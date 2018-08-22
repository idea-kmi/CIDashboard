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
require_once('../../config.php');
?>

var SELECTED_GRAPH_NODE = "";

function createSocialNetworkGraphKey() {
	var tb1 = new Element("div", {'id':'graphkeydivtoolbar','class':'toolbarrow', 'style':'width:100%;margin-top:5px;'});

	var key = new Element("div", {'id':'key','style':'float:left;'});
	var text = "";
	text += '<div style="float:left;margin-right:5px;"><span style="padding:3px;background: #E9157F; color: black; font-weight:bold;"><?php echo $LNG->NETWORKMAPS_KEY_SOCIAL_MOST; ?></span></div>';
	text += '<div style="float:left;margin-right:5px;"><span style="padding:3px;background:#F8C7D9; color: black; font-weight:bold;"><?php echo $LNG->NETWORKMAPS_KEY_SOCIAL_HIGHLY; ?></span></div>';
	text += '<div style="float:left;margin-right:5px;"><span style="padding:3px;background: #C6ECFE; color: black; font-weight:bold;"><?php echo $LNG->NETWORKMAPS_KEY_SOCIAL_MODERATELY; ?></span></div>';
	text += '<div style="float:left;margin-right:5px;"><span style="padding:3px;background: #E4E2E2; color: black; font-weight:bold;"><?php echo $LNG->NETWORKMAPS_KEY_SOCIAL_SLIGHTLY; ?></span></div>';
	text += '<div style="float:left;"><span style="border: 3px solid yellow; color: black; font-weight:bold"><?php echo $LNG->NETWORKMAPS_KEY_SELECTED_ITEM; ?></span></div>';

	key.insert(text);
	tb1.insert(key);

	//var count = new Element("div", {'id':'graphConnectionCount','style':'float:left;margin-left-25px;'});
	//tb1.insert(count);

	return tb1;
}

/**
 * Create the basic graph toolbar for all network graphs
 */
