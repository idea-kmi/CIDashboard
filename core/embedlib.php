<?php
/********************************************************************************
 *                                                                              *
 *  (c) Copyright 2015 - 2024 The Open University UK                            *
 *                                                                              *
 *  This software is freely distributed in accordance with                      *
 *  the GNU Lesser General Public (LGPL) license, version 3 or later            *
 *  as published by the Free Software Foundation.                               *
 *  For details see LGPL: http://www.fsf.org/licensing/licenses/lgpl.html       *
 *               and GPL: http://www.fsf.org/licensing/licenses/gpl-3.0.html    *
 *                                                                              *
 *  This software is provided by the copyright holders and contributors "as is" *
 *  and any express or implied warranties, including, but not limited to, the   *
 *  implied warranties of merchantability and fitness for a particular purpose  *
 *  are disclaimed. In no event shall the copyright owner or contributors be    *
 *  liable for any direct, indirect, incidental, special, exemplary, or         *
 *  consequential damages (including, but not limited to, procurement of        *
 *  substitute goods or services; loss of use, data, or profits; or business    *
 *  interruption) however caused and on any theory of liability, whether in     *
 *  contract, strict liability, or tort (including negligence or otherwise)     *
 *  arising in any way out of the use of this software, even if advised of the  *
 *  possibility of such damage.                                                 *
 *                                                                              *
 ********************************************************************************/
 /** Author: Michelle Bachler, KMi, The Open University **/

require_once($HUB_FLM->getCodeDirPath("core/formats/json.php"));
require_once($HUB_FLM->getCodeDirPath("core/io/catalyst/analyticservices.php"));
require_once($HUB_FLM->getCodeDirPath('core/io/catalyst/catalyst_jsonld_reader.class.php'));

//$jitterArray = array(-0.01, -0.05, -0.1, 0, 0.1, 0.05, 0.01);
$jitterArray = array(-0.01, -0.02, -0.03, 0, 0.03, 0.02, 0.01);

function getCatalystReader($url,$withhistory,$withvotes,$withposts) {
	global $LNG, $HUB_CACHE, $CFG;

	$reader = $HUB_CACHE->getObjData('reader'.$url.$withhistory.$withvotes.$withposts);
	return $reader;

	//minidashboards share a reader so check there first
	//if (isset($_SESSION['reader'.$url])) {
	//	return $_SESSION['reader'.$url];
	//}

	// if you can't find it, try again with parameters returning greater data sets than required.
	// Only for the know obvious combinations

	/*$reader = $HUB_CACHE->getObjData('reader'.$url.$withhistory.$withvotes.$withposts);

	if ($reader === FALSE) {
		if ($withhistory === false || $withvotes === false || $withposts === false) {
			$temphistory = true;
			$tempvotes = true;
			$tempposts = true;
			$reader = $HUB_CACHE->getObjData('reader'.$url.$temphistory.$tempvotes.$tempposts);
			if ($reader === FALSE) {
		 		if ($temphistory === true && $withvotes === false && $withposts === false) {
					$temphistory = true;
					$tempvotes = false;
					$tempposts = true;
					$reader = $HUB_CACHE->getObjData('reader'.$url.$temphistory.$tempvotes.$tempposts);
					if ($reader === FALSE) {
						$temphistory = true;
						$tempvotes = true;
						$tempposts = false;
						$reader = $HUB_CACHE->getObjData('reader'.$url.$temphistory.$tempvotes.$tempposts);
					}
					return $reader;
				} else if ($temphistory === false && $withvotes === false && $withposts === true) {
					$temphistory = true;
					$tempvotes = false;
					$tempposts = true;
					$reader = $HUB_CACHE->getObjData('reader'.$url.$temphistory.$tempvotes.$tempposts);
					if ($reader === FALSE) {
						$temphistory = false;
						$tempvotes = true;
						$tempposts = true;
						$reader = $HUB_CACHE->getObjData('reader'.$url.$temphistory.$tempvotes.$tempposts);
					}
					return $reader;
				} else if ($temphistory === false && $withvotes === true && $withposts === false) {
					$temphistory = true;
					$tempvotes = true;
					$tempposts = false;
					$reader = $HUB_CACHE->getObjData('reader'.$url.$temphistory.$tempvotes.$tempposts);
					if ($reader === FALSE) {
						$temphistory = false;
						$tempvotes = true;
						$tempposts = true;
						$reader = $HUB_CACHE->getObjData('reader'.$url.$temphistory.$tempvotes.$tempposts);
					}
					return $reader;
				}
			} else {
				return $reader;
			}
		}
	} else {
		return $reader;
	}
	*/
}

function jitterme($num) {
	global $jitterArray;
	$rand = rand(1, 7);
	$finalnum = $num+$jitterArray[$rand-1];
	return $finalnum;
}

/**
 * Load the data for the Stream Graph visulaisation
 * @param url the url for the CIF data to load
 * @param timeout how long (in seconds) to cache the visualisation data
 * before it is considered out of date and should be refetched and recalculated.
 * Defaults to 60 seconds.
 * @param withposts include post data in this visualisation
 * @return a data array of the data loaded from the CIF
 * in the format required for the visualisation
 */
function getStreamGraphData($url, $timeout=60, $withposts=false) {
	global $CFG,$LNG,$HUB_CACHE;

	$withhistory=false;
	$withvotes=false;

	$data = $HUB_CACHE->getObjData($CFG->VIS_PAGE_STREAM_GRAPH.$url.$withhistory.$withvotes.$withposts);
	if ($data === FALSE) {
		//error_log("DATA not FOUND: getStreamGraphData");

		$data = array();

		$reader = $HUB_CACHE->getObjData('reader'.$url.$withhistory.$withvotes.$withposts);
		if ($reader === FALSE) {
			//error_log("READER not FOUND: getStreamGraphData");
			$reader = new catalyst_jsonld_reader();
			$reader = $reader->load($url,$timeout,$withhistory,$withvotes,$withposts);
			$HUB_CACHE->setObjData('reader'.$url.$withhistory.$withvotes.$withposts, $reader, $timeout);
		} else {
			//error_log("READER FOUND: getStreamGraphData");
		}

		//$reader = new catalyst_jsonld_reader();
		//$reader = $reader->load($url,$timeout,$withhistory,$withvotes,$withposts);
		if (!$reader instanceof Hub_Error) {
			$nodeCheck = array();
			$totalnodes = 0;

			$nodes = $reader->nodeSet->nodes;

			$count = 0;
			if (is_countable($nodes)) {
				$count = count($nodes);
			}

			$typeArray = array();

			// get types first
			for ($i=0; $i<$count; $i++) {
				$node = $nodes[$i];
				if (!in_array($node->rolename, $typeArray)) {
					array_push($typeArray, $node->rolename);
				}
			}
			$dateArray = array();

			for ($i=0; $i<$count; $i++) {
				$node = $nodes[$i];
				$datekey = date('d/m/y', $node->creationdate);
				if (!array_key_exists($datekey, $dateArray)) {
					$typearray = array();
					foreach($typeArray as $type) {
						$typearray[$type] = 0;
					}
					$typearray[$node->rolename] = 1;
					$dateArray[$datekey] = $typearray;
				} else {
					$typearray = $dateArray[$datekey];
					if (!isset($typearray[$node->rolename])) {
						$typearray[$node->rolename] = 1;
					} else {
						$typearray[$node->rolename] = $typearray[$node->rolename]+1;
					}
					$dateArray[$datekey] = $typearray;
				}
			}

			// sort by date
			function datesortstacked($datekeyA, $datekeyB) {
				$a = DateTime::createFromFormat("d/m/y", $datekeyA);
				$b = DateTime::createFromFormat("d/m/y", $datekeyB);
				if ($a == $b) $r = 0;
				else $r = ($a > $b) ? 1: -1;
				return $r;
			}
			uksort($dateArray, "datesortstacked");

			$finalArray = array();

			foreach ($typeArray as $next) {
				foreach ($dateArray as $key => $innerdata) {
					foreach ($innerdata as $type => $typecount) {
						if ($type == $next) {
							if (!array_key_exists($next, $finalArray)) {
								$nextarray = array();
								array_push($nextarray, array($key, $typecount));
								$finalArray[$next] = $nextarray;
							} else {
								$nextarray = $finalArray[$next];
								array_push($nextarray, array($key, $typecount));
								$finalArray[$next] = $nextarray;
							}
						}
					}
				}
			}

			foreach ($finalArray as $key => $values) {
				$next = new stdClass();
				$next->key = getNodeTypeText($key, false);
				$next->values = $values;
				array_push($data, $next);
			}
		}

		$HUB_CACHE->setObjData($CFG->VIS_PAGE_STREAM_GRAPH.$url.$withhistory.$withvotes.$withposts, $data, $timeout);
	} else {
		//error_log("DATA FOUND: getStreamGraphData");
	}

	return $data;
}

/**
 * Load the data for the Stacked Area visulaisation
 * @param url the url for the CIF data to load
 * @param timeout how long (in seconds) to cache the visualisation data
 * before it is considered out of date and should be refetched and recalculated.
 * Defaults to 60 seconds.
 * @param withposts include post data in this visualisation
 * @return a json string of the data loaded from the CIF
 * and converted to the json required by the Stacked Area visualisation
 */
function getStackedAreaData($url, $timeout=60, $withposts=false) {
	global $CFG,$HUB_CACHE;

	$withhistory=false;
	$withvotes=false;

	$json = $HUB_CACHE->getStringData($CFG->VIS_PAGE_STACKEDAREA.$url.$withhistory.$withvotes.$withposts);
	if ($json === FALSE) {
		//error_log("DATA not FOUND: getStackedAreaData");

		$reader = $HUB_CACHE->getObjData('reader'.$url.$withhistory.$withvotes.$withposts);
		if ($reader === FALSE) {
			//error_log("READER not FOUND: getStackedAreaData");
			$reader = new catalyst_jsonld_reader();
			$reader = $reader->load($url,$timeout,$withhistory,$withvotes,$withposts);
			$HUB_CACHE->setObjData('reader'.$url.$withhistory.$withvotes.$withposts, $reader, $timeout);
		} else {
			//error_log("READER FOUND: getStackedAreaData");
		}

		//$reader = new catalyst_jsonld_reader();
		//$reader = $reader->load($url,$timeout,$withhistory,$withvotes,$withposts);

		$json = "";
		if (!$reader instanceof Hub_Error) {
			$nodeCheck = array();
			$totalnodes = 0;

			$nodes = $reader->nodeSet->nodes;
			$count = 0;
			if (is_countable($nodes)) {
				$count = count($nodes);
			}

			$typeArray = array();
			$dateArray = array();

			// get types first
			for ($i=0; $i<$count; $i++) {
				$node = $nodes[$i];
				if (!in_array($node->rolename, $typeArray)) {
					array_push($typeArray, $node->rolename);
				}
			}

			for ($i=0; $i<$count; $i++) {
				$node = $nodes[$i];
				$datekey = date('d / m / y', $node->creationdate);
				if (!array_key_exists($datekey, $dateArray)) {
					$typearray = array();
					foreach($typeArray as $type) {
						$typearray[$type] = 0;
					}
					$typearray[$node->rolename] = 1;
					$dateArray[$datekey] = $typearray;
				} else {
					$typearray = $dateArray[$datekey];
					if (!isset($typearray[$node->rolename])) {
						$typearray[$node->rolename] = 1;
					} else {
						$typearray[$node->rolename] = $typearray[$node->rolename]+1;
					}
					$dateArray[$datekey] = $typearray;
				}
			}

			// sort by date
			function datesortstacked($datekeyA, $datekeyB) {
				$a = DateTime::createFromFormat("d / m / y", $datekeyA);
				$b = DateTime::createFromFormat("d / m / y", $datekeyB);
				if ($a == $b) $r = 0;
				else $r = ($a > $b) ? 1: -1;
				return $r;
			}
			uksort($dateArray, "datesortstacked");

			// Turn data into json
			$count = 0;
			if (is_countable($dateArray)) {
				$count = count($dateArray);
			}
			if ($count > 0) {
				$json .=  "{";

				// Add category index list
				$json .=  "'label' : [";

				$countj = 0;
				if (is_countable($typeArray)) {
					$countj = count($typeArray);
				}
				for($j=0; $j<$countj; $j++) {
					$next = $typeArray[$j];
					$json .=  "'".$next."'";
					if ($j < $countj-1) {
						$json .=  ",";
					}
				}
				$json .=  "],";

				$json .=  "'color' : [";
				$countj = 0;
				if (is_countable($typeArray)) {
					$countj = count($typeArray);
				}
				for($j=0; $j<$countj; $j++) {
					$next = $typeArray[$j];
					if ($next == "Pro") {
						$json .=  "'".$CFG->proback."'";
					} else if ($next == "Con") {
						$json .=  "'".$CFG->conback."'";
					} else if ($next == "Argument") {
						$json .=  "'".$CFG->argumentback."'";
					} else if ($next == "Solution" || $next == "Idea" ) {
						$json .=  "'".$CFG->solutionback."'";
					} else if ($next == "Issue") {
						$json .=  "'".$CFG->issueback."'";
					} else if ($next == "Challenge") {
						$json .=  "'".$CFG->challengeback."'";
					} else if ($next == "Comment") {
						$json .=  "'".$CFG->commentback."'";
					} else {
						$json .=  "'".$CFG->unknowntypeback."'";
					}
					if ($j < $countj-1) {
						$json .=  ",";
					}
				}
				$json .=  "],";


				// Add values
				$json .=  "'values': [";
				$i=0;

				foreach ($dateArray as $key => $innerdata) {
					$json .=  "{";
					$json .= "'label': '".$key."',";

					$json .= "'values': [";
					$k=0;
					$countk = 0;
					if (is_countable($innerdata)) {
						$countk = count($innerdata);
					}
					foreach ($innerdata as $type => $typecount) {
						$json .= $typecount;
						if ($k < $countk-1) {
							$json .= ",";
						}
						$k++;
					}
					$json .= "]";
					$json .=  "}";

					if ($i < $count-1) {
						$json .= ",";
					}
					$i++;
				}

				$json .= "]}";
			}
		}

		$HUB_CACHE->setStringData($CFG->VIS_PAGE_STACKEDAREA.$url.$withhistory.$withvotes.$withposts, $json, $timeout);
	} else {
		//error_log("DATA FOUND: getStreamGraphData");
	}
	return $json;
}

/**
 * Helper function for the D3 network data function. Recurses the data tree
 */
