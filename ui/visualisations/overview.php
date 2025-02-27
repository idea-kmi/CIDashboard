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

require_once('../../config.php');
require_once($HUB_FLM->getEmbedLib());

$url = required_param('url', PARAM_URL);
$langurl = optional_param('langurl', '', PARAM_URL);
$timeout = optional_param('timeout', 60, PARAM_INT);
$withtitle = optional_param('withtitle', true, PARAM_BOOL);
//$withdesc = optional_param('withdesc', true, PARAM_BOOL);
$dashboard = optional_param('dashboard', false, PARAM_BOOL);

if ($dashboard) {
	include_once($HUB_FLM->getCodeDirPath("ui/headerdashboard.php"));
} else {
	include_once($HUB_FLM->getCodeDirPath("ui/headerembed.php"));
}
?>
<script type='text/javascript'>

function countWords(s){
    s = s.replace(/(^\s*)|(\s*$)/gi,"");//exclude  start and end white-space
    s = s.replace(/[ ]{2,}/gi," ");//2 or more space to 1
    s = s.replace(/\n /,"\n"); // exclude newline with a start spacing
    return s.split(' ').length;
}

function sparklinedatesortasc(a, b) {
	var nameA=a.x;
	var nameB=b.x;
	if (nameA < nameB) {
		return -1;
	}
	if (nameA > nameB) {
		return 1;
	}
	return 0;
}

function votedatesortdesc(a, b) {
	var nameA=a.cnode.votedate;
	var nameB=b.cnode.votedate;
	if (nameA > nameB) {
		return -1;
	}
	if (nameA < nameB) {
		return 1;
	}
	return 0;
}

function activitydatesortdesc(a, b) {
	var nameA=a.modificationdate;
	var nameB=b.modificationdate;
	if (nameA > nameB) {
		return -1;
	}
	if (nameA < nameB) {
		return 1;
	}
	return 0;
}

function votesortdesc(a, b) {
	var nameA=parseInt(a.cnode.totalvotes);
	var nameB=parseInt(b.cnode.totalvotes);
	if (nameA > nameB) {
		return -1;
	}
	if (nameA < nameB) {
		return 1;
	}
	return 0;
}

function negvotesortdesc(a, b) {
	var nameA=parseInt(a.cnode.negativevotes);
	var nameB=parseInt(b.cnode.negativevotes);
	if (nameA > nameB) {
		return -1;
	}
	if (nameA < nameB) {
		return 1;
	}
	return 0;
}

function addOverviewItem(divarea, node, metadata) {

	var nodeid = node.nodeid;
	var nodename = node.name+metadata;
	var nodetype = node.rolename;
	var homepage = node.homepage;

	if (nodeid != nodename) {
		next = new Element("span", {
			'style':'float:left;clear:both;margin-top:5px;margin-bottom:5px;'});

		if (nodetype) {
			var img = new Element("img", {'style':'vertical-align:middle;padding-right:5px'});
			var icon = getNodeIcon(nodetype, false);
			img.src = icon;
			next.insert(img);
		}

		next.insert(nodename);
		if (homepage && homepage != "") {
			next.className = "active";
			Event.observe(next,'click',function (){
				loadDialog('details', homepage, 1024,768);
			});
		}
	} else {
		next = new Element("span", {
			'style':'float:left;clear:both;margin-top:10px;'});
		next.insert(nodename);
	}
	$(divarea).insert(next);
}