function createBasicGraphToolbar(forcedirectedGraph, contentarea) {

	var tb2 = new Element("div", {'id':'graphmaintoolbar','class':'toolbarrow', 'style':'padding-top:5px;display:block;'});

	var button = new Element("button", {'id':'expandbutton','style':'margin-left:8px;padding:3px;','title':'<?php echo $LNG->NETWORKMAPS_RESIZE_MAP_HINT; ?>'});
	var icon = new Element("img", {'id':'expandicon', 'src':"<?php echo $HUB_FLM->getImagePath('enlarge2.gif'); ?>", 'border':'0', 'title':'<?php echo $LNG->NETWORKMAPS_RESIZE_MAP_HINT; ?>'});
	button.insert(icon);
	tb2.insert(button);

	var link = new Element("a", {'id':'expandlink', 'title':'<?php echo $LNG->NETWORKMAPS_RESIZE_MAP_HINT; ?>', 'style':'cursor:pointer;margin-left:5px;'});
	link.insert('<span id="linkbuttonsvn"><?php echo $LNG->NETWORKMAPS_ENLARGE_MAP_LINK; ?></span>');

	var handler = function() {
		if ($('header').style.display == "none") {
			$('linkbuttonsvn').update('<?php echo $LNG->NETWORKMAPS_ENLARGE_MAP_LINK; ?>');
			$('expandicon').src="<?php echo $HUB_FLM->getImagePath('enlarge2.gif'); ?>";
			reduceMap(contentarea, forcedirectedGraph);
		} else {
			$('linkbuttonsvn').update('<?php echo $LNG->NETWORKMAPS_REDUCE_MAP_LINK; ?>');
			$('expandicon').src="<?php echo $HUB_FLM->getImagePath('reduce.gif'); ?>";
			enlargeMap(contentarea, forcedirectedGraph);
		}
	};
	Event.observe(link,"click", handler);
	Event.observe(button,"click", handler);
	tb2.insert(link);

	var zoomOut = new Element("button", {'style':'margin-left: 30px;padding:3px;', 'title':'<?php echo $LNG->GRAPH_ZOOM_IN_HINT;?>'});
	var zoomOuticon = new Element("img", {'src':"<?php echo $HUB_FLM->getImagePath('magminus.png'); ?>", 'border':'0'});
	zoomOut.insert(zoomOuticon);
	var zoomOuthandler = function() {
		zoomFD(forcedirectedGraph, 5.0);
	};
	Event.observe(zoomOut,"click", zoomOuthandler);
	tb2.insert(zoomOut);

	var zoomIn = new Element("button", {'style':'margin-left: 10px;padding:3px;', 'title':'<?php echo $LNG->GRAPH_ZOOM_OUT_HINT;?>'});
	var zoomInicon = new Element("img", {'src':"<?php echo $HUB_FLM->getImagePath('magplus.png'); ?>", 'border':'0'});
	zoomIn.insert(zoomInicon);
	var zoomInhandler = function() {
		zoomFD(forcedirectedGraph, -5.0);
	};
	Event.observe(zoomIn,"click", zoomInhandler);
	tb2.insert(zoomIn);

	var zoom1to1 = new Element("button", {'style':'margin-left: 10px;padding:3px;', 'title':'<?php echo $LNG->GRAPH_ZOOM_ONE_TO_ONE_HINT;?>'});
	var zoom1to1icon = new Element("img", {'src':"<?php echo $HUB_FLM->getImagePath('zoomfull.png'); ?>", 'border':'0'});
	zoom1to1.insert(zoom1to1icon);
	var zoom1to1handler = function() {
		zoomFDFull(forcedirectedGraph);
	};
	Event.observe(zoom1to1,"click", zoom1to1handler);
	tb2.insert(zoom1to1);

	var zoomFit = new Element("button", {'style':'margin-left: 10px;padding:3px;', 'title':'<?php echo $LNG->GRAPH_ZOOM_FIT_HINT;?>'});
	var zoomFiticon = new Element("img", {'src':"<?php echo $HUB_FLM->getImagePath('zoomfit.png'); ?>", 'border':'0'});
	zoomFit.insert(zoomFiticon);
	var zoomFithandler = function() {
		zoomFDFit(forcedirectedGraph);
	};
	Event.observe(zoomFit,"click", zoomFithandler);
	tb2.insert(zoomFit);

	var printButton = new Element("button", {'style':'margin-left: 10px;padding:3px;', 'title':'<?php echo $LNG->GRAPH_PRINT_HINT;?>'});
	var printButtonicon = new Element("img", {'src':"<?php echo $HUB_FLM->getImagePath('printer.png'); ?>", 'border':'0'});
	printButton.insert(printButtonicon);
	var printButtonhandler = function() {
		printCanvas(forcedirectedGraph);
	};
	Event.observe(printButton,"click", printButtonhandler);
	tb2.insert(printButton);

	return tb2;
}

/**
 * Create the graph toolbar for Node network graphs
 */
