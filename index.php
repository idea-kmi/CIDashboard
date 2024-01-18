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
/** @author Michelle Bachler, KMi, The Open University */

include_once("config.php");

include_once($HUB_FLM->getCodeDirPath("ui/header.php"));
?>

<script>
var TABS = {"home":true, "vis":true, "mini":true, "alert":true, "about":true, "help":true };
var VISVIZ = {"tree":true, "network":true, "stats":true, "dash":true};
var HELPVIZ = {"cif":true, "lang":true, "user":true, "alerts":true, "movie":true, "embed":true, "mini":true};

var DEFAULT_TAB = 'home';
var DEFAULT_VIZ = 'tree';
var DEFAULT_HELP_VIZ = 'movie';

var CURRENT_TAB = DEFAULT_TAB;
var CURRENT_VIZ = DEFAULT_VIZ;

var stpHomeList = setTabPushed.bindAsEventListener($('tab-home'),'home');
var stpVisList = setTabPushed.bindAsEventListener($('tab-vis'),'vis');
var stpMiniList = setTabPushed.bindAsEventListener($('tab-mini'),'mini');
var stpAlertList = setTabPushed.bindAsEventListener($('tab-alert'),'alert');
var stpAboutList = setTabPushed.bindAsEventListener($('tab-about'),'about');
var stpHelpList = setTabPushed.bindAsEventListener($('tab-help'),'help');

var stpTreeList = setTabPushed.bindAsEventListener($('tab-tree'),'vis-tree');
var stpNetworkList = setTabPushed.bindAsEventListener($('tab-network'),'vis-network');
var stpStatsList = setTabPushed.bindAsEventListener($('tab-stats'),'vis-stats');
var stpDashList = setTabPushed.bindAsEventListener($('tab-dash'),'vis-dash');

var stpHelpCifList = setTabPushed.bindAsEventListener($('tab-help-cif'),'help-cif');
var stpHelpLangList = setTabPushed.bindAsEventListener($('tab-help-lang'),'help-lang');
var stpHelpUserList = setTabPushed.bindAsEventListener($('tab-help-user'),'help-user');
var stpHelpAlertList = setTabPushed.bindAsEventListener($('tab-help-alerts'),'help-alerts');
var stpHelpMovieList = setTabPushed.bindAsEventListener($('tab-help-movie'),'help-movie');
var stpHelpEmbedList = setTabPushed.bindAsEventListener($('tab-help-embed'),'help-embed');
var stpHelpMiniList = setTabPushed.bindAsEventListener($('tab-help-embed'),'help-mini');

/**
 *	set which tab to show and load first
 */
