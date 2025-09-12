<?php
/********************************************************************************
 *                                                                              *
 *  (c) Copyright 2015 - 2025 The Open University UK                            *
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
/** REQUIRES: graphlib.js.php **/

var diameter = 730;
var svg;
var circlepackingcontainer;

/***** IBIS CIRCLE PACKING VISUALISATION ******/

/**
 * D3 based Circle packing visualisation showing a Conversation tree where balls are coloured by node type.
 * @param container the div object to put the visualisation into
 * @param json the json holding the data to visualise
 * @param int width the width of the parent container
 * @param int height the height of the parent container
 */
function displayCirclePackingNodeTypesD3Vis(container, json, width, height) {
	var root = json;

	circlepackingcontainer = d3.select(container);

	var margin = 20;
	var legendHeight = 20;
	height = height - (margin*2);
	diameter = Math.min(width, height);

    var legendarea = d3.select(container)
        .append("svg")
        .attr("width", width)
        .attr("style", 'padding:0px;height:'+legendHeight+'px;border:1px solid transparent')
        .attr("height", legendHeight)
        .append("g");

 	svg = d3.select(container).append("svg")
    .attr("width", diameter)
    .attr("height", diameter)
    .append("g")
    .attr("transform", "translate(" + diameter / 2 + "," + diameter / 2 + ")");

	if (!root) return console.error(root);

	var width=diameter;
	var data = root;
	var color = d3.scale.linear()
		.domain([-1, 5])
		.range(["hsl(152,80%,80%)", "hsl(228,30%,40%)"])
		.interpolate(d3.interpolateHcl);

	var pack = d3.layout.pack()
		.padding(20)
		.size([diameter - (margin*2), diameter - (margin*2)])
		.value(function(d) { return d.size; });

	var focus = root;
	var view = null;

    addPlaceholders(root);
    var nodes = pack.nodes( root );
    removePlaceholders(nodes);

	nodes.forEach(function(d) {

		if (!d.color) {
			if (d.nodetype == "Pro") {
				d.color = proback;
			} else if (d.nodetype == "Con") {
				d.color = conback;
			} else if (d.nodetype == "Argument") {
				d.color = colorLuminance(argumentback, -(7*d.depth-1)/100);
			} else if (d.nodetype == "Solution") {
				d.color = colorLuminance(solutionback, -(7*d.depth-1)/100);
			} else if (d.nodetype == "Idea") {
				d.color = colorLuminance(ideaback, -(7*d.depth-1)/100);
			} else if (d.nodetype == "Issue") {
				d.color = issueback;
			} else if (d.nodetype == "Group") {
				d.color = groupback;
			} else if (d.nodetype == "Challenge") {
				d.color = colorLuminance(challengeback, -(7*d.depth-1)/100);
			} else if (d.nodetype == "Map") {
				d.color =  colorLuminance(mapback, -(7*d.depth-1)/100);
			} else if (d.nodetype == "Idea") {
				d.color = colorLuminance(ideaback, -(7*d.depth-1)/100);
			} else if (d.nodetype == "Comment") {
				d.color = colorLuminance(commentback, -(7*d.depth-1)/100);
			} else {
				d.color = d.children ? color(d.depth) : null;
			}
		}
	});

	/** LEGEND **/
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

    centerNodes( nodes );
    makePositionsRelativeToZero( nodes );

    // Init tooltip
	var tipCirclePack = d3.select(container)
  		.append("div")
    	.style("visibility", "hidden")
    	.style("position","absolute")
    	.style("border","1px solid lightgray")
    	.style("background-color","white")
    	.style("padding", "2px")
    	.style("top", "10px")
    	.style("left", "10px")
    	.text("");

	var circle = svg.selectAll("circle")
		.data(nodes)
		.enter().append("circle")
		.attr("class", function(d) { return d.parent ? d.children ? "node" : "node node--leaf" : "node node--root"; })
		.style("fill", function(d) {
			return d.color;
		})
		.on("click", function(d) {if (d.children) { if (focus !== d) zoom(d), d3.event.stopPropagation(); } })
		.on('mouseover', function (d,i) {
			var offset = [15,15];
	    	var label = getNodeTitleAntecedence(d.nodetype, true)+" "+d.name;
			tipCirclePack.style("top", (event.pageY)+(offset[1])+"px");
        	tipCirclePack.style("left",(event.pageX)+(offset[0])+"px");
			tipCirclePack.text(label);
			tipCirclePack.style("visibility", "visible");
		})
		.on('mousemove', function (d,i) {
			var offset = [15,15];
			tipCirclePack.style("top", (event.pageY)+(offset[1])+"px");
        	tipCirclePack.style("left",(event.pageX)+(offset[0])+"px");
		})
		.on('mouseout', function (d,i) {
			tipCirclePack.style("visibility", "hidden")
		});

	var text = svg.selectAll("text")
		.data(nodes)
		.enter().append("text")
		.attr("class", "label")
		.style("fill-opacity", function(d) { return d.parent === root ? 1 : 0; })
		.style("display", function(d) { return d.parent === root ? null : "none"; })
		.text(function(d) { return ''; });

	//text = d.name;

	var node = svg.selectAll("circle,text");

	d3.select("body").on("click", function() { zoom(root); });

	zoomTo([root.x, root.y, root.r * 2 + margin]);

	function zoom(d) {
		var focus0 = focus; focus = d;

		var transition = d3.transition()
			.duration(d3.event.altKey ? 7500 : 750)
			.tween("zoom", function(d) {
			  var i = d3.interpolateZoom(view, [focus.x, focus.y, focus.r * 2 + margin]);
			  return function(t) { zoomTo(i(t)); };
			});

		transition.selectAll("text")
		  .filter(function(d) { return d.parent === focus || this.style.display === "inline"; })
			.style("fill-opacity", function(d) { return d.parent === focus ? 1 : 0; })
			.each("start", function(d) { if (d.parent === focus) this.style.display = "inline"; })
			.each("end", function(d) { if (d.parent !== focus) this.style.display = "none"; });
	}

	function zoomTo(v) {
		var k = diameter / v[2]; view = v;
		node.attr("transform", function(d) { return "translate(" + (d.x - v[0]) * k + "," + (d.y - v[1]) * k + ")"; });
		circle.attr("r", function(d) { return d.r * k; });
	}

	//d3.select(self.frameElement).style("height", diameter + "px");
}