function addNextNetworkDataD3Depth($json, $node, $depth, $branch, $treeArray, $checkArray) {
	$json .=  '{';
	$json .=  '"name": "'.parseToJSON($node->name).'",';

	if ($node->description) {
		$json .=  '"description": "'.parseToJSON($node->description).'",';
	}

	$json .=  '"nodetype": "'.parseToJSON($node->rolename).'",';
	$json .=  '"nodetypename": "'.getNodeTypeText(parseToJSON($node->rolename), false).'",';
	if ($node->homepage) {
		$json .=  '"homepage": "'.parseToJSON($node->homepage).'",';
	}
	$json .=  '"branch": "'.parseToJSON($branch).'"';

	$treeitem = $treeArray[$node->nodeid];
	$itemcount = 0;
	if (isset($treeitem["children"]) && is_countable($treeitem["children"])) {
		$itemcount = count($treeitem["children"]);
	}

	if (isset($treeitem["children"]) && $itemcount > 0 && !array_key_exists($node->nodeid, $checkArray)) {

		// make sure you don't recurse the same set of children more than once.
		$checkArray[$node->nodeid] = $node->nodeid;

		$children = $treeitem["children"];
		$treeitem = $treeArray[$node->nodeid];
		$countkids = 0;
		if (is_countable($children)) {
			$countkids = count($children);
		}
		$json .=  ',"children": [';
		for ($i=0; $i<$countkids; $i++) {
			$child = $children[$i];
			$json = addNextNetworkDataD3Depth($json, $child, $depth+1, $branch, $treeArray, $checkArray);
			if ($i<$countkids-1) {
				$json .=  ',';
			}
		}
		$json .=  "]";
	} else {
		$json .=  ',"size": '.(2000-(20*$depth));
	}

	$json .=  "}";
	return $json;
}

/**
 * Load the data for D3 network/tree based visualisation like Circle Packing / Sunburst / TreeMap visualisation
 * @param url the url for the CIF data to load
 * @param timeout how long (in seconds) to cache the visualisation data
 * before it is considered out of date and should be refetched and recalculated.
 * Defaults to 60 seconds.
 * @param withposts include post data in this visualisation
 * @return a json string of the data loaded from the CIF
 * and converted to the json required by the Circle packing visualisation
 */
function getNetworkDataD3($url, $timeout=60, $withposts=false) {
	global $CFG,$HUB_CACHE;

	$withhistory=false;
	$withvotes=false;

	$json = $HUB_CACHE->getStringData($CFG->VIS_PAGE_CIRCLEPACKING.$url.$withhistory.$withvotes.$withposts);
	if ($json === FALSE) {
		//error_log("DATA not FOUND: getNetworkDataD3");

		$reader = $HUB_CACHE->getObjData('reader'.$url.$withhistory.$withvotes.$withposts);
		if ($reader === FALSE) {
			//error_log("READER not FOUND: getNetworkDataD3");
			$reader = new catalyst_jsonld_reader();
			$reader = $reader->load($url,$timeout,$withhistory,$withvotes,$withposts);
			$HUB_CACHE->setObjData('reader'.$url.$withhistory.$withvotes.$withposts, $reader, $timeout);
		} else {
			//error_log("READER FOUND: getNetworkDataD3");
		}

		//$reader = new catalyst_jsonld_reader();
		//$reader = $reader->load($url,$timeout,$withhistory,$withvotes,$withposts);

		$json = "";
		if (!$reader instanceof Hub_Error) {
			$conSet = $reader->connectionSet;
			$cons = $conSet->connections;
			$countcons = 0;
			if (is_countable($cons)) {
				$countcons = count($cons);
			}

			$nodeSet = $reader->nodeSet;
			$nodes = $nodeSet->nodes;
			$countnodes = 0;
			if (is_countable($nodes)) {
				$countnodes = count($nodes);
			}

			$checkArray = array();
			$treeArray = array();

			for ($i=0; $i<$countnodes; $i++) {
				$node = $nodes[$i];
				if (!array_key_exists($node->nodeid, $treeArray)) {
					$nodem = array();
					$nodem["to"] = 0;
					$nodem["from"] = 0;
					$nodem["node"] = $node;
					$treeArray[$node->nodeid] = $nodem;
				}
			}

			for ($i=0; $i<$countcons; $i++) {
				$con = $cons[$i];

				$from = $con->from;
				$to = $con->to;

				if (array_key_exists($from->nodeid, $treeArray)) {
					$nodem = $treeArray[$from->nodeid];
					$nodem["from"] = $nodem["from"]+1;
					$treeArray[$from->nodeid] = $nodem;
				} else {
					$nodem = array();
					$nodem["to"] = 0;
					$nodem["from"] = 1;
					$nodem["node"] = $from;
					$treeArray[$from->nodeid] = $nodem;
				}

				if (array_key_exists($to->nodeid, $treeArray)) {
					$nodem = $treeArray[$to->nodeid];
					$nodem["to"] = $nodem["to"]+1;
					if (isset($nodem["children"])) {
						$children = $nodem["children"];
						array_push($children, $from);
						$nodem["children"] = $children;
					} else {
						$children = array();
						array_push($children, $from);
						$nodem["children"] = $children;
					}
					$treeArray[$to->nodeid] = $nodem;
				} else {
					$nodem = array();
					$nodem["to"] = 1;
					$nodem["from"] = 0;
					$nodem["node"] = $to;
					$children = array();
					array_push($children, $from);
					$nodem["children"] = $children;
					$treeArray[$to->nodeid] = $nodem;
				}
			}

			//$file = 'circlepackingA.txt';
			//$results = print_r($treeArray, true);
			//file_put_contents($file, $results);

			$topNodes = array();
			$counttop = 0;
			if (is_countable($treeArray)) {
				$counttop = count($treeArray);
			}
			foreach ($treeArray as $key => $value) {
				if ($value["from"] == 0) {
					array_push($topNodes, $value["node"]);
				}
			}

			$json .=  '{';
			$json .=  '"name": "Group",';
			$json .=  '"nodetype": "Group",';
			$json .=  '"nodetypename": "Group"';
			$count = 0;
			if (is_countable($topNodes)) {
				$count = count($topNodes);
			}
			if ($count > 0) {
				$json .=  ',"children": [';
				for ($i=0; $i<$count; $i++) {
					$node = $topNodes[$i];
					$json = addNextNetworkDataD3Depth($json, $node, 1, $i, $treeArray, $checkArray);
					if ($i<$count-1) {
						$json .=  ',';
					}
				}
				$json .=  "]";
			} else {
				$json .=  ',"size": "2000"';
			}

			$json .=  "}";
		}

		$HUB_CACHE->setStringData($CFG->VIS_PAGE_CIRCLEPACKING.$url.$withhistory.$withvotes.$withposts, $json, $timeout);
	} else {
		//error_log("DATA FOUND: getNetworkDataD3");
	}

	return $json;
}

/**
 * Helper function for the getNetworkDataD32 function. Recurses the data tree
 */
function addNextNetworkDataD3DepthComments($json, $node, $depth, $branch, $treeArray, $checkArray, &$commentcount, &$commentCheckArray) {
	global $CFG;

	if (!in_array($node->nodeid,$commentCheckArray)) {
		$commentcount = $commentcount+1;
		array_push($commentCheckArray, $node->nodeid);
	}

	$json .=  '{';
	$json .=  '"name": "'.parseToJSON($node->name).'",';
	$json .=  '"nodeid": "'.parseToJSON($node->nodeid).'",';
	$json .=  '"nodetype": "'.parseToJSON($node->rolename).'",';
	$json .=  '"nodetypename": "'.getNodeTypeText(parseToJSON($node->rolename), false).'",';
	$json .=  '"image": "'.parseToJSON($node->role->image).'",';
	if (isset($node->description)) {
		$json .=  '"description": "'.parseToJSON($node->description).'",';
	}
	if (isset($node->homepage)) {
		$json .=  '"homepage": "'.parseToJSON($node->homepage).'",';
	}
	$json .=  '"branch": "'.parseToJSON($branch).'"';

	$treeitem = $treeArray[$node->nodeid];
	$itemcount = 0;
	if (isset($treeitem["children"]) && is_countable($treeitem["children"])) {
		$itemcount = count($treeitem["children"]);
	}

	if (isset($treeitem["children"]) && $itemcount > 0
		&& !array_key_exists($node->nodeid, $checkArray)) {

		// make sure you don't recurse the same set of children more than once.
		$checkArray[$node->nodeid] = $node->nodeid;

		$children = $treeitem["children"];
		$countkids = 0;
		if (is_countable($children)) {
			$countkids = count($children);
		}
		$json .=  ',"children": [';
		for ($i=0; $i<$countkids; $i++) {
			$child = $children[$i];
			$json = addNextNetworkDataD3DepthComments($json, $child, $depth+1, $branch, $treeArray, $checkArray, $commentcount, $commentCheckArray);
			if ($i<$countkids-1) {
				$json .=  ',';
			}
		}
		$json .=  "],";
	} else {
		$json .=  ',"size": '.(2000-(20*$depth)).",";
	}

	$json .=  "}";
	return $json;
}

/**
 * Helper function for the getNetworkDataD32 function. Recurses the data tree
 */
function addNextNetworkDataD3DepthPosts($json, $node, $depth, $branch, $treeArray, $checkArray) {
	global $CFG;

	$json .=  '{';
	$json .=  '"name": "'.parseToJSON($node->name).'",';
	$json .=  '"nodeid": "'.parseToJSON($node->nodeid).'",';
	$json .=  '"nodetype": "'.parseToJSON($node->rolename).'",';
	$json .=  '"nodetypename": "'.getNodeTypeText(parseToJSON($node->rolename), false).'",';
	$json .=  '"image": "'.parseToJSON($CFG->homeAddress.$node->role->image).'",';
	if (isset($node->description)) {
		$json .=  '"description": "'.parseToJSON($node->description).'",';
	}
	if (isset($node->homepage)) {
		$json .=  '"homepage": "'.parseToJSON($node->homepage).'",';
	}
	$json .=  '"branch": "'.parseToJSON($branch).'"';

	$treeitem = $treeArray[$node->nodeid];
	$itemcount = 0;
	if (isset($treeitem["children"]) && is_countable($treeitem["children"])) {
		$itemcount = count($treeitem["children"]);
	}

	if (isset($treeitem["children"]) && $itemcount > 0 && !array_key_exists($node->nodeid, $checkArray)) {

		// make sure you don't recurse the same set of children more than once.
		$checkArray[$node->nodeid] = $node->nodeid;
		$commentsArray = array();
		$commentsCountArray = array();
		$commentCheckArray = array();

		$kidsArray = array();

		$children = $treeitem["children"];
		$countkids = 0;
		if (is_countable($children)) {
			$countkids = count($children);
		}
		for ($i=0; $i<$countkids; $i++) {
			$child = $children[$i];
			if ($child->rolename == "Comment") {
				$commentsjson = "";
				$commentcount = 0;
				$commentsjson = addNextNetworkDataD3DepthComments($commentsjson, $child, $depth+1, $branch, $treeArray, $checkArray, $commentcount, $commentCheckArray);
				array_push($commentsArray, $commentsjson);
				array_push($commentsCountArray, $commentcount);
			} else {
				$kidsjson = "";
				$kidsjson = addNextNetworkDataD3DepthPosts($kidsjson, $child, $depth+1, $branch, $treeArray, $checkArray);
				array_push($kidsArray, $kidsjson);
			}
		}

		$kidscount = 0;
		if (is_countable(kidsArray)) {
			$kidscount = count(kidsArray);
		}
		if ($kidscount > 0) {
			$json .=  ',"children": [';
			for ($i=0; $i<$kidscount; $i++) {
				$next = $kidsArray[$i];
				$json .= $next;
				if ($i<$kidscount-1) {
					$json .=  ',';
				}
			}
			$json .=  "]";
		}

		$commentcount = 0;
		if (is_countable($commentsArray)) {
			$commentcount = count($commentsArray);
		}
		if ($commentcount > 0) {
			$totalcomments = 0;
			$json .=  ',"comments": [';
			for ($i=0; $i<$commentcount; $i++) {
				$next = $commentsArray[$i];
				$json .= $next;
				$totalcomments = $totalcomments+intval($commentsCountArray[$i]);
				if ($i<$commentcount-1) {
					$json .=  ',';
				}
			}
			$json .=  "]";
			$json .=  ',"commentcount": "'.$totalcomments.'"';
		}
	} else {
		$json .=  ',"size": '.(2000-(20*$depth));
	}

	$json .=  "}";
	return $json;
}

/**
 * Load the data for D3 network tree Special to include posts as data only and not part of tree
 * @param url the url for the CIF data to load
 * @param timeout how long (in seconds) to cache the visualisation data
 * before it is considered out of date and should be refetched and recalculated.
 * Defaults to 60 seconds.
 * @param withposts include post data in this visualisation
 * @return a json string of the data loaded from the CIF
 * and converted to the json required by the Circle packing visualisation
 */
