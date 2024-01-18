
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
 * D3 based Tree with titles.
 * Built on top of code by M Bostock at this url: http://mbostock.github.io/d3/talk/20111018/tree.html
 * @param container the div object to put the visualisation into
 * @param json the json holding the data to visualise
 * @param int width the width of the parent container
 * @param int height the height of the parent container
 */
function displayPlainTreeD3Vis(container, json, width, height) {

	var m = [20, 120, 20, 120];
	var w = 1280 - m[1] - m[3];
	var h = 800 - m[0] - m[2];
	var i = 0;
	var root;

	//var formatNumber = d3.format(",.3f");

	var tree = d3.layout.tree()
		.size([h, w]);

	var diagonal = d3.svg.diagonal()
		.projection(function(d) { return [d.y, d.x]; });

	var vis = d3.select(container)
	    .append("svg:svg")
		.attr("width", w + m[1] + m[3])
		.attr("height", h + m[0] + m[2])
	    .append("svg:g")
		.attr("transform", "translate(" + m[3] + "," + m[0] + ")");

	root = json;
	root.x0 = h / 2;
	root.y0 = 0;

	root.children.forEach(toggleAll);
	update(root);

	function update(source) {
		var duration = d3.event && d3.event.altKey ? 5000 : 500;

		// Compute the new tree layout.
		var nodes = tree.nodes(root).reverse();

		// Normalize for fixed-depth.
		nodes.forEach(function(d) { d.y = d.depth * 180; });

		// Update the nodes…
		var node = vis.selectAll("g.nodez")
		  .data(nodes, function(d) { return d.id || (d.id = ++i); });

		// Enter any new nodes at the parent's previous position.
		var nodeEnter = node.enter().append("svg:g")
		  .attr("class", "node")
		  .attr("transform", function(d) { return "translate(" + source.y0 + "," + source.x0 + ")"; })
		  .on("click", function(d) { toggle(d); update(d); });

		nodeEnter.append("svg:circle")
		  .attr("r", 1e-6)
		  .style("fill", function(d) { return d._children ? "lightsteelblue" : "#fff"; });

		nodeEnter.append("svg:text")
		  .attr("x", function(d) { return d.children || d._children ? -10 : 10; })
		  .attr("dy", ".35em")
		  .attr("text-anchor", function(d) { return d.children || d._children ? "end" : "start"; })
		  .text(function(d) { return d.name; })
		  .style("fill-opacity", 1e-6);

		// Transition nodes to their new position.
		var nodeUpdate = node.transition()
		  .duration(duration)
		  .attr("transform", function(d) { return "translate(" + d.y + "," + d.x + ")"; });

		nodeUpdate.select("circle")
		  .attr("r", 4.5)
		  .style("fill", function(d) { return d._children ? "lightsteelblue" : "#fff"; });

		nodeUpdate.select("text")
		  .style("fill-opacity", 1);

		// Transition exiting nodes to the parent's new position.
		var nodeExit = node.exit().transition()
		  .duration(duration)
		  .attr("transform", function(d) { return "translate(" + source.y + "," + source.x + ")"; })
		  .remove();

		nodeExit.select("circle")
		  .attr("r", 1e-6);

		nodeExit.select("text")
		  .style("fill-opacity", 1e-6);

		// Update the links…
		var link = vis.selectAll("path.link")
		  .data(tree.links(nodes), function(d) { return d.target.id; });

		// Enter any new links at the parent's previous position.
		link.enter().insert("svg:path", "g")
		  .attr("class", "link")
		  .attr("d", function(d) {
			var o = {x: source.x0, y: source.y0};
			return diagonal({source: o, target: o});
		  })
		.transition()
		  .duration(duration)
		  .attr("d", diagonal);

		// Transition links to their new position.
		link.transition()
		  .duration(duration)
		  .attr("d", diagonal);

		// Transition exiting nodes to the parent's new position.
		link.exit().transition()
		  .duration(duration)
		  .attr("d", function(d) {
			var o = {x: source.x, y: source.y};
			return diagonal({source: o, target: o});
		  })
		  .remove();

		// Stash the old positions for transition.
		nodes.forEach(function(d) {
			d.x0 = d.x;
			d.y0 = d.y;
		});
	}
}

/**
 * D3 based Tree with titles and panning and zooming.
 * Built on top of code by Rob Schmuecker at this url: http://bl.ocks.org/robschmuecker/7880033
 * @param container the div object to put the visualisation into
 * @param json the json holding the data to visualise
 * @param int width the width of the parent container
 * @param int height the height of the parent container
 */
