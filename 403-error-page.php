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
    include_once("config.php");

    include_once($HUB_FLM->getCodeDirPath("ui/header.php"));
?>

<div style="margin:10px;">
	<h1>403: Forbidden</h1>
	<p>We're very sorry, but you cannot view the page you have requested.</p>
	<p>Try going to the root page of the <a href="<?php echo $CFG->homeAddress ;?>"><?php echo $CFG->SITE_TITLE ;?></a> website instead.</p>
	<span>Questions or problems regarding this web site should be directed to <a href="mailto:<?php echo $CFG->EMAIL_REPLY_TO; ?>"><?php echo $CFG->SITE_TITLE ;?> Hub Support</a>.<br></span>
</div>

<?php
    include_once($HUB_FLM->getCodeDirPath("ui/footer.php"));
?>