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
 /** Author: Michelle Bachler, KMi, The Open University **/
 ?>

<div style="background:transparent;clear:both; float:left; width: 100%;">
	<div style="float:left;clear:both;margin-top:10px;margin-bottom:10px;"><?php echo $LNG->HELP_LANG_MESSAGE; ?></div>

	<h3 style="float:left;margin-top:10px;"><?php echo $LNG->HELP_LANG_NODE_TITLE; ?></h3>

	<table style="float:left;width:100%;border-collapse:collapse;border:1px solid #C0C0C0" border="1">
		<tr>
			<td><b><?php echo $LNG->HELP_LANG_COLUMN_TERM; ?></b></td>
			<td><b><?php echo $LNG->HELP_LANG_COLUMN_CIF; ?></b></td>
			<td><b><?php echo $LNG->HELP_LANG_COLUMN_SINGULAR; ?></b></td>
			<td><b><?php echo $LNG->HELP_LANG_COLUMN_PLURAL; ?></b></td>
		</tr>
		<tr>
			<td>CHALLENGE_NAME</td>
			<td>Question</td>
			<td><?php echo $LNG->CHALLENGE_NAME; ?></td>
			<td><?php echo $LNG->CHALLENGES_NAME; ?></td>
		</tr>
		<tr>
			<td>ISSUE_NAME</td>
			<td>Issue</td>
			<td><?php echo $LNG->ISSUE_NAME; ?></td>
			<td><?php echo $LNG->ISSUES_NAME; ?></td>
		</tr>
		<tr>
			<td>SOLUTION_NAME</td>
			<td>Position</td>
			<td><?php echo $LNG->SOLUTION_NAME; ?></td>
			<td><?php echo $LNG->SOLUTIONS_NAME; ?></td>
		</tr>
		<tr>
			<td>ARGUMENT_NAME</td>
			<td>Argument</td>
			<td><?php echo $LNG->ARGUMENT_NAME; ?></td>
			<td><?php echo $LNG->ARGUMENTS_NAME; ?></td>
		</tr>
		<tr>
			<td>PRO_NAME</td>
			<td><i><?php echo $LNG->HELP_LANG_PRO_NAME; ?></i></td>
			<td><?php echo $LNG->PRO_NAME; ?></td>
			<td><?php echo $LNG->PROS_NAME; ?></td>
		</tr>
		<tr>
			<td>CON_NAME</td>
			<td><i><?php echo $LNG->HELP_LANG_CON_NAME; ?></i></td>
			<td><?php echo $LNG->CON_NAME; ?></td>
			<td><?php echo $LNG->CONS_NAME; ?></td>
		</tr>
		<tr>
			<td>RESOURCE_NAME</td>
			<td>Reference</td>
			<td><?php echo $LNG->RESOURCE_NAME; ?></td>
			<td><?php echo $LNG->RESOURCES_NAME; ?></td>
		</tr>
		<tr>
			<td>IDEA_NAME</td>
			<td>GenericIdea &amp; GenericIdeaNode</td>
			<td><?php echo $LNG->IDEA_NAME; ?></td>
			<td><?php echo $LNG->IDEAS_NAME; ?></td>
		</tr>
		<tr>
			<td>COMMENT_NAME</td>
			<td>SPost</td>
			<td><?php echo $LNG->COMMENTS_NAME; ?></td>
			<td><?php echo $LNG->COMMENTS_NAME; ?></td>
		</tr>
		<tr>
			<td>MAP_NAME</td>
			<td>Map</td>
			<td><?php echo $LNG->MAP_NAME; ?></td>
			<td><?php echo $LNG->MAPS_NAME; ?></td>
		</tr>
		<tr>
			<td>DECISION_NAME</td>
			<td>Decision</td>
			<td><?php echo $LNG->DECISION_NAME; ?></td>
			<td><?php echo $LNG->DECISIONS_NAME; ?></td>
		</tr>
		<tr>
			<td>DEBATE_NAME</td>
			<td><i><?php echo $LNG->HELP_LANG_DEBATE_NAME; ?></i></td>
			<td><?php echo $LNG->DEBATE_NAME; ?></td>
			<td><?php echo $LNG->DEBATES_NAME; ?></td>
		</tr>
		<tr>
			<td>GROUP_NAME</td>
			<td><i><?php echo $LNG->HELP_LANG_GROUP_NAME; ?></i></td>
			<td><?php echo $LNG->GROUP_NAME; ?></td>
			<td><?php echo $LNG->GROUPS_NAME; ?></td>
		</tr>
	</table>

	<h3 style="float:left;margin-top:10px;"><?php echo $LNG->HELP_LANG_LINK_TITLE; ?></h3>

	<div style="float:left;clear:both;margin-bottom:5px;"><?php echo $LNG->HELP_LANG_LINK_MESSAGE; ?></div>

	<table style="clear:both;float:left;width:100%;border-collapse:collapse;border:1px solid #C0C0C0" border="1">
		<tr>
			<td><b><?php echo $LNG->HELP_LANG_COLUMN_TERM; ?></b></td>
			<td><b><?php echo $LNG->HELP_LANG_COLUMN_CIF; ?></b></td>
			<td><b><?php echo $LNG->HELP_LANG_COLUMN_TEXT; ?></b></td>
		</tr>
		<tr>
			<td>LINK_ISSUE_CHALLENGE</td>
			<td>IssueQuestions</td>
			<td><?php echo $LNG->LINK_ISSUE_CHALLENGE; ?></td>
		</tr>
		<tr>
			<td>LINK_SOLUTION_ISSUE</td>
			<td>PositionRespondsToIssue &amp; InclusionRelation</td>
			<td><?php echo $LNG->LINK_SOLUTION_ISSUE; ?></td>
		</tr>
		<tr>
			<td>LINK_ISSUE_SOLUTION</td>
			<td>IssueAppliesTo</td>
			<td><?php echo $LNG->LINK_ISSUE_SOLUTION; ?></td>
		</tr>
		<tr>
			<td>LINK_PRO_SOLUTION</td>
			<td>ArgumentSupportsIdea</td>
			<td><?php echo $LNG->LINK_PRO_SOLUTION; ?></td>
		</tr>
		<tr>
			<td>LINK_CON_SOLUTION</td>
			<td>ArgumentOpposesIdea</td>
			<td><?php echo $LNG->LINK_CON_SOLUTION; ?></td>
		</tr>
		<tr>
			<td>LINK_RESOURCE_NODE</td>
			<td><i>Reference &mdash;&gt; Node</i></td>
			<td><?php echo $LNG->LINK_RESOURCE_NODE; ?></td>
		</tr>
		<tr>
			<td>LINK_IDEA_NODE</td>
			<td>DirectedIdeaRelation</td>
			<td><?php echo $LNG->LINK_IDEA_NODE; ?></td>
		</tr>
		<tr>
			<td>LINK_COMMENT_COMMENT</td>
			<td><i>SPost &mdash;&gt; SPost</i></td>
			<td><?php echo $LNG->LINK_COMMENT_COMMENT; ?></td>
		</tr>
		<tr>
			<td>LINK_COMMENT_NODE</td>
			<td><i>SPost &mdash;&gt; Idea</i></td>
			<td><?php echo $LNG->LINK_COMMENT_NODE; ?></td>
		</tr>
		<tr>
			<td>LINK_DECISION_ISSUE</td>
			<td><i>Decision &mdash;&gt; Issue</i></td>
			<td><?php echo $LNG->LINK_DECISION_ISSUE; ?></td>
		</tr>
	</table>

	<div style="clear:both;float:left;margin-top:30px;"><?php echo $LNG->HELP_LANG_MESSAGE2; ?></div>

	<div style="clear:both;float:left;color:black;clear:both;float:left;">
	<pre>
