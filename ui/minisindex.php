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

function loadMiniSortable() {
	nativesortable($('minisortabledashboard'), {
		change: function() {

		}
	});

	// check for already selected checkboxes - Firefox refresh
	var items = document.getElementsByName('minidashvises');
 	for (var i=0; i<items.length;i++) {
        var item = items[i];
        if (item.checked) {
        	$('minidash-'+item.value).style.display = "inline";
        } else {
        	$('minidash-'+item.value).style.display = "none";
        }
    }

    // check language selection
	var radioimgs = document.getElementsByName('minivislanguageimg');
	for (var i = 0; i < radioimgs.length; i++) {
		if (radioimgs[i].tagName.toLowerCase() == 'img') {
			radioimgs[i].border="0";
		} else {
			radioimgs[i].style.border = '1px solid transparent';
		}
	}

	var radios = document.getElementsByName('minivislanguage');
	for (var i = 0; i < radios.length; i++) {
	    if (radios[i].checked) {
			if ($('minivislanguageimg'+radios[i].value).tagName.toLowerCase() == 'img') {
	        	$('minivislanguageimg'+radios[i].value).border="1";
	        } else {
	        	$('minivislanguageimg'+radios[i].value).style.border = '1px solid black';
	        }
	    }
	}
}

function toggleMiniDashItem(obj, num) {
	if (obj.checked) {
		$('minidash-'+num).style.display = "inline";
	} else {
		$('minidash-'+num).style.display = "none";
	}
}

function createMiniEmbedDashboardLink() {
	var cifdataurl = ($('minicifdataurl').value).trim();
	if (cifdataurl == "") {
		var cifdataurl = prompt("<?php echo $LNG->EMBED_INDEX_DATA_SOURCE_URL_ERROR; ?>", "<?php echo $LNG->EMBED_INDEX_DATA_SOURCE_URL_HINT; ?>");
		if (cifdataurl == null) {
			return false;
		} else {
			$('minicifdataurl').value = cifdataurl;
		}
	} else {
		if (!isValidURI(cifdataurl)) {
			alert("<?php echo $LNG->EMBED_INDEX_DATA_SOURCE_URL_VALID; ?>");
			$('minicifdataurl').focus();
			return false;
		}
	}

	var items = document.getElementsByName('minidash')
	var list = "";
 	for (var i=0; i<items.length;i++) {
        var item = items[i];
        if (item.style.display == 'inline') {
			var bits = item.id.split('-');

			var appendnext = bits[1];
			if ($('miniwithposts'+bits[1])) {
				var withposts = $('miniwithposts'+bits[1]);
				if (withposts.checked) {
					appendnext = 'p'+appendnext;
				}
			}

	   		list = list+appendnext+",";
        }
    }
	list = list.substring(0, list.length-1);
	if (list.length == 0) {
		alert("<?php echo $LNG->EMBED_INDEX_DASH_VIS_ERROR; ?>");
		return false;
	}

	var alertitems = document.getElementsByName('alerts')
	var alerttypes = "";
 	for (var i=0; i<alertitems.length;i++) {
        var alertitem = alertitems[i];
		if (alertitem.checked) {
			alerttypes = alerttypes+alertitem.value+",";
		}

    }
	alerttypes = alerttypes.substring(0, alerttypes.length-1);

	var dashtitle = ($('minidashtitle').value).trim();
	var minilangurl = ($('minilangurl').value).trim();

	var radios = document.getElementsByName('minivislanguage');
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

	var timeout = getMiniTimeOut();

	var code = '<?php echo $CFG->homeAddress; ?>ui/minis/minidashboard.php?vis='+encodeURIComponent(list)+'&lang='+encodeURIComponent(lang)+'&title='+encodeURIComponent(dashtitle)+'&url='+encodeURIComponent(cifdataurl)+'&langurl='+encodeURIComponent(minilangurl)+'&timeout='+encodeURIComponent(timeout);
	if (list.indexOf(',7') != -1) { // if alerts selected add alert types list
		code += '&alerts='+encodeURIComponent(alerttypes);
	}
	return code;
}

function createMiniEmbedDashboardUrl() {
	var url = createMiniEmbedDashboardLink();
	var code = '<iframe src="'+url+'" width="1000" height="400"  style="overflow:auto" scrolling="auto" frameborder="1"></iframe>';
	if (code) {
		textAreaPrompt('<?php echo $LNG->EMBED_INDEX_CODE_MESSAGE; ?>', code, "", "", "");
	}
}

