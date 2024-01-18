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

include_once(__DIR__ . '/../config.php');


$url = required_param("url", PARAM_URL);
$title = required_param("title",PARAM_TEXT);
$width = optional_param("width", 350, PARAM_INT);
$height = optional_param("height", 220, PARAM_INT);

include_once($HUB_FLM->getCodeDirPath("ui/header.php"));
?>

<div style="margin-left:10px;margin-top:20px;">
	<div style="float:left;">
		<iframe src="<?php echo $url; ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>"  style="overflow:none" scrolling="no" frameborder="0"></iframe>
	</div>
</div>

<?php
include_once($HUB_FLM->getCodeDirPath("ui/footer.php"));
?>