/**
 * D3 based Circle packing visualisation using Attention metrics that affects ball colour and size.
 * @param container the div object to put the visualisation into
 * @param json the json holding the data to visualise
 * @param int width the width of the parent container
 * @param int height the height of the parent container
 */
function displayCirclePackingAttentionD3Vis(container, json, width, height) {
	var root = json;

	circlepackingcontainer = d3.select(container);

	var margin = 20;
	var legendHeight = 30;
	width = width - (margin*2);
	height = height - (margin*2);
	diameter = Math.min(width, height);

    var legendarea = d3.select(container)
        .append("svg")
        .attr("width", diameter)
        .attr("style", 'padding:0px;height:'+legendHeight+'px;')
        .attr("height", legendHeight)
        .append("g");

 	svg = d3.select(container).append("svg")
    .attr("width", diameter)
    .attr("height", diameter)
    .append("g")
    .attr("transform", "translate(" + diameter / 2 + "," + ((diameter / 2)) + ")");

	if (!root) return console.error(root);

	//var color = colorbrewer.Set3[11];
	// revrsed RdYlBu
	var color = ["#313695","#4575b4","#74add1","#abd9e9","#e0f3f8","#ffffbf","#fee090","#fdae61","#f46d43","#d73027","#a50026"];
	//var color = colorbrewer.RdYlBu[11];

	var width=diameter;
	var data = root;
	var margin = 20;

	var pack = d3.layout.pack()
		.padding(20)
		.size([diameter - (margin*2), diameter - (margin*2)])
		.value(function(d) { return d.size; });

	var focus = root;
	var view = null;

    addPlaceholders(root);
    var nodes = pack.nodes( root );
    removePlaceholders(nodes);
    centerNodes( nodes );
    makePositionsRelativeToZero( nodes );

    // Init tooltip
	var tipCirclePack = d3.select(container)
  		.append("div")
    	.style("visibility", "hidden")
    	.style("position","absolute")
    	.style("border","1px solid lightgray")
    	.style("background-color","white")
    	.style("padding", "2px")
    	.style("top", "10px")
    	.style("left", "10px")
    	.text("");

	var circle = svg.selectAll("circle")
		.data(nodes)
		.enter().append("circle")
		.attr("class", function(d) { return d.parent ? d.children ? "node" : "node node--leaf" : "node node--root"; })
		.style("fill", function(d) {
			if (d.color) {
				return d.color;
			} else {
				return color[d.colornumber*10];
			}
		})
		.on("click", function(d) {if (d.children) { if (focus !== d) zoom(d), d3.event.stopPropagation(); } })
		.on('mouseover', function (d,i) {
			var offset = [15,15];
	    	var label = getNodeTitleAntecedence(d.nodetype, true)+" "+d.name;
			tipCirclePack.style("top", (event.pageY)+(offset[1])+"px");
        	tipCirclePack.style("left",(event.pageX)+(offset[0])+"px");
			tipCirclePack.text(label);
			tipCirclePack.style("visibility", "visible");
		})
		.on('mousemove', function (d,i) {
			var offset = [15,15];
			tipCirclePack.style("top", (event.pageY)+(offset[1])+"px");
        	tipCirclePack.style("left",(event.pageX)+(offset[0])+"px");
		})
		.on('mouseout', function (d,i) {
			tipCirclePack.style("visibility", "hidden")
		});

	var text = svg.selectAll("text")
		.data(nodes)
		.enter().append("text")
		.attr("class", "label")
		.style("fill-opacity", function(d) { return d.parent === root ? 1 : 0; })
		.style("display", function(d) { return d.parent === root ? null : "none"; })
		.text(function(d) { return ''; });

	var node = svg.selectAll("circle,text");

	d3.select("body").on("click", function() { zoom(root); });

	zoomTo([root.x, root.y, root.r * 2 + margin]);

	function zoom(d) {
		var focus0 = focus; focus = d;

		var transition = d3.transition()
			.duration(d3.event.altKey ? 7500 : 750)
			.tween("zoom", function(d) {
			  var i = d3.interpolateZoom(view, [focus.x, focus.y, focus.r * 2 + margin]);
			  return function(t) { zoomTo(i(t)); };
			});

		transition.selectAll("text")
		  .filter(function(d) { return d.parent === focus || this.style.display === "inline"; })
			.style("fill-opacity", function(d) { return d.parent === focus ? 1 : 0; })
			.each("start", function(d) { if (d.parent === focus) this.style.display = "inline"; })
			.each("end", function(d) { if (d.parent !== focus) this.style.display = "none"; });
	}

	function zoomTo(v) {
		var k = diameter / v[2]; view = v;
		node.attr("transform", function(d) { return "translate(" + (d.x - v[0]) * k + "," + (d.y - v[1]) * k + ")"; });
		circle.attr("r", function(d) { return d.r * k; });
	}

	/** LEGEND **/
	var legend = d3LegendAttention();
	legend
		.label('<?php echo $LNG->ATTENTION_MAP_KEY_NAME; ?>')
		.color(color)
		.width(width)
		.height(20)
        .margin({top: 0, right: 0, bottom: 0, left: 0});

    legendarea.append('g').attr('class', 'legendWrap');
	legendarea.select('.legendWrap')
          .datum(['0','0.1','0.2','0.3','0.4','0.5','0.6','0.7','0.8','0.9','1'])
          .attr('transform', 'translate(' + -((width/2)-120) + ',' + 25 +')')
          .call(legend);
}