function getNetworkDataD3Posts($url, $timeout=60) {
	global $CFG,$HUB_CACHE;

	$withhistory=false;
	$withvotes=false;
	$withposts=true;

	$json = $HUB_CACHE->getStringData($CFG->VIS_PAGE_TREE_BY_POSTS."2".$url.$withhistory.$withvotes.$withposts);
	if ($json === FALSE) {
		//error_log("DATA not FOUND: getNetworkDataD3");

		$reader = $HUB_CACHE->getObjData('reader'.$url.$withhistory.$withvotes.$withposts);
		if ($reader === FALSE) {
			//error_log("READER not FOUND: getNetworkDataD3");
			$reader = new catalyst_jsonld_reader();
			$reader = $reader->load($url,$timeout,$withhistory,$withvotes,$withposts);
			$HUB_CACHE->setObjData('reader'.$url.$withhistory.$withvotes.$withposts, $reader, $timeout);
		} else {
			//error_log("READER FOUND: getNetworkDataD3");
		}

		//$reader = new catalyst_jsonld_reader();
		//$reader = $reader->load($url,$timeout,$withhistory,$withvotes,$withposts);

		$json = "";
		if (!$reader instanceof Hub_Error) {
			$conSet = $reader->connectionSet;
			$cons = $conSet->connections;
			$countcons = 0;
			if (is_countable($cons)) {
				$countcons = count($cons);
			}

			$nodeSet = $reader->nodeSet;
			$nodes = $nodeSet->nodes;
			$countnodes = 0;
			if (is_countable($nodes)) {
				$countnodes = count($nodes);
			}

			$checkArray = array();
			$treeArray = array();

			for ($i=0; $i<$countnodes; $i++) {
				$node = $nodes[$i];
				if (!array_key_exists($node->nodeid, $treeArray)) {
					$nodem = array();
					$nodem["to"] = 0;
					$nodem["from"] = 0;
					$nodem["node"] = $node;
					$treeArray[$node->nodeid] = $nodem;
				}
			}

			for ($i=0; $i<$countcons; $i++) {
				$con = $cons[$i];

				$from = $con->from;
				$to = $con->to;

				if (array_key_exists($from->nodeid, $treeArray)) {
					$nodem = $treeArray[$from->nodeid];
					$nodem["from"] = $nodem["from"]+1;
					$treeArray[$from->nodeid] = $nodem;
				} else {
					$nodem = array();
					$nodem["to"] = 0;
					$nodem["from"] = 1;
					$nodem["node"] = $from;
					$treeArray[$from->nodeid] = $nodem;
				}

				if (array_key_exists($to->nodeid, $treeArray)) {
					$nodem = $treeArray[$to->nodeid];
					$nodem["to"] = $nodem["to"]+1;
					if (isset($nodem["children"])) {
						$children = $nodem["children"];
						array_push($children, $from);
						$nodem["children"] = $children;
					} else {
						$children = array();
						array_push($children, $from);
						$nodem["children"] = $children;
					}
					$treeArray[$to->nodeid] = $nodem;
				} else {
					$nodem = array();
					$nodem["to"] = 1;
					$nodem["from"] = 0;
					$nodem["node"] = $to;
					$children = array();
					array_push($children, $from);
					$nodem["children"] = $children;
					$treeArray[$to->nodeid] = $nodem;
				}
			}

			$topNodes = array();
			$counttop = 0;
			if (is_countable($treeArray)) {
				$counttop = count($treeArray);
			}
			foreach ($treeArray as $key => $value) {
				if ($value["node"]->rolename != "Comment" && $value["from"] == 0) {
					array_push($topNodes, $value["node"]);
				}
			}

			$count = 0;
			if (is_countable($topNodes)) {
				$count = count($topNodes);
			}
			if ($count == 1) {
				$depth = 0;
				$node = $topNodes[0];
				$json .=  '{';
				$json .=  '"name": "'.parseToJSON($node->name).'",';
				$json .=  '"nodetype": "'.parseToJSON($node->rolename).'",';
				$json .=  '"nodetypename": "'.getNodeTypeText(parseToJSON($node->rolename), false).'",';
				$json .=  '"image": "'.parseToJSON($CFG->homeAddress.$node->role->image).'",';
				if (isset($node->description)) {
					$json .=  '"description": "'.parseToJSON($node->description).'",';
				}
				if (isset($node->homepage)) {
					$json .=  '"homepage": "'.parseToJSON($node->homepage).'",';
				}
				$json .=  '"nodeid": "'.parseToJSON($node->nodeid).'"';

				$treeitem = $treeArray[$node->nodeid];
				$itemcount = 0;
				if (isset($treeitem["children"]) && is_countable($treeitem["children"])) {
					$itemcount = count($treeitem["children"]);
				}

				if (isset($treeitem["children"]) && $itemcount > 0 && !array_key_exists($node->nodeid, $checkArray)) {
					// make sure you don't recurse the same set of children more than once.
					$checkArray[$node->nodeid] = $node->nodeid;

					$commentsArray = array();
					$commentsCountArray = array();
					$kidsArray = array();

					$children = $treeitem["children"];
					$countkids = 0;
					if (is_countable($children)) {
						$countkids = count($children);
					}
					for ($i=0; $i<$countkids; $i++) {
						$child = $children[$i];
						if ($child->rolename == "Comment") {
							$commentcount = 0;
							$commentsjson = "";
							$commentsjson = addNextNetworkDataD3DepthComments($commentsjson, $child, 1, $i, $treeArray, $checkArray,$commentcount);
							array_push($commentsArray, $commentsjson);
							array_push($commentsCountArray, $commentcount);
						} else {
							$kidsjson = "";
							$kidsjson = addNextNetworkDataD3DepthPosts($kidsjson, $child, 1, $i, $treeArray, $checkArray);
							array_push($kidsArray, $kidsjson);
						}
					}

					$kidscount = 0;
					if (is_countable($kidsArray)) {
						$kidscount = count($kidsArray);
					}
					if ($kidscount > 0) {
						$json .=  ',"children": [';
						for ($i=0; $i<$kidscount; $i++) {
							$next = $kidsArray[$i];
							$json .= $next;
							if ($i<$kidscount-1) {
							$json .=  ',';
							}
						}
						$json .=  "]";
					}

					$commentcount = 0;
					if (is_countable($commentsArray)) {
						$commentcount = count($commentsArray);
					}
					if ($commentcount > 0) {
						$totalcomments = 0;
						$json .=  ',"comments": [';
						for ($i=0; $i<$commentcount; $i++) {
							$next = $commentsArray[$i];
							$json .= $next;
							$totalcomments  = $totalcomments+intval($commentsCountArray[$i]);
							if ($i<$commentcount-1) {
								$json .=  ',';
							}
						}
						$json .=  "]";
						$json .=  ',"commentcount": "'.$totalcomments.'"';
					}
				} else {
					$json .=  ',"size": '.(2000-(20*$depth));
				}
				$json .=  "}";
			} else {
				$json .=  '{';
				$json .=  '"name": "Group",';
				$json .=  '"nodetype": "Group",';
				$json .=  '"nodetypename": "Group"';
				if ($count > 0) {
					$json .=  ',"children": [';
					for ($i=0; $i<$count; $i++) {
						$node = $topNodes[$i];
						$json = addNextNetworkDataD3DepthPosts($json, $node, 1, $i, $treeArray, $checkArray);
						if ($i<$count-1) {
							$json .=  ',';
						}
					}
					$json .=  "]";
				} else {
					$json .=  ',"size": "2000"';
				}

				$json .=  "}";
			}
		}

		$HUB_CACHE->setStringData($CFG->VIS_PAGE_TREE_BY_POSTS."2".$url.$withhistory.$withvotes.$withposts, $json, $timeout);
	} else {
		//error_log("DATA FOUND: getNetworkDataD3");
	}

	return $json;
}


/**
 * Helper function for the D3 network data function. Recurses the data tree
 */
function addNextNetworkDataD3Depth2($json, $node, $depth, $branch, $treeArray, $checkArray) {
	global $CFG;

	$json .=  '{';
	$json .=  '"name": "'.parseToJSON($node->name).'",';
	$json .=  '"nodeid": "'.parseToJSON($node->nodeid).'",';
	$json .=  '"image": "'.parseToJSON($CFG->homeAddress.$node->role->image).'",';
	$json .=  '"nodetype": "'.parseToJSON($node->rolename).'",';
	$json .=  '"nodetypename": "'.getNodeTypeText(parseToJSON($node->rolename), false).'",';

	if (isset($node->description)) {
		$json .=  '"description": "'.parseToJSON($node->description).'",';
	}
	if (isset($node->homepage)) {
		$json .=  '"homepage": "'.parseToJSON($node->homepage).'",';
	}
	$json .=  '"branch": "'.parseToJSON($branch).'"';

	$treeitem = $treeArray[$node->nodeid];
	$itemcount = 0;
	if (isset($treeitem["children"]) && is_countable($treeitem["children"])) {
		$itemcount = count($treeitem["children"]);
	}

	if (isset($treeitem["children"]) && $itemcount > 0 && !array_key_exists($node->nodeid, $checkArray)) {

		// make sure you don't recurse the same set of children more than once.
		$checkArray[$node->nodeid] = $node->nodeid;

		$children = $treeitem["children"];
		$countkids = 0;
		if (is_countable($children)) {
			$countkids = count($children);
		}
		$json .=  ',"children": [';
		for ($i=0; $i<$countkids; $i++) {
			$child = $children[$i];
			$json = addNextNetworkDataD3Depth2($json, $child, $depth+1, $branch, $treeArray, $checkArray);
			if ($i<$countkids-1) {
				$json .=  ',';
			}
		}
		$json .=  "]";
	} else {
		$json .=  ',"size": '.(2000-(20*$depth));
	}

	$json .=  "}";
	return $json;
}

/**
 * Load the data for D3 network tree
 * @param url the url for the CIF data to load
 * @param timeout how long (in seconds) to cache the visualisation data
 * before it is considered out of date and should be refetched and recalculated.
 * Defaults to 60 seconds.
 * @param withposts include post data in this visualisation
 * @return a json string of the data loaded from the CIF
 * and converted to the json required by the Circle packing visualisation
 */
function getNetworkDataD32($url, $timeout=60, $withposts=false) {
	global $CFG,$HUB_CACHE;

	$withhistory=false;
	$withvotes=false;

	$json = $HUB_CACHE->getStringData($CFG->VIS_PAGE_TREE."2".$url.$withhistory.$withvotes.$withposts);
	if ($json === FALSE) {
		$reader = $HUB_CACHE->getObjData('reader'.$url.$withhistory.$withvotes.$withposts);
		if ($reader === FALSE) {
			//error_log("READER not FOUND: getNetworkDataD32");
			$reader = new catalyst_jsonld_reader();
			$reader = $reader->load($url,$timeout,$withhistory,$withvotes,$withposts);
			$HUB_CACHE->setObjData('reader'.$url.$withhistory.$withvotes.$withposts, $reader, $timeout);
		} else {
			//error_log("READER FOUND: getNetworkDataD32");
		}

		$json = "";
		if (!$reader instanceof Hub_Error) {
			$conSet = $reader->connectionSet;
			$cons = $conSet->connections;
			$countcons = 0;
			if (is_countable($cons)) {
				$countcons = count($cons);
			}

			$nodeSet = $reader->nodeSet;
			$nodes = $nodeSet->nodes;
			$countnodes = 0;
			if (is_countable($nodes)) {
				$countnodes = count($nodes);
			}

			$checkArray = array();
			$treeArray = array();

			for ($i=0; $i<$countnodes; $i++) {
				$node = $nodes[$i];
				if (!array_key_exists($node->nodeid, $treeArray)) {
					$nodem = array();
					$nodem["to"] = 0;
					$nodem["from"] = 0;
					$nodem["node"] = $node;
					$treeArray[$node->nodeid] = $nodem;
				}
			}

			for ($i=0; $i<$countcons; $i++) {
				$con = $cons[$i];

				$from = $con->from;
				$to = $con->to;

				if (array_key_exists($from->nodeid, $treeArray)) {
					$nodem = $treeArray[$from->nodeid];
					$nodem["from"] = $nodem["from"]+1;
					$treeArray[$from->nodeid] = $nodem;
				} else {
					$nodem = array();
					$nodem["to"] = 0;
					$nodem["from"] = 1;
					$nodem["node"] = $from;
					$treeArray[$from->nodeid] = $nodem;
				}

				if (array_key_exists($to->nodeid, $treeArray)) {
					$nodem = $treeArray[$to->nodeid];
					$nodem["to"] = $nodem["to"]+1;
					if (isset($nodem["children"])) {
						$children = $nodem["children"];
						array_push($children, $from);
						$nodem["children"] = $children;
					} else {
						$children = array();
						array_push($children, $from);
						$nodem["children"] = $children;
					}
					$treeArray[$to->nodeid] = $nodem;
				} else {
					$nodem = array();
					$nodem["to"] = 1;
					$nodem["from"] = 0;
					$nodem["node"] = $to;
					$children = array();
					array_push($children, $from);
					$nodem["children"] = $children;
					$treeArray[$to->nodeid] = $nodem;
				}
			}

			$topNodes = array();
			$counttop = 0;
			if (is_countable($treeArray)) {
				$counttop = count($treeArray);
			}
			foreach ($treeArray as $key => $value) {
				if ($value["from"] == 0) {
					array_push($topNodes, $value["node"]);
				}
			}

			$count = 0;
			if (is_countable($topNodes)) {
				$count = count($topNodes);
			}
			if ($count == 1) {
				$depth = 0;
				$node = $topNodes[0];
				$json .=  '{';
				$json .=  '"name": "'.parseToJSON($node->name).'",';
				$json .=  '"image": "'.parseToJSON($CFG->homeAddress.$node->role->image).'",';
				$json .=  '"nodetype": "'.parseToJSON($node->rolename).'",';
				$json .=  '"nodetypename": "'.getNodeTypeText(parseToJSON($node->rolename), false).'",';
				if (isset($node->description)) {
					$json .=  '"description": "'.parseToJSON($node->description).'",';
				}
				if (isset($node->homepage)) {
					$json .=  '"homepage": "'.parseToJSON($node->homepage).'",';
				}
				$json .=  '"nodeid": "'.parseToJSON($node->nodeid).'"';

				$treeitem = $treeArray[$node->nodeid];
				$itemcount = 0;
				if (isset($treeitem["children"]) && is_countable($treeitem["children"])) {
					$itemcount = count($treeitem["children"]);
				}

				if (isset($treeitem["children"]) && $itemcount > 0 && !array_key_exists($node->nodeid, $checkArray)) {
					// make sure you don't recurse the same set of children more than once.
					$checkArray[$node->nodeid] = $node->nodeid;

					$json .=  ',"children": [';
					$children = $treeitem["children"];
					$countkids = 0;
					if (is_countable($children)) {
						$countkids = count($children);
					}
					for ($i=0; $i<$countkids; $i++) {
						$child = $children[$i];
						$json = addNextNetworkDataD3Depth2($json, $child, 1, $i, $treeArray, $checkArray);
						if ($i<$countkids-1) {
							$json .=  ',';
						}
					}
					$json .=  "]";
				} else {
					$json .=  ',"size": '.(2000-(20*$depth));
				}
				$json .=  "}";
			} else {
				$json .=  '{';
				$json .=  '"name": "Group",';
				$json .=  '"nodetype": "Group",';
				$json .=  '"nodetypename": "Group"';
				if ($count > 0) {
					$json .=  ',"children": [';
					//error_log("Count=".$count);
					for ($i=0; $i<$count; $i++) {
						$node = $topNodes[$i];
						$json = addNextNetworkDataD3Depth2($json, $node, 1, $i, $treeArray, $checkArray);
						if ($i<$count-1) {
							$json .=  ',';
						}
					}
					$json .=  "]";
				} else {
					$json .=  ',"size": "2000"';
				}

				$json .=  "}";
			}
		}

		$HUB_CACHE->setStringData($CFG->VIS_PAGE_TREE."2".$url.$withhistory.$withvotes.$withposts, $json, $timeout);
	} else {
		//error_log("DATA FOUND: getNetworkDataD3");
	}

	return $json;
}

