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
 /** @author Michelle Bachler, KMi, The Open University */

header('Content-Type: text/javascript;');
include_once(__DIR__ . '/../config.php');


// Colours for the vis node types
echo "var challengebackpale = '".$CFG->challengebackpale."';";
echo "var issuebackpale = '".$CFG->issuebackpale."';";
echo "var solutionbackpale = '".$CFG->solutionbackpale."';";
echo "var peoplebackpale = '".$CFG->peoplebackpale."';";
echo "var probackpale = '".$CFG->probackpale."';";
echo "var conbackpale = '".$CFG->conbackpale."';";
echo "var resourcebackpale = '".$CFG->resourcebackpale."';";
echo "var plainbackpale  = '".$CFG->plainbackpale."';";
echo "var groupbackpale  = '".$CFG->groupbackpale."';";
echo "var argumentbackpale  = '".$CFG->argumentbackpale."';";
echo "var votebackpale  = '".$CFG->votebackpale."';";
echo "var commentbackpale  = '".$CFG->commentbackpale."';";
echo "var mapbackpale  = '".$CFG->mapbackpale."';";
echo "var ideabackpale  = '".$CFG->ideabackpale."';";

echo "var challengeback = '".$CFG->challengeback."';";
echo "var issueback = '".$CFG->issueback."';";
echo "var solutionback = '".$CFG->solutionback."';";
echo "var peopleback = '".$CFG->peopleback."';";
echo "var proback = '".$CFG->proback."';";
echo "var conback = '".$CFG->conback."';";
echo "var resourceback = '".$CFG->resourceback."';";
echo "var plainback  = '".$CFG->plainback."';";
echo "var groupback  = '".$CFG->groupback."';";
echo "var voteback  = '".$CFG->voteback."';";
echo "var argumentback  = '".$CFG->argumentback."';";
echo "var commentback  = '".$CFG->commentback."';";
echo "var mapback  = '".$CFG->mapback."';";
echo "var ideaback  = '".$CFG->ideaback."';";

echo "var unknowntypeback  = '".$CFG->unknowntypeback."';";

?>

/**
 * Variables
 */
var URL_ROOT = "<?php print $CFG->homeAddress;?>";
var SERVICE_ROOT = URL_ROOT + "core/service.php?format=json";

var DATE_FORMAT = 'd/m/yy';
var DATE_FORMAT_PROJECT = 'd mmm yyyy';
var TIME_FORMAT = 'd/m/yy - H:MM';

var IE = 0;
var IE5 = 0;
var NS = 0;
var GECKO = 0;

var openpopups = new Array();

/** Store some variables about the browser being used.*/
if (document.all) {     // Internet Explorer Detected
	OS = navigator.platform;
	VER = new String(navigator.appVersion);
	VER = VER.substr(VER.indexOf("MSIE")+5, VER.indexOf(" "));
	if ((VER <= 5) && (OS == "Win32")) {
		IE5 = true;
	} else {
		IE = true;
	}
} else if (document.layers) {   // Netscape Navigator Detected
	NS = true;
} else if (document.getElementById) { // Netscape 6 Detected
	GECKO = true;
}

String.prototype.trim = function() {
	return this.replace(/^\s+|\s+$/g,"");
}

/**
 * Check to see if the enter key was pressed then fire the onlcik of that item.
 */
function enterKeyPressed(evt) {
 	var event = evt || window.event;
	var thing = event.target || event.srcElement;

	var characterCode = document.all? window.event.keyCode:event.which;
	if(characterCode == 13) {
		thing.onclick();
	}
}

/**
 * get the anchor (#) value from the url
 */
function getAnchorVal(defVal){
    var url = document.location;
    var strippedUrl = url.toString().split("#");
    if(strippedUrl.length > 1 && strippedUrl[1] != ""){
        return strippedUrl[1];
    } else {
        return defVal;
    }
}

/**
 * Open a page in the dialog window
 */
