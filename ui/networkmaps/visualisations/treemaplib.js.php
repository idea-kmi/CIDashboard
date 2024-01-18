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
/* Author: Michelle Bachler, Kmi, The Open University UK. */

header('Content-Type: text/javascript;');
require_once('../../../config.php');
?>
/** REQUIRES: graphlib.js.php **/


/**
 * D3 based Tree map with titles. Good for shallower maps. Squares coloured by sibling groups.
 * Built on top of code by Bill White at this url: http://www.billdwhite.com/wordpress/2012/12/16/d3-treemap-with-title-headers/
 * @param container the div object to put the visualisation into
 * @param json the json holding the data to visualise
 * @param int width the width of the parent container
 * @param int height the height of the parent container
 */
function displayTreemapNetworkD3Vis(container, json, width, height) {

	var supportsForeignObject = false;
	var chartWidth = width;
	var chartHeight = height;
	var xscale = d3.scale.linear().range([0, chartWidth]);
	var yscale = d3.scale.linear().range([0, chartHeight]);
	var color = d3.scale.category20();
	var headerHeight = 20;
	var headerColor = "#555555";
	var transitionDuration = 500;

    var treemap = d3.layout.treemap()
        .round(false)
        .size([chartWidth, chartHeight])
        .sticky(true)
        .value(function(d) {
            return d.size;
        });

    var chart = d3.select(container)
        .append("svg:svg")
        .attr("width", chartWidth)
        .attr("style", 'padding:20px;padding-top:10px;')
        .attr("height", chartHeight)
        .append("svg:g");


    // Init tooltip
	var tipTreemap = d3.select(container)
  		.append("div")
    	.style("visibility", "hidden")
    	.style("position","absolute")
    	.style("border","1px solid lightgray")
    	.style("background-color","white")
    	.style("padding", "2px")
    	.style("top", "10px")
    	.style("left", "10px")
    	.text("");


	var node = json;
	var root = json;
	var data = json;

	var nodes = treemap.nodes(root);

	var children = nodes.filter(function(d) {
		return !d.children;
	});

	var parents = nodes.filter(function(d) {
		return d.children;
	});

	// create parent cells
	var runningparentcounter = 0;
	var parentCells = chart.selectAll("g.cell.parent")
		.data(parents, function(d) {
			runningparentcounter++;
			return "p-"+runningparentcounter;
		});

	var parentEnterTransition = parentCells.enter()
		.append("g")
		.attr("class", "cell parent")
		.on('mouseover', function (d,i) {
			var offset = [15,15];
	    	var label = getNodeTitleAntecedence(d.nodetype)+" "+d.name
			tipTreemap.style("top", (event.pageY)+(offset[1])+"px");
        	tipTreemap.style("left",(event.pageX)+(offset[0])+"px");
			tipTreemap.text(label);
			tipTreemap.style("visibility", "visible");
		})
		.on('mousemove', function (d,i) {
			var offset = [15,15];
			tipTreemap.style("top", (event.pageY)+(offset[1])+"px");
        	tipTreemap.style("left",(event.pageX)+(offset[0])+"px");
		})
		.on('mouseout', function (d,i) {
			tipTreemap.style("visibility", "hidden")
		})
		.on("click", function(d) {
			if (d.zoomed) {
				d.zoomed = false;
				zoom(d.parent);
			} else {
				d.zoomed = true;
				zoom(d);
			}
		});

	parentEnterTransition.append("rect")
		.attr("width", function(d) {
			return Math.max(0.01, d.dx);
		})
		.attr("height", headerHeight)
		.style("fill", headerColor);

	parentEnterTransition.append('foreignObject')
		.attr("class", "foreignObject")
		.append("xhtml:body")
		.attr("class", "labelbody")
		.append("div")
		.attr("class", "label");

	// update transition
	var parentUpdateTransition = parentCells.transition().duration(transitionDuration);
	parentUpdateTransition.select(".cell")
		.attr("transform", function(d) {
			return "translate(" + d.dx + "," + d.y + ")";
		});

	parentUpdateTransition.select("rect")
		.attr("width", function(d) {
			return Math.max(0.01, d.dx);
		})
		.attr("height", headerHeight)
		.style("fill", headerColor);

	parentUpdateTransition.select(".foreignObject")
		.attr("width", function(d) {
			return Math.max(0.01, d.dx);
		})
		.attr("height", headerHeight)
		.select(".labelbody .label")
		.text(function(d) {
			if (d != root) {
				return d.name;
			}
		});

	// remove transition
	parentCells.exit()
		.remove();


	// create children cells
	var runningchildcounter = 0;
	var childrenCells = chart.selectAll("g.cell.child")
		.data(children, function(d) {
			runningchildcounter++;
			return "c-"+runningchildcounter;
		});

	// enter transition
	var childEnterTransition = childrenCells.enter()
		.append("g")
		.attr("class", "cell child")
		.on('mouseover', function (d,i) {
			var offset = [15,15];
	    	var label = getNodeTitleAntecedence(d.nodetype)+" "+d.name
			tipTreemap.style("top", (event.pageY)+(offset[1])+"px");
        	tipTreemap.style("left",(event.pageX)+(offset[0])+"px");
			tipTreemap.text(label);
			tipTreemap.style("visibility", "visible");
		})
		.on('mousemove', function (d,i) {
			var offset = [15,15];
			tipTreemap.style("top", (event.pageY)+(offset[1])+"px");
        	tipTreemap.style("left",(event.pageX)+(offset[0])+"px");
		})
		.on('mouseout', function (d,i) {
			tipTreemap.style("visibility", "hidden")
		})
		.on("click", function(d) {
			zoom(node === d.parent ? root : d.parent);
		});

	childEnterTransition.append("rect")
		.classed("background", true)
		.style("fill", function(d) {
			return color(d.parent.name);
		});

	childEnterTransition.append('foreignObject')
		.attr("class", "foreignObject")
		.attr("width", function(d) {
			return Math.max(0.01, d.dx);
		})
		.attr("height", function(d) {
			return Math.max(0.01, d.dy);
		})
		.append("xhtml:body")
		.attr("class", "labelbody")
		.append("div")
		.attr("class", "label")
		.text(function(d) {
			return d.name;
		});

	if (supportsForeignObject) {
		childEnterTransition.selectAll(".foreignObject")
				.style("display", "none");
	} else {
		childEnterTransition.selectAll(".foreignObject .labelbody .label")
				.style("display", "none");
	}

	// update transition
	var childUpdateTransition = childrenCells.transition().duration(transitionDuration);
	childUpdateTransition.select(".cell")
		.attr("transform", function(d) {
			return "translate(" + d.x  + "," + d.y + ")";
		});
	childUpdateTransition.select("rect")
		.attr("width", function(d) {
			return Math.max(0.01, d.dx);
		})
		.attr("height", function(d) {
			return d.dy;
		})
		.style("fill", function(d) {
			return color(d.parent.name);
		});
	childUpdateTransition.select(".foreignObject")
		.attr("width", function(d) {
			return Math.max(0.01, d.dx);
		})
		.attr("height", function(d) {
			return Math.max(0.01, d.dy);
		})
		.select(".labelbody .label")
		.text(function(d) {
			return d.name;
		});
	// exit transition
	childrenCells.exit()
		.remove();

    //and another one
    function textHeight(d) {
        var ky = chartHeight / d.dy;
        yscale.domain([d.y, d.y + d.dy]);
        return (ky * d.dy) / headerHeight;
    }


    function getRGBComponents (color) {
        var r = color.substring(1, 3);
        var g = color.substring(3, 5);
        var b = color.substring(5, 7);
        return {
            R: parseInt(r, 16),
            G: parseInt(g, 16),
            B: parseInt(b, 16)
        };
    }

    function idealTextColor (bgColor) {
        var nThreshold = 105;
        var components = getRGBComponents(bgColor);
        var bgDelta = (components.R * 0.299) + (components.G * 0.587) + (components.B * 0.114);
        return ((255 - bgDelta) < nThreshold) ? "#000000" : "#ffffff";
    }

    function zoom(d) {
        treemap
            .padding([headerHeight/(chartHeight/d.dy), 0, 0, 0])
            .nodes(d);

        // moving the next two lines above treemap layout messes up padding of zoom result
        var kx = chartWidth  / d.dx;
        var ky = chartHeight / d.dy;
        var level = d;

        xscale.domain([d.x, d.x + d.dx]);
        yscale.domain([d.y, d.y + d.dy]);

        if (node != level) {
            if (supportsForeignObject) {
                chart.selectAll(".cell.child .foreignObject")
                        .style("display", "none");
            } else {
                chart.selectAll(".cell.child .foreignObject .labelbody .label")
                        .style("display", "none");
            }
        }

        var zoomTransition = chart.selectAll("g.cell").transition().duration(transitionDuration)
            .attr("transform", function(d) {
                return "translate(" + xscale(d.x) + "," + yscale(d.y) + ")";
            })
            .each("end", function(d, i) {
                if (!i && (level !== self.root)) {
                    chart.selectAll(".cell.child")
                        .filter(function(d) {
                            return d.parent === self.node; // only get the children for selected group
                        })
                        .select(".foreignObject .labelbody .label")
                        .style("color", function(d) {
                            return idealTextColor(color(d.parent.name));
                        });

                    if (supportsForeignObject) {
                        chart.selectAll(".cell.child")
                            .filter(function(d) {
                                return d.parent === self.node; // only get the children for selected group
                            })
                            .select(".foreignObject")
                            .style("display", "");
                    } else {
                        chart.selectAll(".cell.child")
                            .filter(function(d) {
                                return d.parent === self.node; // only get the children for selected group
                            })
                            .select(".foreignObject .labelbody .label")
                            .style("display", "");
                    }
                }
            });

        zoomTransition.select(".foreignObject")
            .attr("width", function(d) {
                return Math.max(0.01, kx * d.dx);
            })
            .attr("height", function(d) {
                return d.children ? headerHeight: Math.max(0.01, ky * d.dy);
            })
            .select(".labelbody .label")
            .text(function(d) {
				if (d != root) {
					return d.name;
				}
            });

        // update the width/height of the rects
        zoomTransition.select("rect")
            .attr("width", function(d) {
                return Math.max(0.01, kx * d.dx);
            })
            .attr("height", function(d) {
                return d.children ? headerHeight : Math.max(0.01, ky * d.dy);
            })
            .style("fill", function(d) {
                return d.children ? headerColor : color(d.parent.name);
            });

        node = d;

        if (d3.event) {
            d3.event.stopPropagation();
        }
    }

	zoom(node);
}


