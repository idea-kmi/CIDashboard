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
 * stats.php
 * This holds the language for the Visualisations.
 *
 * Author: Michelle Bachler, KMi, The Open University
 */

/** General **/
$LNG->STATS_DEBATE_CONTRIBUTION_HELP = 'This traffic light indicates how balanced the types of contributions are to the debate. If one of the types ('.$LNG->SOLUTION_NAME.', '.$LNG->PRO_NAME.', '.$LNG->CON_NAME.', or Votes) is barley represented (under 10%) it will show a red traffic light. If one of the types is under-represented (under 20%) then it shows a yellow traffic light. Otherwise, the types are balanced and it will show a green traffic light.';
$LNG->STATS_DEBATE_VIEWING_HELP = 'This indicator represents the percentage of members of this group who viewed this issue. If 50% or more members of this group viewed this issue then it will show a green traffic light. If 20% to 49% viewed it then it will show a yellow traffic light. If less than 20% viewed this issue it will show a red traffic light.';
$LNG->STATS_HELP_HINT = "Click to show/hide visualisation description.";
$LNG->STATS_VIS_ERROR_BIASSPACE = 'Sorry, your data could not yet be visualised as the underlying metric needs more data';
$LNG->STATS_VIS_ERROR_TOPICSPACE = 'Sorry, your data could not yet be visualised as the underlying metric needs more data';

/** Vis Names/Dashboard Tabs **/
$LNG->STATS_TAB_HOME = "Home";
$LNG->STATS_VIS_TITLE_NETWORK = $LNG->DEBATE_NAME.' Network';
$LNG->STATS_VIS_TITLE_SOCIAL = 'Social Network';
$LNG->STATS_VIS_TITLE_SUNBURST = 'People & Issue Ring';
$LNG->STATS_VIS_TITLE_STACKEDAREA = 'Contribution River';
$LNG->STATS_VIS_TITLE_TOPICSPACE = 'Activity Bias';
$LNG->STATS_VIS_TITLE_BIASSPACE = "Rating Bias";
$LNG->STATS_VIS_TITLE_CIRCLEPACKING = $LNG->DEBATE_NAME.' Nesting';
$LNG->STATS_VIS_TITLE_ACTIVITY= 'Activity Analysis';
$LNG->STATS_VIS_TITLE_USER_ACTIVITY = "User Activity Analysis";
$LNG->STATS_VIS_TITLE_STREAM_GRAPH= "Contribution Stream";
$LNG->STATS_VIS_TITLE_OVERVIEW= "Quick Overview";
$LNG->STATS_VIS_TITLE_CIRCLEPACKING_ATTENTION = "Attention Map";
$LNG->STATS_VIS_TITLE_EDGESENSE_HISTORY = "Edgesense Social Network";
$LNG->STATS_VIS_TITLE_INTEREST_NETWORK = "Community Interest Network";
$LNG->STATS_VIS_TITLE_COMMUNITIES_NETWORK = "Sub-Communities Network";
$LNG->STATS_VIS_TITLE_SUNBURST_NETWORK = $LNG->DEBATE_NAME.' Sunburst Network By Type';
$LNG->STATS_VIS_TITLE_SUNBURST_NETWORK_BRANCH = $LNG->DEBATE_NAME.' Sunburst Network by Branch';
$LNG->STATS_VIS_TITLE_TREEMAP = $LNG->DEBATE_NAME.' Treemap';
$LNG->STATS_VIS_TITLE_TREEMAP_BY_TYPE = $LNG->DEBATE_NAME.' Treemap By Type';
$LNG->STATS_VIS_TITLE_TREEMAP_TOP_DOWN = $LNG->DEBATE_NAME.' Treemap - Top down';
$LNG->STATS_VIS_TITLE_TREEMAP_TOP_DOWN_BY_TYPE = $LNG->DEBATE_NAME.' Treemap - Top down by Type';
$LNG->STATS_VIS_TITLE_TREE = "Collapsible Tree";
$LNG->STATS_VIS_TITLE_TREE_BY_POSTS = "Collapsible Tree by Posts";

/** Vis help texts **/
$LNG->STATS_HELP_HINT = "Click to show/hide visualisation description.";
$LNG->STATS_VIS_HELP_NETWORK = 'This visualisation shows a network of the '.$LNG->DEBATE_NAME.' contributions. There are zoom and orientation controls available below and you can also use your mouse wheel to zoom in and out.';
$LNG->STATS_VIS_HELP_SOCIAL = 'This visualisation shows a network of users participating in the '.$LNG->DEBATE_NAME.'. There are zoom and orientation controls available below and you can also use your mouse wheel to zoom in and out. The connections between users can be either green (mostly supporting connections), red (mostly counter connections), and grey (no dominant connection type).';
$LNG->STATS_VIS_HELP_SUNBURST = 'This visualisation shows users and their connections to '.$LNG->ISSUES_NAME.'. The connections between users and '.$LNG->ISSUES_NAME.' can be either green (mostly '.$LNG->PROS_NAME.'), red (mostly '.$LNG->CONS_NAME.'), and grey (no dominant contribution type). Click on a segment of the visualisation see further information about that member or '.$LNG->ISSUE_NAME.' in the details area panel.';
$LNG->STATS_VIS_HELP_STACKEDAREA = 'This visualisation shows types of contributions over time. Rollover the visualisation to view individual statistics for each type for each date. Click on the visualisation to filter by type. Right click on the visualisation or press the "Remove Filter" to unfilter the visualisation.';

