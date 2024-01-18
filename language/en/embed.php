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

/** EMBED INDEX PAGE **/

$LNG->EMBED_INDEX_TAB_HOME = "Home";
$LNG->EMBED_INDEX_TAB_LARGE_VIS = "Large Visualisations";
$LNG->EMBED_INDEX_TAB_MINI_VIS = "Mini Visualisations";
$LNG->EMBED_INDEX_TAB_ALERT_VIS = "Alerts";
$LNG->EMBED_INDEX_TAB_ABOUT = "About";
$LNG->EMBED_INDEX_TAB_HELP = "Help";

$LNG->EMBED_INDEX_LANGUAGE_CHOICE = 'Choose the language for the embeddable:';

$LNG->EMBED_INDEX_TAB_VIS_TREE = "Tree Structures";
$LNG->EMBED_INDEX_TAB_VIS_NETWORK = "Network Structures";
$LNG->EMBED_INDEX_TAB_VIS_STATS = "Stats and Stuff";

$LNG->EMBED_INDEX_TAB_HELP_CIF = "CIF";
$LNG->EMBED_INDEX_TAB_HELP_LANG = "Language Overriding";
$LNG->EMBED_INDEX_TAB_HELP_USER = "User data and Privacy";
$LNG->EMBED_INDEX_TAB_HELP_MOVIE = "Movies";
$LNG->EMBED_INDEX_TAB_HELP_ALERT = "Alerts";
$LNG->EMBED_INDEX_TAB_HELP_EMBED = "Large Visualisations";
$LNG->EMBED_INDEX_TAB_HELP_MINI = "Mini Visualisations";

$LNG->EMBED_INDEX_INNER_TITLE = 'Welcome to our Embeddables.';
$LNG->EMBED_INDEX_FIRST_PARA = 'The Collective Intelligence Dashboard (CIDashboard) is a place in which analytics on conversational and
								social dynamics can be made visible and fed back to the community for further awareness
								and reflection on the state and outcomes of a public debate. This site allows you to choose individual
								visualisations or compilations of visualisations as a custom dashboard that can be embedded as an iframe
								or linked to as a full page from your platform. CIDashboard uses your data passed to us
								in the <span class="active" onclick="setTabPushed($(\'tab-help-cif\'),\'help-cif\');">Catalyst Interchange Format (CIF)</span>.';

$LNG->EMBED_INDEX_SECOND_PARA = 'We currently have three types of embeddables:';

$LNG->EMBED_POWERED_BY_DELIBERATORIUM = 'powered by Deliberatorium Analytics';
$LNG->EMBED_POWERED_BY_EDGESENSE = 'powered by Edgesense';

$LNG->EMBED_INDEX_LARGE_VIS_DESC = 'This is a set of large visualisation broken down into three collections:';
$LNG->EMBED_INDEX_MINI_VIS_DESC = '';
$LNG->EMBED_INDEX_ALERTS_DESC = '';


$LNG->EMBED_INDEX_FIRST_PARA_PART2 = "More description here.....";

$LNG->EMBED_INDEX_VIS_MESSAGE = 'The above field is where you paste a url which must return jsonld
							formatted to the <span class="active" onclick="setTabPushed($(\'tab-help-cif\'),\'help-cif\');">Catalyst Interchange Format (CIF)</span>.
							The system will then use this data to draw the visualisations you select.
							Each visualisation has dependencies on the presence of certain data elements in the data you supply us.
							Please check your data matches the dependencies for the visualisation you select.
							<br>Note: We cache your data temporarily to speed up displays and we therefore request
							that you also indicate how often we should refresh our cached data from your given url in the next field.
							The default is 60 seconds.';

$LNG->EMBED_INDEX_MINI_MESSAGE = 'The above field is where you paste a url which must return jsonld
							formatted to the <span class="active" onclick="setTabPushed($(\'tab-help-cif\'),\'help-cif\');">Catalyst Interchange Format (CIF)</span>.
							The system will then use this data to draw the visualisations you select.
							Each visualisation has dependencies on the presence of certain data elements in the data you supply us.
							Please check your data matches the dependencies for the visualisation you select.
							<br>Note: We cache your data temporarily to speed up displays and we therefore request
							that you also indicate how often we should refresh our cached data from your given url in the next field.
							The default is 60 seconds.';

$LNG->EMBED_INDEX_ALERT_MESSAGE = 'The above field is where you paste a url which must return jsonld
							formatted to the <span class="active" onclick="setTabPushed($(\'tab-help-cif\'),\'help-cif\');">Catalyst Interchange Format (CIF)</span>.
							The system will then use this data to process for alerts you select.
							<br>Note: We cache your data temporarily to speed up displays and we therefore request
							that you also indicate how often we should refresh our cached data from your given url in the next field.
							The default is 60 seconds.';


$LNG->EMBED_INDEX_READ_LESS = "Read Less";
$LNG->EMBED_INDEX_KEEP_READING = "Read More";

