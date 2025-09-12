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

/**
 * Utility library
 * Misc functions that do not fit anywhere else!
 */

/**
 * PARAM_INT - integers only, use when expecting only numbers.
 */
define('PARAM_INT',  1);

/**
 * PARAM_ALPHA - contains only english letters.
 */
define('PARAM_ALPHA', 2);

 /**
 * PARAM_TEXT - general plain text compatible with multilang filter, no other html tags.
 */
define('PARAM_TEXT', 3);

/**
 * PARAM_PATH - safe relative path name, all dangerous chars are stripped, protects against XSS, SQL injections and directory traversals
 * note: the leading slash is not removed, window drive letter is not allowed
 */
define('PARAM_PATH',  4);

/**
 * PARAM_URL - expected properly formatted URL. Please note that domain part is required, http://localhost/ is not acceppted but http://localhost.localdomain/ is ok.
 */
define('PARAM_URL', 5);

/**
 * PARAM_BOOL - converts input into 0 or 1, use for switches in forms and urls.
 */
define('PARAM_BOOL', 6);

/**
 * PARAM_HTML - keep the HTML as HTML
 * note: do not forget to addslashes() before storing into database!
 */
define('PARAM_HTML', 7);

/**
 * PARAM_ALPHANUM - expected numbers and letters only.
 */
define('PARAM_ALPHANUM', 8);

/**
 * PARAM_ALPHAEXT the same contents as PARAM_ALPHA plus the chars in quotes: "/-_" allowed,
 */
define('PARAM_ALPHAEXT', 9);

/**
 * PARAM_BOOL - checks input is an allowed boolean type (true,false,yes,no,on,off,0,1).
 */
define('PARAM_BOOLTEXT', 10);

/**
 * PARAM_NUMBER - returns float, use when expecting only numbers.
 */
define('PARAM_NUMBER',  12);

/**
 * PARAM_EMAIL - checks the string is an email address format.
 */
define('PARAM_EMAIL', 13);

/**
 * PARAM_XML - checks the string is an xml.
 */
define('PARAM_XML', 14);

/**
 * PARAM_ALPHANUMEXT the same contents as PARAM_ALPHANUM plus the chars: "-" and "_" are allowed.
 * Used for ids mostly
 */
define('PARAM_ALPHANUMEXT', 15);

/**
 * Returns a cleaned version of the given parameter value.
 *
 * @param string $param the value to clean
 * @param int $type expected type of the value
 * @return mixed
 */
function check_param($param, $type=PARAM_ALPHAEXT) {
    global $CFG, $HUB_FLM;

    if (!isset($param) || $param == "") {
         $ERROR = new Hub_Error;
         $ERROR->createRequiredParameterError($parname);
         include($HUB_FLM->getCodeDirPath("core/formaterror.php"));
         die;
    }

    return clean_param($param, $type);
}

/**
 * Returns a particular value for the named variable, taken from
 * POST or GET.  If the parameter doesn't exist then an error is
 * thrown because we require this variable.
 *
 * @param string $parname the name of the page parameter we want
 * @param int $type expected type of parameter
 * @return mixed
 */
function required_param($parname, $type=PARAM_ALPHAEXT) {
    global $CFG, $HUB_FLM;

    if (isset($_POST[$parname])) {
        $param = $_POST[$parname];
    } else if (isset($_GET[$parname])) {
        $param = $_GET[$parname];
    } else {
         global $ERROR;
         $ERROR = new Hub_Error;
         $ERROR->createRequiredParameterError($parname);
         include($HUB_FLM->getCodeDirPath("core/formaterror.php"));
         die;
    }

    return clean_param($param, $type);
}

/**
 * Returns a particular value for the named variable, taken from
 * POST or GET, otherwise returning a given default.
 *
 * @param string $parname the name of the page parameter we want
 * @param mixed  $default the default value to return if nothing is found
 * @param int $type expected type of parameter
 * @return mixed
 */
function optional_param($parname, $default=NULL, $type=PARAM_ALPHAEXT) {
    if (isset($_POST[$parname])) {
        $param = $_POST[$parname];
    } else if (isset($_GET[$parname])) {
        $param = $_GET[$parname];
    } else {
        return $default;
    }

    return clean_param($param, $type);
}

/**
 * Clean the passed parameter
 *
 * @param mixed $param the variable we are cleaning
 * @param int $type expected format of param after cleaning.
 * @return mixed
 */
