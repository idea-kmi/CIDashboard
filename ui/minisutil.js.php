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
header('Content-Type: text/javascript;');
include_once(__DIR__ . '/../config.php');

?>

function loadUserContributionData(url, timeout, withPosts, withVotes) {

	$('contribution-messagearea').update(getLoading("<?php echo $LNG->LOADING_MESSAGE; ?>"));

	var args = {}; //must be an empty object to send down the url, or all the Array functions get sent too.
	args["url"] = url;
	args["withposts"] = withPosts;
	args["withvotes"] = withVotes;
	args["timeout"] = timeout;

	var reqUrl = SERVICE_ROOT + "&method=getminiusercontributions&" + Object.toQueryString(args);
	//alert(reqUrl);
	new Ajax.Request(reqUrl, { method:'post',
		onSuccess: function(transport){
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

			var data = json.usercontributions[0];
			if (data.contributorcount > 0) {

				var contributorCount = parseInt(data.contributorcount);
				var contributionTypes = data.contributiontypes[0];
				var totalvotes = parseInt(data.totalvotes);
				var contributionsArray = new Array();

				var person = contributorCount == 1 ? '<?php echo $LNG->STATS_OVERVIEW_PERSON; ?>' :'<?php echo $LNG->STATS_OVERVIEW_PEOPLE; ?>';
				var message = '<b>'+contributorCount+'</b> '+person+' '+'<?php echo $LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION; ?>';
				var innermessage = "";
				var contributionCount = 0;
				for (var property in contributionTypes) {
				    if (contributionTypes.hasOwnProperty(property)) {
				    	var nextcount = contributionTypes[property];
				    	contributionCount += parseInt(nextcount);
				    	var next = {"label":getNodeTitleAntecedence(property, false), "value":nextcount};
				        contributionsArray.push(next);
				        innermessage += next.label+": "+next.value+"; ";
				    }
				}

				if (args["withvotes"] && totalvotes > 0) {
					contributionCount += totalvotes;
					contributionsArray.push({"label":'<?php echo $LNG->STATS_OVERVIEW_VOTES;?>', "value":totalvotes});
					innermessage += '<?php echo $LNG->STATS_OVERVIEW_VOTES;?>'+' '+totalvotes;
				}

				var contributionsObj = {key:"types", values:contributionsArray};
				simpleBarChartTypes($('contribution-chart'), new Array(contributionsObj), 300,90);

				var itemname = contributionCount == 1 ? '<?php echo $LNG->STATS_OVERVIEW_TIME; ?>' : '<?php echo $LNG->STATS_OVERVIEW_TIMES; ?>';
				message += ' <b>'+(contributionCount)+'</b> '+itemname+':<br>';

				$('contribution-chart-message').update(message+innermessage);

				$('contribution-messagearea').update("");
				$("contribution-chart-div").style.display = "block";

			} else {
				$('contribution-messagearea').innerHTML="<?php echo $LNG->NETWORKMAPS_NO_RESULTS_MESSAGE; ?>";
			}
		}
	});
}