function createGraphToolbar(forcedirectedGraph,contentarea) {

	var tb2 = createBasicGraphToolbar(forcedirectedGraph,contentarea);

	var button2 = new Element("button", {'id':'viewdetailbutton','style':'margin-left: 30px;padding:3px;','title':'<?php echo $LNG->NETWORKMAPS_EXPLORE_ITEM_HINT; ?>'});
	var icon2 = new Element("img", {'id':'viewdetailicon', 'src':"<?php echo $HUB_FLM->getImagePath('lightbulb-16.png'); ?>", 'border':'0'});
	button2.insert(icon2);
	tb2.insert(button2);

	var view = new Element("a", {'id':'viewdetaillink', 'title':"<?php echo $LNG->NETWORKMAPS_EXPLORE_ITEM_HINT; ?>", 'style':'margin-left:5px;cursor:pointer;'});
	view.insert('<span id="viewbuttons"><?php echo $LNG->NETWORKMAPS_EXPLORE_ITEM_LINK; ?></span>');
	var handler2 = function() {
		var node = getSelectFDNode(forcedirectedGraph);
		if (node != null && node != "") {
			var nodeid = node.id;
			var nodetype = node.getData('nodetype');
			var width = getWindowWidth();
			var height = getWindowHeight()-20;
			viewNodeDetails(nodeid, nodetype, width, height);
		} else {
			alert("<?php echo $LNG->NETWORKMAPS_SELECTED_NODEID_ERROR; ?>");
		}
	};
	Event.observe(button2,"click", handler2);
	Event.observe(view,"click", handler2);
	tb2.insert(view);

	var button3 = new Element("button", {'id':'viewdetailbutton','style':'margin-left: 30px;padding:3px;margin-bottom:5px;','title':'<?php echo $LNG->NETWORKMAPS_EXPLORE_AUTHOR_HINT; ?>'});
	var icon3 = new Element("img", {'id':'viewdetailicon', 'src':"<?php echo $HUB_FLM->getImagePath('profile_sm.png'); ?>", 'border':'0'});
	button3.insert(icon3);
	tb2.insert(button3);
	var view3 = new Element("a", {'id':'viewdetaillink', 'title':"<?php echo $LNG->NETWORKMAPS_EXPLORE_AUTHOR_HINT; ?>", 'style':'margin-left:5px;cursor:pointer;'});
	view3.insert('<span id="viewbuttons"><?php echo $LNG->NETWORKMAPS_EXPLORE_AUTHOR_LINK; ?></span>');
	var handler3 = function() {
		var node = getSelectFDNode(forcedirectedGraph);
		if (node != null && node != "") {
			var userid = node.getData('oriuser').userid;
			if (userid != "") {
				viewUserHome(userid);
			} else {
				alert("<?php echo $LNG->NETWORKMAPS_SELECTED_NODEID_ERROR; ?>");
			}
		}
	};
	Event.observe(button3,"click", handler3);
	Event.observe(view3,"click", handler3);
	tb2.insert(view3);

	return tb2;
}

/**
 * Create the graph toolbar for all embedded network graphs
 */
function createEmbedBasicGraphToolbar(forcedirectedGraph, contentarea) {

	var tb2 = new Element("div", {'id':'graphmaintoolbar','class':'toolbarrow', 'style':'padding-top:5px;display:block;'});

	var zoomOut = new Element("button", {'style':'float:left;margin-left: 10px;padding:3px;', 'title':'<?php echo $LNG->GRAPH_ZOOM_IN_HINT;?>'});
	var zoomOuticon = new Element("img", {'src':"<?php echo $HUB_FLM->getImagePath('magminus.png'); ?>", 'border':'0'});
	zoomOut.insert(zoomOuticon);
	var zoomOuthandler = function() {
		zoomFD(forcedirectedGraph, 5.0);
	};
	Event.observe(zoomOut,"click", zoomOuthandler);
	tb2.insert(zoomOut);

	var zoomIn = new Element("button", {'style':'float:left;margin-left: 10px;padding:3px;', 'title':'<?php echo $LNG->GRAPH_ZOOM_OUT_HINT;?>'});
	var zoomInicon = new Element("img", {'src':"<?php echo $HUB_FLM->getImagePath('magplus.png'); ?>", 'border':'0'});
	zoomIn.insert(zoomInicon);
	var zoomInhandler = function() {
		zoomFD(forcedirectedGraph, -5.0);
	};
	Event.observe(zoomIn,"click", zoomInhandler);
	tb2.insert(zoomIn);

	var zoom1to1 = new Element("button", {'style':'float:left;margin-left: 10px;padding:3px;', 'title':'<?php echo $LNG->GRAPH_ZOOM_ONE_TO_ONE_HINT;?>'});
	var zoom1to1icon = new Element("img", {'src':"<?php echo $HUB_FLM->getImagePath('zoomfull.png'); ?>", 'border':'0'});
	zoom1to1.insert(zoom1to1icon);
	var zoom1to1handler = function() {
		zoomFDFull(forcedirectedGraph);
	};
	Event.observe(zoom1to1,"click", zoom1to1handler);
	tb2.insert(zoom1to1);

	var zoomFit = new Element("button", {'style':'float:left;margin-left: 10px;padding:3px;', 'title':'<?php echo $LNG->GRAPH_ZOOM_FIT_HINT;?>'});
	var zoomFiticon = new Element("img", {'src':"<?php echo $HUB_FLM->getImagePath('zoomfit.png'); ?>", 'border':'0'});
	zoomFit.insert(zoomFiticon);
	var zoomFithandler = function() {
		zoomFDFit(forcedirectedGraph);
	};
	Event.observe(zoomFit,"click", zoomFithandler);
	tb2.insert(zoomFit);

	var printButton = new Element("button", {'style':'float:left;margin-left: 10px;padding:3px;', 'title':'<?php echo $LNG->GRAPH_PRINT_HINT;?>'});
	var printButtonicon = new Element("img", {'src':"<?php echo $HUB_FLM->getImagePath('printer.png'); ?>", 'border':'0'});
	printButton.insert(printButtonicon);
	var printButtonhandler = function() {
		printCanvas(forcedirectedGraph);
	};
	Event.observe(printButton,"click", printButtonhandler);
	tb2.insert(printButton);

	var count = new Element("div", {'id':'graphConnectionCount','style':'float:left;margin-left-25px;margin-top:7px;'});
	tb2.insert(count);

	return tb2;
}

