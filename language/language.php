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
 * language.php
 *
 * Michelle Bachler, KMi, The Open University.
 *
 * This file loads the language files for the site.
 * For each file, it first loads the base language file, then applies any overrides and additions by;
 * first loading any multi site global version of the file, then any domain specific version.
 * Any matching variable names will be replaced, and new ones added.
 *
 * This should eventually become part of the internationalization of the Evidence Hub
 */
unset($LNG);

$LNG = new stdClass();

/** LOAD CORE TERMS **/
loadLanguageFile('languagecore.php');

// override lang core terms if url supplied.
$langurl = optional_param('langurl', '', PARAM_URL);
if ($langurl != '') {
	overrideLanguageCore($langurl);
}

/** LOAD INTERFACE TEXT (SOME HTML INCLUDED) **/
loadLanguageFile('languageui.php');

loadLanguageFile('embed.php');
loadLanguageFile('stats.php');

/////// PAGES ///////

/** LOAD ABOUT (MUCH HTML INCLUDED) **/
loadLanguageFile('pages/about.php');

/** LOAD CONDITIONS OF USE (MUCH HTML INCLUDED) **/
loadLanguageFile('pages/conditionsofuse.php');

/** LOAD COOKIES (MUCH HTML INCLUDED) **/
loadLanguageFile('pages/cookies.php');

/** LOAD PRIVACY STATEMENT (MUCH HTML INCLUDED) **/
loadLanguageFile('pages/privacy.php');

/** LOAD HELP (MUCH HTML INCLUDED) **/
loadLanguageFile('pages/help.php');


/** HELPER FUNCTIONS **/
function loadLanguageFile($file) {

	global $CFG, $HUB_FLM, $LNG;

	if (file_exists($CFG->dirAddress.'language/'.$CFG->language.'/'.$file)) {
		require_once($CFG->dirAddress.'language/'.$CFG->language.'/'.$file);
	} else {
		if (file_exists($CFG->dirAddress.'language/en/'.$file)) {
			require_once($CFG->dirAddress.'language/en/'.$file);
		}
	}
}

function loadJsonFromURL($url) {
	$curl = curl_init();

	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array( 'Accept: application/json'));
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_ENCODING , "gzip");

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

/**
 * Utility library
 * Misc functions that do not fit anywhere else!
 */
