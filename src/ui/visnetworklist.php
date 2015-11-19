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

<div style="background:transparent;clear:both; float:left; width: 100%;">
	<ol class="idea-list-ol">

	<?php
		include('visdata.php');

		$count = count($visnetwork);
		for ($i=0; $i<$count; $i++) {
			$next = $visnetwork[$i];
			$item = $visdata[$next-1];

			echo '<li class="idea-list-li" style="cursor:default;display:inline-block">';
			echo '<div class="idea-blob-list">';
			if ($i % 2) {
				echo '<div class="boxborder boxbackground" style="float:left;width:477px;height:270px;margin-bottom:10px;">';
			} else {
				echo '<div class="boxborder boxbackground" style="float:left;width:477px;height:270px;margin-right:10px;margin-bottom:10px;">';
			}

			//table 1
			echo '<div class="nodetable boxbackground" style="height:220px;padding:0px;margin:0px;">';
				echo '<div class="nodetablerow">';
					// image cell
					echo '<div class="nodetablecelltop">';
						echo '<img id="largevisimage'.$item[1].'" alt="'.$item[0].'" title="'.$item[0].'" style="padding:5px;padding-bottom:10px;" border="0" src="'.$item[3].'" />';
					echo '</div>';

					// title
					echo '<div class="nodetablecelltop" style="padding-top:5px;">';
						echo '<div style="height:210px;overflow:auto;">';
							echo '<div style="font-size:10pt;font-weight:normal;color:dimgray;overflow-wrap:break-word;margin-left:10px;margin-right:10px;">';
								echo '<h2>'.$item[0].'</h2>';
								echo $item[2];
							echo '</div>';
							echo '<div style="margin-top:10px;font-size:10pt;font-weight:normal;color:dimgray;overflow-wrap:break-word;margin-left:10px;margin-right:10px;">';
								echo '<b>'.$LNG->EMBED_VIS_DEPENDENCIES_TITLE.'</b> ';
								echo $item[5];
							echo '</div>';
						echo '</div>'; //end scrolldiv
					echo '</div>'; //end cell
				echo '</div>'; // end row
			echo '</div>'; //end table

			// table two
			echo '<div class="nodetable boxbackground" style="height:50px;width:100%;padding:0px;margin:0px;">';
				echo '<div class="nodetablerow" style="font-size:12pt;">';
					echo '<div class="nodetablecelltop">';

						echo '<div style="float:left;width:250px;font-size:11pt;">';
							echo '<span class="active" title="'.$LNG->EMBED_INDEX_CODE_HINT.'" onclick="createEmbedVisUrl(\''.$item[4].'\',\''.$item[1].'\')" style="float:left;margin:0px;padding:0px;margin-left:5px;margin-right: 10px;">';
							echo $LNG->EMBED_INDEX_CODE_LINK.'</span>';

							echo '<span class="active" onclick="createEmbedPage(\''.$item[4].'\',\''.$item[1].'\')" title="'.$LNG->EMBED_INDEX_PAGE_HINT.'" style="float:left;margin:0px;padding:0px;margin-right: 10px;">';
							echo $LNG->EMBED_INDEX_PAGE_LINK.'</span>';

							echo '<span class="active" style="float:left;cursor:pointer">|</span>';

							echo '<span class="active" title="'.$LNG->EMBED_INDEX_PREVIEW_VIS_HINT.'" onclick="createEmbedVisPreview(\''.$item[4].'\', \''.$item[0].'\',\''.$item[1].'\')" style="float:left;margin:0px;padding:0px;margin-right:10px;margin-left:10px;">';
							echo $LNG->EMBED_INDEX_PREVIEW_VIS_LINK.'</span>';

							echo '<span class="active" onclick="createEmbedDemo(\''.$item[4].'\', \''.$item[0].'\')" title="'.$LNG->EMBED_INDEX_DEMO_HINT.'" style="float:left;margin:0px;padding:0px;">';
							echo $LNG->EMBED_INDEX_DEMO_LINK.'</span>';
						echo '</div>';

						echo '<div style="float:right;width:200px;font-size:11pt;">';
							if ($item[8] === TRUE){
								echo '<input id="withposts'.$item[1].'" name"withposts" value="'.$item[1].'" type="checkbox" class="active" title="'.$LNG->EMBED_INDEX_INCLUDE_POSTS_HINT.'" style="float:right;margin:0px;padding:0px;margin-left:5px;margin-right: 10px;margin-top:5px;"></input><span style="float:right;font-size:11pt" >'.$LNG->EMBED_INDEX_INCLUDE_POSTS_LINK.'</span>';
								echo '<br>';
							}
							if ($item[1] == 13) {
								echo '<input name="networkonly" id="networkonly'.$item[1].'" value="'.$item[1].'" onclick="changeedgesenseimage(\''.$item[1].'\', \''.$item[3].'\')" type="checkbox" class="active" title="'.$LNG->EMBED_INDEX_COMPACT_HINT.'" style="float:right;margin:0px;padding:0px;margin-left:5px;margin-right: 10px;margin-top:5px;"></input><span style="float:right;font-size:11pt">'.$LNG->EMBED_INDEX_COMPACT_LINK.'</span>';
								echo '<br>';
							}
							echo '<input name="dashvises" value="'.$item[1].'" onchange="toggleDashItem(this, '.$item[1].')" type="checkbox" class="active" title="'.$LNG->EMBED_INDEX_DASH_HINT.'" style="float:right;margin:0px;padding:0px;margin-left:5px;margin-right: 10px;margin-top:5px;"></input><span style="float:right;font-size:11pt" >'.$LNG->EMBED_INDEX_DASH_LINK.'</span>';
						echo '</div>';

						if ($item[9]) {
							echo '<div style="float:left;maring:0px;padding:0px;margin-top:3px;">';
							echo '<a href="http://cci.mit.edu/klein/deliberatorium.html" target="_blank" title="http://cci.mit.edu/klein/deliberatorium.html">';
							echo '<img src="'.$HUB_FLM->getImagePath('deliberatorium-analytics-logo.png').'" style="vertical-align:middle;width:24px; height:24px;" border="0" />';
							echo '<span style="vertical-align:middle; font-size:10pt;font-style:italic;padding-left:5px;">'.$LNG->EMBED_POWERED_BY_DELIBERATORIUM.'</span>';
							echo '</a>';
							echo '</div>';
						}
						if ($item[1] == 13) {
							echo '<div style="float:left;maring:0px;padding:0px;margin-top:3px;">';
							echo '<a href="http://wikitalia.github.io/edgesense/" target="_blank" title="http://wikitalia.github.io/edgesense/">';
							echo '<span style="vertical-align:middle; font-size:10pt;font-style:italic;padding-left:5px;">'.$LNG->EMBED_POWERED_BY_EDGESENSE.'</span>';
							echo '</a>';
							echo '</div>';
						}

					echo '</div>'; // end cell
				echo '</div>'; // end row
			echo '</div>'; // end table

			echo '</div>';
			echo '</div>';
			echo '</li>';
		}
	?>
	</ol>
</div>
