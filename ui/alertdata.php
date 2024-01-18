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
 /** Author: Michelle Bachler, KMi, The Open University **/

$alertsequence = array(1,2,3,4,5,6,12,24,25,13,15,16,19,7,8,9,10,11,14,17,18,20,21,22,23,26,27,28);

$alertdata = array();

$next = array();
$next[0] = $LNG->ALERT_TITLE_UNSEEN_BY_ME;
$next[1] = 1;
$next[2] = $LNG->ALERT_DESC_UNSEEN_BY_ME;
$next[3] = $CFG->ALERT_UNSEEN_BY_ME;
$next[4] = "user";
$next[5] = true; //available
$next[6] = $LNG->ALERT_DEPENDENT_UNSEEN_BY_ME;
array_push($alertdata, $next);

$next = array();
$next[0] = $LNG->ALERT_TITLE_RESPONSE_TO_ME;
$next[1] = 2;
$next[2] = $LNG->ALERT_DESC_RESPONSE_TO_ME;
$next[3] = $CFG->ALERT_RESPONSE_TO_ME;
$next[4] = "user";
$next[5] = true; //available
$next[6] = $LNG->ALERT_DEPENDENT_RESPONSE_TO_ME;
array_push($alertdata, $next);

$next = array();
$next[0] = $LNG->ALERT_TITLE_UNRATED_BY_ME;
$next[1] = 3;
$next[2] = $LNG->ALERT_DESC_UNRATED_BY_ME;
$next[3] = $CFG->ALERT_UNRATED_BY_ME;
$next[4] = "user";
$next[5] = true; //available
$next[6] = $LNG->ALERT_DEPENDENT_UNRATED_BY_ME;
array_push($alertdata, $next);

$next = array();
$next[0] = $LNG->ALERT_INTERESTING_TO_ME;
$next[1] = 4;
$next[2] = $LNG->ALERT_DESC_INTERESTING_TO_ME;
$next[3] = $CFG->ALERT_INTERESTING_TO_ME;
$next[4] = "user";
$next[5] = true; //available
$next[6] = $LNG->ALERT_DEPENDENT_INTERESTING_TO_ME;
array_push($alertdata, $next);

$next = array();
$next[0] = $LNG->ALERT_TITLE_INTERESTING_TO_PEOPLE_LIKE_ME;
$next[1] = 5;
$next[2] = $LNG->ALERT_DESC_INTERESTING_TO_PEOPLE_LIKE_ME;
$next[3] = $CFG->ALERT_INTERESTING_TO_PEOPLE_LIKE_ME;
$next[4] = "user";
$next[5] = true; //available
$next[6] = $LNG->ALERT_DEPENDENT_INTERESTING_TO_PEOPLE_LIKE_ME;
array_push($alertdata, $next);

$next = array();
$next[0] = $LNG->ALERT_TITLE_SUPPORTED_BY_PEOPLE_LIKE_ME;
$next[1] = 6;
$next[2] = $LNG->ALERT_DESC_SUPPORTED_BY_PEOPLE_LIKE_ME;
$next[3] = $CFG->ALERT_SUPPORTED_BY_PEOPLE_LIKE_ME;
$next[4] = "user";
$next[5] = false; //available
$next[6] = $LNG->ALERT_DEPENDENT_SUPPORTED_BY_PEOPLE_LIKE_ME;
array_push($alertdata, $next);

$next = array();
$next[0] = $LNG->ALERT_TITLE_HOT_POST;
$next[1] = 7;
$next[2] = $LNG->ALERT_DESC_HOT_POST;
$next[3] = $CFG->ALERT_HOT_POST;
$next[4] = "network";
$next[5] = true; //available
$next[6] = $LNG->ALERT_DEPENDENT_HOT_POST;
array_push($alertdata, $next);

$next = array();
$next[0] = $LNG->ALERT_TITLE_ORPHANED_IDEA;
$next[1] = 8;
$next[2] = $LNG->ALERT_DESC_ORPHANED_IDEA;
$next[3] = $CFG->ALERT_ORPHANED_IDEA;
$next[4] = "network";
$next[5] = true; //available
$next[6] = $LNG->ALERT_DEPENDENT_ORPHANED_IDEA;
array_push($alertdata, $next);

$next = array();
$next[0] = $LNG->ALERT_TITLE_EMERGING_WINNER;
$next[1] = 9;
$next[2] = $LNG->ALERT_DESC_EMERGING_WINNER;
$next[3] = $CFG->ALERT_EMERGING_WINNER;
$next[4] = "network";
$next[5] = true; //available
$next[6] = $LNG->ALERT_DEPENDENT_EMERGING_WINNER;
array_push($alertdata, $next);

