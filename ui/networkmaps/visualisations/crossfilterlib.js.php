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
require_once('../../../config.php');
?>

/*
"date" => $date,
"type" => $changetype,
"nodeid" => $node->nodeid,
"title" => $node->name,
"nodetype" => $node->role->name,
*/

function displayActivityCrossFilterD3Vis(data, width) {

	var activityChart = dc.barChart("#date-chart");
	//var activitySelectorChart = dc.barChart("#date-selector-chart");
	//var monthChart = dc.rowChart("#month-chart");
	var dayOfWeekChart = dc.rowChart("#days-of-week-chart");
	var itemTypeChart = dc.rowChart("#nodetype-chart");
	var activityTypeChart = dc.rowChart("#type-chart");
	var activityTableList = dc.dataTable("#data-table");

	var formatDateGroup = d3.time.format("%B %Y");
	var formatDate = d3.time.format("%B %d, %Y");
	var formatTime = d3.time.format("%a %d %b %I:%M %p");

	data.forEach(function(d, i) {
		d.index = i;
		d.date = new Date(d.date*1000);
	});

	var activities = crossfilter(data);
	var all = activities.groupAll();

	/*** MAIN DATE CHART ***/
	var date = activities.dimension(function(d) { return d.date; });
	var dates = date.group(d3.time.day);
	var datesselect = date.group(d3.time.day);

	// Get date start and end dates - range
	var strmDateAccessor = function (d){return d.date;};
	strmDateExtent = [];
	strmDateExtent = d3.extent(data, strmDateAccessor);

	var x = d3.time.scale()
    	.domain([d3.time.day.offset(strmDateExtent[0], -1), strmDateExtent[1]])
    	.rangeRound([0, width-80]);

	activityChart
		.width(width)
		.height(200)
		.transitionDuration(500)
		.margins({top: 10, right: 40, bottom: 20, left: 40})
		.dimension(date)
		.x(x)
		.round(d3.time.day.round)
		.xUnits(d3.time.days)
		.elasticY(true)
		.elasticX(false)
		.renderHorizontalGridLines(true)
		.renderVerticalGridLines(false)
		.brushOn(true)
		.group(dates)
		.yAxisPadding(0)
		.xAxisPadding(2)
		.title(function(d) { return d.value; })
		.mouseZoomable(false)
		.renderTitle(true)
		.centerBar(false)
		;

	//	.rangeChart(activitySelectorChart)
	//	.renderArea(true)
	//	.mouseZoomable(true)
	//.centerBar(true)

    /*activitySelectorChart
		.width(width)
        .height(60)
		.margins({top: 10, right: 0, bottom: 20, left: 0})
        .dimension(date)
        .group(datesselect)
        .centerBar(true)
		.gap(1)
		.x(x)
		.round(d3.time.month.round)
		.xUnits(d3.time.months)
		.mouseZoomable(false)
		.brushOn(true)
		;
	*/
	//	.mouseZoomable(false)
   //     .alwaysUseRounding(true)

	/*** MONTH OF WEEK ***/
	/*var monthFilter = activities.dimension(function (d) {
		//var newDate = new Date(date.getFullYear(), date.getMonth()+1, date.getDay());
		var day = d.date.getMonth();
		switch (day) {
			case 0: return "0.<?php echo $LNG->STATS_ACTIVITY_JAN; ?>";
			case 1: return "1.<?php echo $LNG->STATS_ACTIVITY_FEB; ?>";
			case 2: return "2.<?php echo $LNG->STATS_ACTIVITY_MAR; ?>";
			case 3:	return "3.<?php echo $LNG->STATS_ACTIVITY_APR; ?>";
			case 4:	return "4.<?php echo $LNG->STATS_ACTIVITY_MAY; ?>";
			case 5:	return "5.<?php echo $LNG->STATS_ACTIVITY_JUN; ?>";
			case 6:	return "6.<?php echo $LNG->STATS_ACTIVITY_JUL; ?>";
			case 7:	return "7.<?php echo $LNG->STATS_ACTIVITY_AUG; ?>";
			case 8:	return "8.<?php echo $LNG->STATS_ACTIVITY_SEP; ?>";
			case 9:	return "9.<?php echo $LNG->STATS_ACTIVITY_OCT; ?>";
			case 10:return "10.<?php echo $LNG->STATS_ACTIVITY_NOV; ?>";
			case 11:return "11.<?php echo $LNG->STATS_ACTIVITY_DEC; ?>";
		}
	});
	var monthGroup = monthFilter.group();

	monthChart
		.width(180)
		.height(180)
		.margins({top: 10, left: 10, right: 15, bottom: 20})
		.group(monthGroup)
		.dimension(monthFilter)
		.ordinalColors(colorbrewer.BrBG[11])
		.label(function (d) { return d.key.split(".")[1]; })
		.labelOffsetX(5)
		.labelOffsetY(13)
		.elasticX(true)
		.title(function (d) { return d.value; })
		.renderTitle(true)
		.gap(2)
		.xAxis().ticks(4);
	*/

	/*** DAYS OF WEEK ***/
	var dayOfWeek = activities.dimension(function (d) {
		var day = d.date.getDay();
		switch (day) {
			case 0: return "0.<?php echo $LNG->STATS_ACTIVITY_SUNDAY; ?>";
			case 1: return "1.<?php echo $LNG->STATS_ACTIVITY_MONDAY; ?>";
			case 2: return "2.<?php echo $LNG->STATS_ACTIVITY_TUESDAY; ?>";
			case 3:	return "3.<?php echo $LNG->STATS_ACTIVITY_WEDNESDAY; ?>";
			case 4:	return "4.<?php echo $LNG->STATS_ACTIVITY_THURSDAY; ?>";
			case 5:	return "5.<?php echo $LNG->STATS_ACTIVITY_FRIDAY; ?>";
			case 6:	return "6.<?php echo $LNG->STATS_ACTIVITY_SATURDAY; ?>";
		}
	});
	var dayOfWeekGroup = dayOfWeek.group();

	var dayscolor = colorbrewer.Blues[8].slice(0);
	dayscolor.shift();

	dayOfWeekChart
		.width(180)
		.height(180)
		.margins({top: 10, left: 10, right: 15, bottom: 20})
		.group(dayOfWeekGroup)
		.dimension(dayOfWeek)
		.ordinalColors(dayscolor)
		.label(function (d) { return d.key.split(".")[1]; })
		.labelOffsetX(5)
		.labelOffsetY(13)
		.elasticX(true)
		.title(function (d) { return d.value; })
		.renderTitle(true)
		.gap(2)
		.xAxis().ticks(4);

	/*** NODE TYPES ***/
	var nodetype = activities.dimension(function(d) {
		var type = d.nodetype;
		switch (type) {
			case "Issue": return "0."+getNodeTitleAntecedence(d.nodetype, false);
			case "Solution": return "1."+getNodeTitleAntecedence(d.nodetype, false);
			case "Pro": return "2."+getNodeTitleAntecedence(d.nodetype, false);
			case "Con": return "3."+getNodeTitleAntecedence(d.nodetype, false);
			case "Argument": return "4."+getNodeTitleAntecedence(d.nodetype, false);
			case "Idea": return "5."+getNodeTitleAntecedence(d.nodetype, false);
			default: return "6."+type;
		}
	});
	var nodetypeGroup = nodetype.group();

	// ITEM TYPE AS PIE
	itemTypeChart
		.width(180)
		.height(180)
		.margins({top: 10, left: 10, right: 15, bottom: 20})
		.group(nodetypeGroup)
		.dimension(nodetype)
		.ordinalColors([issueback,solutionback,proback,conback,argumentback,ideaback])
		.label(function (d) { return d.key.split(".")[1];  })
		.labelOffsetX(5)
		.labelOffsetY(20)
		.elasticX(true)
		.title(function (d) { return d.value; })
		.renderTitle(true)
		.gap(2)
		.xAxis().ticks(4);

	/*** ACTIVITY TYPES ***/
	var activitytype = activities.dimension(function(d) { return d.type; });
	var activitytypeGroup = activitytype.group();

	var activitycolor = colorbrewer.Blues[8].slice(0);
	activitycolor.reverse();

	activityTypeChart
		.width(180)
		.height(180)
		.margins({top: 10, left: 10, right: 15, bottom: 20})
		.group(activitytypeGroup)
		.dimension(activitytype)
		.ordinalColors(activitycolor)
		.label(function (d) { return d.key; })
		.labelOffsetX(5)
		.labelOffsetY(20)
		.title(function (d) { return d.value; })
		.elasticX(true)
		.renderTitle(true)
		.gap(2)
		.xAxis().ticks(4);

	/*
	dc.pieChart("#nodetype-pie-chart")
		.width(180)
		.height(180)
		.transitionDuration(500)
		.ordinalColors(activitycolor)
		// (optional) define color domain to match your data domain if you want to bind data or color
		.colorDomain([-1750, 1644])
		// (optional) define color value accessor
		.colorAccessor(function(d, i){return d.value;})
		.radius(90) // define pie radius
		.innerRadius(40)
		.dimension(gainOrLoss) // set dimension
		.group(gainOrLossGroup) // set group
		.label(function(d) { return d.data.key + "(" + Math.floor(d.data.value / all.value() * 100) + "%)"; })
		.renderLabel(true)
		.title(function(d) { return d.data.key + "(" + Math.floor(d.data.value / all.value() * 100) + "%)"; })
		.renderTitle(true);
	*/

	/*var colorScale = d3.scale.ordinal().range(activitycolor);
	dc.pieChart("#nodetype-nut-chart")
	    .width(180)
	    .height(180)
	    .transitionDuration(500)
		.ordinalColors(colorScale)
	    .radius(90)
	    .innerRadius(30)
	    .dimension(nodetype)
	    .group(nodetypeGroup)
	    .label(function(d) { return d.data.key.split(".")[1];  })
	    .renderLabel(true)
	    .title(function(d) { return d.data.key.split(".")[1]+": "+d.data.value; })
    	.renderTitle(true);
    	*/

	// TABLE OF DATA AT BOTTOM
	activityTableList
		.dimension(date)
		.group(function(d) {
			return formatDateGroup(d.date);
		})
		// (optional) max number of records to be shown, :default = 25
		.size(data.length)
		.columns([
			function(d) { return formatTime(d.date); },
			function(d) { return d.title; },
			function(d) { return getNodeTitleAntecedence(d.nodetype, false); },
			function(d) { return d.type }
		])
		.sortBy(function(d){ return d.date; })
		.order(d3.ascending);

	dc.dataCount("#data-count")
		.dimension(activities)
		.group(all);

	dc.renderAll();

	//dc.renderAll(chartGroup1);
	//dc.renderAll(chartGroup2);

	// once rendered you can call redrawAll to update charts incrementally when data
	// change without re-rendering everything
	//dc.redrawAll();
	// or you can choose to redraw only those charts associated with a specific chart group
	//dc.redrawAll("group");

	if ($('messagearea')) {
	 	$('messagearea').innerHTML="";
	}
}