$LNG->EMBED_INDEX_DASH_LINK = "Use in Dashboard";
$LNG->EMBED_INDEX_DASH_TITLE_PLACEHOLDER = "optional title for the dashboard";


/***************** LANGUAGE OVERRIDE *******************/
$LNG->EMBED_INDEX_LANG_URL_LABEL = 'Language override:';
$LNG->EMBED_INDEX_LANG_URL_HINT = "http:// <Optional Url to node/link names override file>";
$LNG->EMBED_INDEX_LANG_URL_HELP = 'If you wish to override the terminology used in the visualisations
										for the node and link type names to make it more specific to your platform and users,
										you can supply a url that expresses their replacement names.
										You can find specific details on the structure of this json file on the <span class="active" onclick="setTabPushed($(\'tab-help-lang\'),\'help-lang\');">Help page</span>.';

/****************************************************************************************************************/

$LNG->EMBED_MINI_VISUALISATIONS_TITLE = "Mini Visualisations";
$LNG->EMBED_MINI_DASHBOARD_TITLE = "Dashboard of Mini Visualisations";

$LNG->EMBED_INDEX_MINI_MESSAGE2 = '<br>The dimension of the embedable iframe is 300px wide x 220px heigh. The panel inside it is fixed size to match within this, so this iframe is not really resizable.';

$LNG->EMBED_MINI_DASH_MESSAGE = 'NOTE: The <span class="active" onclick="setTabPushed($(\'tab-help-cif\'),\'help-cif\');">CIF</span>
								  data you provde us in the visualisatoin data url above is used to draw all the
								  dashboard visualisations you select, therefore
								  it must contain all the dependent data required by each selected visualisation.';

$LNG->EMBED_MINI_DASH_MESSAGE2 = 'Below is an area to configure your dashboard embedable or link.
									You must choose the visualisations to include in your dashboard
									from the <b>'.$LNG->EMBED_MINI_VISUALISATIONS_TITLE.'</b> list above using the \'<b>'.$LNG->EMBED_INDEX_DASH_LINK.'</b>\'
									checkboxes. These will then appear in the panel below.';

$LNG->EMBED_MINI_TITLE_USER_CONTRIBUTIONS = 'User Contributions';
$LNG->EMBED_MINI_DESC_USER_CONTRIBUTIONS = "This mini visualisation displays a bar chart of contributins by node type and optinally votes.";
$LNG->EMBED_MINI_DEPENDENT_USER_CONTRIBUTIONS = "This requires nodes or posts with author data and optionally votes.";
$LNG->EMBED_MINI_HELP_USER_CONTRIBUTIONS = 'This mini visualisation shows user contribution statistics. There is a graph showing the number of user contributions by type and if data was available also for votes. Rollover each bar to see more detailed statistics.<br><br>Below the graph it says how many people contributed how many times and then gives a breakdown by contribution type.';

$LNG->EMBED_MINI_TITLE_USER_VIEWING = 'User Viewing Activity';
$LNG->EMBED_MINI_DESC_USER_VIEWING = "This mini visualisation displays a sparkline graph of user viewing statisitcs.";
$LNG->EMBED_MINI_DEPENDENT_USER_VIEWING = "This requires nodes or posts with author data and their viewing history.";
$LNG->EMBED_MINI_HELP_USER_VIEWING = 'This visualisation shows a sparkline graph of user viewing statisitcs by date.<br><br>Rollover the sparkline to see viewing counts per date. The red dot indicates the least views. The green dot indicates the most views. The black dot indicates the last views.';

$LNG->EMBED_MINI_TITLE_HEALTH_PARTICIPATION = 'Participation Indicator';
$LNG->EMBED_MINI_DESC_HEALTH_PARTICIPATION = "This mini visualisation displays a traffic light indicating participation health.";
$LNG->EMBED_MINI_DEPENDENT_HEALTH_PARTICIPATION = "This requires nodes or posts with author data.";
$LNG->EMBED_MINI_HELP_HEALTH_PARTICIPATION = 'If less than 3 people have participated in this '.$LNG->DEBATE_NAME.' then this will show a red traffic light.<br>If between 3 and 5 people have participated in this '.$LNG->DEBATE_NAME.' then this will show an orange traffic light.<br>If more than 5 people have participated in this '.$LNG->DEBATE_NAME.' then this will show a green traffic light.';

$LNG->EMBED_MINI_TITLE_HEALTH_VIEWING = 'Viewing Activity Indicator';
$LNG->EMBED_MINI_DESC_HEALTH_VIEWING = "This mini visualisation displays a traffic light indicating Viewing activity health.";
$LNG->EMBED_MINI_DEPENDENT_HEALTH_VIEWING = "This requires nodes or posts with author data and their viewing history.";
$LNG->EMBED_MINI_HELP_HEALTH_VIEWING = 'If no people have viewied this '.$LNG->DEBATE_NAME.' for more than 14 days, this will show a red traffic light.<br>If people have viewed this '.$LNG->DEBATE_NAME.' between 6 and 14 days ago this will show an orange traffic light.<br>If people have viewed this '.$LNG->DEBATE_NAME.' in the last 5 days this will show a green traffic light.';

