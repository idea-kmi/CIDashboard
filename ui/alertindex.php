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
 /** Author: Michelle Bachler, KMi, The Open University **/
?>

<script type='text/javascript'>

function initAlerts() {

	// check for already selected checkboxes - Firefox refresh
	var items = document.getElementsByName('alerts');
 	for (var i=0; i<items.length;i++) {
        var item = items[i];
        if (item.checked) {
        	$('alert-'+item.value).style.display = "inline";
        } else {
        	$('alert-'+item.value).style.display = "inline";
        }
    }

    // check language selection
	var radioimgs = document.getElementsByName('alertvislanguageimg');
	for (var i = 0; i < radioimgs.length; i++) {
		if (radioimgs[i].tagName.toLowerCase() == 'img') {
			radioimgs[i].border="0";
		} else {
			radioimgs[i].style.border = '1px solid transparent';
		}
	}

	var radios = document.getElementsByName('alertvislanguage');
	for (var i = 0; i < radios.length; i++) {
	    if (radios[i].checked) {
			if ($('alertvislanguageimg'+radios[i].value).tagName.toLowerCase() == 'img') {
	        	$('alertvislanguageimg'+radios[i].value).border="1";
	        } else {
	        	$('alertvislanguageimg'+radios[i].value).style.border = '1px solid black';
	        }
	    }
	}
}

function createAlertEmbedDemo(link, title, id) {
	var radios = document.getElementsByName('alertvislanguage');
	var value = "";
	for (var i = 0; i < radios.length; i++) {
	    if (radios[i].checked) {
	        value = radios[i].value;
	    }
	}
	var lang = "en";
	if (value != "") {
		lang = value;
	}

	width = 500;
	height = 300;

	var url = '<?php echo $CFG->homeAddress; ?>ui/demo.php?';
	url += 'lang='+encodeURIComponent(lang);
	url += '&title='+encodeURIComponent(title);
	url += '&url='+encodeURIComponent(link);
	url += '&width='+encodeURIComponent();
	url += '&height='+encodeURIComponent();
	window.open(url,'_blank');
}

function createAlertEmbedLink(stub, id) {
	var cifdataurl = ($('alertcifdataurl').value).trim();
	if (cifdataurl == "") {
		var cifdataurl = prompt("<?php echo $LNG->EMBED_INDEX_DATA_SOURCE_URL_ERROR; ?>", "<?php echo $LNG->EMBED_INDEX_DATA_SOURCE_URL_HINT; ?>");
		if (cifdataurl == null) {
			return;
		} else {
			$('alertcifdataurl').value = cifdataurl;
		}
	} else {
		if (!isValidURI(cifdataurl)) {
			alert("<?php echo $LNG->EMBED_INDEX_DATA_SOURCE_URL_VALID; ?>");
			$('alertcifdataurl').focus();
			return false;
		}
	}

	var alertcifuserurl = ($('alertcifuserurl').value).trim();
	var alertlangurl = ($('alertlangurl').value).trim();

	var radios = document.getElementsByName('alertvislanguage');
	var value = "";
	for (var i = 0; i < radios.length; i++) {
	    if (radios[i].checked) {
	        value = radios[i].value;
	    }
	}

	var alertitems = document.getElementsByName('alerts');
	var alerttypes = "";
	for (var i=0; i<alertitems.length;i++) {
		var alertitem = alertitems[i];
		if (alertitem.checked) {
			alerttypes = alerttypes+alertitem.value+",";
		}

	}
	alerttypes = alerttypes.substring(0, alerttypes.length-1);

	var lang = "en";
	if (value != "") {
		lang = value;
	}

	var userids = ($('alertusers').value).trim();
	var timeout = getAlertTimeOut();

	var link = stub+'userids='+encodeURIComponent(userids)+'&lang='+encodeURIComponent(lang)
					+'&url='+encodeURIComponent(cifdataurl)+'&userurl='+encodeURIComponent(alertcifuserurl)
					+'&langurl='+encodeURIComponent(alertlangurl)
					+'&timeout='+encodeURIComponent(timeout);
	if (id == 0) {
		link += '&alerts='+encodeURIComponent(alerttypes);
	}
	return link;
}

function createAlertEmbedPage(stub, title, id) {
	var url = createAlertEmbedLink(stub, id);
	if (url) {
		textAreaPrompt('<?php echo $LNG->EMBED_INDEX_PAGE_MESSAGE; ?>', url, "", "", "");
	}
}

