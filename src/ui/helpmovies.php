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

	<div style="clear:both;float:left; margin-top:20px;width:480px">
	<h2><?php echo $LNG->HELP_MOVIES_TITLE_INTRO;?><span style="font-size:9pt;padding-left:5px;color:gray">(11m 55s)</span></h2>
	<video poster="<?php echo $CFG->homeAddress; ?>ui/movies/cidashboard-intro.png" style="border:2px solid #E8E8E8" width="480px" height="360px" autobuffer="autobuffer" controls="controls">
	<source src="<?php echo $CFG->homeAddress; ?>ui/movies/cidashboard-intro.mp4" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
	</video>
	</div>

	<div style="float:left; margin-top:20px;width:480px;margin-left:20px;">
	<h2><?php echo $LNG->HELP_MOVIES_TITLE_LARGEVIS;?><span style="font-size:9pt;padding-left:5px;color:gray">(11m 55s)</span></h2>
	<video poster="<?php echo $CFG->homeAddress; ?>ui/movies/cidashboard-large-visualisations.png" style="border:2px solid #E8E8E8" width="480px" height="360px" autobuffer="autobuffer" controls="controls">
	<source src="<?php echo $CFG->homeAddress; ?>ui/movies/cidashboard-large-visualisations.mp4" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
	</video>
	</div>

	<div style="clear:both;float:left; margin-top:20px;width:480px">
	<h2><?php echo $LNG->HELP_MOVIES_TITLE_MINIVIS;?><span style="font-size:9pt;padding-left:5px;color:gray">(11m 55s)</span></h2>
	<video poster="<?php echo $CFG->homeAddress; ?>ui/movies/cidashboard-minis.png" style="border:2px solid #E8E8E8" width="480px" height="360px" autobuffer="autobuffer" controls="controls">
	<source src="<?php echo $CFG->homeAddress; ?>ui/movies/cidashboard-minis.mp4" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
	</video>
	</div>

	<div style="float:left; margin-top:20px;width:480px;margin-left:20px;">
	<h2><?php echo $LNG->HELP_MOVIES_TITLE_ALERTS;?><span style="font-size:9pt;padding-left:5px;color:gray">(11m 55s)</span></h2>
	<video poster="<?php echo $CFG->homeAddress; ?>ui/movies/cidashboard-alerts.png" style="border:2px solid #E8E8E8" width="480px" height="360px" autobuffer="autobuffer" controls="controls">
	<source src="<?php echo $CFG->homeAddress; ?>ui/movies/cidashboard-alerts.mp4" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
	</video>
	</div>

</div>
