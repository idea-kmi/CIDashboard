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
/** @author Michelle Bachler, KMi, The Open University */

$CFG->VERSION = '1.0';

/** SETUP THE FILE LOCATION MANAGER **/
	unset($HUB_FLM);
	require_once("core/filelocationmanager.class.php");
	// instantiate the file location manager
	if (isset($CFG->uitheme)) {
		$HUB_FLM = new FileLocationManager($CFG->uitheme);
	} else {
		$HUB_FLM = new FileLocationManager();
	}
	global $HUB_FLM;

/** START SESSION **/
	$time = 99999999;
	$ses = 'cidashboard';
    ini_set('session.cache_expire', $time);
    session_set_cookie_params($time);
    if(session_id() == '') {
    	session_start();
	}
    // Reset the expiration time upon page load
    if (isset($_COOKIE[$ses])){
    	setcookie($ses, $_COOKIE[$ses], time() + $time, "/");
    }

	require_once('core/sanitise.php');

/** LOAD LANGUAGE FILES **/
	if (isset($_GET['lang'])) {
		$CFG->language = optional_param('lang','en',PARAM_ALPHAEXT);
		if (!file_exists($CFG->dirAddress.'/language/'.$CFG->language."/")){
			$CFG->language = 'en';
		}
		$_SESSION['lang'] = $CFG->language;
		//setcookie('lang', $CFG->language, time() + (3600 * 24 * 30));
	} else if(isset($_SESSION['lang'])) {
		$CFG->language = $_SESSION['lang'];
		if (!file_exists($CFG->dirAddress.'/language/'.$CFG->language."/")) {
			$CFG->language = 'en';
		}
	} /*else if(isset($_COOKIE['lang'])) {
		$temp = clean_param($_COOKIE['lang'], PARAM_ALPHAEXT);
		if (!file_exists($CFG->dirAddress.'/language/'.$temp."/")) {
			$CFG->language = 'en';
		} else {
			$CFG->language = $temp;
		}
	}*/

 	require_once("language/language.php");

/** GENERAL BITS **/
    global $CFG;
    global $LNG;

    require_once('core/error.class.php');
	require_once('core/utillib.php');
	require_once('core/formatlib.php');
	require_once('core/io/catalyst/catalyst_jsonld_reader.class.php');


/** SETUP THE CACHE MANAGER **/
	unset($HUB_CACHE);
	require_once("core/memcachemanager.class.php");
	$HUB_CACHE = new MemcacheManager();
    global $HUB_CACHE;
?>