function createAlertEmbedVisUrl(stub, id) {
	var url = createAlertEmbedLink(stub, id);
	width = 500;
	height = 300;
	var code = '<iframe src="'+url+'" width="'+width+'" height="'+height+'" style="overflow:auto" scrolling="auto" frameborder="0"></iframe>';
	if (code) {
		textAreaPrompt('<?php echo $LNG->EMBED_INDEX_CODE_MESSAGE; ?>', code, "", "", "");
	}
}

function createAlertEmbedVisPreview(stub, title, id) {
	var url = createAlertEmbedLink(stub, id);
	if (url) {
		width = 500;
		height = 300;
		var calllink = '<?php echo $CFG->homeAddress; ?>ui/alertpreview.php?';
		calllink += 'url='+encodeURIComponent(url);
		if ($('alertcifuserurl').value != "") {
			calllink += '&userurl='+encodeURIComponent($('alertcifuserurl').value);
		}
		if ($('alertlangurl').value != "") {
			calllink += '&langurl='+encodeURIComponent($('alertlangurl').value);
		}
		calllink += '&title='+encodeURIComponent(title);
		calllink += '&width='+encodeURIComponent(width);
		calllink += '&height='+encodeURIComponent(height);
		window.open(calllink,'_blank');
	}
}


function checkAlertLanguageVis(img) {
	var radioimgs = document.getElementsByName('alertvislanguageimg');
	for (var i = 0; i < radioimgs.length; i++) {
		if (radioimgs[i].tagName.toLowerCase() == 'img') {
			radioimgs[i].border="0";
		} else {
			radioimgs[i].style.border = '1px solid transparent';
		}
	}

	var radios = document.getElementsByName('alertvislanguage');
	for (var i = 0; i < radios.length; i++) {
	    if (radios[i].checked) {
			if ($(img).tagName.toLowerCase() == 'img') {
	        	$(img).border="1";
	        } else {
	        	$(img).style.border = '1px solid black';
	        }
	    }
	}
}

function updateAlertTimeOut(type,direction) {
	switch(type){
		case "h":
			var h=parseInt($('alerth1').value);
			if(direction =='up' && h < 24) { h=h+1; }
			if(direction =='down' && h >0){ h=h-1; }
			if(h >24){ h=24; }
			if(h <0) { h=0;	}
			h=h.toString();
			if(h.length < 2) { var h='0'+h; }
			$('alerth1').value = h;
			break;
		case "m":
			var m=parseInt($('alertm1').value);
			if(direction =='up' && m < 59) { m=m+1; }
			if(direction =='down' && m >0) { m=m-1; }
			if(m >59){ m=59; }
			if(m <0){ m=0; }
			m=m.toString();
			if(m.length < 2){ var m='0'+m; }
			$('alertm1').value = m;
			break;
		case "s":
			var s=parseInt($('alerts1').value);
			if(direction =='up' && s < 59){ s=s+1; }
			if(direction =='down' && s >0){ 	s=s-1;}
			if(s >59){ s=59; }
			if(s <0){ s=0; }
			s=s.toString();
			if(s.length < 2){ var s='0'+s; }
			$('alerts1').value = s;
		break;
	} // end of switch
}

function getAlertTimeOut(){
	var hours = parseInt(document.getElementById('alerth1').value);
	var minutes = parseInt(document.getElementById('alertm1').value);
	var seconds = parseInt(document.getElementById('alerts1').value);
	var timeout = seconds+(minutes*60)+(hours*60*60);
	return timeout;
}

</script>