var lastconnections = "";
function getLastConnections() {
	return lastconnections;
}

/**
 * Create the graph toolbar for Social network graphs
 */
function createEmbedSocialGraphToolbar(forcedirectedGraph,contentarea) {

	var tb2 = createEmbedBasicGraphToolbar(forcedirectedGraph,contentarea);

	var label = new Element("label", {'style':'float:left;margin-left:20px;margin-top:7px;'});
	label.insert('<?php echo $LNG->NETWORKMAPS_SOCIAL_CONNECTION_MESSAGE; ?>');
	tb2.insert(label);

	/*var button2 = new Element("button", {'id':'viewdetailbutton','style':'margin-left: 30px;padding:3px;','title':'<?php echo $LNG->NETWORKMAPS_SOCIAL_CONNECTION_HINT; ?>'});
	var icon2 = new Element("img", {'id':'viewdetailicon', 'src':"<?php echo $HUB_FLM->getImagePath('connection.png'); ?>", 'border':'0'});
	button2.insert(icon2);
	tb2.insert(button2);

	var view = new Element("a", {'id':'viewdetaillink', 'title':"<?php echo $LNG->NETWORKMAPS_SOCIAL_CONNECTION_HINT; ?>", 'style':'margin-left:5px;cursor:pointer;'});
	view.insert('<span id="viewbuttons"><?php echo $LNG->NETWORKMAPS_SOCIAL_CONNECTION_LINK; ?></span>');
	var handler2 = function() {
		var adj = getSelectFDLink(forcedirectedGraph);
		var connections = adj.getData('connections');
		lastconnections = "";
		if (connections && connections.length > 0) {
			lastconnections = connections;
			windowRef = loadDialog("multiconnections", URL_ROOT+"ui/networkmaps/showmulticonns.php", 790, 450);
		} else {
			alert("<?php echo $LNG->NETWORKMAPS_SELECTED_NODEID_ERROR; ?>");
		}
	};
	Event.observe(button2,"click", handler2);
	Event.observe(view,"click", handler2);
	tb2.insert(view);
	*/

	return tb2;
}

/**
 * Create the graph toolbar for embedded network graphs
 */
