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

$jit.ForceDirected.Plot.EdgeTypes.implement({

	'labelarrow': {
		'render': function(adj, canvas) {
			var orifrom = adj.nodeFrom.pos.getc(true);
			var orito = adj.nodeTo.pos.getc(true);

			//alert("fromNode = "+adj.nodeTo.pos.getc(true));
			//alert("toNode = "+adj.nodeFrom.pos.getc(true));

			// want the to and from to be where the line intercepcts the node boxes.
			var to = computeIntersectionWithRectangle(adj.nodeTo, orito, orifrom);
			var from = computeIntersectionWithRectangle(adj.nodeFrom, orifrom, orito);

			if (!to) {
				to = orito;
			}
			if (!from) {
				from = orifrom
			}

			var dim = adj.getData('dim');
			var direction = adj.data.$direction;
			var swap = (direction && direction.length>1 && direction[0] != adj.nodeFrom.id);

			var context = canvas.getCtx();
			// invert edge direction
			if (swap) {
				var tmp = from;
				from = to;
				to = tmp;
			}

			//var orifromrole = adj.nodeFrom.getData('orirole');
			//var oritorole = adj.nodeTo.getData('orirole');

			//alert("from="+orifromrole.name);
			//alert("to="+oritorole.name);

			var vect = new $jit.Complex(to.x - from.x, to.y - from.y);
			vect.$scale(dim / vect.norm());
			var posVect = vect;
			var intermediatePoint = new $jit.Complex(to.x - posVect.x, to.y - posVect.y);
			var normal = new $jit.Complex(-vect.y / 2, vect.x / 2);
			var endPoint = intermediatePoint.add(vect);
			var v1 = intermediatePoint.add(normal);
			var v2 = intermediatePoint.$add(normal.$scale(-1));

			if (adj.selected) {
				context.strokeStyle = '#FFFF40';
				context.lineWidth = 3;
			}
			//line
			context.beginPath();
			context.moveTo(from.x, from.y);
			context.lineTo(to.x, to.y);
			context.stroke();

			// Arrow head
			context.beginPath();
			context.moveTo(v1.x, v1.y);
			context.moveTo(v1.x, v1.y);
			context.lineTo(v2.x, v2.y);
			context.lineTo(endPoint.x, endPoint.y);
			context.closePath();
			context.fill();

			// Link Text
			var labeltext = adj.getData('label');
			context.font = "bold 12px Arial";
			context.textBaseline = 'top';

	  		var metrics = context.measureText(labeltext);
	  		var testWidth = metrics.width;

			// center label on line
			var posVectLabel = new $jit.Complex((to.x - from.x)/2, (to.y - from.y)/2);
			var intermediatePointLabel = new $jit.Complex(to.x - posVectLabel.x, to.y - posVectLabel.y);
			//var endPointLabel = intermediatePointLabel.add(vect);

			context.fillText(labeltext, (intermediatePointLabel.x-(testWidth/2)), intermediatePointLabel.y);
		},
		//optional
		'contains': function(adj, pos) {
			var posFrom = adj.nodeFrom.pos.getc(true);
			var posTo = adj.nodeTo.pos.getc(true);
			var epsilon = this.edge.epsilon;
            var min = Math.min,
                max = Math.max,
                minPosX = min(posFrom.x, posTo.x) - epsilon,
                maxPosX = max(posFrom.x, posTo.x) + epsilon,
                minPosY = min(posFrom.y, posTo.y) - epsilon,
                maxPosY = max(posFrom.y, posTo.y) + epsilon;

            if(pos.x >= minPosX && pos.x <= maxPosX
                && pos.y >= minPosY && pos.y <= maxPosY) {
                if(Math.abs(posTo.x - posFrom.x) <= epsilon) {
                    return true;
                }
                var dist = (posTo.y - posFrom.y) / (posTo.x - posFrom.x) * (pos.x - posFrom.x) + posFrom.y;
                return Math.abs(dist - pos.y) <= epsilon;
            }
            return false;
		}
	}
});