$LNG->STATS_VIS_HELP_TOPICSPACE = '<div><div style="float:left;width:780px;"><div style="float:left;clear:both;">The following visualisation shows contributions to a '.$LNG->DEBATE_NAME.' arranged on a xy-plot. Use this visualisation to find clusters/groupings of contributions. A cluster of contributions represents similar contributions based on the activity of users with them (viewing, editing, updating of contributions, etc.).</div>';
$LNG->STATS_VIS_HELP_TOPICSPACE .= '<div style="float:left;clear:both;margin-top:10px">The example on the top-right shows two clusters (two distinct groups of contributions with each having a distinct activity pattern).  The example on the bottom-right shows only one cluster. Often there are no distinct clusters.</div>';
$LNG->STATS_VIS_HELP_TOPICSPACE .= '<div style="float:left;clear:both;margin-top:10px">Use this visualisations to spot clusters. If the visualisation shows more than one cluster, then this is an indicator of the '.$LNG->DEBATE_NAME.' being biased regarding the interest people show by interacting with the '.$LNG->DEBATE_NAME.'. If there is only one cluster or no cluster, then this is an indicator that the '.$LNG->DEBATE_NAME.' is unbiased.</div>';
$LNG->STATS_VIS_HELP_TOPICSPACE .= '<div style="float:left;clear:both;margin-top:10px">Hover over a contribution point to see more information in the "Detail area".</div></div>';
$LNG->STATS_VIS_HELP_TOPICSPACE .= '<div style="float:left;width:130px;margin-left:10px;"><div style="float:left;">Two clusters<br><img width="100" src="'.$CFG->homeAddress.'images/visualisations/cluster_mani_cluster.png" /></div><div style="clear:both;float:left;margin-top:20px;">One cluster<br><img width="100" src="'.$CFG->homeAddress.'images/visualisations/cluster_mani_nocluster.png" /></div></div></div>';

