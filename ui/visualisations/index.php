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
include_once('../../ui/visdata.php');

$width = optional_param("width",1000,PARAM_INT);
$height = optional_param("height",1000,PARAM_INT);

$page = optional_param("page","home",PARAM_TEXT);
$url = required_param("url",PARAM_URL);
$userurl = required_param("userurl",PARAM_URL);
$langurl = optional_param('langurl', '', PARAM_URL);

$count = 0;
if (is_countable($visdata)) {
	$count = count($visdata);
}
for ($i=0; $i<$count; $i++) {
	$item = $visdata[$i];
	if ($page == $item[6]) {
        header('Location: '.$item[4].'?dashboard=true&'.$_SERVER['QUERY_STRING']);
        die();
	}
}

include_once($HUB_FLM->getCodeDirPath("ui/headerdashboard.php"));
?>

<table cellspacing="10" style="margin: 0 auto;border-spacing:5px 5px;width: 700px;">

<?php
$inner = 0;
$rowcount = 5;
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
	$networkonly = 'false';
	if (substr($next,0,1) == 'c') {
		$networkonly = 'true';
		$next = intval(substr($next,1));
	}

	$next = intval($next);

	$item = $visdata[$next-1];

	if ($inner == 0) {
		echo '<tr>';
	}

	$inner++;
	echo '<td width="50%">';
	if ($item[1] == 13) {
		echo '<a class="tab current" href="'.$item[4].'dashboard=true&networkonly='.$networkonly.'&height='.$height.'&width='.$width.'&vis='.rawurlencode($vis).'&title='.rawurlencode($dashtitle).'&page='.$item[6].'&userurl='.rawurlencode($userurl).'&url='.rawurlencode($url).'&langurl='.rawurlencode($langurl).'">';
	} else {
		echo '<a class="tab current" href="'.$item[4].'dashboard=true&height='.$height.'&width='.$width.'&withposts='.$withpostsinner.'&vis='.rawurlencode($vis).'&title='.rawurlencode($dashtitle).'&page='.$item[6].'&userurl='.rawurlencode($userurl).'&url='.rawurlencode($url).'&langurl='.rawurlencode($langurl).'">';
	}
	echo '<div style="width:177px;height:180px;padding:5px; font-weight:bold;" class="plainbackgradient plainborder curvedBorder homebutton1">';
	echo '<div style="padding:0px;"><center><h2 style="font-size:11pt">';
	echo $item[0].'</h2></center></div>';
	echo '<div style="margin: 0 auto; width:'.$item[7].'px;margin-bottom:5px;">';
	if ($item[1] == 13 && $networkonly == 'true') {
		echo '<img src="'.str_replace('-sm','-mini', $item[3]).'" width="'.$item[7].'" border="0" />';
	} else {
		echo '<img src="'.$item[3].'" width="'.$item[7].'" border="0" />';
	}
	echo '</div></div></a>';
	echo '</td>';

	if ($inner == $rowcount || $i == $count) {
		echo '</tr>';
		$inner = 0;
	}
} ?>

</table>

<?php
	include_once($HUB_FLM->getCodeDirPath("ui/footerdashboard.php"));
?>