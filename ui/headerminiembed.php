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

if (!isset($langurl) ){
	$langurl = optional_param('langurl', '', PARAM_URL);
}
?>
<!DOCTYPE html>
<html lang="<?php echo $CFG->language; ?>">
<head>
<meta charset="UTF-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title><?php echo $CFG->SITE_TITLE; ?></title>

<link rel="stylesheet" href="<?php echo $HUB_FLM->getStylePath("style.css"); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo $HUB_FLM->getStylePath("node.css"); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo $HUB_FLM->getStylePath("vis.css"); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo $HUB_FLM->getCodeWebPath("ui/lib/jit-2.0.2/Jit/css/base.css"); ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo $HUB_FLM->getCodeWebPath("ui/lib/d3-3.5.17/css/d3styles.css"); ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo $HUB_FLM->getCodeWebPath("ui/lib/dc.js-2.1.10/dc.css"); ?>" type="text/css" />
<link rel="stylesheet" href="<?php echo $HUB_FLM->getCodeWebPath("ui/lib/nvd3-1.8.6/build/nv.d3.css"); ?>" type="text/css" />

<link rel="icon" href="<?php echo $HUB_FLM->getImagePath("favicon.ico"); ?>" type="images/x-icon" />

<script src="<?php echo $HUB_FLM->getCodeWebPath('ui/util.js.php')."?langurl=".$langurl; ?>" type="text/javascript"></script>
<script src="<?php echo $HUB_FLM->getCodeWebPath('ui/node.js.php')."?langurl=".$langurl; ?>" type="text/javascript"></script>
<script src="<?php echo $HUB_FLM->getCodeWebPath('ui/minisutil.js.php'); ?>" type="text/javascript"></script>

<script src="<?php echo $CFG->homeAddress; ?>ui/lib/prototype.js" type="text/javascript"></script>
<script src="<?php echo $CFG->homeAddress; ?>ui/lib/dateformat.js" type="text/javascript"></script>

<!-- JIT VISUALISATIONS CODE -->
<script src="<?php echo $CFG->homeAddress; ?>ui/lib/jit-2.0.2/Jit/jit.js" type="text/javascript"></script>
<script src="<?php echo $CFG->homeAddress; ?>ui/networkmaps/visualisations/graphlib.js.php?langurl=<?php echo $langurl; ?>" type="text/javascript"></script>
<script src="<?php echo $CFG->homeAddress; ?>ui/networkmaps/networklib.js.php?langurl=<?php echo $langurl;?>" type="text/javascript"></script>

<!-- D3 VISUALISATIONS CODE -->
<script src="<?php echo $CFG->homeAddress; ?>ui/lib/d3-3.5.17/d3.js"></script>
<script src="<?php echo $CFG->homeAddress; ?>ui/lib/d3-3.5.17/lib/colorbrewer/colorbrewer.js"></script>
<script src="<?php echo $CFG->homeAddress; ?>ui/lib/crossfilter-1.3.14/crossfilter.min.js"></script>
<script src="<?php echo $CFG->homeAddress; ?>ui/lib/dc.js-2.1.10/dc.min.js"></script>
<script src="<?php echo $CFG->homeAddress; ?>ui/lib/nvd3-1.8.6/build/nv.d3.js"></script>

<?php
	if ($CFG->GOOGLE_ANALYTICS_ON) {
		include_once($HUB_FLM->getCodeDirPath("ui/analyticstracking.php"));
	}
?>
</head>

<body class="bodyembed">
<div id="main">