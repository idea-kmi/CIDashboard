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

require_once('../../config.php');
require_once($HUB_FLM->getCodeDirPath("ui/alertdata.php"));

$url = required_param('url', PARAM_URL);
$userurl = optional_param('userurl', '', PARAM_URL);
$timeout = optional_param('timeout', 60, PARAM_INT);
$alerts = optional_param('alerts', "", PARAM_TEXT);
$userids = optional_param('userids', "", PARAM_TEXT);

//convert alert numbers to metric alert names
$alertsArray = explode(',', $alerts);
$count = count($alertsArray);
$alertsFinal = "";
for($i=0; $i<$count; $i++) {
	$num = $alertsArray[$i];
	$next = $alertdata[$num-1];
	$alertsFinal .= $next[3];
	if ($i < $count-1) {
		$alertsFinal .= ',';
	}
}

include($HUB_FLM->getCodeDirPath("ui/minislib.php"));
include_once($HUB_FLM->getCodeDirPath("ui/headerminiembed.php"));
?>

<script type='text/javascript'>
var NODE_ARGS = new Array();
NODE_ARGS['userurl'] = '<?php echo $userurl; ?>';
NODE_ARGS['url'] = '<?php echo rawurlencode($url); ?>';
NODE_ARGS['timeout'] = '<?php echo rawurlencode($timeout); ?>';
NODE_ARGS['alerts'] = '<?php echo rawurlencode($alertsFinal); ?>';
NODE_ARGS['userids'] = '<?php echo $userids; ?>';

function processCIFUserData(json) {
	//alert('processCIFUserData');
	if(json.error) {
		alert(json.error[0].message);
		return;
	} else {
		var userdata = "";
		var userArray = {};
		if (json['@graph']) {
			userdata = json['@graph'];

			//make into hastable for easy reference later
			for(var i=0; i<userdata.length; i++) {
				var next = userdata[i];
				if (next['@type'] == 'Agent') {
					userArray[next['@id']] = next;
				}
			}

			NODE_ARGS['userdata'] = userArray;
		}
		loadAlertsData('<?php echo $url; ?>', '<?php echo $timeout; ?>', '<?php echo $alertsFinal; ?>', NODE_ARGS['userids'], userArray);
	}
}

Event.observe(window, 'load', function() {
	var data = NODE_ARGS['data'];
	if (NODE_ARGS['userurl'] != "" && NODE_ARGS['url'] != "") {
		var s = document.createElement("script");
		s.src = NODE_ARGS['userurl']+'&callback=processCIFUserData';
		s.type = "text/javascript";
		document.body.appendChild(s);
	} else {
		loadAlertsData('<?php echo $url; ?>', '<?php echo $timeout; ?>', '<?php echo $alertsFinal; ?>', NODE_ARGS['userids'], '');
	}

});
</script>

<?php insertMiniAlerts(); ?>

<?php
include_once($HUB_FLM->getCodeDirPath("ui/footerminiembed.php"));
?>