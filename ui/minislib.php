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

function insertMiniUserContributions($withDiv=false) {
	global $LNG, $HUB_FLM;

	if ($withDiv) {?>
		<div style="float:left;margin:5px;">
	<?php }	?>
		<div class="boxshadowsquare" style="float:left;clear:both;padding:5px;width:315px;height:200px;">
			<div id="contribution-messagearea" style="width:100%;float:left;clear:both;padding:0px;margin:0px;"></div>
			<div id="contribution-chart-div" style="float:left;display:none;">
				<div style="clear:both;float:left;">
					<b><?php echo $LNG->EMBED_MINI_TITLE_USER_CONTRIBUTIONS; ?></b>
					<span class="active" onMouseOver="$('usercontribution-info-message').style.display='block';$('lower-usercontribution-div').style.display='none'" onMouseOut="$('usercontribution-info-message').style.display='none';$('lower-usercontribution-div').style.display='block'" onClick="$('usercontribution-info-message').style.display='none';$('lower-usercontribution-div').style.display='block'" onkeypress="enterKeyPressed(event)"><img src="<?php echo $HUB_FLM->getImagePath('info.png'); ?>" border="0" style="margin-top: 2px; margin-left: 5px;" /></span>
					<div id="usercontribution-info-message" style="clear:both;float:left;display:none;margin-top:10px;width:290px;height:170px;overflow:auto">
						<?php echo $LNG->EMBED_MINI_HELP_USER_CONTRIBUTIONS; ?>
					</div>
				</div>
				<div id="lower-usercontribution-div" style="clear:both;float:left;display:block;">
					<div id="contribution-chart" style="clear:both;float:left;width:310px;height:95px;"></div>
					<div style="float:left;clear:both;margin:0px;padding:0px;margin-bottom:10px;margin-left:40px;font-size:9pt;font-weight:bold;">
						<?php echo $LNG->MINI_USER_CONTRIBUTIONS_XAXIS_LABEL; ?>
					</div>
					<div id="contribution-chart-message" style="margin-left:10px;clear:both;float:left;width:310px;margin-top:5px;"></div>
				</div>
			</div>
		</div>
	<?php if ($withDiv) {?>
		</div>
	<?php }	?>
<?php }

function insertMiniUserViewing($withDiv=false) {
	global $LNG, $HUB_FLM;

	if ($withDiv) {?>
		<div style="float:left;margin:5px;">
	<?php }	?>
		<div class="boxshadowsquare" style="float:left;padding:5px;width:315px;height:200px;">
			<div id="viewing-messagearea" style="width:100%;float:left;clear:both;padding:0px;margin:0px;"></div>
			<div id="viewing-chart-div" style="float:left;display:none;">
				<div style="clear:both;float:left;margin-bottom:0px;">
					<b><?php echo $LNG->EMBED_MINI_TITLE_USER_VIEWING; ?></b>
					<span class="active" onMouseOver="$('userviewing-info-message').style.display='block';$('lower-userviewing-div').style.display='none'" onMouseOut="$('userviewing-info-message').style.display='none';$('lower-userviewing-div').style.display='block'" onClick="$('userviewing-info-message').style.display='none';$('lower-userviewing-div').style.display='block'" onkeypress="enterKeyPressed(event)"><img src="<?php echo $HUB_FLM->getImagePath('info.png'); ?>" border="0" style="margin-top: 2px; margin-left: 5px;" /></span>
					<div id="userviewing-info-message" style="margin-top:10px;clear:both;float:left;display:none;margin-top:10px;width:290px;height:170px;overflow:auto">
						<?php echo $LNG->EMBED_MINI_HELP_USER_VIEWING; ?>
					</div>
				</div>
				<div id="lower-userviewing-div" style="clear:both;float:left;display:block;">
					<div id="viewing-chart" style="clear:both;float:left;width:310px;height:95px;"></div>
					<div style="float:left;clear:both;margin:0px;padding:0px;margin-bottom:10px;margin-left:20px;font-size:9pt;font-weight:bold;">
						<?php echo $LNG->MINI_USER_VIEWING_XAXIS_LABEL; ?>
					</div>
					<div id="viewing-chart-message" style="margin-left:10px;clear:both;float:left;width:310px;margin-top:5px;"></div>
				</div>
			</div>
		</div>
	<?php if ($withDiv) {?>
		</div>
	<?php }	?>
<?php }