$jit.ForceDirected.Plot.NodeTypes.implement({
    'cohere': {
		'render': function(node, canvas){

			var context = canvas.getCtx()

			var width = node.getData('width');
			var height = node.getData('height');

			var finalpos = node.pos.getc(true);
			var pos = { x: finalpos.x - width / 2, y: finalpos.y - height / 2};

			/*
			context.fillStyle = node.color;
			context.strokeStyle = node.color;
			var rad = 10;
			var xx = finalpos.x - width / 2;
			var yy = finalpos.y - height / 2;
			context.beginPath();
			context.moveTo(xx+rad, yy);
			context.arcTo(xx+width, yy,    xx+width, yy+height, rad);
			context.arcTo(xx+width, yy+height, xx,    yy+height, rad);
			context.arcTo(xx,    yy+height, xx,    yy,    rad);
			context.arcTo(xx,    yy,    xx+width, yy,    rad);
			*/

			context['fill' + 'Rect'](finalpos.x - width / 2, finalpos.y - height / 2,
				width, height);


			//if (node.id == NODE_ARGS['nodeid']) {
			//	context.strokeStyle = '#606060';
			//	context.lineWidth = 3;
			//	context['stroke' + 'Rect'](finalpos.x - width / 2, finalpos.y - height / 2,
			//		width, height);
			//}

			if (node.selected) {
				context.strokeStyle = '#FFFF40';
				context.lineWidth = 3;
				context['stroke' + 'Rect'](finalpos.x - width / 2, finalpos.y - height / 2,
					width, height);
			}

			//var orinode = node.getData('orinode');
			//var orirole = node.getData('orirole');
			//var roleimage = URL_ROOT + orirole.image;

			var roleimage = node.getData('icon');
			var roleicon = forcedirectedGraph.graph.getImage(roleimage);
			if (!roleicon) {
				roleicon = new Image();
		    	roleicon.src = roleimage;
				forcedirectedGraph.graph.addImage(roleicon);
		    }
			if (roleicon.complete) {
				context.drawImage(roleicon, pos.x+5, pos.y+5, 32, 32);
				var iconRect = new mapRectangle(pos.x+5, pos.y+5, 32, 32);
				node.setData('iconrec', iconRect);
			} else {
				roleicon.onload = function () {
					context.drawImage(roleicon, pos.x+5, pos.y+5, 32, 32);
					var iconRect = new mapRectangle(pos.x+5, pos.y+5, 32, 32);
					node.setData('iconrec', iconRect);
				};
			}

			var user = node.getData('oriuser');
			var userimage = '<?php echo $HUB_FLM->getImagePath($CFG->DEFAULT_USER_PHOTO); ?>';
			if (user.photo) {
				userimage = user.photo;
			}

			var usericon = forcedirectedGraph.graph.getImage(userimage);
			if (!usericon) {
				usericon = new Image();
				usericon.src = userimage;
				forcedirectedGraph.graph.addImage(usericon);
			}
			if (usericon.complete) {
				var imgheight = usericon.height;
				var imgwidth = usericon.width;
				if(imgheight > 40) {
					imgheight = 40;
					imgwidth = usericon.width * (40/usericon.height);
					context.drawImage(usericon, pos.x+(width-(5+imgwidth)), pos.y+5, imgwidth, imgheight);
					var userRect = new mapRectangle(pos.x+(width-(5+imgwidth)), pos.y+5, imgwidth, imgheight);
					node.setData('userrec', userRect);
				} else {
					context.drawImage(usericon, pos.x+(width-(5+imgwidth)), pos.y+5, imgwidth, imgheight);
					var userRect = new mapRectangle(pos.x+(width-(5+imgwidth)), pos.y+5, imgwidth, imgheight);
					node.setData('userrec', userRect);
				}
			} else {
				usericon.onload = function () {
					var imgheight = usericon.height;
					var imgwidth = usericon.width;
					if(imgheight > 40) {
						imgheight = 40;
						imgwidth = usericon.width * (40/usericon.height);
						context.drawImage(usericon, pos.x+(width-(5+imgwidth)), pos.y+5, imgwidth, imgheight);
						var userRect = new mapRectangle(pos.x+(width-(5+imgwidth)), pos.y+5, imgwidth, imgheight);
						node.setData('userrec', userRect);
					} else {
						context.drawImage(usericon, pos.x+(width-(5+imgwidth)), pos.y+5);
						var userRect = new mapRectangle(pos.x+(width-(5+imgwidth)), pos.y+5, imgwidth, imgheight);
						node.setData('userrec', userRect);
					}
				};
			}

			var labeltext = node.name;
			if (labeltext.length > 60) {
				labeltext = labeltext.substr(0,60)+"...";
			}

			context.fillStyle = context.strokeStyle = '#000000';
			context.font = "12px Arial";
			context.textBaseline = 'top';

			var maxWidth = 165;
			var lineHeight = 15;

			wrapText(context, labeltext, pos.x + 45, pos.y + 5, maxWidth, lineHeight, 10);
			var textRect = new mapRectangle(pos.x + 45, pos.y, maxWidth, height);
			node.setData('textrec', textRect);
		},

		'contains': function(node, pos, width, height){

			var width = node.getData('width');
			var height = node.getData('height');

			var cpos = node.pos.getc(true);
			var npos = { x: cpos.x - width / 2, y: cpos.y - height / 2};
			var finalnpos = {x:npos.x+width/2, y:npos.y+height/2}

			return Math.abs(pos.x - finalnpos.x) <= width / 2
				&& Math.abs(pos.y - finalnpos.y) <= height / 2;
		}
	}
});