[
    {
  	"term": "CHALLENGE_NAME",
	"label": [
	      {
	         "language": "en",
	         "singular": "Challenge",
	         "plural": "Challenges"
	      }
	]
    },
    {
  	"term": "ISSUE_NAME",
	"label": [
	      {
	        "language": "en",
	 	"singular": "Issue",
	 	"plural": "Issues"
	      }
	]
    },
    {
  	"term": "SOLUTION_NAME",
	"label": [
	      {
	        "language": "en",
	 	"singular": "Idea",
	 	"plural": "Ideas"
	      }
	]
    },
    {
  	"term": "ARGUMENT_NAME",
	"label": [
	      {
	        "language": "en",
	 	"singular": "Argument",
	 	"plural": "Arguments"
	      }
	]
    },
    {
  	"term": "PRO_NAME",
	"label": [
	      {
	        "language": "en",
	 	"singular": "Supporting Argument",
	 	"plural": "Supporting Arguments"
	      }
	]
    },
    {
  	"term": "CON_NAME",
	"label": [
	      {
	        "language": "en",
	 	"singular": "Counter Argument",
	 	"plural": "Counter Arguments"
	      }
	]
    },
    {
  	"term": "RESOURCE_NAME",
	"label": [
	      {
	        "language": "en",
	 	"singular": "Url",
	 	"plural": "Urls"
	      }
	]
    },
    {
  	"term": "COMMENT_NAME",
	"label": [
	      {
	        "language": "en",
	 	"singular": "Comment",
	 	"plural": "Comments"
	      }
	]
    },
    {
  	"term": "IDEA_NAME",
	"label": [
	      {
	        "language": "en",
	 	"singular": "Note",
	 	"plural": "Notes"
	      }
	]
    },
    {
  	"term": "DECISION_NAME",
	"label": [
	      {
	        "language": "en",
	 	"singular": "Decision",
	 	"plural": "Decisions"
	      }
	]
    },
    {
  	"term": "MAP_NAME",
	"label": [
	      {
	        "language": "en",
	 	"singular": "Map",
	 	"plural": "Maps"
	      }
	]
    },
    {
  	"term": "DEBATE_NAME",
	"label": [
	      {
	        "language": "en",
	 	"singular": "Conversation",
	 	"plural": "Conversations"
	      }
	]
    },
    {
  	"term": "LINK_ISSUE_CHALLENGE",
	"label": [
	      {
	        "language": "en",
	 	"text": "is related to"
	      }
	]
    },
    {
  	"term": "LINK_SOLUTION_ISSUE",
	"label": [
	      {
	        "language": "en",
	 	"text": "responds to"
	      }
	]
    },
    {
  	"term": "LINK_ISSUE_SOLUTION",
	"label": [
	      {
	        "language": "en",
	 	"text": "responds to"
	      }
	]
    },
    {
  	"term": "LINK_PRO_SOLUTION",
	"label": [
	      {
	        "language": "en",
	 	"text": "supports"
	      }
	]
    },
    {
  	"term": "LINK_CON_SOLUTION",
	"label": [
	      {
	        "language": "en",
	 	"text": "challenges"
	      }
	]
    },
    {
  	"term": "LINK_RESOURCE_NODE",
	"label": [
	      {
	        "language": "en",
	 	"text": "is related to"
	      }
	]
    },
    {
  	"term": "LINK_COMMENT_NODE",
	"label": [
	      {
	        "language": "en",
	 	"text": "is related to"
	      }
	]
    },
    {
  	"term": "LINK_COMMENT_COMMENT",
	"label": [
	      {
	        "language": "en",
	 	"text": "responds to"
	      }
	]
    },
    {
  	"term": "LINK_IDEA_NODE",
	"label": [
	      {
	        "language": "en",
	 	"text": "responds to"
	      }
	]
    },
    {
  	"term": "LINK_DECISION_ISSUE",
	"label": [
	      {
	        "language": "en",
	 	"text": "responds to"
	      }
	]
    }
]

	</pre>
	</div>
</div>
