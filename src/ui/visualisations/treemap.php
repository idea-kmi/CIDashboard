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

$json = getNetworkDataD3($url, $timeout, $withposts);

if ($dashboard) {
	include_once($HUB_FLM->getCodeDirPath("ui/headerdashboard.php"));
} else {
	include_once($HUB_FLM->getCodeDirPath("ui/headerembed.php"));
}
?>
<style type="text/css">
   body {
		overflow: hidden;
		margin: 0;
		font-size: 12px;
		font-family: "Helvetica Neue", Helvetica;
	}

	rect {
		pointer-events: all;
		cursor: pointer;
		stroke: #EEEEEE;
	}

	.chart {
		display: block;
		margin: auto;
	}

	.parent .label {
		color: #FFFFFF;
		text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);
		-webkit-text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);
		-moz-text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);
	}

	.labelbody {
		background: transparent;
	}

	.label {
		margin: 2px;
		white-space: pre;
		overflow: hidden;
		text-overflow: ellipsis;
		text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);
		-webkit-text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);
		-moz-text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.3);
	}

	.child .label {
		white-space: pre-wrap;
		text-align: center;
		text-overflow: ellipsis;
	}

	.cell {
		font-size: 11px;
		cursor: pointer
	}
</style>

<script type='text/javascript'>
var NODE_ARGS = new Array();

Event.observe(window, 'load', function() {
	NODE_ARGS['jsondata'] = <?php echo $json; ?>;

	var bObj = new JSONscriptRequest('<?php echo $HUB_FLM->getCodeWebPath("ui/networkmaps/embed-treemap.js.php"); ?>');
    bObj.buildScriptTag();
    bObj.addScriptTag();
});
</script>

<div class="vishelpdiv">
	<?php if ($withtitle) { ?>
	<h1 class="vishelpheading"><?php echo $LNG->STATS_VIS_TITLE_TREEMAP; ?>
		<span><img class="vishelparrow" title="<?php echo $LNG->STATS_HELP_HINT; ?>" onclick="if($('vishelp').style.display == 'none') { this.src='<?php echo $HUB_FLM->getImagePath('uparrowbig.gif'); ?>'; $('vishelp').style.display='block'; } else {this.src='<?php echo $HUB_FLM->getImagePath('rightarrowbig.gif'); ?>'; $('vishelp').style.display='none'; }" src="<?php echo $HUB_FLM->getImagePath('uparrowbig.gif'); ?>"/></span>
	</h1>
	<?php } ?>
	<?php if ($withdesc) { ?>
	<div class="boxshadowsquare" id="vishelp" class="vishelpmessage"><?php echo $LNG->STATS_VIS_HELP_TREEMAP; ?></div>
	<?php } ?>

	<div id="treemap-div" class="vismaindiv"></div>
</div>

<?php
if ($dashboard) {
	include_once($HUB_FLM->getCodeDirPath("ui/footerdashboard.php"));
} else {
	include_once($HUB_FLM->getCodeDirPath("ui/footerembed.php"));
}
?>