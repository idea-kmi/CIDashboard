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
/* Author: Michelle Bachler, Kmi, The Open University UK. */

header('Content-Type: text/javascript;');
require_once('../../../config.php');
?>
/** REQUIRES: graphlib.js.php **/

/**
 * D3 based Zoomable Sunburst visualisation of a conversation network, coloured by node type.
 * Built Built on top of code by Mike Bostock at this url: http://bl.ocks.org/mbostock/4348373
 * @param container the div object to put the visualisation into
 * @param json the json holding the data to visualise
 * @param int width the width of the parent container
 * @param int height the height of the parent container
 */
function displaySunburstNetworkD3Vis(container, json, width, height) {
	var svg;
	var sunburstnetworkcontainer;
	var margin = 20;

	var legendHeight = 20;
	width = width - (margin*2);
	height = height - (margin*2);
	var diameter = Math.min(width, height);
	var radius = diameter / 2;
	var x = d3.scale.linear().range([0, 2 * Math.PI]);
	var y = d3.scale.sqrt().range([0, radius]);
	var path;
	var arc;

	var root = json;

	sunburstnetworkcontainer = d3.select(container);

    var legendarea = d3.select(container)
        .append("svg")
        .attr("width", width)
        .attr("style", 'padding:0px;height:'+legendHeight+'px;')
        .attr("height", legendHeight)
        .append("g");

 	svg = d3.select(container).append("svg")
    .attr("width", width)
    .attr("height", height)
    .append("g")
    .attr("transform", "translate(" + diameter / 2 + "," + diameter * .52  + ")");

	if (!root) return console.error(root);

	var radius = Math.min(width, height) / 2;
	var color = d3.scale.category20c();

	var data = root;
	//var margin = 0;
	/*var color = d3.scale.linear()
		.domain([-1, 5])
		.range(["hsl(152,80%,80%)", "hsl(228,30%,40%)"])
		.interpolate(d3.interpolateHcl);
	*/

	var pack = d3.layout.pack()
		.value(function(d) { return d.size; });
	var nodes = pack.nodes( root );

	nodes.forEach(function(d) {

		if (!d.color) {
			if (d.nodetype == "Pro") {
				d.color = proback;
			} else if (d.nodetype == "Con") {
				d.color = conback;
			} else if (d.nodetype == "Solution") {
				d.color = colorLuminance(solutionback, -(7*d.depth-1)/100);
			} else if (d.nodetype == "Idea") {
				d.color = colorLuminance(ideaback, -(7*d.depth-1)/100);
			} else if (d.nodetype == "Issue") {
				d.color = issueback;
			} else if (d.nodetype == "Group") {
				d.color = groupback;
			} else if (d.nodetype == "Argument") {
				d.color = argumentback;
			} else if (d.nodetype == "Comment") {
				d.color = colorLuminance(commentback, -(7*d.depth-1)/100);
			} else if (d.nodetype == "Map") {
				d.color = colorLuminance(mapback, -(7*d.depth-1)/100);
			} else {
				d.color = d.children ? color(d.depth) : null;
			}
		}

	});

	// LEGEND
	var legend = d3LegendInactive();
	legend
		.width(width)
		.height(20)
        .margin({top: 0, right: 0, bottom: 0, left: 0});

	var legendData = flatten(data)
	var priorities = ['Group','Issue','Solution','Pro','Con','Argument','Idea','Comment'];
	var nest = d3.nest().key(function(d) { return d.nodetype; })
		.sortKeys(function(a,b) { return priorities.indexOf(a) - priorities.indexOf(b); })

    legendarea.append('g').attr('class', 'legendWrap');
	legendarea.select('.legendWrap')
          .datum(nest.entries(legendData))
          .call(legend);

	var partition = d3.layout.partition()
	    .value(function(d) { return d.size; });

	arc = d3.svg.arc()
		.startAngle(function(d) { return Math.max(0, Math.min(2 * Math.PI, x(d.x))); })
		.endAngle(function(d) { return Math.max(0, Math.min(2 * Math.PI, x(d.x + d.dx))); })
		.innerRadius(function(d) { return Math.max(0, y(d.y)); })
		.outerRadius(function(d) { return Math.max(0, y(d.y + d.dy)); });


    // Init tooltip

	function zoomsunburst(d) {
		path.transition()
		  .duration(750)
		  .attrTween("d", arcTween(d));
	}

    // Init tooltip
	var tipSunburstNetwork = d3.select(container)
  		.append("div")
    	.style("visibility", "hidden")
    	.style("position","absolute")
    	.style("border","1px solid lightgray")
    	.style("background-color","white")
    	.style("padding", "2px")
    	.style("top", "10px")
    	.style("left", "10px")
    	.text("");

	path = svg.selectAll("path")
		.data(partition.nodes(root))
		.enter().append("path")
		.attr("d", arc)
		.style("fill", function(d) { return d.color; })
	  	.style("stroke", "#fff")
		.on('mouseover', function (d,i) {
			var offset = [15,15];
			var label = getNodeTitleAntecedence(d.nodetype)+" "+d.name;
			tipSunburstNetwork.style("top", (event.pageY)+(offset[1])+"px");
        	tipSunburstNetwork.style("left",(event.pageX)+(offset[0])+"px");
			tipSunburstNetwork.text(label);
			tipSunburstNetwork.style("visibility", "visible");
		})
		.on('mousemove', function (d,i) {
			var offset = [15,15];
			tipSunburstNetwork.style("top", (event.pageY)+(offset[1])+"px");
        	tipSunburstNetwork.style("left",(event.pageX)+(offset[0])+"px");
		})
		.on('mouseout', function (d,i) {
			tipSunburstNetwork.style("visibility", "hidden")
		})
		.on("click", zoomsunburst);

	// Stash the old values for transition.
	function stash(d) {
	  d.x0 = d.x;
	  d.dx0 = d.dx;
	}

	// Interpolate the scales!
	function arcTween(d) {
	  var xd = d3.interpolate(x.domain(), [d.x, d.x + d.dx]),
		  yd = d3.interpolate(y.domain(), [d.y, 1]),
		  yr = d3.interpolate(y.range(), [d.y ? 20 : 0, radius]);
	  return function(d, i) {
		return i
			? function(t) { return arc(d); }
			: function(t) { x.domain(xd(t)); y.domain(yd(t)).range(yr(t)); return arc(d); };
	  };
	}
}

