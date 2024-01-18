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

	include('visdata.php');
?>

<div>
	<div id="tabber">
		<ol id="sortabledashboard" class="sortabledashboard idea-list-ol border boxshadowsquare p-3 d-flex flex-wrap gap-2">
			<?php
				$count = 0;
				if (is_countable($vissequence)) {
					$count = count($vissequence);
				}

				for ($i=0; $i<$count; $i++) {
					$next = $vissequence[$i];
					$item = $visdata[$next-1];
					echo '<li class="idea-list-li" id="visdash-'.$item[1].'" name="visdash" style="display:none;">';
					echo '<div class="visdash boxborder boxbackground p-2 m-0 text-center">';
					echo '<div>';
					echo '<h2 class="fw-bold" style="font-size:10pt">'.$item[0].'</h2>';
					echo '<img id="dashimg'.$item[1].'" alt="'.$item[0].'" title="'.$item[0].'" style="height:80px;padding:5px;" border="0" src="'.$item[3].'" />';
					echo '</div>';
					echo '</div>';
					echo '</li>';
				}
			?>

			<div id="visdashhelp" class="p-2" style="display:none"><?php echo $LNG->EMBED_INDEX_DASH_MESSAGE3; ?></div>
		</ol>
	</div>
</div>
