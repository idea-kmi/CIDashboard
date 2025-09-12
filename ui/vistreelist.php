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
 ?>

<div>
	<ol class="idea-list-ol vis-tree d-flex flex-wrap justify-content-start gap-3">

	<?php
		include('visdata.php');

		$count = 0;
		if (is_countable($vistree)) {
			$count = count($vistree);
		}
		for ($i = 0; $i < $count; $i++) {
			$next = $vistree[$i];
			$item = $visdata[$next-1];

			echo '<li class="idea-list-li">';
			echo '<div class="idea-blob-list">';
			if ($i % 2) {
				echo '<div class="boxborder" style="width:500px;height:270px;">';
			} else {
				echo '<div class="boxborder" style="width:500px;height:270px;">';
			}

			//table 1
			echo '<div class="nodetable boxbackground">';
				echo '<div class="nodetablerow d-flex flex-row justify-content-start">';
					// image cell
					echo '<div class="nodetablecelltop">';
						echo '<img id="largevisimage'.$item[1].'" alt="'.$item[0].'" title="'.$item[0].'" style="padding:5px;padding-bottom:10px;" border="0" src="'.$item[3].'" />';
					echo '</div>';

					// title
					echo '<div class="nodetablecelltop" style="padding-top:5px;">';
						echo '<div style="height:210px; overflow:auto;">';
							echo '<div style="overflow-wrap:break-word;">';
								echo '<h2>'.$item[0].'</h2>';
								echo '<p>'.$item[2].'</p>';
							echo '</div>';
							echo '<div class="" style="overflow-wrap:break-word;">';
								echo '<p class="m-0 p-0"><b>'.$LNG->EMBED_VIS_DEPENDENCIES_TITLE.'</b></p>';
								echo '<p>'.$item[5].'</p>';
							echo '</div>';
						echo '</div>'; //end scrolldiv
					echo '</div>'; //end cell
				echo '</div>'; // end row
			echo '</div>'; //end table

			// table two
			echo '<div class="nodetable boxbackground viscard-footer">';
				echo '<div class="nodetablerow">';
					echo '<div class="nodetablecelltop d-flex flex-row justify-content-between align-items-center gap-2">';
						echo '<div class="card-links d-flex flex-row justify-content-between gap-2">';
							echo '<span class="active" title="'.$LNG->EMBED_INDEX_CODE_HINT.'" onclick="createEmbedVisUrl(\''.$item[4].'\',\''.$item[1].'\')">';
							echo $LNG->EMBED_INDEX_CODE_LINK.'</span>';
							echo '<span class="active" onclick="createEmbedPage(\''.$item[4].'\',\''.$item[1].'\')" title="'.$LNG->EMBED_INDEX_PAGE_HINT.'">';
							echo $LNG->EMBED_INDEX_PAGE_LINK.'</span>';
							echo '<span class="active">|</span>';
							echo '<span class="active" title="'.$LNG->EMBED_INDEX_PREVIEW_VIS_HINT.'" onclick="createEmbedVisPreview(\''.$item[4].'\', \''.$item[0].'\',\''.$item[1].'\')">';
							echo $LNG->EMBED_INDEX_PREVIEW_VIS_LINK.'</span>';
							echo '<span class="active" onclick="createEmbedDemo(\''.$item[4].'\', \''.$item[0].'\')" title="'.$LNG->EMBED_INDEX_DEMO_HINT.'">';
							echo $LNG->EMBED_INDEX_DEMO_LINK.'</span>';
						echo '</div>';

						echo '<div class="card-checkbox d-flex flex-column justify-content-between">';
							if ($item[8] === TRUE){
								echo '<div class="form-check">';
									echo '<input id="withposts'.$item[1].'" name="withposts" value="'.$item[1].'" type="checkbox" class="form-check-input" title="'.$LNG->EMBED_INDEX_INCLUDE_POSTS_HINT.'"></input>
									<label class="form-check-label" for="withposts'.$item[1].'">'.$LNG->EMBED_INDEX_INCLUDE_POSTS_LINK.'</label>';
								echo '</div>';
							}
							if ($item[1] == 13) {
								echo '<div class="form-check">';
									echo '<input id="networkonly'.$item[1].'" name="networkonly" value="'.$item[1].'" onclick="changeedgesenseimage(\''.$item[1].'\', \''.$item[3].'\')" type="checkbox" class="form-check-input" title="'.$LNG->EMBED_INDEX_COMPACT_HINT.'"></input>
									<label class="form-check-label" for="networkonly'.$item[1].'">'.$LNG->EMBED_INDEX_COMPACT_LINK.'</label>';
								echo '</div>';
							}
							echo '<div class="form-check">';
								echo '<input id="dashvises'.$item[1].'" name="dashvises" value="'.$item[1].'" onchange="toggleDashItem(this, '.$item[1].')" type="checkbox" class="form-check-input" title="'.$LNG->EMBED_INDEX_DASH_HINT.'"></input>
								<label class="form-check-label" for="dashvises'.$item[1].'">'.$LNG->EMBED_INDEX_DASH_LINK.'</label>';
							echo '</div>';
						echo '</div>';
					echo '</div>'; // end cell

					if ($item[9]) {
						echo '<div class="d-flex flex-row gap-1">';
						echo '<a href="http://cci.mit.edu/klein/deliberatorium.html" target="_blank" title="http://cci.mit.edu/klein/deliberatorium.html">';
						echo '<img src="'.$HUB_FLM->getImagePath('deliberatorium-analytics-logo.png').'" style="vertical-align:middle;width:24px; height:24px;" border="0" alt="" />';
						echo '<span style="vertical-align:middle; font-size:10pt;font-style:italic;padding-left:5px;">'.$LNG->EMBED_POWERED_BY_DELIBERATORIUM.'</span>';
						echo '</a>';
						echo '</div>';
					}
				echo '</div>'; // end row
			echo '</div>'; // end table

			echo '</div>';
			echo '</div>';
			echo '</li>';
		}
	?>
	</ol>
</div>