function loadDialog(windowName, url, width, height){

    if (width == null){
        width = 570;
    }
    if (height == null){
        height = 510;
    }

    var left = parseInt((screen.availWidth/2) - (width/2));
    var top  = parseInt((screen.availHeight/2) - (height/2));
    var props = "width="+width+",height="+height+",left="+left+",top="+top+",menubar=no,toolbar=no,scrollbars=yes,location=no,status=no,resizable=yes";

    //var props = "width="+width+",height="+height+",left="+left+",top="+top+",menubar=no,toolbar=no,scrollbars=yes,location=no,status=yes,resizable=yes";
	var newWin = "";
    try {
    	newWin = window.open(url, windowName, props);
    	if(newWin == null){
    		alert("<?php echo $LNG->POPUPS_BLOCK; ?>");
    	} else {
    		newWin.focus();
    	}
    } catch(err) {
    	//IE error
    	alert(err.description);
    }

    return newWin;
}

/**
 * Toggle the given div between display 'block' and 'none'
 */
function toggleDiv(div) {
	var div = document.getElementById(div);
	if (div.style.display == "none") {
		div.style.display = "block";
	} else {
		div.style.display = "none";
	}
}

/**
 * Return the height of the current browser page.
 * Defaults to 500.
 */
function getWindowHeight(){
  	var viewportHeight = 500;
	if (self.innerHeight) {
		// all except Explorer
		viewportHeight = self.innerHeight;
	} else if (document.documentElement && document.documentElement.clientHeight) {
	 	// Explorer 6 Strict Mode
		viewportHeight = document.documentElement.clientHeight;
	} else if (document.body)  {
		// other Explorers
		viewportHeight = document.body.clientHeight;
	}
	return viewportHeight;
}

/**
 * Return the width of the current browser page.
 * Defaults to 500.
 */
function getWindowWidth(){
  	var viewportWidth = 500;
	if (self.innerHeight) {
		// all except Explorer
		viewportWidth = self.innerWidth;
	} else if (document.documentElement && document.documentElement.clientHeight) {
	 	// Explorer 6 Strict Mode
		viewportWidth = document.documentElement.clientWidth;
	} else if (document.body)  {
		// other Explorers
		viewportWidth = document.body.clientWidth;
	}
	return viewportWidth;
}

function getPageOffsetX() {
	var x = 0;

    if (typeof(window.pageXOffset) == 'number') {
		x = window.pageXOffset;
	} else {
        if (document.body && document.body.scrollLeft) {
			x = document.body.scrollLeft;
        } else if (document.documentElement && document.documentElement.scrollLeft) {
			x = document.documentElement.scrollLeft;
		}
	}

	return x;
}

function getPageOffsetY() {
	var y = 0;

    if (typeof(window.pageYOffset) == 'number') {
		y = window.pageYOffset;
	} else {
        if (document.body && document.body.scrollTop) {
			y = document.body.scrollTop;
        } else if (document.documentElement && document.documentElement.scrollTop) {
			y = document.documentElement.scrollTop;
		}
	}

	return y;
}

/**
 * Return the position of the given element in an x/y array.
 */
function getPosition(element) {
	var xPosition = 0;
	var yPosition = 0;

	while(element && element != null) {

		xPosition += element.offsetLeft;
		xPosition -= element.scrollLeft;
		xPosition += element.clientLeft;

		yPosition += element.offsetTop;
		yPosition += element.clientTop;

		// Messes up menu positions in Chrome if this is included.
		// Works fine on all main browsers and Chrome if it is not.
		// yPosition -= element.scrollTop;

		//alert(element.id+" :"+"element.offsetTop: "+element.offsetTop+" element.scrollTop :"+element.scrollTop+" element.clientTop :"+element.clientTop);
		//alert(element.id+" :"+xPosition+":"+yPosition);

		// if the element is a table, get the parentElement as offsetParent is wrong
		if (element.nodeName == 'TABLE') {
			var prevelement = element;
			var nextelement = element.parentNode;
			//find a div with any scroll set.
			while(nextelement != prevelement.offsetParent) {
				yPosition -= nextelement.scrollTop;
				xPosition -= nextelement.scrollLeft;
				nextelement = nextelement.parentNode;
			}
		}

		element = element.offsetParent;
	}

	return { x: xPosition, y: yPosition };
}