function createEmbedNetworkGraphToolbar(forcedirectedGraph,contentarea) {
	var tb2 = new Element("div", {'id':'graphmaintoolbar','class':'toolbarrow', 'style':'padding-top:5px;display:block;'});

	var zoomOut = new Element("button", {'style':'float:left;padding:3px;', 'title':'<?php echo $LNG->GRAPH_ZOOM_IN_HINT;?>'});
	var zoomOuticon = new Element("img", {'src':"<?php echo $HUB_FLM->getImagePath('magminus.png'); ?>", 'border':'0'});
	zoomOut.insert(zoomOuticon);
	var zoomOuthandler = function() {
		zoomFD(forcedirectedGraph, 5.0);
	};
	Event.observe(zoomOut,"click", zoomOuthandler);
	tb2.insert(zoomOut);

	var zoomIn = new Element("button", {'style':'float:left;margin-left: 10px;padding:3px;', 'title':'<?php echo $LNG->GRAPH_ZOOM_OUT_HINT;?>'});
	var zoomInicon = new Element("img", {'src':"<?php echo $HUB_FLM->getImagePath('magplus.png'); ?>", 'border':'0'});
	zoomIn.insert(zoomInicon);
	var zoomInhandler = function() {
		zoomFD(forcedirectedGraph, -5.0);
	};
	Event.observe(zoomIn,"click", zoomInhandler);
	tb2.insert(zoomIn);

	var zoom1to1 = new Element("button", {'style':'float:left;margin-left: 10px;padding:3px;', 'title':'<?php echo $LNG->GRAPH_ZOOM_ONE_TO_ONE_HINT;?>'});
	var zoom1to1icon = new Element("img", {'src':"<?php echo $HUB_FLM->getImagePath('zoomfull.png'); ?>", 'border':'0'});
	zoom1to1.insert(zoom1to1icon);
	var zoom1to1handler = function() {
		zoomFDFull(forcedirectedGraph);
	};
	Event.observe(zoom1to1,"click", zoom1to1handler);
	tb2.insert(zoom1to1);

	var zoomFit = new Element("button", {'style':'float:left;margin-left: 10px;padding:3px;', 'title':'<?php echo $LNG->GRAPH_ZOOM_FIT_HINT;?>'});
	var zoomFiticon = new Element("img", {'src':"<?php echo $HUB_FLM->getImagePath('zoomfit.png'); ?>", 'border':'0'});
	zoomFit.insert(zoomFiticon);
	var zoomFithandler = function() {
		zoomFDFit(forcedirectedGraph);
	};
	Event.observe(zoomFit,"click", zoomFithandler);
	tb2.insert(zoomFit);

	var printButton = new Element("button", {'style':'float:left;margin-left: 10px;padding:3px;', 'title':'<?php echo $LNG->GRAPH_PRINT_HINT;?>'});
	var printButtonicon = new Element("img", {'src':"<?php echo $HUB_FLM->getImagePath('printer.png'); ?>", 'border':'0'});
	printButton.insert(printButtonicon);
	var printButtonhandler = function() {
		printCanvas(forcedirectedGraph);
	};
	Event.observe(printButton,"click", printButtonhandler);
	tb2.insert(printButton);

	var count = new Element("div", {'id':'graphConnectionCount','style':'float:left;margin-left-25px;margin-top:10px;'});
	tb2.insert(count);

	var key = new Element("div", {'id':'key', 'style':'clear:both;float:left;margin-top:10px;'});
	var text = "";
	text += '<div style="float:left;margin-right:5px;"><span style="padding:3px;background: '+challengebackpale+'; color: black; font-weight:bold"><?php echo $LNG->CHALLENGE_NAME; ?></span></div>';
	text += '<div style="float:left;margin-right:5px;"><span style="padding:3px;background:'+issuebackpale+'; color: black; font-weight:bold"><?php echo $LNG->ISSUE_NAME; ?></span></div>';
	text += '<div style="float:left;margin-right:5px;"><span style="padding:3px;background: '+solutionbackpale+'; color: black; font-weight:bold"><?php echo $LNG->SOLUTION_NAME; ?></span></div>';
	text += '<div style="float:left;margin-right:5px;"><span style="padding:3px;background: '+probackpale+'; color: black; font-weight:bold"><?php echo $LNG->PRO_NAME; ?></span></div>';
	text += '<div style="float:left;margin-right:5px;"><span style="padding:3px;background: '+conbackpale+'; color: black; font-weight:bold"><?php echo $LNG->CON_NAME; ?></span></div>';
	text += '<div style="float:left;margin-right:5px;"><span style="padding:3px;background:'+argumentbackpale+'; color: black; font-weight:bold"><?php echo $LNG->ARGUMENT_NAME; ?></span></div>';
	text += '<div style="float:left;margin-right:5px;"><span style="padding:3px;background: '+ideabackpale+'; color: black; font-weight:bold"><?php echo $LNG->IDEA_NAME; ?></span></div>';
	text += '<div style="float:left;margin-right:5px;"><span style="padding:3px;background:'+commentbackpale+'; color: black; font-weight:bold"><?php echo $LNG->COMMENT_NAME; ?></span></div>';

	key.insert(text);

	tb2.insert(key);

	return tb2;
}


/**
 * Create the graph toolbar for embedded network graphs
 */