function clean_param($param, $type) {

    global $CFG,$ERROR, $HUB_FLM;

    if (is_array($param)) {
        $newparam = array();
        foreach ($param as $key => $value) {
            $newparam[$key] = clean_param($value, $type);
        }
        return $newparam;
    }

    switch ($type) {

        case PARAM_TEXT:    // leave only tags needed for multilang
            if (is_numeric($param)) {
                return $param;
            }

            $param = stripslashes($param);
            $param = clean_text($param);
			$param = strip_tags($param, '<lang><span>');

			$param = str_replace('+', '&#43;', $param);
			$param = str_replace('(', '&#40;', $param);
			$param = str_replace(')', '&#41;', $param);
			$param = str_replace('=', '&#61;', $param);
			$param = str_replace('"', '&quot;', $param);
			$param = str_replace('\'', '&#039;', $param);

            return   $param;

        case PARAM_HTML:    // keep as HTML, no processing
            $param = stripslashes($param);
            $param = clean_text($param);
            return trim($param);

        case PARAM_INT:
            return (int)$param;

        case PARAM_NUMBER:
            return (float)$param;

        case PARAM_ALPHA:        // Remove everything not a-z
            return preg_replace('/([^a-zA-Z])/i', '', $param);

        case PARAM_ALPHANUM:     // Remove everything not a-zA-Z0-9
            return preg_replace('/([^A-Za-z0-9])/i', '', $param);

        case PARAM_ALPHAEXT:     // Remove everything not a-zA-Z/_-
            return preg_replace('/([^a-zA-Z\/_-])/i', '', $param);

        case PARAM_ALPHANUMEXT:     // Remove everything not a-zA-Z0-9_-
            return preg_replace('/([^a-zA-Z0-9_-])/i', '', $param);

        case PARAM_BOOL:         // Convert to 1 or 0
            $tempstr = strtolower($param);
            if ($tempstr == 'on' or $tempstr == 'yes' or $tempstr == 'true') {
                $param = 1;
            } else if ($tempstr == 'off' or $tempstr == 'no' or $tempstr == 'false') {
                $param = 0;
            } else {
                $param = empty($param) ? 0 : 1;
            }
            return $param;

        case PARAM_BOOLTEXT:         // check is an allowed text type boolean
            $tempstr = strtolower($param);
            if ($tempstr == 'on' or $tempstr == 'yes' or $tempstr == 'true' or
            	 $tempstr == 'off' or $tempstr == 'no' or $tempstr == 'false' or $tempstr == '0' or $tempstr == '1') {
            	$param = $param;
            } else {
                $param = "";
            }
            return $param;

        case PARAM_PATH:         // Strip all suspicious characters from file path
            $param = str_replace('\\\'', '\'', $param);
            $param = str_replace('\\"', '"', $param);
            $param = str_replace('\\', '/', $param);
            $param = ereg_replace('[[:cntrl:]]|[<>"`\|\':]', '', $param);
            $param = ereg_replace('\.\.+', '', $param);
            $param = ereg_replace('//+', '/', $param);
            return ereg_replace('/(\./)+', '/', $param);

        case PARAM_URL:          // allow safe ftp, http, mailto urls
            include_once($CFG->dirAddress .'core/lib/url-validation.class.php');

            $URLValidator = new mrsnk_URL_validation($param, MRSNK_URL_DO_NOT_PRINT_ERRORS, MRSNK_URL_DO_NOT_CONNECT_2_URL);
           	if (!empty($param) && $URLValidator->isValid()) {
               // all is ok, param is respected
            } else {
                $param =''; // not really ok
			}
            return $param;

 		case PARAM_EMAIL:
		    if(validEmail($param)) {
		        return $param;
		    } else {
				 $ERROR = new Hub_Error;
				 $ERROR->createInvalidEmailError();
            	 include_once($HUB_FLM->getCodeDirPath("core/formaterror.php"));
				 die;
		    }

 		case PARAM_XML:
 			$param = parseFromXML($param);
 			return $param;

        default:
            include_once($HUB_FLM->getCodeDirPath("core/formaterror.php"));
            $ERROR = new Hub_Error;
            $ERROR->createInvalidParameterError($type);
            die;
    }
}

/**
 * Check whether a string looks like a valid email address
 *
 * @param string $email
 * @return boolean
 */
