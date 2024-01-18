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

include('minisdata.php');
?>

<div style="background:transparent;clear:both; float:left; width: 100%;">
	<div id="tabber" style="clear:both;float:left; width: 100%;">
		<ol id="minisortabledashboard" class="idea-list-ol boxshadowsquare" style="background-color:transparent;float:left;min-height:160px;padding-top:15px;width:100%">
		<?php
			foreach($minidata as $item) {
				echo '<li class="idea-list-li" style="float:left;">';

				echo '<div id="minidash-'.$item[1].'" name="minidash" class="boxborder boxbackground" style="display:none;width:150px;float:left;height:150px;padding:0px;margin:0px;margin-left:10px;margin-bottom:10px;">';

				echo '<center>';
				echo '<div style="padding:5px;">';
				echo '<h2 style="padding-left:5px;font-size:10pt">'.$item[0].'</h2>';
				echo '<img alt="'.$item[0].'" title="'.$item[0].'" style="height:80px;padding-bottom:10px;" border="0" src="'.$item[3].'" />';
				echo '</div>';
				echo '</center>';

				echo '</div>';

				echo '</li>';
			}
		?>
		</ol>
	</div>
</div>