Event.observe(window, 'load', function() {

	Event.observe('tab-home','click', stpHomeList);
	Event.observe('tab-vis','click', stpVisList);
	Event.observe('tab-mini','click', stpMiniList);
	Event.observe('tab-alert','click', stpAlertList);
	Event.observe('tab-about','click', stpAboutList);
	Event.observe('tab-help','click', stpHelpList);

	Event.observe('tab-vis-tree','click', stpTreeList);
	Event.observe('tab-vis-network','click', stpNetworkList);
	Event.observe('tab-vis-stats','click', stpStatsList);
	Event.observe('tab-vis-dash','click', stpDashList);

	Event.observe('tab-help-cif','click', stpHelpCifList);
	Event.observe('tab-help-lang','click', stpHelpLangList);
	Event.observe('tab-help-user','click', stpHelpUserList);
	Event.observe('tab-help-alerts','click', stpHelpAlertList);
	Event.observe('tab-help-movie','click', stpHelpMovieList);
	Event.observe('tab-help-embed','click', stpHelpEmbedList);
	Event.observe('tab-help-mini','click', stpHelpMiniList);

	var tab = getAnchorVal(DEFAULT_TAB);
	setTabPushed($('tab-'+tab) ,tab);

	if($('largeexample')) {
		iframeLoadingMessage('largeexample', 'vis');
		$('largeexample').src='<?php echo $CFG->homeAddress; ?>ui/visualisations/circlepacking.php?width=1000&height=900&withposts=false&lang=en&userurl&url=https%3A%2F%2Fcidashboard.net%2Fcif%2Fconversations%2F6d417f98-39b5-4d52-8759-90a297d7dd0e&langurl=&timeout=60';
	}
	if($('largedashexample')) {
		iframeLoadingMessage('largedashexample', 'visdash');
		$('largedashexample').src='<?php echo $CFG->homeAddress; ?>ui/visualisations/index.php?width=1000&height=1000&vis=p7%2C8%2Cp1%2C16%2C21%2C23lang=en&userurl&title=Test%20Dashboard%20of%20Large%20Visualisations&url=https%3A%2F%2Fcidashboard.net%2Fcif%2Fconversations%2F6d417f98-39b5-4d52-8759-90a297d7dd0e&timeout=60';
	}
	if($('miniexample')) {
		iframeLoadingMessage('miniexample', 'mini');
		$('miniexample').src='<?php echo $CFG->homeAddress; ?>ui/minis/usercontributions.php?miniwithposts=false&lang=en&url=https%3A%2F%2Fcidashboard.net%2Fcif%2Fviews%2Fb6f0374d-da86-4b13-9fc7-a16f154a5ff0&langurl=&timeout=60';
	}
	if($('minidashexample')) {
		iframeLoadingMessage('minidashexample', 'minidash');
		$('minidashexample').src='<?php echo $CFG->homeAddress; ?>ui/minis/minidashboard.php?vis=1%2C3%2C6&lang=en&title=Test%20Dashboard%20of%20Mini%20Visualisations&url=https%3A%2F%2Fcidashboard.net%2Fcif%2Fviews%2Fb6f0374d-da86-4b13-9fc7-a16f154a5ff0&timeout=60';
	}
	if($('alertsexample')) {
		iframeLoadingMessage('alertsexample', 'alerts');
		$('alertsexample').src='<?php echo $CFG->homeAddress; ?>ui/minis/alerts.php?userids=false&lang=en&url=https%3A%2F%2Fcidashboard.net%2Fcif%2Fviews%2Fb6f0374d-da86-4b13-9fc7-a16f154a5ff0&userurl=&langurl=&timeout=60&alerts=24%2C25%2C15%2C16%2C19%2C7%2C8%2C9%2C14%2C17%2C18%2C20%2C23';
	}
});

/**
 *	switch between tabs
 */
