<?php
	/********************************************************************************
	 *                                                                              *
	 *  (c) Copyright 2015 - 2024 The Open University UK                            *
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
	<ol class="idea-list-ol vis-tree d-flex flex-wrap justify-content-center gap-3">

		<?php
			include('alertdata.php');

			$item = array();
			$item[0] = $LNG->EMBED_MINI_TITLE_ALERTS;
			$item[1] = 0;
			$item[2] = $LNG->EMBED_MINI_DESC_ALERTS;
			$item[3] = $CFG->homeAddress."images/visualisations/alertslist2.png";
			$item[4] = $CFG->homeAddress."ui/minis/alerts.php?";
			$item[5] = $LNG->EMBED_MINI_DEPENDENT_ALERTS;

			echo '<li class="idea-list-li w-100">';
				echo '<div class="idea-blob-list">';
					echo '<div class="boxborder m-2">';

						//table 1
						echo '<div class="nodetable boxbackground">';
							echo '<div class="nodetablerow d-flex flex-row justify-content-start gap-5 py-3">';

							// left cell
								echo '<div class="nodetablecelltop">';
									echo '<img alt="'.$item[0].'" title="'.$item[0].'" src="'.$item[3].'" class="img-fluid vis-alert-img border border-1 p-2 text-center" />';

									echo '<div class="my-2 mt-4">';
										echo '<p><strong>'.$LNG->EMBED_VIS_DEPENDENCIES_TITLE.'</strong> ';
										echo $item[5].'</p>';
									echo '</div>';

									echo '<p>'.$item[2].'</p>';

									echo '<div class="mb-3 row">
											<label for="alertusers" class="col-sm-3 col-form-label">'.$LNG->EMBED_ALERT_USERS_LABEL.'</label>
											<div class="col-sm-9">
												<input type="text" class="form-control" id="alertusers" name="alertusers" placeholder="'.$LNG->EMBED_ALERT_USERS_PLACEHOLDER.'" />
											</div>
										</div>';

									echo '<div>';						
										echo '<p style="font-size:10pt;">'.$LNG->EMBED_ALERT_USERS_HELP.'</p>';
									echo '</div>';
								echo '</div>'; //end cell

								echo '<div class="nodetablecelltop">';
									echo '<h2>'.$item[0].'</h2>';
									foreach($alertsequence as $alertnext) {
										$alert = $alertdata[$alertnext-1];
										if ($alert[5]) {
											echo '<div class="form-check">';
												echo '<input id="alert-'.$alert[1].'" name="alerts" value="'.$alert[1].'" onchange="toggleDashItem(this, '.$alert[1].')" type="checkbox" class="form-check-input" title="'.$alert[2].'"></input>
												<label class="form-check-label" for="alert-'.$alert[1].'" style="cursor: pointer;">'.$alert[0].'</label>';
											echo '</div>';
										}
									}
								echo '</div>'; //end cell
							echo '</div>'; // end row
						echo '</div>'; //end table

						// table two
						echo '<div class="nodetable boxbackground viscard-footer">';
							echo '<div class="nodetablerow">';
								echo '<div class="nodetablecelltop d-flex flex-row justify-content-between align-items-center gap-2">';
									echo '<div class="card-links d-flex flex-row justify-content-between gap-2">';
										echo '<span class="active" title="'.$LNG->EMBED_INDEX_CODE_HINT.'" onclick="createAlertEmbedVisUrl(\''.$item[4].'\',\''.$item[1].'\')">';
										echo $LNG->EMBED_INDEX_CODE_LINK.'</span>';
										echo '<span class="active" onclick="createEmbedPage(\''.$item[4].'\',\''.$item[1].'\')" title="'.$LNG->EMBED_INDEX_PAGE_HINT.'">';
										echo $LNG->EMBED_INDEX_PAGE_LINK.'</span>';
										echo '<span class="active">|</span>';
										echo '<span class="active" title="'.$LNG->EMBED_INDEX_PREVIEW_VIS_HINT.'" onclick="createAlertEmbedVisPreview(\''.$item[4].'\', \''.$item[0].'\',\''.$item[1].'\')">';
										echo $LNG->EMBED_INDEX_PREVIEW_VIS_LINK.'</span>';
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