$LNG->STATS_VIS_HELP_BIASSPACE = '<div><div style="float:left;width:780px;"><div style="float:left;clear:both;">The following visualisation shows contributions to a '.$LNG->DEBATE_NAME.' arranged on a xy-plot. Use this visualisation to find clusters/groupings of contributions. A cluster of contributions represents similar contributions based on the voting by users.</div>';
$LNG->STATS_VIS_HELP_BIASSPACE .= '<div style="float:left;clear:both;margin-top:10px">The example on the top-right shows two clusters (two distinct groups of contributions with each having a distinct voting pattern).  The example on the bottom-right shows only one cluster. Often there are no distinct clusters.</div>';
$LNG->STATS_VIS_HELP_BIASSPACE .= '<div style="float:left;clear:both;margin-top:10px">Use this visualisations to spot clusters. If the visualisation shows more than one cluster, then this is an indicator of the '.$LNG->DEBATE_NAME.' being biased regarding the voting behaviour of people. If there is only one cluster or no cluster, then this is an indicator that the '.$LNG->DEBATE_NAME.' is unbiased.</div>';
$LNG->STATS_VIS_HELP_BIASSPACE .= '<div style="float:left;clear:both;margin-top:10px">Hover over a contribution point to see more information in the "Detail area".</div></div>';
$LNG->STATS_VIS_HELP_BIASSPACE .= '<div style="float:left;width:130px;margin-left:10px;"><div style="float:left;">Two clusters<br><img width="100" src="'.$CFG->homeAddress.'images/visualisations/cluster_mani_cluster.png" /></div><div style="clear:both;float:left;margin-top:20px;">One cluster<br><img width="100" src="'.$CFG->homeAddress.'images/visualisations/cluster_mani_nocluster.png" /></div></div></div>';
$LNG->STATS_VIS_HELP_CIRCLEPACKING = 'The following visualisation provides an overview of the entire '.$LNG->DEBATE_NAME.' as nested circles of contributions. The colours denote the node types as shown in the key. Click on a circle to zoom in, click outside a circle to zoom out. Rollover a cirlce to view the item title as a tooltip.';
$LNG->STATS_VIS_HELP_ACTIVITY = 'The following visualisation shows the activity of a '.$LNG->DEBATE_NAME.' over time. Click on the timeline to cover a period of time (click and drag). The visualisations below will change and will show the frequency of activity per day, the type of contribution ('.$LNG->ISSUE_NAME.', '.$LNG->SOLUTION_NAME.', '.$LNG->PRO_NAME.' and '.$LNG->CON_NAME.'), the type of activity (viewing, adding, or  editing), and in the table below you can see the data underlying the visualisations.  There you can also reset the visualisation to its original state. You can click on the bars of the visualisations to filter for a specific type. You can also select several types by clicking on several bars. Click for example on the '.$LNG->ISSUE_NAME.' and '.$LNG->SOLUTION_NAME.' bar and on the viewing bar to filter for all viewed '.$LNG->ISSUES_NAME.' and '.$LNG->SOLUTIONS_NAME.'.';
$LNG->STATS_VIS_HELP_USER_ACTIVITY = 'The visualisation shows contribution creation and voting by users in this '.$LNG->DEBATE_NAME.'. Click on the "Users" chart to filter by user. Click the "User Actions" chart to filter the page by Action. In both, you can select more than one. You can reset the page by clicking on "Reset All".';
$LNG->STATS_VIS_HELP_STREAM_GRAPH = 'This visualisation shows types of contributions over time. Rollover the visualisation to view individual statistics for each type for each date. Choose between a stacked, stream, and expanded view to inspect contributions over time.';
$LNG->STATS_VIS_HELP_OVERVIEW = 'This visualisations provides an overview of important aspects of a '.$LNG->DEBATE_NAME.'. It contains three '.$LNG->DEBATE_NAME.' health indicators (hover over the question mark next to each traffic light for more information) and several overview visualisations.';
$LNG->STATS_VIS_HELP_CIRCLEPACKING_ATTENTION = 'The following visualisation provides an overview of the entire '.$LNG->DEBATE_NAME.' as nested circles of contributions. The colors of the balls represent inequality. This measures to what extent community interest been applied unequally to the children of each contribution, where 0 = fully equal, 1 = all discussion is on single child. The ball size on the deepest level measures the degree of community interest for those contributions, where interest in a post includes interest in all the posts in the branch below it. Each ball at all levels also displays their Interest rating on rollover. Click on a circle to zoom in, click outside a circle to zoom out. Rollover a cirlce to view the item title as a tooltip.';
$LNG->STATS_VIS_HELP_EDGESENSE_HISTORY = 'This visualisation shows a social network based on the conversation data supplied.';
$LNG->STATS_VIS_HELP_INTEREST_NETWORK = 'This visualisation shows a network of the '.$LNG->DEBATE_NAME.' post connections. The size and colour of the balls represeting the posts are determined by their community interest score. <br>Interest level scores are calculated as follows: viewed = 1; voted on = 2; commented on or connected to = 3; edited = 4.<br>There are zoom and orientation controls available below and you can also use your mouse wheel to zoom in and out.';
$LNG->STATS_VIS_HELP_COMMUNITIES_NETWORK = 'This visualisation shows a network of the '.$LNG->DEBATE_NAME.' post connections. The shape and colour of the nodes represeting the posts are determined by the sub-community clustering. Sub-communities of posts are posts that tend to be looked at together. <br>There are zoom and orientation controls available below and you can also use your mouse wheel to zoom in and out.';
$LNG->STATS_VIS_HELP_SUNBURST_NETWORK = "This visualisation display a network graph of the connected posts in the ".$LNG->DEBATE_NAME." as a layered sunburst coloured by post type. Click segments to refocus the graph.";
$LNG->STATS_VIS_HELP_SUNBURST_NETWORK_BRANCH = "This visualisation display a network graph of the connected posts in the ".$LNG->DEBATE_NAME." as a layered sunburst. The colours show the different branches of the ".$LNG->DEBATE_NAME.". Click segments to refocus the graph.";
$LNG->STATS_VIS_HELP_TREEMAP = "This visualisation displays a treemap of the ".$LNG->DEBATE_NAME.". The coloured blocks represent the leaves of the tree. The colours of the leaves change to represent groups of sibling leaves. Click to zoom.";
$LNG->STATS_VIS_HELP_TREEMAP_BY_TYPE = "This visualisation displays a treemap of the ".$LNG->DEBATE_NAME.". The coloured blocks represent the leaves of the tree. The colours of the leaves change to represent post types. Click to zoom";
$LNG->STATS_VIS_HELP_TREEMAP_TOP_DOWN = "This visualisation displays a treemap of the ".$LNG->DEBATE_NAME.". The first two levels of the tree are exposed initially and then you drill down by clicking the labelled boxes.";
$LNG->STATS_VIS_HELP_TREEMAP_TOP_DOWN_BY_TYPE = "This visualisation displays a treemap of the ".$LNG->DEBATE_NAME.". The first two levels of the tree are exposed initially and then you drill down by clicking the labelled boxes. The box colours show the post type.";
$LNG->STATS_VIS_HELP_TREE = "This visualisation displays a tree of the ".$LNG->DEBATE_NAME.". The circle and link sizes are determined by the number of children below a given node. Click circles to expand/contract levels. Rollover circles to get more information.";
$LNG->STATS_VIS_HELP_TREE_BY_POSTS = "This visualisation displays a tree of the ".$LNG->DEBATE_NAME.". The circle and link sizes are determined by the number of posts below a given node. Posts are not shown in the tree. Click circles to expand/contract levels. Rollover circles to get more information.";

