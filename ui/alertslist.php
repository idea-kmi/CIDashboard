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

<div style="background:transparent;clear:both;float:left;width: 100%;">
	<ol class="idea-list-ol">

	<?php
		include('alertdata.php');

		$item = array();
		$item[0] = $LNG->EMBED_MINI_TITLE_ALERTS;
		$item[1] = 0;
		$item[2] = $LNG->EMBED_MINI_DESC_ALERTS;
		$item[3] = $CFG->homeAddress."images/visualisations/alertslist2.png";
		$item[4] = $CFG->homeAddress."ui/minis/alerts.php?";
		$item[5] = $LNG->EMBED_MINI_DEPENDENT_ALERTS;

		echo '<li class="idea-list-li" style="cursor:default;">';
		echo '<div class="idea-blob-list">';
		echo '<div class="boxborder" style="float:left;width:100%;margin-right:10px;margin-bottom:10px;">';

		//table 1
		echo '<div class="nodetable boxbackground" style="float:left;height:170px;padding:0px;margin:0px;">';
		echo '<div class="nodetablerow">';

		// left cell
		echo '<div class="nodetablecelltop" style="width:33%">';
		echo '<img alt="'.$item[0].'" title="'.$item[0].'" style="border:1px solid #E8E8E8;float:left;margin:5px;margin-bottom:10px;" src="'.$item[3].'" />';

		echo '<div style="float:left;clear:both;margin-top:10px;font-size:10pt;font-weight:normal;color:dimgray;overflow-wrap:break-word;margin-left:10px;margin-right:10px;">';
		echo '<b>'.$LNG->EMBED_VIS_DEPENDENCIES_TITLE.'</b> ';
		echo $item[5];
		echo '</div>';

		echo '<div style="clear:both;float:left;margin-top:10px;font-size:10pt;font-weight:normal;color:dimgray;overflow-wrap:break-word;margin-left:10px;margin-right:10px;">';
		echo $item[2];
		echo '</div>';

		echo '<div style="clear:both;float:left;font-size:11pt;margin:10px;margin-top:20px;">';
			echo '<label for="alertusers" style="font-weight:bold;padding-right:5px;">'.$LNG->EMBED_ALERT_USERS_LABEL.'</label>';
			echo '<input id="alertusers" name="alertusers" placeholder="'.$LNG->EMBED_ALERT_USERS_PLACEHOLDER.'" style="width:450px;"></input>';
			echo '<br><span style="font-size:10pt;">'.$LNG->EMBED_ALERT_USERS_HELP.'</span>';
		echo '</div>';

		echo '</div>'; //end cell

		echo '<div class="nodetablecelltop" style="padding:5px;width:33%">';
		echo '<h2>'.$item[0].'</h2>';
		foreach($alertsequence as $alertnext) {
			$alert = $alertdata[$alertnext-1];
			if ($alert[5]) {
				echo '<div style="float;left;clear:both" title="'.$alert[2].'"><input id="alert-'.$alert[1].'" name="alerts" value="'.$alert[1].'" type="checkbox" class="active" style="float:left;margin:0px;padding:0px;margin-left:5px;margin-right: 10px;margin-top:3px;"></input><span style="float:left;font-size:11pt" >'.$alert[0].'</span></div>';
			}
			/*if (!$alert[5]) {
				echo '<div style="float;left;clear:both" title="'.$alert[2].'"><input disabled id="alert-'.$alert[1].'" name="alerts" value="'.$alert[1].'" type="checkbox" class="active" style="float:left;margin:0px;padding:0px;margin-left:5px;margin-right: 10px;margin-top:3px;"></input><span style="float:left;font-size:11pt;color:#c0c0c0;" >'.$alert[0].'</span></div>';
			} else {
				echo '<div style="float;left;clear:both" title="'.$alert[2].'"><input id="alert-'.$alert[1].'" name="alerts" value="'.$alert[1].'" type="checkbox" class="active" style="float:left;margin:0px;padding:0px;margin-left:5px;margin-right: 10px;margin-top:3px;"></input><span style="float:left;font-size:11pt" >'.$alert[0].'</span></div>';
			}*/
		}
		echo '</div>'; //end cell

		echo '</div>'; // end row
		echo '</div>'; //end table

		// table two
		echo '<div class="nodetable boxbackground" style="height:50px;width:100%;padding:0px;margin:0px;border-top:1px solid gray;padding-top:5px;">';
		echo '<div class="nodetablerow" style="font-size:12pt;">';
		echo '<div class="nodetablecelltop" style="padding-bottom:5px;">';

		echo '<div style="float:left;width:250px;font-size:11pt;">';
			echo '<span class="active" title="'.$LNG->EMBED_INDEX_CODE_HINT.'" onclick="createAlertEmbedVisUrl(\''.$item[4].'\',\''.$item[1].'\')" style="float:left;margin:0px;padding:0px;margin-left:5px;margin-right: 10px;">';
			echo $LNG->EMBED_INDEX_CODE_LINK.'</span>';

			echo '<span class="active" onclick="createEmbedPage(\''.$item[4].'\',\''.$item[1].'\')" title="'.$LNG->EMBED_INDEX_PAGE_HINT.'" style="float:left;margin:0px;padding:0px;margin-right: 10px;">';
			echo $LNG->EMBED_INDEX_PAGE_LINK.'</span>';

			echo '<span class="active" style="float:left;cursor:pointer">|</span>';

			echo '<span class="active" title="'.$LNG->EMBED_INDEX_PREVIEW_VIS_HINT.'" onclick="createAlertEmbedVisPreview(\''.$item[4].'\', \''.$item[0].'\',\''.$item[1].'\')" style="float:left;margin:0px;padding:0px;margin-right:10px;margin-left:10px;">';
			echo $LNG->EMBED_INDEX_PREVIEW_VIS_LINK.'</span>';

			//echo '<span class="active" onclick="createAlertEmbedDemo(\''.$item[4].'\', \''.$item[0].'\', \''.$item[1].'\')" title="'.$LNG->EMBED_INDEX_DEMO_HINT.'" style="float:left;margin:0px;padding:0px;">';
			//echo $LNG->EMBED_INDEX_DEMO_LINK.'</span>';
		echo '</div>';

		echo '</div>'; // end cell
		echo '</div>'; // end row
		echo '</div>'; // end table

		echo '</div>';
		echo '</div>';
		echo '</li>';
	?>
	</ol>
</div>
