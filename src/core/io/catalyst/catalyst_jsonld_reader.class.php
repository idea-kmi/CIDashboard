<?php
/********************************************************************************
 *                                                                              *
 *  (c) Copyright 2015 The Open University UK                                   *
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

require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');

class catalyst_jsonld_reader {

	private $UNKNOWN_USER = 'anonymous'; //'unknown'

	public $nodeimages = array (
		'Challenge' => 'images/nodetypes/Default/challenge.png',
		'Issue' => 'images/nodetypes/Default/issue.png',
		'Solution' => 'images/nodetypes/Default/solution.png',
		'Argument' => 'images/nodetypes/Default/argument.png',
		'Resource' => 'images/nodetypes/Default/reference.png',
		'Idea' => 'images/nodetypes/Default/idea.png',
		'Pro' => 'images/nodetypes/Default/plus.png',
		'Con' => 'images/nodetypes/Default/minus.png',
		'Comment' => 'images/nodetypes/Default/comment.png'
		/*'Map' => 'images/nodetypes/Default/map.png',
		'Decision' => 'images/nodetypes/Default/decision.png'
		*/
	);


	public $nodetypes = array (
		'Question' => 'Challenge',
		'Issue' => 'Issue',
		'Position' => 'Solution',
		'Argument' => 'Argument',
		'Reference' => 'Resource',
		'GenericIdea' => 'Idea',
		'GenericIdeaNode' => 'Idea',
		'SPost' => 'Comment'
		/*'Map' => 'Map',
		'Decision' => 'Decision'
		*/
	);

	public $linktypes = array (
		'IssueQuestions' => 'is related to', //$CFG->LINK_ISSUE_CHALLENGE,
		'PositionRespondsToIssue' => 'responds to', //$CFG->LINK_SOLUTION_ISSUE,
		'ArgumentSupportsIdea' => 'supports', //$CFG->LINK_PRO_SOLUTION,
		'ArgumentOpposesIdea' => 'challenges', //$CFG->LINK_CON_SOLUTION,
		'DirectedIdeaRelation' => 'responds to', //$CFG->LINK_SOLUTION_ISSUE,
		'InclusionRelation' => 'responds to', //$CFG->LINK_IDEA_NODE,
		'IssueAppliesTo' => 'responds to', //$CFG->LINK_ISSUE_SOLUTION,
		'SPostToSPost' => 'responds to',  //$CFG->LINK_COMMENT_COMMENT,
		'SPostToIdea' => 'is related to' //$CFG->LINK_COMMENT_NODE
	);

	public $linkends = array (
		'IssueQuestions' => array(
			'from' => 'applicable_issue',
			'to' => 'target_idea'
		),
		'PositionRespondsToIssue' => array(
			'from' => 'response_position',
			'to' => 'response_issue'
		),
		'ArgumentOpposesIdea' => array(
			'from' => 'argument_arguing',
			'to' => 'target_idea'
		),
		'ArgumentSupportsIdea' => array(
			'from' => 'argument_arguing',
			'to' =>'target_idea'
		),
		'DirectedIdeaRelation' => array(
			'from' => 'source_idea',
			'to' => 'target_idea'
		),
		'InclusionRelation' => array(
			'from' => 'source_idea',
			'to' => 'target_idea'
		),
		'IssueAppliesTo' => array(
			'from' => 'applicable_issue',
			'to' => 'target_idea'
		),
	);

	public $userArray = array();
	public $userProfileArray = array();
	public $nodeArray = array();
	public $nodeHistoryArray = array();
	public $userHistoryArray = array();
	public $votesArray = array();
	public $votesRangeArray = array();
	public $linkArray = array();
	public $linkCheckArray = array();

	public $datagraphs = array();
	public $context;

	public $withVotes = false;
	public $withHistory = false;
	public $withPosts = false;

	public $connectionSet;
	public $nodeSet;
	public $userSet;

	//public $annotationArray = array();

	/**
	 * Take the given url and fetch the jsonld it should return.
	 * Then process the jsonld into connections for a graph.
	 * @param $url string of the url to fetch the jsonld from.
	 * @return this, or Error
	 */
	function load($url, $timeout=60, $withHistory=false, $withVotes=false, $withPosts=false) {
		global $CFG, $HUB_FLM, $HUB_CACHE;

		$this->withHistory = $withHistory;
		$this->withVotes = $withVotes;
		$this->withPosts = $withPosts;

		$this->connectionSet = new ConnectionSet();
		$this->nodeSet = new NodeSet();
		$this->userSet = new UserSet();

		$doc = $HUB_CACHE->getStringData($url);
		if ($doc === FALSE) {
			$doc = loadJsonLDFromURL($url);
			$HUB_CACHE->setStringData($url, $doc, $timeout);
		} else {
			//error_log("URL DATA FOUND: catalyst reader");
		}

		try {
			// should be done on export of data from url end, but this is a fallback
			$doc = iconv("UTF-8", "UTF-8//IGNORE", $doc);

			$item = json_decode($doc);

			/*$error = json_last_error();
			if($error === JSON_ERROR_NONE && $item === null) {
			  $error = JSON_ERROR_SYNTAX;
			}
			switch($error) {
			case JSON_ERROR_NONE:
			  break;
			case JSON_ERROR_DEPTH:
			  throw new JsonLdException(
				'Could not parse JSON; the maximum stack depth has been exceeded.',
				'jsonld.ParseError');
			case JSON_ERROR_STATE_MISMATCH:
			  throw new JsonLdException(
				'Could not parse JSON; invalid or malformed JSON.',
				'jsonld.ParseError');
			case JSON_ERROR_CTRL_CHAR:
			case JSON_ERROR_SYNTAX:
			  throw new JsonLdException(
				'Could not parse JSON; syntax error, malformed JSON.',
				'jsonld.ParseError');
			case JSON_ERROR_UTF8:
			  throw new JsonLdException(
				'Could not parse JSON from URL; malformed UTF-8 characters.',
				'jsonld.ParseError');
			default:
			  throw new JsonLdException(
				'Could not parse JSON from URL; unknown error.',
				'jsonld.ParseError');
			}
			*/
		} catch (Exception $e) {
			error_log(print_r($e,true));
		}

		// free up a bit of memory?
		$doc = null;
		unset($doc);

		if ($item != NULL) {
			$this->processObject($item);

			// PROCESS USERS INTO SET AND ADD ACTIVITIES AND PROFILE INFO
			$countUsers = count($this->userArray);
			if ($countUsers > 0) {
				foreach($this->userArray as $userid => $user) {

					// If the user acount has a profile with any details
					// Add them to the final user account object.
					if (isset($user->profileid) && isset($this->userArray[$user->profileid])) {
						$userprofile = $this->userArray[$user->profileid];
						if (isset($userprofile->name)) {
							$user->name = $userprofile->name;
						}
						if (isset($userprofile->description)) {
							$user->description = $userprofile->description;
						}
						if (isset($userprofile->homepage)) {
							$user->homepage = $userprofile->homepage;
						}
						if (isset($userprofile->photo)) {
							$user->photo = $userprofile->photo;
						}
						if (isset($userprofile->thumb)) {
							$user->thumb = $userprofile->thumb;
						}
						//error_log("Profile id for user:".$user->userid." profileid=".$user->profileid);
					} else {
						//error_log("NO profile id for user:".$user->userid);
					}

					if (array_key_exists($userid, $this->userHistoryArray)) {
						$activity = $this->userHistoryArray[$userid];
						$user->activity = $activity;
					}

					$this->userArray[$userid] = $user;
					$this->userSet->add($user);
				}
			}

			// PROCESS NODES INTO SET AND ADD VOTES AND ACTIVITIES AND USERS
			$countNodes = count($this->nodeArray);
			if ($countNodes > 0) {
				foreach($this->nodeArray as $nodeid => $node) {
					if (array_key_exists($nodeid, $this->nodeHistoryArray)) {
						$activity = $this->nodeHistoryArray[$nodeid];
						$node->activity = $activity;
					}
					if (array_key_exists($nodeid, $this->votesArray)) {
						$votes = $this->votesArray[$nodeid];
						$node->votes = $votes;
					}
					if (array_key_exists($node->userid, $this->userArray)) {
						$node->users[0] = $this->userArray[$node->userid];
					} else {
						// if user object is missing, create from user from the id
						$user = new User($node->userid);
						$user->name = $node->userid;
						$user->photo =  $HUB_FLM->getImagePath($CFG->DEFAULT_USER_PHOTO);
						$user->thumb =  $HUB_FLM->getImagePath(str_replace('.','_thumb.', stripslashes($CFG->DEFAULT_USER_PHOTO)));
						$this->userArray[$node->userid] = $user;

						if (array_key_exists($node->userid, $this->userHistoryArray)) {
							$activity = $this->userHistoryArray[$node->userid];
							$user->activity = $activity;
						}

						$this->userArray[$node->userid] = $user;
						$this->userSet->add($user);

						$node->users[0] = $user;
					}

					if (array_key_exists($node->rolename, $this->nodeimages)) {
						$role = new Role();
						$role->name = $node->rolename;
						$role->image = $this->nodeimages[$node->rolename];
						$node->role = $role;
					}

					$this->nodeArray[$nodeid] = $node;
					$this->nodeSet->add($node);
				}

				$this->nodeSet->count = count($this->nodeSet->nodes);
				$this->nodeSet->totalno = $this->nodeSet->count;
			}

			$count = count($this->linkArray);
			if ($count > 0) {
				// PREPROCESS to get linktype counts
				for($i=0; $i<$count; $i++) {
					$link = $this->linkArray[$i];
					$fromid = $link['fromid'];
					$toid = $link['toid'];
					$linkname = $link['linkname'];

					if (array_key_exists($fromid, $this->nodeArray)) {
						$fromNode = $this->nodeArray[$fromid];
						if ($linkname == $CFG->LINK_PRO_SOLUTION) {
							$fromNode->procount = $fromNode->procount+1;
						} else if ($linkname == $CFG->LINK_CON_SOLUTION) {
							$fromNode->concount = $fromNode->concount+1;
						} else {
							$fromNode->othercount = $fromNode->othercount+1;
						}
					}
				}

				// PROCESS CONNECTIONS INTO SET
				$i=0;
				for($i=0; $i<$count; $i++) {
					$link = $this->linkArray[$i];

					$id = $link['id'];
					$fromid = $link['fromid'];
					$toid = $link['toid'];
					$linkname = $link['linkname'];
					$type = $link['type'];

					//error_log($type);

					$con = new Connection($id);
					$con->linklabelname = $linkname;
					$con->type = $type;

					//error_log(print_r($this->nodeArray, true));

					$fromNode = "";
					if (array_key_exists($fromid, $this->nodeArray)) {
						//error_log("from node");
						$fromNode = $this->nodeArray[$fromid];

						//error_log("concount".$fromNode->concount);
						//error_log("procount".$fromNode->procount);
						//error_log("othercount".$fromNode->othercount);

						if ($linkname == $CFG->LINK_PRO_SOLUTION
								&& $fromNode->concount == 0
									&& $fromNode->othercount == 0) {
							$fromNode->rolename = 'Pro';
						} else if ($linkname == $CFG->LINK_CON_SOLUTION
								&& $fromNode->procount == 0
									&& $fromNode->othercount == 0) {
							$fromNode->rolename = 'Con';
						}

						$role = new Role();
						$role->name = $fromNode->rolename;
						if (array_key_exists($fromNode->rolename, $this->nodeimages)) {
							$role->image = $this->nodeimages[$fromNode->rolename];
						}
						$fromNode->role = $role;
						$con->fromrole = $role;
					}

					$toNode = "";
					if (array_key_exists($toid, $this->nodeArray)) {
						$toNode = $this->nodeArray[$toid];
						$role = new Role();
						$role->name = $toNode->rolename;
						if (array_key_exists($toNode->rolename, $this->nodeimages)) {
							$role->image = $this->nodeimages[$toNode->rolename];
						}
						$toNode->role = $role;
						$con->torole = $role;
					}

					if ($fromNode != "" && $toNode != "") {
						$con->from = $fromNode;
						$con->to = $toNode;

						if (array_key_exists($id, $this->votesArray)) {
							$votes = $this->votesArray[$id];
							$con->votes = $votes;
						}

						$this->connectionSet->add($con);
					}
				}

				$this->connectionSet->count = count($this->connectionSet->connections);
				$this->connectionSet->totalno = $this->connectionSet->count;
			}

			return $this;
		} else {
			global $ERROR;
			$ERROR = new error;
			$ERROR->createInvalidJSONLDError(json_last_error());
			return $ERROR;
		}
	}

	function processArray($graphid, $dataArray) {
		if (is_array($dataArray)) {
			$count2 = count($dataArray);
			for ($j=0; $j < $count2; $j++) {
				$next = $dataArray[$j];
				$this->processObject($next, $graphid);
			}
		}
	}

	function processObject($dataObject, $graphid="") {
		global $HUB_FLM, $CFG;

		$next = $dataObject;
		$type = "";
		if (isset($next->{'@context'})) {
			$this->context = $next->{'@context'};
		}
		//error_log(print_r($this->context, true));

		if (isset($next->{'@graph'})) {
			$subgraph = $next->{'@graph'};
			$graphid = "";
			if (isset($next->{'@id'})) {
				$graphid = $next->{'@id'};
			}
			$this->processArray($graphid,$subgraph);
		} else {
			if (isset($next->{'@type'})) {
				$type = $next->{'@type'};
				//error_log($type);

				$id = "";
				if (isset($next->{'@id'})) {
					$id = $next->{'@id'};
				}

				switch($type) {
					case 'Conversation':
						if (isset($next->{'data_graph'})) {
							$array = array();
							$array['name'] = $next->{'data_graph'};
							$this->datagraphs[$id] = $array;
						}
						break;

					case 'UserAccount':
						$this->processUserAccount($next,$id, $type);
						break;
					case 'Agent':
						$this->processUserProfile($next,$id, $type);
						break;

					/** NODES **/
					/*case 'Map':
					case 'Option':*/
					case 'Question':
					case 'Argument':
					case 'Position':
					case 'Issue':
					case 'GenericIdea':
					case 'GenericIdeaNode':
						$this->processNode($next,$id, $type);
						break;

					/** LINKS **/
					case 'IssueQuestions':
					case 'PositionRespondsToIssue':
					case 'ArgumentSupportsIdea':
					case 'ArgumentOpposesIdea':
					case 'DirectedIdeaRelation':
					case 'InclusionRelation':
						$this->processLink($next,$id, $type);
						break;

					/** SPOST **/
					case 'SPost':
						if ($this->withPosts) {
							$this->processSPost($next,$id, $type);
						}
						break;

					/** ANNOTAIONS **/
					case 'Annotation':
						$this->processAnnotation($next,$id, $type);
						break;

					/** HISTORY ITEMS **/
					case 'Create':
					case 'Update':
					case 'Delete':
					case 'ReadStatusChange':
						$this->processHistory($next,$id, $type);
						break;

					case 'BinaryVote':
						$this->processBinaryVote($next,$id, $type);
						break;

					case 'LickertVote':
						$this->processLickertVote($next,$id, $type);
						break;

					case 'OrderingVote':
						$this->processOrderingVote($next, $id, $type);
						break;

					case 'LickertRange':
						if ($this->withVotes) {
							$min = "";
							if (isset($next->min)) {
								$min = $next->min;
							}
							$max = "";
							if (isset($next->max)) {
								$max = $next->max;
							}

							$voterange = array();
							$voterange['type'] = $type;
							$voterange['id'] = $id;
							$voterange['min'] = $min;
							$voterange['max'] = $max;

							$this->votesRangeArray[$id] = $voterange;
						}

						break;
					default:
						//error as method not defined.
						//global $ERROR;
						//$ERROR = new error;
						//$ERROR->createInvalidMethodError();
						//include($HUB_FLM->getCodeDirPath("core/formaterror.php"));
						//die;
				}
			}
		}
	}

	/**
	 * Load a node
	 */
	function processNode($next, $id, $type) {
		$created = "";
		if (isset($next->created)) {
			$created = $next->created;
		}

		$modified = "";
		if (isset($next->modified)) {
			$modified = $next->modified;
		}

		$has_creator = $this->UNKNOWN_USER;
		if (isset($next->has_creator)) {
			$has_creator = $next->has_creator;
		}
		$homepage = "";
		if (isset($next->homepage)) {
			$homepage = $next->homepage;
		}

		$titlevalue="";
		if (isset($next->title)) {
			$titleObj = $next->title;
			if ($titleObj instanceof StdClass) {
				if ($titleObj->{'@value'}) {
					$titlevalue = $titleObj->{'@value'};
				}
			} else {
				$titlevalue = $titleObj;
			}
		}

		$desc = "";
		if (isset($next->description)) {
			$descObj = $next->description;
			if ($descObj instanceof StdClass) {
				if ($descObj->{'@value'}) {
					$desc = $descObj->{'@value'};
				}
			} else if (is_string($descObj)) {
				$desc = $descObj;
			}
		}

		if ($titlevalue != "" && $id != "") {
			$nodetype = "Idea";
			if (isset($this->nodetypes[$type])) {
				$nodetype = $this->nodetypes[$type];
			}

			$cNode = new CNode($id);
			$cNode->name = $titlevalue;
			$cNode->description = $desc;
			$cNode->creationdate = $this->isoToTimestamp($created);
			$cNode->modificationdate = $this->isoToTimestamp($modified);
			$cNode->rolename = $nodetype;
			$cNode->userid = $has_creator;
			$cNode->homepage = $homepage;
			$cNode->type = $type;

			$this->nodeArray[$id] = $cNode;
		}
	}

	/**
	 * Load a node
	 */
	function processSPost($next, $id, $type) {
		$created = "";
		if (isset($next->created)) {
			$created = $next->created;
		}

		$modified = "";
		if (isset($next->modified)) {
			$modified = $next->modified;
		}

		$has_creator = $this->UNKNOWN_USER;
		if (isset($next->has_creator)) {
			$has_creator = $next->has_creator;
		}

		// add connection object
		if (isset($next->reply_of)) {
			$reply_of = $next->reply_of;
			if (!in_array($id.$reply_of, $this->linkCheckArray)) {
				$link = array();
				$link['id'] = $id.$reply_of;
				$link['type'] = 'SPostToSPost';
				$link['fromid'] = $id;
				$link['toid'] = $reply_of;
				$link['linkname'] = $this->linktypes[$link['type']];
				array_push($this->linkArray, $link);
				array_push($this->linkCheckArray, $link['id']);
			}
		}

		//link to any nodes that the spost pertains to
		if (isset($next->postLinkedToIdea)) {
			if (is_string($next->postLinkedToIdea)) {
				$nextidea = $next->postLinkedToIdea;
				if (!in_array($id.$nextidea, $this->linkCheckArray)) {
					$link = array();
					$link['id'] = $id.$nextidea;
					$link['type'] = 'SPostToIdea';
					$link['fromid'] = $id;
					$link['toid'] = $nextidea;
					$link['linkname'] = $this->linktypes[$link['type']];
					array_push($this->linkArray, $link);
					array_push($this->linkCheckArray, $link['id']);
				}
			} else {
				$ideaslist = $next->postLinkedToIdea;
				$countideas = count($ideaslist);
				for ($i=0; $i<$countideas; $i++) {
					$nextidea = $ideaslist[$i];
					if (!in_array($id.$nextidea, $this->linkCheckArray)) {
						$link = array();
						$link['id'] = $id.$nextidea;
						$link['type'] = 'SPostToIdea';
						$link['fromid'] = $id;
						$link['toid'] = $nextidea;
						$link['linkname'] = $this->linktypes[$link['type']];
						array_push($this->linkArray, $link);
						array_push($this->linkCheckArray, $link['id']);
					}
				}
			}
		}

		$titlevalue="";
		if (isset($next->title)) {
			$titleObj = $next->title;
			if ($titleObj instanceof StdClass) {
				if ($titleObj->{'@value'}) {
					$titlevalue = $titleObj->{'@value'};
				}
			} else {
				$titlevalue = $titleObj;
			}
		}

		$desc = "";
		if (isset($next->description)) {
			$descObj = $next->description;
			if ($descObj instanceof StdClass) {
				if ($descObj->{'@value'}) {
					$desc = $descObj->{'@value'};
				}
			} else if (is_string($descObj)) {
				$desc = $descObj;
			}
		}

		if ($titlevalue != "" && $id != "") {
			$nodetype = "Comment";

			//if (isset($this->nodetypes[$type])) {
			//	$nodetype = $this->nodetypes[$type];
			//}

			$cNode = new CNode($id);
			$cNode->name = $titlevalue;
			$cNode->description = $desc;
			$cNode->creationdate = $this->isoToTimestamp($created);
			$cNode->modificationdate = $this->isoToTimestamp($modified);
			$cNode->rolename = $nodetype;
			$cNode->userid = $has_creator;
			$cNode->homepage = "";
			$cNode->type = $type;

			$this->nodeArray[$id] = $cNode;
		}
	}

	/**
	 * Load a link
	 */
	function processLink($next, $id, $type) {
		$ends = $this->linkends[$type];
		$fromtype = $ends['from'];
		$totype = $ends['to'];

		$fromid = "";
		if (isset($next->{$fromtype})) {
			$fromid = $next->{$fromtype};
		}

		$toid = "";
		if (isset($next->{$totype})) {
			$toid = $next->{$totype};
		}

		$linktypename = $this->linktypes[$type];

		if ($fromid != "" && $toid != "" && $linktypename) {
			if (!in_array($id, $this->linkCheckArray)) {
				$link = array();
				$link['id'] = $id;
				$link['type'] = $type;
				$link['fromid'] = $fromid;
				$link['toid'] = $toid;
				$link['linkname'] = $linktypename;
				array_push($this->linkArray, $link);
				array_push($this->linkCheckArray, $id);
			}
		}
	}

	/**
	 * Load a UserAccount item
	 */
	function processUserAccount($next,$id, $type) {
		global $HUB_FLM,$CFG;

		$user = new User($id);
		$user->name = $id;

		if (isset($next->account_of)) {
			$user->profileid = $next->account_of;
		}

		$user->photo =  $HUB_FLM->getImagePath($CFG->DEFAULT_USER_PHOTO);
		$user->thumb =  $HUB_FLM->getImagePath(str_replace('.','_thumb.', stripslashes($CFG->DEFAULT_USER_PHOTO)));
		if (!array_key_exists($id, $this->userArray)) {
			$this->userArray[$id] = $user;
		}
	}

	/**
	 * Load a UserProfile item
	 */
	function processUserProfile($next, $id, $type) {
		global $HUB_FLM,$CFG;

		$user = new User($id);

		$name = $id;
		if (isset($next->firstName)) {
			$name = $next->firstName;
		}

		if (isset($next->familyName)) {
			if (isset($next->firstName)) {
				$name = $name." ".$next->firstName;
			} else {
				$name = $next->firstName;
			}
		}

		if (isset($next->fname) && $next->fname != "") {
			$name = $next->fname;
		}
		$user->name = $name;

		$desc = "";
		if (isset($next->description)) {
			$descObj = $next->description;
			if ($descObj instanceof StdClass) {
				if ($descObj->{'@value'}) {
					$desc = $descObj->{'@value'};
				}
			} else if (is_string($descObj)) {
				$desc = $descObj;
			}
		}
		$user->description = $desc;

		if (isset($next->img)) {
			$user->photo = $next->img;
			$user->thumb = "";
		} else {
			$user->photo =  $HUB_FLM->getImagePath($CFG->DEFAULT_USER_PHOTO);
			$user->thumb =  $HUB_FLM->getImagePath(str_replace('.','_thumb.', stripslashes($CFG->DEFAULT_USER_PHOTO)));
		}

		if (isset($next->homepage)) {
			$user->homepage = $next->homepage;
		}

		if (!array_key_exists($id, $this->userProfileArray)) {
			$this->userProfileArray[$id] = $user;
		}
	}

	/**
	 * Load a History item
	 */
	function processHistory($next, $id, $type) {
		if ($this->withHistory) {
			$who = "";
			if (isset($next->who)) {
				$who = $next->who;
			}
			$what = "";
			if (isset($next->what)) {
				$what = $next->what;
			}
			$when = 0;
			if (isset($next->when)) {
				$when = $this->isoToTimestamp($next->when);
			}

			$activitytype = $type;
			if ($type == 'ReadStatusChange') {
				$activitytype = "View";
			}

			$activity = array();
			$activity["type"] = $activitytype;
			$activity["itemid"] = $what;
			$activity["userid"] = $who;
			$activity["modificationdate"] = $when;

			if ($what != "") {
				if (array_key_exists($what, $this->nodeHistoryArray)) {
					$list = $this->nodeHistoryArray[$what];
					array_push($list, $activity);
					$this->nodeHistoryArray[$what] = $list;
				} else {
					$list = array();
					array_push($list, $activity);
					$this->nodeHistoryArray[$what] = $list;
				}
			}

			if ($who != "") {
				if (array_key_exists($who, $this->userHistoryArray)) {
					$list = $this->userHistoryArray[$who];
					array_push($list, $activity);
					$this->userHistoryArray[$who] = $list;
				} else {
					$list = array();
					array_push($list, $activity);
					$this->userHistoryArray[$who] = $list;
				}
			}
		}
	}

	/**
	 * Load a Binary Vote
	 */
	function processBinaryVote($next, $id, $type) {
		if ($this->withVotes) {
			$voter = "";
			if (isset($next->voter)) {
				$voter = $next->voter;
			}
			$created = "";
			if (isset($next->created)) {
				$created = $this->isoToTimestamp($next->created);
			}
			$vote_subject_node = "";
			if (isset($next->vote_subject_node)) {
				$vote_subject_node = $next->vote_subject_node;
			}
			$vote_subject_link = "";
			if (isset($next->vote_subject_link)) {
				$vote_subject_link = $next->vote_subject_link;
			}
			$positive = "";
			if (isset($next->positive)) {
				$positive = $next->positive;
			}

			$activity = array();
			$activity["type"] = 'Vote';
			$activity["subtype"] = $type;
			$activity["userid"] = $voter;
			$activity["modificationdate"] = $created;
			$activity["id"] = $id;
			$activity["positive"] = $positive;

			if ($vote_subject_node != "") {
				$activity["itemid"] = $vote_subject_node;
				if (array_key_exists($vote_subject_node, $this->votesArray)) {
					$list = $this->votesArray[$vote_subject_node];
					array_push($list,$activity);
					$this->votesArray[$vote_subject_node] = $list;
				} else {
					$list = array();
					array_push($list,$activity);
					$this->votesArray[$vote_subject_node] = $list;
				}
			} else if ($vote_subject_link != "") {
				$activity["itemid"] = $vote_subject_link;
				if (array_key_exists($vote_subject_link, $this->votesArray)) {
					$list = $this->votesArray[$vote_subject_link];
					array_push($list,$activity);
					$this->votesArray[$vote_subject_link] = $list;
				} else {
					$list = array();
					array_push($list,$activity);
					$this->votesArray[$vote_subject_link] = $list;
				}
			}
			if ($voter != "") {
				if (array_key_exists($voter, $this->userHistoryArray)) {
					$list = $this->userHistoryArray[$voter];
					array_push($list,$activity);
					$this->userHistoryArray[$voter] = $list;
				} else {
					$list = array();
					array_push($list,$activity);
					$this->userHistoryArray[$voter] = $list;
				}
			}
		}
	}

	/**
	 * Load a Lickert Vote
	 */
	function processLickertVote($next, $id, $type) {
		if ($this->withVotes) {
			$voter = "";
			if (isset($next->voter)) {
				$voter = $next->voter;
			}
			$created = "";
			if (isset($next->created)) {
				$created = $this->isoToTimestamp($next->created);
			}
			$vote_subject_link = "";
			if (isset($next->vote_subject_link)) {
				$vote_subject_link = $next->vote_subject_link;
			}
			$vote_subject_node = "";
			if (isset($next->vote_subject_node)) {
				$vote_subject_node = $next->vote_subject_node;
			}
			$lickert_value = "";
			if (isset($next->lickert_value)) {
				$lickert_value = $next->lickert_value;
			}
			$lickert_in_range = "";
			if (isset($next->lickert_in_range)) {
				$lickert_in_range = $next->lickert_in_range;
			}

			$activity = array();
			$activity["type"] = 'Vote';
			$activity["subtype"] = $type;
			$activity["userid"] = $voter;
			$activity["modificationdate"] = $created;
			$activity["id"] = $id;
			$activity["lickertvalue"] = $lickert_value;
			$activity["lickertrange"] = $lickert_in_range;

			if ($vote_subject_node != "") {
				$activity["itemid"] = $vote_subject_node;
				if (array_key_exists($vote_subject_node, $this->votesArray)) {
					$list = $this->votesArray[$vote_subject_node];
					array_push($list,$activity);
					$this->votesArray[$vote_subject_node] = $list;
				} else {
					$list = array();
					array_push($list,$activity);
					$this->votesArray[$vote_subject_node] = $list;
				}
			} else if ($vote_subject_link != "") {
				$activity["itemid"] = $vote_subject_link;
				if (array_key_exists($vote_subject_link, $this->votesArray)) {
					$list = $this->votesArray[$vote_subject_link];
					array_push($list,$activity);
					$this->votesArray[$vote_subject_link] = $list;
				} else {
					$list = array();
					array_push($list,$activity);
					$this->votesArray[$vote_subject_link] = $list;
				}
			}
			if ($voter != "") {
				if (array_key_exists($voter, $this->userHistoryArray)) {
					$list = $this->userHistoryArray[$voter];
					array_push($list, $activity);
					$this->userHistoryArray[$voter] = $list;
				} else {
					$list = array();
					array_push($list, $activity);
					$this->userHistoryArray[$voter] = $list;
				}
			}
		}
	}

	/**
	 * Load an Ordering Vote
	 */
	function processOrderingVote() {
		if ($this->withVotes) {
			$voter = "";
			if (isset($next->voter)) {
				$voter = $next->voter;
				//print_r("VOTER=".$voter);
				//echo "<br>";
			}
			$created = "";
			if (isset($next->created)) {
				$created = $this->isoToTimestamp($next->created);
				//print_r("CREATED=".$created);
				//echo "<br>";
			}
			$vote_subject_link = "";
			if (isset($next->vote_subject_link)) {
				$vote_subject_link = $next->vote_subject_link;
				//print_r("VOTER SUBJECT LINK=".$vote_subject_link);
				//echo "<br>";
			}
			$vote_subject_node = "";
			if (isset($next->vote_subject_node)) {
				$vote_subject_node = $next->vote_subject_node;
				//print_r("VOTER SUBJECT NODE=".$vote_subject_node);
				//echo "<br>";
			}
			$ordered_ideas = "";
			if (isset($next->ordered_ideas)) {
				$ordered_ideas = $next->ordered_ideas;
				//print_r("ORDERED IDEAS=".$ordered_ideas);
				//echo "<br>";
			}

			$vote = array();
			$vote['type'] = $type;
			$vote['id'] = $id;
			$vote['created'] = $created;
			$vote['vote_subject_node'] = $vote_subject_node;
			$vote['vote_subject_link'] = $vote_subject_link;
			$vote['ordered_ideas'] = $ordered_ideas;

			if ($vote_subject_node != "") {
				if (array_key_exists($vote_subject_node, $this->votesArray)) {
					$list = $this->votesArray[$vote_subject_node];
					array_push($list, $vote);
					$this->votesArray[$vote_subject_node] = $list;
				} else {
					$list = array();
					array_push($list, $vote);
					$this->votesArray[$vote_subject_node] = $list;
				}
			}
			if ($vote_subject_link != "") {
				if (array_key_exists($vote_subject_link, $this->votesArray)) {
					$list = $this->votesArray[$vote_subject_link];
					array_push($list, $vote);
					$this->votesArray[$vote_subject_link] = $list;
				} else {
					$list = array();
					array_push($list, $vote);
					$this->votesArray[$vote_subject_link] = $list;
				}
			}
		}
	}

	/**
	 * Load an Annotation
	 */
	function processAnnotation($next, $id, $type) {
		/*
		$hasBody = "";
		$hasTarget = "";
		if (isset($next->hasBody)) {
			$hasBody = $next->hasBody;
			//print_r("BODY=".$hasBody);
			//echo "<br>";
		}
		if (isset($next->hasTarget)) {
			$hasTarget = $next->hasTarget;
			//print_r("TARGET=".$hasTarget);
			//echo "<br>";
		}
		*/

		//if ($next->{'oa:annotatedAt'}) {
		//
		//}
		//if ($next->{'oa:serializedBy'}) {
		//
		//}
	}

	/**
	 * Take an ISO date and turn it into a timestamp.
	 */
	function isoToTimestamp($ison) {
	    return date("U",strtotime($ison));
	}
}