function loadUserViewingData(url, timeout, withPosts) {

	$('viewing-messagearea').update(getLoading("<?php echo $LNG->LOADING_MESSAGE; ?>"));

	var args = {}; //must be an empty object to send down the url, or all the Array functions get sent too.
	args["url"] = url;
	args["withposts"] = withPosts;
	args["timeout"] = timeout;

	var reqUrl = SERVICE_ROOT + "&method=getminiuserviewings&" + Object.toQueryString(args);
	console.log(reqUrl);

	new Ajax.Request(reqUrl, { method:'post',
		onSuccess: function(transport){
			//console.log(transport.responseText);

			var json = null;
			try {
				json = transport.responseText.evalJSON();
				console.log(json);
			} catch(e) {
				alert(e);
			}
			if(json.error){
				alert(json.error[0].message);
				return;
			}
			var data = json.userviewings[0];
			//console.log(data);

			if (data.viewdatearray.length > 0) {

				var viewDateArray = data.viewdatearray[0];

				var formatDate = d3.time.format("%e %b %y");
				var sparklineData = new Array();
				var hightesviews = 0;
				var hightesviewsdate = 0;
				var lowestviews = 0;
				var lowestviewsdate = 0;

				for (var property in viewDateArray) {
				    if (viewDateArray.hasOwnProperty(property)) {
				    	var countdate = parseInt(property)*1000;
				    	var viewcount = parseInt(viewDateArray[property]);
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

				sparklineDateNVD3($('viewing-chart'), sparklineData, 300, 90);

				var viewingmessage = '<?php echo $LNG->MINI_USER_VIEWING_HIGHEST; ?>';
				viewingmessage += " <b>"+hightesviews+"</b> ";
				//viewingmessage += '<?php echo $LNG->MINI_USER_VIEWING_VIEWS; ?>';
				viewingmessage += '<?php echo $LNG->MINI_USER_VIEWING_ON; ?> '+formatDate(new Date(hightesviewsdate))+'<br>';

				viewingmessage += '<?php echo $LNG->MINI_USER_VIEWING_LOWEST; ?>';
				viewingmessage += " <b>"+lowestviews+"</b> ";
				//viewingmessage += '<?php echo $LNG->MINI_USER_VIEWING_VIEWS; ?>';
				viewingmessage += '<?php echo $LNG->MINI_USER_VIEWING_ON; ?> '+formatDate(new Date(lowestviewsdate))+'<br>';

				viewingmessage += '<?php echo $LNG->MINI_USER_VIEWING_LAST; ?>';
				viewingmessage += " <b>"+lastcount.y+"</b> ";
				//viewingmessage += '<?php echo $LNG->MINI_USER_VIEWING_VIEWS; ?>';
				viewingmessage += '<?php echo $LNG->MINI_USER_VIEWING_ON; ?> '+formatDate(new Date(lastcount.x));

				$('viewing-chart-message').update(viewingmessage);

				$('viewing-messagearea').update("");
				$("viewing-chart-div").style.display = "block";

			} else {
				$('viewing-messagearea').innerHTML="<?php echo $LNG->NETWORKMAPS_NO_RESULTS_MESSAGE; ?>";
			}
		}
	});
}

function loadHealthParticipationData(url, timeout, withPosts) {
	$('healthparticipation-messagearea').update(getLoading("<?php echo $LNG->LOADING_MESSAGE; ?>"));

	var args = {}; //must be an empty object to send down the url, or all the Array functions get sent too.
	args["url"] = url;
	args["withposts"] = withPosts;
	args["timeout"] = timeout;

	var reqUrl = SERVICE_ROOT + "&method=getminihealthparticipation&" + Object.toQueryString(args);

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

			var data = json.healthparticipation[0];
			//alert("data:"+data.toSource());
			if (data.peoplecount) {
				var userNodeCount = data.peoplecount
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

				$('healthparticipation-messagearea').update("");
				$('health-participation-div').style.display = "block";

			} else {
				$('healthparticipation-messagearea').innerHTML="<?php echo $LNG->NETWORKMAPS_NO_RESULTS_MESSAGE; ?>";
			}
		}
	});
}


function loadHealthViewingData(url, timeout, withPosts) {
	$('healthviewing-messagearea').update(getLoading("<?php echo $LNG->LOADING_MESSAGE; ?>"));

	var args = {}; //must be an empty object to send down the url, or all the Array functions get sent too.
	args["url"] = url;
	args["withposts"] = withPosts;
	args["timeout"] = timeout;

	var reqUrl = SERVICE_ROOT + "&method=getminihealthviewing&" + Object.toQueryString(args);
	//alert(reqUrl);

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

			var data = json.healthviewing[0];
			//alert("data:"+data.toSource());
			if (data.peoplegreencount) {
				var peoplegreencount = data.peoplegreencount;
				var peopleorangecount = data.peopleorangecount;
				var orangecount = data.orangecount;
				var greencount = data.greencount;

				var peoplecount = peoplegreencount+peopleorangecount;

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

				$('healthviewing-messagearea').update("");
				$('health-viewing-div').style.display = "block";

			} else {
				$('healthviewing-messagearea').innerHTML="<?php echo $LNG->NETWORKMAPS_NO_RESULTS_MESSAGE; ?>";
			}
		}
	});
}