$LNG->EMBED_MINI_TITLE_HEALTH_CONTRIBUTION = 'Contribution Activity Indicator';
$LNG->EMBED_MINI_DESC_HEALTH_CONTRIBUTION = "This mini visualisation displays a traffic light indicating contribution activity health.";
$LNG->EMBED_MINI_DEPENDENT_HEALTH_CONTRIBUTION = "This requires nodes or posts with author and creation date data.";
$LNG->EMBED_MINI_HELP_HEALTH_CONTRIBUTION = 'If people have not added a new entry to this '.$LNG->DEBATE_NAME.' for more than 14 days, this will show a red traffic light.<br>If people have added a new entry to this '.$LNG->DEBATE_NAME.' between 6 and 14 days ago this will show an orange traffic light.<br>If people have added a new entry to this '.$LNG->DEBATE_NAME.' in the last 5 days this will show a green traffic light.';

$LNG->EMBED_MINI_TITLE_WORD_STATS = 'Word Counts';
$LNG->EMBED_MINI_DESC_WORD_STATS = "This mini visualisation displays word count statisitcs.";
$LNG->EMBED_MINI_DEPENDENT_WORD_STATS = "This requires nodes or posts with author data";
$LNG->EMBED_MINI_HELP_WORD_STATS = 'This mini visualisation displays word count statisitcs. There is a graph showing total word counts per user. Rollover the graph to see the details.<br><br>Below the graph it shows the average word count per user and also the minimum single contribution count and the maximum single contribution count.';

/****************************************************************************************************************/

$LNG->EMBED_INDEX_VISUALISATIONS_TITLE = "Large Visualisations";
$LNG->EMBED_INDEX_DASHBOARD_TITLE = "Dashboard Builder";

$LNG->EMBED_INDEX_VIS_MESSAGE2 = '<br>The default dimension of the embedable iframe is 1000px wide x 1000px heigh, but you can edit this in the embed code.';

$LNG->EMBED_INDEX_DASH_MESSAGE2 = 'If you wish to embed a whole dashboard of visualisations rather than individual ones, you can use can organise your dashboard embeddable here.';

$LNG->EMBED_INDEX_DASH_MESSAGE3 = 'You select visualisations for your dashboard by ticking the \'<b>'.$LNG->EMBED_INDEX_DASH_LINK.'</b>\'
									checkboxes on visualisations in the <b>preceding tabs</b>.';


$LNG->EMBED_INDEX_USER_SOURCE_URL_LABEL = 'User Data:';
$LNG->EMBED_INDEX_USER_SOURCE_URL_HINT = "https:// <Optional Url to your CIF formatted User data>";
$LNG->EMBED_INDEX_USER_SOURCE_URL_HELP = 'If you wish to display user names, descriptions or homepage
										links in any of the visualisations you select that require them,
										but you do not wish that data to be cached or stored on a server,
										you can optionally supply a separate url to get that data.
										The user url is only called and displayed by the browser and
										never the server, so that user data is not stored on any server.
										The user data must be supplied in CIF format containing CIF Agent
										objects with ids that match those supplied in the visualisation data given in the url above.
										<br><br>The user url must be https and the server processing the user url must be able to pick up
										the \'callback\' parameter we add to the their user url and wrap the reply json in the callback
										function we name. Here is an example of a user url with a callback function appended:
										<pre>https://debatehubdev.kmi.open.ac.uk/api/unobfuscatedusers/?id=1722128760457755001427202440&callback=processCIFUserData</pre>
										More help can be found on the <span class="active" onclick="setTabPushed($(\'tab-help-user\'),\'help-user\');">User data and Privacy help page</span>';

$LNG->EMBED_INDEX_USER_SOURCE_URL_HELP_HINT = 'Click to show/hide additional information';



$LNG->EMBED_INDEX_DATA_SOURCE_URL_LABEL = "Visualisation Data:";
$LNG->EMBED_INDEX_DATA_SOURCE_URL_HINT = "http:// <Url to your CIF formatted data>";
$LNG->EMBED_INDEX_DATA_SOURCE_REFRESH_LABEL = "Refresh every:";
$LNG->EMBED_INDEX_DATA_SOURCE_DASHBOARD_LABEL = "Dashboard Data:";
$LNG->EMBED_INDEX_DATA_SOURCE_URL_ERROR = "You must first enter a url for the source data to be used";
$LNG->EMBED_INDEX_DATA_SOURCE_URL_VALID = "You must enter a valid url for the source data to be used";
$LNG->EMBED_INDEX_CODE_LINK = "Embed";
$LNG->EMBED_INDEX_CODE_HINT = "Get the Iframe code snippet to embed this option in your website";
$LNG->EMBED_INDEX_CODE_MESSAGE = "Below is the iframe embed code for your chosen embedable:";
$LNG->EMBED_INDEX_DEMO_LINK = "Demo";
$LNG->EMBED_INDEX_DEMO_HINT = "View an example demonstration of this";
$LNG->EMBED_INDEX_PAGE_LINK = "Page";
$LNG->EMBED_INDEX_PAGE_HINT = "Get the url to link to full page view";
$LNG->EMBED_INDEX_PAGE_MESSAGE = "Below is the url to link to your visualisation page:";
$LNG->EMBED_INDEX_DASH_HINT = "Select to add this visualisation to your embeddable dashboard.";
$LNG->EMBED_INDEX_PREVIEW_LINK = "Preview";
$LNG->EMBED_INDEX_PREVIEW_HINT = "Go to a preview of your new dashboard page.";
$LNG->EMBED_INDEX_PREVIEW_VIS_LINK = "Preview";
$LNG->EMBED_INDEX_PREVIEW_VIS_HINT = "Go to a preview of this visualisation using your data given above.";
$LNG->EMBED_INDEX_INCLUDE_POSTS_LINK = "Include Posts";
$LNG->EMBED_INDEX_INCLUDE_POSTS_HINT = "Include SPost data in this visualisation.";
$LNG->EMBED_INDEX_COMPACT_LINK = "Network Only";
$LNG->EMBED_INDEX_COMPACT_HINT = "Exclude the graphs at the bottom and just have the network.";