/**
 * Display the index page hint for the given type.
 */
function showGlobalHint(type,evt,panelName) {

 	var event = evt || window.event;

	$('globalMessage').innerHTML="";

	if (type == "StatsOverviewParticipation") {
		$("globalMessage").insert('<?php echo addslashes($LNG->STATS_OVERVIEW_HEALTH_PARTICIPATION_HINT); ?>');
	} else if (type == "StatsOverviewViewing") {
		$("globalMessage").insert('<?php echo addslashes($LNG->STATS_OVERVIEW_HEALTH_VIEWING_HINT); ?>');
	} else if (type == "StatsOverviewDebate") {
		$("globalMessage").insert('<?php echo addslashes($LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION_HINT); ?>');
	} else if (type == "StatsDebateContribution") {
		$("globalMessage").insert('<?php echo addslashes($LNG->STATS_DEBATE_CONTRIBUTION_HELP); ?>');
	} else if (type == "StatsDebateViewing") {
		$("globalMessage").insert('<?php echo addslashes($LNG->STATS_DEBATE_VIEWING_HELP); ?>');
	}

	showHint(event, panelName, 10, -10);
}

/**
 * Show a rollover hint popup div (when multiple lines needed).
 */
function showHint(evt, popupName, extraX, extraY) {

	hideHints();

 	var event = evt || window.event;
	var thing = event.target || event.srcElement;

	var viewportHeight = getWindowHeight();
	var viewportWidth = getWindowWidth();
	var panel = document.getElementById(popupName);

	if (GECKO) {
		//adjust for it going off the screen right or bottom.
		var x = event.clientX;
		var y = event.clientY;
		if ( (x+panel.offsetWidth+30) > viewportWidth) {
			x = x-(panel.offsetWidth+30);
		} else {
			x = x+10;
		}
		if ( (y+panel.offsetHeight) > viewportHeight) {
			y = y-50;
		} else {
			y = y-5;
		}

		if (panel) {
			panel.style.left = x+extraX+window.pageXOffset+"px";
			panel.style.top = y+extraY+window.pageYOffset+"px";
			panel.style.background = "#FFFED9";
			panel.style.visibility = "visible";
			openpopups.push(popupName);
		}
	}
	else if (NS) {
		//adjust for it going off the screen right or bottom.
		var x = event.pageX;
		var y = event.pageY;
		if ( (x+panel.offsetWidth+30) > viewportWidth) {
			x = x-(panel.offsetWidth+30);
		} else {
			x = x+10;
		}
		if ( (y+panel.offsetHeight) > viewportHeight) {
			y = y-50;
		} else {
			y = y-5;
		}
		document.layers[popupName].moveTo(x+extraX+window.pageXOffset+"px", y+extraY+window.pageYOffset+"px");
		document.layers[popupName].bgColor = "#FFFED9";
		document.layers[popupName].visibility = "show";
		openpopups.push(popupName);
	}
	else if (IE || IE5) {
		//adjust for it going off the screen right or bottom.
		var x = event.x;
		var y = event.clientY;
		if ( (x+panel.offsetWidth+30) > viewportWidth) {
			x = x-(panel.offsetWidth+30);
		} else {
			x = x+10;
		}
		if ( (y+panel.offsetHeight) > viewportHeight) {
			y = y-50;
		} else {
			y = y-5;
		}

		window.event.cancelBubble = true;
		document.all[popupName].style.left = x+extraX+ document.documentElement.scrollLeft+"px";
		document.all[popupName].style.top = y+extraY+ document.documentElement.scrollTop+"px";
		document.all[popupName].style.visibility = "visible";
		openpopups[openpopups.length] = popupName;
	}
	return false;
}

function hideHints() {
	var popupname;
	for (var i = 0; i < openpopups.length; i++) {
		popupname = new String (openpopups[i]);
		if (popupname) {
			var popup = document.getElementById(popupname);
			if (popup) {
				popup.style.visibility = "hidden";
			}
		}
	}
	openpopups = new Array();
	return;
}

var popupTimerHandleArray = new Array();
var popupArray = new Array();

