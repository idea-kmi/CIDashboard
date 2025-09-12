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

require_once(__DIR__ . '/../../config.php');
require_once($HUB_FLM->getCodeDirPath('ui/minisdata.php'));

$url = required_param("url",PARAM_URL);
$timeout = optional_param('timeout',60,PARAM_INT);

$vis = required_param("vis",PARAM_TEXT);
$vises = explode(',', $vis);

$title = optional_param("title", "",PARAM_TEXT);

include($HUB_FLM->getCodeDirPath("ui/minislib.php"));
include_once($HUB_FLM->getCodeDirPath("ui/headerminiembed.php"));

?>
<div style="float:left;padding:5px;width:100%;height:100%">
<center>
	<h1 style="padding-top:0px;margin-top:0px;"><a href="<?php echo $url; ?>"><?php echo $title; ?></a></h1>
</center>

<?php

$inner = 0;
$rowcount = 5;
$loadString = "";

$count = 0;
if (is_countable($vises)) {
	$count = count($vises);
}

for ($i=0; $i<$count; $i++) {
	$next = $vises[$i];

	$withpostsinner = 'false';
	if (substr($next,0,1) == 'p') {
		$withpostsinner = 'true';
		$next = intval(substr($next,1));
	}

	$item = $minidata[$next-1];

	if ($item[6] == $CFG->MINI_PAGE_USER_VIEWING) {
		insertMiniUserViewing(true);
		$loadString .= 'loadUserViewingData(\''.$url.'\',\''.rawurlencode($timeout).'\', \''.$withpostsinner.'\'); ';
	} else if ($item[6] == $CFG->MINI_PAGE_USER_CONTRIBUTIONS) {
		insertMiniUserContributions(true);
		$loadString .= 'loadUserContributionData(\''.$url.'\',\''.rawurlencode($timeout).'\', \''.$withpostsinner.'\', \'false\'); ';
	} else if ($item[6] == $CFG->MINI_PAGE_HEALTH_PARTICIPATION) {
		insertMiniHealthParticipation(true);
		$loadString .= 'loadHealthParticipationData(\''.$url.'\',\''.rawurlencode($timeout).'\', \''.$withpostsinner.'\'); ';
	} else if ($item[6] == $CFG->MINI_PAGE_HEALTH_VIEWING) {
		insertMiniHealthViewing(true);
		$loadString .= 'loadHealthViewingData(\''.$url.'\',\''.rawurlencode($timeout).'\', \''.$withpostsinner.'\'); ';
	} else if ($item[6] == $CFG->MINI_PAGE_HEALTH_CONTRIBUTION) {
		insertMiniHealthContribution(true);
		$loadString .= 'loadHealthContributionData(\''.$url.'\',\''.rawurlencode($timeout).'\', \''.$withpostsinner.'\'); ';
	} else if ($item[6] == $CFG->MINI_PAGE_WORD_STATS) {
		insertMiniWordStats(true);
		$loadString .= 'loadWordStatsData(\''.$url.'\',\''.rawurlencode($timeout).'\', \''.$withpostsinner.'\'); ';
	}
}

echo '<script type="text/javascript">';
echo 'Event.observe(window, \'load\', function() {';
echo $loadString;
echo '})';
echo '</script>';

echo '</div>';

include_once($HUB_FLM->getCodeDirPath("ui/footerminiembed.php"));
?>