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
 * languagecore.php
 *
 * Author: Michelle Bachler, KMi, The Open University
 * Translation by: Alexandre Marino Costa
 *
 * This file holds the default text for the main datamodel node types and link types and core terms.
 * These may be reference inside other language files so the terms can easily be changed and ripple through.
 */

/** Singular **/
$LNG->CHALLENGE_NAME = "Desafio";
$LNG->ISSUE_NAME = "Problema";
$LNG->SOLUTION_NAME = "Idéia";
$LNG->ARGUMENT_NAME = "Argumento";
$LNG->PRO_NAME = "Argumento a favor";
$LNG->CON_NAME = "Argumento contra";
$LNG->RESOURCE_NAME = "Url";
$LNG->COMMENT_NAME = "Comentário";
$LNG->IDEA_NAME = "Nota";
$LNG->DECISION_NAME = "Decisão";
$LNG->MAP_NAME = "Mapa";
$LNG->DEBATE_NAME = "Conversa";
$LNG->GROUP_NAME = "Grupo";

/** Plural **/
$LNG->CHALLENGES_NAME = "Desafios";
$LNG->ISSUES_NAME = "Problemas";
$LNG->SOLUTIONS_NAME = "Idéias";
$LNG->ARGUMENTS_NAME = "Argumentos";
$LNG->PROS_NAME = "Argumentos a favor";
$LNG->CONS_NAME = "Argumentos contra";
$LNG->RESOURCES_NAME = "Urls";
$LNG->COMMENTS_NAME = "Comentários";
$LNG->IDEAS_NAME = "Notas";
$LNG->DECISIONS_NAME = "Decisões";
$LNG->MAPS_NAME = "Mapas";
$LNG->DEBATES_NAME = "Conversas";
$LNG->GROUPS_NAME = "Grupos";

/** Link Type Name **/
$LNG->LINK_ISSUE_CHALLENGE = 'está relacionado com';
$LNG->LINK_SOLUTION_ISSUE = 'responde a';
$LNG->LINK_ISSUE_SOLUTION = 'responde a';
$LNG->LINK_PRO_SOLUTION = 'apoios';
$LNG->LINK_CON_SOLUTION = 'desafios';
$LNG->LINK_RESOURCE_NODE = 'está relacionado a';
$LNG->LINK_COMMENT_NODE = 'está relacionado a';
$LNG->LINK_COMMENT_COMMENT = 'responde a';
$LNG->LINK_IDEA_NODE = 'responde a';
$LNG->LINK_DECISION_ISSUE = 'responde a';
?>