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

require_once(__DIR__ . '/../../config.php');

$url = required_param('url', PARAM_URL);
$withposts = optional_param('miniwithposts', false, PARAM_BOOL);
$timeout = optional_param('timeout', 60, PARAM_INT);

include($HUB_FLM->getCodeDirPath("ui/minislib.php"));
include_once($HUB_FLM->getCodeDirPath("ui/headerminiembed.php"));
?>

<script type='text/javascript'>

Event.observe(window, 'load', function() {
	loadHealthContributionData('<?php echo $url; ?>', '<?php echo $timeout; ?>', '<?php echo $withposts; ?>');
});
</script>

<?php insertMiniHealthContribution(); ?>

<?php
include_once($HUB_FLM->getCodeDirPath("ui/footerminiembed.php"));
?>