function createMiniEmbedDashboardPreview() {
	var url = createMiniEmbedDashboardLink();
	if (url) {
		window.open(url,'_blank');
	}
}

function createMiniEmbedDashboardPage() {
	var url = createMiniEmbedDashboardLink();
	if (url) {
		textAreaPrompt('<?php echo $LNG->EMBED_INDEX_DASH_PAGE_MESSAGE; ?>', url, "", "", "");
	}
}

function createMiniEmbedDemo(link, title, id) {
	var radios = document.getElementsByName('minivislanguage');
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

	width = 350;
	height = 220;
	var url = '<?php echo $CFG->homeAddress; ?>ui/demo.php?';
	url += 'lang='+encodeURIComponent(lang);
	url += '&title='+encodeURIComponent(title);
	url += '&url='+encodeURIComponent(link);
	url += '&width='+encodeURIComponent();
	url += '&height='+encodeURIComponent();
	window.open(url,'_blank');
}

function createMiniEmbedLink(stub, id) {
	var cifdataurl = ($('minicifdataurl').value).trim();
	if (cifdataurl == "") {
		var cifdataurl = prompt("<?php echo $LNG->EMBED_INDEX_DATA_SOURCE_URL_ERROR; ?>", "<?php echo $LNG->EMBED_INDEX_DATA_SOURCE_URL_HINT; ?>");
		if (cifdataurl == null) {
			return;
		} else {
			$('minicifdataurl').value = cifdataurl;
		}
	} else {
		if (!isValidURI(cifdataurl)) {
			alert("<?php echo $LNG->EMBED_INDEX_DATA_SOURCE_URL_VALID; ?>");
			$('minicifdataurl').focus();
			return false;
		}
	}

	var minilangurl = ($('minilangurl').value).trim();

	var radios = document.getElementsByName('minivislanguage');
	var value = "";
	for (var i = 0; i < radios.length; i++) {
	    if (radios[i].checked) {
	        value = radios[i].value;
	    }
	}

	var withposts = 'false';
	if ($('miniwithposts'+id)) {
		var withpostsobj = $('miniwithposts'+id);
		if (withpostsobj.checked) {
			withposts = 'true';
		}
	}

	if (id == 7) {
		var alertitems = document.getElementsByName('alerts')
		var alerttypes = "";
		for (var i=0; i<alertitems.length;i++) {
			var alertitem = alertitems[i];
			if (alertitem.checked) {
				alerttypes = alerttypes+alertitem.value+",";
			}

		}
		alerttypes = alerttypes.substring(0, alerttypes.length-1);
	}

	var lang = "en";
	if (value != "") {
		lang = value;
	}

	var timeout = getMiniTimeOut();

	var link = stub+'miniwithposts='+encodeURIComponent(withposts)+'&lang='+encodeURIComponent(lang)+'&url='+encodeURIComponent(cifdataurl)+'&langurl='+encodeURIComponent(minilangurl)+'&timeout='+encodeURIComponent(timeout);
	if (id == 7) {
		link += '&alerts='+encodeURIComponent(alerttypes);
	}
	return link;
}

function createMiniEmbedPage(stub, title, id) {
	var url = createMiniEmbedLink(stub, id);
	if (url) {
		textAreaPrompt('<?php echo $LNG->EMBED_INDEX_PAGE_MESSAGE; ?>', url, "", "", "");
	}
}

function createMiniEmbedVisUrl(stub, id) {
	var url = createMiniEmbedLink(stub, id);
	width = 350;
	height = 220;
	var code = '<iframe src="'+url+'" width="'+width+'" height="'+height+'" frameborder="0"></iframe>';
	if (code) {
		textAreaPrompt('<?php echo $LNG->EMBED_INDEX_CODE_MESSAGE; ?>', code, "", "", "");
	}
}

function createMiniEmbedVisPreview(stub, title, id) {
	var url = createMiniEmbedLink(stub, id);
	if (url) {
		width = 350;
		height = 220;
		var calllink = '<?php echo $CFG->homeAddress; ?>ui/minipreview.php?';
		calllink += 'url='+encodeURIComponent(url);
		calllink += '&title='+encodeURIComponent(title);
		calllink += '&width='+encodeURIComponent(width);
		calllink += '&height='+encodeURIComponent(height);
		window.open(calllink,'_blank');
	}
}