/**
 * D3 based Zoomable Sunburst visualisation of a conversation network, coloured by conversation branch.
 * Built on top of code by Mike Bostock at this url: http://bl.ocks.org/mbostock/4348373
 * @param container the div object to put the visualisation into
 * @param json the json holding the data to visualise
 * @param int width the width of the parent container
 * @param int height the height of the parent container
 */
function displaySunburstNetworkByBranchD3Vis(container, json, width, height) {

	var svg;
	var sunburstnetworkcontainer;

	var margin = 20;
	width = width - (margin*2);
	height = height - (margin*2);
	var diameter = Math.min(width, height)
	var radius = diameter / 2;
	var x = d3.scale.linear().range([0, 2 * Math.PI]);
	var y = d3.scale.sqrt().range([0, radius]);
	var path;
	var arc;

	var root = json;

	sunburstnetworkcontainer = d3.select(container);

 	svg = d3.select(container).append("svg")
    .attr("width", width)
    .attr("height", height)
    .append("g")
    .attr("transform", "translate(" + diameter / 2 + "," + diameter * .52  + ")");

	if (!root) return console.error(root);

	var radius = Math.min(width, height) / 2;

	var color2 = colorbrewer.Paired[12];
	var color = colorbrewer.Set3[12];
	var interval = 12;

	//var color = d3.scale.category20c();
	/*var color = d3.scale.linear()
		.domain([-1, 5])
		.range(["hsl(152,80%,80%)", "hsl(228,30%,40%)"])
		.interpolate(d3.interpolateHcl);
	*/

	var data = root;

	var partition = d3.layout.partition().value(function(d) { return d.size; });
	//partition.sort(d3.descending);
	var nodes = partition.nodes(root);
	nodes.forEach(function(d) {
		if (!d.color) {
			var position = d.branch;
			if (d.branch > interval) {
				position = d.branch % interval;
				d.color = colorLuminance(color[position], -(7*d.depth-1)/100);
			} else {
				d.color = colorLuminance(color2[d.branch], -(7*d.depth-1)/100);
			}
		}
	});

	arc = d3.svg.arc()
		.startAngle(function(d) { return Math.max(0, Math.min(2 * Math.PI, x(d.x))); })
		.endAngle(function(d) { return Math.max(0, Math.min(2 * Math.PI, x(d.x + d.dx))); })
		.innerRadius(function(d) { return Math.max(0, y(d.y)); })
		.outerRadius(function(d) { return Math.max(0, y(d.y + d.dy)); });

	function zoomsunburst(d) {
		path.transition()
		  .duration(750)
		  .attrTween("d", arcTween(d));
	}

    // Init tooltip
	var tipSunburstNetwork = d3.select(container)
  		.append("div")
    	.style("visibility", "hidden")
    	.style("position","absolute")
    	.style("border","1px solid lightgray")
    	.style("background-color","white")
    	.style("padding", "2px")
    	.style("top", "10px")
    	.style("left", "10px")
    	.text("");

	path = svg.selectAll("path")
		.data(partition.nodes(root))
		.enter().append("path")
		.attr("d", arc)
		.style("fill", function(d) { return d.color; })
	  	.style("stroke", "#fff")
		.on('mouseover', function (d,i) {
			var offset = [15,15];
			var label = getNodeTitleAntecedence(d.nodetype)+" "+d.name;
			tipSunburstNetwork.style("top", (event.pageY)+(offset[1])+"px");
        	tipSunburstNetwork.style("left",(event.pageX)+(offset[0])+"px");
			tipSunburstNetwork.text(label);
			tipSunburstNetwork.style("visibility", "visible");
		})
		.on('mousemove', function (d,i) {
			var offset = [15,15];
			tipSunburstNetwork.style("top", (event.pageY)+(offset[1])+"px");
        	tipSunburstNetwork.style("left",(event.pageX)+(offset[0])+"px");
		})
		.on('mouseout', function (d,i) {
			tipSunburstNetwork.style("visibility", "hidden")
		})
		.on("click", function (d, i) {
		    if (window.event.ctrlKey && d.homepage) {
		    	var win = window.open(d.homepage, '_blank');
  				win.focus();
			} else {
				zoomsunburst(d);
			}
		});

	// Stash the old values for transition.
	function stash(d) {
	  d.x0 = d.x;
	  d.dx0 = d.dx;
	}

	// Interpolate the scales!
	function arcTween(d) {
	  var xd = d3.interpolate(x.domain(), [d.x, d.x + d.dx]),
		  yd = d3.interpolate(y.domain(), [d.y, 1]),
		  yr = d3.interpolate(y.range(), [d.y ? 20 : 0, radius]);
	  return function(d, i) {
		return i
			? function(t) { return arc(d); }
			: function(t) { x.domain(xd(t)); y.domain(yd(t)).range(yr(t)); return arc(d); };
	  };
	}
}