/** Mini vis word counts **/
$LNG->MINI_WORD_STATS_XAXIS_LABEL = 'Total word counts per User';
$LNG->MINI_WORD_STATS_WORDS_MIN = 'minimum single contribution:';
$LNG->MINI_WORD_STATS_WORDS_MAX = 'maximum single contribution:';
$LNG->MINI_WORD_STATS_AVERAGE = 'Average contribution per user:';

/** Mini vis user contributions **/
$LNG->MINI_USER_CONTRIBUTIONS_XAXIS_LABEL = 'Contribution counts by Type';

/** Mini vis user viewing activity **/
$LNG->MINI_USER_VIEWING_HIGHEST = 'Most views: ';
$LNG->MINI_USER_VIEWING_LOWEST = 'Least views: ';
$LNG->MINI_USER_VIEWING_LAST = 'Last views: ';
$LNG->MINI_USER_VIEWING_VIEWS = 'views';
$LNG->MINI_USER_VIEWING_ON = 'on the';
$LNG->MINI_USER_VIEWING_XAXIS_LABEL = 'View counts by date';

/** Attention Map **/
$LNG->ATTENTION_MAP_KEY_NAME = 'Inequality Rating';
$LNG->ATTENTION_MAP_INTEREST = 'Interest Rating';
$LNG->ATTENTION_MAP_INEQULAITY = 'Inequality Rating';

/** Overview visulaisation **/
$LNG->STATS_OVERVIEW_MAIN_TITLE='Overview';
$LNG->STATS_OVERVIEW_WORDS_MESSAGE = 'Word count statistics:';
$LNG->STATS_OVERVIEW_CONTRIBUTION_MESSAGE = 'User contributions';
$LNG->STATS_OVERVIEW_VIEWING_MESSAGE = "User viewing activity";
$LNG->STATS_OVERVIEW_HEALTH_TITLE = $LNG->DEBATE_NAME.' Health Indicators';
$LNG->STATS_OVERVIEW_HEALTH_PROBLEM = 'There is a problem.';
$LNG->STATS_OVERVIEW_HEALTH_NO_PROBLEM = 'There seems to be no problem.';
$LNG->STATS_OVERVIEW_HEALTH_MAYBE_PROBLEM = 'There might be a problem.';
$LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION_TITLE = 'Contribution Activity Indicator';
$LNG->STATS_OVERVIEW_HEALTH_VIEWING_TITLE = 'Viewing Activity Indicator';
$LNG->STATS_OVERVIEW_HEALTH_PARTICIPATION_TITLE = 'Participation Indicator';
$LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTORS = 'participated in this '.$LNG->DEBATE_NAME.".";
$LNG->STATS_OVERVIEW_HEALTH_VIEWERS = '';
$LNG->STATS_OVERVIEW_HEALTH_VIEWERS_PART2 = 'viewed this '.$LNG->DEBATE_NAME;
$LNG->STATS_OVERVIEW_HEALTH_VIEWERS_RED = ' in the last last 14 days';
$LNG->STATS_OVERVIEW_HEALTH_VIEWERS_ORANGE = ' between 6 and 14 days ago';
$LNG->STATS_OVERVIEW_HEALTH_VIEWERS_GREEN = ' in the last 5 days';
$LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION = ' contributed';
$LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION_RED = ' in the last last 14 days';
$LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION_ORANGE = ' between 6 and 14 days ago';
$LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION_GREEN = ' in the last 5 days';
$LNG->STATS_OVERVIEW_LOADING_MESSAGE = '(Loading Overview Statistics. These may take a a short while to calculate depending on the size of the discourse data...)';
$LNG->STATS_OVERVIEW_TOP_THREE_VOTES_MESSAGE = 'Most voted on entries:';
$LNG->STATS_OVERVIEW_RECENT_NODES_MESSAGE = 'Most recently added:';
$LNG->STATS_OVERVIEW_RECENT_VOTES_MESSAGE = 'Most recently voted on:';
$LNG->STATS_OVERVIEW_DATE = 'Date:';
$LNG->STATS_OVERVIEW_VOTES = 'Votes:';
$LNG->STATS_OVERVIEW_TIME = 'time';
$LNG->STATS_OVERVIEW_TIMES = 'times';
$LNG->STATS_OVERVIEW_PERSON = 'person';
$LNG->STATS_OVERVIEW_PEOPLE = 'people';
$LNG->STATS_OVERVIEW_WORDS_AVERAGE = 'Average contribution:';
$LNG->STATS_OVERVIEW_WORDS = 'words';
$LNG->STATS_OVERVIEW_WORDS_MIN = 'minimum:';
$LNG->STATS_OVERVIEW_WORDS_MAX = 'maximum:';
$LNG->STATS_OVERVIEW_VIEWING_HIGHEST = 'Highest viewing count was';
$LNG->STATS_OVERVIEW_VIEWING_LOWEST = 'Lowest viewing count was';
$LNG->STATS_OVERVIEW_VIEWING_LAST = 'Last viewing count was';
$LNG->STATS_OVERVIEW_VIEWING_VIEWS = 'views';
$LNG->STATS_OVERVIEW_HEALTH_PARTICIPATION_HINT = 'If less than 3 people have participated in this '.$LNG->DEBATE_NAME.' then this will show a red traffic light. If between 3 and 5 people have participated in this '.$LNG->DEBATE_NAME.' then this will show an orange traffic light. If more than 5 people have participated in this '.$LNG->DEBATE_NAME.' then this will show a green traffic light.';
$LNG->STATS_OVERVIEW_HEALTH_VIEWING_HINT = 'If no people have viewied this '.$LNG->DEBATE_NAME.' for more than 14 days, this will show a red traffic light. If people have viewed this '.$LNG->DEBATE_NAME.' between 6 and 14 days ago this will show an orange traffic light. If people have viewed this '.$LNG->DEBATE_NAME.' in the last 5 days this will show a green traffic light.';
$LNG->STATS_OVERVIEW_HEALTH_CONTRIBUTION_HINT = 'If people have not added a new entry to this '.$LNG->DEBATE_NAME.' for more than 14 days, this will show a red traffic light. If people have added a new entry to this '.$LNG->DEBATE_NAME.' between 6 and 14 days ago this will show an orange traffic light. If people have added a new entry to this '.$LNG->DEBATE_NAME.' in the last 5 days this will show a green traffic light.';