function createNewEmbedForceDirectedGraph(containername, rootNodeID) {

	var fd = new $jit.ForceDirected({
		//id of the visualization container
		injectInto: containername,

		Navigation: {
			enable: true,
			type: 'Native',

			//Enable panning events only if were dragging the empty
			//canvas (and not a node).
			panning: 'avoid nodes',
			zooming: 10 //zoom speed. higher is more sensible
		},

		// Change node and edge styles such as
		// color and width.
		// These properties are also set per node
		// with dollar prefixed data-properties in the
		// JSON structure.
		Node: {
			overridable: true,
			type: "cohere",
			height: 50,
			width: 250,
			nodetype: "",
			orinode: null,
			orirole: null,
			oriuser:null,
			icon: "",
			desc: "",
			connections:{},
			textrec:null,
			iconrec:null,
			userrec:null,
		},

		Edge: {
		  	overridable: true,
		  	color: '#808080',
		  	lineWidth: 1.5,
		  	type: "labelarrow",
		  	label: "",
		},

		// Add node events
		Events: {
			enable: true,

			type: 'Native',
			//Change cursor style when hovering a node
			onMouseEnter: function() {
				fd.canvas.getElement().style.cursor = 'move';
			},
			onMouseLeave: function() {
				fd.canvas.getElement().style.cursor = '';
				hideBox('maphintdiv');
			},

			onMouseMove: function(node, eventInfo, e) {
				if (!node) {
					return;
				}

				var isLink = node.nodeFrom ? true : false;
				if (!isLink) {
					var pos = eventInfo.getPos();
					var userRec = node.getData('userrec');
					var iconRec = node.getData('iconrec');
					var textRec = node.getData('textrec');

					/*if (iconRec && iconRec.contains(pos.x, pos.y)) {
						//fd.canvas.getElement().style.cursor = 'pointer';
						var text = getNodeTitleAntecedence(node.getData('nodetype'), false);
						showMapHint('maphintdiv', node, text, e);
					} else*/ if (userRec && userRec.contains(pos.x, pos.y)) {
						var oriuser = node.getData('oriuser');
						var text = oriuser.name;
						if (oriuser.homepage && oriuser.homepage != "") {
							fd.canvas.getElement().style.cursor = 'pointer';
							text = text + '<br><span style="font-size:8pt">(<?php echo $LNG->NODE_EXPLORE_BUTTON_HINT; ?>)</span>';
						}
						showMapHint('maphintdiv', node, text, e);
					} else if (textRec && textRec.contains(pos.x, pos.y)) {
						var orinode = node.getData('orinode');
						var connections = node.getData('connections');
						var count = -1;
						if (connections) {
							count = connections.length;
						}
						var tip = "";
						if (count > -1) {
							tip = '<div>' + node.name+'</div>';
							tip += '<div><b>connections:</b> ' + count; + '</div>';
							if (orinode.homepage && orinode.homepage != "") {
								fd.canvas.getElement().style.cursor = 'pointer';
								tip += '<div style="font-size:8pt">(<?php echo $LNG->NODE_EXPLORE_BUTTON_HINT; ?>)</div>';
							}
						} else {
							tip = node.name;
						}
						showMapHint('maphintdiv', node, tip, e);
					}
				}
			},

			//Update node positions when dragged
			onDragMove: function(node, eventInfo, e) {
				var pos = eventInfo.getPos();
				node.pos.setc(pos.x, pos.y);
				fd.plot();
			},
			//Implement the same handler for touchscreens
			onTouchMove: function(node, eventInfo, e) {
				$jit.util.event.stop(e); //stop default touchmove event
				this.onDragMove(node, eventInfo, e);
			},

			onRightClick: function(node, eventInfo, e) {
				if (!node) return;
			},

			onClick: function(node, eventInfo, e) {
				if (node != false) {
					var isLink = node.nodeFrom ? true : false;
					if (!isLink) {
						/*fd.graph.eachNode(function(n) {
							if(n.id != node.id) {
								delete n.selected;
							} else {
								if(!n.selected) {
									n.selected = true;
								}
							}
						});
						//trigger animation to final styles
						fd.fx.animate({
							modes: ['edge-property:lineWidth:color'],
							duration: 2
						});
						*/

						var pos = eventInfo.getPos();
						var userRec = node.getData('userrec');
						var textRec = node.getData('textrec');
						if (userRec && userRec.contains(pos.x, pos.y)) {
							fd.canvas.getElement().style.cursor = 'pointer';
							var oriuser = node.getData('oriuser');
							if (oriuser.homepage) {
								//var width = getWindowWidth()-50;
								//var height = getWindowHeight()-50;
								loadDialog('viewuser', oriuser.homepage, 1000,700);
							}
						} else if (textRec && textRec.contains(pos.x, pos.y)) {
							fd.canvas.getElement().style.cursor = 'pointer';
							var orinode = node.getData('orinode');
							if (orinode.homepage) {
								//var width = getWindowWidth()-50;
								//var height = getWindowHeight()-50;
								loadDialog('viewnode', orinode.homepage, 1000,700);
							}
						}
					}
				}
			}
		},

		//Number of iterations for the FD algorithm
		iterations: 200,

		//Edge length
		levelDistance: 280,

		//Add Tips
		Tips: {
			enable: false,
			type: 'Native',
			offsetX: 10,
  			offsetY: 10,
			onShow: function(tip, node) {
				/*var connections = node.getData('connections');
				var count = -1;
				if (connections) {
					count = connections.length;
				}
				if (count > -1) {
					tip.innerHTML = "<div class=\"tip-title\">" + node.name + "</div>"
					  + "<div class=\"tip-text\"><b>connections:</b> " + count; + "</div>";
				} else {
					tip.innerHTML = node.name;
				}
				*/
			}
		}
	});

	fd.graph = new $jit.Graph(fd.graphOptions, fd.config.Node, fd.config.Edge, fd.config.Label);

	var userimage = '<?php echo $HUB_FLM->getImagePath($CFG->DEFAULT_USER_PHOTO); ?>';
	usericon = new Image();
	usericon.src = userimage;
	fd.graph.addImage(usericon);

	if (rootNodeID && rootNodeID != "") {
		fd.root = rootNodeID;
	}

	return fd;
}

