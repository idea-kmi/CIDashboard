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

<div class="boxbackground" style="clear:both; float:left; width: 100%;">
	<?php
		include('visdata.php');

		$count = count($vissequence);
		for ($i=0; $i<$count; $i++) {
			$next = $vissequence[$i];
			$item = $visdata[$next-1];
			echo '<div style="float:left;padding:5px;padding-bottom:10px;"><img id="largevisimage'.$item[1].'" alt="'.$item[0].'" title="'.$item[0].'" style="loat:left;height:60px;border:1px solid #e8e8e8;" border="0" src="'.$item[3].'" /></div>';
		}
	?>
</div>