function createHeatMapNetworkToolbar(forcedirectedGraph, biggest) {
	var tb2 = new Element("div", {'id':'graphmaintoolbar','class':'toolbarrow', 'style':'padding-top:5px;display:block;'});

	var zoomOut = new Element("button", {'style':'float:left;margin-left: 10px;padding:3px;', 'title':'<?php echo $LNG->GRAPH_ZOOM_IN_HINT;?>'});
	var zoomOuticon = new Element("img", {'src':"<?php echo $HUB_FLM->getImagePath('magminus.png'); ?>", 'border':'0'});
	zoomOut.insert(zoomOuticon);
	var zoomOuthandler = function() {
		zoomFD(forcedirectedGraph, 5.0);
	};
	Event.observe(zoomOut,"click", zoomOuthandler);
	tb2.insert(zoomOut);

	var zoomIn = new Element("button", {'style':'float:left;margin-left: 10px;padding:3px;', 'title':'<?php echo $LNG->GRAPH_ZOOM_OUT_HINT;?>'});
	var zoomInicon = new Element("img", {'src':"<?php echo $HUB_FLM->getImagePath('magplus.png'); ?>", 'border':'0'});
	zoomIn.insert(zoomInicon);
	var zoomInhandler = function() {
		zoomFD(forcedirectedGraph, -5.0);
	};
	Event.observe(zoomIn,"click", zoomInhandler);
	tb2.insert(zoomIn);

	var zoom1to1 = new Element("button", {'style':'float:left;margin-left: 10px;padding:3px;', 'title':'<?php echo $LNG->GRAPH_ZOOM_ONE_TO_ONE_HINT;?>'});
	var zoom1to1icon = new Element("img", {'src':"<?php echo $HUB_FLM->getImagePath('zoomfull.png'); ?>", 'border':'0'});
	zoom1to1.insert(zoom1to1icon);
	var zoom1to1handler = function() {
		zoomFDFull(forcedirectedGraph);
	};
	Event.observe(zoom1to1,"click", zoom1to1handler);
	tb2.insert(zoom1to1);

	var zoomFit = new Element("button", {'style':'float:left;margin-left: 10px;padding:3px;', 'title':'<?php echo $LNG->GRAPH_ZOOM_FIT_HINT;?>'});
	var zoomFiticon = new Element("img", {'src':"<?php echo $HUB_FLM->getImagePath('zoomfit.png'); ?>", 'border':'0'});
	zoomFit.insert(zoomFiticon);
	var zoomFithandler = function() {
		zoomFDFit(forcedirectedGraph);
	};
	Event.observe(zoomFit,"click", zoomFithandler);
	tb2.insert(zoomFit);

	var printButton = new Element("button", {'style':'float:left;margin-left: 10px;padding:3px;', 'title':'<?php echo $LNG->GRAPH_PRINT_HINT;?>'});
	var printButtonicon = new Element("img", {'src':"<?php echo $HUB_FLM->getImagePath('printer.png'); ?>", 'border':'0'});
	printButton.insert(printButtonicon);
	var printButtonhandler = function() {
		printCanvas(forcedirectedGraph);
	};
	Event.observe(printButton,"click", printButtonhandler);
	tb2.insert(printButton);

	var key = new Element("div", {'id':'key', 'style':'float:left;margin-left:20px;margin-top:10px;'});
	key.insert('<div style="float:left;margin-right:5px;"><?php echo $LNG->INTEREST_NETWORK_CALCULATION_KEY; ?>: </div>');
	var text = "";
	var color = ["#313695","#4575b4","#74add1","#abd9e9","#e0f3f8","#ffffbf","#fee090","#fdae61","#f46d43","#d73027","#a50026"];
	var interval = Math.round(biggest / 10);
	for (var i=0; i<10; i++) {
		var from = (i*interval)+1;
		var to = ((i+1)*interval);
		if (from == 1) { from = 0; }
		if (to > biggest) {	to = biggest; }
		var colour = 'black';
		if (i < 3 || i > 6) { colour = 'white'; }
		text += '<div style="float:left;margin-right:5px;"><span style="padding:3px;background: '+color[i]+';color:'+colour+'; font-weight:bold">'+from+' - '+to+'</span></div>';
	}
	key.insert(text);
	tb2.insert(key);

	return tb2;
}