function loadHealthContributionData(url, timeout, withPosts) {
	$('healthcontribution-messagearea').update(getLoading("<?php echo $LNG->LOADING_MESSAGE; ?>"));

	var args = {}; //must be an empty object to send down the url, or all the Array functions get sent too.
	args["url"] = url;
	args["withposts"] = withPosts;
	args["withvotes"] = true;
	args["timeout"] = timeout;

	var reqUrl = SERVICE_ROOT + "&method=getminihealthcontribution&" + Object.toQueryString(args);
	//alert(reqUrl);

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

			var data = json.healthcontribution[0];
			//alert("data:"+data.toSource());
			if (data.peoplegreencount) {
				var peoplegreencount = data.peoplegreencount;
				var peopleorangecount = data.peopleorangecount;
				var orangecount = data.orangecount;
				var greencount = data.greencount;

				var peoplecount = peoplegreencount+peopleorangecount;

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

				$('healthcontribution-messagearea').update("");
				$('health-contribution-div').style.display = 'block';

			} else {
				$('healthcontribution-messagearea').innerHTML="<?php echo $LNG->NETWORKMAPS_NO_RESULTS_MESSAGE; ?>";
			}
		}
	});
}

function loadWordStatsData(url, timeout, withPosts) {

	$('wordstats-messagearea').update(getLoading("<?php echo $LNG->LOADING_MESSAGE; ?>"));

	var args = {}; //must be an empty object to send down the url, or all the Array functions get sent too.
	args["url"] = url;
	args["withposts"] = withPosts;
	args["withvotes"] = false;
	args["timeout"] = timeout;

	var reqUrl = SERVICE_ROOT + "&method=getminiwordstats&" + Object.toQueryString(args);
	//alert(reqUrl);

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

			var data = json.wordstats[0];
			//alert("data:"+data.toSource());
			if (data) {
				var wordsByUser = data.wordsByUser[0];

				var innermessage = "";
				var contributionCount = 0;
				var contributionsArray = new Array();

				for (property in wordsByUser) {
				    if (wordsByUser.hasOwnProperty(property)) {
				    	var nextcount = wordsByUser[property];
				    	contributionCount += parseInt(nextcount);
				    	var next = {"label":property, "value":nextcount};
				        contributionsArray.push(next);
				        innermessage += next.label+": "+next.value+"; ";
				    }
				}
				var contributionsObj = {key:"types", values:contributionsArray};

				simpleBarChartUsers($('wordstats-chart'), new Array(contributionsObj), 300,90);

				var minWordCount = parseInt(data.minWordCount);
				var maxWordCount = parseInt(data.maxWordCount);
				var totalWordCount = parseInt(data.totalWordCount);

				var userNodeCount = parseInt(data.contributorCount);

				var averageWordCount = 0;
				if (userNodeCount != 0) {
					averageWordCount = parseInt(totalWordCount/userNodeCount);
				}

				$('average-words-count').update(averageWordCount);
				$('min-words-count').update(minWordCount);
				$('max-words-count').update(maxWordCount);

				$('wordstats-messagearea').update("");
				$('wordstats-div').style.display = 'block';

			} else {
				$('wordstats-messagearea').innerHTML="<?php echo $LNG->NETWORKMAPS_NO_RESULTS_MESSAGE; ?>";
			}
		}
	});
}

