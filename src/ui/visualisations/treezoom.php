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

require_once('../../config.php');
require_once($HUB_FLM->getCodeDirPath("core/embedlib.php"));

$url = required_param('url', PARAM_URL);
$withposts = optional_param('withposts', false, PARAM_BOOL);
$timeout = optional_param('timeout', 60, PARAM_INT);
$withtitle = optional_param('withtitle', true, PARAM_BOOL);
$withdesc = optional_param('withdesc', true, PARAM_BOOL);
$dashboard = optional_param('dashboard', false, PARAM_BOOL);

$json = getNetworkDataD32($url, $timeout, $withposts);

if ($dashboard) {
	include_once($HUB_FLM->getCodeDirPath("ui/headerdashboard.php"));
} else {
	include_once($HUB_FLM->getCodeDirPath("ui/headerembed.php"));
}
?>
<style type="text/css">
.nodez {
	cursor: pointer;
}

.overlay {
	/*background-color:#EEE;*/
}

.nodez text {
	font-size:10px;
	font-family:sans-serif;
	font-weight: normal;
}

.link {
	fill: none;
}

div.tooltip {
    position: absolute;
    text-align: left;
    background: #FFFFEF;
    width: 300px;
    height: 210px;
    padding: 10px;
    border: 1px solid #D5D5D5;
    font-family: arial,helvetica,sans-serif;
    font-size: 1.1em;
    border-radius: 3px;
    background: rgba(255,255,255,0.9);
    color: #000;
    /*opacity: 0;*/
    display:none;
    box-shadow: 0 1px 5px rgba(0,0,0,0.4);
    border:1px solid rgba(200,200,200,0.85);
	overflow-y:auto;
}
</style>

<script type='text/javascript'>
var NODE_ARGS = new Array();

Event.observe(window, 'load', function() {
	NODE_ARGS['jsondata'] = <?php echo $json; ?>;

	var bObj = new JSONscriptRequest('<?php echo $HUB_FLM->getCodeWebPath("ui/networkmaps/embed-tree.js.php"); ?>');
    bObj.buildScriptTag();
    bObj.addScriptTag();
});
</script>

<div class="vishelpdiv">
	<?php if ($withtitle) { ?>
	<h1 class="vishelpheading"><?php echo $LNG->STATS_VIS_TITLE_TREE; ?>
		<span><img class="vishelparrow" title="<?php echo $LNG->STATS_HELP_HINT; ?>" onclick="if($('vishelp').style.display == 'none') { this.src='<?php echo $HUB_FLM->getImagePath('uparrowbig.gif'); ?>'; $('vishelp').style.display='block'; } else {this.src='<?php echo $HUB_FLM->getImagePath('rightarrowbig.gif'); ?>'; $('vishelp').style.display='none'; }" src="<?php echo $HUB_FLM->getImagePath('uparrowbig.gif'); ?>"/></span>
	</h1>
	<?php } ?>
	<?php if ($withdesc) { ?>
		<div class="boxshadowsquare" id="vishelp" class="vishelpmessage"><?php echo $LNG->STATS_VIS_HELP_TREE; ?></div>
	<?php } ?>

	<div>
		<div style="float:left;margin-right:5px;"><button id="treeexpandall"><?php echo $LNG->TREE_EXPAND_ALL; ?></buton></div>
		<div style="float:left;margin-right:10px;"><button id="treecollapseall"><?php echo $LNG->TREE_COLLAPSE_ALL; ?></buton></div>
		<!--div style="float:left;margin-right:10px;width:500px;height:30px;" id="legenddiv"></div -->
	</div>

	<div id="toolTip" class="tooltip">
		<div id="titlediv"><img id="nodeimg" border="0" style="padding-right:5px;vertical-align:middle;width:20px;height:20px;display:none;" align="left" src=""><span class="wordwrap" style="overlfow:hidden;display:block;font-weight:bold; font-size: 14pt" id="nodename"><span></div>
		<div style="clear:both;overflow-y:margin-top:5px;margin-bottom:10px;" id="nodedesc"></div>
		<div style="margin-bottom:10px;font-weight:10px;" id="childcountdiv"><?php echo $LNG->TREE_CHILD_COUNT; ?> <span id="childcount">0</span></div>
		<button title="<?php echo $LNG->TREE_HOMEPAGE_HINT; ?>" id="explorebutton" style="clear:both;float:left;display:none;margin-bottom:5px;"><?php echo $LNG->TREE_HOMEPAGE_TEXT; ?></button>
	</div>

	<div id="tree-div" class="vismaindiv"></div>
</div>

<?php
if ($dashboard) {
	include_once($HUB_FLM->getCodeDirPath("ui/footerdashboard.php"));
} else {
	include_once($HUB_FLM->getCodeDirPath("ui/footerembed.php"));
}
?>