/** CLASSES TO HOLD DATA **/
class CNode {
	public $nodeid;
	public $type;
	public $userid;
	public $name;
	public $description;
	public $creationdate;
	public $modificationdate;
	public $rolename;
	public $homepage;
	public $procount=0;
	public $concount=0;
	public $othercount=0;

    function CNode($nodeid = ""){
        if ($nodeid != ""){
            $this->nodeid = $nodeid;
            return $this;
        }
    }
}

class NodeSet {
    public $totalno = 0;
    public $count = 0;
    public $nodes;

    function NodeSet() {
        $this->nodes = array();
    }

    function add($node){
        array_push($this->nodes,$node);
    }
}

class Connection {
	public $connid;
	public $type;
	/*public $fromid;
	public $toid;
	*/
	public $from;
	public $to;
	public $fromrole;
	public $torole;
	public $votes;
	public $linklabelname;

    function Connection($connid = ""){
        if ($connid != ""){
            $this->connid= $connid;
            return $this;
        }
    }
}

class ConnectionSet {
    public $totalno = 0;
    public $count = 0;
    public $connections;

    function ConnectionSet() {
        $this->connections = array();
    }

    function add($conn){
        array_push($this->connections,$conn);
    }
}

class User {
	public $userid;
	public $name;
	public $description;
	public $profileid;
	public $homepage;
	public $photo;
	public $thumb;

    function user($userid = "") {
        if ($userid != ""){
            $this->userid = $userid;
            return $this;
        }
    }
}

class UserSet {
    public $totalno = 0;
    public $count = 0;
    public $users;

    function UserSet() {
        $this->users = array();
    }

    function add($user){
        array_push($this->users,$user);
    }
}

class Role {
    public $roleid;
    public $name;
    public $userid;
    public $groupid;
    public $image;
}
?>