function showMapHint(panelname, node, text, evt) {

	var panel = $(panelname);
	panel.innerHTML = "";
	panel.insert(text);

	var extraX = 5;
	var extraY = 5;
 	var event = evt || window.event;
	var thing = event.target || event.srcElement;
	var viewportHeight = getWindowHeight();
	var viewportWidth = getWindowWidth();
	if (GECKO) {
		//adjust for it going off the screen right or bottom.
		var x = event.clientX;
		var y = event.clientY;
		if ( (x+panel.offsetWidth+30) > viewportWidth) {
			x = x-(panel.offsetWidth+30);
		} else {
			x = x+extraX;
		}
		if ( (y+panel.offsetHeight) > viewportHeight) {
			y = y-50;
		} else {
			y = y-5;
		}

		if (panel) {
			panel.style.left = x+extraX+window.pageXOffset+"px";
			panel.style.top = y+extraY+window.pageYOffset+"px";
		}
	}
	else if (NS) {
		//adjust for it going off the screen right or bottom.
		var x = event.pageX;
		var y = event.pageY;
		if ( (x+panel.offsetWidth+30) > viewportWidth) {
			x = x-(panel.offsetWidth+30);
		} else {
			x = x+extraX;
		}
		if ( (y+panel.offsetHeight) > viewportHeight) {
			y = y-50;
		} else {
			y = y-5;
		}
		panel.moveTo(x+extraX+window.pageXOffset+"px", y+extraY+window.pageYOffset+"px");
	}
	else if (IE || IE5) {
		//adjust for it going off the screen right or bottom.
		var x = event.x;
		var y = event.clientY;
		if ( (x+panel.offsetWidth+30) > viewportWidth) {
			x = x-(panel.offsetWidth+30);
		} else {
			x = x+extraX;
		}
		if ( (y+panel.offsetHeight) > viewportHeight) {
			y = y-50;
		} else {
			y = y-5;
		}

		window.event.cancelBubble = true;
		panel.style.left = x+extraX+ document.documentElement.scrollLeft+"px";
		panel.style.top = y+extraY+ document.documentElement.scrollTop+"px";
	}

	showBox(panelname);
}