/**
 * Create the graph toolbar for embedded network graphs
 */
function createShortNetworkToolbar(forcedirectedGraph) {
	var tb2 = new Element("div", {'id':'graphmaintoolbar','class':'toolbarrow', 'style':'padding-top:5px;display:block;'});

	var zoomOut = new Element("button", {'style':'float:left;margin-left: 10px;padding:3px;', 'title':'<?php echo $LNG->GRAPH_ZOOM_IN_HINT;?>'});
	var zoomOuticon = new Element("img", {'src':"<?php echo $HUB_FLM->getImagePath('magminus.png'); ?>", 'border':'0'});
	zoomOut.insert(zoomOuticon);
	var zoomOuthandler = function() {
		zoomFD(forcedirectedGraph, 5.0);
	};
	Event.observe(zoomOut,"click", zoomOuthandler);
	tb2.insert(zoomOut);

	var zoomIn = new Element("button", {'style':'float:left;margin-left: 10px;padding:3px;', 'title':'<?php echo $LNG->GRAPH_ZOOM_OUT_HINT;?>'});
	var zoomInicon = new Element("img", {'src':"<?php echo $HUB_FLM->getImagePath('magplus.png'); ?>", 'border':'0'});
	zoomIn.insert(zoomInicon);
	var zoomInhandler = function() {
		zoomFD(forcedirectedGraph, -5.0);
	};
	Event.observe(zoomIn,"click", zoomInhandler);
	tb2.insert(zoomIn);

	var zoom1to1 = new Element("button", {'style':'float:left;margin-left: 10px;padding:3px;', 'title':'<?php echo $LNG->GRAPH_ZOOM_ONE_TO_ONE_HINT;?>'});
	var zoom1to1icon = new Element("img", {'src':"<?php echo $HUB_FLM->getImagePath('zoomfull.png'); ?>", 'border':'0'});
	zoom1to1.insert(zoom1to1icon);
	var zoom1to1handler = function() {
		zoomFDFull(forcedirectedGraph);
	};
	Event.observe(zoom1to1,"click", zoom1to1handler);
	tb2.insert(zoom1to1);

	var zoomFit = new Element("button", {'style':'float:left;margin-left: 10px;padding:3px;', 'title':'<?php echo $LNG->GRAPH_ZOOM_FIT_HINT;?>'});
	var zoomFiticon = new Element("img", {'src':"<?php echo $HUB_FLM->getImagePath('zoomfit.png'); ?>", 'border':'0'});
	zoomFit.insert(zoomFiticon);
	var zoomFithandler = function() {
		zoomFDFit(forcedirectedGraph);
	};
	Event.observe(zoomFit,"click", zoomFithandler);
	tb2.insert(zoomFit);

	var printButton = new Element("button", {'style':'float:left;margin-left: 10px;padding:3px;', 'title':'<?php echo $LNG->GRAPH_PRINT_HINT;?>'});
	var printButtonicon = new Element("img", {'src':"<?php echo $HUB_FLM->getImagePath('printer.png'); ?>", 'border':'0'});
	printButton.insert(printButtonicon);
	var printButtonhandler = function() {
		printCanvas(forcedirectedGraph);
	};
	Event.observe(printButton,"click", printButtonhandler);
	tb2.insert(printButton);

	return tb2;
}

/**
 * Calulate the width and height of the visible graph area
 * depending if it is reduced or enlarged at present.
 */
function resizeFDGraph(graphview, contentarea, withInner){
	if ($('header')&& $('header').style.display == "none") {
		var width = $(contentarea).offsetWidth - 35;
		var height = getWindowHeight();
		//alert(height);

		if ($('graphkeydivtoolbar')) {
			height -= $('graphkeydivtoolbar').offsetHeight;
		}
		if ($('graphmaintoolbar')) {
			height -= $('graphmaintoolbar').offsetHeight;
		}
		height -= 20;

		//alert(height);

		$(graphview.config.injectInto+'-outer').style.width = width+"px";
		$(graphview.config.injectInto+'-outer').style.height = height+"px";

		//if (withInner) {
			resizeFDGraphCanvas(graphview, width, height);
		//}
	} else {
		var size = calulateInitialGraphViewport(contentarea)
		$(graphview.config.injectInto+'-outer').style.width = size.width+"px";
		$(graphview.config.injectInto+'-outer').style.height = size.height+"px";

		//if (withInner) {
			resizeFDGraphCanvas(graphview, width, height);
		//}
	}

	// GRAB FOCUS
	graphview.canvas.getPos(true);
}


