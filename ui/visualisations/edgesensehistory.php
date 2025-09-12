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

require_once('../../config.php');

$url = required_param('url', PARAM_URL);
$userurl = optional_param('userurl', "", PARAM_URL);
$networkonly = optional_param('networkonly', false, PARAM_BOOL);
$dashboard = optional_param('dashboard', false, PARAM_BOOL);

if ($dashboard) {
	include_once($HUB_FLM->getCodeDirPath("ui/headerdashboard.php"));
} else {
	include_once($HUB_FLM->getCodeDirPath("ui/headerembed.php"));
}

$base_url = $CFG->edgesenseServiceUrl.'catalyst_embed.html?url=';
$base_url2 = $CFG->edgesenseServiceUrl.'catalyst_embed_network.html?url=';

if (gettype($networkonly) === 'string') {
	$networkonly = $networkonly === 'true'? true: false;
}
if ($networkonly) {
	$base_url = $base_url2;
}

$finalurl = $base_url.urlencode($url);
if ($userurl != "") {
	$finalurl = $finalurl.'&userurl='.urlencode($userurl);
}
?>
<!-- meta http-equiv="refresh" content="0; URL='<?php echo $finalurl; ?>'" / -->

<div style="float:left;margin-top:10px;">
	<iframe title="<?php echo $LNG->IFRAME_EDGE_SENSE;?>" src="<?php echo $finalurl; ?>" width="600" height="1000"  style="overflow:auto" scrolling="no" frameborder="0"></iframe>
</div>

<?php
if ($dashboard) {
	include_once($HUB_FLM->getCodeDirPath("ui/footerdashboard.php"));
} else {
	include_once($HUB_FLM->getCodeDirPath("ui/footerembed.php"));
}
?>