/**
 * Helper function for the Circle Packing Attention function. Recurses the data tree
 */
function addNextCirclePackingAttentionDepth($json, $node, $depth,$treeArray, $checkArray, $circlesizearray, $circlecolorarray) {
	$json .=  '{';
	$json .=  '"name": "'.parseToJSON($node->name).'",';
	$json .=  '"nodetype": "'.parseToJSON($node->rolename).'",';
	$json .=  '"nodetypename": "'.getNodeTypeText(parseToJSON($node->rolename), false).'"';
	if (array_key_exists($node->nodeid, $circlecolorarray)) {
		$json .=  ',"colornumber": "'.((round($circlecolorarray[$node->nodeid], 1))).'"';
	} else {
		$json .=  ',"colornumber": "0"';
		//error_log("Color not found for:".$node->nodeid);
	}

	$treeitem = $treeArray[$node->nodeid];
	$itemcount = 0;
	if (isset($treeitem["children"]) && is_countable($treeitem["children"])) {
		$itemcount = count($treeitem["children"]);
	}

	if (isset($treeitem["children"]) && $itemcount > 0 && !array_key_exists($node->nodeid, $checkArray)) {
		// make sure you don't recurse the same set of children more than once.
		$checkArray[$node->nodeid] = $node->nodeid;

		$children = $treeitem["children"];
		$countkids = 0;
		if (is_countable($children)) {
			$countkids = count($children);
		}
		$json .=  ',"children": [';
		for ($i=0; $i<$countkids; $i++) {
			$child = $children[$i];
			$json = addNextCirclePackingAttentionDepth($json, $child, $depth+1,$treeArray, $checkArray, $circlesizearray, $circlecolorarray);
			if ($i<$countkids-1) {
				$json .=  ',';
			}
		}
		$json .=  "]";
	}

	$circlesize = 0; //(2000-(20*$depth));
	if (array_key_exists($node->nodeid, $circlesizearray)) {
		$circlesize = $circlesizearray[$node->nodeid];
	}
	$json .=  ',"size": '.$circlesize;

	$json .=  "}";
	return $json;
}

/**
 * Load the data for the Circle Packing attention visulaisation
 * @param url the url for the CIF data to load
 * @param timeout how long (in seconds) to cache the visualisation data
 * before it is considered out of date and should be refetched and recalculated.
 * Defaults to 60 seconds.
 * @return a json string of the data loaded from the CIF
 * and converted to the json required by the Circle packing visualisation
 */
function getCirclePackingAttentionData($url, $timeout=60) {
	global $CFG,$LNG,$HUB_CACHE;

	$withhistory=false;
	$withvotes=false;
	$withposts = false;

	$json = $HUB_CACHE->getStringData($CFG->VIS_PAGE_CIRCLEPACKING_ATTENTION.$url.$withhistory.$withvotes.$withposts);
	if ($json === FALSE) {
		//error_log("DATA not FOUND: getCirclePackingAttentionData");

		$reader = $HUB_CACHE->getObjData('reader'.$url.$withhistory.$withvotes.$withposts);
		if ($reader === FALSE) {
			//error_log("READER not FOUND: getCirclePackingAttentionData");
			$reader = new catalyst_jsonld_reader();
			$reader = $reader->load($url,$timeout,$withhistory,$withvotes,$withposts);
			$HUB_CACHE->setObjData('reader'.$url.$withhistory.$withvotes.$withposts, $reader, $timeout);
		} else {
			//error_log("READER FOUND: getCirclePackingAttentionData");
		}

		//$reader = new catalyst_jsonld_reader();
		//$reader = $reader->load($url,$timeout,$withhistory,$withvotes,$withposts);

		$json = "";
		if (!$reader instanceof Hub_Error) {
			$circlesizearray = array();
			$circlecolorarray = array();
			$biggestsize = 2000;

			// GET METRICS
			$interestmetric = 'interest_by_community';
			$inequalitymetric = 'interest_inequality';
			$metric = $interestmetric.','.$inequalitymetric;
			$reply = "";

			if ($url == $CFG->homeAddress.'testing/naples.json') {
				$reply = getCannedResults($CFG->homeAddress.'testing/naples-attention-output.json');
			} /*else if ($url == $CFG->homeAddress.'testing/d14.f.json') {
				$reply = getCannedResults($CFG->homeAddress.'testing/d14.f.-attention-output.json');
			}*/ else {
				$reply = getMetrics($url, $metric, $timeout);
			}

			// {warnings: [string,* ], responses: [ result,* ] }
			$replyObj = json_decode($reply);
			$results = $replyObj->responses;

			//error_log(print_r($reply, true));
			if ( (!isset($results[0]->error) && isset($results[0]->data)) &&
				(!isset($results[1]->error) && isset($results[1]->data))
			) {
				$next = $results[0]->metric;

				//error_log("NEXT:".print_r($next, true));

				$interestmetricdata = "";
				$inequalitymetricdata = "";
				if ($next == $interestmetric) {
					$interestmetricdata = $results[0]->data;
				}
				$next = $results[1]->metric;
				if ($next == $inequalitymetric) {
					$inequalitymetricdata = $results[1]->data;
				}

				if ($interestmetricdata != "") {
					//error_log("metric:interestmetric data:".print_r($interestmetricdata, true));
					foreach($interestmetricdata as $nodeid => $value) {
						if (!array_key_exists($nodeid, $circlesizearray) && $nodeid != 'null') {
							if ($value > intval($biggestsize)) {
								$biggestsize = $value;
							}
							$circlesizearray[$nodeid] = $value;
						}
					}
				}

				if ($inequalitymetricdata != "") {
					//error_log("metric:inequalitymetric data:".print_r($inequalitymetricdata, true));
					foreach($inequalitymetricdata as $nodeid => $value) {
						if (!array_key_exists($nodeid, $circlecolorarray) && $nodeid != 'null') {
							$circlecolorarray[$nodeid] = $value;
						}
					}
				}
			}

			//error_log(print_r($circlecolorarray, true));

			$conSet = $reader->connectionSet;
			$cons = $conSet->connections;
			$countcons = 0;
			if (is_countable($cons)) {
				$countcons = count($cons);
			}

			$nodeSet = $reader->nodeSet;
			$nodes = $nodeSet->nodes;
			$countnodes = 0;
			if (is_countable($nodes)) {
				$countnodes = count($nodes);
			}

			$checkArray = array();
			$treeArray = array();

			for ($i=0; $i<$countnodes; $i++) {
				$node = $nodes[$i];
				if (!array_key_exists($node->nodeid, $treeArray)) {
					$nodem = array();
					$nodem["to"] = 0;
					$nodem["from"] = 0;
					$nodem["node"] = $node;
					$treeArray[$node->nodeid] = $nodem;
				}
			}

			for ($i=0; $i<$countcons; $i++) {
				$con = $cons[$i];

				$from = $con->from;
				$to = $con->to;

				if (array_key_exists($from->nodeid, $treeArray)) {
					$nodem = $treeArray[$from->nodeid];
					$nodem["from"] = $nodem["from"]+1;
					$treeArray[$from->nodeid] = $nodem;
				} else {
					$nodem = array();
					$nodem["to"] = 0;
					$nodem["from"] = 1;
					$nodem["node"] = $from;
					$treeArray[$from->nodeid] = $nodem;
				}

				if (array_key_exists($to->nodeid, $treeArray)) {
					$nodem = $treeArray[$to->nodeid];
					$nodem["to"] = $nodem["to"]+1;
					if (isset($nodem["children"])) {
						$children = $nodem["children"];
						array_push($children, $from);
						$nodem["children"] = $children;
					} else {
						$children = array();
						array_push($children, $from);
						$nodem["children"] = $children;
					}
					$treeArray[$to->nodeid] = $nodem;
				} else {
					$nodem = array();
					$nodem["to"] = 1;
					$nodem["from"] = 0;
					$nodem["node"] = $to;
					$children = array();
					array_push($children, $from);
					$nodem["children"] = $children;
					$treeArray[$to->nodeid] = $nodem;
				}
			}

			//$file = 'circlepackingA.txt';
			//$results = print_r($treeArray, true);
			//file_put_contents($file, $results);

			$topNodes = array();
			$counttop = 0;
			if (is_countable($treeArray)) {
				$counttop = count($treeArray);
			}
			foreach ($treeArray as $key => $value) {
				if ($value["from"] == 0) {
					array_push($topNodes, $value["node"]);
				}
			}

			$json .=  '{';
			$json .=  '"name": "Group",';
			$json .=  '"nodetype": "Group",';
			$json .=  '"nodetypename": "Group",';
			$json .=  '"color": "#F4F5F7"';
			$count = 0;
			if (is_countable($topNodes)) {
				$count = count($topNodes);
			}
			if ($count > 0) {
				$json .=  ',"children": [';
				for ($i=0; $i<$count; $i++) {
					$node = $topNodes[$i];
					$json = addNextCirclePackingAttentionDepth($json, $node, 1, $treeArray, $checkArray, $circlesizearray, $circlecolorarray);
					if ($i<$count-1) {
						$json .=  ',';
					}
				}
				$json .=  "]";
			} else {
				$json .=  ',"size": "'.$biggestsize.'"';
			}

			$json .=  "}";
		}
		$HUB_CACHE->setStringData($CFG->VIS_PAGE_CIRCLEPACKING_ATTENTION.$url.$withhistory.$withvotes.$withposts, $json, $timeout);
	} else {
		//error_log("DATA FOUND: getCirclePackingAttentionData");
	}

	//error_log(print_r($json, true));

	return $json;
}

/**
 * Load the data for the Sunburst visulaisation
 * @param url the url for the CIF data to load
 * @param timeout how long (in seconds) to cache the visualisation data
 * before it is considered out of date and should be refetched and recalculated.
 * Defaults to 60 seconds.
 * @return an associative array of arrays of nodes, connections and users from the data loaded from the CIF.
 * and converted to the structure required by the Sunburst visualisation.
 * The keys are 'nodes', 'cons' and 'users'.
 */
