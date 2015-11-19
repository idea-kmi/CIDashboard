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
?>
<div style="clear:both;float:left;width:100%">
	<div id="tab-content-embed-viz-div" style="clear:both;float:left;width:100%;">

		<div id="tabber" style="clear:both;float:left; width: 100%;margin-top:20px;">
			<ul id="helptabs" class="tab2">
				<li class="tab2"><a class="tab2" id="tab-help-movie" href="<?php echo $CFG->homeAddress; ?>#help-movie"><span class="tab2 tabinner"><?php echo $LNG->EMBED_INDEX_TAB_HELP_MOVIE; ?></span></a></li>
				<li class="tab2"><a class="tab2" id="tab-help-embed" href="<?php echo $CFG->homeAddress; ?>#help-embed"><span class="tab2 tabinner"><?php echo $LNG->EMBED_INDEX_TAB_HELP_EMBED; ?></span></a></li>
				<li class="tab2"><a class="tab2" id="tab-help-mini" href="<?php echo $CFG->homeAddress; ?>#help-mini"><span class="tab2 tabinner"><?php echo $LNG->EMBED_INDEX_TAB_HELP_MINI; ?></span></a></li>
				<li class="tab2"><a class="tab2" id="tab-help-alerts" href="<?php echo $CFG->homeAddress; ?>#help-alerts"><span class="tab2 tabinner"><?php echo $LNG->EMBED_INDEX_TAB_HELP_ALERT; ?></span></a></li>
				<li class="tab2"><a class="tab2" id="tab-help-cif" href="<?php echo $CFG->homeAddress; ?>#help-cif"><span class="tab2 tabinner"><?php echo $LNG->EMBED_INDEX_TAB_HELP_CIF; ?></span></a></li>
				<li class="tab2"><a class="tab2" id="tab-help-lang" href="<?php echo $CFG->homeAddress; ?>#help-lang"><span class="tab2 tabinner"><?php echo $LNG->EMBED_INDEX_TAB_HELP_LANG; ?></span></a></li>
				<li class="tab2"><a class="tab2" id="tab-help-user" href="<?php echo $CFG->homeAddress; ?>#help-user"><span class="tab2 tabinner"><?php echo $LNG->EMBED_INDEX_TAB_HELP_USER; ?></span></a></li>
			</ul>

			<div id="tab-content-help" class="tabcontentinner">

				<div id='tab-content-help-movie-div'  class='tabcontent' style="display:none;">
					<div class="tabline" style="height:2px;width:100%"></div>
					<?php
						include('ui/helpmovies.php');
					?>
				</div>
				<div id='tab-content-help-embed-div'  class='tabcontent' style="display:none;">
					<div class="tabline" style="height:2px;width:100%"></div>
					<?php
						include('ui/helpembed.php');
					?>
				</div>
				<div id='tab-content-help-mini-div'  class='tabcontent' style="display:none;">
					<div class="tabline" style="height:2px;width:100%"></div>
					<?php
						include('ui/helpmini.php');
					?>
				</div>
				<div id='tab-content-help-alerts-div'  class='tabcontent' style="display:none;">
					<div class="tabline" style="height:2px;width:100%"></div>
					<?php
						include('ui/helpalerts.php');
					?>
				</div>
				<div id='tab-content-help-cif-div'  class='tabcontent' style="display:none;">
					<div class="tabline" style="height:2px;width:100%"></div>
					<?php
						include('ui/helpcif.php');
					?>
				</div>
				<div id='tab-content-help-lang-div'  class='tabcontent' style="display:none;">
					<div class="tabline" style="height:2px;width:100%"></div>
					<?php
						include('ui/helplang.php');
					?>
				</div>
				<div id='tab-content-help-user-div'  class='tabcontent' style="display:none;">
					<div class="tabline" style="height:2px;width:100%"></div>
					<?php
						include('ui/helpuser.php');
					?>
				</div>
			</div>
		</div>
	</div>
</div>