function loadAlertsData(url, timeout, alerts, userids, userunobfuscationdata) {

	var ALERT_COUNT = 2;

	$('alerts-messagearea').update(getLoading("<?php echo $LNG->LOADING_MESSAGE; ?>"));

	var args = {}; //must be an empty object to send down the url, or all the Array functions get sent too.
	args["url"] = url;
	args["timeout"] = timeout;
	args["alerts"] = alerts;
	args["userids"] = userids;

	var reqUrl = SERVICE_ROOT + "&method=getminialerts&" + Object.toQueryString(args);
	//alert(reqUrl);

	new Ajax.Request(reqUrl, { method:'post',
		onSuccess: function(transport){
			//alert("HERE"+transport.responseText);

			var json = null;
			try {
				json = transport.responseText.evalJSON();
			} catch(e) {
				$('alerts-messagearea').innerHTML="<?php echo $LNG->NETWORKMAPS_NO_RESULTS_MESSAGE; ?>";
			}
			if(json.error){
				$('alerts-messagearea').innerHTML="<?php echo $LNG->NETWORKMAPS_NO_RESULTS_MESSAGE; ?>";
			}

			var data = json.alertdata[0];
			//alert(data.toSource());
			if (data && (data.alertarray.length > 0 || data.userarray.length > 0)) {
				var alertarray = data.alertarray[0];
				var userarray = data.userarray[0];
				//alert(userarray.toSource());

				var nodealertDiv = $('alerts-issue-div');
				var useralertDiv = $('alerts-user-div');

				// Process Users
				var usersDataArray = new Array();
				if (data.users) {
					var userObj = data.users[0];
					var userSet = userObj.userset;
					var users = userSet.users;
					for (user in users) {
						if (users[user].user) {
							var cuser = users[user].user;
							if (cuser.profileid) {
								usersDataArray[cuser.profileid] = cuser;
							} else {
								usersDataArray[cuser.userid] = cuser;
							}
						}
					}
				}

				// Process Nodes
				var nodesArray = new Array();
				if (data.nodes) {
					var nodesObj = data.nodes[0];
					var nodeSet = nodesObj.nodeset;
					var nodes = nodeSet.nodes;
					for (node in nodes) {
						if (nodes[node].cnode) {
							var cnode = nodes[node].cnode;
							nodesArray[cnode.nodeid] = cnode;
						}
					}
				}

				// process user specific alerts
				var n=0;
				for (userid in userarray) {
					if (userarray.hasOwnProperty(userid)) {
						var user = usersDataArray[userid];
						user = unobfuscateUser(user);

						var	heading = new Element('h2', {'style':'padding-top:5px;padding-bottom:5px;font-size:13pt;background:#E8E8E8'});
						if (n > 0) {
							heading.style.marginTop = "15px";
						}
						n++;
						if (user.homepage && user.homepage != "") {
							heading.insert('<a href="'+user.homepage+'" target="_blank">'+user.name+'</a>');
						} else {
							heading.insert(user.name);
						}
						useralertDiv.insert(heading);

						var alertTypes = userarray[userid][0];
						var i=0;
						for (alerttype in alertTypes) {
							if (alertTypes.hasOwnProperty(alerttype)) {
								var alertName = getAlertName(alerttype);
								var	title = new Element('div', {'title':getAlertHint(alerttype), 'style':'font-weight:bold;border-top:1px solid #E8E8E8;font-size:12pt;margin:0px;padding:0px;'});
								title.insert(alertName);
								var countspan = new Element('span', {'id':'titlecount'+i, 'style':'font-size:10pt; font-weight:normal; padding-left:5px;'});
								title.insert(countspan);
								if (i > 0) {
									title.style.marginTop = '10px';
								} else {
									title.style.marginTop = '0px';
								}
								useralertDiv.insert(title);
								i++;
								//var title='<span style="margin-top:0px;font-weight:bold" title="'+getAlertHint(alerttype)+'">'+alertName+':</span>';
								var posts = alertTypes[alerttype][0];
								var k=0;
								for (post in posts) {
									if (posts.hasOwnProperty(post)) {
										k++;
										var display = 'block';
										if (k>ALERT_COUNT) {
											display = 'none';
										}
										var postid = posts[post];
										if (nodesArray[postid]) {
											var node = nodesArray[postid];
											createAlertNodeLink(alerttype, postid, node, useralertDiv, display);
										} else if (usersDataArray[postid]) {
											var inneruser = usersDataArray[postid];
											inneruser = unobfuscateUser(inneruser);
											createAlertUserLink(alerttype, postid, inneruser, useralertDiv, display);
										}
									}
								}
								countspan.insert("("+k+")");
								if (k>ALERT_COUNT) {
									var morebutton = new Element('span', {'class':'active','style':'color:#A6156C;margin-bottom:10px;'});
									morebutton.insert('<?php echo $LNG->ALERT_SHOW_ALL; ?>');
									morebutton.alerttype = alerttype;
									Event.observe(morebutton,"click", function(){
										toggleAlertPosts(this, this.alerttype);
									});
									useralertDiv.insert(morebutton);
								}
							}
						}
					}
				}

				// process map specific alerts
				var i=0;
				for (alerttype in alertarray) {
					if (alertarray.hasOwnProperty(alerttype)) {
						//alert(alerttype);
						i++;
						var alertName = getAlertName(alerttype);
						var	title = new Element('div', {'title':getAlertHint(alerttype), 'style':'font-weight:bold;border-top:1px solid #E8E8E8;font-size:12pt'});
						title.insert(alertName);
						var countspan = new Element('span', {'id':'titlecount'+i, 'style':'font-size:10pt; font-weight:normal; padding-left:5px;'});
						title.insert(countspan);
						if (i > 0) {
							title.style.marginTop = '10px';
						} else {
							title.style.marginTop = '0px';
						}
						nodealertDiv.insert(title);
						var posts = alertarray[alerttype][0];
						var k=0;
						for (post in posts) {
							if (posts.hasOwnProperty(post)) {
								k++;
								var display = 'block';
								if (k>ALERT_COUNT) {
									display = 'none';
								}
								var postid = posts[post];
								if (nodesArray[postid]) {
									var node = nodesArray[postid];
									createAlertNodeLink(alerttype, postid, node, nodealertDiv, display);
								} else if (usersDataArray[postid]) {
									var inneruser = usersDataArray[postid];
									inneruser = unobfuscateUser(inneruser);
									createAlertUserLink(alerttype, postid, inneruser, nodealertDiv, display);
								}
							}
						}
						countspan.insert("("+k+")");
						if (k>ALERT_COUNT) {
							var morebutton = new Element('div', {'class':'active','style':'color:#A6156C;margin-top:5px;margin-bottom:10px;'});
							morebutton.insert('<?php echo $LNG->ALERT_SHOW_ALL; ?>');
							morebutton.alerttype = alerttype;
							Event.observe(morebutton,"click", function(){
								toggleAlertPosts(this, this.alerttype);
							});
							nodealertDiv.insert(morebutton);
						}
					}
				}

				$('alerts-messagearea').innerHTML="";
			} else {
				$('alerts-messagearea').innerHTML="<?php echo $LNG->NETWORKMAPS_NO_RESULTS_MESSAGE; ?>";
			}
		}
	});
}


