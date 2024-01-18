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
header('Content-Type: text/javascript;');
require_once(__DIR__ . '/../config.php');

?>

/**
 * Render the given node.
 * Used for Activities, Multi connection Viewer, Stats pages etc. where the node is drawn as a Cohere style box.
 *
 * @param node the node object to render
 * @param uniQ is a unique id element prepended to the nodeid to form an overall unique id within the currently visible site elements
 * @param role the role object for this node
 * @param includemenu whether to include the drop-down menu
 * @param type defaults to 'active', but can be 'inactive' so nothing is clickable
 * 			or a specialized type for some of the popups
 */
function renderNodeFromLocalJSon(node, uniQ, role, includemenu, type) {

	if (type === undefined) {
		type = "active";
	}
	if (includemenu === undefined) {
		includemenu = true;
	}
	if(role === undefined){
		role = node.role[0];
	}
	var user = null;
	// JSON structure different if coming from popup where json_encode used.
	if (node.users[0].userid) {
		user = node.users[0];
	} else {
		user = node.users[0].user;
	}

	var breakout = "";

	//needs to check if embedded as a snippet
	if(top.location != self.location){
		breakout = " target='_blank'";
	}

	// used mostly for getting data from Audit history. So nodes repeated a lot.
	// creation date will be the same, but modification date will be different for each duplicated node in the Audit
	uniQ = node.modificationdate+node.nodeid + uniQ;

	var iDiv = new Element("div", {'class':'idea-container'});

	var ihDiv = new Element("div", {'class':'idea-header'});
	var itDiv = new Element("div", {'class':'idea-title'});

	var nodeTable = new Element( 'table' );
	nodeTable.className = "toConnectionsTable";
	nodeTable.width="100%";
	if (type == "connselect") {
		nodeTable.style.cursor = 'pointer';
		Event.observe(nodeTable,'click',function (){
			loadConnectionNode(node, role);
		});
	}

	var row = nodeTable.insertRow(-1);
	var leftCell = row.insertCell(-1);
	leftCell.vAlign="top";
	leftCell.align="left";
	var rightCell = row.insertCell(-1);
	rightCell.vAlign="top";
	rightCell.align="right";

	//get url for any saved image.

	//add left side with icon image and node text.
	var alttext = getNodeTitleAntecedence(role.name, false);
	if (node.imagethumbnail != null && node.imagethumbnail != "") {
		var originalurl = "";
		if(node.urls && node.urls.length > 0){
			for (var i=0 ; i< node.urls.length; i++){
				var urlid = node.urls[i].url.urlid;
				if (urlid == node.imageurlid) {
					originalurl = node.urls[i].url.url;
					break;
				}
			}
		}
		if (originalurl == "") {
			originalurl = node.imagethumbnail;
		}
		var iconlink = new Element('a', {
			'href':originalurl,
			'title':'<?php echo $LNG->NODE_TYPE_ICON_HINT; ?>', 'target': '_blank' });
 		var nodeicon = new Element('img',{'alt':'<?php echo $LNG->NODE_TYPE_ICON_HINT; ?>', 'style':'padding-right:5px;','align':'left', 'border':'0','src': URL_ROOT + node.imagethumbnail});
 		iconlink.insert(nodeicon);
 		itDiv.insert(iconlink);
 		itDiv.insert(alttext+": ");
	} else if (role.image != null && role.image != "") {
 		var nodeicon = new Element('img',{'alt':alttext, 'title':alttext, 'style':'padding-right:5px;','align':'left', 'border':'0','src': URL_ROOT + role.image});
		itDiv.insert(nodeicon);
	} else {
 		itDiv.insert(alttext+": ");
	}

	itDiv.insert("<span>"+node.name+"</span>");
	leftCell.insert(itDiv);

	// Add right side with user image and date below
	var iuDiv = new Element("div", {'class':'idea-user'});

	if (user.photo && user.photo != "") {
		if (user.homepage) {
			var exploreUser = new Element("a", {} );
			exploreUser.href= user.homepage;
			exploreUser.target = '_blank';
			var userimageThumb = new Element('img',{'alt':user.name, 'height':'30', 'title': user.name+" - "+'<?php echo $LNG->USER_EXPLORE_BUTTON_HINT; ?>', 'style':'padding-right:5px;','align':'right', 'border':'0','src': user.photo});
			exploreUser.insert(userimageThumb);
			iuDiv.insert(exploreUser);
		} else {
			var userimageThumb = new Element('img',{'alt':user.name, 'height':'30', 'title': user.name, 'style':'padding-right:5px;','align':'right', 'border':'0','src': user.photo});
			iuDiv.insert(userimageThumb);
		}
	} else {
		if (user.homepage) {
			var exploreUser = new Element("a", {} );
			exploreUser.href= user.homepage;
			exploreUser.target = '_blank';
			var userimageThumb = new Element('img',{'alt':user.name, 'title': user.name+" - "+'<?php echo $LNG->USER_EXPLORE_BUTTON_HINT; ?>', 'style':'padding-right:5px;','align':'right', 'border':'0','src': user.thumb});
			exploreUser.insert(userimageThumb);
			iuDiv.insert(exploreUser);
		} else {
			var userimageThumb = new Element('img',{'alt':user.name, 'title': user.name, 'style':'padding-right:5px;','align':'right', 'border':'0','src': user.thumb});
			iuDiv.insert(userimageThumb);
		}
	}

	var modDate = new Date(node.creationdate*1000);
	if (modDate) {
		var fomatedDate = modDate.format(DATE_FORMAT);
		iuDiv.insert("<div style='clear: both;'>"+fomatedDate+"</span>");
	}

	rightCell.insert(iuDiv);
	ihDiv.insert(nodeTable);

	var iwDiv = new Element("div", {'class':'idea-wrapper'});
	var imDiv = new Element("div", {'class':'idea-main'});
	var idDiv = new Element("div");
	var headerDiv = new Element("div", {'class':'idea-menus', 'style':'width: 100%'});
	idDiv.insert(headerDiv);

	if (node.homepage && node.homepage != "") {
		var exploreButton = new Element("a", {'title':'<?php echo $LNG->NODE_EXPLORE_BUTTON_HINT; ?>'} );
		exploreButton.insert("<?php echo $LNG->NODE_EXPLORE_BUTTON_TEXT;?>");
		exploreButton.href= node.homepage;
		exploreButton.target = '_blank';
		headerDiv.insert(exploreButton);
	}

	imDiv.insert(idDiv);
	iwDiv.insert(imDiv);
	iwDiv.insert('<div style="clear:both;"></div>');

	iDiv.insert(ihDiv);
	iDiv.insert('<div style="clear:both;"></div>');
	iDiv.insert(iwDiv);

	return iDiv;
}