/*** HERLPER FUNCTIONS ****/

function flatten(root) {
	var nodes = [], i = 0;

	function recurse(node) {
		if (node.children)
			node.children.forEach(recurse);
		if (!node.id) node.id = ++i;
			nodes.push(node);
	}

	recurse(root);
	return nodes;
}


/*** Code from http://stackoverflow.com/questions/22307486/d3-js-packed-circle-layout-how-to-adjust-child-radius ***/

function addPlaceholders( node ) {
    if(node.children) {
        for( var i = 0; i < node.children.length; i++ ) {
            var child = node.children[i];
            addPlaceholders( child );
        }

        if(node.children.length === 1) {
            node.children.push({ name:'placeholder', children: [ { name:'placeholder', children:[] }] });
        }
    }
};

function removePlaceholders( nodes ) {
    for( var i = nodes.length - 1; i >= 0; i-- ) {
        var node = nodes[i];
        if( node.name === 'placeholder' ) {
            nodes.splice(i,1);
        } else {
            if( node.children ) {
                removePlaceholders( node.children );
            }
        }
    }
};

function centerNodes( nodes ) {
    for( var i = 0; i < nodes.length; i ++ ) {
        var node = nodes[i];
        if( node.children ) {
            if( node.children.length === 1) {
                var offset = node.x - node.children[0].x;
                node.children[0].x += offset;
                reposition(node.children[0],offset);
            }
        }
    }

    function reposition( node, offset ) {
        if(node.children) {
            for( var i = 0; i < node.children.length; i++ ) {
                node.children[i].x += offset;
                reposition( node.children[i], offset );
            }
        }
    };
};

function makePositionsRelativeToZero( nodes ) {
    //use this to have vis centered at 0,0,0 (easier for positioning)
    var offsetX = nodes[0].x;
    var offsetY = nodes[0].y;

    for( var i = 0; i < nodes.length; i ++ ) {
        var node = nodes[i];
        node.x -= offsetX;
        node.y -= offsetY;
    }
};

/*** End Code import ***/