<div style="clear:both;float:left;padding:10px;">
	<div id="tab-content-embed-alert-div" style="clear:both;float:left;width:100%;">

		<div style="float:left;">
		<a href="http://cci.mit.edu/klein/deliberatorium.html" target="_blank" title="http://cci.mit.edu/klein/deliberatorium.html">
		<img src="<?php echo $HUB_FLM->getImagePath('deliberatorium-analytics-logo.png'); ?>" style="vertical-align:middle;width:40px; height:40px;" border="0" />
		<span style="vertical-align:middle; font-size:12pt;font-style:italic;"><?php echo $LNG->EMBED_POWERED_BY_DELIBERATORIUM; ?></span>
		</a>
		</div>

		<div id="alertlanguagechoice" style="clear:both;float:left;margin-top:0px;margin-right:20px;"></div>
			<div style="float:left;margin-top:10px;"><label><?php echo $LNG->EMBED_INDEX_LANGUAGE_CHOICE;?></label></div>
			<div style="float:left;display: inline-block;vertical-align: middle;margin-left:5px;"><input <?php if ($CFG->language == 'en') {echo 'checked'; } ?> style="height:32px;float:left;" onchange="checkAlertLanguageVis('alertvislanguageimgen')" type="radio" value="en" name="alertvislanguage"><img id="alertvislanguageimgen" name="alertvislanguageimg" style="float:left;vertical-align:middle;padding-left:3px; padding-right:2px;" <?php if ($CFG->language == 'en') { echo 'border="1"'; } else { echo 'border="0"'; } ?> src="images/flags/UnitedKingdom.png" /></input></div>
			<div style="float:left;display: inline-block;vertical-align: middle;margin-left:5px;"><input <?php if ($CFG->language == 'de') {echo 'checked'; } ?> style="height:32px;float:left;" onchange="checkAlertLanguageVis('alertvislanguageimgde')" type="radio" value="de" name="alertvislanguage"><img id="alertvislanguageimgde" name="alertvislanguageimg" style="float:left;vertical-align:middle;padding-left:3px; padding-right:2px;" <?php if ($CFG->language == 'de') { echo 'border="1"'; } else { echo 'border="0"'; } ?> src="images/flags/Germany.png" /></input></div>
			<div style="float:left;display: inline-block;vertical-align: middle;margin-left:5px;"><input <?php if ($CFG->language == 'es') {echo 'checked'; } ?> style="height:32px;float:left;" onchange="checkAlertLanguageVis('alertvislanguageimges')" type="radio" value="es" name="alertvislanguage"><img id="alertvislanguageimges" name="alertvislanguageimg" style="float:left;vertical-align:middle;padding-left:3px; padding-right:2px;" <?php if ($CFG->language == 'es') { echo 'border="1"'; } else { echo 'border="0"'; } ?> src="images/flags/Spain.png" /></input></div>
			<div style="float:left;display: inline-block;vertical-align: middle;margin-left:5px;"><input <?php if ($CFG->language == 'pt') {echo 'checked'; } ?> style="height:32px;float:left;" onchange="checkAlertLanguageVis('alertvislanguageimgpt')" type="radio" value="pt" name="alertvislanguage">
			    <div id="alertvislanguageimgpt" name="alertvislanguageimg" style="height:32px;margin:0px;padding:0px;display:table-cell;float:left;padding-left:3px;" >
					<img style="padding-right:0px;" src="<?php echo $HUB_FLM->getImagePath('flags/Portugal.png'); ?>" />
					<img style="padding-left:0px; padding-right:2px;" src="<?php echo $HUB_FLM->getImagePath('flags/Brazil.png'); ?>" />
				</div>
			</input></div>
		</div>

		<div style="clear:both;float:left;margin-top:24px;">
			<label for="alertcifdataurl" style="float:left;width:150px"><?php echo $LNG->EMBED_INDEX_DATA_SOURCE_URL_LABEL; ?></label>
			<input id="alertcifdataurl" style="float:left;width:450px;" placeholder="<?php echo $LNG->EMBED_INDEX_DATA_SOURCE_URL_HINT; ?>" />
			<img title="<?php echo $LNG->EMBED_INDEX_USER_SOURCE_URL_HELP_HINT; ?>" src="<?php echo $HUB_FLM->getImagePath('info.png'); ?>" border="0" style="cursor:pointer;padding-left:5px;padding-top:3px;" onclick="toggleDiv('alertcifurlhelp')" />
			<div id="alertcifurlhelp" style="clear:both;float:left;display:none;margin-top:5px;padding:5px;"><?php echo $LNG->EMBED_INDEX_ALERT_MESSAGE; ?></div>
		</div>
		<div style="float:left;margin-left:20px;">
			<div style="float:left;margin-top:26px;"><label for="expiretime"><?php echo $LNG->EMBED_INDEX_DATA_SOURCE_REFRESH_LABEL; ?></label></div>
			<div style="float:left;">
				<table id="expiretime" style="width:190px;" border=0>
					<tr>
						<td width="33%"><span onclick="updateAlertTimeOut('h','up')"><img style="vertical-align:bottom;padding-left:2px;cursor:pointer;" src="<?php echo $HUB_FLM->getImagePath('uparrowbig.gif'); ?>" border='0'></a></td>
						<td width="33%"><span onclick="updateAlertTimeOut('m','up')"><img style="vertical-align:bottom;padding-left:2px;cursor:pointer;" src="<?php echo $HUB_FLM->getImagePath('uparrowbig.gif'); ?>" border='0'></a></td>
						<td width="33%"><span onclick="updateAlertTimeOut('s','up')"><img style="vertical-align:bottom;padding-left:2px;cursor:pointer;" src="<?php echo $HUB_FLM->getImagePath('uparrowbig.gif'); ?>" border='0'></a></td>
					</tr>
					<tr>
						<td width="33%"><input disabled type="text" style="width:15px" id="alerth1" name='alerth1' value="00"> hrs</td>
						<td width="33%"><input disabled type="text" style="width:15px" id="alertm1" name='alertm1' value="01"> mins</td>
						<td width="33%"><input disabled type="text" style="width:15px" id="alerts1" name='alerts1' value="00"> secs</td>
					</tr>
					<tr>
						<td width="33%"><span onclick="updateAlertTimeOut('h','down')"><img style="vertical-align:top;padding-left:3px;cursor:pointer;" src="<?php echo $HUB_FLM->getImagePath('downarrowbig.gif'); ?>" border='0'></a></td>
						<td width="33%"><span onclick="updateAlertTimeOut('m','down')"><img style="vertical-align:top;padding-left:3px;cursor:pointer;" src="<?php echo $HUB_FLM->getImagePath('downarrowbig.gif'); ?>" border='0'></a></td>
						<td width="33%"><span onclick="updateAlertTimeOut('s','down')"><img style="vertical-align:top;padding-left:3px;cursor:pointer;" src="<?php echo $HUB_FLM->getImagePath('downarrowbig.gif'); ?>" border='0'></a></td>
					</tr>
				</table>
			</div>
		</div>

		<div style="clear:both;float:left;">
			<label for="alertlangurl" style="float:left;width:150px;margin-top:4px;"><?php echo $LNG->EMBED_INDEX_LANG_URL_LABEL; ?></label>
			<input id="alertlangurl" style="float:left;width:450px;" placeholder="<?php echo $LNG->EMBED_INDEX_LANG_URL_HINT; ?>" />
			<img title="<?php echo $LNG->EMBED_INDEX_USER_SOURCE_URL_HELP_HINT; ?>" src="<?php echo $HUB_FLM->getImagePath('info.png'); ?>" border="0" style="cursor:pointer;padding-left:5px;padding-top:3px;" onclick="toggleDiv('alertlanghelp')" />
			<div id="alertlanghelp" style="clear:both;float:left;display:none;margin-top:5px;padding:5px;"><?php echo $LNG->EMBED_INDEX_LANG_URL_HELP; ?></div>
		</div>

		<div style="clear:both;float:left;margin-top:5px;">
			<label for="alertcifuserurl" style="float:left;width:150px"><?php echo $LNG->EMBED_INDEX_USER_SOURCE_URL_LABEL; ?></label>
			<input id="alertcifuserurl" style="float:left;width:450px;" placeholder="<?php echo $LNG->EMBED_INDEX_USER_SOURCE_URL_HINT; ?>" />
			<img title="<?php echo $LNG->EMBED_INDEX_USER_SOURCE_URL_HELP_HINT; ?>" src="<?php echo $HUB_FLM->getImagePath('info.png'); ?>" border="0" style="padding-left:5px;padding-top:3px;cursor:pointer;" onclick="toggleDiv('alertcifuserurlhelp')" />
			<div id="alertcifuserurlhelp" style="clear:both;float:left;display:none;margin-top:5px;padding:5px;"><?php echo $LNG->EMBED_INDEX_USER_SOURCE_URL_HELP; ?></div>
		</div>

		<!-- div style="clear:both;float:left;width:100%;margin-top:20px;">
			<h2 style="font-size:14pt;margin-bottom:0px;"><?php echo $LNG->EMBED_ALERT_VISUALISATIONS_TITLE ?></h2>
		</div -->

		<!-- div style="clear:both;float:left;margin:0px;padding:0px;margin-bottom:5px;"><?php echo $LNG->EMBED_INDEX_ALERT_MESSAGE2; ?></div -->

		<div style="float:left;margin-top:20px;">
		<?php
			include('ui/alertslist.php');
		?>
		</div>
	</div>
</div>