function setTabPushed(e) {

	var data = $A(arguments);
	var tabID = data[1];
	var parts = tabID.split("-");
	var tab = parts[0];

	var viz="";
	if (parts.length > 1) {
		viz = parts[1];
	}

	// Check tab is known else default to default
	if (!TABS.hasOwnProperty(tab)) {
		tab = DEFAULT_TAB;
		viz = DEFAULT_VIZ;
	}

	var i="";
	for (i in TABS){
		if(tab == i){
			if($("tab-"+i)) {
				$("tab-"+i).removeClassName("unselected");
				$("tab-"+i).addClassName("current");
			}
		} else {
			if($("tab-"+i)) {
				$("tab-"+i).removeClassName("current");
				$("tab-"+i).addClassName("unselected");
			}
		}

		if(tab == i){
			if ($("tab-content-"+i+"-div")) {
				$("tab-content-"+i+"-div").show();
			}
		} else {
			if ($("tab-content-"+i+"-div")) {
				$("tab-content-"+i+"-div").hide();
			}
		}
	}

	if (tab =="vis") {
		if (viz == "") {
			viz = DEFAULT_VIZ;
		}

		for (i in VISVIZ){
			if(viz == i){
				if ($("tab-"+tab+"-"+i)) {
					$("tab-"+tab+"-"+i).removeClassName("unselected");
					$("tab-"+tab+"-"+i).addClassName("current");
					$("tab-content-"+tab+"-"+i+"-div").show();
				}
			} else {
				if ($("tab-"+tab+"-"+i)) {
					$("tab-"+tab+"-"+i).removeClassName("current");
					$("tab-"+tab+"-"+i).addClassName("unselected");
					$("tab-content-"+tab+"-"+i+"-div").hide();
				}
			}
		}
	}

	if (tab == "help") {
		if (viz == "") {
			viz = DEFAULT_HELP_VIZ;
		}

		for (i in HELPVIZ){
			if(viz == i){
				if ($("tab-"+tab+"-"+i)) {
					$("tab-"+tab+"-"+i).removeClassName("unselected");
					$("tab-"+tab+"-"+i).addClassName("current");
					$("tab-content-"+tab+"-"+i+"-div").show();
				}
			} else {
				if ($("tab-"+tab+"-"+i)) {
					$("tab-"+tab+"-"+i).removeClassName("current");
					$("tab-"+tab+"-"+i).addClassName("unselected");
					$("tab-content-"+tab+"-"+i+"-div").hide();
				}
			}
		}
	}

	CURRENT_TAB = tab;
	CURRENT_VIZ = viz;

	switch(tab) {
		case 'home':
			$('tab-home').setAttribute("href",'#home');
			Event.stopObserving('tab-home','click');
			Event.observe('tab-home','click', stpHomeList);
			break;
		case 'vis':
			loadSortable();
			switch(viz){
				case 'tree':
					$('tab-vis').setAttribute("href",'#vis-tree');
					Event.stopObserving('tab-vis','click');
					Event.observe('tab-vis','click', stpTreeList);
					break;
				case 'network':
					$('tab-vis').setAttribute("href",'#vis-network');
					Event.stopObserving('tab-vis','click');
					Event.observe('tab-vis','click', stpNetworkList);
					break;
				case 'stats':
					$('tab-vis').setAttribute("href",'#vis-stats');
					Event.stopObserving('tab-vis','click');
					Event.observe('tab-vis','click', stpStatsList);
					break;
				case 'dash':
					$('tab-vis').setAttribute("href",'#vis-dash');
					Event.stopObserving('tab-vis','click');
					Event.observe('tab-vis','click', stpDashList);
					break;
			}
		case 'mini':
			$('tab-mini').setAttribute("href",'#mini');
			Event.stopObserving('tab-mini','click');
			Event.observe('tab-mini','click', stpMiniList);
			loadMiniSortable();
			break;
		case 'alert':
			$('tab-alert').setAttribute("href",'#alert');
			Event.stopObserving('tab-alert','click');
			Event.observe('tab-alert','click', stpAlertList);
			initAlerts();
			break;
		case 'about':
			$('tab-about').setAttribute("href",'#about');
			Event.stopObserving('tab-about','click');
			Event.observe('tab-about','click', stpAboutList);
			break;
		case 'help':
			switch(viz){
				case 'cif':
					$('tab-help').setAttribute("href",'#help-cif');
					Event.stopObserving('tab-help','click');
					Event.observe('tab-help','click', stpHelpCifList);
					break;
				case 'embed':
					$('tab-help').setAttribute("href",'#help-embed');
					Event.stopObserving('tab-help','click');
					Event.observe('tab-help','click', stpHelpEmbedList);
					break;
				case 'mini':
					$('tab-help').setAttribute("href",'#help-mini');
					Event.stopObserving('tab-help','click');
					Event.observe('tab-help','click', stpHelpMiniList);
					break;
				case 'alerts':
					$('tab-help').setAttribute("href",'#help-alerts');
					Event.stopObserving('tab-help','click');
					Event.observe('tab-help','click', stpHelpAlertList);
					break;
				case 'lang':
					$('tab-help').setAttribute("href",'#help-lang');
					Event.stopObserving('tab-help','click');
					Event.observe('tab-help','click', stpHelpLangList);
					break;
				case 'user':
					$('tab-help').setAttribute("href",'#help-user');
					Event.stopObserving('tab-help','click');
					Event.observe('tab-help','click', stpHelpUserList);
					break;
				case 'movie':
					$('tab-help').setAttribute("href",'#help-movie');
					Event.stopObserving('tab-help','click');
					Event.observe('tab-help','click', stpHelpMovieList);
					break;
			}
	}
}


function iframeLoadingMessage(iframename, type) {
	$("tab-content-"+type+"-message").update(getLoadingLine('<?php echo $LNG-> LOADING_MESSAGE; ?>'));
	if (IE) {
		$(iframename).onreadystatechange = function() {
			if( $(iframename).readyState == 'complete'){
				$("tab-content-"+type+"-message").update("");
			}
		};
	} else {
	    $(iframename).onload = function () {
			$("tab-content-"+type+"-message").update("");
	    };
	}
}

</script>