$LNG->EMBED_INDEX_DASH_PAGE_LINK = "Link";
$LNG->EMBED_INDEX_DASH_PAGE_MESSAGE = "Below is the url to link to your dashboard page:";

$LNG->EMBED_INDEX_DASH_MESSAGE = 'NOTE: The <span class="active" onclick="setTabPushed($(\'tab-help-cif\'),\'help-cif\');">CIF</span>
								  data you provde us in the visualisatoin data url above is used to draw all the
								  dashboard visualisations you select, therefore
								  it must contain all the dependent data required by each selected visualisation.';

$LNG->EMBED_INDEX_DASH_TITLE_LABEL = "Dashboard Title:";
$LNG->EMBED_INDEX_DASH_CHOOSER_TITLE = "Dashboard";
$LNG->EMBED_INDEX_DASH_CHOOSER_MESSAGE = "Once selected, visualisations can be rearrange in the box below by dragging and droppping them";
$LNG->EMBED_INDEX_DASH_VIS_ERROR = "You must select at least one visualisation for the dashboard";
$LNG->EMBED_VIS_DEPENDENCIES_TITLE = "Dependencies:";

$LNG->EMBED_INDEX_DASH_EXAMPLE_TITLE = "Example Dashboard";

/*****************************************************************************************************************/

$LNG->EMBED_VIS_TITLE_NETWORK = $LNG->DEBATE_NAME.' Network';
$LNG->EMBED_VIS_DESC_NETWORK = "This visualisation display a network graph of the connected posts in the ".$LNG->DEBATE_NAME;
$LNG->EMBED_VIS_DEPENDENT_NETWORK = "This requires nodes and connections or interconnected posts.";

$LNG->EMBED_VIS_TITLE_SOCIAL = 'Social Network';
$LNG->EMBED_VIS_DESC_SOCIAL = "This visualisation display a social graph based on a given network graph.";
$LNG->EMBED_VIS_DEPENDENT_SOCIAL = "This requires nodes, connections and node authors or interconnectde posts with authors.";

$LNG->EMBED_VIS_TITLE_SUNBURST = 'People & Issue Ring';
$LNG->EMBED_VIS_DESC_SUNBURST = "This visualisation show people and issues, letting you explore who added what kinds if items to which issues.";
$LNG->EMBED_VIS_DEPENDENT_SUNBURST = 'This requires <a href="http://en.wikipedia.org/wiki/Issue-Based_Information_System">IBIS</a> data; Issues, Positions, with supporting and counter Arguments which must all include node authors';

$LNG->EMBED_VIS_TITLE_STACKEDAREA = 'Contribution River';
$LNG->EMBED_VIS_DESC_STACKEDAREA = 'This visualisations shows item creation over time for the various item types.';
$LNG->EMBED_VIS_DEPENDENT_STACKEDAREA = 'This requires nodes or posts with creation dates';

$LNG->EMBED_VIS_TITLE_TOPICSPACE = 'Activity Bias';
$LNG->EMBED_VIS_DESC_TOPICSPACE = 'This visualisation clusters contributions based on similar activity patterns.';
$LNG->EMBED_VIS_DEPENDENT_TOPICSPACE = 'This requires voting data.';

$LNG->EMBED_VIS_TITLE_BIASSPACE = "Rating Bias";
$LNG->EMBED_VIS_DESC_BIASSPACE = "This visualisation clusters contributions based on similar voting patterns.";
$LNG->EMBED_VIS_DEPENDENT_BIASSPACE = "This requires history data.";

$LNG->EMBED_VIS_TITLE_CIRCLEPACKING = $LNG->DEBATE_NAME.' Nesting';
$LNG->EMBED_VIS_DESC_CIRCLEPACKING = 'This visualisation shows a '.$LNG->DEBATE_NAME.' nested inside circles. The colours denote the node types.';
$LNG->EMBED_VIS_DEPENDENT_CIRCLEPACKING = "This requires nodes and connections or interconnected posts.";