function displayTreeZoomD3Vis(container, json, width, height) {
	var treeData = json;

	var myname = "<?php echo $CFG->VIS_PAGE_TREE; ?>"

	var toolTip = d3.select(document.getElementById("toolTip"));
    toolTip.on('mouseover', function() {
        toolTip.transition();
    });
    toolTip.on('mouseleave', function() {
        toolTip.style('display', 'none');
        postMessageToPage(myname,'mouseout','hideinfo','node',toolTip.nodeid);
    });

	var exploreButton = d3.select(document.getElementById("explorebutton"));
	exploreButton.on('click', exploreNode);

	var tooltipWidth = 300;
	var tooltipHeight = 210;

    // Calculate total nodes, max label length
    var totalNodes = 0;
    var maxLabelLength = 0;

    // variables for drag/drop
    var selectedNode = null;
    var draggingNode = null;

    // panning variables
    var panSpeed = 200;
    var panBoundary = 20; // Within 20px from edges will pan when dragging.

    var i = 0;
    var duration = 750;

    // Define the root
    var root = treeData;
    root.x0 = viewerHeight / 2;
    root.y0 = 0;


    // size of the diagram
    var viewerWidth = width;
    var viewerHeight = height;

    var tree = d3.layout.tree().size([viewerHeight, viewerWidth]);

	var maxNumChildren = 0;
    var nodes = tree.nodes(root).reverse();
	nodes.forEach(function(d) {
		d.color = '#E8E8E8';
		if (d.branch) {
			d.color = getTreeColour(d.branch);
		}
		d.numChildren = (d.children) ? d.children.length : 0;
		if (d.numChildren == 0 && d._children) {
			d.numChildren = d._children.length;
		};
		if (d.numChildren > maxNumChildren) {
			maxNumChildren = d.numChildren;
		}
	});

    // define a d3 diagonal projection for use by the node paths later on.
    var diagonal = d3.svg.diagonal()
        .projection(function(d) {
            return [d.y, d.x];
        });

   // A recursive helper function for performing some setup by walking through all nodes

    function visit(parent, visitFn, childrenFn) {
        if (!parent) return;

        visitFn(parent);

        var children = childrenFn(parent);
        if (children) {
            var count = children.length;
            for (var i = 0; i < count; i++) {
                visit(children[i], visitFn, childrenFn);
            }
        }
    }

    // Call visit function to establish maxLabelLength
    visit(treeData, function(d) {
        totalNodes++;
        maxLabelLength = Math.max(d.name.length, maxLabelLength);

    }, function(d) {
        return d.children && d.children.length > 0 ? d.children : null;
    });


    // sort the tree according to the node names

    function sortTree() {
        tree.sort(function(a, b) {
            return b.name.toLowerCase() < a.name.toLowerCase() ? 1 : -1;
        });
    }
    // Sort the tree initially incase the JSON is not in a sorted order.
    sortTree();

    // TODO: Pan function, can be better implemented.
    function pan(domNode, direction) {
        var speed = panSpeed;
        if (panTimer) {
            clearTimeout(panTimer);
            translateCoords = d3.transform(svgGroup.attr("transform"));
            if (direction == 'left' || direction == 'right') {
                translateX = direction == 'left' ? translateCoords.translate[0] + speed : translateCoords.translate[0] - speed;
                translateY = translateCoords.translate[1];
            } else if (direction == 'up' || direction == 'down') {
                translateX = translateCoords.translate[0];
                translateY = direction == 'up' ? translateCoords.translate[1] + speed : translateCoords.translate[1] - speed;
            }
            scaleX = translateCoords.scale[0];
            scaleY = translateCoords.scale[1];
            scale = zoomListener.scale();
            svgGroup.transition().attr("transform", "translate(" + translateX + "," + translateY + ")scale(" + scale + ")");
            d3.select(domNode).select('g.nodez').attr("transform", "translate(" + translateX + "," + translateY + ")");
            zoomListener.scale(zoomListener.scale());
            zoomListener.translate([translateX, translateY]);
            panTimer = setTimeout(function() {
                pan(domNode, speed, direction);
            }, 50);
        }
    }

    // Define the zoom function for the zoomable tree

    function zoom() {
        svgGroup.attr("transform", "translate(" + d3.event.translate + ")scale(" + d3.event.scale + ")");
    }

    // define the zoomListener which calls the zoom function on the "zoom" event constrained within the scaleExtents
    var zoomListener = d3.behavior.zoom().scaleExtent([0.1, 3]).on("zoom", zoom);

    // define the baseSvg, attaching a class for styling and the zoomListener
    var baseSvg = d3.select(container).append("svg")
        .attr("width", viewerWidth)
        .attr("height", viewerHeight)
        .attr("class", "overlay")
        .call(zoomListener);

    // Function to center node when clicked/dropped so node does not get lost when collapsing/moving with large amount of children.

    function centerNode(d) {
        var scale = zoomListener.scale();
        var x = -d.y0;
        var y = -d.x0;
        x = x * scale + viewerWidth / 2;
        y = y * scale + viewerHeight / 2;
        d3.select('g.maing').transition()
            .duration(duration)
            .attr("transform", "translate(" + x + "," + y + ")scale(" + scale + ")");
        zoomListener.scale(scale);
        zoomListener.translate([x, y]);
    }

    // Toggle children on click.
    function click(d) {
    	if (!d.nodeid) {
    		return;
    	}

        var action = 'expand';
		if (d.children) {
			action = 'collapse';
		}
        postMessageToPage(myname,'click',action,'node',d.nodeid);

        d = toggleChildren(d);
        update(d);
        centerNode(d);
    }

	function exploreNode() {
		var homepage = $('explorebutton').homepage;
    	var win = window.open(homepage, '_blank');
		win.focus();
	}

    function onMouseOut(obj, d) {
    	if (!d.nodeid) {
    		return;
    	}

		toolTip.transition().delay(500)
		  .style('display', 'none')
		  .each("end", function() {
				postMessageToPage(myname,'mouseout','hideinfo','node',d.nodeid);
		  });
	}

    function onMouseOver(obj, d) {
		toolTip.nodeid = '';
		if (!d.nodeid) {
    		return;
    	}
    	toolTip.nodeid = d.nodeid

 		postMessageToPage(myname,'mouseover','showinfo','node',d.nodeid);

        toolTip.transition();

		if (d.numChildren && d.numChildren > 0) {
			$('childcount').update(d.numChildren);
			$('childcountdiv').style.display = "block";
		} else {
			$('childcount').update(0);
			$('childcountdiv').style.display = "none";
		}

		$('nodename').update(d.name);
		if (d.description) {
			$('nodedesc').update(d.description);
		} else {
			$('nodedesc').update("");
		}

		if (d.image) {
			$("nodeimg").src = d.image;
			$("nodeimg").title = d.nodetypename;
			$("nodeimg").style.display = "block";
		} else {
			$("nodeimg").title = "";
			$("nodeimg").style.display = "none";
		}

		//if (typeof d.description !== 'undefined') {

		var leftpos = d3.event.pageX + 15;
		var toppos = d3.event.pageY - 75;
        if ( (leftpos + tooltipWidth) > window.innerWidth) {
        	leftpos = leftpos - tooltipWidth - 50;
        }
        if ( (toppos + tooltipHeight) > window.innerHeight) {
        	toppos = toppos - tooltipHeight;
        }

		if (d.homepage && d.homepage != "") {
			$('explorebutton').homepage = d.homepage;
			$('explorebutton').style.display = "block";
		} else {
			$('explorebutton').homepage = "";
			$('explorebutton').style.display = "none";
		}

        toolTip.style("left", leftpos + "px").style("top", toppos + "px");

	    toolTip.style('display', 'block');
    };

    function update(source) {
        // Compute the new height, function counts total children of root node and sets tree height accordingly.
        // This prevents the layout looking squashed when new nodes are made visible or looking sparse when nodes are removed
        // This makes the layout more consistent.
        var levelWidth = [1];
        var childCount = function(level, n) {
            if (n.children && n.children.length > 0) {
                if (levelWidth.length <= level + 1) levelWidth.push(0);

                levelWidth[level + 1] += n.children.length;
                n.children.forEach(function(d) {
                    childCount(level + 1, d);
                });
            }
        };
        childCount(0, root);

        var newHeight = d3.max(levelWidth) * 35; // 25 pixels per line
        tree = tree.size([newHeight, viewerWidth]);

        // Compute the new tree layout.
        var nodes = tree.nodes(root).reverse();
        var links = tree.links(nodes);

		nodes.forEach(function(d) {
			d.y = (d.depth * 300); //500px per level.
			d.color = '#E8E8E8';
			if (d.branch) {
				d.color = getTreeColour(d.branch);
			}
		});

        // Set widths between levels based on maxLabelLength.
        //nodes.forEach(function(d) {
            //d.y = (d.depth * (maxLabelLength * 10)); //maxLabelLength * 10px
            // alternatively to keep a fixed scale one can set a fixed depth per level
            // Normalize for fixed-depth by commenting out below line
            //d.y = (d.depth * 300); //500px per level.
        //});

        // Update the nodes…
        node = svgGroup.selectAll("g.nodez")
            .data(nodes, function(d) {
                return d.id || (d.id = ++i);
            });

        // Enter any new nodes at the parents previous position.
        var nodeEnter = node.enter().append("g")
            .attr("class", "nodez")
            .attr("transform", function(d) {
                return "translate(" + source.y0 + "," + source.x0 + ")";
            })
            .on('click', click);

        nodeEnter.append("circle")
            .attr('class', 'nodeCircle')
            .style("stroke-width", '1.5px')
            .style("stroke", function(d) {
                return d.color;
            })
            .attr("r", function(d) {
       	   		return calculateTreeNodeSize(d.numChildren, maxNumChildren);
                //return d.numChildren+1;
            })
            .style("fill", function(d) {
                return d.color;
            })
			.on("mouseover", function(d) {
				onMouseOver(this, d);
			})
			.on("mouseout", function(d) {
				onMouseOut(this, d);
			})
            .style("fill-opacity", function(d) {
                return d.children ? 0.8 : 0.5;
            });

        nodeEnter.append("text")
            .attr("x", function(d) {
                return d.children || d._children ? -10 : 10;
            })
            .attr("dy", ".35em")
            .attr('class', 'nodeText')
            .attr("text-anchor", function(d) {
                return d.children || d._children ? "end" : "start";
            })
            .text(function(d) {
            	if (d.name.length > 36) {
            		return d.name.substr(0,36)+"...";
            	} else {
                	return d.name;
                }
            })
            .style("fill-opacity", 0);

        // Move text to in front of cicle if has children or behind circle if is leaf.
        node.selectAll('text.nodeText')
            .attr("x", function(d) {
                return d.children || d._children ? -10 : 10;
            })
            .style("fill-opacity", 1)
            .attr("text-anchor", function(d) {
                return d.children || d._children ? "end" : "start";
            })
            .text(function(d) {
            	if (d.name.length > 36) {
            		return d.name.substr(0,36)+"...";
            	} else {
                	return d.name;
                }
            });


        // Transition nodes to their new position.
        var nodeUpdate = node.transition()
            .duration(duration)
            .attr("transform", function(d) {
                return "translate(" + d.y + "," + d.x + ")";
            });

        // Fade the text in
        nodeUpdate.selectAll("text.nodeText").style("fill-opacity", 1);

        // Transition exiting nodes to the parents new position.
        var nodeExit = node.exit().transition()
            .duration(duration)
            .attr("transform", function(d) {
                return "translate(" + source.y + "," + source.x + ")";
            })
            .remove();

        nodeExit.selectAll("circle.nodeCircle").attr("r", 0);

        nodeExit.selectAll("text.nodeText").style("fill-opacity", 0);

        // Update the links…
        var linkcount;
        var link = svgGroup.selectAll("path.link")
            .data(links, function(d) {
                return d.target.id;
            });

        // Enter any new links at the parents previous position.
        link.enter().insert("path", "g")
            .attr("class", "link")
            .attr("d", function(d) {
                var o = {
                    x: source.x0,
                    y: source.y0
                };
                return diagonal({
                    source: o,
                    target: o
                });
            })
		    .style("stroke", function(d) {
		    	return d.target.color;
		    })
		    .style("stroke-width", function(d) {
		    	if (d.target.numChildren) {
	           	   	return calculateTreeLinkSize(d.target.numChildren, maxNumChildren);
		    		//return (d.target.numChildren+1) * 2;
		    	} else {
	           	   	return calculateTreeLinkSize(0, maxNumChildren);
		    		//return 6;
		    	}
		    })
			.style("stroke-opacity", function(d) {
				var size = ((d.source.depth + 1) / 4.5);
				return size;
			})
		    .style("stroke-linecap", "round");

	    //.style("stroke-opacity","0.3")

        // Transition links to their new position.
        link.transition()
            .duration(duration)
            .attr("d", diagonal);

        // Transition exiting nodes to the parents new position.
        link.exit().transition()
            .duration(duration)
            .attr("d", function(d) {
                var o = {
                    x: source.x,
                    y: source.y
                };
                return diagonal({
                    source: o,
                    target: o
                });
            })
            .remove();

        // Stash the old positions for transition.
        nodes.forEach(function(d) {
            d.x0 = d.x;
            d.y0 = d.y;
        });
    }

    // Append a group which holds all nodes and which the zoom Listener can act upon.
    var svgGroup = baseSvg.append("g").attr("class", "maing");

	var expandButton = d3.select(document.getElementById("treeexpandall"));
	expandButton.on('click', function () {
        postMessageToPage(myname,'click','expandall','global','global');
		if (root.children) {
			root.children.forEach(function(d) {
				expand(d);
			});
		} else {
			root._children.forEach(function(d) {
				expand(d);
			});
		}
		update(root);
		centerNode(root);
	});

	var collapseButton = d3.select(document.getElementById("treecollapseall"));
	collapseButton.on('click', function () {
		postMessageToPage(myname,'click','collapseall','global','global');
		root.children.forEach(toggleAll);
		update(root);
		centerNode(root);
 	});

	//createTreeLegend(maxNumChildren);

    // Layout the tree initially and center on the root node.
    root.children.forEach(toggleAll);
    update(root);
    centerNode(root);
}