/**
 * Add the given connection to the given graph
 */
function addConnectionToFDGraph(c, forcedirectedGraph) {

	var graph = forcedirectedGraph.graph;

	if (c && c.from && c.to) {
		var fN = c.from[0].cnode;
		var tN = c.to[0].cnode;

		var fromRole = fN.rolename;
		var toRole = tN.rolename;

		// Get icon for the From Role
		var fNNodeImage = getNodeIcon(fromRole, false);
		var roleicon = forcedirectedGraph.graph.getImage(fNNodeImage);
		if (!roleicon) {
			roleicon = new Image();
			roleicon.src = fNNodeImage;
			forcedirectedGraph.graph.addImage(roleicon);
		}


		// Get the icon for the To Role
		var tNNodeImage = getNodeIcon(toRole, false);
		var roleicon = forcedirectedGraph.graph.getImage(tNNodeImage);
		if (!roleicon) {
			roleicon = new Image();
			roleicon.src = tNNodeImage;
			forcedirectedGraph.graph.addImage(roleicon);
		}


		var fromDesc = "";
		if (fN.description) {
			fromDesc = fN.description;
		}
		var toDesc = "";
		if (tN.description) {
			toDesc = tN.description;
		}
		var fromName = fN.name;
		var toName = tN.name;

		// Get HEX for From Role
		var fromHEX = "";
		if (fromRole == 'Challenge') {
			fromHEX = challengebackpale;
		} else if (fromRole == 'Issue') {
			fromHEX = issuebackpale;
		} else if (fromRole == 'Solution') {
			fromHEX = solutionbackpale;
		} else if (fromRole == 'Idea' ) {
			fromHEX = ideabackpale;
		} else if (fromRole == 'Argument') {
			fromHEX = argumentbackpale;
		} else if (fromRole == "Pro") {
			fromHEX = probackpale;
		} else if (fromRole == "Con") {
			fromHEX = conbackpale;
		} else if (fromRole == 'Resource') {
			fromHEX = resourcebackpale;
		} else if (fromRole == 'Comment') {
			fromHEX = commentbackpale;
		} else if (fromRole == 'Map') {
			fromHEX = mapbackpale;
		} else {
			fromHEX = plainbackpale;
		}

		// Get HEX for To Role
		var toHEX = "";
		if (toRole == 'Challenge') {
			toHEX = challengebackpale;
		} else if (toRole == 'Issue') {
			toHEX = issuebackpale;
		} else if (toRole == 'Solution') {
			toHEX = solutionbackpale;
		} else if (toRole == 'Idea') {
			toHEX = ideabackpale;
		} else if (toRole == "Argument") {
			toHEX = argumentbackpale;
		} else if (toRole == 'Pro') {
			toHEX = probackpale;
		} else if (toRole == 'Con') {
			toHEX = conbackpale;
		} else if (toRole == 'Resource') {
			toHEX = resourcebackpale;
		} else if (toRole == 'Comment') {
			toHEX = commentbackpale;
		} else if (toRole == 'Map') {
			toHEX = mapbackpale;
		} else {
			toHEX = plainbackpale;
		}

		if (fromRole == "Resource") {
			if (fromDesc != "") {
				var tempName = fromName;
				fromName = fromDesc;
				fromDesc = tempName;
			}
		}
		if (toRole == "Resource") {
			if (toDesc != "") {
				var tempName = toName;
				toName = toDesc;
				toDesc = tempName;
			}
		}

		//var fromRoleLabel = getNodeTitleAntecedence(fromRole, false);
		//var toRoleLabel = getNodeTitleAntecedence(toRole, false);

		//create from & to nodes

		//var fromuser = fN.userid;
		//var touser = tN.userid;
		var fromuser = fN.users[0].user;
		var touser = tN.users[0].user;
		if (fromuser.photo) {
			var usericon = forcedirectedGraph.graph.getImage(fromuser.photo);
			if (!usericon) {
				usericon = new Image();
				usericon.src = fromuser.photo;
				forcedirectedGraph.graph.addImage(usericon);
			}
		}
		if (touser.photo) {
			var usericon = forcedirectedGraph.graph.getImage(touser.photo);
			if (!usericon) {
				usericon = new Image();
				usericon.src = touser.photo;
				forcedirectedGraph.graph.addImage(usericon);
			}
		}

		var fromNode = null;
		if (!checkNodes[fN.nodeid]) {
			var connections = new Array();
			connections.push(c);
			fromNode = {
					"data": {
						"$color": fromHEX,
						"$nodetype": fromRole,
						"$orinode": fN,
						"$orirole": '',
						"$oriuser": fromuser,
						"$icon": fNNodeImage,
						"$desc": fromDesc,
						"$connections":connections,
						"$userrec":new mapRectangle(0,0,0,0),
						"$iconrec":new mapRectangle(0,0,0,0),
						"$textrec":new mapRectangle(0,0,0,0),
					},
					"id": fN.nodeid,
					"name": fromName,
			   };
			var addednode = graph.addNode(fromNode);
			checkNodes[fN.nodeid] = fN.nodeid;
			var concount = connections.length;
			if (concount >FD_MOST_CONNECTED_COUNT) {
				FD_MOST_CONNECTED_COUNT = concount;
				FD_MOST_CONNECTED_NODE = addednode;
				forcedirectedGraph.root = fN.nodeid;
			}

		} else {
			fromNode = graph.getNode(fN.nodeid);
			var connections = fromNode.getData('connections');
			connections.push(c);
			fromNode.setData('connections', connections);
			var concount = connections.length;
			if (concount >FD_MOST_CONNECTED_COUNT) {
				FD_MOST_CONNECTED_COUNT = concount;
				FD_MOST_CONNECTED_NODE = fromNode;
				forcedirectedGraph.root = fN.nodeid;
			}
		}

		var toNode = null;
		if (!checkNodes[tN.nodeid]) {

			var connections = new Array();
			connections.push(c);
			toNode = {
					"data": {
						"$color": toHEX,
						"$nodetype": toRole,
						"$orinode": tN,
						"$orirole": '',
						"$oriuser": touser,
						"$icon": tNNodeImage,
						"$desc": toDesc,
						"$connections": connections,
						"$userrec":new mapRectangle(0,0,0,0),
						"$iconrec":new mapRectangle(0,0,0,0),
						"$textrec":new mapRectangle(0,0,0,0),
					},
					"id": tN.nodeid,
					"name": toName,
			 };

			var addednode = graph.addNode(toNode);
			checkNodes[tN.nodeid] = tN.nodeid;
			var concount = connections.lenth;
			if (concount >FD_MOST_CONNECTED_COUNT) {
				FD_MOST_CONNECTED_COUNT = concount;
				FD_MOST_CONNECTED_NODE = addednode;
				forcedirectedGraph.root = touser.userid;
			}
		} else {
			toNode = graph.getNode(tN.nodeid);
			var connections = toNode.getData('connections');
			connections.push(c);
			toNode.setData('connections', connections);
		}

		// add edge/conn
		var linklabelname = c.linklabelname;
		linklabelname = getLinkLabelName(fromRole, toRole, linklabelname);

		var linkcolour = "#808080";
		if (linklabelname == "<?php echo $CFG->LINK_PRO_SOLUTION; ?>") {
			linkcolour = "#00BD53";
		} else if (linklabelname == "<?php echo $CFG->LINK_CON_SOLUTION; ?>") {
			linkcolour = "#C10031";
		}

		var data = {
			"$color": linkcolour,
			"$label": linklabelname,
			"$direction": [fN.nodeid,tN.nodeid],
		};

		graph.addAdjacence(fromNode, toNode, data);
	}
}