$LNG->EMBED_VIS_TITLE_ACTIVITY= 'Activity Analysis';
$LNG->EMBED_VIS_DESC_ACTIVITY= 'This visualisation shows the activity of a '.$LNG->DEBATE_NAME.' over time.';
$LNG->EMBED_VIS_DEPENDENT_ACTIVITY= 'This requires activity data.';

$LNG->EMBED_VIS_TITLE_USER_ACTIVITY = "User Activity Analysis";
$LNG->EMBED_VIS_DESC_USER_ACTIVITY = "This visualisation shows creation and voting activity by participant.";
$LNG->EMBED_VIS_DEPENDENT_USER_ACTIVITY = "This requires nodes and user data with creation and/or voting activity data.";

$LNG->EMBED_VIS_TITLE_STREAM_GRAPH= "Contribution Stream";
$LNG->EMBED_VIS_DESC_STREAM_GRAPH = 'This visualisations shows item creation over time for the various item types.';
$LNG->EMBED_VIS_DEPENDENT_STREAM_GRAPH = 'This requires nodes or posts with creation dates';

$LNG->EMBED_VIS_TITLE_OVERVIEW= "Quick Overview";
$LNG->EMBED_VIS_DESC_OVERVIEW = 'This visualisations provides an overview of important aspects of a '.$LNG->DEBATE_NAME.'.';
$LNG->EMBED_VIS_DEPENDENT_OVERVIEW = 'This requires nodes with creation dates and history data';

$LNG->EMBED_VIS_TITLE_CIRCLEPACKING_ATTENTION = "Attention Map";
$LNG->EMBED_VIS_DESC_CIRCLEPACKING_ATTENTION = 'This visualisation shows a '.$LNG->DEBATE_NAME.' nested inside circles with colors denoting attention distribution across the contributions.';
$LNG->EMBED_VIS_DEPENDENT_CIRCLEPACKING_ATTENTION = "This requires node and connection data.";

$LNG->EMBED_VIS_TITLE_EDGESENSE_HISTORY = "Edgesense Social Network";
$LNG->EMBED_VIS_DESC_EDGESENSE_HISTORY = 'This visualisation shows a social network based on the conversation data supplied.';
$LNG->EMBED_VIS_DEPENDENT_EDGESENSE_HISTORY = "This requires user, node, connection data.";

$LNG->EMBED_VIS_TITLE_INTEREST_NETWORK = "Community Interest Network";
$LNG->EMBED_VIS_DESC_INTEREST_NETWORK = "This visualisation display a network graph of the connected nodes in the ".$LNG->DEBATE_NAME." showing the community interest in that node by ball size and colour changes.";
$LNG->EMBED_VIS_DEPENDENT_INTEREST_NETWORK = "This minimally requires user, node and connection data.";

$LNG->EMBED_VIS_TITLE_COMMUNITIES_NETWORK = "Sub-Communities Network";
$LNG->EMBED_VIS_DESC_COMMUNITIES_NETWORK = "This visualisation display a network graph of the connected nodes in the ".$LNG->DEBATE_NAME.". It shows sub-community clustering within the ".$LNG->DEBATE_NAME." where the shapes representing the nodes change shape and colour depending on their sub-community.";
$LNG->EMBED_VIS_DEPENDENT_COMMUNITIES_NETWORK = "This minimally requires user, node and connection data.";

$LNG->EMBED_VIS_TITLE_SUNBURST_NETWORK = $LNG->DEBATE_NAME.' Sunburst Network by Type';
$LNG->EMBED_VIS_DESC_SUNBURST_NETWORK = "This visualisation display a network graph of the connected nodes in the ".$LNG->DEBATE_NAME." as a layered sunburst coloured by node type.";
$LNG->EMBED_VIS_DEPENDENT_SUNBURST_NETWORK = "This requires nodes and connections or interconnected posts.";

$LNG->EMBED_VIS_TITLE_SUNBURST_NETWORK_BRANCH = $LNG->DEBATE_NAME.' Sunburst Network by Branch';
$LNG->EMBED_VIS_DESC_SUNBURST_NETWORK_BRANCH = "This visualisation display a network graph of the connected nodes in the ".$LNG->DEBATE_NAME." as a layered sunburst coloured by branch of the ".$LNG->DEBATE_NAME.".";
$LNG->EMBED_VIS_DEPENDENT_SUNBURST_NETWORK_BRANCH = "This requires nodes and connections or interconnected posts.";

$LNG->EMBED_VIS_TITLE_TREEMAP = $LNG->DEBATE_NAME.' Treemap';
$LNG->EMBED_VIS_DESC_TREEMAP = "This visualisation displays a treemap of the ".$LNG->DEBATE_NAME.". The colours of the squares change to represent sibling groupings. This version of the treemap is good for shallower trees.";
$LNG->EMBED_VIS_DEPENDENT_TREEMAP = "This requires nodes and connections or interconnected posts.";

