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

/** REQUIRES: graphlib.js.php **/


function createCommunitiesForceDirectedGraph(containername, rootNodeID) {

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
			type: "circle",
			dim:30,
			width:50,
			height:30,
			nodetype: "",
			orinode: null,
			orirole: null,
			oriuser:null,
			icon: "",
			desc: "",
			connections:{},
		},

		Edge: {
		  	overridable: true,
		  	color: '#808080',
		  	lineWidth: 1.5,
		  	type: "line",
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
		},

		//Number of iterations for the FD algorithm
		iterations: 200,

		//Edge length
		levelDistance: 280,

		//Add Tips
		Tips: {
			enable: true,
			type: 'Native',
			offsetX: 10,
  			offsetY: 10,
			onShow: function(tip, node) {
				var connections = node.getData('connections');
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
			}
		}
	});

	fd.graph = new $jit.Graph(fd.graphOptions, fd.config.Node, fd.config.Edge, fd.config.Label);

	if (rootNodeID && rootNodeID != "") {
		fd.root = rootNodeID;
	}

	return fd;
}

/**
 * Add the given connection to the given graph
 */
function addConnectionToFDCGraph(c, forcedirectedGraph, communitiescount) {
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

		var fromtype = "circle";
		var totype = "circle";

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
			var shape = getCommunityShape(fN.community);
			var color = getCommunityColour(fN.community);
			var connections = new Array();
			connections.push(c);
			var dim = 30;
			var width = 50;
			var height = 30;

			switch(shape) {
				case 'circle':
					dim = 40;
					break;
				case 'triangle':
					dim = 40;
					break;
				case 'square':
					dim = 40;
					break;
				case 'star':
					dim = 60;
					break;
				case 'ellipse':
					width = 70;
					height = 50;
					break;
				case 'rectangle':
					width = 60;
					height = 40;
					break;
			}
			fromNode = {
					"data": {
						"$type": shape,
						"$color": color,
						"$dim":dim,
						"$width":width,
						"$height":height,
						"$nodetype": fromRole,
						"$orinode": fN,
						"$orirole": '',
						"$oriuser": fromuser,
						"$icon": fNNodeImage,
						"$desc": fromDesc,
						"$connections":connections,
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
			var shape = getCommunityShape(tN.community);
			var color = getCommunityColour(tN.community);
			var connections = new Array();
			connections.push(c);

			var dim = 30;
			var width = 50;
			var height = 30;

			switch(shape) {
				case 'circle':
					dim = 40;
					break;
				case 'triangle':
					dim = 40;
					break;
				case 'square':
					dim = 40;
					break;
				case 'star':
					dim = 60;
					break;
				case 'ellipse':
					width = 70;
					height = 50;
					break;
				case 'rectangle':
					width = 60;
					height = 40;
					break;
			}
			toNode = {
					"data": {
						"$type": shape,
						"$color": color,
						"$dim":dim,
						"$width":width,
						"$height":height,
						"$nodetype": toRole,
						"$orinode": tN,
						"$orirole": '',
						"$oriuser": touser,
						"$icon": tNNodeImage,
						"$desc": toDesc,
						"$connections": connections,
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
		var data = {
			"$color": linkcolour,
			"$label": linklabelname,
			"$direction": [fN.nodeid,tN.nodeid],
		};

		graph.addAdjacence(fromNode, toNode, data);
	}
}


function getCommunityColour(count) {
	//var colors = ['#E41414','#468CC3','#663A98','#BE4FB0','#0D950D','#760808','#000080','#00C0C0','#FF7800','#DCDE0A','#82C682'];
	//var colors = ['#6699FF','#3366CC','#000099','#336633','#339933','#339999','#CC3333','#990000','#990099','#FF9933','#CC6600'];
	var	colors = colorbrewer.Spectral[11];
	var position = count % 11;
	return colors[position];
}


function getCommunityShape(count) {
	var shapes = ['circle', 'triangle', 'square', 'star', 'ellipse', 'rectangle'];
	var position = count % 6;
	return shapes[position];
}

/**
 * Compute positions incrementally and animate.
 */
function layoutAndAnimateFDC(graphview, messagearea) {

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
					zoomFDFit(graphview);

					/*var width = $(graphview.config.injectInto+'-outer').offsetWidth;
					var height = $(graphview.config.injectInto+'-outer').offsetHeight;
					clipInitialCanvas(graphview, width, height);

					var size = graphview.canvas.getSize();
					if (size.width > width || size.height > height) {
						zoomFDFit(graphview);
					} else {
						var rootNodeID = graphview.root;
						panToNodeFD(graphview, rootNodeID);
					}
					*/

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

/**** COMMUNITY INTEREST NETWORK ******/
function createInterestForceDirectedGraph(containername, rootNodeID) {

	var fd = new $jit.ForceDirected({
		injectInto: containername,

		Navigation: {
			enable: true,
			type: 'Native',
			panning: 'avoid nodes',
			zooming: 10 //zoom speed. higher is more sensible
		},

		Node: {
			overridable: true,
			type: "circle",
			dim:30,
			nodetype: "",
			orinode: null,
			orirole: null,
			oriuser:null,
			desc: "",
			connections:{},
		},

		Edge: {
		  	overridable: true,
		  	color: '#808080',
		  	lineWidth: 1.5,
		  	type: "line",
		  	label: "",
		},

		// Add node events
		Events: {
			enable: true,
			type: 'Native',

			//Change cursor style when hovering a node
			onMouseEnter: function(node, eventInfo, e) {
				fd.canvas.getElement().style.cursor = 'move';
			},
			onMouseLeave: function() {
				fd.canvas.getElement().style.cursor = '';
				hideBox('maphintdiv');
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
		},

		//Number of iterations for the FD algorithm
		iterations: 200,

		//Edge length
		levelDistance: 280,

		//Add Tips
		Tips: {
			enable: true,
			type: 'Native',
			offsetX: 10,
  			offsetY: 10,
			onShow: function(tip, node) {
				var connections = node.getData('connections');
				var orinode = node.getData('orinode');
				var count = -1;
				if (connections) {
					count = connections.length;
				}
				if (count > -1) {
					tip.innerHTML = "<div class=\"tip-title\">" + node.name + "</div>"
					  + "<div class=\"tip-text\"><b><?php echo $LNG->INTEREST_NETWORK_CONNECTIONS; ?>:</b> " + count + "<span style=\"font-weight:bold;padding-left:10px;\"><?php echo $LNG->INTEREST_NETWORK_COUNT; ?>:</span> " + orinode.metric + "</div>";
				} else {
					tip.innerHTML = node.name;
				}
			}
		}
	});

	fd.graph = new $jit.Graph(fd.graphOptions, fd.config.Node, fd.config.Edge, fd.config.Label);
	if (rootNodeID && rootNodeID != "") {
		fd.root = rootNodeID;
	}
	return fd;
}

/**
 * Add the given connection to the given graph
 */
function addConnectionToFDIGraph(c, forcedirectedGraph, biggest) {
	var color = ["#313695","#4575b4","#74add1","#abd9e9","#e0f3f8","#ffffbf","#fee090","#fdae61","#f46d43","#d73027","#a50026"];
	var ballsizes = ["10","15","20","25","30","35","40","45","50","55","60"];
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
			var position = getInterestMetricRounding(fN.metric, biggest);
			var fcolour = color[position];
			var fsize = ballsizes[position];

			var connections = new Array();
			connections.push(c);
			fromNode = {
					"data": {
						"$color": fcolour,
						"$dim": fsize,
						"$nodetype": fromRole,
						"$orinode": fN,
						"$orirole": '',
						"$oriuser": fromuser,
						"$desc": fromDesc,
						"$connections":connections,
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
			var position = getInterestMetricRounding(tN.metric, biggest);
			var tcolour = color[position];
			var tsize = ballsizes[position];

			var connections = new Array();
			connections.push(c);
			toNode = {
					"data": {
						"$color": tcolour,
						"$dim": tsize,
						"$nodetype": toRole,
						"$orinode": tN,
						"$orirole": '',
						"$oriuser": touser,
						"$desc": toDesc,
						"$connections": connections,
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
		var data = {
			"$color": linkcolour,
			"$label": linklabelname,
			"$direction": [fN.nodeid,tN.nodeid],
		};

		graph.addAdjacence(fromNode, toNode, data);
	}
}

function getInterestMetricRounding(metric, biggest) {
	var reply = 0;
	var metricrounded = 0;
	var interval = Math.round(biggest / 10);

	var position = 0;
	for (var i=0; i<10; i++) {
		if (metric > (interval*i) && metric <= (interval*(i+1))) {
			position = i+1;
			break;
		}
	}
	reply = position;
	return reply;
}

/**
 * Compute positions incrementally and animate.
 */
function layoutAndAnimateFDI(graphview, messagearea) {

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
					zoomFDFit(graphview);

					/*var width = $(graphview.config.injectInto+'-outer').offsetWidth;
					var height = $(graphview.config.injectInto+'-outer').offsetHeight;
					clipInitialCanvas(graphview, width, height);

					var size = graphview.canvas.getSize();
					if (size.width > width || size.height > height) {
						zoomFDFit(graphview);
					} else {
						var rootNodeID = graphview.root;
						panToNodeFD(graphview, rootNodeID);
					}
					*/

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