/**
 * Compute positions incrementally and animate.
 */
function layoutAndAnimateFD(graphview, messagearea) {

	graphview.computePrefuse({
		iter:20,
		property: 'end',
		onStep: function(perc){
			if (messagearea) {
				messagearea.innerHTML='<div id="innerfdmessage" style="margin:10px;">'+ perc + '<?php echo $LNG->NETWORKMAPS_PERCENTAGE_MESSAGE; ?></div>';
			}
		},
		onComplete: function(){

			if ($("innerfdmessage")) {
				$("innerfdmessage").innerHTML="<?php echo $LNG->NETWORKMAPS_SCALING_MESSAGE; ?>";
			}

		  	graphview.animate({
				modes: ['linear'],
				transition: $jit.Trans.Elastic.easeOut,
				duration: 0,
				onComplete: function() {
					var width = $(graphview.config.injectInto+'-outer').offsetWidth;
					var height = $(graphview.config.injectInto+'-outer').offsetHeight;
					clipInitialCanvas(graphview, width, height);

					var size = graphview.canvas.getSize();
					if (size.width > width || size.height > height) {
						zoomFDFit(graphview);
					} else {
						var rootNodeID = graphview.root;
						panToNodeFD(graphview, rootNodeID);
					}

					if (messagearea) {
						messagearea.innerHTML="";
						messagearea.style.display = "none";
					}

					graphview.canvas.getPos(true);
				}
		  	});
		}
	});
}