function insertMiniHealthParticipation($withDiv=false) {
	global $LNG, $HUB_FLM;

	if ($withDiv) {?>
		<div style="float:left;margin:5px;">
	<?php }	?>

		<div class="boxshadowsquare" id="health-participation" style="float:left;padding:5px;width:315px;height:200px;">
			<div id="healthparticipation-messagearea" style="width:100%;float:left;clear:both;padding:0px;margin:0px;"></div>
			<div id="health-participation-div" style="float:left;display:none;">
				<div style="clear:both;float:left;">
					<b><?php echo $LNG->STATS_OVERVIEW_HEALTH_PARTICIPATION_TITLE; ?></b>
					<span class="active" onMouseOver="$('participation-info-message').style.display='block';;$('lower-participation-div').style.display='none'" onMouseOut="$('participation-info-message').style.display='none';$('lower-participation-div').style.display='block'" onClick="$('participation-info-message').style.display='none';;$('lower-participation-div').style.display='block'" onkeypress="enterKeyPressed(event)"><img src="<?php echo $HUB_FLM->getImagePath('info.png'); ?>" border="0" style="margin-top: 2px; margin-left: 5px;" /></span>
					<div id="participation-info-message" style="margin-top:10px;clear:both;float:left;display:none;width:290px;height:170px;overflow:auto;">
						<?php echo $LNG->EMBED_MINI_HELP_HEALTH_PARTICIPATION; ?>
					</div>
				</div>
				<div id="lower-participation-div" style="clear:both;float:left;display:block;margin-top:10px;">
					<div style="clear:both;float:left;">
						<div id="health-participation-trafficlight" class="trafficlight">
							<span id="health-participation-red" class="trafficlightred"></span>
							<span id="health-participation-orange" class="trafficlightorange"></span>
							<span id="health-participation-green" class="trafficlightgreen"></span>
						</div>
						<div style="float:left;width:220px;margin-left:5px;margin-top:10px;">
							<b><span id="health-participation-count"></span></b> <span id='health-participation-message'></span><br><br>
						</div>
					</div>
					<div style="clear:both;float:left;" id='health-participation-recomendation'></div>
				</div>
			</div>
		</div>
	<?php if ($withDiv) {?>
		</div>
	<?php }	?>
<?php }

