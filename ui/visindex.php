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

var defaultwidth=1000;
var defaultheight=1000;

var defaultedgesensewidth=600;
var defaultedgesenseheight = 1000;
var defaultedgesenseheightsm=650;

function loadSortable() {
	nativesortable($('sortabledashboard'), {
		change: function() {
		}
	});

	// check for already selected checkboxes - Firefox refresh
	var items = document.getElementsByName('dashvises');
	var someon = false;
 	for (var i=0; i<items.length;i++) {
        var item = items[i];
        if (item.checked) {
        	someon = true;
        	$('visdash-'+item.value).style.display = "inline";
        } else {
        	$('visdash-'+item.value).style.display = "none";
        }
    }

    if (!someon) {
    	$('visdashhelp').style.display = 'block';
    } else {
    	$('visdashhelp').style.display = 'none';
    }

	var networkonly = document.getElementsByName('networkonly');
 	for (var i=0; i<networkonly.length;i++) {
        var networkonlyitem = networkonly[i];
        if (networkonlyitem.checked) {
        	networkonlyitem.click();
        	networkonlyitem.click();
        }
    }

    // check language selection
	var radioimgs = document.getElementsByName('vislanguageimg');
	for (var i = 0; i < radioimgs.length; i++) {
		if (radioimgs[i].tagName.toLowerCase() == 'img') {
			radioimgs[i].border="0";
		} else {
			radioimgs[i].style.border = '1px solid transparent';
		}
	}

	var radios = document.getElementsByName('vislanguage');
	for (var i = 0; i < radios.length; i++) {
	    if (radios[i].checked) {
			if ($('vislanguageimg'+radios[i].value).tagName.toLowerCase() == 'img') {
	        	$('vislanguageimg'+radios[i].value).border="1";
	        } else {
	        	$('vislanguageimg'+radios[i].value).style.border = '1px solid black';
	        }
	    }
	}
}

function toggleDashItem(obj, num) {
	if (obj.checked) {
		$('visdash-'+num).style.display = "inline";
	} else {
		$('visdash-'+num).style.display = "none";
	}
}

