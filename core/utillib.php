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

/**
 * Return the node type text for a given node type label
 * @param $nodetype the node type for node to return the text for
 * @param $withColon true if you want a colon adding after the node type name, else false (default = true).
 */
function getNodeTypeText($nodetype, $withColon=true) {
	global $LNG, $CFG;

	$title=$nodetype;

	if ($nodetype == 'Challenge') {
		$title = $LNG->CHALLENGE_NAME;
	} else if ($nodetype == 'Issue') {
		$title = $LNG->ISSUE_NAME;
	} else if ($nodetype == 'Solution') {
		$title = $LNG->SOLUTION_NAME;
	} else if ($nodetype == 'Argument') {
		$title = $LNG->ARGUMENT_NAME;
	} else if ($nodetype == 'Pro') {
		$title = $LNG->PRO_NAME;
	} else if ($nodetype == 'Con') {
		$title = $LNG->CON_NAME;
	} else if ($nodetype == 'Resource') {
		$title = $LNG->RESOURCE_NAME;
	} else if ($nodetype == 'Comment') {
		$title = $LNG->COMMENT_NAME;
	} else if ($nodetype == 'Idea') {
		$title = $LNG->IDEA_NAME;
	} else if ($nodetype == 'Decision') {
		$title = $LNG->DECISION_NAME;
	} else if ($nodetype == 'Map') {
		$title = $LNG->MAP_NAME;
	}

	if ($withColon) {
		$title .= ": ";
	}

	return $title;
}

/**
 * Replace chars with their JSON escaped chars. Also removes tabs and escapes line feeds etc which mess up JSON validation
 *
 * @param string $str
 * @return string
 */
function parseToJSON($str) {

	//reverse this from reading in
 	$str = str_replace('&#43;','+',$str);
	$str = str_replace('&#40;','(',$str);
	$str = str_replace('&#41;',')',$str);
	$str = str_replace('&#61;','=',$str);
    $str = str_replace("&quot;", '"', $str);
    $str = str_replace("&#039;", "'", $str);

    $str = str_replace("\r\n", "\n", $str);
    $str = str_replace("\r", "\n", $str);

    // JSON requires new line characters be escaped
    $str = str_replace("\n", "\\n", $str);

    $str = str_replace(chr(9),' ',$str);  // remove tabs
    $str = str_replace("\"",'\\"',$str); // escape double quotes
    return $str;
}

function loadJsonLDFromURL($url) {
	//error_log($url);

	$curl = curl_init();

	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array( 'Accept: application/ld+json'));
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_ENCODING , "gzip");
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

	$response = curl_exec($curl);
	$httpCode = curl_getinfo( $curl, CURLINFO_HTTP_CODE );
	curl_close($curl);

	//error_log(print_r("RESPONSE=".$response, true));
	//error_log("code=".$httpCode);

	if($httpCode != 200 || $response === false) {
		return false;
	} else {
		return $response;
	}
}
?>