$LNG->EMBED_VIS_TITLE_TREEMAP_BY_TYPE = $LNG->DEBATE_NAME.' Treemap By Type';
$LNG->EMBED_VIS_DESC_TREEMAP_BY_TYPE = "This visualisation displays a treemap of the ".$LNG->DEBATE_NAME.". The colours of the squares change to represent node types.. This version of the treemap is good for shallower trees.";
$LNG->EMBED_VIS_DEPENDENT_TREEMAP_BY_TYPE = "This requires nodes and connections or interconnected posts.";

$LNG->EMBED_VIS_TITLE_TREEMAP_TOP_DOWN = $LNG->DEBATE_NAME.' Treemap - Top down';
$LNG->EMBED_VIS_DESC_TREEMAP_TOP_DOWN = "This visualisation displays a treemap of the ".$LNG->DEBATE_NAME.". The first two levels of the tree are exposed initially and then you drill down by clicking the labelled boxes. This version of the treemap is good for deeper trees.";
$LNG->EMBED_VIS_DEPENDENT_TREEMAP_TOP_DOWN = "This requires nodes and connections or interconnected posts.";

$LNG->EMBED_VIS_TITLE_TREEMAP_TOP_DOWN_BY_TYPE = $LNG->DEBATE_NAME.' Treemap - Top down By Type';
$LNG->EMBED_VIS_DESC_TREEMAP_TOP_DOWN_BY_TYPE = "This visualisation displays a treemap of the ".$LNG->DEBATE_NAME.". The first two levels of the tree are exposed initially and then you drill down by clicking the labelled boxes. The box colour indicate the node type. This version of the treemap is good for deeper trees.";
$LNG->EMBED_VIS_DEPENDENT_TREEMAP_TOP_DOWN_BY_TYPE = "This requires nodes and connections or interconnected posts.";

$LNG->EMBED_VIS_TITLE_TREE = "Collapsible Tree";
$LNG->EMBED_VIS_DESC_TREE = "This visualisation displays a tree of the ".$LNG->DEBATE_NAME.".  The node circle and link sizes are determined by the number of children below a given node.";
$LNG->EMBED_VIS_DEPENDENT_TREE = "This requires nodes and connections or interconnected posts.";

$LNG->EMBED_VIS_TITLE_TREE_BY_POSTS = "Collapsible Tree by Posts";
$LNG->EMBED_VIS_DESC_TREE_BY_POSTS = "This visualisation displays a tree of the ".$LNG->DEBATE_NAME.". The node and link sizes are determined by the number of posts below a given node.";
$LNG->EMBED_VIS_DEPENDENT_TREE_BY_POSTS = "This requires nodes and connections and posts associated with nodes.";


/****************************************************************************************************************/

// ALERTS
$LNG->EMBED_MINI_TITLE_ALERTS = 'Alerts';
$LNG->EMBED_MINI_DESC_ALERTS = "This embeddable displays alerts. Please select which alert types you would like messages shown for in this alert box from the list on the right.<br>Below you can also specify a list of user ids to get alerts for. If no user ids are given the alerts are for all users in the visualisation data supplied.";
$LNG->EMBED_MINI_DEPENDENT_ALERTS = "These require minimally nodes or posts with author data. But ideally also connections, votes and views data.";

$LNG->EMBED_MINI_TITLE_ALERTS_NETWORK = 'Alerts with Conversation Network';
$LNG->EMBED_MINI_DESC_ALERTS_NETWORK = "This embeddable displays a ".$LNG->EMBED_VIS_TITLE_NETWORK." with an alerts sidebar. clicking items in the sidebar highlights them in the network. Please select which alert types you would like shown in the alert sidebar from the list on the right.<br>Note: unconnected nodes will not be shown but may be listed in the alerts";
$LNG->EMBED_MINI_DEPENDENT_ALERTS_NETWORK = "This requires connections and nodes or posts with author data and votes.";

$LNG->EMBED_ALERT_VISUALISATIONS_TITLE = "Alerts";
$LNG->EMBED_INDEX_ALERT_MESSAGE2 = '<br>The default dimension of the embedable iframe is 500px wide x 300px heigh, but you can edit this in the embed code.';

$LNG->EMBED_ALERT_USERS_LABEL = 'Users';
$LNG->EMBED_ALERT_USERS_PLACEHOLDER = 'optional comma separated list of user ids';
$LNG->EMBED_ALERT_USERS_HELP = '(User ids given must exist in the visulisation data supplied)';

//RETURNS POSTS / PEOPLE BASED
$LNG->ALERT_TITLE_UNSEEN_BY_ME = "Unseen by me";
$LNG->ALERT_DESC_UNSEEN_BY_ME = "I have not seen this post yet.";
$LNG->ALERT_DEPENDENT_UNSEEN_BY_ME = "This alert requires nodes, users and view events";

$LNG->ALERT_TITLE_RESPONSE_TO_ME = "Reponse to my post";
$LNG->ALERT_DESC_RESPONSE_TO_ME = "This post is a response to a post I authored.";
$LNG->ALERT_DEPENDENT_RESPONSE_TO_ME  = "This alert requires nodes, connections and users";