$next = array();
$next[0] = $LNG->ALERT_TITLE_CONTENTIOUS_ISSUE;
$next[1] = 10;
$next[2] = $LNG->ALERT_DESC_CONTENTIOUS_ISSUE;
$next[3] = $CFG->ALERT_CONTENTIOUS_ISSUE;
$next[4] = "network";
$next[5] = false; //available
$next[6] = $LNG->ALERT_DEPENDENT_CONTENTIOUS_ISSUE;
array_push($alertdata, $next);

$next = array();
$next[0] = $LNG->ALERT_TITLE_INCONSISTENT_SUPPORT;
$next[1] = 11;
$next[2] = $LNG->ALERT_DESC_INCONSISTENT_SUPPORT;
$next[3] = $CFG->ALERT_INCONSISTENT_SUPPORT;
$next[4] = "network";
$next[5] = false; //available
$next[6] = $LNG->ALERT_DEPENDENT_INCONSISTENT_SUPPORT;
array_push($alertdata, $next);

$next = array();
$next[0] = $LNG->ALERT_TITLE_PEOPLE_WITH_INTERESTS_LIKE_MINE;
$next[1] = 12;
$next[2] = $LNG->ALERT_DESC_PEOPLE_WITH_INTERESTS_LIKE_MINE;
$next[3] = $CFG->ALERT_PEOPLE_WITH_INTERESTS_LIKE_MINE;
$next[4] = "user";
$next[5] = true; //available
$next[6] = $LNG->ALERT_DEPENDENT_PEOPLE_WITH_INTERESTS_LIKE_MINE;
array_push($alertdata, $next);

$next = array();
$next[0] = $LNG->ALERT_TITLE_PEOPLE_WHO_AGREE_WITH_ME;
$next[1] = 13;
$next[2] = $LNG->ALERT_DESC_PEOPLE_WHO_AGREE_WITH_ME;
$next[3] = $CFG->ALERT_PEOPLE_WHO_AGREE_WITH_ME;
$next[4] = "user";
$next[5] = false; //available
$next[6] = $LNG->ALERT_DEPENDENT_PEOPLE_WHO_AGREE_WITH_ME;
array_push($alertdata, $next);

$next = array();
$next[0] = $LNG->ALERT_TITLE_IGNORED_POST;
$next[1] = 14;
$next[2] = $LNG->ALERT_DESC_IGNORED_POST;
$next[3] = $CFG->ALERT_IGNORED_POST;
$next[4] = "network";
$next[5] = true; //available
$next[6] = $LNG->ALERT_DEPENDENT_IGNORED_POST;
array_push($alertdata, $next);

$next = array();
$next[0] = $LNG->ALERT_TITLE_LURKING_USER;
$next[1] = 15;
$next[2] = $LNG->ALERT_DESC_LURKING_USER;
$next[3] = $CFG->ALERT_LURKING_USER;
$next[4] = "user";
$next[5] = true; //available
$next[6] = $LNG->ALERT_DEPENDENT_LURKING_USER;
array_push($alertdata, $next);

$next = array();
$next[0] = $LNG->ALERT_TITLE_INACTIVE_USER;
$next[1] = 16;
$next[2] = $LNG->ALERT_DESC_INACTIVE_USER;
$next[3] = $CFG->ALERT_INACTIVE_USER;
$next[4] = "user";
$next[5] = true; //available
$next[6] = $LNG->ALERT_DEPENDENT_INACTIVE_USER;
array_push($alertdata, $next);

$next = array();
$next[0] = $LNG->ALERT_TITLE_MATURE_ISSUE;
$next[1] = 17;
$next[2] = $LNG->ALERT_DESC_MATURE_ISSUE;
$next[3] = $CFG->ALERT_MATURE_ISSUE;
$next[4] = "network";
$next[5] = true; //available
$next[6] = $LNG->ALERT_DEPENDENT_MATURE_ISSUE;
array_push($alertdata, $next);

$next = array();
$next[0] = $LNG->ALERT_TITLE_IMMATURE_ISSUE;
$next[1] = 18;
$next[2] = $LNG->ALERT_DESC_IMMATURE_ISSUE;
$next[3] = $CFG->ALERT_IMMATURE_ISSUE;
$next[4] = "network";
$next[5] = true; //available
$next[6] = $LNG->ALERT_DEPENDENT_IMMATURE_ISSUE;
array_push($alertdata, $next);

$next = array();
$next[0] = $LNG->ALERT_TITLE_USER_GONE_INACTIVE;
$next[1] = 19;
$next[2] = $LNG->ALERT_DESC_USER_GONE_INACTIVE;
$next[3] = $CFG->ALERT_USER_GONE_INACTIVE;
$next[4] = "user";
$next[5] = true; //available
$next[6] = $LNG->ALERT_DEPENDENT_USER_GONE_INACTIVE;
array_push($alertdata, $next);