function checkMiniLanguageVis(img) {
	var radioimgs = document.getElementsByName('minivislanguageimg');
	for (var i = 0; i < radioimgs.length; i++) {
		if (radioimgs[i].tagName.toLowerCase() == 'img') {
			radioimgs[i].border="0";
		} else {
			radioimgs[i].style.border = '1px solid transparent';
		}
	}

	var radios = document.getElementsByName('minivislanguage');
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

function updateMiniTimeOut(type,direction) {
	switch(type){
		case "h":
			var h=parseInt($('minih1').value);
			if(direction =='up' && h < 24) { h=h+1; }
			if(direction =='down' && h >0){ h=h-1; }
			if(h >24){ h=24; }
			if(h <0) { h=0;	}
			h=h.toString();
			if(h.length < 2) { var h='0'+h; }
			$('minih1').value = h;
			break;
		case "m":
			var m=parseInt($('minim1').value);
			if(direction =='up' && m < 59) { m=m+1; }
			if(direction =='down' && m >0) { m=m-1; }
			if(m >59){ m=59; }
			if(m <0){ m=0; }
			m=m.toString();
			if(m.length < 2){ var m='0'+m; }
			$('minim1').value = m;
			break;
		case "s":
			var s=parseInt($('minis1').value);
			if(direction =='up' && s < 59){ s=s+1; }
			if(direction =='down' && s >0){ 	s=s-1;}
			if(s >59){ s=59; }
			if(s <0){ s=0; }
			s=s.toString();
			if(s.length < 2){ var s='0'+s; }
			$('minis1').value = s;
		break;
	} // end of switch
}

function getMiniTimeOut(){
	var hours = parseInt(document.getElementById('minih1').value);
	var minutes = parseInt(document.getElementById('minim1').value);
	var seconds = parseInt(document.getElementById('minis1').value);
	var timeout = seconds+(minutes*60)+(hours*60*60);
	return timeout;
}

</script>

<div style="clear:both;float:left;padding:10px;">
	<div style="clear:both;float:left;width:100%;">
		<div id="minilanguagechoice" style="clear:both;float:left;margin-top:0px;margin-right:20px;"></div>
			<div style="float:left;margin-top:10px;"><label><?php echo $LNG->EMBED_INDEX_LANGUAGE_CHOICE;?></label></div>
			<div style="float:left;display: inline-block;vertical-align: middle;margin-left:5px;"><input <?php if ($CFG->language == 'en') {echo 'checked'; } ?> style="height:32px;float:left;" onchange="checkMiniLanguageVis('minivislanguageimgen')" type="radio" value="en" name="minivislanguage"><img id="minivislanguageimgen" name="minivislanguageimg" style="float:left;vertical-align:middle;padding-left:3px; padding-right:2px;" <?php if ($CFG->language == 'en') { echo 'border="1"'; } else { echo 'border="0"'; } ?> src="images/flags/UnitedKingdom.png" /></input></div>
			<div style="float:left;display: inline-block;vertical-align: middle;margin-left:5px;"><input <?php if ($CFG->language == 'de') {echo 'checked'; } ?> style="height:32px;float:left;" onchange="checkMiniLanguageVis('minivislanguageimgde')" type="radio" value="de" name="minivislanguage"><img id="minivislanguageimgde" name="minivislanguageimg" style="float:left;vertical-align:middle;padding-left:3px; padding-right:2px;" <?php if ($CFG->language == 'de') { echo 'border="1"'; } else { echo 'border="0"'; } ?> src="images/flags/Germany.png" /></input></div>
			<div style="float:left;display: inline-block;vertical-align: middle;margin-left:5px;"><input <?php if ($CFG->language == 'es') {echo 'checked'; } ?> style="height:32px;float:left;" onchange="checkMiniLanguageVis('minivislanguageimges')" type="radio" value="es" name="minivislanguage"><img id="minivislanguageimges" name="minivislanguageimg" style="float:left;vertical-align:middle;padding-left:3px; padding-right:2px;" <?php if ($CFG->language == 'es') { echo 'border="1"'; } else { echo 'border="0"'; } ?> src="images/flags/Spain.png" /></input></div>
			<div style="float:left;display: inline-block;vertical-align: middle;margin-left:5px;"><input <?php if ($CFG->language == 'pt') {echo 'checked'; } ?> style="height:32px;float:left;" onchange="checkMiniLanguageVis('minivislanguageimgpt')" type="radio" value="pt" name="minivislanguage">
			    <div id="minivislanguageimgpt" name="minivislanguageimg" style="height:32px;margin:0px;padding:0px;display:table-cell;float:left;padding-left:3px; <?php if ($CFG->language == 'pt') { echo 'border:1px solid black;'; } else { echo 'border:1px solid transparent'; } ?>" >
					<img style="padding-right:0px;" src="<?php echo $HUB_FLM->getImagePath('flags/Portugal.png'); ?>" />
					<img style="padding-left:0px; padding-right:2px;" src="<?php echo $HUB_FLM->getImagePath('flags/Brazil.png'); ?>" />
				</div>
			</input></div>
		</div>

		<div style="float:left;margin-top:24px;">
			<label for="minicifdataurl" style="float:left;width:150px;margin-top:4px;"><?php echo $LNG->EMBED_INDEX_DATA_SOURCE_URL_LABEL; ?></label>
			<input id="minicifdataurl" style="float:left;width:450px;" placeholder="<?php echo $LNG->EMBED_INDEX_DATA_SOURCE_URL_HINT; ?>" />
			<img title="<?php echo $LNG->EMBED_INDEX_USER_SOURCE_URL_HELP_HINT; ?>" src="<?php echo $HUB_FLM->getImagePath('info.png'); ?>" border="0" style="cursor:pointer;padding-left:5px;padding-top:3px;" onclick="toggleDiv('minicifurlhelp')" />
			<div id="minicifurlhelp" style="clear:both;float:left;display:none;margin-top:5px;padding:5px;"><?php echo $LNG->EMBED_INDEX_MINI_MESSAGE; ?></div>
		</div>

		<div style="float:left;margin-left:20px;">
			<div style="float:left;margin-top:26px;"><label for="expiretime"><?php echo $LNG->EMBED_INDEX_DATA_SOURCE_REFRESH_LABEL; ?></label></div>
			<div style="float:left;">
				<table id="expiretime" style="width:190px;" border=0>
					<tr>
						<td width="33%"><span onclick="updateMiniTimeOut('h','up')"><img style="vertical-align:bottom;padding-left:2px;" src="<?php echo $HUB_FLM->getImagePath('uparrowbig.gif'); ?>" border='0'></a></td>
						<td width="33%"><span onclick="updateMiniTimeOut('m','up')"><img style="vertical-align:bottom;padding-left:2px;" src="<?php echo $HUB_FLM->getImagePath('uparrowbig.gif'); ?>" border='0'></a></td>
						<td width="33%"><span onclick="updateMiniTimeOut('s','up')"><img style="vertical-align:bottom;padding-left:2px;" src="<?php echo $HUB_FLM->getImagePath('uparrowbig.gif'); ?>" border='0'></a></td>
					</tr>
					<tr>
						<td width="33%"><input disabled type="text" style="width:15px" id="minih1" name='minih1' value="00"> hrs</td>
						<td width="33%"><input disabled type="text" style="width:15px" id="minim1" name='minim1' value="01"> mins</td>
						<td width="33%"><input disabled type="text" style="width:15px" id="minis1" name='minis1' value="00"> secs</td>
					</tr>
					<tr>
						<td width="33%"><span onclick="updateMiniTimeOut('h','down')"><img style="vertical-align:top;padding-left:3px;" src="<?php echo $HUB_FLM->getImagePath('downarrowbig.gif'); ?>" border='0'></a></td>
						<td width="33%"><span onclick="updateMiniTimeOut('m','down')"><img style="vertical-align:top;padding-left:3px;" src="<?php echo $HUB_FLM->getImagePath('downarrowbig.gif'); ?>" border='0'></a></td>
						<td width="33%"><span onclick="updateMiniTimeOut('s','down')"><img style="vertical-align:top;padding-left:3px;" src="<?php echo $HUB_FLM->getImagePath('downarrowbig.gif'); ?>" border='0'></a></td>
					</tr>
				</table>
			</div>
		</div>

		<div style="clear:both;float:left;;">
			<label for="minilangurl" style="float:left;width:150px;margin-top:4px;"><?php echo $LNG->EMBED_INDEX_LANG_URL_LABEL; ?></label>
			<input id="minilangurl" style="float:left;width:450px;" placeholder="<?php echo $LNG->EMBED_INDEX_LANG_URL_HINT; ?>" />
			<img title="<?php echo $LNG->EMBED_INDEX_USER_SOURCE_URL_HELP_HINT; ?>" src="<?php echo $HUB_FLM->getImagePath('info.png'); ?>" border="0" style="cursor:pointer;padding-left:5px;padding-top:3px;" onclick="toggleDiv('minilanghelp')" />
			<div id="minilanghelp" style="clear:both;float:left;display:none;margin-top:5px;padding:5px;"><?php echo $LNG->EMBED_INDEX_LANG_URL_HELP; ?></div>
		</div>

		<!-- div style="clear:both;float:left;width:100%;margin-top:20px;">
			<h2 style="font-size:14pt;margin-bottom:0px;"><?php echo $LNG->EMBED_MINI_VISUALISATIONS_TITLE ?></h2>
		</div>

		<div style="clear:both;float:left;margin:0px;padding:px;"><?php echo $LNG->EMBED_INDEX_MINI_MESSAGE2; ?></div -->

		<?php
			include('ui/minislist.php');
		?>
	</div>

	<div style="clear:both;float:left;width:100%;padding-top:10px;border-top:2px solid #E8E8E8;">
		<h2 style="padding:5px;font-size:14pt;"><?php echo $LNG->EMBED_MINI_DASHBOARD_TITLE ?></h2>
		<p><?php echo $LNG->EMBED_MINI_DASH_MESSAGE2; ?></p>

		<table style="border-collapsed:collapse;padding:0px; margin:0px;">
			<tr>
			<td><label for="minidashtitle"><?php echo $LNG->EMBED_INDEX_DASH_TITLE_LABEL; ?></label></td>
			<td><input id="minidashtitle" style="width:500px;" placeholder="<?php echo $LNG->EMBED_INDEX_DASH_TITLE_PLACEHOLDER; ?>" /></td>
			</tr>
		</table>

		<p><?php echo $LNG->EMBED_MINI_DASH_MESSAGE; ?></p>

		<h3><?php echo $LNG->EMBED_INDEX_DASH_CHOOSER_TITLE; ?><span style="font-size:9pt; padding-left:20px;">(<?php echo $LNG->EMBED_INDEX_DASH_CHOOSER_MESSAGE; ?>)</span></h3>
		<?php
			include('ui/minidashboardbuilder.php');
		?>

		<div style="font-size:12pt;clear:both;float:left;margin-top:15px;padding-bottom:30px;">
			<span class="active" title="<?php echo $LNG->EMBED_INDEX_CODE_HINT; ?>" onclick="createMiniEmbedDashboardUrl()" style="float:left;margin:0px;padding:0px;margin-right: 20px;">
			<?php echo $LNG->EMBED_INDEX_CODE_LINK; ?></span>

			<span class="active" title="<?php echo $LNG->EMBED_INDEX_PAGE_HINT; ?>" onclick="createMiniEmbedDashboardPage()" style="float:left;margin:0px;padding:0px;margin-right: 20px;">
			<?php echo $LNG->EMBED_INDEX_DASH_PAGE_LINK; ?></span>

			<span class="active" title="<?php echo $LNG->EMBED_INDEX_PREVIEW_HINT; ?>" onclick="createMiniEmbedDashboardPreview()" style="float:left;margin:0px;padding:0px;margin-right: 20px;">
			<?php echo $LNG->EMBED_INDEX_PREVIEW_LINK; ?></span>

			<a target="_blank" href="http://hubtesting.kmi.open.ac.uk/ui/dashboardmini/index.php?vis=1,2,3,4&title=<?php echo urlencode($LNG->EMBED_INDEX_DASH_EXAMPLE_TITLE); ?>&page=home&url=<?php echo urlencode('http://cidashboard.net/ui/test.json'); ?>" title="<?php echo $LNG->EMBED_INDEX_DEMO_HINT; ?>" style="float:left;margin:0px;padding:0px;margin-right: 20px;">
			<?php echo $LNG->EMBED_INDEX_DEMO_LINK; ?></a>
		</div>
	</div>
</div>