/**
 * D3 based Tree map with titles. Good for shallower maps. Squares coloured by Node Type
 * Built on top of code by Bill White at this url: http://www.billdwhite.com/wordpress/2012/12/16/d3-treemap-with-title-headers/
 * @param container the div object to put the visualisation into
 * @param json the json holding the data to visualise
 * @param int width the width of the parent container
 * @param int height the height of the parent container
 */
function displayTreemapNetworkByTypeD3Vis(container, json, width, height) {

	var supportsForeignObject = false;
	var chartWidth = width;
	var chartHeight = height-20;
	var xscale = d3.scale.linear().range([0, chartWidth]);
	var yscale = d3.scale.linear().range([0, chartHeight]);
	var headerHeight = 20;
	var headerColor = "#555555";
	var transitionDuration = 500;

    var treemap = d3.layout.treemap()
        .round(false)
        .size([chartWidth, chartHeight])
        .sticky(true)
        .value(function(d) {
            return d.size;
        });

    var legendarea = d3.select(container)
        .append("svg:svg")
        .attr("width", chartWidth)
        .attr("style", 'height:20px;')
        .attr("height", 20)
        .append("svg:g");

    var chart = d3.select(container)
        .append("svg:svg")
        .attr("width", chartWidth)
        .attr("style", 'padding:0px;padding-top:0px;')
        .attr("height", chartHeight)
        .append("svg:g");

    // Init tooltip
	var tipTreemap = d3.select(container)
  		.append("div")
    	.style("visibility", "hidden")
    	.style("position","absolute")
    	.style("border","1px solid lightgray")
    	.style("background-color","white")
    	.style("padding", "2px")
    	.style("top", "10px")
    	.style("left", "10px")
    	.text("");

	var node = json;
	var root = json;
	var data = json;

	// SET COLOURS
	var nodes = treemap.nodes(root);
	nodes.forEach(function(d) {
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

	var children = nodes.filter(function(d) {
		return !d.children;
	});

	var parents = nodes.filter(function(d) {
		return d.children;
	});

	// create parent cells
	var runningparentcounter = 0;
	var parentCells = chart.selectAll("g.cell.parent")
		.data(parents, function(d) {
			runningparentcounter++;
			return "p-"+runningparentcounter;
		});

	var parentEnterTransition = parentCells.enter()
		.append("g")
		.attr("class", "cell parent")
		.on('mouseover', function (d,i) {
			var offset = [15,15];
	    	var label = getNodeTitleAntecedence(d.nodetype)+" "+d.name
			tipTreemap.style("top", (event.pageY)+(offset[1])+"px");
        	tipTreemap.style("left",(event.pageX)+(offset[0])+"px");
			tipTreemap.text(label);
			tipTreemap.style("visibility", "visible");
		})
		.on('mousemove', function (d,i) {
			var offset = [15,15];
			tipTreemap.style("top", (event.pageY)+(offset[1])+"px");
        	tipTreemap.style("left",(event.pageX)+(offset[0])+"px");
		})
		.on('mouseout', function (d,i) {
			tipTreemap.style("visibility", "hidden")
		})
		.on("click", function(d) {
			if (d.zoomed) {
				d.zoomed = false;
				zoom(d.parent);
			} else {
				d.zoomed = true;
				zoom(d);
			}
		});

	parentEnterTransition.append("rect")
		.attr("width", function(d) {
			return Math.max(0.01, d.dx);
		})
		.attr("height", headerHeight)
		.style("fill", headerColor);

	parentEnterTransition.append('foreignObject')
		.attr("class", "foreignObject")
		.append("xhtml:body")
		.attr("class", "labelbody")
		.append("div")
		.attr("class", "label");

	// update transition
	var parentUpdateTransition = parentCells.transition().duration(transitionDuration);
	parentUpdateTransition.select(".cell")
		.attr("transform", function(d) {
			return "translate(" + d.dx + "," + d.y + ")";
		});

	parentUpdateTransition.select("rect")
		.attr("width", function(d) {
			return Math.max(0.01, d.dx);
		})
		.attr("height", headerHeight)
		.style("fill", headerColor);

	parentUpdateTransition.select(".foreignObject")
		.attr("width", function(d) {
			return Math.max(0.01, d.dx);
		})
		.attr("height", headerHeight)
		.select(".labelbody .label")
		.text(function(d) {
			if (d != root) {
				return d.name;
			}
		});

	// remove transition
	parentCells.exit()
		.remove();


	// create children cells
	var runningchildcounter = 0;
	var childrenCells = chart.selectAll("g.cell.child")
		.data(children, function(d) {
			runningchildcounter++;
			return "c-"+runningchildcounter;
		});

	// enter transition
	var childEnterTransition = childrenCells.enter()
		.append("g")
		.attr("class", "cell child")
		.on('mouseover', function (d,i) {
			var offset = [15,15];
	    	var label = getNodeTitleAntecedence(d.nodetype)+" "+d.name
			tipTreemap.style("top", (event.pageY)+(offset[1])+"px");
        	tipTreemap.style("left",(event.pageX)+(offset[0])+"px");
			tipTreemap.text(label);
			tipTreemap.style("visibility", "visible");
		})
		.on('mousemove', function (d,i) {
			var offset = [15,15];
			tipTreemap.style("top", (event.pageY)+(offset[1])+"px");
        	tipTreemap.style("left",(event.pageX)+(offset[0])+"px");
		})
		.on('mouseout', function (d,i) {
			tipTreemap.style("visibility", "hidden")
		})
		.on("click", function(d) {
			zoom(node === d.parent ? root : d.parent);
		});

	childEnterTransition.append("rect")
		.classed("background", true)
		.style("fill", function(d) {
			return d.color;
		});

	childEnterTransition.append('foreignObject')
		.attr("class", "foreignObject")
		.attr("width", function(d) {
			return Math.max(0.01, d.dx);
		})
		.attr("height", function(d) {
			return Math.max(0.01, d.dy);
		})
		.append("xhtml:body")
		.attr("class", "labelbody")
		.append("div")
		.attr("class", "label")
		.text(function(d) {
			return d.name;
		});

	if (supportsForeignObject) {
		childEnterTransition.selectAll(".foreignObject")
				.style("display", "none");
	} else {
		childEnterTransition.selectAll(".foreignObject .labelbody .label")
				.style("display", "none");
	}

	// update transition
	var childUpdateTransition = childrenCells.transition().duration(transitionDuration);
	childUpdateTransition.select(".cell")
		.attr("transform", function(d) {
			return "translate(" + d.x  + "," + d.y + ")";
		});
	childUpdateTransition.select("rect")
		.attr("width", function(d) {
			return Math.max(0.01, d.dx);
		})
		.attr("height", function(d) {
			return d.dy;
		})
		.style("fill", function(d) {
			return d.color;
		});
	childUpdateTransition.select(".foreignObject")
		.attr("width", function(d) {
			return Math.max(0.01, d.dx);
		})
		.attr("height", function(d) {
			return Math.max(0.01, d.dy);
		})
		.select(".labelbody .label")
		.text(function(d) {
			return d.name;
		});
	// exit transition
	childrenCells.exit()
		.remove();

    //and another one
    function textHeight(d) {
        var ky = chartHeight / d.dy;
        yscale.domain([d.y, d.y + d.dy]);
        return (ky * d.dy) / headerHeight;
    }

    function getRGBComponents (color) {
        var r = color.substring(1, 3);
        var g = color.substring(3, 5);
        var b = color.substring(5, 7);
        return {
            R: parseInt(r, 16),
            G: parseInt(g, 16),
            B: parseInt(b, 16)
        };
    }

    function idealTextColor (bgColor) {
        var nThreshold = 105;
        var components = getRGBComponents(bgColor);
        var bgDelta = (components.R * 0.299) + (components.G * 0.587) + (components.B * 0.114);
        return ((255 - bgDelta) < nThreshold) ? "#000000" : "#ffffff";
    }

    function zoom(d) {
        treemap
            .padding([headerHeight/(chartHeight/d.dy), 0, 0, 0])
            .nodes(d);

        // moving the next two lines above treemap layout messes up padding of zoom result
        var kx = chartWidth  / d.dx;
        var ky = chartHeight / d.dy;
        var level = d;

        xscale.domain([d.x, d.x + d.dx]);
        yscale.domain([d.y, d.y + d.dy]);

        if (node != level) {
            if (supportsForeignObject) {
                chart.selectAll(".cell.child .foreignObject")
                        .style("display", "none");
            } else {
                chart.selectAll(".cell.child .foreignObject .labelbody .label")
                        .style("display", "none");
            }
        }

        var zoomTransition = chart.selectAll("g.cell").transition().duration(transitionDuration)
            .attr("transform", function(d) {
                return "translate(" + xscale(d.x) + "," + yscale(d.y) + ")";
            })
            .each("end", function(d, i) {
                if (!i && (level !== self.root)) {
                    chart.selectAll(".cell.child")
                        .filter(function(d) {
                            return d.parent === self.node; // only get the children for selected group
                        })
                        .select(".foreignObject .labelbody .label")
                        .style("color", function(d) {
                            return idealTextColor(color(d.parent.name));
                        });

                    if (supportsForeignObject) {
                        chart.selectAll(".cell.child")
                            .filter(function(d) {
                                return d.parent === self.node; // only get the children for selected group
                            })
                            .select(".foreignObject")
                            .style("display", "");
                    } else {
                        chart.selectAll(".cell.child")
                            .filter(function(d) {
                                return d.parent === self.node; // only get the children for selected group
                            })
                            .select(".foreignObject .labelbody .label")
                            .style("display", "");
                    }
                }
            });

        zoomTransition.select(".foreignObject")
            .attr("width", function(d) {
                return Math.max(0.01, kx * d.dx);
            })
            .attr("height", function(d) {
                return d.children ? headerHeight: Math.max(0.01, ky * d.dy);
            })
            .select(".labelbody .label")
            .text(function(d) {
				if (d != root) {
					return d.name;
				}
            });

        // update the width/height of the rects
        zoomTransition.select("rect")
            .attr("width", function(d) {
                return Math.max(0.01, kx * d.dx);
            })
            .attr("height", function(d) {
                return d.children ? headerHeight : Math.max(0.01, ky * d.dy);
            })
            .style("fill", function(d) {
                return d.children ? headerColor : d.color;
            });

        node = d;

        if (d3.event) {
            d3.event.stopPropagation();
        }
    }

	zoom(node);
}

/**
 * D3 based Tree map that you drill from the top down. Good for deep maps.
 * Built from code by Mike Bostock at this url: http://bost.ocks.org/mike/treemap/
 * @param container the div object to put the visualisation into
 * @param json the json holding the data to visualise
 * @param int width the width of the parent container
 * @param int height the height of the parent container
 */
function displayTreemapNetworkTopDownD3Vis(container, json, width, height) {

	var root = json;

	var margin = {top: 20, right: 0, bottom: 0, left: 0};
	height = height - margin.top - margin.bottom;
	var formatNumber = d3.format(",d");
	var transitioning;

	var x = d3.scale.linear()
		.domain([0, width])
		.range([0, width]);

	var y = d3.scale.linear()
		.domain([0, height])
		.range([0, height]);

	var treemap = d3.layout.treemap()
		.children(function(d, depth) { return depth ? null : d._children; })
        .value(function(d) {
            return d.size;
        })
		.sort(function(a, b) { return a.size - b.size; })
		.ratio(height / width * 0.5 * (1 + Math.sqrt(5)))
		.round(false);

	var svg = d3.select(container).append("svg")
		.attr("width", width + margin.left + margin.right)
		.attr("height", height + margin.bottom + margin.top)
		.style("margin-left", -margin.left + "px")
		.style("margin.right", -margin.right + "px")
	  	.append("g")
		.attr("transform", "translate(" + margin.left + "," + margin.top + ")")
		.style("shape-rendering", "crispEdges");

	var grandparent = svg.append("g")
		.attr("class", "grandparent");

	grandparent.append("rect")
		.attr("y", -margin.top)
		.attr("width", width)
		.attr("height", margin.top)
		.style("cursor", "pointer")
		.style("stroke-width", "2px")
		.style("fill", "orange")
		.on('mouseover', function (d,i) {
			d3.select(this).style("fill", "#ee9700");
		})
		.on('mouseout', function (d,i) {
			d3.select(this).style("fill", "orange");
		})
		;

	grandparent.append("text")
		.attr("x", 6)
		.attr("y", 6 - margin.top)
		.attr("dy", ".75em")
		.style("font-weight", "bold")
		.style("pointer-events", "none")
		;

	function initialize(root) {
		root.x = root.y = 0;
		root.dx = width;
		root.dy = height;
		root.depth = 0;
	}

	// Aggregate the sizes for internal nodes. This is normally done by the
	// treemap layout, but not here because of our custom implementation.
	// We also take a snapshot of the original children (_children) to avoid
	// the children being overwritten when when layout is computed.
	function accumulate(d) {
		return (d._children = d.children)
			? d.size = d.children.reduce(function(p, v) { return p + accumulate(v); }, 0)
			: d.size;
	}

	// Compute the treemap layout recursively such that each group of siblings
	// uses the same size (1×1) rather than the dimensions of the parent cell.
	// This optimizes the layout for the current zoom state. Note that a wrapper
	// object is created for the parent node for each group of siblings so that
	// the parent’s dimensions are not discarded as we recurse. Since each group
	// of sibling was laid out in 1×1, we must rescale to fit using absolute
	// coordinates. This lets us use a viewport to zoom.
	function layout(d) {
		if (d._children) {
		  treemap.nodes({_children: d._children});
		  d._children.forEach(function(c) {
			c.x = d.x + c.x * d.dx;
			c.y = d.y + c.y * d.dy;
			c.dx *= d.dx;
			c.dy *= d.dy;
			c.parent = d;
			layout(c);
		  });
		}
	}

	function display(d) {
		grandparent
			.datum(d.parent)
			.on("click", transition)
		  	.select("text")
			.text(name(d, 0));

		var g1 = svg.insert("g", ".grandparent")
			.datum(d)
			.attr("class", "depth");

		var g = g1.selectAll("g")
			.data(d._children)
		  .enter().append("g");

		g.filter(function(d) { return d._children; })
			.classed("children", true)
			.on("click", transition);

		g.selectAll(".child")
			.data(function(d) { return d._children || [d]; })
			.enter().append("rect")
			.style("cursor", "normal")
			.style("fill", function(d) {
				if (d._children) {
					return "#bbb";
				} else {
					return "#E8E8E8";
				}
			})
			.style("stroke", "#fff")
			.style("stroke-width", "2")
			.style("opacity", "0.4")
			.call(rect);

		g.append("rect")
			.attr("class", "parent")
			.style("fill", function(d) {
				return "#bbb";
			})
			.style("stroke", "#fff")
			.style("stroke-width", "2")
			.style("cursor", "normal")
			.style("opacity", "0.4")
			.on('mouseover', function (d,i) {
				if (d._children) {
					d3.select(this).style("opacity", "0.65");
					d3.select(this).style("cursor", "pointer");
				}
			})
			.on('mouseout', function (d,i) {
				if (d._children) {
					d3.select(this).style("opacity", "0.4");
					d3.select(this).style("cursor", "normal");
				}
			})
			.call(rect);

	   g.selectAll(".parent")
			.call(rect)
			.style("display", function (d,i) {
				if (d._children) {
					d3.select(this).style("display", "block");
				} else {
					d3.select(this).style("display", "none");
				}
			});

		// we do not want to see the size in this version as they have no meaning.
		/*.append("title")
		.text(function(d) { return formatNumber(d.size); });
		*/

		g.append("text")
			.attr("dy", ".75em")
			.text(function(d) { return d.name; })
			.call(text);

		function transition(d) {
		  if (transitioning || !d) return;
			  transitioning = true;

			  var g2 = display(d),
				  t1 = g1.transition().duration(750),
				  t2 = g2.transition().duration(750);

			  // Update the domain only after entering new elements.
			  x.domain([d.x, d.x + d.dx]);
			  y.domain([d.y, d.y + d.dy]);

			  // Enable anti-aliasing during the transition.
			  svg.style("shape-rendering", null);

			  // Draw child nodes on top of parent nodes.
			  svg.selectAll(".depth").sort(function(a, b) { return a.depth - b.depth; });

			  // Fade-in entering text.
			  g2.selectAll("text").style("fill-opacity", 0);

			  // Transition to the new view.
			  t1.selectAll("text").call(text).style("fill-opacity", 0);
			  t2.selectAll("text").call(text).style("fill-opacity", 1);
			  t1.selectAll("rect").call(rect);
			  t2.selectAll("rect").call(rect);

			  // Remove the old node when the transition is finished.
			  t1.remove().each("end", function() {
				svg.style("shape-rendering", "crispEdges");
				transitioning = false;
			  });
		}
		return g;
	}

	function text(text) {
		text.attr("x", function(d) { return x(d.x) + 6; })
			.attr("y", function(d) { return y(d.y) + 6; });
	}

	function rect(rect) {
		rect.attr("x", function(d) { return x(d.x); })
			.attr("y", function(d) { return y(d.y); })
			.attr("width", function(d) { return x(d.x + d.dx) - x(d.x); })
			.attr("height", function(d) { return y(d.y + d.dy) - y(d.y); });
	}

	/** Only show the last 2 depths of title in the history title bar.*/
	function name(d, depth) {
		if (d != root) {
			if (depth < 2) {
				var next = "";
				depth++;
				if (d.parent && d.parent != root) {
					next = name(d.parent, depth) + " / " + d.name;
				} else {
					next = d.name;
				}
			} else {
				next = "...";
			}
			return next;
		}
	}

	initialize(root);
	accumulate(root);
	layout(root);
	display(root);
}


/**
 * D3 based Tree map that you drill from the top down. Good for deep maps.
 * Built from code by Mike Bostock at this url: http://bost.ocks.org/mike/treemap/
 * @param container the div object to put the visualisation into
 * @param json the json holding the data to visualise
 * @param int width the width of the parent container
 * @param int height the height of the parent container
 */
function displayTreemapNetworkTopDownByTypeD3Vis(container, json, width, height) {

	var root =data = json;

	var margin = {top: 20, right: 0, bottom: 0, left: 0};
	height = height - margin.top - margin.bottom;
	var formatNumber = d3.format(",d");
	var transitioning;

	var x = d3.scale.linear()
		.domain([0, width])
		.range([0, width]);

	var y = d3.scale.linear()
		.domain([0, height])
		.range([0, height]);

	var treemap = d3.layout.treemap()
		.children(function(d, depth) { return depth ? null : d._children; })
        .value(function(d) {
            return d.size;
        })
		.sort(function(a, b) { return a.size - b.size; })
		.ratio(height / width * 0.5 * (1 + Math.sqrt(5)))
		.round(false);

	var pack = d3.layout.pack().value(function(d) { return d.size; });
	var nodes = pack.nodes( root );
	nodes.forEach(function(d) {
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
			} else {
				d.color = d.children ? color(d.depth) : null;
			}
		}
	});

    var legendarea = d3.select(container)
        .append("svg")
        .attr("width", width)
        .attr("style", 'height:20px;')
        .attr("height", 20)
        .append("g");

	var svg = d3.select(container).append("svg")
		.attr("width", width + margin.left + margin.right)
		.attr("height", height + margin.bottom + margin.top)
		.style("margin-left", -margin.left + "px")
		.style("margin.right", -margin.right + "px")
	  	.append("g")
		.attr("transform", "translate(" + margin.left + "," + margin.top + ")")
		.style("shape-rendering", "crispEdges");

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

	var grandparent = svg.append("g")
		.attr("class", "grandparent");

	grandparent.append("rect")
		.attr("y", -margin.top)
		.attr("width", width)
		.attr("height", margin.top)
		.style("cursor", "pointer")
		.style("stroke-width", "2px")
		.style("fill", "orange")
		.on('mouseover', function (d,i) {
			d3.select(this).style("fill", "#ee9700");
		})
		.on('mouseout', function (d,i) {
			d3.select(this).style("fill", "orange");
		})
		;

	grandparent.append("text")
		.attr("x", 6)
		.attr("y", 6 - margin.top)
		.attr("dy", ".75em")
		.style("font-weight", "bold")
		.style("pointer-events", "none")
		;

	function initialize(root) {
		root.x = root.y = 0;
		root.dx = width;
		root.dy = height;
		root.depth = 0;
	}

	// Aggregate the sizes for internal nodes. This is normally done by the
	// treemap layout, but not here because of our custom implementation.
	// We also take a snapshot of the original children (_children) to avoid
	// the children being overwritten when when layout is computed.
	function accumulate(d) {
		return (d._children = d.children)
			? d.size = d.children.reduce(function(p, v) { return p + accumulate(v); }, 0)
			: d.size;
	}

	// Compute the treemap layout recursively such that each group of siblings
	// uses the same size (1×1) rather than the dimensions of the parent cell.
	// This optimizes the layout for the current zoom state. Note that a wrapper
	// object is created for the parent node for each group of siblings so that
	// the parent’s dimensions are not discarded as we recurse. Since each group
	// of sibling was laid out in 1×1, we must rescale to fit using absolute
	// coordinates. This lets us use a viewport to zoom.
	function layout(d) {
		if (d._children) {
		  treemap.nodes({_children: d._children});
		  d._children.forEach(function(c) {
			c.x = d.x + c.x * d.dx;
			c.y = d.y + c.y * d.dy;
			c.dx *= d.dx;
			c.dy *= d.dy;
			c.parent = d;
			layout(c);
		  });
		}
	}

	function display(d) {
		grandparent
			.datum(d.parent)
			.on("click", transition)
		  	.select("text")
			.text(name(d, 0));

		var g1 = svg.insert("g", ".grandparent")
			.datum(d)
			.attr("class", "depth");

		var g = g1.selectAll("g")
			.data(d._children)
		  .enter().append("g");

		g.filter(function(d) { return d._children; })
			.classed("children", true)
			.on("click", transition);

		g.selectAll(".child")
			.data(function(d) { return d._children || [d]; })
			.enter().append("rect")
			.style("cursor", "normal")
			.style("fill", function(d) {
				return d.color;
				/*if (d._children) {
					return "#bbb";
				} else {
					return "#E8E8E8";
				}*/
			})
			.style("stroke", '#fff')
			.style("stroke-width", "2")
			.style("opacity", "1")
			.call(rect);

		g.append("rect")
			.attr("class", "parent")
			.style("fill", function(d) {
				return d.color;
				//return "#bbb";
			})
			.style("stroke", "#fff")
			.style("stroke-width", "2")
			.style("cursor", function (d,i) {
				if (d._children) {
					d3.select(this).style("cursor", "pointer");
				} else {
					d3.select(this).style("cursor", "normal");
				}
			})
			.style("opacity", "0.8")
			.on('mouseover', function (d,i) {
				if (d._children) {
					d3.select(this).style("opacity", "0.3");
					d3.select(this).style("cursor", "pointer");
				}
			})
			.on('mouseout', function (d,i) {
				if (d._children) {
					d3.select(this).style("opacity", "0.8");
					d3.select(this).style("cursor", "normal");
				}
			})
			.call(rect);

	   g.selectAll(".parent")
			.call(rect)
			.style("display", function (d,i) {
				if (d._children) {
					d3.select(this).style("display", "block");
				} else {
					d3.select(this).style("display", "none");
				}
			});

		// we do not want to see the size in this version as they have no meaning.
		/*.append("title")
		.text(function(d) { return formatNumber(d.size); });
		*/

		g.append("text")
			.attr("dy", ".75em")
			.text(function(d) { return d.name; })
			.call(text);

		function transition(d) {
		  if (transitioning || !d) return;
			  transitioning = true;

			  var g2 = display(d),
				  t1 = g1.transition().duration(750),
				  t2 = g2.transition().duration(750);

			  // Update the domain only after entering new elements.
			  x.domain([d.x, d.x + d.dx]);
			  y.domain([d.y, d.y + d.dy]);

			  // Enable anti-aliasing during the transition.
			  svg.style("shape-rendering", null);

			  // Draw child nodes on top of parent nodes.
			  svg.selectAll(".depth").sort(function(a, b) { return a.depth - b.depth; });

			  // Fade-in entering text.
			  g2.selectAll("text").style("fill-opacity", 0);

			  // Transition to the new view.
			  t1.selectAll("text").call(text).style("fill-opacity", 0);
			  t2.selectAll("text").call(text).style("fill-opacity", 1);
			  t1.selectAll("rect").call(rect);
			  t2.selectAll("rect").call(rect);

			  // Remove the old node when the transition is finished.
			  t1.remove().each("end", function() {
				svg.style("shape-rendering", "crispEdges");
				transitioning = false;
			  });
		}
		return g;
	}

	function text(text) {
		text.attr("x", function(d) { return x(d.x) + 6; })
			.attr("y", function(d) { return y(d.y) + 6; });
	}

	function rect(rect) {
		rect.attr("x", function(d) { return x(d.x); })
			.attr("y", function(d) { return y(d.y); })
			.attr("width", function(d) { return x(d.x + d.dx) - x(d.x); })
			.attr("height", function(d) { return y(d.y + d.dy) - y(d.y); });
	}

	/** Only show the last 2 depths of title in the history title bar.*/
	function name(d, depth) {
		if (d != root) {
			if (depth < 2) {
				var next = "";
				depth++;
				if (d.parent && d.parent != root) {
					next = name(d.parent, depth) + " / " + d.name;
				} else {
					next = d.name;
				}
			} else {
				next = "...";
			}
			return next;
		}
	}

	initialize(root);
	accumulate(root);
	layout(root);
	display(root);
}