function showBox(div) {
	hideBoxes();

    if (popupTimerHandleArray[div] != null) {
        clearTimeout(popupTimerHandleArray[div]);
        popupTimerHandleArray[div] = null;
    }

    var divObj = document.getElementById(div);
    divObj.style.display = 'block';
    popupArray.push(div);
}

function hideBox(div) {
    var popupTimerHandle = setTimeout("reallyHideBox('" + div + "');", 250);
    popupTimerHandleArray[div] = popupTimerHandle;
}

function reallyHideBox(div) {
    var divObj = document.getElementById(div);
    divObj.style.display = 'none';
}

function hideBoxes() {
	var popupname;
	for (var i = 0; i < popupArray.length; i++) {
		popupname = new String (popupArray[i]);
		var popup = document.getElementById(popupname);
		if (popup) {
			popup.style.display = "none";
		}
	}
	popupArray = new Array();
	return;
}

function fadeMessage(messageStr) {
	var viewportHeight = getWindowHeight();
	var viewportWidth = getWindowWidth();
	var x = (viewportWidth-300)/2;
	var y = (viewportHeight-100)/2;
	$('message').style.left = x+getPageOffsetX()+"px";
	$('message').style.top = y+getPageOffsetY()+"px";
	$('message').update("");
	$('message').update(messageStr);
	$('message').style.display = "block";
	fadein();
    var fade=setTimeout("fadeout()",2500);
}

function fadein(){
	var element = document.getElementById("message");
	element.style.opacity = 0.0;
	fadeinloop();
}

function fadeinloop(){
	var element = document.getElementById("message");

	element.style.opacity += 0.1;
	if(element.style.opacity > 1.0) {
		element.style.opacity = 1.0;
	} else {
		setTimeout("fadeinloop()", 100);
	}
}

function fadeout(){
	var element = document.getElementById("message");
	element.style.opacity = 1.0;
	fadeoutloop();
}

function fadeoutloop(){
	var element = document.getElementById("message");

	element.style.opacity -= 0.1;
	if(element.style.opacity < 0.0) {
		element.style.opacity = 0.0;
	} else {
		setTimeout("fadeoutloop()", 100);
	}
}


function getLoading(infoText){
    var loadDiv = new Element("div",{'class':'loading'});
    loadDiv.insert("<img src='<?php echo $HUB_FLM->getImagePath('ajax-loader.gif'); ?>'/>");
    loadDiv.insert("<br/>"+infoText);
    return loadDiv;
}

function getLoadingLine(infoText){
    var loadDiv = new Element("div",{'class':'loading'});
    loadDiv.insert("<img src='<?php echo $HUB_FLM->getImagePath('ajax-loader.gif'); ?>' />");
    loadDiv.insert("&nbsp;"+infoText);
    return loadDiv;
}

function nl2br (dataStr) {
	return dataStr.replace(/(\r\n|\r|\n)/g, "<br />");
}

/**
 * http://www.456bereastreet.com/archive/201105/validate_url_syntax_with_javascript/
 * MB: I modified the original as I could not get it to work as it was.
 */