$next = array();
$next[0] = $LNG->ALERT_TITLE_CONTROVERSIAL_IDEA;
$next[1] = 20;
$next[2] = $LNG->ALERT_DESC_CONTROVERSIAL_IDEA;
$next[3] = $CFG->ALERT_CONTROVERSIAL_IDEA;
$next[4] = "network";
$next[5] = true; //available
$next[6] = $LNG->ALERT_DEPENDENT_CONTROVERSIAL_IDEA;
array_push($alertdata, $next);

$next = array();
$next[0] = $LNG->ALERT_TITLE_WELL_EVALUATED_IDEA;
$next[1] = 21;
$next[2] = $LNG->ALERT_DESC_WELL_EVALUATED_IDEA;
$next[3] = $CFG->ALERT_WELL_EVALUATED_IDEA;
$next[4] = "network";
$next[5] = false; //available
$next[6] = $LNG->ALERT_DEPENDENT_WELL_EVALUATED_IDEA;
array_push($alertdata, $next);

$next = array();
$next[0] = $LNG->ALERT_TITLE_POORLY_EVALUATED_IDEA;
$next[1] = 22;
$next[2] = $LNG->ALERT_DESC_POORLY_EVALUATED_IDEA;
$next[3] = $CFG->ALERT_POORLY_EVALUATED_IDEA;
$next[4] = "network";
$next[5] = false; //available
$next[6] = $LNG->ALERT_DEPENDENT_POORLY_EVALUATED_IDEA;
array_push($alertdata, $next);

$next = array();
$next[0] = $LNG->ALERT_TITLE_RATING_IGNORED_ARGUMENT;
$next[1] = 23;
$next[2] = $LNG->ALERT_DESC_RATING_IGNORED_ARGUMENT;
$next[3] = $CFG->ALERT_RATING_IGNORED_ARGUMENT;
$next[4] = "network";
$next[5] = true; //available
$next[6] = $LNG->ALERT_DEPENDENT_RATING_IGNORED_ARGUMENT;
array_push($alertdata, $next);

$next = array();
$next[0] = $LNG->ALERT_TITLE_UNSEEN_RESPONSE;
$next[1] = 24;
$next[2] = $LNG->ALERT_DESC_UNSEEN_RESPONSE;
$next[3] = $CFG->ALERT_UNSEEN_RESPONSE;
$next[4] = "user";
$next[5] = true; //available
$next[6] = $LNG->ALERT_DEPENDENT_UNSEEN_RESPONSE;
array_push($alertdata, $next);

$next = array();
$next[0] = $LNG->ALERT_TITLE_UNSEEN_COMPETITOR;
$next[1] = 25;
$next[2] = $LNG->ALERT_DESC_UNSEEN_COMPETITOR;
$next[3] = $CFG->ALERT_UNSEEN_COMPETITOR;
$next[4] = "user";
$next[5] = true; //available
$next[6] = $LNG->ALERT_DEPENDENT_UNSEEN_COMPETITOR;
array_push($alertdata, $next);

$next = array();
$next[0] = $LNG->ALERT_TITLE_USER_IGNORED_COMPETITORS;
$next[1] = 26;
$next[2] = $LNG->ALERT_DESC_USER_IGNORED_COMPETITORS;
$next[3] = $CFG->ALERT_USER_IGNORED_COMPETITORS;
$next[4] = "network";
$next[5] = true; //available
$next[6] = $LNG->ALERT_DEPENDENT_USER_IGNORED_COMPETITORS;
array_push($alertdata, $next);

$next = array();
$next[0] = $LNG->ALERT_TITLE_USER_IGNORED_ARGUMENTS;
$next[1] = 27;
$next[2] = $LNG->ALERT_DESC_USER_IGNORED_ARGUMENTS;
$next[3] = $CFG->ALERT_USER_IGNORED_ARGUMENTS;
$next[4] = "network";
$next[5] = true; //available
$next[6] = $LNG->ALERT_DEPENDENT_USER_IGNORED_ARGUMENTS;
array_push($alertdata, $next);

$next = array();
$next[0] = $LNG->ALERT_TITLE_USER_IGNORED_RESPONSES;
$next[1] = 28;
$next[2] = $LNG->ALERT_DESC_USER_IGNORED_RESPONSES;
$next[3] = $CFG->ALERT_USER_IGNORED_RESPONSES;
$next[4] = "network";
$next[5] = true; //available
$next[6] = $LNG->ALERT_DEPENDENT_USER_IGNORED_RESPONSES;
array_push($alertdata, $next);
?>