/**** HELP FUNCTIONS ****/
function createAlertNodeLink(alerttype, postid, node, container, display) {
	var name = node.name;
	var type = alerttype.replace(/ /g,'');
	var id = 'post';
	if (display == 'none') {
		id = type;
	}

	var nodespan = new Element('div', {'name':id, 'class':'active', 'style':'display:'+display+';padding-top:10px;'});

	var role = node.role[0].role;
	var alttext = getNodeTitleAntecedence(role.name, false);
	if (role.image != null && role.image != "") {
		var nodeicon = new Element('img',{'alt':alttext, 'title':alttext, 'style':'width:16px;height:16px;padding-top:6px;padding-right:5px;','border':'0','src': URL_ROOT + role.image});
		nodespan.insert(nodeicon);
	}

	var desc = "";
	if (node.desc) {
		desc = node.desc;
	}

	if (node.homepage && node.homepage != "") {
		nodespan.insert('<a style="display:inline" target="_blank" title="'+desc+'" href="'+node.homepage+'">'+name+'</a><br>');
	} else {
		nodespan.insert('<span style="pading-left:10px"><span title="'+desc+'">'+name+'</span></span><br>');
	}

	container.insert(nodespan);
}

function createAlertUserLink(alerttype, postid, inneruser, container, display) {
	if (inneruser.name == 'Unknown User') {
		return;
	}
	var type = alerttype.replace(/ /g,'');
	var id = 'post';
	if (display == 'none') {
		id = type;
	}

	var nodespan = new Element('div', {'name':id, 'style':'display:'+display+';padding-top:10px;'});

	var username = inneruser.name;
	if (inneruser.homepage && inneruser.homepage != "") {
		nodespan.insert('<a href="'+inneruser.homepage+'" target="_blank">'+username+'</a>');
	} else {
		nodespan.insert('<span style="display:inline">'+username+'</span>');
	}
	container.insert(nodespan);
}

function toggleAlertPosts(obj, alerttype) {
	var type = alerttype.replace(/ /g,'');
	var items = document.getElementsByName(type);
	for (var i=0; i<items.length; i++) {
		var item = items[i];
		if (item.style.display == 'none') {
			item.style.display = 'block';
			obj.update('<?php echo $LNG->ALERT_SHOW_LESS; ?>');
		} else {
			item.style.display = 'none';
			obj.update('<?php echo $LNG->ALERT_SHOW_ALL; ?>');
		}
	}
}

