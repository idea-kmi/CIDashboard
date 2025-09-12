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
 * languagecore.php
 *
 * Author: Michelle Bachler, KMi, The Open University
 *
 * This file holds the default text for the main datamodel node types and link types.
 * These may be reference inside other language files so the terms can easily be changed and ripple through.
 */

/** Singular **/
$LNG->CHALLENGE_NAME = "Challenge";
$LNG->ISSUE_NAME = "Issue";
$LNG->SOLUTION_NAME = "Idea";
$LNG->ARGUMENT_NAME = "Argument";
$LNG->PRO_NAME = "Supporting Argument";
$LNG->CON_NAME = "Counter Argument";
$LNG->RESOURCE_NAME = "Url";
$LNG->COMMENT_NAME = "Comment";
$LNG->IDEA_NAME = "Note";
$LNG->DECISION_NAME = "Decision";
$LNG->MAP_NAME = "Map";
$LNG->DEBATE_NAME = "Conversation";
$LNG->GROUP_NAME = 'Group';

/** Plural **/
$LNG->CHALLENGES_NAME = "Challenges";
$LNG->ISSUES_NAME = "Issues";
$LNG->SOLUTIONS_NAME = "Ideas";
$LNG->ARGUMENTS_NAME = "Arguments";
$LNG->PROS_NAME = "Supporting Arguments";
$LNG->CONS_NAME = "Counter Arguments";
$LNG->RESOURCES_NAME = "Urls";
$LNG->COMMENTS_NAME = "Comments";
$LNG->IDEAS_NAME = "Notes";
$LNG->DECISIONS_NAME = "Decisions";
$LNG->MAPS_NAME = "Maps";
$LNG->DEBATES_NAME = "Conversations";
$LNG->GROUPS_NAME = 'Groups';

/** Link Type Name **/
$LNG->LINK_ISSUE_CHALLENGE = 'is related to';
$LNG->LINK_SOLUTION_ISSUE = 'responds to';
$LNG->LINK_ISSUE_SOLUTION = 'responds to';
$LNG->LINK_PRO_SOLUTION = 'supports';
$LNG->LINK_CON_SOLUTION = 'challenges';
$LNG->LINK_RESOURCE_NODE = 'is related to';
$LNG->LINK_COMMENT_NODE = 'is related to';
$LNG->LINK_COMMENT_COMMENT = 'responds to';
$LNG->LINK_IDEA_NODE = 'responds to';
$LNG->LINK_DECISION_ISSUE = 'responds to';
?>