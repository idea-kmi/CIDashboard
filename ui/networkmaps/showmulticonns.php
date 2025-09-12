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
    include_once("../../config.php");

    include_once($HUB_FLM->getCodeDirPath("ui/headerdialog.php"));
?>

<script type="text/javascript">
//<![CDATA[
	var LINKTYPELABEL_CUTOFF = 18;
	var connections = "";

	/**
	 * Display a list of connections with no numbers and checkboxes
	 */
	function displayMultipleConnectionsArray(objDiv,conns, start, direction, includemenu, type){

		var lOL = new Element("ol", {'start':start, 'class':'conn-list-ol'});
		for(var i=0; i< conns.length; i++){

			var iUL = new Element("li", {'id':conns[i].connid, 'class':'conn-list-li'});
			lOL.insert(iUL);
			var cWrap = new Element("div", {'class':'conn-li-wrapper'});
			var blobDiv = new Element("div", {'class':'conn-blob-sm'});
			var blobConn =  renderConnection(conns[i], "conn-list"+i+start, includemenu, type);
			blobDiv.insert(blobConn);
			cWrap.insert(blobDiv);
			iUL.insert(cWrap);
		}
		objDiv.insert(lOL);
	}

	function renderConnection(connection,uniQ, includemenu, type){

		if (includemenu === undefined) {
			includemenu = false;
		}

		uniQ = connection.connid + uniQ;
		var connDiv = new Element("div",{'class': 'connection'});

		var fromDiv = new Element("div",{'class': 'fromidea-horiz'});

		var from = connection.from[0].cnode;
		var fromrole = connection.fromrole[0].role;
		var to = connection.to[0].cnode;
		var torole = connection.torole[0].role;

		var fromNode = renderNodeFromLocalJSon(from,'conn-from-idea'+uniQ, fromrole, includemenu, type);
		fromDiv.insert(fromNode).insert('<div style="clear:both;"></div>');
		connDiv.insert(fromDiv);

		var linktypelabelfull = ""
		if (connection.linklabelname) {
			linktypelabelfull = connection.linklabelname;
		} else {
			linktypelabelfull = connection.linktype[0].linktype.label;
		}

		var linktypelabel = getLinkLabelName(fromrole.name, torole.name, linktypelabelfull)
		if (linktypelabelfull.length > LINKTYPELABEL_CUTOFF) {
			linktypelabel = linktypelabelfull.substring(0,LINKTYPELABEL_CUTOFF)+"...";
		}

		var group = 'neutral';
		if (linktypelabelfull == "<?php echo $CFG->LINK_PRO_SOLUTION; ?>") {
			group = 'positive'
		} else if (linktypelabelfull == "<?php echo $CFG->LINK_CON_SOLUTION; ?>") {
			group = 'negative'
		}

		var linkDiv = new Element("div",{'class': 'connlink-horiz-slim','id': 'connlink'+connection.connid});
		linkDiv.setStyle('background-image: url("'+URL_ROOT +'images/conn-'+group+'-slim3.png")');
		var ltDiv = new Element("div",{'class': 'conn-link-text'});
		linkDiv.insert(ltDiv);

		var ltWrap = new Element("div",{'class': 'link-type-wrapper'});
		ltDiv.insert(ltWrap);

		var ltText = new Element("div",{'class':'link-type-text'}).insert(linktypelabel);
		if (linktypelabelfull.length > LINKTYPELABEL_CUTOFF) {
			ltText.title = linktypelabelfull;
		}
		ltWrap.insert(ltText);
		// set colour of ltText

		if (linktypelabelfull == "<?php echo $CFG->LINK_PRO_SOLUTION; ?>") {
			ltText.setStyle({"color":"#00BD53"});
		} else if (linktypelabelfull == "<?php echo $CFG->LINK_CON_SOLUTION; ?>") {
			ltText.setStyle({"color":"#C10031"});
		} else {
			ltText.setStyle({"color":"#B2B2B2"});
		}

		/*if (connection.linktype[0].linktype.grouplabel.toLowerCase() == "positive"){
			ltText.setStyle({"color":"#00BD53"});
		} else if (connection.linktype[0].linktype.grouplabel.toLowerCase() == "negative"){
			ltText.setStyle({"color":"#C10031"});
		} else if (connection.linktype[0].linktype.grouplabel.toLowerCase() == "neutral"){
			ltText.setStyle({"color":"#B2B2B2"});
		}*/

		ltText.style.width="154px";

		var iuDiv = new Element("div");
		iuDiv.style.marginLeft='90px';
		iuDiv.style.marginTop="3px";

		/*if (connectionids != "") {
			var imagelink = new Element('a', {
				'href':URL_ROOT+"user.php?userid="+connection.users[0].user.userid,
				'title':connection.users[0].user.name});
			imagelink.target = "_blank";
			var userimageThumb = new Element('img',{'title': connection.users[0].user.name, 'style':'padding-right:5px;','border':'0','src': connection.users[0].user.thumb});
			imagelink.insert(userimageThumb);
			iuDiv.insert(imagelink);
		}*/

		linkDiv.insert(iuDiv);

		connDiv.insert(linkDiv);

		var toDiv = new Element("div",{'class': 'toidea-horiz'});
		var toNode = renderNodeFromLocalJSon(to,'conn-to-idea'+uniQ, torole, includemenu, type);
		toDiv.insert(toNode).insert('<div style="clear:both;"></div>');
		connDiv.insert(toDiv);

		return connDiv;
	}

	function getConnections(){
		if (window.opener.getLastConnections) {
			connections = window.opener.getLastConnections();
			if (connections != "" && connections.length > 0){
				$("connectiondetails").innerHTML = "";
				displayMultipleConnectionsArray($('connectiondetails'), connections, 1, 'right', false, 'inactive')
			}
		} else {
			$("connectiondetails").innerHTML = "<p><h3><?php echo $LNG->SOCIAL_MULTI_CONNECTIONS_ERROR; ?></h3></p>";
		}
   }

    /**
     *  set which tab to show and load first
     */
    Event.observe(window, 'load', function() {
        getConnections();

    });
//]]>
</script>
<div id="connectiondetails">
</div>

<?php
    include_once($HUB_FLM->getCodeDirPath("ui/footerdialog.php"));
?>