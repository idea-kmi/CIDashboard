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
 * languageui.php
 *
 * Author: Michelle Bachler, KMi, The Open University
 *
 */

/** HEADERS **/
$LNG->HEADER_LOGO_HINT = 'Go to the '.$CFG->SITE_TITLE.' home page';
$LNG->HEADER_LOGO_ALT = $CFG->SITE_TITLE.' Logo';
$LNG->HEADER_HELP_PAGE_LINK_TEXT = 'Help';
$LNG->HEADER_HELP_PAGE_LINK_HINT = 'Go to the Help page';
$LNG->HEADER_ABOUT_PAGE_LINK_TEXT = 'About';
$LNG->HEADER_ABOUT_PAGE_LINK_HINT = 'Go to the About page';
$LNG->HEADER_ADMIN_PAGE_LINK_TEXT = 'Admin';
$LNG->HEADER_ADMIN_PAGE_LINK_HINT = 'Go to the Admin page';

/** FOOTER **/
$LNG->FOOTER_TERMS_LINK = 'Terms of Use';
$LNG->FOOTER_PRIVACY_LINK = 'Privacy';
$LNG->FOOTER_CONTACT_LINK = 'Contact';
$LNG->FOOTER_DEVELOPED_BY = 'Developed By';
$LNG->FOOTER_ACCESSIBILITY = 'Accessibility';

$LNG->POPUPS_BLOCK = 'You appear to have blocked popup windows.\n\n Please alter your browser settings to allow this site to open popup windows.';
$LNG->FORM_BUTTON_CLOSE = 'Close';

/** CORE **/
$LNG->CORE_FORMAT_NOT_IMPLEMENTED_MESSAGE = 'Not yet implemented';
$LNG->CORE_FORMAT_INVALID_SELECTION_ERROR = 'Invalid format selection';

/** ERROR MESSAGE SENT FROM THE CORE CODE **/
$LNG->ERROR_REQUIRED_PARAMETER_MISSING_MESSAGE = "Required parameter missing";
$LNG->ERROR_INVALID_METHOD_SPECIFIED_MESSAGE = "Invalid or no method specified";
$LNG->ERROR_INVALID_EMAIL_FORMAT_MESSAGE = "Invalid email format";
$LNG->ERROR_INVALID_PARAMETER_TYPE_MESSAGE = "Invalid parameter type";

$LNG->ERROR_INVALID_JSON_ERROR_NONE = "No JSON errors";
$LNG->ERROR_INVALID_JSON_ERROR_DEPTH = "Maximum stack depth exceeded in the JSON";
$LNG->ERROR_INVALID_JSON_ERROR_STATE_MISMATCH = "Underflow or the modes mismatch";
$LNG->ERROR_INVALID_JSON_ERROR_CTRL_CHAR = "Unexpected control character found in the JSON";
$LNG->ERROR_INVALID_JSON_ERROR_SYNTAX = "Syntax error, malformed JSON";
$LNG->ERROR_INVALID_JSON_ERROR_UTF8 = "Malformed UTF-8 characters, possibly incorrectly encoded";
$LNG->ERROR_INVALID_JSON_ERROR_DEFAULT = "An unknown error has occurred decoding the JSON";
?>