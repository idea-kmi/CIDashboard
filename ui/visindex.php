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
				$('visdash-'+item.value).style.display = "inline-block";
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
			if (item.style.display == 'inline-block') {
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

<div class="container-fluid">
	<div class="row p-3">	
		<div class="col-12">
			<div id="tab-content-embed-viz-div">
				<div id="languagechoice" class="d-flex flex-wrap">
					<div class="me-5 mt-3"><p><?php echo $LNG->EMBED_INDEX_LANGUAGE_CHOICE;?></p></div>
					<div class="form-check form-check-inline d-flex align-items-center gap-2">
						<input class="form-check-input" type="radio" name="vislanguage" value="en" id="en" <?php if ($CFG->language == 'en') {echo 'checked'; } ?> onchange="checkLanguageVis('vislanguageimgen')" />
						<label class="form-check-label" for="en" style="cursor: pointer;">
							<img id="vislanguageimgen" name="vislanguageimg" src="images/flags/UnitedKingdom.png" alt="English" class="px-1" />
						</label>
					</div>
					<div class="form-check form-check-inline d-flex align-items-center gap-2">
						<input class="form-check-input" type="radio" name="vislanguage" value="de" id="de" <?php if ($CFG->language == 'de') {echo 'checked'; } ?> onchange="checkLanguageVis('vislanguageimgde')" />
						<label class="form-check-label" for="de" style="cursor: pointer;">
							<img id="vislanguageimgde" name="vislanguageimg" src="images/flags/Germany.png" alt="German" class="px-1" />
						</label>
					</div>
					<div class="form-check form-check-inline d-flex align-items-center gap-2">
						<input class="form-check-input" type="radio" name="vislanguage" value="es" id="es" <?php if ($CFG->language == 'es') {echo 'checked'; } ?> onchange="checkLanguageVis('vislanguageimges')" />
						<label class="form-check-label" for="es" style="cursor: pointer;">
							<img id="vislanguageimges" name="vislanguageimg" src="images/flags/Spain.png" alt="Spanish" class="px-1" />
						</label>
					</div>
					<div class="form-check form-check-inline d-flex align-items-center gap-2">
						<input class="form-check-input" type="radio" name="vislanguage" value="pt" id="pt" <?php if ($CFG->language == 'pt') {echo 'checked'; } ?> onchange="checkLanguageVis('vislanguageimgpt')" />
						<label class="form-check-label" for="pt" style="cursor: pointer;">	
							<div id="vislanguageimgpt" name="vislanguageimg" class="px-1">
								<img src="<?php echo $HUB_FLM->getImagePath('flags/Portugal.png'); ?>" alt="Portuguese (Portugal)" />
								<img src="<?php echo $HUB_FLM->getImagePath('flags/Brazil.png'); ?>" alt="Portuguese (Brazil)" />
							</div>
						</label>
					</div>					
				</div>
			</div>
					
			<div class="mb-3 row">
				<label for="cifdataurl" class="col-sm-3 col-form-label">
					<?php echo $LNG->EMBED_INDEX_DATA_SOURCE_URL_LABEL; ?>
					<a class="active" onclick="toggleDiv('cifurlhelp')">
						<i class="far fa-question-circle fa-lg me-2" aria-hidden="true" ></i> 
						<span class="sr-only">More info</span>
					</a>
				</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="cifdataurl" name="cifdataurl" placeholder="<?php echo $LNG->EMBED_INDEX_DATA_SOURCE_URL_HINT; ?>" />
				</div>
			</div>

			<div class="mb-3 row">
				<div class="col">
					<div class="d-flex flex-wrap align-items-center">
						<div class="col-sm-3"><p><?php echo $LNG->EMBED_INDEX_DATA_SOURCE_REFRESH_LABEL;?></p></div>
						<table id="expiretime" class="text-center">
							<tr>
								<td width="33%" style="cursor: pointer;"><span onclick="updateTimeOut('h','up')"><img style="vertical-align:bottom;padding-left:2px;cursor:pointer;" src="<?php echo $HUB_FLM->getImagePath('uparrowbig.gif'); ?>" alt="increase hours" /></a></td>
								<td width="33%" style="cursor: pointer;"><span onclick="updateTimeOut('m','up')"><img style="vertical-align:bottom;padding-left:2px;cursor:pointer;" src="<?php echo $HUB_FLM->getImagePath('uparrowbig.gif'); ?>" alt="increase minutes" /></a></td>
								<td width="33%" style="cursor: pointer;"><span onclick="updateTimeOut('s','up')"><img style="vertical-align:bottom;padding-left:2px;cursor:pointer;" src="<?php echo $HUB_FLM->getImagePath('uparrowbig.gif'); ?>" alt="increase seconds" /></a></td>
							</tr>
							<tr>
								<td width="33%"><input disabled type="text" class="form-control" style="width:50px" id="vish1" name='h1' value="00" /> <label for="vish1">hrs</label></td>
								<td width="33%"><input disabled type="text" class="form-control" style="width:50px" id="vism1" name='m1' value="01" /> <label for="vism1">mins</label></td>
								<td width="33%"><input disabled type="text" class="form-control" style="width:50px" id="viss1" name='s1' value="00" /> <label for="viss1">secs</label></td>
							</tr>
							<tr>
								<td width="33%" style="cursor: pointer;"><span onclick="updateTimeOut('h','down')"><img style="vertical-align:top;padding-left:3px;cursor:pointer;" src="<?php echo $HUB_FLM->getImagePath('downarrowbig.gif'); ?>" alt="decrease hours" /></a></td>
								<td width="33%" style="cursor: pointer;"><span onclick="updateTimeOut('m','down')"><img style="vertical-align:top;padding-left:3px;cursor:pointer;" src="<?php echo $HUB_FLM->getImagePath('downarrowbig.gif'); ?>" alt="decrease minutes" /></a></td>
								<td width="33%" style="cursor: pointer;"><span onclick="updateTimeOut('s','down')"><img style="vertical-align:top;padding-left:3px;cursor:pointer;" src="<?php echo $HUB_FLM->getImagePath('downarrowbig.gif'); ?>" alt="decrease seconds" /></a></td>
							</tr>
						</table>
					</div>
				</div>
			</div>

			<div class="mb-3 row" id="cifurlhelp" style="display:none;">
				<div class="col">
					<div class="card">
						<div class="card-body">
							<p><?php echo $LNG->EMBED_INDEX_VIS_MESSAGE; ?></p>
						</div>
					</div>
				</div>
			</div>			
					
			<div class="mb-3 row">
				<label for="langurl" class="col-sm-3 col-form-label">
					<?php echo $LNG->EMBED_INDEX_LANG_URL_LABEL; ?>
					<a class="active" onclick="toggleDiv('langhelp')">
						<i class="far fa-question-circle fa-lg me-2" aria-hidden="true" ></i> 
						<span class="sr-only">More info</span>
					</a>
				</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="langurl" name="langurl" placeholder="<?php echo $LNG->EMBED_INDEX_LANG_URL_HINT; ?>" />
				</div>
			</div>

			<div class="mb-3 row" id="langhelp" style="display:none;">
				<div class="col">
					<div class="card">
						<div class="card-body">
							<p><?php echo $LNG->EMBED_INDEX_LANG_URL_HELP; ?></p>
						</div>
					</div>
				</div>
			</div>
					
			<div class="mb-3 row">
				<label for="cifuserurl" class="col-sm-3 col-form-label">
					<?php echo $LNG->EMBED_INDEX_USER_SOURCE_URL_LABEL; ?>
					<a class="active" onclick="toggleDiv('cifuserurlhelp')">
						<i class="far fa-question-circle fa-lg me-2" aria-hidden="true" ></i> 
						<span class="sr-only">More info</span>
					</a>
				</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="cifuserurl" name="cifuserurl" placeholder="<?php echo $LNG->EMBED_INDEX_USER_SOURCE_URL_HINT; ?>" />
				</div>
			</div>

			<div class="mb-3 row" id="cifuserurlhelp" style="display:none;">
				<div class="col">
					<div class="card">
						<div class="card-body">
							<p><?php echo $LNG->EMBED_INDEX_USER_SOURCE_URL_HELP; ?></p>
						</div>
					</div>
				</div>
			</div>

			<div id="tabber">
				<ul id="vistabs" class="nav nav-tabs vistabs" role="tablist">
					<li class="nav-item"><a class="nav-link tab2" id="tab-vis-tree" href="<?php echo $CFG->homeAddress; ?>#vis-tree"><span class="tab2 tabinner"><?php echo $LNG->EMBED_INDEX_TAB_VIS_TREE; ?></span></a></li>
					<li class="nav-item"><a class="nav-link tab2" id="tab-vis-network" href="<?php echo $CFG->homeAddress; ?>#vis-network"><span class="tab2 tabinner"><?php echo $LNG->EMBED_INDEX_TAB_VIS_NETWORK; ?></span></a></li>
					<li class="nav-item"><a class="nav-link tab2" id="tab-vis-stats" href="<?php echo $CFG->homeAddress; ?>#vis-stats"><span class="tab2 tabinner"><?php echo $LNG->EMBED_INDEX_TAB_VIS_STATS; ?></span></a></li>
					<li class="nav-item"><a class="nav-link tab2" id="tab-vis-dash" href="<?php echo $CFG->homeAddress; ?>#vis-dash"><span class="tab2 tabinner"><?php echo $LNG->EMBED_INDEX_DASHBOARD_TITLE; ?></span></a></li>
				</ul>

				<div id="tab-content-vis" class="tabcontentinner">
					<div id='tab-content-vis-tree-div'  class='tabcontent' style="display:none;">
						<div class="tabline"></div>
						<?php
							include('ui/vistreelist.php');
						?>
					</div>
					<div id='tab-content-vis-network-div'  class='tabcontent' style="display:none;">
						<div class="tabline"></div>
						<?php
							include('ui/visnetworklist.php');
						?>
					</div>
					<div id='tab-content-vis-stats-div'  class='tabcontent' style="display:none;">
						<div class="tabline"></div>
						<?php
							include('ui/visstatslist.php');
						?>
					</div>
					<div id='tab-content-vis-dash-div'  class='tabcontent' style="display:none;">
						<div class="tabline"></div>
						<div id="tab-content-embed-viz-div">
							<p><?php echo $LNG->EMBED_INDEX_DASH_MESSAGE2; ?></p>

							<div class="mb-3 row">
								<label for="dashtitle" class="col-sm-2 col-form-label">
									<?php echo $LNG->EMBED_INDEX_DASH_TITLE_LABEL; ?>
								</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="dashtitle" name="dashtitle" placeholder="<?php echo $LNG->EMBED_INDEX_DASH_TITLE_PLACEHOLDER; ?>" />
								</div>
							</div>

							<p><?php echo $LNG->EMBED_INDEX_DASH_MESSAGE; ?></p>

							<h3 class="mt-5">
								<?php echo $LNG->EMBED_INDEX_DASH_CHOOSER_TITLE; ?>
								<span class="dash-message">(<?php echo $LNG->EMBED_INDEX_DASH_CHOOSER_MESSAGE; ?>)</span>
							</h3>
							<?php
								include('ui/visdashboardbuilder.php');
							?>

							<div style="font-size:12pt;margin-top:15px;padding-bottom:30px;">
								<span class="active" title="<?php echo $LNG->EMBED_INDEX_CODE_HINT; ?>" onclick="createEmbedDashboardUrl()" style="margin:0px;padding:0px;margin-right: 20px;">
								<?php echo $LNG->EMBED_INDEX_CODE_LINK; ?></span>

								<span class="active" title="<?php echo $LNG->EMBED_INDEX_PAGE_HINT; ?>" onclick="createEmbedDashboardPage()" style="margin:0px;padding:0px;margin-right: 20px;">
								<?php echo $LNG->EMBED_INDEX_DASH_PAGE_LINK; ?></span>

								<span class="active" title="<?php echo $LNG->EMBED_INDEX_PREVIEW_HINT; ?>" onclick="createEmbedDashboardPreview()" style="margin:0px;padding:0px;margin-right: 20px;">
								<?php echo $LNG->EMBED_INDEX_PREVIEW_LINK; ?></span>

								<a target="_blank" href="<?php echo $CFG->homeAddress; ?>ui/visualisations/index.php?vis=1,2,3,4&title=<?php echo urlencode($LNG->EMBED_INDEX_DASH_EXAMPLE_TITLE); ?>&page=home&userurl=&url=<?php echo urlencode('<?php echo $CFG->homeAddress; ?>ui/test.json'); ?>" title="<?php echo $LNG->EMBED_INDEX_DEMO_HINT; ?>" style="margin:0px;padding:0px;margin-right: 20px;">
								<?php echo $LNG->EMBED_INDEX_DEMO_LINK; ?></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