<div id="tabber" style="clear:both;float:left; width: 100%;margin-top:20px;">
	<ul id="tabs" class="tab">
		<li class="tab"><a class="tab" id="tab-home" href="<?php echo $CFG->homeAddress; ?>#home"><span class="tab tabouter"><?php echo $LNG->EMBED_INDEX_TAB_HOME; ?></span></a></li>
		<li class="tab"><a class="tab" id="tab-vis" href="<?php echo $CFG->homeAddress; ?>#vis"><span class="tab tabouter"><?php echo $LNG->EMBED_INDEX_TAB_LARGE_VIS; ?></span></a></li>
		<li class="tab"><a class="tab" id="tab-mini" href="<?php echo $CFG->homeAddress; ?>#mini"><span class="tab tabouter"><?php echo $LNG->EMBED_INDEX_TAB_MINI_VIS; ?></span></a></li>
		<li class="tab"><a class="tab" id="tab-alert" href="<?php echo $CFG->homeAddress; ?>#alert"><span class="tab tabouter"><?php echo $LNG->EMBED_INDEX_TAB_ALERT_VIS; ?></span></a></li>
		<li class="tab"><a class="tab" id="tab-about" href="<?php echo $CFG->homeAddress; ?>#about"><span class="tab tabouter"><?php echo $LNG->EMBED_INDEX_TAB_ABOUT; ?></span></a></li>
		<li class="tab"><a class="tab" id="tab-help" href="<?php echo $CFG->homeAddress; ?>#help"><span class="tab tabouter"><?php echo $LNG->EMBED_INDEX_TAB_HELP; ?></span></a></li>
	</ul>

	<div id="tabs-content" style="clear:both;float: left; width: 100%;">

		<div id='tab-content-home-div' class='tabcontent' style="display:none;">
			<div style="float:left;padding:10px;">
				<h1><?php echo $LNG->EMBED_INDEX_INNER_TITLE; ?></h1>
				<p><?php echo $LNG->EMBED_INDEX_FIRST_PARA; ?></p>
				<p><?php echo $LNG->EMBED_INDEX_SECOND_PARA; ?></p>

				<div style="float:left;width:100%">
					<h3><span style="font-size:12pt;cursor:pointer;" onclick="setTabPushed($('tab-vis-tree'),'vis-tree');"><?php echo $LNG->EMBED_INDEX_TAB_LARGE_VIS; ?>
					<br>
					<?php include($HUB_FLM->getCodeDirPath("ui/vislist.php")); ?>
					</span></h3>
				</div>

				<div style="float:left;margin-top:10px;width:100%">
					<h3><span style="font-size:12pt;cursor:pointer;" onclick="setTabPushed($('tab-mini'),'mini');"><?php echo $LNG->EMBED_INDEX_TAB_MINI_VIS; ?>
					<?php include($HUB_FLM->getCodeDirPath("ui/minishomelist.php")); ?>
					</span></h3>
				</div>

				<div style="float:left;margin-top:10px;width:100%">
					<h3><span style="font-size:12pt;cursor:pointer;" onclick="setTabPushed($('tab-alert'),'alert');"><?php echo $LNG->EMBED_INDEX_TAB_ALERT_VIS; ?>
					<br>
					<img alt="<?php echo $LNG->EMBED_MINI_TITLE_ALERTS; ?>" style="float:left;margin-bottom:10px;margin-top:5px;" src="images/visualisations/alertswhole-sm.png" />
					</span></h3>
				</div>
			</div>
		</div>

		<div id='tab-content-vis-div' class='tabcontent' style="display:none;">
			<?php include($HUB_FLM->getCodeDirPath("ui/visindex.php")); ?>
		</div>

		<div id='tab-content-mini-div' class='tabcontent' style="display:none;">
			<?php include($HUB_FLM->getCodeDirPath("ui/minisindex.php")); ?>
		</div>

		<div id='tab-content-alert-div' class='tabcontent' style="display:none;">
			<?php include($HUB_FLM->getCodeDirPath("ui/alertindex.php")); ?>
		</div>

		<div id='tab-content-about-div' class='tabcontent' style="display:none;">
			<div style="float:left;margin-top:10px;">
				<h1><?php echo $LNG->PAGE_ABOUT_TITLE; ?></h1>
				<div><?php echo $LNG->PAGE_ABOUT_BODY; ?></div>
			</div>
		</div>

		<div id='tab-content-help-div' class='tabcontent' style="display:none;">
			<?php include($HUB_FLM->getCodeDirPath("ui/helpindex.php")); ?>
		</div>
	</div>
</div>
<?php
    include_once($HUB_FLM->getCodeDirPath("ui/footer.php"));
?>