function validEmail($email){
    if(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/i", $email)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Clean up the given text
 *
 * @param string $text The text to be cleaned
 * @return string The clean text
 */
function clean_text($text) {

	global $CFG;

    if (empty($text) or is_numeric($text)) {
       return (string)$text;
    }

	/// Fix non standard entity notations
	$text = preg_replace('/(&#[0-9]+)(;?)/i', "\\1;", $text);
	$text = preg_replace('/(&#x[0-9a-fA-F]+)(;?)/i', "\\1;", $text);

	require_once($CFG->dirAddress .'core/lib/htmlpurifier/library/HTMLPurifier.auto.php');

    $config = HTMLPurifier_Config::createDefault();

    $config->set('Core.Encoding', 'utf-8'); // replace with your encoding
    $config->set('HTML.Doctype', 'XHTML 1.0 Transitional');

	$config->set('HTML.SafeIframe', true);
	$config->set('HTML.SafeEmbed', true);
    $config->set('HTML.SafeObject', true);
    $config->set('Output.FlashCompat', true);
    $config->set('HTML.FlashAllowFullScreen', true);


    //$config->set('Filter.YouTube', true);

    //$config->set('HTML.Allowed', 'object[id|codebase|align|classid|width|height|data],param[name|value],embed[src|quality|bgcolor|name|align|pluginspage|type|allowscriptaccess|width|height|wmode|flashvars]');

	$safeurls = '%^(http[s]?:)?//(';

	if (isset($CFG->safeurls)) {
		$count = 0;
		if (is_countable($CFG->safeurls)) {
			$count = count($CFG->safeurls);
		}
		for ($i=0; $i<$count;$i++) {
			if ($i == 0) {
				$safeurls .= $CFG->safeurls[$i];
			} else {
				$safeurls .= "|".$CFG->safeurls[$i];
			}
		}
	} else {
		$safeurls .= 'www.youtube-nocookies.com/embed/';
		$safeurls .= '|player.vimeo.com/video/';
		$safeurls .= '|cohere.open.ac.uk/';
		$safeurls .= '|www.ustream.tv/';
		$safeurls .= '|www.schooltube.com/';
		$safeurls .= '|archive.org/';
		$safeurls .= '|www.blogtv.com/';
		$safeurls .= '|uk.video.yahoo.com/';
		$safeurls .= '|www.teachertube.com/';
		$safeurls .= '|sciencestage.com/';
		$safeurls .= '|www.flickr.com/';
	}

	$safeurls .= ')%';

	$config->set('URI.SafeIframeRegexp', $safeurls);

	$def = $config->getHTMLDefinition(true);
	$def->addAttribute('object', 'flashvars', 'CDATA');
	$def->addAttribute('object', 'classid', 'CDATA');
	$def->addAttribute('object', 'codebase', 'CDATA');
	$def->addAttribute('object', 'id', 'CDATA');
	$def->addAttribute('object', 'align', 'CDATA');

	// already handled.
	//$def->addAttribute('embed', 'src', 'URI#embedded');

	$def->addAttribute('embed', 'quality', 'CDATA');
	$def->addAttribute('embed', 'name', 'CDATA');
	$def->addAttribute('embed', 'pluginspage', 'CDATA');
	$def->addAttribute('embed', 'align', 'CDATA');
	$def->addAttribute('embed', 'bgcolor', 'CDATA');

	$embedFilter = new HTMLPurifier_URIFilter_SafeEmbed();
	$embedFilter->setRegularExpression($safeurls);

	$objectFilter = new HTMLPurifier_URIFilter_SafeObject();
	$objectFilter->setRegularExpression($safeurls);

	$uri = $config->getDefinition('URI');
	$uri->addFilter($embedFilter, $config);
	$uri->addFilter($objectFilter, $config);

    $purifier = new HTMLPurifier($config);

    $text = $purifier->purify($text);

	return $text;
}

/**
 * Replace reserved chars with their XML entity equivalents
 *
 * @param string $xmlStr
 * @return string
 */
function parseToXML($xmlStr) {
    $xmlStr=str_replace("&",'&amp;',$xmlStr);
    $xmlStr=str_replace('<','&lt;',$xmlStr);
    $xmlStr=str_replace('>','&gt;',$xmlStr);
    $xmlStr=str_replace('"','&quot;',$xmlStr);
    $xmlStr=str_replace("'",'&#39;',$xmlStr);
    return $xmlStr;
}

/**
 * Replace XML entities with their character equivalents
 *
 * @param string $text
 * @return string
 */
function parseFromXML($text) {
    $text = str_replace("&amp;", "&", $text);
    $text = str_replace("&lt;", "<", $text);
    $text = str_replace("&gt;", ">", $text);
    $text = str_replace("&quot;", '"', $text);
    $text = str_replace("&#039;", "'", $text);
    return $text;
}
?>