function getSunburstData($url, $timeout=60) {
	global $CFG, $HUB_CACHE;

	$withhistory=false;
	$withvotes=false;
	$withposts = false;

	$data = $HUB_CACHE->getObjData($CFG->VIS_PAGE_SUNBURST.$url.$withhistory.$withvotes.$withposts);
	if ($data === FALSE) {
		//error_log("DATA not FOUND: getSunburstData");

		$reader = $HUB_CACHE->getObjData('reader'.$url.$withhistory.$withvotes.$withposts);
		if ($reader === FALSE) {
			//error_log("READER not FOUND: getSunburstData");
			$reader = new catalyst_jsonld_reader();
			$reader = $reader->load($url,$timeout,$withhistory,$withvotes,$withposts);
			$HUB_CACHE->setObjData('reader'.$url.$withhistory.$withvotes.$withposts, $reader, $timeout);
		} else {
			//error_log("READER FOUND: getSunburstData");
		}

		//$reader = new catalyst_jsonld_reader();
		//$reader = $reader->load($url,$timeout,$withhistory,$withvotes,$withposts);

		$jsonnodes = array();
		$jsonusers = array();
		$jsoncons = array();
 		$data = array();

		if (!$reader instanceof Hub_Error) {

			$userHashtable = array();

			$userCheck = array();
			$usersToDebates = array();
			$nodeCheck = array();
			$totalnodes = 0;

			$issueCheck = array();
			$issueNodes = array();
			$issueConnections = array();
			$solutionNodes = array();

			$connections = $reader->connectionSet->connections;
			$count = 0;
			if (is_countable($connections)) {
				$count = count($connections);
			}

			$nodeSet = new NodeSet();

			// GET ISSUES
			for ($i=0; $i<$count; $i++) {
				$connection = $connections[$i];
				$from = $connection->from;
				$to = $connection->to;

				if ($from->rolename == "Issue") {
					if (!in_array($from->nodeid, $issueCheck)) {
						array_push($issueNodes, $from);
						$nodeSet->add($from);
						array_push($issueCheck, $from->nodeid);
					}
				}
				if ($to->rolename == "Issue") {
					if (!in_array($to->nodeid, $issueCheck)) {
						array_push($issueNodes, $to);
						$nodeSet->add($to);
						array_push($issueCheck, $to->nodeid);
					}
				}
			}

			// GET ISSUE TREES
			function loadMoreIssueChildNodes(&$connections, $nextArray, &$parentlist) {
				global $issueConnections;

				$countj = 0;
				if (is_countable($nextArray)) {
					$countj = count($nextArray);
				}
				for ($j=0; $j<$countj; $j++) {
					$nextid = $nextArray[$j];
					$newNextArray = array();

					foreach ($connections as $connection) {
						$from = $connection->from;
						$to = $connection->to;

						if ( ($to->nodeid == $nextid)
							|| ($from->nodeid == $nextid) ) {

							if ($from->nodeid == $nextid) {
								array_push($newNextArray, $to->nodeid);
							} else {
								array_push($newNextArray, $from->nodeid);
							}
							array_push($parentlist, $connection);
							if(($key = array_search($connection, $connections)) !== false) {
								unset($connections[$key]);
							}
						}
					}

					$countnew = 0;
					if (is_countable($newNextArray)) {
						$countnew = count($newNextArray);
					}
					$countcons = 0;
					if (is_countable($connections)) {
						$countcons = count($connections);
					}

					if ($countnew > 0 && $countcons > 0) {
						loadMoreIssueChildNodes($connections, $newNextArray, $parentlist);
					}
				}
			}

			set_time_limit(60);

			$nextArray = array();

			$countj = 0;
			if (is_countable($issueNodes)) {
				$countj = count($issueNodes);
			}
			for ($j=0; $j<$countj; $j++) {
				$next = $issueNodes[$j];
				$nextid = $next->nodeid;

				$list = array();
				foreach ($connections as $connection) {
					$from = $connection->from;
					$to = $connection->to;

					if ( ($to->nodeid == $nextid)
							|| ($from->nodeid == $nextid) ) {
						if ($from->nodeid == $nextid) {
							array_push($nextArray, $to->nodeid);
						} else {
							array_push($nextArray, $from->nodeid);
						}
						array_push($list, $connection);
						if(($key = array_search($connection, $connections)) !== false) {
							unset($connections[$key]);
						}
					}
				}

				$issueConnections[$nextid] = $list;
				loadMoreIssueChildNodes($connections, $nextArray, $issueConnections[$nextid]);
			}

			// COUNT TYPES FOR DETAILS PANEL
			$count = 0;
			if (is_countable($issueNodes)) {
				$count = count($issueNodes);
			}
			for ($i=0; $i<$count; $i++) {
				$node = $issueNodes[$i];
				if (isset($node->users[0])) {

					if (!array_key_exists($node->nodeid, $nodeCheck)) {
						$nodeCheck[$node->nodeid] = $node;
					}
					if (!array_key_exists($node->users[0]->userid, $userHashtable)) {
						$globaluser = clone $node->users[0];
						$globaluser->procount = 0;
						$globaluser->concount = 0;
						$globaluser->ideacount = 0;
						$globaluser->debatecount = 1;
						$userHashtable[$node->users[0]->userid] = $globaluser;
					} else {
						$globaluser = $userHashtable[$node->users[0]->userid];
						$globaluser->debatecount = $globaluser->debatecount+1;
						$userHashtable[$node->users[0]->userid] = $globaluser;
					}

					if (array_key_exists($node->nodeid, $issueConnections)) {
						$cons = $issueConnections[$node->nodeid];
						$countcons = 0;
						if (is_countable($cons)) {
							$countcons = count($cons);
						}
						$localusers = array();

						$debateowner = $node->users[0];
						$debateowner->procount = 0;
						$debateowner->concount = 0;
						$debateowner->ideacount = 0;
						$debateowner->debatecount = 1;
						$localusers[$node->users[0]->userid] = $debateowner;

						if (!array_key_exists($node->users[0]->userid, $userCheck)) {
							$userCheck[$node->users[0]->userid] = $node->users[0];
						}

						for ($j=0; $j<$countcons; $j++) {
							$con = $cons[$j];
							$fromNode = $con->from;

							if (!array_key_exists($fromNode->nodeid, $nodeCheck)) {
								$nodeCheck[$fromNode->nodeid] = $fromNode;
							}

							//$toNode = $con->to;
							$thisuser = clone $fromNode->users[0];

							if (!array_key_exists($thisuser->userid, $userCheck)) {
								$userCheck[$thisuser->userid] = $thisuser;
							}

							if (!array_key_exists($thisuser->userid, $userHashtable)) {
								$globaluser = clone $fromNode->users[0];
								$globaluser->procount = 0;
								$globaluser->concount = 0;
								$globaluser->ideacount = 0;
								$globaluser->debatecount = 0;
								if ($fromNode->role->name == 'Pro') $globaluser->procount = 1;
								if ($fromNode->role->name == 'Con') $globaluser->concount = 1;
								if ($fromNode->role->name == 'Solution') $globaluser->ideacount = 1;
								$userHashtable[$thisuser->userid] = $globaluser;
							} else {
								$globaluser = $userHashtable[$thisuser->userid];
								if ($fromNode->role->name == 'Pro') $globaluser->procount = $globaluser->procount+1;
								if ($fromNode->role->name == 'Con') $globaluser->concount = $globaluser->concount+1;
								if ($fromNode->role->name == 'Solution') $globaluser->ideacount = $globaluser->ideacount+1;
								$userHashtable[$thisuser->userid] = $globaluser;
							}

							if (!array_key_exists($thisuser->userid, $localusers)) {
								$thisuser->procount = 0;
								$thisuser->concount = 0;
								$thisuser->ideacount = 0;
								$thisuser->debatecount = 0;
								if ($fromNode->role->name == 'Pro') $thisuser->procount = 1;
								if ($fromNode->role->name == 'Con') $thisuser->concount = 1;
								if ($fromNode->role->name == 'Solution') $thisuser->ideacount = 1;
								$localusers[$thisuser->userid] = $thisuser;
							} else {
								$thisuser = $localusers[$thisuser->userid];
								if ($fromNode->role->name == 'Pro') $thisuser->procount = $thisuser->procount+1;
								if ($fromNode->role->name == 'Con') $thisuser->concount = $thisuser->concount+1;
								if ($fromNode->role->name == 'Solution') $thisuser->ideacount = $thisuser->ideacount+1;
								$localusers[$thisuser->userid] = $thisuser;
							}
						}
					}
					$usersToDebates[$node->nodeid] = $localusers;
				}
			}

			$conSet = new ConnectionSet();
			$count = 0;
			if (is_countable($usersToDebates)) {
				$count = count($usersToDebates);
			}

			//$userHashtable = $userCheck;

			foreach ($usersToDebates as $nodeid => $users) {
				//$from = $nodeCheck[$nodeid];

				foreach ($users as $userid => $user) {
					$to = $user;
					$connection = new Connection();

					$procount = $user->procount;
					$concount = $user->concount;
					$ideacount = $user->ideacount;
					$debatecount = $user->debatecount;

					$totalnodes = $totalnodes+($ideacount+$debatecount+$procount+$concount);

					$connection->procount = $procount;
					$connection->concount = $concount;
					$connection->ideacount = $ideacount;
					$connection->debatecount = $debatecount;
					$connection->toid = $userid;
					$connection->fromid = $nodeid;

					$graycount = $ideacount+$debatecount;

					if ($procount > $concount && $procount > $graycount) {
						$connection->linklabelname = $CFG->LINK_PRO_SOLUTION;
					} else if ($concount > $procount && $concount > $graycount) {
						$connection->linklabelname = $CFG->LINK_CON_SOLUTION;
					} else if ($procount == $graycount && $procount > $concount) {
						$connection->linklabelname = $CFG->LINK_PRO_SOLUTION;
					} else if ($concount == $graycount && $concount > $procount) {
						$connection->linklabelname = $CFG->LINK_CON_SOLUTION;
					} else {
						$connection->linklabelname = $CFG->LINK_SOLUTION_ISSUE;
					}

					$conSet->add($connection);
				}
			}

			$format_json = new format_json();

			$userset = new UserSet();
			foreach ($userHashtable as $userid => $user) {
				$userset->add($user);
			}

			$conSet->totalnodes = $totalnodes;

			$jsonnodes = $format_json->format($nodeSet);
			$jsonusers = $format_json->format($userset);
			$jsoncons = $format_json->format($conSet);
		}

		$data['nodes'] = $jsonnodes;
		$data['cons'] = $jsoncons;
		$data['users'] = $jsonusers;

		$HUB_CACHE->setObjData($CFG->VIS_PAGE_SUNBURST.$url.$withhistory.$withvotes.$withposts, $data, $timeout);
	} else {
		//error_log("DATA FOUND: getSunburstData");
	}

	return $data;
}

/**
 * Load the data for the Topic Space visulaisation
 * @param url the url for the CIF data to load
 * @param timeout how long (in seconds) to cache the visualisation data
 * before it is considered out of date and should be refetched and recalculated.
 * Defaults to 60 seconds.
 * @return an array of the data loaded from the CIF
 * and converted to the structure required by the Topic Space visualisation
 */
function getTopicSpaceData($url, $timeout=60) {
	global $CFG, $HUB_CACHE;

	$withhistory=false;
	$withvotes=false;
	$withposts = false;

	$data = $HUB_CACHE->getObjData($CFG->VIS_PAGE_TOPICSPACE.$url.$withhistory.$withvotes.$withposts);
	if ($data === FALSE) {
		//error_log("DATA not FOUND: getTopicSpaceData");

		$reader = $HUB_CACHE->getObjData('reader'.$url.$withhistory.$withvotes.$withposts);
		if ($reader === FALSE) {
			//error_log("READER not FOUND: getTopicSpaceData");
			$reader = new catalyst_jsonld_reader();
			$reader = $reader->load($url,$timeout,$withhistory,$withvotes,$withposts);
			$HUB_CACHE->setObjData('reader'.$url.$withhistory.$withvotes.$withposts, $reader, $timeout);
		} else {
			//error_log("READER FOUND: getTopicSpaceData");
		}

		//$reader = new catalyst_jsonld_reader();
		//$reader = $reader->load($url,$timeout,$withhistory,$withvotes,$withposts);

		$data = array();
		if (!$reader instanceof Hub_Error) {
			$nodes = $reader->nodeSet->nodes;
			$count = 0;
			if (is_countable($nodes)) {
				$count = count($nodes);
			}
			$nodeArray = array();
			for ($i=0; $i<$count; $i++) {
				$node = $nodes[$i];
				$nodeArray[$node->nodeid] = $node;
			}

			// GET METRICS
			$metric = 'interest_space_post_coordinates';
			$reply = "";
			if ($url == $CFG->homeAddress.'testing/designcommunity.json') {
				$reply = getCannedResults($CFG->homeAddress.'testing/designcommunityTopicSpace.json');
			} else {
				$reply = getMetrics($url, $metric);
			}

			// {warnings: [string,* ], responses: [ result,* ] }
			$replyObj = json_decode($reply);
			$results = $replyObj->responses;

			if (!isset($results[0]->error) && isset($results[0]->data)) {
				$topicspacedata = $results[0]->data;

				$groups = array();
				foreach($topicspacedata as $nodearray) {
					$nodeString = $nodearray[0];

					$nodeid = $nodearray[0];
					if (array_key_exists($nodeid, $nodeArray)) {
						$node = $nodeArray[$nodeid];
						$nodeString = $node->name;
						$role = $node->rolename;
						$homepage = "";
						if (isset($node->homepage) && $node->homepage != "") {
							$homepage = $node->homepage;
						}

						$next = array(
							"x" => jitterme($nodearray[1]),
							"y" => jitterme($nodearray[2]),
							"size" => 10,
							"shape" => "circle",
							"id" => $nodeid,
							"name" => $nodeString,
							"nodetype" => $role,
							"homepage" => $homepage
						);

						if (!array_key_exists($role, $groups)) {
							$groups[$role] = array();
						}

						array_push($groups[$role], (object)$next);
					}
				}

				foreach($groups as $key => $values) {
					$next = array(
						"key" => $key,
						"values" => $values
					);
					array_push($data, (object)$next);
				}
			}
		}

		$HUB_CACHE->setObjData($CFG->VIS_PAGE_TOPICSPACE.$url.$withhistory.$withvotes.$withposts, $data, $timeout);
	} else {
		//error_log("DATA FOUND: getTopicSpaceData");
	}

	return $data;
}

/**
 * Load the data for the Bias Space visulaisation
 * @param url the url for the CIF data to load
 * @param timeout how long (in seconds) to cache the visualisation data
 * before it is considered out of date and should be refetched and recalculated.
 * Defaults to 60 seconds.
 * @return an array of arrays of the data loaded from the CIF
 * converted to the structure required by the Bias Space visualisation.
 */
function getBiasSpaceData($url, $timeout=60) {
	global $CFG, $HUB_CACHE;

	$withhistory=false;
	$withvotes=false;
	$withposts = false;

	$data = $HUB_CACHE->getObjData($CFG->VIS_PAGE_BIASSPACE.$url.$withhistory.$withvotes.$withposts);
	if ($data === FALSE) {
		//error_log("DATA not FOUND: getBiasSpaceData");

		$reader = $HUB_CACHE->getObjData('reader'.$url.$withhistory.$withvotes.$withposts);
		if ($reader === FALSE) {
			//error_log("READER not FOUND: getBiasSpaceData");
			$reader = new catalyst_jsonld_reader();
			$reader = $reader->load($url,$timeout,$withhistory,$withvotes,$withposts);
			$HUB_CACHE->setObjData('reader'.$url.$withhistory.$withvotes.$withposts, $reader, $timeout);
		} else {
			//error_log("READER FOUND: getBiasSpaceData");
		}

		//$reader = new catalyst_jsonld_reader();
		//$reader = $reader->load($url,$timeout,$withhistory,$withvotes,$withposts);

		$data = array();
		if (!$reader instanceof Hub_Error) {
			$nodes = $reader->nodeSet->nodes;
			$count = 0;
			if (is_countable($nodes)) {
				$count = count($nodes);
			}
			$nodeArray = array();
			for ($i=0; $i<$count; $i++) {
				$node = $nodes[$i];
				$nodeArray[$node->nodeid] = $node;
			}

			// GET METRICS
			$metric = 'support_space_post_coordinates';
			$reply = "";
			if ($url == $CFG->homeAddress.'testing/designcommunity.json') {
				$reply = getCannedResults($CFG->homeAddress.'testing/designcommunityBiasSpace.json');
			} else {
				$reply = getMetrics($url, $metric);
			}

			// {warnings: [string,* ], responses: [ result,* ] }
			$replyObj = json_decode($reply);
			$results = $replyObj->responses;

			if (!isset($results[0]->error) && isset($results[0]->data)) {
				$biasspacedata = $results[0]->data;
				$groups = array();
				foreach($biasspacedata as $nodearray) {
					$nodeString = $nodearray[0];
					$nodeid = $nodearray[0];
					if (array_key_exists($nodeid, $nodeArray)) {
						$node = $nodeArray[$nodeid];
						$nodeString = $node->name;
						$role = $node->rolename;
						$homepage = "";
						if (isset($node->homepage) && $node->homepage != "") {
							$homepage = $node->homepage;
						}

						$next = array(
							"x" => jitterme($nodearray[1]),
							"y" => jitterme($nodearray[2]),
							"size" => 10,
							"shape" => "circle",
							"id" => $nodeid,
							"name" => $nodeString,
							"nodetype" => $role,
							"homepage" => $homepage
						);

						if (!array_key_exists($role, $groups)) {
							$groups[$role] = array();
						}

						array_push($groups[$role], (object)$next);
					}
				}

				foreach($groups as $key => $values) {
					$next = array(
						"key" => $key,
						"values" => $values
					);
					array_push($data, (object)$next);
				}
			}
		}

		$HUB_CACHE->setObjData($CFG->VIS_PAGE_BIASSPACE.$url.$withhistory.$withvotes.$withposts, $data, $timeout);
	} else {
		//error_log("DATA FOUND: getBiasSpaceData");
	}

	return $data;
}

/**
 * Load the data for the Activity Analysis visualisation
 * @param url the url for the CIF data to load
 * @param timeout how long (in seconds) to cache the visualisation data
 * before it is considered out of date and should be refetched and recalculated.
 * Defaults to 60 seconds.
 * @param withposts include post data in this visualisation
 * @return an array of arrays of the data loaded from the CIF
 * converted to the structure required by the Activity Analysis visualisation.
 */
