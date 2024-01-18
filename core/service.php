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
 * REST service API
 *
 * All the methods listed are are available to users through REST-style URL calls
 */

require_once(__DIR__ . '/../config.php');

global $USER,$CFG,$LNG,$HUB_FLM;

//send the header info
set_service_header();
$method = optional_param("method","",PARAM_ALPHA);

$response = "";
switch($method) {
	case "getconnectionsfromjsonld" :
		require_once($HUB_FLM->getCodeDirPath("core/io/catalyst/catalyst_jsonld_reader.class.php"));
		$url = required_param('url', PARAM_URL);
		$withhistory = optional_param('withhistory',false,PARAM_BOOL);
		$withvotes = optional_param('withvotes',false,PARAM_BOOL);
		$withposts = optional_param('withposts',false,PARAM_BOOL);
		$timeout = optional_param('timeout',60,PARAM_INT);

		$reader = new catalyst_jsonld_reader();
		$reader = $reader->load($url,$timeout,$withhistory,$withvotes,$withposts);

		$response = $reader->connectionSet;
		break;

	case "getnodesfromjsonld" :
		require_once($HUB_FLM->getCodeDirPath("core/io/catalyst/catalyst_jsonld_reader.class.php"));
		$url = required_param('url', PARAM_URL);
		$withhistory = optional_param('withhistory',false,PARAM_BOOL);
		$withvotes = optional_param('withvotes',false,PARAM_BOOL);
		$withposts = optional_param('withposts',false,PARAM_BOOL);
		$timeout = optional_param('timeout',60,PARAM_INT);

		$reader = new catalyst_jsonld_reader();
		$reader = $reader->load($url,$timeout,$withhistory,$withvotes,$withposts);

		$response = $reader->nodeSet;
		break;

	case "getinterestnetworkdata" :
		require_once($HUB_FLM->getEmbedLib());
		$url = required_param('url', PARAM_URL);
		$withposts = optional_param('withposts',false,PARAM_BOOL);
		$timeout = optional_param('timeout',60,PARAM_INT);

		$response = getInterestNetworkData($url,$timeout,$withposts);
		break;
	case "getcommunitiesnetworkdata" :
		require_once($HUB_FLM->getEmbedLib());
		$url = required_param('url', PARAM_URL);
		$withposts = optional_param('withposts',false,PARAM_BOOL);
		$timeout = optional_param('timeout',60,PARAM_INT);

		$response = getCommunitiesNetworkData($url,$timeout,$withposts);
		break;

	case "getminiusercontributions" :
		require_once($HUB_FLM->getEmbedLib());
		$url = required_param('url', PARAM_URL);
		$withvotes = optional_param('withvotes',false,PARAM_BOOL);
		$withposts = optional_param('withposts',false,PARAM_BOOL);
		$timeout = optional_param('timeout',60,PARAM_INT);

		$response = getMiniUserContributions($url,$timeout,$withvotes,$withposts);
		break;
	case "getminiuserviewings" :
		require_once($HUB_FLM->getEmbedLib());
		$url = required_param('url', PARAM_URL);
		$withposts = optional_param('withposts',false,PARAM_BOOL);
		$timeout = optional_param('timeout',60,PARAM_INT);

		$response = getMiniUserViewings($url,$timeout,$withposts);
		break;
	case "getminihealthparticipation" :
		require_once($HUB_FLM->getCodeDirPath("core/embedlib.php"));
		$url = required_param('url', PARAM_URL);
		$withposts = optional_param('withposts',false,PARAM_BOOL);
		$timeout = optional_param('timeout',60,PARAM_INT);

		$response = getMiniHealthParticipation($url,$timeout,$withposts);
		break;
	case "getminihealthviewing" :
		require_once($HUB_FLM->getEmbedLib());
		$url = required_param('url', PARAM_URL);
		$withposts = optional_param('withposts',false,PARAM_BOOL);
		$timeout = optional_param('timeout',60,PARAM_INT);

		$response = getMiniHealthViewing($url,$timeout,$withposts);
		break;
	case "getminihealthcontribution" :
		require_once($HUB_FLM->getEmbedLib());
		$url = required_param('url', PARAM_URL);
		$withposts = optional_param('withposts',false,PARAM_BOOL);
		$withvotes = optional_param('withvotes',false,PARAM_BOOL);
		$timeout = optional_param('timeout',60,PARAM_INT);

		$response = getMiniHealthContribution($url,$timeout,$withvotes,$withposts);
		break;
	case "getminiwordstats" :
		require_once($HUB_FLM->getEmbedLib());
		$url = required_param('url', PARAM_URL);
		$withposts = optional_param('withposts',false,PARAM_BOOL);
		$timeout = optional_param('timeout',60,PARAM_INT);

		$response = getMiniWordStats($url,$timeout,$withposts);
		break;
	case "getminialerts" :
		require_once($HUB_FLM->getEmbedLib());
		$url = required_param('url', PARAM_URL);
		$timeout = optional_param('timeout',60,PARAM_INT);
		$alerts = optional_param('alerts',"",PARAM_TEXT);
		$userids = optional_param('userids',"",PARAM_TEXT);

		$response = getAlertsData($url,$alerts,$timeout,$userids);
		break;
    default:
        //error as method not defined.
        global $ERROR;
        $ERROR = new Hub_Error;
        $ERROR->createInvalidMethodError();
        include($HUB_FLM->getCodeDirPath("core/formaterror.php"));
        die;
}

// finally format the output based on the format param in url
echo format_output($response);
?>