function calulateInitialGraphViewport(areaname) {
	var w = $(areaname).offsetWidth; // - 30;
	var h = getWindowHeight();
	//alert(h);

	if ($('header')) {
		h -= $('header').offsetHeight;
	}

	if ($('headertoolbar')) {
		h -= $('headertoolbar').offsetHeight;
		h -= 30;
	}

	if ($('graphkeydivtoolbar')) {
		h -= $('graphkeydivtoolbar').offsetHeight;
	}
	if ($('graphmaintoolbar')) {
		h -= $('graphmaintoolbar').offsetHeight;
	}

	// Main social Network
	if ($('tabs')) { // +user social uses this
		h -= $('tabs').offsetHeight;
	}
	if ($('tab-content-user-title')) {
		h -= $('tab-content-user-title').offsetHeight;
		h -= 35;
	}
	if ($('tab-content-user-search')) {
		h -= $('tab-content-user-search').offsetHeight;
	}
	if ($('usertabs')) {
		h -= $('usertabs').offsetHeight;
	}

	// User social network
	if ($('context')) {
		h -= $('context').offsetHeight;
	}
	if ($('tab-content-user-bar')) {
		h -= $('tab-content-user-bar').offsetHeight;
		h -= 20;
	}

	//alert(h);
	return {width:w, height:h};
}

/**
 * Called to set the screen to standard view
 */
function reduceMap(contentarea, forcedirectedGraph) {

	if ($('header')) {
		$('header').style.display="block";
	}

	// The explore views toolbar
	if ($('headertoolbar')) {
		$('headertoolbar').style.display="block";
	}

	// Main social Network
	if ($('tabs')) { // +user social uses this
		$('tabs').style.display="block";
	}
	if ($('tab-content-user-title')) {
		$('tab-content-user-title').style.display="block";
	}
	if ($('tab-content-user-search')) {
		$('tab-content-user-search').style.display="block";
	}
	if ($('usertabs')) {
		$('usertabs').style.display="block";
	}

	// User social network
	if ($('context')) {
		$('context').style.display="block";
	}
	if ($('tab-content-user-bar')) {
		$('tab-content-user-bar').style.display="block";
	}

	resizeFDGraph(forcedirectedGraph, contentarea, true);
}

/**
 * Called to remove some screen realestate to increase map area.
 */
function enlargeMap(contentarea, forcedirectedGraph) {

	if ($('header')) {
		$('header').style.display="none";
	}

	// The explore views toolbar
	if ($('headertoolbar')) {
		$('headertoolbar').style.display="none";
	}

	// Main social Network
	if ($('tabs')) { // +user social uses this
		$('tabs').style.display="none";
	}
	if ($('tab-content-user-title')) {
		$('tab-content-user-title').style.display="none";
	}
	if ($('tab-content-user-search')) {
		$('tab-content-user-search').style.display="none";
	}
	if ($('usertabs')) {
		$('usertabs').style.display="none";
	}

	// User social network
	if ($('context')) {
		$('context').style.display="none";
	}
	if ($('tab-content-user-bar')) {
		$('tab-content-user-bar').style.display="none";
	}

	resizeFDGraph(forcedirectedGraph, contentarea, true);
}

/**
 * Called by the Applet to open the applet help
 */
function showHelp() {
    loadDialog('help', URL_ROOT+'ui/pages/networkmap.php');
}

/**
 * Called by the Applet to go to the home page of the given userid
 */
function viewUserHome(userid) {
	var width = getWindowWidth();
	var height = getWindowHeight()-20;

	loadDialog('userdetails', URL_ROOT+"user.php?userid="+userid, width,height);
}

/**
 * Check if the current brwoser supports HTML5 Canvas.
 * Return true if it does, else false.
 */
function isCanvasSupported(){
  	var elem = document.createElement('canvas');
  	return !!(elem.getContext && elem.getContext('2d'));
}