/** Activity graphs **/
$LNG->STATS_ACTIVITY_COLUMN_DATE = 'Date';
$LNG->STATS_ACTIVITY_COLUMN_TITLE = 'Title';
$LNG->STATS_ACTIVITY_COLUMN_ITEM_TYPE = 'Contribution Type';
$LNG->STATS_ACTIVITY_COLUMN_TYPE = 'Activity Type';
$LNG->STATS_ACTIVITY_COLUMN_ACTION = 'User Action';
$LNG->STATS_ACTIVITY_FILTER_DATE_TITLE = 'Date';
$LNG->STATS_ACTIVITY_FILTER_DAYS_TITLE = 'Days of Week';
$LNG->STATS_ACTIVITY_FILTER_ITEM_TYPES_TITLE = 'Contribution Types';
$LNG->STATS_ACTIVITY_FILTER_TYPES_TITLE = 'Activity Types';
$LNG->STATS_ACTIVITY_FILTER_USERS_TITLE = 'Users';
$LNG->STATS_ACTIVITY_FILTER_ACTION_TITLE = 'User Actions';
$LNG->STATS_ACTIVITY_USER_ANONYMOUS = "u";

$LNG->STATS_ACTIVITY_CREATE = 'Create';
$LNG->STATS_ACTIVITY_UPDATE = 'Update';
$LNG->STATS_ACTIVITY_DELETE = 'Delete';
$LNG->STATS_ACTIVITY_VIEW = 'View';
$LNG->STATS_ACTIVITY_VOTE = 'Vote';
$LNG->STATS_ACTIVITY_VOTED_FOR = 'Voted For';
$LNG->STATS_ACTIVITY_VOTED_AGAINST = 'Voted Against';

$LNG->STATS_ACTIVITY_SUNDAY = 'Sun';
$LNG->STATS_ACTIVITY_MONDAY = 'Mon';
$LNG->STATS_ACTIVITY_TUESDAY = 'Tue';
$LNG->STATS_ACTIVITY_WEDNESDAY = 'Wed';
$LNG->STATS_ACTIVITY_THURSDAY = 'Thu';
$LNG->STATS_ACTIVITY_FRIDAY = 'Fri';
$LNG->STATS_ACTIVITY_SATURDAY = 'Sat';

$LNG->STATS_ACTIVITY_JAN = 'January';
$LNG->STATS_ACTIVITY_FEB = 'February';
$LNG->STATS_ACTIVITY_MAR = 'March';
$LNG->STATS_ACTIVITY_APR = 'April';
$LNG->STATS_ACTIVITY_MAY = 'May';
$LNG->STATS_ACTIVITY_JUN = 'June';
$LNG->STATS_ACTIVITY_JUL = 'July';
$LNG->STATS_ACTIVITY_AUG = 'August';
$LNG->STATS_ACTIVITY_SEP = 'September';
$LNG->STATS_ACTIVITY_OCT = 'October';
$LNG->STATS_ACTIVITY_NOV = 'Nov';
$LNG->STATS_ACTIVITY_DEC = 'Dec';

