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
 * languagecore.php
 *
 * Michelle Bachler (KMi)
 *
 * This file holds the default text for the main datamodel node types and link types for the LiteMap.
 * These item are referenced throughout the other Language files to expediate the ability to change central
 * terms quickly.
 */

/** Singular **/
$LNG->CHALLENGE_NAME = "Thema";
$LNG->ISSUE_NAME = "Fragestellung";
$LNG->SOLUTION_NAME = "Aspekt";
$LNG->ARGUMENT_NAME = "Argument";
$LNG->PRO_NAME = "Pro Argument";
$LNG->CON_NAME = "Contra Argument";
$LNG->RESOURCE_NAME = "Url";
$LNG->COMMENT_NAME = "Kommentar";
$LNG->IDEA_NAME = "Notiz";
$LNG->DECISION_NAME = "Entscheidung";
$LNG->MAP_NAME = "Karte";
$LNG->DEBATE_NAME = "Unterhaltung";
$LNG->GROUP_NAME = 'Gruppe';

/** Plural **/
$LNG->CHALLENGES_NAME = "Themen";
$LNG->ISSUES_NAME = "Fragestellungen";
$LNG->SOLUTIONS_NAME = "Aspekte";
$LNG->ARGUMENTS_NAME = "Argumente";
$LNG->PROS_NAME = "Pro Argumente";
$LNG->CONS_NAME = "Contra Argumente";
$LNG->RESOURCES_NAME = "Urls";
$LNG->COMMENTS_NAME = "Kommentare";
$LNG->IDEAS_NAME = "Notizen";
$LNG->DECISIONS_NAME = "Entscheidungen";
$LNG->MAPS_NAME = "Karten";
$LNG->DEBATES_NAME = "Gespräche";
$LNG->GROUPS_NAME = 'Gruppen';

/** Link Type Name **/
$LNG->LINK_ISSUE_CHALLENGE = 'ist Teil von';
$LNG->LINK_SOLUTION_ISSUE = 'beantwortet';
$LNG->LINK_ISSUE_SOLUTION = 'beantwortet';
$LNG->LINK_PRO_SOLUTION = 'unterstÃ¼tzt';
$LNG->LINK_CON_SOLUTION = 'fordert heraus';
$LNG->LINK_RESOURCE_NODE = 'ist Teil von';
$LNG->LINK_COMMENT_NODE = 'ist Teil von';
$LNG->LINK_COMMENT_COMMENT = 'beantwortet';
$LNG->LINK_IDEA_NODE = 'beantwortet';
$LNG->LINK_DECISION_ISSUE = 'beantwortet';
?>