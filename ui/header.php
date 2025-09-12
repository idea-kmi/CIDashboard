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

	$query = stripslashes(parseToJSON(optional_param("q","",PARAM_TEXT)));
	// need to do parseToJSON to convert any '+' symbols as they are now used in searches.

	$scope = optional_param("scope","all",PARAM_ALPHA);
	$tagsonly = optional_param("tagsonly",false,PARAM_BOOL);

	if( isset($_POST["loginsubmit"]) ) {
		$url = "http" . ((!empty($_SERVER["HTTPS"])) ? "s" : "") . "://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		header('Location: '.$CFG->homeAddress.'ui/pages/login.php?ref='.urlencode($url));
	}
?>

<!DOCTYPE html>
<html lang="<?php echo $CFG->language; ?>">
	<head>
		<meta http-equiv="Content-Type" content="text/html" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta charset="utf-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $CFG->SITE_TITLE; ?></title>

		<link rel="icon" href="<?php echo $HUB_FLM->getImagePath("favicon.ico"); ?>" type="images/x-icon" />

		<link rel="stylesheet" href="<?php echo $HUB_FLM->getStylePath("bootstrap.css"); ?>" type="text/css" />
		<link rel="stylesheet" href="<?php echo $HUB_FLM->getStylePath("all.css"); ?>" type="text/css" />
		<link rel="stylesheet" href="<?php echo $HUB_FLM->getStylePath("style.css"); ?>" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo $HUB_FLM->getStylePath("node.css"); ?>" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo $HUB_FLM->getStylePath("vis.css"); ?>" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo $HUB_FLM->getStylePath("tabber.css"); ?>" type="text/css" media="screen" />


		<script src="<?php echo $HUB_FLM->getCodeWebPath('ui/util.js.php'); ?>" type="text/javascript"></script>

		<script src="<?php echo $CFG->homeAddress; ?>ui/lib/prototype.js" type="text/javascript"></script>
		<script src="<?php echo $CFG->homeAddress; ?>ui/lib/dateformat.js" type="text/javascript"></script>
		<script src="<?php echo $CFG->homeAddress; ?>ui/lib/nativesortable-0.1.0/nativesortable.js" type="text/javascript"></script>

		<script src="<?php echo $HUB_FLM->getCodeWebPath('ui/lib/bootstrap/bootstrap.bundle.min.js'); ?>" type="text/javascript"></script>

		<script type="text/javascript">
			window.name="cidashboardmain";
		</script>

        <script type="text/javascript">
			function init(){
				document.getElementById('cookie-policy-link').focus();
			}
			window.onload = init;
		</script>


		<?php
			if ($CFG->GOOGLE_ANALYTICS_ON) {
				include_once($HUB_FLM->getCodeDirPath("ui/analyticstracking.php"));
			}
		?>
	</head>

	<body>

		<div class="alert alert-warning text-center" role="alert" style="margin-top: 20px;">
			<h4 class="alert-heading">⚠️ Important Notice: Site Retirement</h4>
			<p>
				It is with a heavy heart that we announce the retirement of this research site after more than a decade of service.
				The underlying code has become outdated and increasingly difficult to maintain securely, and we are no longer able to keep the site online.
			</p>
			<p>
				We are incredibly proud of the role this tool has played in supporting research and collaboration over the years. 
				Thank you to everyone who has used it.
			</p>
			<p>
				The site will be taken offline on <strong>10th October 2025</strong>.
			</p>
			<hr>
			<p class="mb-0">Thank you for being part of this journey.</p>
		</div>

		<div class="alert alert-dark alert-dismissible fade show m-0 fixed-bottom" role="alert" id="cookieConsent" style="display: none;">
			<div style="display: flex; align-items: center; flex-direction: column;">
				We use essential cookies to handle sessions, and Google Analytics cookies to gather data on how you use this site.<br/>
				<div>This data is extremely valuable for our research and helps us improve our analysis.</div>				
				<a id="cookie-policy-link" style="margin-top:5px;" href="<?php echo $CFG->homeAddress; ?>ui/pages/cookies.php">Read our cookie policy</a>
				<div>
					Are you happy to help with our research by allowing Google Analytics cookies? 
					<button type="button" class="cookieConsentButton" data-bs-dismiss="alert" aria-label="Yes" id="acceptAnlyticsCookies">Yes</button>
					<button type="button" class="cookieConsentButton" data-bs-dismiss="alert" aria-label="No" id="declineAnlyticsCookies">No</button>
				</div>
				<br/>
			</div>
		</div>
		
		<nav class="bg-light">
			<header class="py-3 mb-0 border-bottom" id="header">
				<div class="container-fluid d-flex flex-wrap justify-content-center">
					<div id="logo" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
						<a href="<?php print($CFG->homeAddress);?>" title="<?php echo $LNG->HEADER_LOGO_HINT; ?>" class="text-decoration-none">
							<img alt="<?php echo $LNG->HEADER_LOGO_ALT; ?>" src="<?php echo $HUB_FLM->getImagePath('evidence-hub-logo-header.png'); ?>" />
						</a>
					</div>
				</div>
			</header>
		</nav>

		<div id="message" class="messagediv"></div>
		<div id="prompttext" class="prompttext"></div>
		<div id="hgrhint" class="hintRollover">
			<span id="globalMessage"></span>
		</div>
		
		<div id="main" class="main">
			<div id="contentwrapper" class="contentwrapper">
				<div id="content" class="content">
					<div class="c_innertube">

