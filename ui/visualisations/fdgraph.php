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
/**
 * @author Michelle Bachler
 */
require_once('../../config.php');

$url = required_param('url', PARAM_URL);
$userurl = optional_param('userurl', '', PARAM_URL);
$withposts = optional_param('withposts', false, PARAM_BOOL);
$timeout = optional_param('timeout', 60, PARAM_INT);
$width = optional_param("width",1000,PARAM_INT);
$height = optional_param("height",1000,PARAM_INT);
$withtitle = optional_param('withtitle', true, PARAM_BOOL);
$withdesc = optional_param('withdesc', true, PARAM_BOOL);
$dashboard = optional_param('dashboard', false, PARAM_BOOL);

// need to call for the visualisation data first to create the userid for the second call for litemap and debatehub.
// As results are cashed the first time it is not too wasteful to call it again from the vis
// But probably need to rethink this really.

require_once($HUB_FLM->getCodeDirPath("core/io/catalyst/catalyst_jsonld_reader.class.php"));
$withhistory = optional_param('withhistory',false,PARAM_BOOL);
$withvotes = optional_param('withvotes',false,PARAM_BOOL);
$reader = new catalyst_jsonld_reader();
$reader = $reader->load($url,$timeout,$withhistory,$withvotes,$withposts);

if ($dashboard) {
	include_once($HUB_FLM->getCodeDirPath("ui/headerdashboard.php"));
} else {
	include_once($HUB_FLM->getCodeDirPath("ui/headerembed.php"));
}
?>

<script type='text/javascript'>
var NODE_ARGS = new Array();
NODE_ARGS['userurl'] = '<?php echo $userurl; ?>';
NODE_ARGS['url'] = '<?php echo rawurlencode($url); ?>';
NODE_ARGS['withposts'] = '<?php echo rawurlencode($withposts); ?>';
NODE_ARGS['timeout'] = '<?php echo rawurlencode($timeout); ?>';

var frameheight=<?php echo $height; ?>;
var framewidth=<?php echo $width; ?>;

function processCIFUserData(json) {
	//alert('processCIFUserData');
	if(json.error) {
		alert(json.error[0].message);
		return;
	} else {
		var userArray = loadUserUnobfuscationData(json);
		NODE_ARGS['userdata'] = userArray;

		addScriptDynamically('<?php echo $HUB_FLM->getCodeWebPath("ui/networkmaps/embed-net.js.php"); ?>', 'net-script');
	}
}

Event.observe(window, 'load', function() {
	//alert(NODE_ARGS['userurl']);

	var data = NODE_ARGS['data'];
	if (NODE_ARGS['userurl'] != "" && NODE_ARGS['url'] != "") {
		//$('messagearea').update(getLoadingLine("<?php echo $LNG->LOADING_DATA; ?>"));
		var s = document.createElement("script");
		s.src = NODE_ARGS['userurl']+'&callback=processCIFUserData';
		s.type = "text/javascript";
		document.body.appendChild(s);
	} else {
		//$('messagearea').update(getLoadingLine("<?php echo $LNG->LOADING_DATA; ?>"));

		addScriptDynamically('<?php echo $HUB_FLM->getCodeWebPath("ui/networkmaps/embed-net.js.php"); ?>', 'net-script');
	}
});
</script>

<div id="visheader" class="vishelpdivgraph">
	<?php if ($withtitle) { ?>
	<h1 class="vishelpheading"><?php echo $LNG->STATS_VIS_TITLE_NETWORK; ?>
		<span><img class="vishelparrow" title="<?php echo $LNG->STATS_HELP_HINT; ?>" onclick="if($('vishelp').style.display == 'none') { this.src='<?php echo $HUB_FLM->getImagePath('uparrowbig.gif'); ?>'; $('vishelp').style.display='block'; } else {this.src='<?php echo $HUB_FLM->getImagePath('rightarrowbig.gif'); ?>'; $('vishelp').style.display='none'; }" src="<?php echo $HUB_FLM->getImagePath('uparrowbig.gif'); ?>"/></span>
	</h1>
	<?php } ?>
	<?php if ($withdesc) { ?>
	<div class="boxshadowsquare" id="vishelp" class="vishelpmessage"><?php echo $LNG->STATS_VIS_HELP_NETWORK; ?></div>
	<?php } ?>
</div>
<div id="net-embed-div" class="vismaindiv" style="margin-left:10px;"></div>

<?php
if ($dashboard) {
	include_once($HUB_FLM->getCodeDirPath("ui/footerdashboard.php"));
} else {
	include_once($HUB_FLM->getCodeDirPath("ui/footerembed.php"));
}
?>