$LNG->ALERT_TITLE_UNRATED_BY_ME = "Not voted on by me";
$LNG->ALERT_DESC_UNRATED_BY_ME = "I have not yet voted on this post.";
$LNG->ALERT_DEPENDENT_UNRATED_BY_ME  = "This alert requires nodes, users and votes";

$LNG->ALERT_TITLE_INTERESTING_TO_PEOPLE_LIKE_ME = "Viewed by similar people to me";
$LNG->ALERT_DESC_INTERESTING_TO_PEOPLE_LIKE_ME = "This post was viewed by people with similar interests to me (based on SVD analysis of activity patterns).";
$LNG->ALERT_DEPENDENT_INTERESTING_TO_PEOPLE_LIKE_ME  = "This alert requires nodes, users and view events";

$LNG->ALERT_TITLE_SUPPORTED_BY_PEOPLE_LIKE_ME = "Voted on by similar people to me";
$LNG->ALERT_DESC_SUPPORTED_BY_PEOPLE_LIKE_ME = "This post was voted highly by people whose opinions are similar to mine (based on SVD analysis of rating patterns).";
$LNG->ALERT_DEPENDENT_SUPPORTED_BY_PEOPLE_LIKE_ME  = "This alert requires nodes, users and votes";

$LNG->ALERT_INTERESTING_TO_ME = 'Interesting to me';
$LNG->ALERT_DESC_INTERESTING_TO_ME = 'Find posts that should interest a user, given their previous interests. This alert estimates the user\'s interests in each post based on how much attention he/she gave it or it\'s nearest neighbors in the past. It then identifies the posts whose "interest" scores are in the top 50%.';
$LNG->ALERT_DEPENDENT_INTERESTING_TO_ME  = "This alert requires users and their activity history";


//RETURNS PEOPLE / PEOPLE BASED
$LNG->ALERT_TITLE_PEOPLE_WITH_INTERESTS_LIKE_MINE = "People like me - by interests";
$LNG->ALERT_DESC_PEOPLE_WITH_INTERESTS_LIKE_MINE = "People who have similar interests to me, based on activity patterns.";
$LNG->ALERT_DEPENDENT_PEOPLE_WITH_INTERESTS_LIKE_MINE  = "This alert requires users and their activity history";

$LNG->ALERT_TITLE_PEOPLE_WHO_AGREE_WITH_ME = "People like me - by voting";
$LNG->ALERT_DESC_PEOPLE_WHO_AGREE_WITH_ME = "People who have similar opinions to mine, based on rating patterns.";
$LNG->ALERT_DEPENDENT_PEOPLE_WHO_AGREE_WITH_ME  = "This alert requires users and votes";

$LNG->ALERT_TITLE_LURKING_USER = 'Lurking user';
$LNG->ALERT_DESC_LURKING_USER = 'User has not edited or created any posts';
$LNG->ALERT_DEPENDENT_LURKING_USER  = "This alert requires users and create and edit events";

$LNG->ALERT_TITLE_INACTIVE_USER = 'Inactive user';
$LNG->ALERT_DESC_INACTIVE_USER = 'Finds users who have done zilch';
$LNG->ALERT_DEPENDENT_INACTIVE_USER  = "This alert requires users and their activity history";


//RETURNS POSTS / MAP BASED
$LNG->ALERT_TITLE_HOT_POST = "Hot post";
$LNG->ALERT_DESC_HOT_POST = "This post has received a lot of interest in general.";
$LNG->ALERT_DEPENDENT_HOT_POST  = "This alert requires users and their activity history";

$LNG->ALERT_TITLE_ORPHANED_IDEA = "Orphaned idea";
$LNG->ALERT_DESC_ORPHANED_IDEA = "This idea post is receiving much less attention than its siblings.";
$LNG->ALERT_DEPENDENT_ORPHANED_IDEA  = "This alert requires nodes, connections, users and their activity";

$LNG->ALERT_TITLE_EMERGING_WINNER = "Dominant idea";
$LNG->ALERT_DESC_EMERGING_WINNER = "One idea has predominance of community support (for a given issue).";
$LNG->ALERT_DEPENDENT_EMERGING_WINNER  = "This alert requires nodes, connections, users and votes";

$LNG->ALERT_TITLE_CONTENTIOUS_ISSUE = "Contentious issue";
$LNG->ALERT_DESC_CONTENTIOUS_ISSUE = "An issue with ideas that the community is strongly divided over: balkanization, polarization.";
$LNG->ALERT_DEPENDENT_CONTENTIOUS_ISSUE  = "This alert requires nodes, connections, users and votes";

$LNG->ALERT_TITLE_INCONSISTENT_SUPPORT = "Inconsitently supported idea";
$LNG->ALERT_DESC_INCONSISTENT_SUPPORT = "An idea where my support for the idea and it's underlying arguments are inconsistent.";
$LNG->ALERT_DEPENDENT_INCONSISTENT_SUPPORT  = "This alert requires nodes, connections, users and votes";