function loadOverviewData() {

	$('messagearea').update(getLoading("<?php echo $LNG->STATS_OVERVIEW_LOADING_MESSAGE; ?>"));

	var url = '<?php echo rawurlencode($url); ?>';
	var timeout = '<?php echo rawurlencode($timeout); ?>';

	var reqUrl = SERVICE_ROOT + "&method=getnodesfromjsonld&withhistory=true&withvotes=true&url="+url+"&timeout="+timeout;

	new Ajax.Request(reqUrl, { method:'post',
		onSuccess: function(transport){
			//alert(transport.responseText);

			var json = null;
			try {
				json = transport.responseText.evalJSON();
			} catch(e) {
				alert(e);
			}
			if(json.error){
				alert(json.error[0].message);
				return;
			}

			var nodes = json.nodeset[0].nodes;
			//alert("node count = "+nodes.length);
			if (nodes.length > 0) {
				var now = new Date();
				var timeTwoWeeksAgo = now.setDate(now.getDate() - 14);
				now = new Date();
				var timeFiveDaysAgo = now.setDate(now.getDate() - 5);

				var avergaeWordCount = 0;
				var wordsByUser = {};
				var viewsByUser = {};
				var minWordCount = 0;
				var maxWordCount = 0;
				var totalWordCount = 0;
				var contributorCount = 0;
				var viewCount = 0;
				var allActivity = new Array();
				var allViews = new Array();
				var allVotes = new Array();
				var contributionsArray = new Array();
				var contributionsObj = {key:"types", values:contributionsArray};
				var contributionTypes = {};


				for(var i=0; i< nodes.length; i++){
					var node = nodes[i].cnode;
					//alert(i);
					//alert(node.toSource())
					var nameCount = countWords(node.name);
					var descCount = countWords(node.description);
					var userid = node.userid;
					var nextWordCount = descCount+nameCount;
					if (nextWordCount>maxWordCount) {
						maxWordCount = nextWordCount
					}
					if (minWordCount == 0 || nextWordCount < minWordCount) {
						minWordCount = nextWordCount;
					}
					totalWordCount = totalWordCount+nextWordCount;

					node.votedate = 0;
					node.totalvotes = 0;

					if (contributionTypes[node.rolename]) {
						contributionTypes[node.rolename] = contributionTypes[node.rolename]+1;
					} else {
						contributionTypes[node.rolename] = 1;
					}

					if (node.activity) {
						var activity = node.activity;
						var activities = activity[0];
						for (next in activities) {
						 	if(activities.hasOwnProperty(next)) {
						 		var obj = activities[next][0];
								allActivity.push(activities[next][0]);
								if (obj.type == "View") {
									if (obj.userid.indexOf("anonymous") == -1) {
										allViews.push(activities[next][0]);
									}
								}
							}
						}
					}

					if (node.votes) {
						var votes = node.votes;
						var voteactivity = votes[0];
						//var positivevotes = 0;
						//var negativevotes = 0;
						var totalvotes = 0;
						var votesArray = new Array();

						for (next in voteactivity) {
						 	if(voteactivity.hasOwnProperty(next)) {
						 		var vote = voteactivity[next][0];
								totalvotes++;
								/*if (vote.subtype == "BinaryVote") {
									if (vote.positive == "true") {
										positivevotes++;
									} else {
										negativevotes++;
									}
								} else {
									positivevotes++;
								}*/
								allVotes.push(voteactivity[next][0]);
								votesArray.push(voteactivity[next][0]);
							}
						}
						//node.positivevotes = positivevotes;
						//node.negativevotes = negativevotes;

						node.totalvotes = totalvotes;
						votesArray.sort(activitydatesortdesc);
						if (votesArray[0]) {
							node.votedate = votesArray[0].modificationdate;
						}
					}

					if (wordsByUser.hasOwnProperty(userid)) {
						var count = wordsByUser[userid];
						count = count+descCount+nameCount;
						wordsByUser[userid] = count;
					} else {
						contributorCount++;
						var count = descCount+nameCount;
						wordsByUser[userid] = count;
					}
				}
				// MOST VOTES ON
				var totaladded = 0;
				nodes.sort(votesortdesc);
				var count = nodes.length;
				if (count > 3) {
					count = 3;
				}
				for (var i=0; i<count; i++) {
					var nextnode = nodes[i];
					if (parseInt(nextnode.cnode.totalvotes) > 0) {
						var votes = '<span style="padding-left:10px;color:dimgray"><?php echo $LNG->STATS_OVERVIEW_VOTES;?>'+parseInt(nextnode.cnode.totalvotes)+'</span>';
						addOverviewItem($("topvotedlist"), nextnode.cnode, votes);
						totaladded++;
					}
				}
				if (totaladded == 0) {
					$('topvoteddiv').style.display = 'none';
				}

				// MOST RENCETNLY VOTED ON
				totaladded = 0;
				nodes.sort(votedatesortdesc);
				count = nodes.length;
				if (count > 3) {
					count = 3;
				}
				for (var i=0; i<count; i++) {
					var nextnode = nodes[i];
					if (nextnode.cnode.votedate) {
						var creationDate = new Date(nextnode.cnode.votedate*1000);
						var fomatedDate = "";
						if (creationDate) {
							fomatedDate = creationDate.format(DATE_FORMAT_PROJECT);
						}
						var date = '<span style="padding-left:10px;color:dimgray"><?php echo $LNG->STATS_OVERVIEW_DATE;?>'+fomatedDate+'</span>';
						addOverviewItem($("recentvotedlist"), nextnode.cnode, date);
						totaladded++;
					}
				}
				if (totaladded == 0) {
					$('recentvoteddiv').style.display = 'none';
				}

				// RECENTLY ADDED NODES
				totaladded = 0;
				nodes.sort(creationdatenodesortdesc);
				count = nodes.length;
				if (count > 3) {
					count = 3;
				}
				for (var i=0; i<count; i++) {
					var nextnode = nodes[i];
					var creationDate = new Date(nextnode.cnode.creationdate*1000);
					var fomatedDate = "";
					if (creationDate) {
						fomatedDate = creationDate.format(DATE_FORMAT_PROJECT);
					}
					var date = '<span style="padding-left:10px;color:dimgray"><?php echo $LNG->STATS_OVERVIEW_DATE;?>'+fomatedDate+'</span>';
					addOverviewItem($("latestnodeslist"), nextnode.cnode, date);
					totaladded++;
				}
				if (totaladded == 0) {
					$('latestnodesdiv').style.display = 'none';
				}

				// WORD STATS
				var userNodeCount = contributorCount;
				var averageWordCount = 0;
				if (userNodeCount != 0) {
					averageWordCount = parseInt(parseInt(totalWordCount)/parseInt(userNodeCount));
				}

				$('average-words-count').update(averageWordCount);
				$('min-words-count').update(minWordCount);
				$('max-words-count').update(maxWordCount);


				// HEALTH PARTICIPATION

				$('health-participation-count').update(userNodeCount);
				var person = userNodeCount == 1 ? '<?php echo $LNG->STATS_OVERVIEW_PERSON; ?>' :'<?php echo $LNG->STATS_OVERVIEW_PEOPLE; ?>';
				$('health-participation-message').update(person+' '+'<?php echo $LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTORS; ?>');
				if (userNodeCount < 3) {
					$('health-participation-red').className = "trafficlightredon";
					$('health-participation-recomendation').update('<?php echo $LNG->STATS_OVERVIEW_HEALTH_PROBLEM; ?>');
				} else if (userNodeCount >= 3 && userNodeCount <= 5) {
					$('health-participation-orange').className = "trafficlightorangeon";
					$('health-participation-recomendation').update('<?php echo $LNG->STATS_OVERVIEW_HEALTH_MAYBE_PROBLEM; ?>');
				} else if (userNodeCount > 5) {
					$('health-participation-green').className = "trafficlightgreenon";
					$('health-participation-recomendation').update('<?php echo $LNG->STATS_OVERVIEW_HEALTH_NO_PROBLEM; ?>');
				}

				// HEALTH VIEWING
				var peoplegreencount = 0;
				var peopleorangecount = 0;
				var peopleGreenCheck = new Array();
				var peopleOrangeCheck = new Array();
				var orangecount = 0;
				var greencount = 0;
				var peoplecount = 0;

				for (var i=0; i<allViews.length; i++) {
					var nextview = allViews[i];
					if (nextview) {
						if (nextview.modificationdate) {
							var nextdate = parseInt(nextview.modificationdate)*1000;
							if (nextdate >= timeTwoWeeksAgo) {
								if (nextdate < timeFiveDaysAgo) {
									if (peopleOrangeCheck.indexOf(nextview.userid) == -1) {
										peopleorangecount++;
										peopleOrangeCheck.push(nextview.userid);
									}
									orangecount++;
								} else if (nextdate >= timeFiveDaysAgo) {
									if (peopleGreenCheck.indexOf(nextview.userid) == -1) {
										peoplegreencount++;
										peopleGreenCheck.push(nextview.userid);
									}
									greencount++;
								}
							}
						}
					}
				}

				peoplecount = peoplegreencount+peopleorangecount;

				if (peoplecount == 0) {
					var orangeamount = orangecount == 1 ? '<?php echo $LNG->STATS_OVERVIEW_TIME; ?>' : '<?php echo $LNG->STATS_OVERVIEW_TIMES; ?>';
					$('health-viewing-messageorange').update('<?php echo $LNG->STATS_OVERVIEW_HEALTH_VIEWERS; ?>'+' '+'<?php echo $LNG->STATS_OVERVIEW_PEOPLE; ?>'+' '+'<?php echo $LNG->STATS_OVERVIEW_HEALTH_VIEWERS_PART2; ?>');
					$('health-viewing-messageorange-part2').update(orangeamount+' '+'<?php echo $LNG->STATS_OVERVIEW_HEALTH_VIEWERS_RED; ?>');
					$('health-viewing-recomendation').update('<?php echo $LNG->STATS_OVERVIEW_HEALTH_PROBLEM; ?>');
					$('health-viewingpeople-orange-count').update(0);
					$('health-viewingitem-orange-count').update(0);
					$('health-viewing-red').className = "trafficlightredon";
					$('health-viewingorange-div').style.display = "block";
				} else if (orangecount > 0 && greencount == 0) {
					var orangeamount = orangecount == 1 ? '<?php echo $LNG->STATS_OVERVIEW_TIME; ?>' : '<?php echo $LNG->STATS_OVERVIEW_TIMES; ?>';
					var orangeperson = peopleorangecount == 1 ? '<?php echo $LNG->STATS_OVERVIEW_PERSON; ?>' :'<?php echo $LNG->STATS_OVERVIEW_PEOPLE; ?>';
					$('health-viewing-messageorange').update('<?php echo $LNG->STATS_OVERVIEW_HEALTH_VIEWERS; ?>'+' '+orangeperson+' '+'<?php echo $LNG->STATS_OVERVIEW_HEALTH_VIEWERS_PART2; ?>');
					$('health-viewing-messageorange-part2').update(orangeamount+' '+'<?php echo $LNG->STATS_OVERVIEW_HEALTH_VIEWERS_ORANGE; ?>');
					$('health-viewing-recomendation').update('<?php echo $LNG->STATS_OVERVIEW_HEALTH_MAYBE_PROBLEM; ?>');
					$('health-viewingpeople-orange-count').update(peopleorangecount);
					$('health-viewingitem-orange-count').update(orangecount);
					$('health-viewing-orange').className = "trafficlightorangeon";
					$('health-viewingorange-div').style.display = "block";
				} else if (greencount > 0) {
					var greenamount = greencount == 1 ? '<?php echo $LNG->STATS_OVERVIEW_TIME; ?>' : '<?php echo $LNG->STATS_OVERVIEW_TIMES; ?>';
					var greenperson = peoplegreencount == 1 ? '<?php echo $LNG->STATS_OVERVIEW_PERSON; ?>' :'<?php echo $LNG->STATS_OVERVIEW_PEOPLE; ?>';
					$('health-viewing-messagegreen').update('<?php echo $LNG->STATS_OVERVIEW_HEALTH_VIEWERS; ?>'+' '+greenperson+' '+'<?php echo $LNG->STATS_OVERVIEW_HEALTH_VIEWERS_PART2; ?>');
					$('health-viewing-messagegreen-part2').update(greenamount+' '+'<?php echo $LNG->STATS_OVERVIEW_HEALTH_VIEWERS_GREEN; ?>');
					$('health-viewing-recomendation').update('<?php echo $LNG->STATS_OVERVIEW_HEALTH_NO_PROBLEM; ?>');
					$('health-viewingpeople-green-count').update(peoplegreencount);
					$('health-viewingitem-green-count').update(greencount);
					$('health-viewing-green').className = "trafficlightgreenon";

					if (orangecount > 0) {
						var orangeamount = orangecount == 1 ? '<?php echo $LNG->STATS_OVERVIEW_TIME; ?>' : '<?php echo $LNG->STATS_OVERVIEW_TIMES; ?>';
						var orangeperson = peopleorangecount == 1 ? '<?php echo $LNG->STATS_OVERVIEW_PERSON; ?>' :'<?php echo $LNG->STATS_OVERVIEW_PEOPLE; ?>';
						$('health-viewing-messageorange').update('<?php echo $LNG->STATS_OVERVIEW_HEALTH_VIEWERS; ?>'+' '+orangeperson+' '+'<?php echo $LNG->STATS_OVERVIEW_HEALTH_VIEWERS_PART2; ?>');
						$('health-viewing-messageorange-part2').update(orangeamount+' '+'<?php echo $LNG->STATS_OVERVIEW_HEALTH_VIEWERS_ORANGE; ?>');
						$('health-viewingpeople-orange-count').update(peopleorangecount);
						$('health-viewingitem-orange-count').update(orangecount);
						$('health-viewingorange-div').style.display = "block";
						$('health-viewing-spacer').style.display = 'block';
					}

					$('health-viewinggreen-div').style.display = "block";
				}

				// HEALTH CONTRIBUTION
				peoplegreencount = 0;
				peopleorangecount = 0;
				peopleGreenCheck = new Array();
				peopleOrangeCheck = new Array();
				orangecount = 0;
				greencount = 0;
				peoplecount = 0

				for (var i=0; i<nodes.length; i++) {
					var node = nodes[i];
					if (node) {
						if (node.cnode.creationdate) {
							var nextdate = parseInt(node.cnode.creationdate)*1000;
							if (nextdate >= timeTwoWeeksAgo) {
								if (nextdate < timeFiveDaysAgo) {
									if (peopleOrangeCheck.indexOf(node.cnode.userid) == -1) {
										peopleorangecount++;
										peopleOrangeCheck.push(node.cnode.userid);
									}
									orangecount++;
								} else if (nextdate >= timeFiveDaysAgo) {
									if (peopleGreenCheck.indexOf(node.cnode.userid) == -1) {
										peoplegreencount++;
										peopleGreenCheck.push(node.cnode.userid);
									}
									greencount++;
								}
							}
						}
					}
				}

				//peoplegreencount = 3;
				//peopleorangecount = 1;
				//orangecount = 2;
				//greencount = 4;

				peoplecount = peoplegreencount+peopleorangecount;

				//$('health-debate-count').update(peoplecount);
				if (peoplecount == 0) {
					$('health-debate-messageorange').update('<?php echo $LNG->STATS_OVERVIEW_PEOPLE; ?>'+' '+'<?php echo $LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION; ?>');
					$('health-debate-messageorange-part2').update('<?php echo $LNG->STATS_OVERVIEW_TIMES; ?>'+' '+'<?php echo $LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION_RED; ?>');
					$('health-debate-recomendation').update('<?php echo $LNG->STATS_OVERVIEW_HEALTH_PROBLEM; ?>');
					$('health-debatepeople-orange-count').update(0);
					$('health-debateitem-orange-count').update(0);
					$('health-debate-red').className = "trafficlightredon";
					$('health-debateorange-div').style.display = "block";
				} else if (orangecount > 0 && greencount == 0) {
					var orangeamount = orangecount == 1 ? '<?php echo $LNG->STATS_OVERVIEW_TIME; ?>' : '<?php echo $LNG->STATS_OVERVIEW_TIMES; ?>';
					var orangeperson = peopleorangecount == 1 ? '<?php echo $LNG->STATS_OVERVIEW_PERSON; ?>' :'<?php echo $LNG->STATS_OVERVIEW_PEOPLE; ?>';
					$('health-debate-messageorange').update(orangeperson+' '+'<?php echo $LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION; ?>');
					$('health-debate-messageorange-part2').update(orangeamount+' '+'<?php echo $LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION_ORANGE; ?>');
					$('health-debate-recomendation').update('<?php echo $LNG->STATS_OVERVIEW_HEALTH_MAYBE_PROBLEM; ?>');
					$('health-debatepeople-orange-count').update(peopleorangecount);
					$('health-debateitem-orange-count').update(orangecount);
					$('health-debate-orange').className = "trafficlightorangeon";
					$('health-debateorange-div').style.display = "block";
				} else if (greencount > 0) {
					var greenamount = greencount == 1 ? '<?php echo $LNG->STATS_OVERVIEW_TIME; ?>' : '<?php echo $LNG->STATS_OVERVIEW_TIMES; ?>';
					var greenperson = peoplegreencount == 1 ? '<?php echo $LNG->STATS_OVERVIEW_PERSON; ?>' :'<?php echo $LNG->STATS_OVERVIEW_PEOPLE; ?>';
					$('health-debate-messagegreen').update(greenperson+' '+'<?php echo $LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION; ?>');
					$('health-debate-messagegreen-part2').update(greenamount+' '+'<?php echo $LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION_GREEN; ?>');
					$('health-debate-recomendation').update('<?php echo $LNG->STATS_OVERVIEW_HEALTH_NO_PROBLEM; ?>');
					$('health-debatepeople-green-count').update(peoplegreencount);
					$('health-debateitem-green-count').update(greencount);
					$('health-debate-green').className = "trafficlightgreenon";
					$('health-debategreen-div').style.display = "block";

					if (orangecount > 0) {
						var orangeamount = orangecount == 1 ? '<?php echo $LNG->STATS_OVERVIEW_TIME; ?>' : '<?php echo $LNG->STATS_OVERVIEW_TIMES; ?>';
						var orangeperson = peopleorangecount == 1 ? '<?php echo $LNG->STATS_OVERVIEW_PERSON; ?>' : '<?php echo $LNG->STATS_OVERVIEW_PEOPLE; ?>';
						$('health-debate-messageorange').update(orangeperson+' '+'<?php echo $LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION; ?>');
						$('health-debate-messageorange-part2').update(orangeamount+' '+'<?php echo $LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION_ORANGE; ?>');
						$('health-debate-spacer').style.display = 'block';
						$('health-debatepeople-orange-count').update(peopleorangecount);
						$('health-debateitem-orange-count').update(orangecount);
						$('health-debateorange-div').style.display = "block";
					}
				}

				// CONTRIBUTION BAR CHART
				var message = userNodeCount+' '+person+' '+'<?php echo $LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION; ?>';
				var innermessage = "";
				var contributionCount = 0;
				for (var property in contributionTypes) {
				    if (contributionTypes.hasOwnProperty(property)) {
				    	var nextcount = contributionTypes[property];
				    	contributionCount += nextcount;
				    	var next = {"label":getNodeTitleAntecedence(property, false), "value":nextcount};
				        contributionsArray.push(next);
				        innermessage += next.label+": "+next.value+"; ";
				    }
				}
				// add votes
				contributionsArray.push({"label":'<?php echo $LNG->STATS_OVERVIEW_VOTES;?>', "value":allVotes.length});
				simpleBarChartTypes($('contribution-chart'), new Array(contributionsObj), 300,100);

				innermessage += '<?php echo $LNG->STATS_OVERVIEW_VOTES;?>'+' '+allVotes.length;
				var itemname = contributionCount == 1 ? '<?php echo $LNG->STATS_OVERVIEW_TIME; ?>' : '<?php echo $LNG->STATS_OVERVIEW_TIMES; ?>';
				message += ' '+(contributionCount+allVotes.length)+' '+itemname+':<br><br>';
				$('contribution-chart-message').update(message+innermessage);

				// VIEWING SPARKLINE
				// Sort by day
				var viewDateArray = new Array();

				var formatDate = d3.time.format("%e %b %y");

				for (var i=0; i<allViews.length; i++) {
					var nextview = allViews[i];
					if (nextview) {
						if (nextview.modificationdate) {
							var date = new Date(nextview.modificationdate*1000);
							var newDate = new Date(date.getFullYear(), date.getMonth(), date.getDate());
							var time = newDate.getTime();
							if (viewDateArray[time]) {
								viewDateArray[time] = viewDateArray[time] +1;
							} else {
								viewDateArray[time] = 1;
							}
						}
					}
				}
				var sparklineData = new Array();
				var hightesviews = 0;
				var hightesviewsdate = 0;
				var lowestviews = 0;
				var lowestviewsdate = 0;

				for (var property in viewDateArray) {
				    if (viewDateArray.hasOwnProperty(property)) {
				    	var countdate = parseInt(property);
				    	var viewcount = viewDateArray[property];
				    	if (viewcount > hightesviews) {
				    		hightesviews = viewcount;
				    		hightesviewsdate = countdate;
				    	} else if (lowestviews == 0 || viewcount < lowestviews) {
				    		lowestviews = viewcount;
				    		lowestviewsdate = countdate;
				    	}
				        sparklineData.push({"x":countdate, "y":viewcount});
				    }
				}
				sparklineData = sparklineData.sort(sparklinedatesortasc);

				var lastcount = sparklineData[sparklineData.length-1];

				sparklineDateNVD3($('viewing-chart'), sparklineData, 500, 100);

				var viewingmessage = '<?php echo $LNG->STATS_OVERVIEW_VIEWING_HIGHEST; ?>';
				viewingmessage += " "+hightesviews+" ";
				viewingmessage += '<?php echo $LNG->STATS_OVERVIEW_VIEWING_VIEWS; ?>';
				viewingmessage += " "+formatDate(new Date(hightesviewsdate))+"<br>";

				viewingmessage += '<?php echo $LNG->STATS_OVERVIEW_VIEWING_LOWEST; ?>';
				viewingmessage += " "+lowestviews+" ";
				viewingmessage += '<?php echo $LNG->STATS_OVERVIEW_VIEWING_VIEWS; ?>';
				viewingmessage += " "+formatDate(new Date(lowestviewsdate))+"<br>";

				viewingmessage += '<?php echo $LNG->STATS_OVERVIEW_VIEWING_LAST; ?>';
				viewingmessage += " "+lastcount.y+" ";
				viewingmessage += '<?php echo $LNG->STATS_OVERVIEW_VIEWING_VIEWS; ?>';
				viewingmessage += " "+formatDate(new Date(lastcount.x));

				$('viewing-chart-message').update(viewingmessage);

				$('messagearea').update("");
				$("overview-group-div").style.display = "block";

			} else {
				$('messagearea').innerHTML="<?php echo $LNG->NETWORKMAPS_NO_RESULTS_MESSAGE; ?>";
				toolbar.style.display = 'none';
			}
		}
	});
}