/**
 * D3 based Tree with titles and panning and zooming and associated Posts as the size determiner.
 * Built on top of code by Rob Schmuecker at this url: http://bl.ocks.org/robschmuecker/7880033
 * @param container the div object to put the visualisation into
 * @param json the json holding the data to visualise
 * @param int width the width of the parent container
 * @param int height the height of the parent container
 */
function displayTreeZoomD3VisPosts(container, json, width, height) {
	var treeData = json;

	var myname = "<?php echo $CFG->VIS_PAGE_TREE_BY_POSTS; ?>"

	var toolTip = d3.select(document.getElementById("toolTip"));
    toolTip.on('mouseover', function() {
        toolTip.transition();
    });
    toolTip.on('mouseleave', function() {
        postMessageToPage(myname,'mouseout','hideinfo','node',toolTip.nodeid);
        toolTip.style('display', 'none');
    });

	var exploreButton = d3.select(document.getElementById("explorebutton"));
	exploreButton.on('click', exploreNode);

	var tooltipWidth = 300;
	var tooltipHeight = 210;

    // Calculate total nodes, max label length
    var totalNodes = 0;
    var maxLabelLength = 0;

    // variables for drag/drop
    var selectedNode = null;
    var draggingNode = null;

    // panning variables
    var panSpeed = 200;
    var panBoundary = 20; // Within 20px from edges will pan when dragging.

    var i = 0;
    var duration = 750;

    // Define the root
    var root = treeData;
    root.x0 = viewerHeight / 2;
    root.y0 = 0;

    // size of the diagram
    var viewerWidth = width;
    var viewerHeight = height;

    var tree = d3.layout.tree().size([viewerHeight, viewerWidth]);

    // Set widths between levels based on maxLabelLength.
    //nodes.forEach(function(d) {
	     //d.y = (d.depth * (maxLabelLength * 10)); //maxLabelLength * 10px
         // alternatively to keep a fixed scale one can set a fixed depth per level
         // Normalize for fixed-depth by commenting out below line
         //d.y = (d.depth * 300); //500px per level.
   //});

	var maxNumChildren = 0;
	var maxNumComments = 0;
    var nodes = tree.nodes(root).reverse();
	nodes.forEach(function(d) {
		d.y = (d.depth * 300); //500px per level.
		d.color = '#E8E8E8';
		if (d.branch) {
			d.color = getTreeColour(d.branch);
		}
		d.numChildren = (d.children) ? d.children.length : 0;
		if (d.numChildren == 0 && d._children) {
			d.numChildren = d._children.length;
		};
		if (d.numChildren > maxNumChildren) {
			maxNumChildren = d.numChildren;
		}
		if (d.commentcount) {
			d.commentcount = parseInt(d.commentcount);
		} else {
			d.commentcount = 0;
		}
		if (d.commentcount > maxNumComments) {
			maxNumComments = d.commentcount;
		}
	});


    // define a d3 diagonal projection for use by the node paths later on.
    var diagonal = d3.svg.diagonal()
        .projection(function(d) {
            return [d.y, d.x];
        });

   // A recursive helper function for performing some setup by walking through all nodes

    function visit(parent, visitFn, childrenFn) {
        if (!parent) return;

        visitFn(parent);

        var children = childrenFn(parent);
        if (children) {
            var count = children.length;
            for (var i = 0; i < count; i++) {
                visit(children[i], visitFn, childrenFn);
            }
        }
    }

    // Call visit function to establish maxLabelLength
    visit(treeData, function(d) {
        totalNodes++;
        maxLabelLength = Math.max(d.name.length, maxLabelLength);

    }, function(d) {
        return d.children && d.children.length > 0 ? d.children : null;
    });


    // sort the tree according to the node names

    function sortTree() {
        tree.sort(function(a, b) {
            return b.name.toLowerCase() < a.name.toLowerCase() ? 1 : -1;
        });
    }
    // Sort the tree initially incase the JSON is not in a sorted order.
    sortTree();

    // TODO: Pan function, can be better implemented.
    function pan(domNode, direction) {
        var speed = panSpeed;
        if (panTimer) {
            clearTimeout(panTimer);
            translateCoords = d3.transform(svgGroup.attr("transform"));
            if (direction == 'left' || direction == 'right') {
                translateX = direction == 'left' ? translateCoords.translate[0] + speed : translateCoords.translate[0] - speed;
                translateY = translateCoords.translate[1];
            } else if (direction == 'up' || direction == 'down') {
                translateX = translateCoords.translate[0];
                translateY = direction == 'up' ? translateCoords.translate[1] + speed : translateCoords.translate[1] - speed;
            }
            scaleX = translateCoords.scale[0];
            scaleY = translateCoords.scale[1];
            scale = zoomListener.scale();
            svgGroup.transition().attr("transform", "translate(" + translateX + "," + translateY + ")scale(" + scale + ")");
            d3.select(domNode).select('g.nodez').attr("transform", "translate(" + translateX + "," + translateY + ")");
            zoomListener.scale(zoomListener.scale());
            zoomListener.translate([translateX, translateY]);
            panTimer = setTimeout(function() {
                pan(domNode, speed, direction);
            }, 50);
        }
    }

    // Define the zoom function for the zoomable tree
    function zoom() {
        svgGroup.attr("transform", "translate(" + d3.event.translate + ")scale(" + d3.event.scale + ")");
    }

    // define the zoomListener which calls the zoom function on the "zoom" event constrained within the scaleExtents
    var zoomListener = d3.behavior.zoom().scaleExtent([0.1, 3]).on("zoom", zoom);

    // define the baseSvg, attaching a class for styling and the zoomListener
    var baseSvg = d3.select(container).append("svg")
        .attr("width", viewerWidth)
        .attr("height", viewerHeight)
        .attr("class", "overlay")
        .call(zoomListener);

    // Function to center node when clicked/dropped so node does not get lost when collapsing/moving with large amount of children.
    function centerNode(d) {
        var scale = zoomListener.scale();
        var x = -d.y0;
        var y = -d.x0;
        x = x * scale + viewerWidth / 2;
        y = y * scale + viewerHeight / 2;
        d3.select('g.maing').transition()
            .duration(duration)
            .attr("transform", "translate(" + x + "," + y + ")scale(" + scale + ")");
        zoomListener.scale(scale);
        zoomListener.translate([x, y]);
    }

	function exploreNode() {
		var homepage = $('explorebutton').homepage;
    	var win = window.open(homepage, '_blank');
		win.focus();
	}

    // Toggle children on click.
    function click(d) {
    	if (!d.nodeid) {
    		return;
    	}

        var action = 'expand';
		if (d.children) {
			action = 'collapse';
		}
        postMessageToPage(myname,'click',action,'node',d.nodeid);

        d = toggleChildren(d);
        update(d);
        centerNode(d);
    }

    function onMouseOut(obj, d) {
    	if (!d.nodeid) {
    		return;
    	}

		toolTip.transition().delay(500)
		  .style('display', 'none')
		  .each("end", function() {
				postMessageToPage(myname,'mouseout','hideinfo','node',d.nodeid);
		  });
	}

    function onMouseOver(obj, d) {
		toolTip.nodeid = '';
    	if (!d.nodeid) {
    		return;
    	}

		toolTip.nodeid = d.nodeid;

        postMessageToPage(myname,'mouseover','showinfo','node',d.nodeid);

        toolTip.transition();

		if (d.commentcount && d.commentcount > 0) {
			$('commentcount').update(d.commentcount);
			$('commentcountdiv').style.display = "block";
		} else {
			$('commentcount').update(0);
			$('commentcountdiv').style.display = "none";
		}

		$('nodename').update(d.name);
		if (d.description) {
			$('nodedesc').update(d.description);
		} else {
			$('nodedesc').update("");
		}

		if (d.image) {
			$("nodeimg").src = d.image;
			$("nodeimg").title = d.nodetypename;
			$("nodeimg").style.display = "block";
		} else {
			$("nodeimg").title = "";
			$("nodeimg").style.display = "none";
		}

		var leftpos = d3.event.pageX + 15;
		var toppos = d3.event.pageY - 75;
        if ( (leftpos + tooltipWidth) > window.innerWidth) {
        	leftpos = leftpos - tooltipWidth - 50;
        }
        if ( (toppos + tooltipHeight) > window.innerHeight) {
        	toppos = toppos - tooltipHeight;
        }

		if (d.homepage && d.homepage != "") {
			$('explorebutton').homepage = d.homepage;
			$('explorebutton').style.display = "block";
		} else {
			$('explorebutton').homepage = "";
			$('explorebutton').style.display = "none";
		}

        toolTip.style("left", leftpos + "px").style("top", toppos + "px");
	    toolTip.style('display', 'block');
    };

    function update(source) {
        // Compute the new height, function counts total children of root node and sets tree height accordingly.
        // This prevents the layout looking squashed when new nodes are made visible or looking sparse when nodes are removed
        // This makes the layout more consistent.
        var levelWidth = [1];
        var childCount = function(level, n) {
            if (n.children && n.children.length > 0) {
                if (levelWidth.length <= level + 1) levelWidth.push(0);

                levelWidth[level + 1] += n.children.length;
                n.children.forEach(function(d) {
                    childCount(level + 1, d);
                });
            }
        };
        childCount(0, root);

        var newHeight = d3.max(levelWidth) * 35; // 25 pixels per line
        tree = tree.size([newHeight, viewerWidth]);

        // Compute the new tree layout.
        var nodes = tree.nodes(root).reverse();
        var links = tree.links(nodes);

		nodes.forEach(function(d) {
			d.y = (d.depth * 300); //500px per level.
		});

        // Update the nodes…
        node = svgGroup.selectAll("g.nodez")
            .data(nodes, function(d) {
                return d.id || (d.id = ++i);
            });

        // Enter any new nodes at the parents previous position.
        var nodeEnter = node.enter().append("g")
            .attr("class", "nodez")
            .attr("transform", function(d) {
                return "translate(" + source.y0 + "," + source.x0 + ")";
            })
            .on('click', click);

        nodeEnter.append("circle")
            .attr('class', 'nodeCircle')
            .style("stroke-width", '1.5px')
            .style("stroke", function(d) {
                return d.color;
            })
            .style("fill", function(d) {
                return d.color;
            })
            .attr("r", function(d) {
            	if (d.commentcount) {
            	   	return calculateTreeNodeSize(d.commentcount, maxNumComments);
            		//return parseInt(d.commentcount)+1;
            	} else {
                	return calculateTreeNodeSize(0, maxNumComments);
                	// return 6;
                }
            })
			.on("mouseover", function(d) {
				onMouseOver(this, d);
			})
			.on("mouseout", function(d) {
				onMouseOut(this, d);
			})
            .style("fill-opacity", function(d) {
                return d.children ? 0.8 : 0.5;
            });

        nodeEnter.append("text")
            .attr("x", function(d) {
                return d.children || d._children ? -10 : 10;
            })
            .attr("dy", ".35em")
            .attr('class', 'nodeText')
            .attr("text-anchor", function(d) {
                return d.children || d._children ? "end" : "start";
            })
            .text(function(d) {
            	if (d.name.length > 36) {
            		return d.name.substr(0,36)+"...";
            	} else {
                	return d.name;
                }
            })
            .style("fill-opacity", 0);

        // Move text to in front of cicle if has children or behind circle if is leaf.
        node.selectAll('text.nodeText')
            .attr("x", function(d) {
                return d.children || d._children ? -10 : 10;
            })
            .style("fill-opacity", 1)
            .attr("text-anchor", function(d) {
                return d.children || d._children ? "end" : "start";
            })
            .text(function(d) {
            	if (d.name.length > 36) {
            		return d.name.substr(0,36)+"...";
            	} else {
                	return d.name;
                }
            });


        // Transition nodes to their new position.
        var nodeUpdate = node.transition()
            .duration(duration)
            .attr("transform", function(d) {
                return "translate(" + d.y + "," + d.x + ")";
            });

        // Fade the text in
        nodeUpdate.selectAll("text.nodeText").style("fill-opacity", 1);

        // Transition exiting nodes to the parents new position.
        var nodeExit = node.exit().transition()
            .duration(duration)
            .attr("transform", function(d) {
                return "translate(" + source.y + "," + source.x + ")";
            })
            .remove();

        nodeExit.selectAll("circle.nodeCircle").attr("r", 0);
        nodeExit.selectAll("text.nodeText").style("fill-opacity", 0);

        // Update the links…
        var linkcount;
        var link = svgGroup.selectAll("path.link")
            .data(links, function(d) {
                return d.target.id;
            });

        // Enter any new links at the parents previous position.
        link.enter().insert("path", "g")
            .attr("class", "link")
            .attr("d", function(d) {
                var o = {
                    x: source.x0,
                    y: source.y0
                };
                return diagonal({
                    source: o,
                    target: o
                });
            })
		    .style("stroke", function(d) {
		    	return d.target.color;
		    })
		    .style("stroke-width", function(d) {
            	if (d.target.commentcount) {
		    		return calculateTreeLinkSize(d.target.commentcount, maxNumComments);
            		//return (parseInt(d.target.commentcount)+1) * 2;
            	} else {
		    		return calculateTreeLinkSize(0, maxNumComments);
                	//return 6;
                }
		    })
			.style("stroke-opacity", function(d) {
				var size = ((d.source.depth + 1) / 4.5);
				return size;
			})
		    .style("stroke-linecap", "round");

        // Transition links to their new position.
        link.transition()
            .duration(duration)
            .attr("d", diagonal);

        // Transition exiting nodes to the parents new position.
        link.exit().transition()
            .duration(duration)
            .attr("d", function(d) {
                var o = {
                    x: source.x,
                    y: source.y
                };
                return diagonal({
                    source: o,
                    target: o
                });
            })
            .remove();

        // Stash the old positions for transition.
        nodes.forEach(function(d) {
            d.x0 = d.x;
            d.y0 = d.y;
        });
    }

    // Append a group which holds all nodes and which the zoom Listener can act upon.
    var svgGroup = baseSvg.append("g").attr("class", "maing");

	var expandButton = d3.select(document.getElementById("treeexpandall"));
	expandButton.on('click', function () {
        postMessageToPage(myname,'click','expandall','global','global');

		if (root.children) {
			root.children.forEach(function(d) {
				expand(d);
			});
		} else {
			root._children.forEach(function(d) {
				expand(d);
			});
		}
		update(root);
		centerNode(root);
	});

	var collapseButton = d3.select(document.getElementById("treecollapseall"));
	collapseButton.on('click', function () {
        postMessageToPage(myname,'click','collapseall','global','global');

		root.children.forEach(toggleAll);
		update(root);
		centerNode(root);
	});

	//createTreeLegend(maxNumComments);

    // Layout the tree initially and center on the root node.
    root.children.forEach(toggleAll);
    update(root);
    centerNode(root);
}