function getActivityAnalysisData($url, $timeout=60, $withposts=false) {
	global $LNG, $HUB_CACHE, $CFG;

	$withhistory=true;
	$withvotes=true;

	$data = $HUB_CACHE->getObjData($CFG->VIS_PAGE_ACTIVITY.$url.$withhistory.$withvotes.$withposts);
	if ($data === FALSE) {
		//error_log("DATA not FOUND: getActivityAnalysisData");

		$reader = $HUB_CACHE->getObjData('reader'.$url.$withhistory.$withvotes.$withposts);
		if ($reader === FALSE) {
			//error_log("READER not FOUND: getActivityAnalysisData");
			$reader = new catalyst_jsonld_reader();
			$reader = $reader->load($url,$timeout,$withhistory,$withvotes,$withposts);
			$HUB_CACHE->setObjData('reader'.$url.$withhistory.$withvotes.$withposts, $reader, $timeout);
		} else {
			//error_log("READER FOUND: getActivityAnalysisData");
		}

		$data = array();
		if (!$reader instanceof Hub_Error) {
			$nodes = $reader->nodeSet->nodes;
			$count = 0;
			if (is_countable($nodes)) {
				$count = count($nodes);
			}
			for ($i=0; $i<$count; $i++) {
				if (isset($nodes[$i]->activity)) {
					foreach($nodes[$i]->activity as $activity) {
						$type = $activity["type"];
						if ($type == "Create") {
							$type = $LNG->STATS_ACTIVITY_CREATE;
						} else if ($type == "Update") {
							$type = $LNG->STATS_ACTIVITY_UPDATE;
						} else if ($type == "Delete") {
							$type = $LNG->STATS_ACTIVITY_DELETE;
						} else if ($type == "View") {
							$type = $LNG->STATS_ACTIVITY_VIEW;
							if (strpos($activity["userid"], "anonymous") !== FALSE) {
								continue;
							}
						}
						array_push($data, (object)array(
							"date" => $activity["modificationdate"],
							"type" => $type,
							"nodeid" => $nodes[$i]->nodeid,
							"title" => $nodes[$i]->name,
							"nodetype" => $nodes[$i]->rolename,
						));
					}
				}
			}
		}
		$HUB_CACHE->setObjData($CFG->VIS_PAGE_ACTIVITY.$url.$withhistory.$withvotes.$withposts, $data, $timeout);
	} else {
		//error_log("DATA FOUND: getActivityAnalysisData");
	}

	return $data;
}

/**
 * Load the data for the User Activity Analysis visulaisation
 * @param url the url for the CIF data to load
 * @param timeout how long (in seconds) to cache the visualisation data
 * before it is considered out of date and should be refetched and recalculated.
 * Defaults to 60 seconds.
 * @param withposts include post data in this visualisation
 * @return an array of arrays of the data loaded from the CIF
 * converted to the structure required by the User Activity Analysis visualisation.
 */
function getUserActivityAnalysisData($url, $timeout=60, $withposts=false) {
	global $LNG, $HUB_CACHE, $CFG;

	$withhistory=true;
	$withvotes=true;

	$data = $HUB_CACHE->getObjData($CFG->VIS_PAGE_USER_ACTIVITY.$url.$withhistory.$withvotes.$withposts);
	if ($data === FALSE) {
		//error_log("DATA not FOUND: getUserActivityAnalysisData");
		$reader = $HUB_CACHE->getObjData('reader'.$url.$withhistory.$withvotes.$withposts);
		if ($reader === FALSE) {
			//error_log("READER not FOUND: getUserActivityAnalysisData");
			$reader = new catalyst_jsonld_reader();
			$reader = $reader->load($url,$timeout,$withhistory,$withvotes,$withposts);
			$HUB_CACHE->setObjData('reader'.$url.$withhistory.$withvotes.$withposts, $reader, $timeout);
		} else {
			//error_log("READER FOUND: getUserActivityAnalysisData");
		}

		//$reader = new catalyst_jsonld_reader();
		//$reader = $reader->load($url,$timeout,$withhistory,$withvotes,$withposts);

		$data = array();
		if (!$reader instanceof Hub_Error) {
			$nodeSet = $reader->nodeSet;
			$nodes = $nodeSet->nodes;
			$count = 0;
			if (is_countable($nodes)) {
				$count = count($nodes);
			}
			$userArray = $reader->userArray;

			$usersCheck = array();
			$users = array();

			for ($i=0; $i<$count; $i++) {
				$node = $nodes[$i];
				if (isset($node->activity)) {
					foreach($node->activity as $activity) {
						$type = $activity["type"];
						$activityuser = $userArray[$activity["userid"]];
						//error_log(print_r($activityuser, true));
						if ($type == "Create") {
							$type = $LNG->STATS_ACTIVITY_CREATE;

							$userid = "";
							if (isset($activityuser->profileid)) {
								//error_log("profileid".$activityuser->profileid);
								$userid = $activityuser->profileid;
							} else {
								//error_log("userid".$activityuser->userid);
								$userid = $activityuser->userid;
							}
							//error_log($userid);

							$username = "";
							if (!in_array($userid, $usersCheck)) {
								array_push($usersCheck, $userid);

								$username = $LNG->STATS_ACTIVITY_USER_ANONYMOUS.(count($usersCheck));
								if ($activityuser->name != $activityuser->userid && $activityuser->name != "") {
									$username = $activityuser->name;
								}
								$users[$userid] = $username;
							} else {
								$username = $users[$userid];
							}

							$nexttopic = array(
								"date" => $activity["modificationdate"],
								"userid" => $userid,
								"username" => $username,
								"nodeid" => $node->nodeid,
								"title" => $node->name,
								"nodetype" => $node->rolename,
							);
							array_push($data, (object)$nexttopic);
						}
					}
				}

				if (isset($node->votes)) {
					foreach($node->votes as $activity) {
						$type = $activity["type"];
						//$positive = $activity->positive;
						//if ($type == "Vote") {
						//	$role = $LNG->STATS_ACTIVITY_VOTE;
						//	//if ($positive == "Y") {
						//	//	$role = $LNG->STATS_ACTIVITY_VOTED_FOR;
						//	//} else {
						//	//	$role = $LNG->STATS_ACTIVITY_VOTED_AGAINST;
						//	//}
						//}

						$activityuser = $userArray[$activity["userid"]];
						//error_log(print_r($activityuser, true));
						if (isset($activityuser->profileid)) {
							//error_log("profileid".$activityuser->profileid);
							$userid = $activityuser->profileid;
						} else {
							//error_log("userid".$activityuser->userid);
							$userid = $activityuser->userid;
						}
						//error_log($userid);

						$username = "";
						if (!in_array($userid, $usersCheck)) {
							array_push($usersCheck, $userid);

							$username = $LNG->STATS_ACTIVITY_USER_ANONYMOUS.(count($usersCheck));
							if ($activityuser->name != $activityuser->userid && $activityuser->name != "") {
								$username = $activityuser->name;
							}
							$users[$userid] = $username;
						} else {
							$username = $users[$userid];
						}

						$nexttopic = array(
							"date" => $activity["modificationdate"],
							"userid" => $userid,
							"username" => $username,
							"nodeid" => $node->nodeid,
							"title" => $node->name,
							"nodetype" => $LNG->STATS_ACTIVITY_VOTE,
						);
						array_push($data, (object)$nexttopic);
					}
				}
			}
		}

		$HUB_CACHE->setObjData($CFG->VIS_PAGE_USER_ACTIVITY.$url.$withhistory.$withvotes.$withposts, $data, $timeout);
	} else {
		//error_log("DATA FOUND: getUserActivityAnalysisData");
	}

	return $data;
}

/**
 * Load the data for the Conversation Network with community interest metrics.
 * @param url the url for the CIF data to load
 * @param timeout how long (in seconds) to cache the visualisation data
 * before it is considered out of date and should be refetched and recalculated.
 * Defaults to 60 seconds.
 * @param withposts include post data in this visualisation
 * @return a json string of the data loaded from the CIF
 * and converted to the json required by the Circle packing visualisation
 */
function getInterestNetworkData($url, $timeout=60,$withposts=false) {
	global $CFG,$LNG,$HUB_CACHE;

	$withhistory=false;
	$withvotes=false;

	$conSet = $HUB_CACHE->getObjData($CFG->VIS_PAGE_INTEREST_NETWORK.$url.$withhistory.$withvotes.$withposts);
	if ($conSet === FALSE) {
		//error_log("DATA not FOUND: getNetworkAttentionData");
		$reader = $HUB_CACHE->getObjData('reader'.$url.$withhistory.$withvotes.$withposts);
		if ($reader === FALSE) {
			//error_log("READER not FOUND: getNetworkAttentionData");
			$reader = new catalyst_jsonld_reader();
			$reader = $reader->load($url,$timeout,$withhistory,$withvotes,$withposts);
			$HUB_CACHE->setObjData('reader'.$url.$withhistory.$withvotes.$withposts, $reader, $timeout);
		} else {
			//error_log("READER FOUND: getNetworkAttentionData");
		}

		$json = "";
		if (!$reader instanceof Hub_Error) {
			$metricarray = array();
			$biggestsize = 0;

			// GET METRICS
			$metric = 'interest_by_community';
			$reply = getMetrics($url, $metric, $timeout);
			//error_log(print_r($reply, true));

			// {warnings: [string,* ], responses: [ result,* ] }
			$replyObj = json_decode($reply);
			$results = $replyObj->responses;

			if (!isset($results[0]->error)	&& isset($results[0]->data)) {
				$interestmetricdata = $results[0]->data;;
				if ($interestmetricdata != "") {
					foreach($interestmetricdata as $nodeid => $value) {
						//error_log($nodeid.":".$value);
						if (!array_key_exists($nodeid, $metricarray) && $nodeid != 'null') {
							if ($value > intval($biggestsize)) {
								$biggestsize = $value;
							}
							$metricarray[$nodeid] = $value;
						}
					}
				}
			}

			$conSet = $reader->connectionSet;
			$conSet->biggest = $biggestsize;
			$cons = $conSet->connections;
			$countcons = 0;
			if (is_countable($cons)) {
				$countcons = count($cons);
			}

			for ($i=0; $i<$countcons; $i++) {
				$con = $cons[$i];
				$from = $con->from;
				$to = $con->to;

				if (isset($metricarray[$to->nodeid])) {
					$to->metric = $metricarray[$to->nodeid];
				} else {
					$to->metric = 0;
				}
				if (isset($metricarray[$from->nodeid])) {
					$from->metric = $metricarray[$from->nodeid];
				} else {
					$from->metric = 0;
				}
			}
		}

		$HUB_CACHE->setObjData($CFG->VIS_PAGE_INTEREST_NETWORK.$url.$withhistory.$withvotes.$withposts, $conSet, $timeout);
	} else {
		//error_log("DATA FOUND: getNetworkAttentionData");
	}

	return $conSet;
}

/**
 * Load the data for the Conversation Network with sub-communities metrics.
 * @param url the url for the CIF data to load
 * @param timeout how long (in seconds) to cache the visualisation data
 * before it is considered out of date and should be refetched and recalculated.
 * Defaults to 60 seconds.
 * @param withposts include post data in this visualisation
 * @return a json string of the data loaded from the CIF
 * and converted to the json required by the Circle packing visualisation
 */
function getCommunitiesNetworkData($url, $timeout=60,$withposts=false) {
	global $CFG,$LNG,$HUB_CACHE;

	$withhistory=false;
	$withvotes=false;

	$conSet = $HUB_CACHE->getObjData($CFG->VIS_PAGE_COMMUNITIES_NETWORK.$url.$withhistory.$withvotes.$withposts);
	if ($conSet === FALSE) {
		//error_log("DATA not FOUND: getCommunitiesNetworkData");
		$reader = $HUB_CACHE->getObjData('reader'.$url.$withhistory.$withvotes.$withposts);
		if ($reader === FALSE) {
			//error_log("READER not FOUND: getCommunitiesNetworkData");
			$reader = new catalyst_jsonld_reader();
			$reader = $reader->load($url,$timeout,$withhistory,$withvotes,$withposts);
			$HUB_CACHE->setObjData('reader'.$url.$withhistory.$withvotes.$withposts, $reader, $timeout);
		} else {
			//error_log("READER FOUND: getCommunitiesNetworkData");
		}

		$json = "";
		if (!$reader instanceof Hub_Error) {
			$metricarray = array();

			// GET METRICS
			$metric = 'interest_space_post_clusters';
			$reply = getMetrics($url, $metric, $timeout);
			//error_log(print_r($replyObj, true));

			// {warnings: [string,* ], responses: [ result,* ] }
			$replyObj = json_decode($reply);
			$results = $replyObj->responses;

			$communitycount = 0;

			if (!isset($results[0]->error)	&& isset($results[0]->data)) {
				$metricdata = $results[0]->data;
				$count = 0;
				if (is_countable($metricdata)) {
					$count = count($metricdata);
				}
				$communitycount = $count;
				for ($i=0; $i<$count; $i++) {
					$nextcommunity = $metricdata[$i];

					$countj = 0;
					if (is_countable($nextcommunity)) {
						$countj = count($nextcommunity);
					}
					for ($j=0; $j<$countj; $j++) {
						$nodeid = $nextcommunity[$j];
						if (!array_key_exists($nodeid, $metricarray) && $nodeid != 'null') {
							$metricarray[$nodeid] = $i+1;
						}
					}
				}
			}

			//error_log("biggest = ".$biggestsize);

			$conSet = $reader->connectionSet;
			$conSet->communitycount = $communitycount;
			$cons = $conSet->connections;
			$countcons = 0;
			if (is_countable($cons)) {
				$countcons = count($cons);
			}

			for ($i=0; $i<$countcons; $i++) {
				$con = $cons[$i];
				$from = $con->from;
				$to = $con->to;

				if (isset($metricarray[$to->nodeid])) {
					$to->community = $metricarray[$to->nodeid];
				} else {
					$to->community = 0;
				}
				if (isset($metricarray[$from->nodeid])) {
					$from->community = $metricarray[$from->nodeid];
				} else {
					$from->community = 0;
				}
			}
		}

		$HUB_CACHE->setObjData($CFG->VIS_PAGE_COMMUNITIES_NETWORK.$url.$withhistory.$withvotes.$withposts, $conSet, $timeout);
	} else {
		//error_log("DATA FOUND: getCommunitiesNetworkData");
	}

	return $conSet;
}

/***************** MINI VISUALISATIONS *******************/

/**
 * Load the data for the User Contributions mini visualisation
 * @param url the url for the CIF data to load
 * @param timeout how long (in seconds) to cache the visualisation data
 * before it is considered out of date and should be refetched and recalculated.
 * Defaults to 60 seconds.
 * @param withvotes include vote data in this visualisation
 * @param withposts include post data in this visualisation
 * @return userContributions object containing 	totalvotes, contributorcount and contributiontypes (array of <node type/votes name>:<count>);
 */