function overrideLanguageCore($langurl) {
	global $CFG, $LNG;
	//error_log($langurl);

	$doc = loadJsonFromURL($langurl);
	if ($doc !== false) {
		$jsondata = "";
		$doc = iconv("UTF-8", "UTF-8//IGNORE", $doc);
		$jsondata = json_decode($doc);

		switch (json_last_error()) {
			case JSON_ERROR_NONE:
				//echo ' - No errors';
			break;
			case JSON_ERROR_DEPTH:
				echo 'Json language override file - Maximum stack depth exceeded';
			break;
			case JSON_ERROR_STATE_MISMATCH:
				echo 'Json language override file - Underflow or the modes mismatch';
			break;
			case JSON_ERROR_CTRL_CHAR:
				echo 'Json language override file - Unexpected control character found';
			break;
			case JSON_ERROR_SYNTAX:
				echo 'Json language override file - Syntax error, malformed JSON';
			break;
			case JSON_ERROR_UTF8:
				echo 'Json language override file - Malformed UTF-8 characters, possibly incorrectly encoded';
			break;
			default:
				echo 'Json language override file - Unknown error';
			break;
		}

		if ($jsondata != NULL && json_last_error() == 0) {
			$count = 0;
			if (is_countable($jsondata)) {
				$count = count($jsondata);
			}
			for ($i=0; $i < $count; $i++) {
				$next = $jsondata[$i];
				$term = $next->term;
				$label = $next->label;
				$singular = '';
				$plural = '';
				$text= '';
				$countlabel = 0;
				if (is_countable($label)) {
					$countlabel = count($label);
				}
				for ($j=0; $j<$countlabel;$j++) {
					$n = $label[$j];
					if ($n->language == $CFG->language) {
						if (isset($n->singular)) {
							$singular = $n->singular;
						}
						if (isset($n->plural)) {
							$plural = $n->plural;
						}
						if (isset($n->text)) {
							$text = $n->text;
						}
					}
				}

				$singular = clean_param($singular, PARAM_TEXT);
				$plural = clean_param($plural, PARAM_TEXT);
				$text = clean_param($text, PARAM_TEXT);

				//error_log($term);
				//error_log($singular);
				//error_log($plural);

				if ($singular != '') {
					switch($term) {
						case "CHALLENGE_NAME":
							$LNG->CHALLENGE_NAME = $singular;
							if ($plural != '') {
								$LNG->CHALLENGES_NAME = $plural;
							}
							break;
						case "ISSUE_NAME":
							$LNG->ISSUE_NAME = $singular;
							if ($plural != '') {
								$LNG->ISSUES_NAME = $plural;
							}
							break;
						case "SOLUTION_NAME":
							$LNG->SOLUTION_NAME = $singular;
							if ($plural != '') {
								$LNG->SOLUTIONS_NAME = $plural;
							}
							break;
						case "ARGUMENT_NAME":
							$LNG->ARGUMENT_NAME = $singular;
							if ($plural != '') {
								$LNG->ARGUMENTS_NAME = $plural;
							}
							break;
						case "PRO_NAME":
							$LNG->PRO_NAME = $singular;
							if ($plural != '') {
								$LNG->PROS_NAME = $plural;
							}
							break;
						case "CON_NAME":
							$LNG->CON_NAME = $singular;
							if ($plural != '') {
								$LNG->CONS_NAME = $plural;
							}
							break;
						case "RESOURCE_NAME":
							$LNG->RESOURCE_NAME = $singular;
							if ($plural != '') {
								$LNG->RESOURCES_NAME = $plural;
							}
							break;
						case "COMMENT_NAME":
							$LNG->COMMENT_NAME = $singular;
							if ($plural != '') {
								$LNG->COMMENTS_NAME = $plural;
							}
							break;
						case "IDEA_NAME":
							$LNG->IDEA_NAME = $singular;
							if ($plural != '') {
								$LNG->IDEAS_NAME = $plural;
							}
							break;
						case "DECISION_NAME":
							$LNG->DECISION_NAME = $singular;
							if ($plural != '') {
								$LNG->DECISIONS_NAME = $plural;
							}
							break;
						case "MAP_NAME":
							$LNG->MAP_NAME = $singular;
							if ($plural != '') {
								$LNG->MAPS_NAME = $plural;
							}
							break;
						case "DEBATE_NAME":
							$LNG->DEBATE_NAME = $singular;
							if ($plural != '') {
								$LNG->DEBATES_NAME = $plural;
							}
							break;
					}
				} else if ($text != '') {
					switch($term) {
						case "LINK_ISSUE_CHALLENGE":
							$LNG->LINK_ISSUE_CHALLENGE = $text;
							break;
						case "LINK_SOLUTION_ISSUE":
							$LNG->LINK_SOLUTION_ISSUE = $text;
							break;
						case "LINK_ISSUE_SOLUTION":
							$LNG->LINK_SOLUTION_ISSUE = $text;
							break;
						case "LINK_PRO_SOLUTION":
							$LNG->LINK_PRO_SOLUTION = $text;
							break;
						case "LINK_CON_SOLUTION":
							$LNG->LINK_CON_SOLUTION = $text;
							break;
						case "LINK_RESOURCE_NODE":
							$LNG->LINK_RESOURCE_NODE = $text;
							break;
						case "LINK_COMMENT_NODE":
							$LNG->LINK_COMMENT_NODE = $text;
							break;
						case "LINK_COMMENT_COMMENT":
							$LNG->LINK_COMMENT_NODE = $text;
							break;
						case "LINK_IDEA_NODE":
							$LNG->LINK_IDEA_NODE = $text;
							break;
						case "LINK_DECISION_ISSUE":
							$LNG->LINK_DECISION_ISSUE = $text;
							break;
					}
				}
			}
		}
	}
}
?>