/** SHARED HELPER FUNCTIONS **/

function toggleAll(d) {
	if (d.children) {
		d.children.forEach(toggleAll);
		toggleChildren(d);
	}
}

function toggleChildren(d) {
	if (d.children) {
		d._children = d.children;
		d.children = null;
	} else if (d._children) {
		d.children = d._children;
		d._children = null;
	}
	return d;
}

function collapse(d) {
	if (d.children) {
		d._children = d.children;
		d._children.forEach(collapse);
		d.children = null;
	} else if (d._children) {
		d._children.forEach(expand);
	}
}

function expand(d) {
	if (d._children) {
		d.children = d._children;
		d.children.forEach(expand);
		d._children = null;
	} else if (d.children) {
		d.children.forEach(expand);
	}
}

function getTreeColour(count) {
	var colors = ["#bd0026", "#fecc5c", "#fd8d3c", "#f03b20", "#B02D5D", "#9B2C67", "#982B9A", "#692DA7", "#5725AA", "#4823AF", "#d7b5d8", "#dd1c77", "#5A0C7A", "#5A0C7A"];
	var position = count % 14;
	return colors[position];
}

function createTreeLegend(maxcount) {
    var legendarea = d3.select($('legenddiv'))
        .append("svg")
        .attr("width", 500)
        .attr("height", 30)
        .attr("style", 'padding:0px;')
        .append("g")
        .attr("transform", "translate(0,0)");

	var interval = 1;
	if (maxcount > 10) {
		interval = Math.round(maxcount / 10);
	}

	for (var i=0; i<10; i++) {
		var radius = i+3;
		var fromsize = ((interval*i)+1);
		if (i == 0) {
			fromsize = 0;
		}
		var tosize = (interval*(i+1));
		var dotx = ((i+1)*3)+((i+1)*30);

        legendarea.append("circle")
            .style("stroke-width", '1.5px')
            .style("stroke", "gray")
            .attr("r", radius)
            .style("fill", "gray")
            .style("fill-opacity", 0.8)
            .attr("title", fromsize+" -> "+tosize)
        	.attr("transform", "translate("+dotx+",15)");

       /*
       var textx = dotx;
       legendarea.append("text")
            .text(interval*i+' -> '+interval*(i+1))
            .style("fill-opacity", 0)
        	.attr("transform", "translate("+textx+",10)");
        	*/
	}
}

function calculateTreeNodeSize(count, maxcount) {
	var increment = 3;
	var interval = 1;
	if (maxcount > 10) {
		interval = Math.round(maxcount / 10);
	}

	var reply = increment;
	for (var i=0; i<10; i++) {
		if (count > (interval*i) && count <= (interval*(i+1))) {
			reply = (i+2)*increment;
			break;
		}
	}
	return reply;
}

function calculateTreeLinkSize(count, maxcount) {
	var increment = 6;
	var interval = 1;
	if (maxcount > 10) {
		interval = Math.round(maxcount / 10);
	}

	var reply = increment;
	for (var i=0; i<10; i++) {
		if (count > (interval*i) && count <= (interval*(i+1))) {
			reply = (i+2)*increment;
			break;
		}
	}
	return reply;
}