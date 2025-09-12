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

require_once('../../config.php');

// override lang if supplied.
$langurl = optional_param('langurl', '', PARAM_URL);
if ($langurl != '') {
	overrideLanguageCore($langurl);
}

require_once($HUB_FLM->getEmbedLib());

$url = required_param('url', PARAM_URL);
$withposts = optional_param('withposts', false, PARAM_BOOL);
$timeout = optional_param('timeout', 60, PARAM_INT);
$data = getActivityAnalysisData($url,$timeout,$withposts);
$withtitle = optional_param('withtitle', true, PARAM_BOOL);
$withdesc = optional_param('withdesc', true, PARAM_BOOL);
$dashboard = optional_param('dashboard', false, PARAM_BOOL);

if ($dashboard) {
	include_once($HUB_FLM->getCodeDirPath("ui/headerdashboard.php"));
} else {
	include_once($HUB_FLM->getCodeDirPath("ui/headerembed.php"));
}
?>
<script type='text/javascript'>
var NODE_ARGS = new Array();

Event.observe(window, 'load', function() {
	NODE_ARGS['data'] = <?php echo json_encode($data, JSON_INVALID_UTF8_IGNORE); ?>;

	$('messagearea').update(getLoadingLine("<?php echo $LNG->LOADING_DATA; ?>"));
	var data = NODE_ARGS['data'];
 	if (data != "") {
		displayActivityCrossFilterD3Vis(data, 980);
	} else {
		$('messagearea').innerHTML="<?php echo $LNG->NETWORKMAPS_NO_RESULTS_MESSAGE; ?>";
	}
});
</script>

<div class="vishelpdiv">
	<?php if ($withtitle) { ?>
	<h1 class="vishelpheading"><?php echo $LNG->STATS_VIS_TITLE_ACTIVITY; ?>
		<span><img class="vishelparrow" title="<?php echo $LNG->STATS_HELP_HINT; ?>" onclick="if($('vishelp').style.display == 'none') { this.src='<?php echo $HUB_FLM->getImagePath('uparrowbig.gif'); ?>'; $('vishelp').style.display='block'; } else {this.src='<?php echo $HUB_FLM->getImagePath('rightarrowbig.gif'); ?>'; $('vishelp').style.display='none'; }" src="<?php echo $HUB_FLM->getImagePath('uparrowbig.gif'); ?>"/></span>
	</h1>
	<?php } ?>
	<?php if ($withdesc) { ?>
	<div class="boxshadowsquare" id="vishelp" class="vishelpmessage"><?php echo $LNG->STATS_VIS_HELP_ACTIVITY; ?></div>
	<?php } ?>
</div>

<div style="clear:both;float:left;padding:5px;">
	<div id="messagearea"></div>

	<div style="clear:both;float:left;width:100%;">
	  <div style="clear:both;float:left;height:260px;" id="date-chart">
		<div class="title"><?php echo $LNG->STATS_ACTIVITY_FILTER_DATE_TITLE; ?></div>
	  </div>
	  <div style="clear:both;float:left;height:200px;width:200px;" id="days-of-week-chart">
		<div class="title"><?php echo $LNG->STATS_ACTIVITY_FILTER_DAYS_TITLE; ?></div>
	  </div>
	  <div style="float:left;height:200px;width:200px;width:200px;margin-left:20px;" id="nodetype-chart">
		<div class="title"><?php echo $LNG->STATS_ACTIVITY_FILTER_ITEM_TYPES_TITLE; ?></div>
	  </div>
	  <div style="float:left;height:200px;margin-left:20px;" id="type-chart">
		<div class="title"><?php echo $LNG->STATS_ACTIVITY_FILTER_TYPES_TITLE; ?></div>
	  </div>
	</div>

	<div style="clear:both;float:left;margin-top:30px;">
		<div id="data-count">
			<span class="filter-count"></span> <?php echo $LNG->STATS_ACTIVITY_SELECTED_COUNT_MESSAGE_PART1; ?> <span class="total-count"></span> <?php echo $LNG->STATS_ACTIVITY_SELECTED_COUNT_MESSAGE_PART2; ?> | <a
				href="javascript:dc.filterAll(); dc.renderAll();"><?php echo $LNG->STATS_ACTIVITY_RESET_ALL_BUTTON; ?></a>
		</div>
		<div style="clear:both;float:left;overflow:auto;height:250px;width:940px">
			<table id="data-table" class="table table-hover dc-data-table" style="clear:both;float:left;width:900px">
				<thead>
				<tr class="header">
					<th width="20%"><?php echo $LNG->STATS_ACTIVITY_COLUMN_DATE; ?></th>
					<th width="50%"><?php echo $LNG->STATS_ACTIVITY_COLUMN_TITLE; ?></th>
					<th width="15%"><?php echo $LNG->STATS_ACTIVITY_COLUMN_ITEM_TYPE; ?></th>
					<th width="15%"><?php echo $LNG->STATS_ACTIVITY_COLUMN_TYPE; ?></th>
				</tr>
				</thead>
			</table>
		</div>
	</div>
</div>

<?php
if ($dashboard) {
	include_once($HUB_FLM->getCodeDirPath("ui/footerdashboard.php"));
} else {
	include_once($HUB_FLM->getCodeDirPath("ui/footerembed.php"));
}
?>