function insertMiniHealthViewing($withDiv=false) {
	global $LNG, $HUB_FLM;

	if ($withDiv) {?>
		<div style="float:left;margin:5px;">
	<?php }	?>
		<div class="boxshadowsquare" id="health-viewing" style="float:left;padding:5px;width:315px;height:200px;">
			<div id="healthviewing-messagearea" style="width:100%;float:left;clear:both;padding:0px;margin:0px;"></div>
			<div id="health-viewing-div" style="float:left;display:none;">
				<div style="clear:both;float:left;">
					<b><?php echo $LNG->EMBED_MINI_TITLE_HEALTH_VIEWING; ?></b>
					<span class="active" onMouseOver="$('viewing-info-message').style.display='block';$('lower-viewing-div').style.display='none'" onMouseOut="$('viewing-info-message').style.display='none';$('lower-viewing-div').style.display='block'" onClick="$('viewing-info-message').style.display='none';$('lower-viewing-div').style.display='block'" onkeypress="enterKeyPressed(event)"><img src="<?php echo $HUB_FLM->getImagePath('info.png'); ?>" border="0" style="margin-top: 2px; margin-left: 5px;" /></span>
					<div id="viewing-info-message" style="margin-top:10px;clear:both;float:left;display:none;width:290px;height:170px;overflow:auto">
						<?php echo $LNG->EMBED_MINI_HELP_HEALTH_VIEWING; ?>
					</div>
				</div>
				<div id="lower-viewing-div" style="clear:both;float:left;display:block;margin-top:10px;">
					<div style="clear:both;float:left;">
						<div id='health-viewing-trafficlight' class="trafficlight">
							<span id='health-viewing-red' class="trafficlightred"></span>
							<span id='health-viewing-orange' class="trafficlightorange"></span>
							<span id='health-viewing-green' class="trafficlightgreen"></span>
						</div>
						<div style="float:left;width:220px;margin-left:5px;margin-top:10px;">
							<div id="health-viewingorange-div" style="display:none">
								<b><span id="health-viewingpeople-orange-count"></span></b> <span id='health-viewing-messageorange'></span>
								<b> <span id="health-viewingitem-orange-count"></span></b> <span id='health-viewing-messageorange-part2'></span>
							</div>
							<div id="health-viewing-spacer" style="height:10px;display:none"></div>
							<div id="health-viewinggreen-div" style="display:none">
								<b><span id="health-viewingpeople-green-count"></span></b> <span id='health-viewing-messagegreen'><?php echo $LNG->STATS_OVERVIEW_HEALTH_VIEWERS; ?></span>
								<b> <span id="health-viewingitem-green-count"></span></b> <span id='health-viewing-messagegreen-part2'></span>
							</div>
						</div>
					</div>
					<div style="clear:both;float:left;" id='health-viewing-recomendation'></div>
				</div>
			</div>
		</div>
	<?php if ($withDiv) {?>
		</div>
	<?php }	?>
<?php }

function insertMiniHealthContribution($withDiv=false) {
	global $LNG, $HUB_FLM;

	if ($withDiv) {?>
		<div style="float:left;margin:5px;">
	<?php }	?>
		<div class="boxshadowsquare" id="health-debate" style="float:left;padding:5px;width:315px;height:200px;">
			<div id="healthcontribution-messagearea" style="width:100%;float:left;clear:both;padding:0px;margin:0px;"></div>
			<div id="health-contribution-div" style="float:left;display:none;">
				<div style="clear:both;float:left;">
					<b><?php echo $LNG->EMBED_MINI_TITLE_HEALTH_CONTRIBUTION; ?></b>
					<span class="active" onMouseOver="$('contribution-info-message').style.display='block';$('lower-contribution-div').style.display='none'" onMouseOut="$('contribution-info-message').style.display='none';$('lower-contribution-div').style.display='block'" onClick="$('contribution-info-message').style.display='none';$('lower-contribution-div').style.display='block'" onkeypress="enterKeyPressed(event)"><img src="<?php echo $HUB_FLM->getImagePath('info.png'); ?>" border="0" style="margin-top: 2px; margin-left: 5px;" /></span>
					<div id="contribution-info-message" style="margin-top:10px;clear:both;float:left;display:none;width:290px;height:170px;overflow:auto">
						<?php echo $LNG->EMBED_MINI_HELP_HEALTH_CONTRIBUTION; ?>
					</div>
				</div>
				<div id="lower-contribution-div" style="clear:both;float:left;display:block;margin-top:10px;">
					<div style="clear:both;float:left;">
						<div class="trafficlight" style="clear:both;float:left;">
							<span id='health-debate-red' class="trafficlightred"></span>
							<span id='health-debate-orange' class="trafficlightorange"></span>
							<span id='health-debate-green' class="trafficlightgreen"></span>
						</div>
						<div style="float:left;width:220px;margin-left:5px;margin-top:10px;">
							<div id="health-debateorange-div" style="display:none">
								<b><span id="health-debatepeople-orange-count"></span></b> <span id='health-debate-messageorange'></span>
								<b> <span id="health-debateitem-orange-count"></span></b> <span id='health-debate-messageorange-part2'></span>
							</div>
							<div id="health-debate-spacer" style="height:10px;display:none"></div>
							<div id="health-debategreen-div" style="display:none">
								<b><span id="health-debatepeople-green-count"></span></b> <span id='health-debate-messagegreen'></span>
								<b> <span id="health-debateitem-green-count"></span></b> <span id='health-debate-messagegreen-part2'></span>
							</div>
						</div>
					</div>
					<div style="clear:both;float:left;" id='health-debate-recomendation'></div>
				</div>
			</div>
		</div>
	<?php if ($withDiv) {?>
		</div>
	<?php }	?>
<?php }