$LNG->STATS_ACTIVITY_SELECTED_COUNT_MESSAGE_PART1 = 'selected out of';
$LNG->STATS_ACTIVITY_SELECTED_COUNT_MESSAGE_PART2 = 'records';
$LNG->STATS_ACTIVITY_RESET_ALL_BUTTON = 'Reset All';

$LNG->STATS_ACTIVITY_ADDED = 'Added';

/** Scatterplots **/
$LNG->STATS_SCATTERPLOT_DETAILS_COUNT = "Entries:";
$LNG->STATS_SCATTERPLOT_DETAILS = "Details Area";
$LNG->STATS_SCATTERPLOT_DETAILS_CLICK = "Hover over contribution point to view details.";

/** Contribution River **/
$LNG->STATS_GROUP_STACKEDAREA_TITLE = 'Key';
$LNG->STATS_GROUP_STACKEDAREA_HELP = 'Hover over a coloured area at a given time to display a contribution count for that item type for that date.<br /><br />';
$LNG->STATS_GROUP_STACKEDAREA_HELP .= 'Left-click a coloured area to filter diagram on that item type.<br /><br />';
$LNG->STATS_GROUP_STACKEDAREA_HELP .= 'Right-click to remove the filter (or click the button below).<br /><br />';
$LNG->STATS_GROUP_STACKEDAREA_RESTORE_BUTTON = 'Remove Filter';

/** People and Issue Ring **/
$LNG->STATS_GROUP_SUNBURST_PERSON = 'Member';
$LNG->STATS_GROUP_SUNBURST_CONNECTED_DEBATE = 'was contributed to by:';
$LNG->STATS_GROUP_SUNBURST_CONNECTED_USER = 'and is connected to:';
$LNG->STATS_GROUP_SUNBURST_WITH = 'with:';
$LNG->STATS_GROUP_SUNBURST_CREATED = 'created:';
$LNG->STATS_GROUP_SUNBURST_DETAILS = "Details Area";
$LNG->STATS_GROUP_SUNBURST_DETAILS_CLICK = "Click section to view more details";

/** Network graphs **/
$LNG->GRAPH_PRINT_HINT = "Print this network graph";
$LNG->GRAPH_ZOOM_FIT_HINT = "Scale graph down if required and move to make it all fit in the visible area";
$LNG->GRAPH_ZOOM_ONE_TO_ONE_HINT = "Zoom this network graph to 100%";
$LNG->GRAPH_ZOOM_IN_HINT = "Zoom in";
$LNG->GRAPH_ZOOM_OUT_HINT = "Zoom out";
$LNG->GRAPH_CONNECTION_COUNT_LABEL = 'Connections:';
$LNG->GRAPH_NOT_SUPPORTED = 'Your current browser does not support HTML5 Canvas.<br><br>Please upgrade to a newer version if you wish to view this visualisation: IE 9.0+; Firefox 23.0+; Chrome 29.0+; Opera 17.0+; Safari 5.1+';

$LNG->NETWORKMAPS_RESIZE_MAP_HINT = 'Resize the Map';
$LNG->NETWORKMAPS_ENLARGE_MAP_LINK = 'Enlarge Map';
$LNG->NETWORKMAPS_REDUCE_MAP_LINK = 'Reduce Map';
$LNG->NETWORKMAPS_EXPLORE_ITEM_LINK = 'Explore Selected Item';
$LNG->NETWORKMAPS_EXPLORE_ITEM_HINT = 'Open the full details page for the currently selected item';
$LNG->NETWORKMAPS_EXPLORE_AUTHOR_LINK = 'Explore Author of Selected Item';
$LNG->NETWORKMAPS_EXPLORE_AUTHOR_HINT = 'Open the Author home page for the currently selected item';
$LNG->NETWORKMAPS_SELECTED_NODEID_ERROR = 'Please make sure you have made a selection in the map.';
$LNG->NETWORKMAPS_LOADING_MESSAGE = 'Fetching data...';
$LNG->NETWORKMAPS_NO_RESULTS_MESSAGE = 'No results found.';
$LNG->NETWORKMAPS_KEY_SELECTED_ITEM = 'Selected item';
$LNG->NETWORKMAPS_KEY_FOCAL_ITEM = 'Focal item';
$LNG->NETWORKMAPS_KEY_NEIGHBOUR_ITEM = 'Neighbour item';
$LNG->NETWORKMAPS_KEY_SOCIAL_MODERATELY = 'Moderately connected';
$LNG->NETWORKMAPS_KEY_SOCIAL_HIGHLY = 'Highly connected';
$LNG->NETWORKMAPS_KEY_SOCIAL_SLIGHTLY = 'Slightly connected';
$LNG->NETWORKMAPS_KEY_SOCIAL_MOST = 'The most connected';
$LNG->NETWORKMAPS_PERCENTAGE_MESSAGE = '% of layout computed...';
$LNG->NETWORKMAPS_SCALING_MESSAGE = 'Scaling to fit page...';