function displayUserActivityCrossFilterD3Vis(data, width, userdata) {

	if (userdata === undefined) {
		userdata = "";
	}

	var formatDateGroup = d3.time.format("%B %Y");
	var formatDate = d3.time.format("%B %d, %Y");
	var formatTime = d3.time.format("%a %d %b %Y %I:%M %p");

	var checkDuplicateNames = {};

	data.forEach(function(d, i) {
		if (!d.color) {
			if (d.nodetype == "Pro") {
				d.color = proback;
			} else if (d.nodetype == "Con") {
				d.color = conback;
			} else if (d.nodetype == "Solution") {
				d.color = solutionback;
			} else if (d.nodetype == "Idea") {
				d.color = ideaback;
			} else if (d.nodetype == "Issue") {
				d.color = issueback;
			} else if (d.nodetype == "Group") {
				d.color = groupback;
			} else if (d.nodetype == "Argument") {
				d.color = argumentback;
			} else if (d.nodetype == "Comment") {
				d.color = commentback;
			} else if (d.nodetype == "Map") {
				d.color = mapback;
			} else if (d.nodetype == "<?php echo $LNG->STATS_ACTIVITY_VOTE; ?>") {
				d.color = voteback;
			} else {
				d.color = d.children ? color(d.depth) : null;
			}
		}
		d.index = i;
		d.date = new Date(d.date*1000);
		if (userdata != "" && userdata[d.userid]) {
			var dataitem = userdata[d.userid];

			// Handle duplicate names
			var name = dataitem['fname'];
			if (checkDuplicateNames[name]) {
				var nameuseridArray = checkDuplicateNames[name];
				var found = false;
				for (i=0; i<nameuseridArray.length; i++) {
					nextid = nameuseridArray[i];
					if (nextid == d.userid) {
						if (i == 0) {
							d.username = name;
						} else {
							d.username = name+" ("+(i+1)+")";
						}
						found = true;
						break;
					}
				}
				if (!found) {
					nameuseridArray.push(d.userid);
					d.username = name+" ("+(nameuseridArray.length)+")";
					checkDuplicateNames[name] = nameuseridArray;
				}
			} else {
				d.username = name;
				var array = new Array();
				array.push(d.userid);
				checkDuplicateNames[name] = array;
			}

			if (dataitem['homepage']) {
				d.homepage = dataitem['homepage'];
			}
		}
	});

	var activities = crossfilter(data);
	var all = activities.groupAll();

	/*** MAIN DATE CHART ***/
	// var user = activities.dimension(function(d) {return d.userid;}); //NOT NECESSARILY UNIQUE
	var user = activities.dimension(function(d) {return d.username;});
	var users = user.group();

	var usersGrouped = user.group().reduce(
		function(p, v) {
			p.totalAll++;
			if (v.nodetype == "Issue") {
				p.totalIssue++;
			} else if (v.nodetype == "Solution") {
				p.totalSolution++;
			} else if (v.nodetype == "Pro") {
				p.totalPro++;
			} else if (v.nodetype == "Con") {
				p.totalCon++;
			} else if (v.nodetype == "Argument") {
				p.totalArgument++;
			} else if (v.nodetype == "Idea") {
				p.totalIdea++;
			} else if (v.nodetype == "<?php echo $LNG->STATS_ACTIVITY_VOTE; ?>") {
				p.totalVote++;
			} else if (v.nodetype == "<?php echo $LNG->STATS_ACTIVITY_VOTED_FOR; ?>") {
				p.totalVoteFor++;
			} else if (v.nodetype == "<?php echo $LNG->STATS_ACTIVITY_VOTED_AGAINST; ?>") {
				p.totalVoteAgainst++;
			}
			return p;
		},
		function(p, v) {
			p.totalAll--;
			if (v.nodetype == "Issue") {
				p.totalIssue--;
			} else if (v.nodetype == "Solution") {
				p.totalSolution--;
			} else if (v.nodetype == "Pro") {
				p.totalPro--;
			} else if (v.nodetype == "Con") {
				p.totalCon--;
			} else if (v.nodetype == "Argument") {
				p.totalArgument--;
			} else if (v.nodetype == "Idea") {
				p.totalIdea--;
			} else if (v.nodetype == "<?php echo $LNG->STATS_ACTIVITY_VOTE; ?>") {
				p.totalVote--;
			} else if (v.nodetype == "<?php echo $LNG->STATS_ACTIVITY_VOTED_FOR; ?>") {
				p.totalVoteFor--;
			} else if (v.nodetype == "<?php echo $LNG->STATS_ACTIVITY_VOTED_AGAINST; ?>") {
				p.totalVoteAgainst--;
			}
			return p;
		},
		function() {
			return {
				totalAll:0,
				totalIssue:0,
				totalSolution:0,
				totalPro:0,
				totalCon:0,
				totalArgument:0,
				totalIdea:0,
				totalVote:0,
				totalVoteFor:0,
				totalVoteAgainst:0
			};
		}
	);

	//	.stack(usersGrouped, "<?php echo $LNG->STATS_ACTIVITY_VOTED_FOR; ?>", function(d){return d.value.totalVoteFor;})
	//	.stack(usersGrouped, "<?php echo $LNG->STATS_ACTIVITY_VOTED_AGAINST; ?>", function(d){return d.value.totalVoteAgainst;})

	var widtha = 0;
	var usercount = users.size();
	if (usercount > 10) {
		widtha = usercount*30;
	} else {
		widtha = usercount*90;
	}

	dc.barChart("#user-chart")
		.width(width)
		.height(300)
		.transitionDuration(500)
		.margins({top: 10, right: 30, bottom: 100, left: 40})
		.group(usersGrouped, getNodeTitleAntecedence("Issue", false))
		.valueAccessor(function(d) { return d.value.totalIssue;	})
		.stack(usersGrouped, getNodeTitleAntecedence("Solution", false), function(d){return d.value.totalSolution;})
		.stack(usersGrouped, getNodeTitleAntecedence("Pro", false), function(d){return d.value.totalPro;})
		.stack(usersGrouped, getNodeTitleAntecedence("Con", false), function(d){return d.value.totalCon;})
		.stack(usersGrouped, getNodeTitleAntecedence("Argument", false), function(d){return d.value.totalArgument;})
		.stack(usersGrouped, getNodeTitleAntecedence("Idea", false), function(d){return d.value.totalIdea;})
		.stack(usersGrouped, "<?php echo $LNG->STATS_ACTIVITY_VOTE; ?>", function(d){return d.value.totalVote;})
		.ordinalColors([issueback, solutionback, proback, conback, argumentback, ideaback, voteback])
		.dimension(user)
		.elasticY(false)
		.yAxisPadding(0)
		.elasticX(false)
		.xAxisPadding(0)
		.x(d3.scale.ordinal().domain(data.map( function(d){ return d.username;})))
		.xUnits(dc.units.ordinal)
		.centerBar(true)
		.renderHorizontalGridLines(true)
		.renderVerticalGridLines(false)
		.ordering(function(d){ return -d.value.totalAll; })
		.title(function(d){ return "";})
		.renderTitle(false);

	/*** NODE TYPES ***/
	var nodetype = activities.dimension(function(d) {
		var type = d.nodetype;
		switch (type) {
			case "Issue": return "0.<?php echo $LNG->STATS_ACTIVITY_ADDED; ?> "+getNodeTitleAntecedence(d.nodetype, false);
			case "Solution": return "1.<?php echo $LNG->STATS_ACTIVITY_ADDED; ?> "+getNodeTitleAntecedence(d.nodetype, false);
			case "Pro": return "2.<?php echo $LNG->STATS_ACTIVITY_ADDED; ?> "+getNodeTitleAntecedence(d.nodetype, false);
			case "Con": return "3.<?php echo $LNG->STATS_ACTIVITY_ADDED; ?> "+getNodeTitleAntecedence(d.nodetype, false);
			case "Argument": return "4.<?php echo $LNG->STATS_ACTIVITY_ADDED; ?> "+getNodeTitleAntecedence(d.nodetype, false);
			case "Idea": return "5.<?php echo $LNG->STATS_ACTIVITY_ADDED; ?> "+getNodeTitleAntecedence(d.nodetype, false);
			case "<?php echo $LNG->STATS_ACTIVITY_VOTE; ?>": return "6."+d.nodetype;
		}
	});
	var nodetypeGroup = nodetype.group();

	var colorChoice = d3.scale.ordinal().domain([0,1,2,3,4,5,6])
          .range([issueback,solutionback,proback,conback,argumentback,ideaback,voteback]);

	dc.rowChart("#nodetype-chart")
		.width(350)
		.height(200)
		.margins({top: 10, left: 40, right: 20, bottom: 20})
		.group(nodetypeGroup)
		.dimension(nodetype)
		.colors(colorChoice)
		.colorAccessor(function(d) {
			 var key = parseInt(d.key.split(".")[0]);
			 return key;
         })
		.label(function (d) { return d.key.split(".")[1];  })
		.labelOffsetX(5)
		.labelOffsetY(20)
		.elasticX(true)
		.title(function (d) { return d.value; })
		.renderTitle(true)
		.gap(2)
		.xAxis().ticks(6);

	// TABLE OF DATA AT BOTTOM
	//var date = activities.dimension(function(d) { return d.date; });
	dc.dataTable("#data-table")
		.dimension(user)
		.group(function(d) {
			if (d.homepage && d.homepage != "") {
				return '<a target="_blank" href="'+d.homepage+'">'+d.username+'</a>';
			} else {
				return d.username;
			}
		})
		// (optional) max number of records to be shown, :default = 25
		.size(50)
		.columns([
			function(d) { return formatTime(d.date); },
			function(d) {
				var type = d.nodetype;
				switch (type) {
					case "Issue": return "<?php echo $LNG->STATS_ACTIVITY_ADDED; ?> "+getNodeTitleAntecedence(type, false);
					case "Solution": return "<?php echo $LNG->STATS_ACTIVITY_ADDED; ?> "+getNodeTitleAntecedence(type, false);
					case "Pro": return "<?php echo $LNG->STATS_ACTIVITY_ADDED; ?> "+getNodeTitleAntecedence(type, false);
					case "Con": return "<?php echo $LNG->STATS_ACTIVITY_ADDED; ?> "+getNodeTitleAntecedence(type, false);
					case "Argument": return "<?php echo $LNG->STATS_ACTIVITY_ADDED; ?> "+getNodeTitleAntecedence(type, false);
					case "Idea": return "<?php echo $LNG->STATS_ACTIVITY_ADDED; ?> "+getNodeTitleAntecedence(type, false);
					case "<?php echo $LNG->STATS_ACTIVITY_VOTE; ?>": return type;
					case "<?php echo $LNG->STATS_ACTIVITY_VOTED_FOR; ?>": return type;
					case "<?php echo $LNG->STATS_ACTIVITY_VOTED_AGAINST; ?>": return type;
					default: return type;
				}
			},
			function(d) { return d.title; }
		])
		.sortBy(function(d){ return d.userid; })
		.order(d3.ascending);

	dc.dataCount("#data-count")
		.dimension(activities)
		.group(all);

	dc.renderAll();

	/** LEGEND **/
	var legend = d3LegendInactive();
	legend
		.width(width)
		.height(20)
        .margin({top: 0, right: 0, bottom: 0, left: 15});

	var priorities = ['Issue','Solution','Pro','Con','Argument','Idea','Vote'];
	var nest = d3.nest().key(function(d) { return d.nodetype; })
		.sortKeys(function(a,b) { return priorities.indexOf(a) - priorities.indexOf(b); })

	var svg = d3.select("#keyarea").append("svg")
	  .attr("width", width)
	  .attr("height", 30)
	  .append("g")
	  .attr('class', 'legendWrap')
	  .attr("transform", "translate(" + 0 + "," + 0 + ")");

	d3.select('.legendWrap')
          .datum(nest.entries(data))
          .call(legend);

	if ($('messagearea')) {
	 	$('messagearea').innerHTML="";
	}
}