function getAlertName(alert) {
	var alertName = alert;
	switch(alert) {
		case '<?php echo $CFG->ALERT_UNSEEN_BY_ME; ?>':
			alertName = '<?php echo addslashes($LNG->ALERT_UNSEEN_BY_ME); ?>';
			break;
		case '<?php echo $CFG->ALERT_RESPONSE_TO_ME; ?>':
			alertName = '<?php echo addslashes($LNG->ALERT_RESPONSE_TO_ME); ?>';
			break;
		case '<?php echo $CFG->ALERT_UNRATED_BY_ME; ?>':
			alertName = '<?php echo addslashes($LNG->ALERT_UNRATED_BY_ME); ?>';
			break;
		case '<?php echo $CFG->ALERT_LURKING_USER; ?>':
			alertName = '<?php echo addslashes($LNG->ALERT_LURKING_USER); ?>';
			break;
		case '<?php echo $CFG->ALERT_INACTIVE_USER; ?>':
			alertName = '<?php echo addslashes($LNG->ALERT_INACTIVE_USER); ?>';
			break;
		case '<?php echo $CFG->ALERT_USER_GONE_INACTIVE; ?>':
			alertName = '<?php echo addslashes($LNG->ALERT_USER_GONE_INACTIVE); ?>';
			break;
		case '<?php echo $CFG->ALERT_MATURE_ISSUE; ?>':
			alertName = '<?php echo addslashes($LNG->ALERT_MATURE_ISSUE); ?>';
			break;
		case '<?php echo $CFG->ALERT_IMMATURE_ISSUE; ?>':
			alertName = '<?php echo addslashes($LNG->ALERT_IMMATURE_ISSUE); ?>';
			break;
		case '<?php echo $CFG->ALERT_IGNORED_POST; ?>':
			alertName = '<?php echo addslashes($LNG->ALERT_IGNORED_POST); ?>';
			break;
		case '<?php echo $CFG->ALERT_INTERESTING_TO_ME; ?>':
			alertName = '<?php echo addslashes($LNG->ALERT_INTERESTING_TO_ME); ?>';
			break;
		case '<?php echo $CFG->ALERT_INTERESTING_TO_PEOPLE_LIKE_ME; ?>':
			alertName = '<?php echo addslashes($LNG->ALERT_INTERESTING_TO_PEOPLE_LIKE_ME); ?>';
			break;
		case '<?php echo $CFG->ALERT_SUPPORTED_BY_PEOPLE_LIKE_ME; ?>':
			alertName = '<?php echo addslashes($LNG->ALERT_SUPPORTED_BY_PEOPLE_LIKE_ME); ?>';
			break;
		case '<?php echo $CFG->ALERT_HOT_POST; ?>':
			alertName = '<?php echo addslashes($LNG->ALERT_HOT_POST); ?>';
			break;
		case '<?php echo $CFG->ALERT_ORPHANED_IDEA; ?>':
			alertName = '<?php echo addslashes($LNG->ALERT_ORPHANED_IDEA); ?>';
			break;
		case '<?php echo $CFG->ALERT_EMERGING_WINNER; ?>':
			alertName = '<?php echo addslashes($LNG->ALERT_EMERGING_WINNER); ?>';
			break;
		case '<?php echo $CFG->ALERT_CONTENTIOUS_ISSUE; ?>':
			alertName = '<?php echo addslashes($LNG->ALERT_CONTENTIOUS_ISSUE); ?>';
			break;
		case '<?php echo $CFG->ALERT_CONTROVERSIAL_IDEA; ?>':
			alertName = '<?php echo addslashes($LNG->ALERT_CONTROVERSIAL_IDEA); ?>';
			break;
		case '<?php echo $CFG->ALERT_INCONSISTENT_SUPPORT; ?>':
			alertName = '<?php echo addslashes($LNG->ALERT_INCONSISTENT_SUPPORT); ?>';
			break;
		case '<?php echo $CFG->ALERT_PEOPLE_WITH_INTERESTS_LIKE_MINE; ?>':
			alertName = '<?php echo addslashes($LNG->ALERT_PEOPLE_WITH_INTERESTS_LIKE_MINE); ?>';
			break;
		case '<?php echo $CFG->ALERT_PEOPLE_WHO_AGREE_WITH_ME; ?>':
			alertName = '<?php echo addslashes($LNG->ALERT_PEOPLE_WHO_AGREE_WITH_ME); ?>';
			break;
		case '<?php echo $CFG->ALERT_WELL_EVALUATED_IDEA; ?>':
			alertName = '<?php echo addslashes($LNG->ALERT_WELL_EVALUATED_IDEA); ?>';
			break;
		case '<?php echo $CFG->ALERT_POORLY_EVALUATED_IDEA; ?>':
			alertName = '<?php echo addslashes($LNG->ALERT_POORLY_EVALUATED_IDEA); ?>';
			break;
		case '<?php echo $CFG->ALERT_RATING_IGNORED_ARGUMENT; ?>':
			alertName = '<?php echo addslashes($LNG->ALERT_RATING_IGNORED_ARGUMENT); ?>';
			break;
		case '<?php echo $CFG->ALERT_UNSEEN_RESPONSE; ?>':
			alertName = '<?php echo addslashes($LNG->ALERT_UNSEEN_RESPONSE); ?>';
			break;
		case '<?php echo $CFG->ALERT_UNSEEN_COMPETITOR; ?>':
			alertName = '<?php echo addslashes($LNG->ALERT_UNSEEN_COMPETITOR); ?>';
			break;
		case '<?php echo $CFG->ALERT_USER_IGNORED_COMPETITORS; ?>':
			alertName = '<?php echo addslashes($LNG->ALERT_USER_IGNORED_COMPETITORS); ?>';
			break;
		case '<?php echo $CFG->ALERT_USER_IGNORED_ARGUMENTS; ?>':
			alertName = '<?php echo addslashes($LNG->ALERT_USER_IGNORED_ARGUMENTS); ?>';
			break;
		case '<?php echo $CFG->ALERT_USER_IGNORED_RESPONSES; ?>':
			alertName = '<?php echo addslashes($LNG->ALERT_USER_IGNORED_RESPONSES); ?>';
			break;
	}
	return alertName;
}