function isValidURI(uri) {
    if (!uri) uri = "";

   	var schemeRE = /^([-a-z0-9]|%[0-9a-f]{2})*$/i;
   	var authorityRE = /^([-a-z0-9.:]|%[0-9a-f]{2})*$/i;
   	var pathRE = /^([-a-z0-9._~:@!$&'()*+,;=\//#]|%[0-9a-f]{2})*$/i;
    var qqRE = /^([-a-z0-9._~:@!$&'\[\]()*+,;=?\/]|%[0-9a-f]{2})*$/i;
    var qfRE = /^([-a-z0-9._~:@!$&#'\[\]()*+,;=?\/]|%[0-9a-f]{2})*$/i;
    var parser = /^(?:([^:\/?]+):)?(?:\/\/([^\/?]*))?([^?]*)(?:\?([^\#]*))?(?:(.*))?/;

    var result = uri.match(parser);

    var scheme    = result[1] || null;
    var authority = result[2] || null;
    var path      = result[3] || null;
    var query     = result[4] || null;
    var fragment  = result[5] || null;

    if (!scheme || !scheme.match(schemeRE)) {
        return false;
    }
    if (!authority || !authority.match(authorityRE)) {
        return false;
    }
    if (path != null && !path.match(pathRE)) {
        return false;
    }
    if (query && !query.match(qqRE)) {
        return false;
    }
    if (fragment && !fragment.match(qfRE)) {
        return false;
    }

    return true;
}

/**
 * Display explore page in a popup (called by applets).
 */
function viewNodeDetails(nodeid, nodetype, width, height) {
	loadDialog('details', URL_ROOT+"explore.php?id="+nodeid, width,height);
}


/**
 * Add the given connection object to the given map.
 * @param c the connection to add (json of connection returned from server).
 * @param map the name of the map applet to add the data to
 */
function addConnectionToNetworkMap(c, map) {

	var fN = c.from[0].cnode;
	var tN = c.to[0].cnode;

	var fnRole = c.fromrole[0].role;
	var fNNodeImage = "";
	if (fN.imagethumbnail != null && fN.imagethumbnail != "") {
		fNNodeImage = URL_ROOT + fN.imagethumbnail;
	} else if (fN.role[0].role.image != null && fN.role[0].role.image != "") {
		fNNodeImage = URL_ROOT + fN.role[0].role.image;
	}

	var tnRole = c.torole[0].role;
	var tNNodeImage = "";
	if (tN.imagethumbnail != null && tN.imagethumbnail != "") {
		tNNodeImage = URL_ROOT + tN.imagethumbnail;
	} else if (tN.role[0].role.image != null && tN.role[0].role.image != "") {
		tNNodeImage = URL_ROOT + tN.role[0].role.image;
	}
	var fromRole = fN.role[0].role.name;
	var toRole = tN.role[0].role.name;

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
	} else if (fromRole == 'Argument') {
		fromHEX = argumentbackpale;
	} else if (fromRole == 'Pro') {
		fromHEX = probackpale;
	} else if (fromRole == 'Con') {
		fromHEX = conbackpale;
	} else if (fromRole == 'Comment') {
		fromHEX = commentbackpale;
	} else if (fromRole == 'Idea') {
		fromHEX = ideabackpale;
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
	} else if (fromRole == 'Argument') {
		toHEX = argumentbackpale;
	} else if (fromRole == 'Pro') {
		toHEX = probackpale;
	} else if (fromRole == 'Con') {
		toHEX = conbackpale;
	} else if (toRole == 'Comment') {
		toHEX = commentbackpale;
	} else if (toRole == 'Idea') {
		toHEX = ideabackpale;
	} else if (toRole == 'Map') {
		toHEX = mapbackpale;
	} else {
		toHEX = plainbackpale;
	}

	fromRole = getNodeTitleAntecedence(fromRole, false);
	toRole = getNodeTitleAntecedence(toRole, false);

	//create from & to nodes
	$(map).addNode(fN.nodeid, fromRole+": "+fromName, fromDesc, fN.users[0].user.userid, fN.creationdate, fN.otheruserconnections, fNNodeImage, fN.users[0].user.thumb, fN.users[0].user.name, fromRole, fromHEX);
	$(map).addNode(tN.nodeid, toRole+": "+toName, toDesc, tN.users[0].user.userid, tN.creationdate, tN.otheruserconnections, tNNodeImage, tN.users[0].user.thumb, tN.users[0].user.name, toRole, toHEX);

	// add edge/conn
	var fromRoleName = fromRole;
	if (c.fromrole[0].role) {
		fromRoleName = c.fromrole[0].role.name;
	}

	var toRoleName = toRole;
	if (c.torole[0].role) {
		toRoleName = c.torole[0].role.name;
	}

	var linklabelname = c.linktype[0].linktype.label;
	linklabelname = getLinkLabelName(fN.role[0].role.name, tN.role[0].role.name, linklabelname);

	$(map).addEdge(c.connid, fN.nodeid, tN.nodeid, c.linktype[0].linktype.grouplabel, linklabelname, c.creationdate, c.userid, c.users[0].user.name, fromRoleName, toRoleName);
}

/**
 * Get the language version of the link label that should be displayed to the users.
 */
function getLinkLabelName(fromNodeTypeName, toNodeTypeName, linkName) {

	if (fromNodeTypeName == 'Resource' && linkName == '<?php echo $CFG->LINK_RESOURCE_NODE; ?>') {
		return '<?php echo $LNG->LINK_RESOURCE_NODE; ?>';
	} else if (fromNodeTypeName == 'Issue' && toNodeTypeName == 'Challenge') {
		return '<?php echo $LNG->LINK_ISSUE_CHALLENGE; ?>';
	} else if (fromNodeTypeName == 'Solution' && toNodeTypeName == 'Issue') {
		return '<?php echo $LNG->LINK_SOLUTION_ISSUE; ?>';
	} else if (fromNodeTypeName == 'Issue' && toNodeTypeName == 'Solution') {
		return '<?php echo $LNG->LINK_ISSUE_SOLUTION; ?>';
	} else if ((fromNodeTypeName == 'Pro' || fromNodeTypeName == 'Con' || fromNodeTypeName == 'Argument') &&
				(toNodeTypeName == 'Solution')) {
		if (linkName == '<?php echo $CFG->LINK_PRO_SOLUTION; ?>') {
			return '<?php echo $LNG->LINK_PRO_SOLUTION; ?>';
		} else if (linkName == '<?php echo $CFG->LINK_CON_SOLUTION; ?>') {
			return '<?php echo $LNG->LINK_CON_SOLUTION; ?>';
		}
	} else if (fromNodeTypeName == 'Idea') {
		return '<?php echo $LNG->LINK_IDEA_NODE; ?>';
	} else if (fromNodeTypeName == 'Comment' && toNodeTypeName == 'Comment') {
		return '<?php echo $LNG->LINK_COMMENT_COMMENT; ?>';
	} else if (fromNodeTypeName == 'Comment' && toNodeTypeName != 'Comment') {
		return '<?php echo $LNG->LINK_COMMENT_NODE; ?>';
	} else if (fromNodeTypeName == 'Decision' && toNodeTypeName != 'Issue') {
		return '<?php echo $LNG->LINK_DECISION_ISSUE; ?>';
	}

	return linkName;
}

/**
 * Return the node type text to be placed before the node title
 * @param nodetype the node type for node to return the text for
 * @param withColon true if you want a colon adding after the node type name, else false.
 */
function getNodeTitleAntecedence(nodetype, withColon) {
	if (withColon == undefined) {
		withColon = true;
	}

	var title=nodetype;

	if (nodetype == 'Challenge') {
		title = "<?php echo $LNG->CHALLENGE_NAME; ?>";
	} else if (nodetype == 'Issue') {
		title = "<?php echo $LNG->ISSUE_NAME; ?>";
	} else if (nodetype == 'Solution') {
		title = "<?php echo $LNG->SOLUTION_NAME; ?>";
	} else if (nodetype == 'Argument') {
		title = "<?php echo $LNG->ARGUMENT_NAME; ?>";
	} else if (nodetype == 'Pro') {
		title = "<?php echo $LNG->PRO_NAME; ?>";
	} else if (nodetype == 'Con') {
		title = "<?php echo $LNG->CON_NAME; ?>";
	} else if (nodetype == 'Resource') {
		title = "<?php echo $LNG->RESOURCE_NAME; ?>";
	} else if (nodetype == 'Comment') {
		title = "<?php echo $LNG->COMMENT_NAME; ?>";
	} else if (nodetype == 'Idea') {
		title = "<?php echo $LNG->IDEA_NAME; ?>";
	} else if (nodetype == 'Decision') {
		title = "<?php echo $LNG->DECISION_NAME; ?>";
	} else if (nodetype == 'Map') {
		title = "<?php echo $LNG->MAP_NAME; ?>";
	} else if (nodetype == 'Group') {
		title = "<?php echo $LNG->GROUP_NAME; ?>";
	}

	if (withColon) {
		title += ": ";
	}

	return title;
}

function getNodeIcon(nodetype, large) {
	var icon = '';
	if (nodetype) {
		if (large) {
			if (nodetype == 'Challenge') {
				icon = '<?php echo $CFG->challengeiconbig; ?>';
			} else if (nodetype == 'Issue') {
				icon = '<?php echo $CFG->issueiconbig; ?>';
			} else if (nodetype == 'Solution') {
				icon = '<?php echo $CFG->solutioniconbig; ?>';
			} else if (nodetype == 'Argument') {
				icon = '<?php echo $CFG->argumenticonbig; ?>';
			} else if (nodetype == 'Pro') {
				icon = '<?php echo $CFG->proiconbig; ?>';
			} else if (nodetype == 'Con') {
				icon = '<?php echo $CFG->coniconbig; ?>';
			} else if (nodetype == 'Resource') {
				icon = '<?php echo $CFG->resourceiconbig; ?>';
			} else if (nodetype == 'Comment') {
				icon = '<?php echo $CFG->commenticonbig; ?>';
			} else if (nodetype == 'Idea') {
				icon = '<?php echo $CFG->ideaiconbig; ?>';
			} else if (nodetype == 'Decision') {
				icon = '<?php echo $CFG->decisioniconbig; ?>';
			} else if (nodetype == 'Map') {
				icon = '<?php echo $CFG->mapiconbig; ?>';
			} else {
				icon = '<?php echo $CFG->ideaiconbig; ?>';
			}
		} else {
			if (nodetype == 'Challenge') {
				icon = '<?php echo $CFG->challengeicon; ?>';
			} else if (nodetype == 'Issue') {
				icon = '<?php echo $CFG->issueicon; ?>';
			} else if (nodetype == 'Solution') {
				icon = '<?php echo $CFG->solutionicon; ?>';
			} else if (nodetype == 'Argument') {
				icon = '<?php echo $CFG->argumenticon; ?>';
			} else if (nodetype == 'Pro') {
				icon = '<?php echo $CFG->proicon; ?>';
			} else if (nodetype == 'Con') {
				icon = '<?php echo $CFG->conicon; ?>';
			} else if (nodetype == 'Resource') {
				icon = '<?php echo $CFG->resourceicon; ?>';
			} else if (nodetype == 'Comment') {
				icon = '<?php echo $CFG->commenticon; ?>';
			} else if (nodetype == 'Idea') {
				icon = '<?php echo $CFG->ideaicon; ?>';
			} else if (nodetype == 'Decision') {
				icon = '<?php echo $CFG->decisionicon; ?>';
			} else if (nodetype == 'Map') {
				icon = '<?php echo $CFG->mapicon; ?>';
			} else {
				icon = '<?php echo $CFG->ideaicon; ?>';
			}
		}
	}
	return icon;
}

function creationdatenodesortasc(a, b) {
	var nameA=a.cnode.creationdate;
	var nameB=b.cnode.creationdate;
	if (nameA < nameB) {
		return -1;
	}
	if (nameA > nameB) {
		return 1;
	}
	return 0 ;
}

function creationdatenodesortdesc(a, b) {
	var nameA=a.cnode.creationdate;
	var nameB=b.cnode.creationdate;
	if (nameA > nameB) {
		return -1;
	}
	if (nameA < nameB) {
		return 1;
	}
	return 0 ;
}

function textAreaCancel() {
	$('prompttext').style.display = "none";
	$('prompttext').update("");
}

function textAreaPrompt(messageStr, text, connid, handler, refresher) {

	$('prompttext').innerHTML="";
	$('prompttext').style.width = "400px";
	$('prompttext').style.height = "300px";

	var viewportHeight = getWindowHeight();
	var viewportWidth = getWindowWidth();
	var x = (viewportWidth-400)/2;
	var y = (viewportHeight-200)/2;
	$('prompttext').style.left = x+getPageOffsetX()+"px";
	$('prompttext').style.top = y+getPageOffsetY()+"px";

	var textarea1 = new Element('textarea', {'id':'messagetextarea','rows':'10','style':'color: black; width:390px; border: 1px solid gray; padding: 3px; overflow:hidden'});
	textarea1.value=text;

    var buttonCancel = new Element('input', { 'style':'margin-left: 5px; margin-top: 5px; font-size: 8pt', 'type':'button', 'value':'<?php echo $LNG->FORM_BUTTON_CLOSE; ?>'});
	Event.observe(buttonCancel,'click', textAreaCancel);

	// To remove prototype - all needs to be re-written in plain javascript: e.g.
    //var buttonCancel = document.createElement("input");
    //buttonCancel.setAttribute('style', 'margin-left: 5px; margin-top: 5px; font-size: 8pt');
    //buttonCancel.setAttribute('type', 'button)';
    //buttonCancel.value = '<?php echo $LNG->FORM_BUTTON_CLOSE; ?>';
	//buttonCancel.addEventListener("click",  function() {
    //	textAreaCancel();
	//});

	$('prompttext').insert('<h2>'+messageStr+'</h2>');
	$('prompttext').insert(textarea1);
	if (connid != "") {
		$('prompttext').insert(buttonOK);
	}
	$('prompttext').insert(buttonCancel);
	$('prompttext').style.display = "block";
}

/**
 * Take the given json of user CIF data and extract the required user fname from any Agent objects.
 */
function loadUserUnobfuscationData(json) {
	var userdata = "";
	var userArray = {};
	if (json['@graph']) {
		userdata = json['@graph'];
		//alert(userdata.toSource());

		//make into hastable for easy reference later
		for(var i=0; i<userdata.length; i++) {
			var next = userdata[i];
			if (next['@type'] && next['@type'] == 'Agent') {
				userArray[next['@id']] = next;
			} else if (!next['@type'] && next['fname']) {
				userArray[next['@id']] = next;
			}
		}
	}
	return userArray;
}

/**
 * If the Global NODE_ARGS variable has a 'userdata' property extract the relevant data and add it to the given user object
 * @param user the user object to update with actual user details.
 */
function unobfuscateUser(user) {
	if (NODE_ARGS && NODE_ARGS['userdata'] && user.profileid) {
		var userdata = NODE_ARGS['userdata'];
		if (userdata && userdata != "" && userdata[user.profileid]) {
			var userdataitem = userdata[user.profileid];
			if (userdataitem['fname'] && userdataitem['fname'] != "") {
				user.name = userdataitem['fname'];
			}
			if (userdataitem['homepage'] && userdataitem['homepage'] != "") {
				user.homepage = userdataitem['homepage'];
			}
			if (userdataitem['description'] && userdataitem['description'] != "") {
				user.description = userdataitem['description'];
			}
			if (userdataitem['img'] && userdataitem['img'] != "") {
				user.photo = userdataitem['img']
			}
		}
	}
	return user;
}

/**
 * Post a message from the CIDashboard IFrame code to the parent page
 *
 * @param source the unique name of the visualisation posting the message
 * @param eventname click/moueover/mouseout
 * @param action collapse/expand/showinfo/hideinfo/collapseall/expandall (see docs fo up-to-date list)
 * @param tartgettype node/user/global
 * @param target CIF id of the node or user the message is about or just 'global'
 */
function postMessageToPage(source,eventname,action,targettype,target) {
	if (typeof top.postMessage != "undefined") {

		var message = '{';
		message += '"source":"' + source + '",';
		message += '"event":"' + eventname + '",';
		message += '"action":"' + action + '",';
		message += '"target_type":"' + targettype + '",';
		message += '"target":"' + target + '"';
		message += '}';

		top.postMessage(message,"*");
	}
}

/**
 * Add new new Script tag to the current HTML page dynamically to load a local javascript file on demand.
 *
 * @param url The url to add as the src on the new script tag
 * @param id If given set as the id of the new script tag
 */
function addScriptDynamically(url, id) {

	// only allow the import of local code;
	if (url.indexOf(URL_ROOT) == 0) {
		var headarea = document.getElementsByTagName("head").item(0);
		var scriptobj = document.createElement("script");
		scriptobj.setAttribute("type", "text/javascript");
		scriptobj.setAttribute("src", url);
		if (id) {
			scriptobj.setAttribute("id", id);
		}
		headarea.appendChild(scriptobj);
	}
}