$LNG->NETWORKMAPS_SOCIAL_CONNECTION_HINT = 'Show all connections for the selected link';
$LNG->NETWORKMAPS_SOCIAL_CONNECTION_LINK = 'Explore Selected Link';
$LNG->NETWORKMAPS_SOCIAL_LOADING_MESSAGE = '(Loading Social Network View. This may take a few minutes to calculate depending on the size of the Hub...)';
$LNG->NETWORKMAPS_SOCIAL_CONNECTIONS = 'Connections';
$LNG->NETWORKMAPS_SOCIAL_CONNECTION = 'Connection';
$LNG->NETWORKMAPS_SOCIAL_CONNECTION_MESSAGE = 'Click connection links below to view details';

/** INTEREST HEAT NETWORK **/
$LNG->INTEREST_NETWORK_COUNT = 'interest score';
$LNG->INTEREST_NETWORK_CONNECTIONS = 'connections';
$LNG->INTEREST_NETWORK_CALCULATION_KEY = 'Key';

/** COLLAPSIBLE TREE **/
$LNG->TREE_COLLAPSE_ALL = 'Collapse All';
$LNG->TREE_EXPAND_ALL = 'Expand All';
$LNG->TREE_HOMEPAGE_TEXT = 'Go To Homepage';
$LNG->TREE_HOMEPAGE_HINT = 'Click to go and view the homepage of this item';
$LNG->TREE_COMMENT_COUNT = $LNG->COMMENT_NAME.' Count:';
$LNG->TREE_CHILD_COUNT = 'Child Count:';

/** LOADING MESSAGES **/
$LNG->LOADING_DATA = '(Loading data...)';
$LNG->LOADING_MESSAGE = 'Loading...';

// ODD BITS
$LNG->NODE_EXPLORE_BUTTON_TEXT = 'Explore >>';
$LNG->NODE_EXPLORE_BUTTON_HINT = 'Click to see more information';
$LNG->USER_EXPLORE_BUTTON_HINT = 'Click to see more information on this person';
$LNG->NODE_TYPE_ICON_HINT = 'View original image';
$LNG->SOCIAL_MULTI_CONNECTIONS_ERROR = 'Insufficient Data supplied to get Connections';

// ALERT MESSAGES
$LNG->ALERTS_BOX_TITLE = 'Alerts';
$LNG->ALERT_SHOW_ALL = 'show all...';
$LNG->ALERT_SHOW_LESS = 'show less...';

//RETURNS POSTS / PEOPLE BASED
$LNG->ALERT_UNSEEN_BY_ME = "Unseen by me";
$LNG->ALERT_HINT_UNSEEN_BY_ME = "I have not seen this post yet.";

$LNG->ALERT_RESPONSE_TO_ME = "Reponse to my post";
$LNG->ALERT_HINT_RESPONSE_TO_ME = "This post is a response to a post I authored.";

$LNG->ALERT_UNRATED_BY_ME = "Not voted on by me";
$LNG->ALERT_HINT_UNRATED_BY_ME = "I have not yet voted on this post.";

$LNG->ALERT_INTERESTING_TO_PEOPLE_LIKE_ME = "Viewed by similar people to me";
$LNG->ALERT_HINT_INTERESTING_TO_PEOPLE_LIKE_ME = "This post was viewed by people with similar interests to me (based on SVD analysis of activity patterns).";

$LNG->ALERT_SUPPORTED_BY_PEOPLE_LIKE_ME = "Voted on by similar people to me";
$LNG->ALERT_HINT_SUPPORTED_BY_PEOPLE_LIKE_ME = "This post was voted highly by people whose opinions are similar to mine (based on SVD analysis of rating patterns).";

$LNG->ALERT_INTERESTING_TO_ME = 'Interesting to me';
$LNG->ALERT_HINT_INTERESTING_TO_ME = 'Find posts that should interest a user, given their previous interests. This alert estimates the user\'s interests in each post based on how much attention he/she gave it or it\'s nearest neighbors in the past. It then identifies the posts whose "interest" scores are in the top 50%.';

$LNG->ALERT_UNSEEN_COMPETITOR = 'Unseen competitor';
$LNG->ALERT_HINT_UNSEEN_COMPETITOR = 'Identifies ideas from someone else that competes with an idea I authored.';

$LNG->ALERT_UNSEEN_RESPONSE = 'Unseen response';
$LNG->ALERT_HINT_UNSEEN_RESPONSE = 'Identifies unseen (by me) responses authored by someone else to a post I authored.';