function getMiniUserContributions($url, $timeout=60, $withvotes=false, $withposts=false) {
	global $LNG, $HUB_CACHE, $CFG;

	$withhistory=false;
	class userContributions {}

	$data = $HUB_CACHE->getObjData($CFG->MINI_PAGE_USER_CONTRIBUTIONS.$url.$withhistory.$withvotes.$withposts);
	if ($data === FALSE) {
		//error_log("DATA not FOUND: getMiniUserContributions");

		$data = new userContributions();

		$contributorCount = 0;
		$totalvotes = 0;
		$contributionTypes = array();
		$uniqueContributorsArray = array();

		$reader = getCatalystReader($url,$withhistory,$withvotes,$withposts);
		if ($reader === FALSE) {
			//error_log("READER not FOUND: getMiniUserContributions");
			$reader = new catalyst_jsonld_reader();
			$reader = $reader->load($url,$timeout,$withhistory,$withvotes,$withposts);
			$HUB_CACHE->setObjData('reader'.$url.$withhistory.$withvotes.$withposts, $reader, $timeout);
		} else {
			//error_log("READER FOUND: getMiniUserContributions");
		}

		if (!$reader instanceof Hub_Error) {
			$nodeSet = $reader->nodeSet;
			$nodes = $nodeSet->nodes;
			$count = 0;
			if (is_countable($nodes)) {
				$count = count($nodes);
			}

			for ($i=0; $i<$count; $i++) {
				$node = $nodes[$i];
				$userid = $node->userid;

				if (array_key_exists($node->rolename,$contributionTypes)) {
					$contributionTypes[$node->rolename] = $contributionTypes[$node->rolename]+1;
				} else {
					$contributionTypes[$node->rolename] = 1;
				}

				if (in_array($userid, $uniqueContributorsArray) === FALSE){
					$contributorCount++;
					array_push($uniqueContributorsArray, $userid);
				}

				if ($withvotes) {
					if (isset($node->votes)) {
						foreach($node->votes as $activity) {

							// Node Voters aer not the same as the node adders
							$activityuser = $activity["userid"];
							if (in_array($activityuser, $uniqueContributorsArray) === FALSE){
								$contributorCount++;
								array_push($uniqueContributorsArray, $activityuser);
							}
							$totalvotes++;
						}
					}
				}
			}
		}

		global $sortorder;
		$sortorder = array("Issue"=>0, "Solution"=>1, "Idea"=>2, "Pro"=>3, "Con"=>4, "Comment"=>5);
		function sortbytype($key1, $key2) {
			global $sortorder;
			if (array_key_exists($key1, $sortorder) && array_key_exists($key2, $sortorder)) {
				if ($sortorder[$key1] == $sortorder[$key2]) {
				    return 0;
				}
    			return ($sortorder[$key1] < $sortorder[$key2]) ? -1 : 1;
			} else {
				if (array_key_exists($key1, $sortorder) && array_key_exists($key2, $sortorder)) {
					return 0;
				}
    			if (array_key_exists($key1, $sortorder) && !array_key_exists($key2, $sortorder)) {
    				return -1;
    			} else {
    				return 1;
    			}
			}
		}
		uksort($contributionTypes, "sortbytype");

		$data->totalvotes = $totalvotes;
		$data->contributorcount = $contributorCount;
		$data->contributiontypes = $contributionTypes;

		$HUB_CACHE->setObjData($CFG->MINI_PAGE_USER_CONTRIBUTIONS.$url.$withhistory.$withvotes.$withposts, $data, $timeout);
	} else {
		//error_log("DATA FOUND: getMiniUserContributions");
	}

	return $data;
}

/**
 * Load the data for the User veiwing mini visulaisation
 * @param url the url for the CIF data to load
 * @param timeout how long (in seconds) to cache the visualisation data
 * before it is considered out of date and should be refetched and recalculated.
 * Defaults to 60 seconds.
 * @param withposts include post data in this visualisation
 * @return userViewings object containing viewdatearray(array of <timestamp>:<count>);
 */
function getMiniUserViewings($url, $timeout=60, $withposts=false) {
	global $LNG, $HUB_CACHE, $CFG;

	$withhistory = true;
	$withvotes = false;

	class userViewings {}

	$data = $HUB_CACHE->getObjData($CFG->MINI_PAGE_USER_VIEWING.$url.$withhistory.$withvotes.$withposts);
	if ($data === FALSE) {
		//error_log("DATA not FOUND: getMiniUserViewings");

		$reader = getCatalystReader($url,$withhistory,$withvotes,$withposts);
		if ($reader === FALSE) {
			//error_log("READER not FOUND: getMiniUserViewings");
			$reader = new catalyst_jsonld_reader();
			$reader = $reader->load($url,$timeout,$withhistory,$withvotes,$withposts);
			$HUB_CACHE->setObjData('reader'.$url.$withhistory.$withvotes.$withposts, $reader, $timeout);
		} else {
			//error_log("READER FOUND: getMiniUserViewings");
		}

		$allViews = array();
		if (!$reader instanceof Hub_Error) {
			$nodeSet = $reader->nodeSet;
			$nodes = $nodeSet->nodes;
			$count = 0;
			if (is_countable($nodes)) {
				$count = count($nodes);
			}

			for ($i=0; $i<$count; $i++) {
				$node = $nodes[$i];
				if (isset($node->activity)) {
					foreach($node->activity as $activity) {
						$type = $activity["type"];
						if ($type == "View") {
							array_push($allViews, $activity);
						}
					}
				}
			}
		}

		$viewDateArray = array();

		$count = 0;
		if (is_countable($allViews)) {
			$count = count($allViews);
		}
		for ($i=0; $i<$count; $i++) {
			$nextview = $allViews[$i];
			if (isset($nextview)) {
				if (isset($nextview['modificationdate'])) {
					$mod = $nextview['modificationdate'];
					$date = date($mod);

					$day = date("d",$date);
					$month = date("m",$date);
					$year = date("Y",$date);

					$newdate = DateTime::createFromFormat('d-m-Y', $day.'-'.$month.'-'.$year);

					$time = $newdate->getTimestamp();
					if (array_key_exists($time, $viewDateArray)) {
						$viewDateArray[$time] = $viewDateArray[$time]+1;
					} else {
						$viewDateArray[$time] = 1;
					}
				}
			}
		}

		$data = new userViewings();
		$data->viewdatearray = $viewDateArray;

		$HUB_CACHE->setObjData($CFG->MINI_PAGE_USER_VIEWING.$url.$withhistory.$withvotes.$withposts, $data, $timeout);
	} else {
		//error_log("DATA FOUND: getMiniUserViewings");
	}

	return $data;
}

/**
 * Load the data for the Health participation mini visulaisation
 * @param url the url for the CIF data to load
 * @param timeout how long (in seconds) to cache the visualisation data
 * before it is considered out of date and should be refetched and recalculated.
 * Defaults to 60 seconds.
 * @param withposts include post data in this visualisation
 * @return healthParticipation object containing viewdatearray(array of <timestamp>:<count>);
 */
function getMiniHealthParticipation($url, $timeout=60, $withposts=false) {
	global $LNG, $HUB_CACHE, $CFG;

	$withhistory = false;
	$withvotes=false;

	class healthParticipation {}

	$data = $HUB_CACHE->getObjData($CFG->MINI_PAGE_HEALTH_PARTICIPATION.$url.$withhistory.$withvotes.$withposts);
	if ($data === FALSE) {
		//error_log("DATA not FOUND: getMiniHealthParticipation");

		$reader = getCatalystReader($url,$withhistory,$withvotes,$withposts);
		if ($reader === FALSE) {
			//error_log("READER not FOUND: getMiniHealthParticipation");
			$reader = new catalyst_jsonld_reader();
			$reader = $reader->load($url,$timeout,$withhistory,$withvotes,$withposts);
			$HUB_CACHE->setObjData('reader'.$url.$withhistory.$withvotes.$withposts, $reader, $timeout);
		} else {
			//error_log("READER FOUND: getMiniHealthParticipation");
		}

		if (!$reader instanceof Hub_Error) {
			$consSet = $reader->connectionSet;
			$cons = $consSet->connections;
			$count = 0;
			if (is_countable($cons)) {
				$count = count($cons);
			}
			$userCheck = array();

			for ($i=0; $i<$count;$i++) {
				$next = $cons[$i];
				$from = $next->from;
				$to = $next->to;

				if (!in_array($from->users[0]->userid, $userCheck)) {
					array_push($userCheck, $from->users[0]->userid);
				}
				if (!in_array($to->users[0]->userid, $userCheck)) {
					array_push($userCheck, $to->users[0]->userid);
				}
				if (isset($next->userid)) {
					if (!in_array($next->userid, $userCheck)) {
						array_push($userCheck, $next->users[0]->userid);
					}
				}
			}

			$data=new healthParticipation();
			$data->peoplecount = 0;
			if (is_countable($userCheck)) {
				$data->peoplecount = count($userCheck);
			}

			$HUB_CACHE->setObjData($CFG->MINI_PAGE_HEALTH_PARTICIPATION.$url.$withhistory.$withvotes.$withposts, $data, $timeout);
		} else {
			$data=new healthParticipation();
			// error_log("READER ERROR: getMiniHealthParticipation");
		}
	} else {
		//error_log("DATA FOUND: getMiniHealthParticipation");
	}

	return $data;
}

/**
 * Load the data for the Health viewing mini visualisation
 * @param url the url for the CIF data to load
 * @param timeout how long (in seconds) to cache the visualisation data
 * before it is considered out of date and should be refetched and recalculated.
 * Defaults to 60 seconds.
 * @param withposts include post data in this visualisation
 * @return healthViewing object containing organcecount, peopleorangecount, greencount, peoplegreencount;
 */
function getMiniHealthViewing($url, $timeout=60, $withposts=false) {
	global $LNG, $HUB_CACHE, $CFG;

	$withhistory = true;
	$withvotes = false;

	class healthViewing {}

	$data = $HUB_CACHE->getObjData($CFG->MINI_PAGE_HEALTH_VIEWING.$url.$withhistory.$withvotes.$withposts);
	if ($data === FALSE) {
		//error_log("DATA not FOUND: getMiniHealthViewing");

		$reader = getCatalystReader($url,$withhistory,$withvotes,$withposts);
		if ($reader === FALSE) {
			//error_log("READER not FOUND: getMiniUserViewings");
			$reader = new catalyst_jsonld_reader();
			$reader = $reader->load($url,$timeout,$withhistory,$withvotes,$withposts);
			$HUB_CACHE->setObjData('reader'.$url.$withhistory.$withvotes.$withposts, $reader, $timeout);
		} else {
			//error_log("READER FOUND: getMiniUserViewings");
		}

		if (!$reader instanceof Hub_Error) {
			$nodeSet = $reader->nodeSet;
			$nodes = $nodeSet->nodes;
			$count = 0;
			if (is_countable($nodes)) {
				$count = count($nodes);
			}

			$allViews = array();

			for ($i=0; $i<$count; $i++) {
				$node = $nodes[$i];
				if (isset($node->activity)) {
					foreach($node->activity as $activity) {
						$type = $activity["type"];
						if ($type == "View") {
							array_push($allViews, $activity);
						}
					}
				}
			}

			$peoplegreencount = 0;
			$peopleorangecount = 0;
			$peopleGreenCheck = array();
			$peopleOrangeCheck = array();
			$orangecount = 0;
			$greencount = 0;
			$peoplecount = 0;

			$timeTwoWeeksAgo = strtotime("-2 week");
			$timeFiveDaysAgo = strtotime("-5 day");

			$countviews = 0;
			if (is_countable($allViews)) {
				$countviews = count($allViews);
			}
			for ($i=0; $i<$countviews; $i++) {
				$nextview = $allViews[$i];
				if (isset($nextview)) {
					if (isset($nextview->modificationdate)) {
						$nextdate = intval($nextview->modificationdate);
						if ($nextdate >= $timeTwoWeeksAgo) {
							if ($nextdate < $timeFiveDaysAgo) {
								if (in_array($nextview->userid, $peopleOrangeCheck) === FALSE) {
									$peopleorangecount++;
									array_push($peopleOrangeCheck, $nextview->userid);
								}
								$orangecount++;
							} else if ($nextdate >= timeFiveDaysAgo) {
								if (in_array($nextview->userid, $peopleGreenCheck) === FALSE) {
									$peoplegreencount++;
									array_push($peopleGreenCheck, $nextview->userid);
								}
								$greencount++;
							}
						}
					}
				}
			}

			$data = new healthViewing();
			$data->peoplegreencount = $peoplegreencount;
			$data->peopleorangecount = $peopleorangecount;
			$data->orangecount = $orangecount;
			$data->greencount = $greencount;

			$HUB_CACHE->setObjData($CFG->MINI_PAGE_HEALTH_VIEWING.$url.$withhistory.$withvotes.$withposts, $data, $timeout);
		} else {
			$data = new healthViewing();
		}
	} else {
		//error_log("DATA FOUND: getMiniHealthViewing");
	}

	return $data;
}

/**
 * Load the data for the Health contribution mini visulaisation
 * @param url the url for the CIF data to load
 * @param timeout how long (in seconds) to cache the visualisation data
 * before it is considered out of date and should be refetched and recalculated.
 * Defaults to 60 seconds.
 * @param withvotes include vote data in this visualisation
 * @param withposts include post data in this visualisation
 * @return healthParticipation object containing viewdatearray(array of <timestamp>:<count>);
 */
