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

$page = optional_param("page","home",PARAM_TEXT);

$width = optional_param("width",1000,PARAM_INT);
$height = optional_param("height",1000,PARAM_INT);

$url = required_param("url",PARAM_URL);
$userurl = required_param("userurl",PARAM_URL);
$langurl = optional_param('langurl', '', PARAM_URL);

$vis = required_param("vis",PARAM_TEXT);
$vises = split(',', $vis);

$dashtitle = optional_param("title", "",PARAM_TEXT);
?>

<?php if ($dashtitle != "") { ?>
	<center>
		<h1 style="padding-top:0px;margin-top:0px;"><a href="<?php echo $url; ?>"><?php echo $dashtitle; ?></a></h1>
	</center>
<?php }?>

<div id="tabber" style="margin-left:10px;clear:both;float:left; width: 100%;">
	<ul id="tabs" class="tab3">
		<li class="tab3">
			<a class="tab3 <?php if ($page == "home") { echo 'current'; } else { echo 'unselected'; } ?>" href="index.php?vis=<?php echo rawurlencode($vis); ?>&title=<?php echo rawurlencode($dashtitle);?>&page=home&url=<?php echo rawurlencode($url);?>&userurl=<?php echo rawurlencode($userurl); ?>&langurl=<?php echo rawurlencode($langurl); ?>"><span class="tab3"><?php echo $LNG->STATS_TAB_HOME; ?></span></a>
		</li>

<?php
$count = count($vises);
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

	$item = $visdata[$next-1];

	echo '<li class="tab3">';
	echo '<a class="tab3 ';
	if ($page == $item[6]) {
		echo 'current';
	} else {
		echo 'unselected';
	}
	if ($item[1] == 13) {
		echo '" href="'.$item[4].'dashboard=true&height='.$height.'&width='.$width.'&networkonly='.$networkonly.'&vis='.rawurlencode($vis).'&title='.rawurlencode($dashtitle).'&page='.$item[6];
	} else {
		echo '" href="'.$item[4].'dashboard=true&height='.$height.'&width='.$width.'&withposts='.$withpostsinner.'&vis='.rawurlencode($vis).'&title='.rawurlencode($dashtitle).'&page='.$item[6];
	}
	if ($langurl != '') {
		echo '&langurl='.rawurlencode($langurl);
	}
	echo '&userurl='.rawurlencode($userurl).'&url='.rawurlencode($url).'"><span class="tab3">'.$item[0];
	echo '</span></a>';
	echo '</li>';
} ?>
	</ul>
</div>