function getAlertHint(alert) {
	var alertHint = "";
	switch(alert) {
		case '<?php echo $CFG->ALERT_UNSEEN_BY_ME; ?>':
			alertHint = '<?php echo addslashes($LNG->ALERT_HINT_UNSEEN_BY_ME); ?>';
			break;
		case '<?php echo $CFG->ALERT_RESPONSE_TO_ME; ?>':
			alertHint = '<?php echo addslashes($LNG->ALERT_HINT_RESPONSE_TO_ME); ?>';
			break;
		case '<?php echo $CFG->ALERT_UNRATED_BY_ME; ?>':
			alertHint = '<?php echo addslashes($LNG->ALERT_HINT_UNRATED_BY_ME); ?>';
			break;
		case '<?php echo $CFG->ALERT_LURKING_USER; ?>':
			alertHint = '<?php echo addslashes($LNG->ALERT_HINT_LURKING_USER); ?>';
			break;
		case '<?php echo $CFG->ALERT_INACTIVE_USER; ?>':
			alertHint = '<?php echo addslashes($LNG->ALERT_HINT_INACTIVE_USER); ?>';
			break;
		case '<?php echo $CFG->ALERT_USER_GONE_INACTIVE; ?>':
			alertHint = '<?php echo addslashes($LNG->ALERT_HINT_USER_GONE_INACTIVE); ?>';
			break;
		case '<?php echo $CFG->ALERT_MATURE_ISSUE; ?>':
			alertHint = '<?php echo addslashes($LNG->ALERT_HINT_MATURE_ISSUE); ?>';
			break;
		case '<?php echo $CFG->ALERT_IMMATURE_ISSUE; ?>':
			alertHint = '<?php echo addslashes($LNG->ALERT_HINT_IMMATURE_ISSUE); ?>';
			break;
		case '<?php echo $CFG->ALERT_IGNORED_POST; ?>':
			alertHint = '<?php echo addslashes($LNG->ALERT_HINT_IGNORED_POST); ?>';
			break;
		case '<?php echo $CFG->ALERT_INTERESTING_TO_ME; ?>':
			alertHint = '<?php echo addslashes($LNG->ALERT_HINT_INTERESTING_TO_ME); ?>';
			break;
		case '<?php echo $CFG->ALERT_INTERESTING_TO_PEOPLE_LIKE_ME; ?>':
			alertHint = '<?php echo addslashes($LNG->ALERT_HINT_INTERESTING_TO_PEOPLE_LIKE_ME); ?>';
			break;
		case '<?php echo $CFG->ALERT_SUPPORTED_BY_PEOPLE_LIKE_ME; ?>':
			alertHint = '<?php echo addslashes($LNG->ALERT_HINT_SUPPORTED_BY_PEOPLE_LIKE_ME); ?>';
			break;
		case '<?php echo $CFG->ALERT_HOT_POST; ?>':
			alertHint = '<?php echo addslashes($LNG->ALERT_HINT_HOT_POST); ?>';
			break;
		case '<?php echo $CFG->ALERT_ORPHANED_IDEA; ?>':
			alertHint = '<?php echo addslashes($LNG->ALERT_HINT_ORPHANED_IDEA); ?>';
			break;
		case '<?php echo $CFG->ALERT_EMERGING_WINNER; ?>':
			alertHint = '<?php echo addslashes($LNG->ALERT_HINT_EMERGING_WINNER); ?>';
			break;
		case '<?php echo $CFG->ALERT_CONTENTIOUS_ISSUE; ?>':
			alertHint = '<?php echo addslashes($LNG->ALERT_HINT_CONTENTIOUS_ISSUE); ?>';
			break;
		case '<?php echo $CFG->ALERT_CONTROVERSIAL_IDEA; ?>':
			alertHint = '<?php echo addslashes($LNG->ALERT_HINT_CONTROVERSIAL_IDEA); ?>';
			break;
		case '<?php echo $CFG->ALERT_INCONSISTENT_SUPPORT; ?>':
			alertHint = '<?php echo addslashes($LNG->ALERT_HINT_INCONSISTENT_SUPPORT); ?>';
			break;
		case '<?php echo $CFG->ALERT_PEOPLE_WITH_INTERESTS_LIKE_MINE; ?>':
			alertHint = '<?php echo addslashes($LNG->ALERT_HINT_PEOPLE_WITH_INTERESTS_LIKE_MINE); ?>';
			break;
		case '<?php echo $CFG->ALERT_PEOPLE_WHO_AGREE_WITH_ME; ?>':
			alertHint = '<?php echo addslashes($LNG->ALERT_HINT_PEOPLE_WHO_AGREE_WITH_ME); ?>';
			break;
		case '<?php echo $CFG->ALERT_WELL_EVALUATED_IDEA; ?>':
			alertHint = '<?php echo addslashes($LNG->ALERT_HINT_WELL_EVALUATED_IDEA); ?>';
			break;
		case '<?php echo $CFG->ALERT_POORLY_EVALUATED_IDEA; ?>':
			alertHint = '<?php echo addslashes($LNG->ALERT_HINT_POORLY_EVALUATED_IDEA); ?>';
			break;
		case '<?php echo $CFG->ALERT_RATING_IGNORED_ARGUMENT; ?>':
			alertHint = '<?php echo addslashes($LNG->ALERT_HINT_RATING_IGNORED_ARGUMENT); ?>';
			break;
		case '<?php echo $CFG->ALERT_UNSEEN_RESPONSE; ?>':
			alertHint = '<?php echo addslashes($LNG->ALERT_HINT_UNSEEN_RESPONSE); ?>';
			break;
		case '<?php echo $CFG->ALERT_UNSEEN_COMPETITOR; ?>':
			alertHint = '<?php echo addslashes($LNG->ALERT_HINT_UNSEEN_COMPETITOR); ?>';
			break;
		case '<?php echo $CFG->ALERT_USER_IGNORED_COMPETITORS; ?>':
			alertHint = '<?php echo addslashes($LNG->ALERT_HINT_USER_IGNORED_COMPETITORS); ?>';
			break;
		case '<?php echo $CFG->ALERT_USER_IGNORED_ARGUMENTS; ?>':
			alertHint = '<?php echo addslashes($LNG->ALERT_HINT_USER_IGNORED_ARGUMENTS); ?>';
			break;
		case '<?php echo $CFG->ALERT_USER_IGNORED_RESPONSES; ?>':
			alertHint = '<?php echo addslashes($LNG->ALERT_HINT_USER_IGNORED_RESPONSES); ?>';
			break;
	}
	return alertHint;
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