function getMiniHealthContribution($url, $timeout=60, $withvotes=false, $withposts=false) {
	global $LNG, $HUB_CACHE, $CFG;

	$withhistory = false;

	class healthContribution {}

	$data = $HUB_CACHE->getObjData($CFG->MINI_PAGE_HEALTH_CONTRIBUTION.$url.$withhistory.$withvotes.$withposts);
	if ($data === FALSE) {
		//error_log("DATA not FOUND: getMiniHealthContribution");

		$reader = getCatalystReader($url,$withhistory,$withvotes,$withposts);
		if ($reader === FALSE) {
			//error_log("READER not FOUND: getMiniHealthContribution");
			$reader = new catalyst_jsonld_reader();
			$reader = $reader->load($url,$timeout,$withhistory,$withvotes,$withposts);
			$HUB_CACHE->setObjData('reader'.$url.$withhistory.$withvotes.$withposts, $reader, $timeout);
		} else {
			//error_log("READER FOUND: getMiniHealthContribution");
		}

		if (!$reader instanceof Hub_Error) {

			$nodeSet = $reader->nodeSet;
			$nodes = $nodeSet->nodes;

			$peoplegreencount = 0;
			$peopleorangecount = 0;
			$peopleGreenCheck = array();
			$peopleOrangeCheck = array();
			$orangecount = 0;
			$greencount = 0;
			$peoplecount = 0;

			$timeTwoWeeksAgo = strtotime("-2 week");
			$timeFiveDaysAgo = strtotime("-5 day");

			$count = 0;
			if (is_countable($nodes)) {
				$count = count($nodes);
			}
			for ($i=0; $i<$count; $i++) {
				$next = $nodes[$i];
				if (isset($next)) {
					if (isset($next->creationdate)) {
						$nextdate = intval($next->creationdate);
						if ($nextdate >= $timeTwoWeeksAgo) {
							if ($nextdate < $timeFiveDaysAgo) {
								if (in_array($next->users[0]->userid, $peopleOrangeCheck) === FALSE) {
									$peopleorangecount++;
									array_push($peopleOrangeCheck, $next->users[0]->userid);
								}
								$orangecount++;
							} else if ($nextdate >= $timeFiveDaysAgo) {
								if (in_array($next->users[0]->userid, $peopleGreenCheck) === FALSE) {
									$peoplegreencount++;
									array_push($peopleGreenCheck, $next->users[0]->userid);
								}
								$greencount++;
							}
						}
					}
				}
			}

			$data = new healthContribution();
			$data->peoplegreencount = $peoplegreencount;
			$data->peopleorangecount = $peopleorangecount;
			$data->orangecount = $orangecount;
			$data->greencount = $greencount;

			$HUB_CACHE->setObjData($CFG->MINI_PAGE_HEALTH_CONTRIBUTION.$url.$withhistory.$withvotes.$withposts, $data, $timeout);
		} else {
			$data = new healthContribution();
		}
	} else {
		//error_log("DATA FOUND: getMiniHealthContribution");
	}

	return $data;
}


/**
 * Load the data for the word stats mini visulaisation
 * @param url the url for the CIF data to load
 * @param timeout how long (in seconds) to cache the visualisation data
 * before it is considered out of date and should be refetched and recalculated.
 * Defaults to 60 seconds.
 * @param withposts include post data in this visualisation
 * @return wordStats object containing viewdatearray(array of <timestamp>:<count>);
 */
function getMiniWordStats($url, $timeout=60, $withposts=false) {
	global $LNG, $HUB_CACHE, $CFG;

	$withhistory = false;
	$withvotes = false;

	class wordStats {}

	$data = $HUB_CACHE->getObjData($CFG->MINI_PAGE_WORD_STATS.$url.$withhistory.$withvotes.$withposts);
	if ($data === FALSE) {
		//error_log("DATA not FOUND: getMiniWordStats");

		$reader = getCatalystReader($url,$withhistory,$withvotes,$withposts);
		if ($reader === FALSE) {
			//error_log("READER not FOUND: getMiniWordStats");
			$reader = new catalyst_jsonld_reader();
			$reader = $reader->load($url,$timeout,$withhistory,$withvotes,$withposts);
			$HUB_CACHE->setObjData('reader'.$url.$withhistory.$withvotes.$withposts, $reader, $timeout);
		} else {
			//error_log("READER FOUND: getMiniWordStats");
		}

		$allViews = array();
		if (!$reader instanceof Hub_Error) {
			$nodeSet = $reader->nodeSet;
			$nodes = $nodeSet->nodes;
			$count = 0;
			if (is_countable($nodes)) {
				$count = count($nodes);
			}

			$minWordCount = 0;
			$maxWordCount = 0;
			$totalWordCount = 0;
			$contributorCount = 0;

			$wordsByUser = array();
			$usersCheck = array();
			$users = array();

			$countUsers = 1;

			for ($i=0; $i<$count; $i++) {
				$node = $nodes[$i];

				$nameCount = intval(embedCountWords($node->name));
				$descCount = intval(embedCountWords($node->description));

				$userid = $node->userid;
				if (!in_array($userid, $usersCheck)) {
					$users[$userid] = $LNG->STATS_ACTIVITY_USER_ANONYMOUS.$countUsers;
					array_push($usersCheck, $userid);
					$userid = $users[$userid];
					$countUsers++;
				} else {
					$userid = $users[$userid];
				}

				$nextWordCount = $descCount+$nameCount;
				if ($nextWordCount>$maxWordCount) {
					$maxWordCount = $nextWordCount;
				}
				if ($minWordCount == 0 || $nextWordCount < $minWordCount) {
					$minWordCount = $nextWordCount;
				}
				$totalWordCount = $totalWordCount+$nextWordCount;

				if (array_key_exists($userid, $wordsByUser)) {
					$innercount = $wordsByUser[$userid];
					$innercount = $innercount+$descCount+$nameCount;
					$wordsByUser[$userid] = $innercount;
				} else {
					$contributorCount++;
					$innercount = $descCount+$nameCount;
					$wordsByUser[$userid] = $innercount;
				}
			}
		}

		arsort($wordsByUser);

		$data = new wordStats();
		$data->minWordCount = $minWordCount;
		$data->maxWordCount = $maxWordCount;
		$data->totalWordCount = $totalWordCount;
		$data->contributorCount = $contributorCount;
		$data->wordsByUser = $wordsByUser;

		$HUB_CACHE->setObjData($CFG->MINI_PAGE_WORD_STATS.$url.$withhistory.$withvotes.$withposts, $data, $timeout);
	} else {
		//error_log("DATA FOUND: getMiniWordStats");
	}

	return $data;
}

function embedCountWords($str){
    $str = trim($str);

    $patterns = array();
	$patterns[0] = '/[ ]{2,}/i';
	$patterns[1] = '/\n /';

    $replacements = array();
	$replacements[2] = ' ';
	$replacements[1] = '\n';

	$str = preg_replace($patterns, $replacements, $str);

	if (strlen($str) == 0) {
		return 0;
	}

    $results = explode(' ', $str);
    if ($results === FALSE) {
    	return 0;
    } else {
		$count = 0;
		if (is_countable($results)) {
			$count = count($results);
		}
    	return $count;
    }
}

/**
 * Load the data for the Topic Space visulaisation
 * @param url the url for the CIF data to load
 * @param alerttypes a comma separated list of the alerttypes to get data for
 * @param timeout how long (in seconds) to cache the visualisation data
 * before it is considered out of date and should be refetched and recalculated.
 * Defaults to 60 seconds.
 * @param userids (optional) a comma separated list of userids to get alert data for
 * @param root (optional) a nodeid for the root node of a data tree to process.
 * @return class alertdata with properties 'alertarray', 'userarray', 'nodearray'.
 *
 */
function getAlertsData($url, $alerttypes, $timeout=60,$userids="",$root="") {
	global $CFG, $HUB_CACHE;

	$withhistory=true;
	$withvotes=true;
	$withposts = true;

	class alertdata {}

	$data = $HUB_CACHE->getObjData($CFG->MINI_PAGE_ALERTS.$url.$alerttypes.$userids);
	if ($data === FALSE) {
		//error_log("DATA not FOUND: getAlertsData");

		$reader = $HUB_CACHE->getObjData('reader'.$url.$alerttypes.$userids);
		if ($reader === FALSE) {
			//error_log("READER not FOUND: getAlertsData");
			$reader = new catalyst_jsonld_reader();
			$reader = $reader->load($url,$timeout,$withhistory,$withvotes,$withposts);
			$HUB_CACHE->setObjData('reader'.$url.$alerttypes, $reader, $timeout);
		} else {
			//error_log("READER FOUND: getAlertsData");
		}

		$data = array();
		if (!$reader instanceof Hub_Error) {
			$nodes = $reader->nodeSet->nodes;
			$count = 0;
			if (is_countable($nodes)) {
				$count = count($nodes);
			}
			$nodeArray = array();
			for ($i=0; $i<$count; $i++) {
				$node = $nodes[$i];
				$nodeArray[$node->nodeid] = $node;
			}
			$users = $reader->userSet->users;
			$count = 0;
			if (is_countable($users)) {
				$count = count($users);
			}
			$userArray = array();

			for ($i=0; $i<$count; $i++) {
				$user = $users[$i];
				if (isset($user->profileid) && $user->profileid != "") {
					$userArray[$user->profileid] = $user; // index on profile if it is there as that is what Mark sends back.
				} else {
					$userArray[$user->userid] = $user;
				}
			}

			// GET METRICS
			$reply = getAlertMetrics($url, $alerttypes, $timeout, $userids, $root);
			//error_log(print_r($reply, true));

			// {warnings: [string,* ], responses: [ result,* ] }
			$replyObj = json_decode($reply);

			if (isset($replyObj->responses)) {
				$results = $replyObj->responses;

				if (!isset($results[0]->error) && isset($results[0]->data)) {
					$replydata = $results[0]->data;

					//$useridlist = $results[0]->users;
					//$typeslist = $results[0]->types;
					/*
					userAlert =
					{
					  user:userID,
					  suggestions:[suggestion,*]
					}

					suggestion =
					{
					  @type:alertype,
					  targetType:user | post,
					  targetID:targetID,
					  arguments:{argName:argValue,*}
					}
					*/

					$alertArray = array(); //post by alert type
					$userAlertArray = array(); // post by user by alert type
					$finalNodeArray = new NodeSet();
					$finalUserArray = new UserSet();

					$count = 0;
					if (is_countable($replydata)) {
						$count = count($replydata);
					}
					for ($i=0; $i<$count; $i++) {
						$next = $replydata[$i];
						$userid = $next->userID;
						if ($userid != '*') {
							$user = $userArray[$userid];
							$finalUserArray->add($user);
						}
						$suggestionsArray = $next->suggestions;

						$countj = 0;
						if (is_countable($suggestionsArray)) {
							$countj = count($suggestionsArray);
						}
						for ($j=0; $j<$countj; $j++) {
							$suggestion = $suggestionsArray[$j];

							//error_log(print_r($next, true));

							$alertype = $suggestion->{'@type'};
							$nextpost = $suggestion->targetID;

							//if (isset($suggestion->arguments)) {
							//	$argumentsArray = $suggestion->arguments;
							//}

							$targetType = $suggestion->targetType;
							if ($targetType == 'post' && isset($nodeArray[$nextpost])) {
								$nextObj = $nodeArray[$nextpost];
								$finalNodeArray->add($nextObj);
							} else if ($targetType == 'user' && isset($userArray[$nextpost])){
								$nextObj = $userArray[$nextpost];
								$finalUserArray->add($nextObj);
							}

							if (!isset($nextObj)) {
								continue;
							}

							switch ($alertype) {
								// MAP ALERTS
								case $CFG->ALERT_LURKING_USER;
								case $CFG->ALERT_INACTIVE_USER;
								case $CFG->ALERT_IGNORED_POST:
								case $CFG->ALERT_MATURE_ISSUE:
								case $CFG->ALERT_IMMATURE_ISSUE:
								case $CFG->ALERT_ORPHANED_IDEA:
								case $CFG->ALERT_EMERGING_WINNER:
								case $CFG->ALERT_CONTENTIOUS_ISSUE:
								case $CFG->ALERT_INCONSISTENT_SUPPORT:
								case $CFG->ALERT_HOT_POST:
								case $CFG->ALERT_CONTROVERSIAL_IDEA:
								case $CFG->ALERT_USER_GONE_INACTIVE:
								case $CFG->ALERT_WELL_EVALUATED_IDEA:
								case $CFG->ALERT_POORLY_EVALUATED_IDEA:
								case $CFG->ALERT_RATING_IGNORED_ARGUMENT:
								case $CFG->ALERT_USER_IGNORED_COMPETITORS:
								case $CFG->ALERT_USER_IGNORED_ARGUMENTS:
								case $CFG->ALERT_USER_IGNORED_RESPONSES:
									// Store data just by alert type
									if (array_key_exists($alertype,$alertArray)) {
										$array = $alertArray[$alertype];
										array_push($array, $nextpost);
										$alertArray[$alertype] = $array;
									} else {
										$array = array();
										array_push($array, $nextpost);
										$alertArray[$alertype] = $array;
									}
									break;

								// USER SPECIFIC ALERTS
								case $CFG->ALERT_UNSEEN_BY_ME:
								case $CFG->ALERT_RESPONSE_TO_ME:
								case $CFG->ALERT_UNRATED_BY_ME:
								case $CFG->ALERT_INTERESTING_TO_ME:
								case $CFG->ALERT_INTERESTING_TO_PEOPLE_LIKE_ME:
								case $CFG->ALERT_SUPPORTED_BY_PEOPLE_LIKE_ME:
								case $CFG->ALERT_PEOPLE_WITH_INTERESTS_LIKE_MINE:
								case $CFG->ALERT_PEOPLE_WHO_AGREE_WITH_ME:
								case $CFG->ALERT_UNSEEN_RESPONSE:
								case $CFG->ALERT_UNSEEN_COMPETITOR:

									if ($userid != null && $userid != "") {
										if (array_key_exists($userid, $userAlertArray)) {
											$typesarray = $userAlertArray[$userid];
											if (array_key_exists($alertype,$typesarray)) {
												$postArray = $typesarray[$alertype];
												array_push($postArray, $nextpost);
												$typesarray[$alertype] = $postArray;
												$userAlertArray[$userid] = $typesarray;
											} else {
												$postArray = array();
												array_push($postArray, $nextpost);
												$typesarray[$alertype] = $postArray;
												$userAlertArray[$userid] = $typesarray;
											}
										} else {
											$typesarray = array();
											$postArray = array();
											array_push($postArray, $nextpost);
											$typesarray[$alertype] = $postArray;
											$userAlertArray[$userid] = $typesarray;
										}
									}
									break;
								default:
									// Do nothing
							}
						}
					}

					$data = new alertdata();
					$data->alertarray = $alertArray; //nodes by alert type
					$data->userarray = $userAlertArray; // nodes by user by alert type
					$data->nodes = $finalNodeArray;
					$data->users = $finalUserArray;
				} else {
					$data = new alertdata();
				}
			}
		}

		$HUB_CACHE->setObjData($CFG->MINI_PAGE_ALERTS.$url.$alerttypes.$userids, $data, $timeout);
	} else {
		//error_log("DATA FOUND: getUserAlertData");
	}

	return $data;
}

?>