//RETURNS PEOPLE / PEOPLE BASED
$LNG->ALERT_PEOPLE_WITH_INTERESTS_LIKE_MINE = "People like me - by interests";
$LNG->ALERT_HINT_PEOPLE_WITH_INTERESTS_LIKE_MINE = "People who have similar interests to me, based on activity patterns.";

$LNG->ALERT_PEOPLE_WHO_AGREE_WITH_ME = "People like me - by voting";
$LNG->ALERT_HINT_PEOPLE_WHO_AGREE_WITH_ME = "People who have similar opinions to mine, based on rating patterns.";

$LNG->ALERT_LURKING_USER = 'Lurking user';
$LNG->ALERT_HINT_LURKING_USER = 'User has not edited or created any posts.';

$LNG->ALERT_INACTIVE_USER = 'Inactive user';
$LNG->ALERT_HINT_INACTIVE_USER = 'Finds users who have done nothing.';

$LNG->ALERT_USER_IGNORED_COMPETITORS = 'User ignored competitors';
$LNG->ALERT_HINT_USER_IGNORED_COMPETITORS = 'Identifies users who ignored competitors to their ideas. For each user, it lists the issues the user offered ideas for, followed by the competing ideas that the user ignored (i.e. did not view or respond to).';

$LNG->ALERT_USER_IGNORED_ARGUMENTS = 'User ignored arguments';
$LNG->ALERT_HINT_USER_IGNORED_ARGUMENTS = 'Identifies users who ignored underlying arguments when rating posts. For each user, it lists the rated posts followed by the arguments for each of those posts that the user ignored (i.e. did not view or respond to).';

$LNG->ALERT_USER_IGNORED_RESPONSES = 'User ignored responses';
$LNG->ALERT_HINT_USER_IGNORED_RESPONSES = 'Identifies users who ignored responses by other people to their posts. For each user, it lists the user-authored posts followed responses to each of those posts that the user ignored (i.e. did not view or respond to).';


//RETURNS POSTS / MAP BASED
$LNG->ALERT_HOT_POST = "Hot post";
$LNG->ALERT_HINT_HOT_POST = "This post has received a lot of interest in general.";

$LNG->ALERT_ORPHANED_IDEA = "Orphaned idea";
$LNG->ALERT_HINT_ORPHANED_IDEA = "This idea post is receiving much less attention than its siblings.";

$LNG->ALERT_EMERGING_WINNER = "Dominant idea";
$LNG->ALERT_HINT_EMERGING_WINNER = "One idea has predominance of community support (for a given issue).";

$LNG->ALERT_CONTENTIOUS_ISSUE = "Contentious issue";
$LNG->ALERT_HINT_CONTENTIOUS_ISSUE = "An issue with ideas that the community is strongly divided over: balkanization, polarization.";

$LNG->ALERT_INCONSISTENT_SUPPORT = "Inconsitently supported idea";
$LNG->ALERT_HINT_INCONSISTENT_SUPPORT = "An idea where my support for the idea and it's underlying arguments are inconsistent.";

$LNG->ALERT_MATURE_ISSUE = 'Mature issue';
$LNG->ALERT_HINT_MATURE_ISSUE = 'Issue has  >= 3 ideas with at least one argument each.';

$LNG->ALERT_IGNORED_POST = 'Ignored Post';
$LNG->ALERT_HINT_IGNORED_POST = 'Post has not been seen by anyone but original author.';

$LNG->ALERT_USER_GONE_INACTIVE = 'Users gone inactive';
$LNG->ALERT_HINT_USER_GONE_INACTIVE = 'Users who were initially active, but stopped.';

$LNG->ALERT_CONTROVERSIAL_IDEA = 'Controversial idea';
$LNG->ALERT_HINT_CONTROVERSIAL_IDEA = 'The community has widely divergent opinions (as reflected by their voting) of whether an idea is a good one or not.';

$LNG->ALERT_IMMATURE_ISSUE = "Immature issue";
$LNG->ALERT_HINT_IMMATURE_ISSUE = 'Issue has &lt; 3 ideas with no arguments.';

$LNG->ALERT_WELL_EVALUATED_IDEA = "Well evaluated idea";
$LNG->ALERT_HINT_WELL_EVALUATED_IDEA = "Idea has several pros and cons, including some rebuttals.";

$LNG->ALERT_POORLY_EVALUATED_IDEA = "Poorly evaluated idea";
$LNG->ALERT_HINT_POORLY_EVALUATED_IDEA = "Idea has few pros and cons, and no rebuttals.";

$LNG->ALERT_RATING_IGNORED_ARGUMENT = 'Rating ignored argument';
$LNG->ALERT_HINT_RATING_IGNORED_ARGUMENT = 'Identifies relevant arguments that the user did not view before rating a post.';
?>