function createEmbedDashboardLink() {
	var cifdataurl = ($('cifdataurl').value).trim();
	if (cifdataurl == "") {
		var cifdataurl = prompt("<?php echo $LNG->EMBED_INDEX_DATA_SOURCE_URL_ERROR; ?>", "<?php echo $LNG->EMBED_INDEX_DATA_SOURCE_URL_HINT; ?>");
		if (cifdataurl == null) {
			return false;
		} else {
			$('cifdataurl').value = cifdataurl;
		}
	} else {
		if (!isValidURI(cifdataurl)) {
			alert("<?php echo $LNG->EMBED_INDEX_DATA_SOURCE_URL_VALID; ?>");
			$('cifdataurl').focus();
			return false;
		}
	}

	var cifuserurl = ($('cifuserurl').value).trim();
	var langurl = ($('langurl').value).trim();

	var items = document.getElementsByName('visdash')
	var list = "";
 	for (var i=0; i<items.length;i++) {
        var item = items[i];
        if (item.style.display == 'inline') {
			var bits = item.id.split('-');

			var appendnext = bits[1];
			if ($('withposts'+bits[1])) {
				var withposts = $('withposts'+bits[1]);
				if (withposts.checked) {
					appendnext = 'p'+appendnext;
				}
			}

			if ($('networkonly'+bits[1])) {
				var networkonly = $('networkonly'+bits[1]);
				if (networkonly.checked) {
					appendnext = 'c'+appendnext;
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

	var dashtitle = ($('dashtitle').value).trim();
	//if (dashtitle == "") {
	//	dashtitle = cifdataurl;
	//}

	var radios = document.getElementsByName('vislanguage');
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

	var timeout = getTimeOut();

	var code = '<?php echo $CFG->homeAddress; ?>ui/visualisations/index.php?width='+defaultwidth+'&height='+defaultheight+'&vis='+encodeURIComponent(list)+'&lang='+encodeURIComponent(lang)+'&title='+encodeURIComponent(dashtitle)+'&url='+encodeURIComponent(cifdataurl)+'&userurl='+encodeURIComponent(cifuserurl)+'&langurl='+encodeURIComponent(langurl)+'&timeout='+encodeURIComponent(timeout);
	return code;
}

function createEmbedDashboardUrl() {
	var url = createEmbedDashboardLink();
	var code = '<iframe src="'+url+'" width="'+defaultwidth+'" height="'+defaultheight+'"  style="overflow:auto" scrolling="auto" frameborder="1"></iframe>';
	if (code) {
		textAreaPrompt('<?php echo $LNG->EMBED_INDEX_CODE_MESSAGE; ?>', code, "", "", "");
	}
}

function createEmbedDashboardPreview() {
	var url = createEmbedDashboardLink();
	if (url) {
		window.open(url,'_blank');
	}
}

function createEmbedDashboardPage() {
	var url = createEmbedDashboardLink();
	if (url) {
		textAreaPrompt('<?php echo $LNG->EMBED_INDEX_DASH_PAGE_MESSAGE; ?>', url, "", "", "");
	}
}

function createEmbedDemo(link, title) {
	var radios = document.getElementsByName('vislanguage');
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

	var url = '<?php echo $CFG->homeAddress; ?>ui/demo.php?';
	url += 'lang='+encodeURIComponent(lang);
	url += '&title='+encodeURIComponent(title);
	url += '&url='+encodeURIComponent(link);
	window.open(url,'_blank');
}

function createEmbedLink(stub, id) {
	var cifdataurl = ($('cifdataurl').value).trim();
	if (cifdataurl == "") {
		var cifdataurl = prompt("<?php echo $LNG->EMBED_INDEX_DATA_SOURCE_URL_ERROR; ?>", "<?php echo $LNG->EMBED_INDEX_DATA_SOURCE_URL_HINT; ?>");
		if (cifdataurl == null) {
			return;
		} else {
			$('cifdataurl').value = cifdataurl;
		}
	} else {
		if (!isValidURI(cifdataurl)) {
			alert("<?php echo $LNG->EMBED_INDEX_DATA_SOURCE_URL_VALID; ?>");
			$('cifdataurl').focus();
			return false;
		}
	}

	var cifuserurl = ($('cifuserurl').value).trim();
	var langurl = ($('langurl').value).trim();

	var radios = document.getElementsByName('vislanguage');
	var value = "";
	for (var i = 0; i < radios.length; i++) {
	    if (radios[i].checked) {
	        value = radios[i].value;
	    }
	}

	var withposts = 'false';
	if ($('withposts'+id)) {
		var withpostsobj = $('withposts'+id);
		if (withpostsobj.checked) {
			withposts = 'true';
		}
	}

	var lang = "en";
	if (value != "") {
		lang = value;
	}

	var timeout = getTimeOut();

	var link = "";

	if (id == 13) { //edgesense is different
		var networkonly = 'false';
		if ($('networkonly'+id)) {
			var networkonlyobj = $('networkonly'+id);
			if (networkonlyobj.checked) {
				networkonly = 'true';
			}
		}

		if (networkonly == 'true') {
			link = stub+'&networkonly='+networkonly+'width='+defaultedgesensewidth+'&height='+defaultedgesenseheightsm+'&url='+encodeURIComponent(cifdataurl)+'&userurl='+encodeURIComponent(cifuserurl);
		} else {
			link = stub+'width='+defaultedgesensewidth+'&height='+defaultheight+'&url='+encodeURIComponent(cifdataurl)+'&userurl='+encodeURIComponent(cifuserurl);
		}
	} else {
		link = stub+'width='+defaultwidth+'&height='+defaultheight+'&withposts='+encodeURIComponent(withposts)+'&lang='+encodeURIComponent(lang)+'&url='+encodeURIComponent(cifdataurl)+'&userurl='+encodeURIComponent(cifuserurl)+'&langurl='+encodeURIComponent(langurl)+'&timeout='+encodeURIComponent(timeout);
	}
	return link;
}

function changeedgesenseimage(id, imgsrc) {
		if ($('networkonly'+id)) {
			var networkonlyobj = $('networkonly'+id);
			var img = $('largevisimage'+id);
			if (networkonlyobj.checked) {
				img.src = imgsrc.replace('-sm','-mini');
				$('dashimg'+id).src = imgsrc.replace('-sm','-mini');
			} else {
				img.src = imgsrc;
				$('dashimg'+id).src = imgsrc;
			}
		}

}

function createEmbedPage(stub, id) {
	var url = createEmbedLink(stub, id);
	if (url) {
		textAreaPrompt('<?php echo $LNG->EMBED_INDEX_PAGE_MESSAGE; ?>', url, "", "", "");
	}
}

function createEmbedVisUrl(stub, id) {
	var url = createEmbedLink(stub, id);
	var code = '<iframe src="'+url+'" width="'+defaultwidth+'" height="'+defaultheight+'" style="overflow:auto" scrolling="auto" frameborder="1"></iframe>';
	if (id == 13) { //edgesense is different
		var networkonly = false;
		if ($('networkonly'+id)) {
			var networkonlyobj = $('networkonly'+id);
			if (networkonlyobj.checked) {
				networkonly = true;
			}
		}
		if (networkonly) {
			code = '<iframe src="'+url+'" width="'+defaultedgesensewidth+'" height="'+defaultedgesenseheightsm+'" style="overflow:auto" scrolling="auto" frameborder="1"></iframe>';
		} else {
			code = '<iframe src="'+url+'" width="'+defaultedgesensewidth+'" height="'+defaultedgesenseheight+'" style="overflow:auto" scrolling="auto" frameborder="1"></iframe>';
		}
	}
	if (code) {
		textAreaPrompt('<?php echo $LNG->EMBED_INDEX_CODE_MESSAGE; ?>', code, "", "", "");
	}
}

function createEmbedVisPreview(stub, title, id) {
	var url = createEmbedLink(stub, id);
	if (url) {
		var calllink = '<?php echo $CFG->homeAddress; ?>ui/preview.php?';
		if (id == 13) { //edgesense is different
			calllink += 'height='+defaultheight;
			calllink += '&width=600';
		} else {
			calllink += 'height='+defaultheight;
			calllink += '&width='+defaultwidth;
		}
		if ($('langurl').value != "") {
			calllink += '&langurl='+encodeURIComponent($('langurl').value);
		}
		calllink += '&url='+encodeURIComponent(url);
		calllink += '&title='+encodeURIComponent(title);
		window.open(calllink,'_blank');
	}
}

function checkLanguageVis(img) {
	var radioimgs = document.getElementsByName('vislanguageimg');
	for (var i = 0; i < radioimgs.length; i++) {
		if (radioimgs[i].tagName.toLowerCase() == 'img') {
			radioimgs[i].border="0";
		} else {
			radioimgs[i].style.border = '1px solid transparent';
		}
	}

	var radios = document.getElementsByName('vislanguage');
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

function updateTimeOut(type,direction) {
	switch(type){
		case "h":
			var h=parseInt(document.getElementById('vish1').value);
			if(direction =='up' && h < 24) { h=h+1; }
			if(direction =='down' && h >0){ h=h-1; }
			if(h >24){ h=24; }
			if(h <0) { h=0;	}
			h=h.toString();
			if(h.length < 2) { var h='0'+h; }
			document.getElementById('vish1').value = h;
			break;
		case "m":
			var m=parseInt(document.getElementById('vism1').value);
			if(direction =='up' && m < 59) { m=m+1; }
			if(direction =='down' && m >0) { m=m-1; }
			if(m >59){ m=59; }
			if(m <0){ m=0; }
			m=m.toString();
			if(m.length < 2){ var m='0'+m; }
			document.getElementById('vism1').value = m;
			break;
		case "s":
			var s=parseInt(document.getElementById('viss1').value);
			if(direction =='up' && s < 59){ s=s+1; }
			if(direction =='down' && s >0){ 	s=s-1;}
			if(s >59){ s=59; }
			if(s <0){ s=0; }
			s=s.toString();
			if(s.length < 2){ var s='0'+s; }
			document.getElementById('viss1').value = s;
		break;
	} // end of switch
}

function getTimeOut(){
	var hours = parseInt(document.getElementById('vish1').value);
	var minutes = parseInt(document.getElementById('vism1').value);
	var seconds = parseInt(document.getElementById('viss1').value);
	var timeout = seconds+(minutes*60)+(hours*60*60);
	return timeout;
}

</script>

<div style="clear:both;float:left;padding:10px;">
	<div id="tab-content-embed-viz-div" style="clear:both;float:left;width:100%;">
		<div id="languagechoice" style="clear:both;float:left;margin-top:0px;margin-right:20px;"></div>
			<div style="float:left;margin-top:10px;"><label><?php echo $LNG->EMBED_INDEX_LANGUAGE_CHOICE;?></label></div>
			<div style="float:left;display: inline-block;vertical-align: middle;margin-left:5px;"><input <?php if ($CFG->language == 'en') {echo 'checked'; } ?> style="height:32px;float:left;" onchange="checkLanguageVis('vislanguageimgen')" type="radio" value="en" name="vislanguage"><img id="vislanguageimgen" name="vislanguageimg" style="float:left;vertical-align:middle;padding-left:3px; padding-right:2px;" <?php if ($CFG->language == 'en') { echo 'border="1"'; } else { echo 'border="0"'; } ?> src="images/flags/UnitedKingdom.png" /></input></div>
			<div style="float:left;display: inline-block;vertical-align: middle;margin-left:5px;"><input <?php if ($CFG->language == 'de') {echo 'checked'; } ?> style="height:32px;float:left;" onchange="checkLanguageVis('vislanguageimgde')" type="radio" value="de" name="vislanguage"><img id="vislanguageimgde" name="vislanguageimg" style="float:left;vertical-align:middle;padding-left:3px; padding-right:2px;" <?php if ($CFG->language == 'de') { echo 'border="1"'; } else { echo 'border="0"'; } ?> src="images/flags/Germany.png" /></input></div>
			<div style="float:left;display: inline-block;vertical-align: middle;margin-left:5px;"><input <?php if ($CFG->language == 'es') {echo 'checked'; } ?> style="height:32px;float:left;" onchange="checkLanguageVis('vislanguageimges')" type="radio" value="es" name="vislanguage"><img id="vislanguageimges" name="vislanguageimg" style="float:left;vertical-align:middle;padding-left:3px; padding-right:2px;" <?php if ($CFG->language == 'es') { echo 'border="1"'; } else { echo 'border="0"'; } ?> src="images/flags/Spain.png" /></input></div>
			<div style="float:left;display: inline-block;vertical-align: middle;margin-left:5px;"><input <?php if ($CFG->language == 'pt') {echo 'checked'; } ?> style="height:32px;float:left;" onchange="checkLanguageVis('vislanguageimgpt')" type="radio" value="pt" name="vislanguage">
			    <div id="vislanguageimgpt" name="vislanguageimg" style="height:32px;margin:0px;padding:0px;display:table-cell;float:left;padding-left:3px; <?php if ($CFG->language == 'pt') { echo 'border:1px solid black;'; } else { echo 'border:1px solid transparent'; } ?>" >
					<img style="padding-right:0px;" src="<?php echo $HUB_FLM->getImagePath('flags/Portugal.png'); ?>" />
					<img style="padding-left:0px; padding-right:2px;" src="<?php echo $HUB_FLM->getImagePath('flags/Brazil.png'); ?>" />
				</div>
			</input></div>
		</div>

		<div style="clear:both;float:left;margin-top:24px;">
			<label for="cifdataurl" style="float:left;width:150px;margin-top:4px;"><?php echo $LNG->EMBED_INDEX_DATA_SOURCE_URL_LABEL; ?></label>
			<input id="cifdataurl" style="width:450px;" placeholder="<?php echo $LNG->EMBED_INDEX_DATA_SOURCE_URL_HINT; ?>" />
			<img title="<?php echo $LNG->EMBED_INDEX_USER_SOURCE_URL_HELP_HINT; ?>" src="<?php echo $HUB_FLM->getImagePath('info.png'); ?>" border="0" style="cursor:pointer;padding-left:5px;padding-top:3px;" onclick="toggleDiv('cifurlhelp')" />
			<div id="cifurlhelp" style="clear:both;float:left;display:none;margin-top:5px;background-color:#F4F5F7;padding:5px;"><?php echo $LNG->EMBED_INDEX_VIS_MESSAGE; ?></div>
		</div>

		<div style="float:left;margin-left:20px;">
			<div style="float:left;margin-top:26px;"><label for="expiretime"><?php echo $LNG->EMBED_INDEX_DATA_SOURCE_REFRESH_LABEL; ?></label></div>
			<div style="float:left;">
				<table id="expiretime" style="width:190px;" border=0>
					<tr>
						<td width="33%"><span onclick="updateTimeOut('h','up')"><img style="vertical-align:bottom;padding-left:2px;cursor:pointer;" src="<?php echo $HUB_FLM->getImagePath('uparrowbig.gif'); ?>" border='0'></a></td>
						<td width="33%"><span onclick="updateTimeOut('m','up')"><img style="vertical-align:bottom;padding-left:2px;cursor:pointer;" src="<?php echo $HUB_FLM->getImagePath('uparrowbig.gif'); ?>" border='0'></a></td>
						<td width="33%"><span onclick="updateTimeOut('s','up')"><img style="vertical-align:bottom;padding-left:2px;cursor:pointer;" src="<?php echo $HUB_FLM->getImagePath('uparrowbig.gif'); ?>" border='0'></a></td>
					</tr>
					<tr>
						<td width="33%"><input disabled type="text" style="width:15px" id="vish1" name='h1' value="00"> hrs</td>
						<td width="33%"><input disabled type="text" style="width:15px" id="vism1" name='m1' value="01"> mins</td>
						<td width="33%"><input disabled type="text" style="width:15px" id="viss1" name='s1' value="00"> secs</td>
					</tr>
					<tr>
						<td width="33%"><span onclick="updateTimeOut('h','down')"><img style="vertical-align:top;padding-left:3px;cursor:pointer;" src="<?php echo $HUB_FLM->getImagePath('downarrowbig.gif'); ?>" border='0'></a></td>
						<td width="33%"><span onclick="updateTimeOut('m','down')"><img style="vertical-align:top;padding-left:3px;cursor:pointer;" src="<?php echo $HUB_FLM->getImagePath('downarrowbig.gif'); ?>" border='0'></a></td>
						<td width="33%"><span onclick="updateTimeOut('s','down')"><img style="vertical-align:top;padding-left:3px;cursor:pointer;" src="<?php echo $HUB_FLM->getImagePath('downarrowbig.gif'); ?>" border='0'></a></td>
					</tr>
				</table>
			</div>
		</div>

		<div style="clear:both;float:left;">
			<label for="langurl" style="float:left;width:150px;margin-top:4px;"><?php echo $LNG->EMBED_INDEX_LANG_URL_LABEL; ?></label>
			<input id="langurl" style="float:left;width:450px;" placeholder="<?php echo $LNG->EMBED_INDEX_LANG_URL_HINT; ?>" />
			<img title="<?php echo $LNG->EMBED_INDEX_USER_SOURCE_URL_HELP_HINT; ?>" src="<?php echo $HUB_FLM->getImagePath('info.png'); ?>" border="0" style="cursor:pointer;padding-left:5px;padding-top:3px;" onclick="toggleDiv('langhelp')" />
			<div id="langhelp" style="clear:both;float:left;display:none;margin-top:5px;padding:5px;"><?php echo $LNG->EMBED_INDEX_LANG_URL_HELP; ?></div>
		</div>

		<div style="clear:both;float:left;margin-top:5px;">
			<label for="cifuserurl" style="float:left;width:150px;margin-top:4px;"><?php echo $LNG->EMBED_INDEX_USER_SOURCE_URL_LABEL; ?></label>
			<input id="cifuserurl" style="float:left;width:450px;" placeholder="<?php echo $LNG->EMBED_INDEX_USER_SOURCE_URL_HINT; ?>" />
			<img title="<?php echo $LNG->EMBED_INDEX_USER_SOURCE_URL_HELP_HINT; ?>" src="<?php echo $HUB_FLM->getImagePath('info.png'); ?>" border="0" style="cursor:pointer;padding-left:5px;padding-top:3px;" onclick="toggleDiv('cifuserurlhelp')" />
			<div id="cifuserurlhelp" style="clear:both;float:left;display:none;margin-top:5px;padding:5px;"><?php echo $LNG->EMBED_INDEX_USER_SOURCE_URL_HELP; ?></div>
		</div>

		<!-- div style="clear:both;float:left;width:100%;margin-top:20px;">
			<h2 style="font-size:14pt;margin-bottom:0px;"><?php echo $LNG->EMBED_INDEX_VISUALISATIONS_TITLE ?></h2>
		</div -->

		<!-- div style="clear:both;float:left;margin:0px;padding:px;"><?php echo $LNG->EMBED_INDEX_VIS_MESSAGE2; ?></div -->

		<div id="tabber" style="clear:both;float:left; width: 100%;margin-top:20px;">
			<ul id="vistabs" class="tab2">
				<li class="tab2"><a class="tab2" id="tab-vis-tree" href="<?php echo $CFG->homeAddress; ?>#vis-tree"><span class="tab2 tabinner"><?php echo $LNG->EMBED_INDEX_TAB_VIS_TREE; ?></span></a></li>
				<li class="tab2"><a class="tab2" id="tab-vis-network" href="<?php echo $CFG->homeAddress; ?>#vis-network"><span class="tab2 tabinner"><?php echo $LNG->EMBED_INDEX_TAB_VIS_NETWORK; ?></span></a></li>
				<li class="tab2"><a class="tab2" id="tab-vis-stats" href="<?php echo $CFG->homeAddress; ?>#vis-stats"><span class="tab2 tabinner"><?php echo $LNG->EMBED_INDEX_TAB_VIS_STATS; ?></span></a></li>
				<li class="tab2"><a class="tab2" id="tab-vis-dash" href="<?php echo $CFG->homeAddress; ?>#vis-dash"><span class="tab2 tabinner"><?php echo $LNG->EMBED_INDEX_DASHBOARD_TITLE; ?></span></a></li>
			</ul>

			<div id="tab-content-vis" class="tabcontentinner">
				<div id='tab-content-vis-tree-div'  class='tabcontent' style="display:none;">
		        	<div class="tabline" style="height:2px;width:100%"></div>
					<?php
						include('ui/vistreelist.php');
					?>
				</div>
				<div id='tab-content-vis-network-div'  class='tabcontent' style="display:none;">
		        	<div class="tabline" style="height:2px;width:100%"></div>
					<?php
						include('ui/visnetworklist.php');
					?>
				</div>
				<div id='tab-content-vis-stats-div'  class='tabcontent' style="display:none;">
		        	<div class="tabline" style="height:2px;width:100%"></div>
					<?php
						include('ui/visstatslist.php');
					?>
				</div>
				<div id='tab-content-vis-dash-div'  class='tabcontent' style="display:none;">
		        	<div class="tabline" style="height:2px;width:100%"></div>
					<div id="tab-content-embed-viz-div" style="clear:both;float:left;width:100%;">
						<p><?php echo $LNG->EMBED_INDEX_DASH_MESSAGE2; ?></p>

						<p>
							<label for="dashtitle"><?php echo $LNG->EMBED_INDEX_DASH_TITLE_LABEL; ?></label>
							<input id="dashtitle" style="width:500px;" placeholder="<?php echo $LNG->EMBED_INDEX_DASH_TITLE_PLACEHOLDER; ?>" />
						</p>

						<p><?php echo $LNG->EMBED_INDEX_DASH_MESSAGE; ?></p>

						<h3><?php echo $LNG->EMBED_INDEX_DASH_CHOOSER_TITLE; ?><span style="font-size:9pt; padding-left:20px;">(<?php echo $LNG->EMBED_INDEX_DASH_CHOOSER_MESSAGE; ?>)</span></h3>
						<?php
							include('ui/visdashboardbuilder.php');
						?>

						<div style="font-size:12pt;clear:both;float:left;margin-top:15px;padding-bottom:30px;">
							<span class="active" title="<?php echo $LNG->EMBED_INDEX_CODE_HINT; ?>" onclick="createEmbedDashboardUrl()" style="float:left;margin:0px;padding:0px;margin-right: 20px;">
							<?php echo $LNG->EMBED_INDEX_CODE_LINK; ?></span>

							<span class="active" title="<?php echo $LNG->EMBED_INDEX_PAGE_HINT; ?>" onclick="createEmbedDashboardPage()" style="float:left;margin:0px;padding:0px;margin-right: 20px;">
							<?php echo $LNG->EMBED_INDEX_DASH_PAGE_LINK; ?></span>

							<span class="active" title="<?php echo $LNG->EMBED_INDEX_PREVIEW_HINT; ?>" onclick="createEmbedDashboardPreview()" style="float:left;margin:0px;padding:0px;margin-right: 20px;">
							<?php echo $LNG->EMBED_INDEX_PREVIEW_LINK; ?></span>

							<a target="_blank" href="<?php echo $CFG->homeAddress; ?>ui/visualisations/index.php?vis=1,2,3,4&title=<?php echo urlencode($LNG->EMBED_INDEX_DASH_EXAMPLE_TITLE); ?>&page=home&userurl=&url=<?php echo urlencode('<?php echo $CFG->homeAddress; ?>ui/test.json'); ?>" title="<?php echo $LNG->EMBED_INDEX_DEMO_HINT; ?>" style="float:left;margin:0px;padding:0px;margin-right: 20px;">
							<?php echo $LNG->EMBED_INDEX_DEMO_LINK; ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