Event.observe(window, 'load', function() {
	loadOverviewData();
});
</script>

<div id="messagearea" style="width:100%;float:left;clear:both;"></div>

<div id="overview-group-div" style="float:left;height:100%;width:100%;display:none">
	<div id="health-indicators" style="width:100%;float:left;clear:both;padding:5px;">
		<?php if ($withtitle) { ?>
		<h1><?php echo $LNG->STATS_OVERVIEW_HEALTH_TITLE; ?></h1>
		<?php } ?>

		<div class="boxshadowsquare" id='health-participation' style="float:left;width:290px;height:180px;margin-right:10px">
			<div>
				<b><?php echo $LNG->STATS_OVERVIEW_HEALTH_PARTICIPATION_TITLE; ?></b>
				<span class="active" onMouseOver="showGlobalHint('StatsOverviewParticipation', event, 'hgrhint'); return false;" onMouseOut="hideHints(); return false;" onClick="hideHints(); return false;" onkeypress="enterKeyPressed(event)"><img src="<?php echo $HUB_FLM->getImagePath('info.png'); ?>" border="0" style="margin-top: 2px; margin-left: 5px;" /></span>
			</div>
			<div id='health-participation-trafficlight' class="trafficlight">
				<span id='health-participation-red' class="trafficlightred"></span>
				<span id='health-participation-orange' class="trafficlightorange"></span>
				<span id='health-participation-green' class="trafficlightgreen"></span>
			</div>
			<div style="float:left;width:220px;margin-left:5px;margin-top:10px;">
				<b><span id="health-participation-count"></span></b> <span id='health-participation-message'></span><br><br>
			</div>
			<div style="clear:both;float:left;" id='health-participation-recomendation'></div>
		</div>

		<div class="boxshadowsquare" id='health-viewing' style="float:left;width:290px;height:180px;margin-right:10px">
			<div>
				<b><?php echo $LNG->STATS_OVERVIEW_HEALTH_VIEWING_TITLE; ?></b>
				<span class="active" onMouseOver="showGlobalHint('StatsOverviewViewing', event, 'hgrhint'); return false;" onMouseOut="hideHints(); return false;" onClick="hideHints(); return false;" onkeypress="enterKeyPressed(event)"><img src="<?php echo $HUB_FLM->getImagePath('info.png'); ?>" border="0" style="margin-top: 2px; margin-left: 5px;" /></span>
			</div>
			<div id='health-viewing-trafficlight' class="trafficlight">
				<span id='health-viewing-red' class="trafficlightred"></span>
				<span id='health-viewing-orange' class="trafficlightorange"></span>
				<span id='health-viewing-green' class="trafficlightgreen"></span>
			</div>
			<div style="float:left;width:220px;margin-left:5px;margin-top:10px;">
				<div id="health-viewingorange-div" style="display:none">
					<b><span id="health-viewingpeople-orange-count"></span></b> <span id='health-viewing-messageorange'></span>
					<b> <span id="health-viewingitem-orange-count"></span></b> <span id='health-viewing-messageorange-part2'></span>
				</div>
				<div id="health-viewing-spacer" style="height:10px;display:none"></div>
				<div id="health-viewinggreen-div" style="display:none">
					<b><span id="health-viewingpeople-green-count"></span></b> <span id='health-viewing-messagegreen'><?php echo $LNG->STATS_OVERVIEW_HEALTH_VIEWERS; ?></span>
					<b> <span id="health-viewingitem-green-count"></span></b> <span id='health-viewing-messagegreen-part2'></span>
				</div>
			</div>
			<div style="clear:both;float:left;" id='health-viewing-recomendation'></div>
		</div>

		<div class="boxshadowsquare" id='health-debate' style="float:left;width:290px;height:180px;">
			<div>
				<b><?php echo $LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION_TITLE; ?></b>
				<span class="active" onMouseOver="showGlobalHint('StatsOverviewDebate', event, 'hgrhint'); return false;" onMouseOut="hideHints(); return false;" onClick="hideHints(); return false;" onkeypress="enterKeyPressed(event)"><img src="<?php echo $HUB_FLM->getImagePath('info.png'); ?>" border="0" style="margin-top: 2px; margin-left: 5px;" /></span>
			</div>
			<div class="trafficlight">
				<span id='health-debate-red' class="trafficlightred"></span>
				<span id='health-debate-orange' class="trafficlightorange"></span>
				<span id='health-debate-green' class="trafficlightgreen"></span>
			</div>
			<div style="float:left;width:220px;margin-left:5px;margin-top:10px;">
				<div id="health-debateorange-div" style="display:none">
					<b><span id="health-debatepeople-orange-count"></span></b> <span id='health-debate-messageorange'></span>
					<b> <span id="health-debateitem-orange-count"></span></b> <span id='health-debate-messageorange-part2'></span>
				</div>
				<div id="health-debate-spacer" style="height:10px;display:none"></div>
				<div id="health-debategreen-div" style="display:none">
					<b><span id="health-debatepeople-green-count"></span></b> <span id='health-debate-messagegreen'></span>
					<b> <span id="health-debateitem-green-count"></span></b> <span id='health-debate-messagegreen-part2'></span>
				</div>
			</div>
			<div style="clear:both;float:left;" id='health-debate-recomendation'></div>
		</div>
	</div>

	<div id="overviewarea" style="width:100%;float:left;clear:both;padding:5px;">
		<h1><?php echo $LNG->STATS_OVERVIEW_MAIN_TITLE; ?></h1>

		<div class="boxshadowsquare" style="float:left;clear:both;">
			<div style="float:left;width:300px;margin-top:10px;"><?php echo $LNG->STATS_OVERVIEW_CONTRIBUTION_MESSAGE; ?></div>
			<div id="contribution-chart" style="float:left;width:320px;height:100px;"></div>
			<div id="contribution-chart-message" style="float:left;width:317px;"></div>
		</div>

		<div class="boxshadowsquare" style="margin-top:10px;float:left;clear:both;">
			<div style="float:left;width:270px;margin-top:10px;"><?php echo $LNG->STATS_OVERVIEW_VIEWING_MESSAGE; ?></div>
			<div id="viewing-chart" style="float:left;width:400px;height:100px;"></div>
			<div id="viewing-chart-message" style="float:left;width:267px;">
			</div>
		</div>

		<div class="boxshadowsquare" id="topvoteddiv" style="display:block;margin-top:10px;float:left;clear:both;">
			<div style="float:left;width:300px;margin-top:10px;"><?php echo $LNG->STATS_OVERVIEW_TOP_THREE_VOTES_MESSAGE; ?></div>
			<div id="topvotedlist" style="float:left;width:637px"></div>
		</div>

		<div class="boxshadowsquare" id="recentvoteddiv" style="display:block;margin-top:10px;float:left;clear:both;">
			<div style="float:left;width:300px;margin-top:10px;"><?php echo $LNG->STATS_OVERVIEW_RECENT_VOTES_MESSAGE; ?></div>
			<div id="recentvotedlist" style="float:left;width:637px"></div>
		</div>

		<div class="boxshadowsquare" id="latestnodesdiv" style="display:block;margin-top:10px;float:left;clear:both;">
			<div style="float:left;width:300px;margin-top:10px;"><?php echo $LNG->STATS_OVERVIEW_RECENT_NODES_MESSAGE; ?></div>
			<div id="latestnodeslist" style="float:left;width:637px"></div>
		</div>

		<div class="boxshadowsquare" id="average-words" style="margin-top:10px;float:left;clear:both;">
			<div style="float:left;width:300px;"><?php echo $LNG->STATS_OVERVIEW_WORDS_MESSAGE; ?></div>
			<div style="float:left;width:637px">
				<span><?php echo $LNG->STATS_OVERVIEW_WORDS_AVERAGE; ?> <b><span id="average-words-count">0</span></b> <?php echo $LNG->STATS_OVERVIEW_WORDS; ?></span>
				<span style="padding-left:20px;"><?php echo $LNG->STATS_OVERVIEW_WORDS_MIN; ?> <b><span id="min-words-count">0</span></b> <?php echo $LNG->STATS_OVERVIEW_WORDS; ?></span>
				<span style="padding-left:20px;"><?php echo $LNG->STATS_OVERVIEW_WORDS_MAX; ?> <b><span id="max-words-count">0</span></b> <?php echo $LNG->STATS_OVERVIEW_WORDS; ?></span>
			</div>
		</div>
	</div>
</div>

<?php
if ($dashboard) {
	include_once($HUB_FLM->getCodeDirPath("ui/footerdashboard.php"));
} else {
	include_once($HUB_FLM->getCodeDirPath("ui/footerembed.php"));
}
?>