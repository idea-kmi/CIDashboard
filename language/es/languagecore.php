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
 *
 * This file holds the default text for the main datamodel node types and link types.
 * These may be reference inside other language files so the terms can easily be changed and ripple through.
 */

/** Singular **/
$LNG->CHALLENGE_NAME = "Desafío";
$LNG->ISSUE_NAME = "Pregunta";
$LNG->SOLUTION_NAME = "Idea";
$LNG->ARGUMENT_NAME = "Argumento";
$LNG->PRO_NAME = "Argumento Apoyo";
$LNG->CON_NAME = "Argumento Contrario";
$LNG->RESOURCE_NAME = "Url";
$LNG->COMMENT_NAME = "Comentario";
$LNG->IDEA_NAME = "Nota";
$LNG->DECISION_NAME = "Decisión";
$LNG->MAP_NAME = "Mapa";
$LNG->DEBATE_NAME = "Conversación";
$LNG->GROUP_NAME = "Grupo";

/** Plural **/
$LNG->CHALLENGES_NAME = "Desafíos";
$LNG->ISSUES_NAME = "Cuestiones";
$LNG->SOLUTIONS_NAME = "Ideas";
$LNG->ARGUMENTS_NAME = "Argumentos";
$LNG->PROS_NAME = "Argumentos Apoyo";
$LNG->CONS_NAME = "Argumentos Contrario";
$LNG->RESOURCES_NAME = "Urls";
$LNG->COMMENTS_NAME = "Comentarios";
$LNG->IDEAS_NAME = "Notas";
$LNG->DECISIONS_NAME = "Decisiones";
$LNG->MAPS_NAME = "Mapas";
$LNG->DEBATES_NAME = "Conversaciones";
$LNG->GROUPS_NAME = "Grupos";

/** Link Type Name **/
$LNG->LINK_ISSUE_CHALLENGE = 'está relacionado a';
$LNG->LINK_SOLUTION_ISSUE = 'responde a';
$LNG->LINK_ISSUE_SOLUTION = 'responde a';
$LNG->LINK_PRO_SOLUTION = 'soportes';
$LNG->LINK_CON_SOLUTION = 'desafíos';
$LNG->LINK_RESOURCE_NODE = 'está relacionado a';
$LNG->LINK_COMMENT_NODE = 'está relacionado a';
$LNG->LINK_COMMENT_COMMENT = 'responde a';
$LNG->LINK_IDEA_NODE = 'responde a';
$LNG->LINK_DECISION_ISSUE = 'responde a';
?>