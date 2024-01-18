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

///////////////////////////////////////
// Error Class
///////////////////////////////////////

class Error {

	private $REQUIRED_PARAMETER_MISSING = "1000";
	private $INVALID_METHOD_SPECIFIED = "1001";
	private $INVALID_EMAIL_FORMAT = "4000";
	private $INVALID_JSONLD_FORMAT = "5000";
	private $INVALID_PARAMETER_TYPE = "10001";

    public $message;
    public $code;


    function createInvalidMethodError() {
    	global $LNG;
        $this->message = $LNG->ERROR_INVALID_METHOD_SPECIFIED_MESSAGE;
        $this->code = $this->INVALID_METHOD_SPECIFIED;
    }

    function createRequiredParameterError($parname) {
    	global $LNG;
    	$this->message = $LNG->ERROR_REQUIRED_PARAMETER_MISSING_MESSAGE." : ".$parname;
        $this->code = $this->REQUIRED_PARAMETER_MISSING;
    }

    function createInvalidParameterError($type) {
    	global $LNG;
    	$this->message = $LNG->ERROR_INVALID_PARAMETER_TYPE_MESSAGE." : ".$type;
        $this->code = $this->INVALID_PARAMETER_TYPE;
    }

    function createInvalidEmailError() {
    	global $LNG;
    	$this->message = $LNG->ERROR_INVALID_EMAIL_FORMAT_MESSAGE;
        $this->code = $this->INVALID_EMAIL_FORMAT;
    }

	function createInvalidJSONLDError($json_last_error) {
    	global $LNG;

		switch ($json_last_error) {
			case JSON_ERROR_NONE:
		    	$this->message = $LNG->ERROR_INVALID_JSON_ERROR_NONE;
			break;
			case JSON_ERROR_DEPTH:
		    	$this->message = $LNG->ERROR_INVALID_JSON_ERROR_DEPTH;
			break;
			case JSON_ERROR_STATE_MISMATCH:
		    	$this->message = $LNG->ERROR_INVALID_JSON_ERROR_STATE_MISMATCH;
			break;
			case JSON_ERROR_CTRL_CHAR:
		    	$this->message = $LNG->ERROR_INVALID_JSON_ERROR_CTRL_CHAR;
			break;
			case JSON_ERROR_SYNTAX:
		    	$this->message = $LNG->ERROR_INVALID_JSON_ERROR_SYNTAX;
			break;
			case JSON_ERROR_UTF8:
		    	$this->message = $LNG->ERROR_INVALID_JSON_ERROR_UTF8;
			break;
			default:
		    	$this->message = $LNG->ERROR_INVALID_JSON_ERROR_DEFAULT;
			break;
		}

        $this->code = $this->INVALID_JSONLD_FORMAT;
	}
}
?>