function insertMiniWordStats($withDiv=false) {
	global $LNG, $HUB_FLM;

	if ($withDiv) {?>
		<div style="float:left;margin:5px;">
	<?php }	?>
		<div class="boxshadowsquare" id="health-debate" style="float:left;padding:5px;width:315px;height:200px;">
			<div id="wordstats-messagearea" style="width:100%;float:left;clear:both;padding:0px;margin:0px;"></div>
			<div id="wordstats-div" style="float:left;display:none;">
				<div style="clear:both;float:left;">
					<b><?php echo $LNG->STATS_OVERVIEW_WORDS_MESSAGE; ?></b>
					<span class="active" onMouseOver="$('wordstats-info-message').style.display='block';$('lower-wordstats-div').style.display='none'" onMouseOut="$('wordstats-info-message').style.display='none';$('lower-wordstats-div').style.display='block'" onClick="$('wordstats-info-message').style.display='none';$('lower-wordstats-div').style.display='block'" onkeypress="enterKeyPressed(event)"><img src="<?php echo $HUB_FLM->getImagePath('info.png'); ?>" border="0" style="margin-top: 2px; margin-left: 5px;" /></span>
					<div id="wordstats-info-message" style="clear:both;float:left;display:none;margin-top:10px;width:290px;height:170px;overflow:auto">
						<?php echo $LNG->EMBED_MINI_HELP_WORD_STATS; ?>
					</div>
				</div>
				<div id="lower-wordstats-div" style="clear:both;float:left;display:block;">
					<div id="wordstats-chart" style="clear:both;float:left;width:310px;height:95px;"></div>
					<div style="float:left;clear:both;margin:0px;padding:0px;margin-bottom:10px;margin-left:40px;font-size:9pt;font-weight:bold;">
						<?php echo $LNG->MINI_WORD_STATS_XAXIS_LABEL; ?>
					</div>
					<div id="lower-wordstats-div" style="clear:both;float:left;display:block;margin-top:5px;">
						<span style="float:left;clear:both;padding-left:10px;"><?php echo $LNG->MINI_WORD_STATS_AVERAGE; ?> <b><span id="average-words-count">0</span></b> <?php echo $LNG->STATS_OVERVIEW_WORDS; ?></span>
						<span style="float:left;clear:both;padding-left:10px;"><?php echo $LNG->MINI_WORD_STATS_WORDS_MIN; ?> <b><span id="min-words-count">0</span></b> <?php echo $LNG->STATS_OVERVIEW_WORDS; ?></span>
						<span style="float:left;clear:both;padding-left:10px;"><?php echo $LNG->MINI_WORD_STATS_WORDS_MAX; ?> <b><span id="max-words-count">0</span></b> <?php echo $LNG->STATS_OVERVIEW_WORDS; ?></span>
					</div>
				</div>
			</div>
		</div>
	<?php if ($withDiv) {?>
		</div>
	<?php }	?>
<?php }

function insertMiniAlerts($withDiv=false) {
	global $LNG, $HUB_FLM;

	if ($withDiv) {?>
		<div style="float:left;margin:5px;">
	<?php }	?>
		<div id="alert-box" style="float:left;padding:5px;">
			<h1 style="margin-bottom:0px;padding-bottom:0px;"><?php echo $LNG->ALERTS_BOX_TITLE; ?></h1>
			<div id="alerts-messagearea" style="width:100%;float:left;clear:both;padding:0px;margin:0px;"></div>
			<div id="alerts-div" style="float:left;">
				<div id="alerts-issue-div" style="clear:both;float:left;"></div>
				<div id="alerts-user-div" style="clear:both;float:left;margin-top:20px;"></div>
			</div>
		</div>
	<?php if ($withDiv) {?>
		</div>
	<?php }	?>
<?php }

?>