$LNG->ALERT_TITLE_MATURE_ISSUE = 'Mature issue';
$LNG->ALERT_DESC_MATURE_ISSUE = 'Issue has  >= 3 ideas with at least one argument each';
$LNG->ALERT_DEPENDENT_MATURE_ISSUE  = "This alert requires nodes, connections";

$LNG->ALERT_TITLE_IMMATURE_ISSUE = "Immature issue";
$LNG->ALERT_DESC_IMMATURE_ISSUE = 'Issue has &lt; 3 ideas with no arguments';
$LNG->ALERT_DEPENDENT_IMMATURE_ISSUE  = "This alert requires nodes, connections";

$LNG->ALERT_TITLE_WELL_EVALUATED_IDEA = "Well evaluated idea";
$LNG->ALERT_DESC_WELL_EVALUATED_IDEA = "Idea has several pros and cons, including some rebuttals";
$LNG->ALERT_DEPENDENT_WELL_EVALUATED_IDEA = "This alert requires nodes, connections";

$LNG->ALERT_TITLE_POORLY_EVALUATED_IDEA = "Poorly evaluated idea";
$LNG->ALERT_DESC_POORLY_EVALUATED_IDEA = "Idea has few pros and cons, and no rebuttals";
$LNG->ALERT_DEPENDENT_POORLY_EVALUATED_IDEA = "This alert requires nodes, connections";

$LNG->ALERT_TITLE_IGNORED_POST = 'Ignored Post';
$LNG->ALERT_DESC_IGNORED_POST = 'Post has not been seen by anyone but original author';
$LNG->ALERT_DEPENDENT_IGNORED_POST = "This alert requires nodes, their authors and view events";

$LNG->ALERT_TITLE_USER_GONE_INACTIVE = 'Users gone inactive';
$LNG->ALERT_DESC_USER_GONE_INACTIVE = 'Users who were initially active, but stopped';
$LNG->ALERT_DEPENDENT_USER_GONE_INACTIVE = "This alert requires users, their activity history";

$LNG->ALERT_TITLE_CONTROVERSIAL_IDEA = 'Controversial idea';
$LNG->ALERT_DESC_CONTROVERSIAL_IDEA = 'The community has widely divergent opinions (as reflected by their voting) of whether an idea is a good one or not.';
$LNG->ALERT_DEPENDENT_CONTROVERSIAL_IDEA = "This alert requires nodes, connections and votes";

$LNG->ALERT_TITLE_RATING_IGNORED_ARGUMENT = 'Rating ignored argument';
$LNG->ALERT_DESC_RATING_IGNORED_ARGUMENT = 'Identifies relevant arguments that the user did not view before rating a post';
$LNG->ALERT_DEPENDENT_RATING_IGNORED_ARGUMENT = "This alert requires nodes, connections, votes and view events";

$LNG->ALERT_TITLE_UNSEEN_RESPONSE = 'Unseen response';
$LNG->ALERT_DESC_UNSEEN_RESPONSE = 'Identifies unseen (by me) responses authored by someone else to a post I authored';
$LNG->ALERT_DEPENDENT_UNSEEN_RESPONSE = "This alert requires nodes, connections, create and view events";

$LNG->ALERT_TITLE_UNSEEN_COMPETITOR = 'Unseen competitor';
$LNG->ALERT_DESC_UNSEEN_COMPETITOR = 'Identifies ideas from someone else that competes with an idea I authored';
$LNG->ALERT_DEPENDENT_UNSEEN_COMPETITOR  = "This alert requires nodes, connections, create and view events";

$LNG->ALERT_TITLE_USER_IGNORED_COMPETITORS = 'User ignored competitors';
$LNG->ALERT_DESC_USER_IGNORED_COMPETITORS = 'Identifies users who ignored competitors to their ideas. For each user, it lists the issues the user offered ideas for, followed by the competing ideas that the user ignored (i.e. did not view or respond to).';
$LNG->ALERT_DEPENDENT_USER_IGNORED_COMPETITORS  = "This alert requires nodes, connections, create and view events";

$LNG->ALERT_TITLE_USER_IGNORED_ARGUMENTS = 'User ignored arguments';
$LNG->ALERT_DESC_USER_IGNORED_ARGUMENTS = 'Identifies users who ignored underlying arguments when rating posts. For each user, it lists the rated posts followed by the arguments for each of those posts that the user ignored (i.e. did not view or respond to).';
$LNG->ALERT_DEPENDENT_USER_IGNORED_ARGUMENTS  = "This alert requires nodes, connections, votes, create and view events";

$LNG->ALERT_TITLE_USER_IGNORED_RESPONSES = 'User ignored responses';
$LNG->ALERT_DESC_USER_IGNORED_RESPONSES = 'Identifies users who ignored responses by other people to their posts. For each user, it lists the user-authored posts followed responses to each of those posts that the user ignored (i.e. did not view or respond to).';
$LNG->ALERT_DEPENDENT_USER_IGNORED_RESPONSES  = "This alert requires nodes, connections, create and view events";
?>
