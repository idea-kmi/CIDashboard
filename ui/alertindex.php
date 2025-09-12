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
		var code = '<iframe title="<?php echo $LNG->IFRAME_ALERT_EMBED; ?>" src="'+url+'" width="'+width+'" height="'+height+'" style="overflow:auto" scrolling="auto" frameborder="0"></iframe>';
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

<div class="container-fluid">
	<div class="row p-3">	
		<div class="col-12">
			<div id="tab-content-embed-alert-div">
				<p>
					<a href="http://cci.mit.edu/klein/deliberatorium.html" target="_blank" title="http://cci.mit.edu/klein/deliberatorium.html">
						<img src="<?php echo $HUB_FLM->getImagePath('deliberatorium-analytics-logo.png'); ?>" style="vertical-align:middle; width:30px; height:30px;" alt="" />
						<i><?php echo $LNG->EMBED_POWERED_BY_DELIBERATORIUM; ?></i>
					</a>
				</p>

				<div id="alertlanguagechoice" class="d-flex flex-wrap">
					<div class="me-5 mt-3"><p><?php echo $LNG->EMBED_INDEX_LANGUAGE_CHOICE;?></p></div>
					<div class="form-check form-check-inline d-flex align-items-center gap-2">
						<input class="form-check-input" type="radio" name="alertvislanguage" value="en" id="alert-en" <?php if ($CFG->language == 'en') {echo 'checked'; } ?> onchange="checkAlertLanguageVis('alertvislanguageimgen')" />
						<label class="form-check-label" for="alert-en" style="cursor: pointer;">
							<img id="alertvislanguageimgen" name="alertvislanguageimg" src="images/flags/UnitedKingdom.png" alt="English" class="px-1" />
						</label>
					</div>
					<div class="form-check form-check-inline d-flex align-items-center gap-2">
						<input class="form-check-input" type="radio" name="alertvislanguage" value="de" id="alert-de" <?php if ($CFG->language == 'de') {echo 'checked'; } ?> onchange="checkAlertLanguageVis('alertvislanguageimgde')" />
						<label class="form-check-label" for="alert-de" style="cursor: pointer;">
							<img id="alertvislanguageimgde" name="alertvislanguageimg" src="images/flags/Germany.png" alt="German" class="px-1" />
						</label>
					</div>
					<div class="form-check form-check-inline d-flex align-items-center gap-2">
						<input class="form-check-input" type="radio" name="alertvislanguage" value="es" id="alert-es" <?php if ($CFG->language == 'es') {echo 'checked'; } ?> onchange="checkAlertLanguageVis('alertvislanguageimges')" />
						<label class="form-check-label" for="alert-es" style="cursor: pointer;">
							<img id="alertvislanguageimges" name="alertvislanguageimg" src="images/flags/Spain.png" alt="Spanish" class="px-1" />
						</label>
					</div>
					<div class="form-check form-check-inline d-flex align-items-center gap-2">
						<input class="form-check-input" type="radio" name="alertvislanguage" value="pt" id="alert-pt" <?php if ($CFG->language == 'pt') {echo 'checked'; } ?> onchange="checkAlertLanguageVis('alertvislanguageimgpt')" />
						<label class="form-check-label" for="alert-pt" style="cursor: pointer;">	
							<div id="alertvislanguageimgpt" name="alertvislanguageimg" class="px-1">
								<img src="<?php echo $HUB_FLM->getImagePath('flags/Portugal.png'); ?>" alt="Portuguese (Portugal)" />
								<img src="<?php echo $HUB_FLM->getImagePath('flags/Brazil.png'); ?>" alt="Portuguese (Brazil)" />
							</div>
						</label>
					</div>
				</div>
			</div>

			<div class="mb-3 row">
				<label for="alertcifdataurl" class="col-sm-3 col-form-label">
					<?php echo $LNG->EMBED_INDEX_DATA_SOURCE_URL_LABEL; ?>
					<a class="active" onclick="toggleDiv('alertcifurlhelp')">
						<i class="far fa-question-circle fa-lg me-2" aria-hidden="true" ></i> 
						<span class="sr-only">More info</span>
					</a>
				</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="alertcifdataurl" name="alertcifdataurl" placeholder="<?php echo $LNG->EMBED_INDEX_DATA_SOURCE_URL_HINT; ?>" />
				</div>
			</div>
	
			<div class="mb-3 row">
				<div class="col">
					<div class="d-flex flex-wrap align-items-center">
						<div class="col-sm-3"><p><?php echo $LNG->EMBED_INDEX_DATA_SOURCE_REFRESH_LABEL;?></p></div>
						<table id="expiretime" class="text-center">
							<tr>
								<td width="33%" style="cursor: pointer;"><span onclick="updateAlertTimeOut('h','up')"><img style="vertical-align:bottom;padding-left:2px;cursor:pointer;" src="<?php echo $HUB_FLM->getImagePath('uparrowbig.gif'); ?>" alt="increase hours" /></a></td>
								<td width="33%" style="cursor: pointer;"><span onclick="updateAlertTimeOut('m','up')"><img style="vertical-align:bottom;padding-left:2px;cursor:pointer;" src="<?php echo $HUB_FLM->getImagePath('uparrowbig.gif'); ?>" alt="increase minutes" /></a></td>
								<td width="33%" style="cursor: pointer;"><span onclick="updateAlertTimeOut('s','up')"><img style="vertical-align:bottom;padding-left:2px;cursor:pointer;" src="<?php echo $HUB_FLM->getImagePath('uparrowbig.gif'); ?>" alt="increase seconds" /></a></td>
							</tr>
							<tr>
								<td width="33%"><input disabled type="text" class="form-control" style="width:50px" id="alerth1" name='alerth1' value="00" /> <label for="alerth1">hrs</label></td>
								<td width="33%"><input disabled type="text" class="form-control" style="width:50px" id="alertm1" name='alertm1' value="01" /> <label for="alertm1">mins</label></td>
								<td width="33%"><input disabled type="text" class="form-control" style="width:50px" id="alerts1" name='alerts1' value="00" /> <label for="alerts1">secs</label></td>
							</tr>
							<tr>
								<td width="33%" style="cursor: pointer;"><span onclick="updateAlertTimeOut('h','down')"><img style="vertical-align:top;padding-left:3px;cursor:pointer;" src="<?php echo $HUB_FLM->getImagePath('downarrowbig.gif'); ?>" alt="decrease hours" /></a></td>
								<td width="33%" style="cursor: pointer;"><span onclick="updateAlertTimeOut('m','down')"><img style="vertical-align:top;padding-left:3px;cursor:pointer;" src="<?php echo $HUB_FLM->getImagePath('downarrowbig.gif'); ?>" alt="decrease minutes" /></a></td>
								<td width="33%" style="cursor: pointer;"><span onclick="updateAlertTimeOut('s','down')"><img style="vertical-align:top;padding-left:3px;cursor:pointer;" src="<?php echo $HUB_FLM->getImagePath('downarrowbig.gif'); ?>" alt="decrease seconds" /></a></td>
							</tr>
						</table>
					</div>
				</div>
			</div>

			<div class="mb-3 row" id="alertcifurlhelp" style="display:none;">
				<div class="col">
					<div class="card">
						<div class="card-body">
							<p><?php echo $LNG->EMBED_INDEX_ALERT_MESSAGE; ?></p>
						</div>
					</div>
				</div>
			</div>		
					
			<div class="mb-3 row">
				<label for="alertlangurl" class="col-sm-3 col-form-label">
					<?php echo $LNG->EMBED_INDEX_LANG_URL_LABEL; ?>
					<a class="active" onclick="toggleDiv('alertlanghelp')">
						<i class="far fa-question-circle fa-lg me-2" aria-hidden="true" ></i> 
						<span class="sr-only">More info</span>
					</a>
				</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="alertlangurl" name="alertlangurl" placeholder="<?php echo $LNG->EMBED_INDEX_LANG_URL_HINT; ?>" />
				</div>
			</div>

			<div class="mb-3 row" id="alertlanghelp" style="display:none;">
				<div class="col">
					<div class="card">
						<div class="card-body">
							<p><?php echo $LNG->EMBED_INDEX_LANG_URL_HELP; ?></p>
						</div>
					</div>
				</div>
			</div>
					
			<div class="mb-3 row">
				<label for="alertcifuserurl" class="col-sm-3 col-form-label">
					<?php echo $LNG->EMBED_INDEX_USER_SOURCE_URL_LABEL; ?>
					<a class="active" onclick="toggleDiv('alertcifuserurlhelp')">
						<i class="far fa-question-circle fa-lg me-2" aria-hidden="true" ></i> 
						<span class="sr-only">More info</span>
					</a>
				</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="alertcifuserurl" name="alertcifuserurl" placeholder="<?php echo $LNG->EMBED_INDEX_USER_SOURCE_URL_HINT; ?>" />
				</div>
			</div>

			<div class="mb-3 row" id="alertcifuserurlhelp" style="display:none;">
				<div class="col">
					<div class="card">
						<div class="card-body">
							<p><?php echo $LNG->EMBED_INDEX_USER_SOURCE_URL_HELP; ?></p>
						</div>
					</div>
				</div>
			</div>

			<div class="mb-3 row">
				<?php
					include('ui/alertslist.php');
				?>
			</div>
		</div>
	</div>
</div>
