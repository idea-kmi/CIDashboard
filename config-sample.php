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
/**
 * config.php
 *
 * This is the master config file, that will establish the domain
 * and redirect to the required main site specific config file.
 */

unset($CFG);

$CFG = new stdClass();


/** EDIT THESE NEXT CONFIGURATION SETTINGS TO SETUP YOUR CIDASHBOARD INSTANCE **/

/**
 * Put your site title here.
 * This is used in the header title as well as being displayed to the user in various places.
 */
$CFG->SITE_TITLE = "";

/**
 * The domain for your instance of CIDashboard
 * E.g.  cidashboardtesting.kmi.open.ac.uk
 */
$CFG->basedomain = "";

/**
 * The file path on the server to get to the top level code folder
 * Must end in a '/'
 */
$CFG->dirAddress = "";

/**
 * The url for your version of CIDashboard
 * E.g. http://cidashboardtesting.kmi.open.ac.uk/
 */
$CFG->homeAddress = "";

// The url of the analytics service being used - including trailing slash
// Sepcifically this is the one developed by Mark Klein on the Catalyst FP7 project (http://catalyst-fp7.eu/)
// https://papers.ssrn.com/sol3/papers.cfm?abstract_id=2962524
$CFG->analyticsServiceUrl = "";

// The url where you are getting an edgesense service - including trailing slash
// The serice is expected to deliver the services as per code base: https://github.com/Wikitalia/edgesense
$CFG->edgesenseServiceUrl = "";

/**
 * If you want to use MemcacheManager to cache files and speed stuff up, set this to true
 */
$CFG->hasMemcacheManager = false;

/**
 * The email address to use to contact the people running this site.
 * Used in the Contacts link and privacy and conditions of use pages.
 */
$CFG->EMAIL_REPLY_TO = "";


/** OPTINALLY EDIT THESE NEXT SETTINGS **/

/** GOOGLE **/
// Do you want to use Google analytics. ('true' or 'false')
// If this is set to 'true' you must also complete the GOOGLE_ANALYTICS_KEY below.
$CFG->GOOGLE_ANALYTICS_ON = false;

// Google analytics key.
// You must get this from the Google Analytics website.
// If you set the GOOGLE_ANALYTICS_ON to 'true' you must add a key for it to work.
$CFG->GOOGLE_ANALYTICS_KEY = "";
$CFG->GOOGLE_ANALYTICS_DOMAIN = "";

/** LANGUAGE **/
// This string indicates what language the interface text should use.
// The name must correspnd to a folder in the 'language' folder where the translated texts should exist.
$CFG->language = 'en';

/** INTERFACE THEME **/
// This string indicates what theme the interface should use.
// The name must correspond to a folder in the 'theme' folder where the theme specific style sheets, images and pages should exist.
// The default theme is 'default'. Make sure this is never deleted as it is the fall back position.
$CFG->uitheme = 'default';

/**
 * These are the background colours used in the Network Applet
 * They have the same names as styles in the styles.css file,
 * but we found we needed slightly darker shades than their stylesheet equivalents.
 */
$CFG->challengebackpale = '#6FCBF5';
$CFG->issuebackpale = '#DFC7EB';
$CFG->solutionbackpale = '#B9C1DD';
$CFG->probackpale ='#C3D6BC';
$CFG->conbackpale ='#DE9898';
$CFG->peoplebackpale = '#C6ECFE';
$CFG->resourcebackpale = '#E1F1C9';
$CFG->plainbackpale = '#D0D0D0';
$CFG->groupbackpale = '#F4F5F7';
$CFG->argumentbackpale = '#F0F1AD';
$CFG->votebackpale = '#F9B257';
$CFG->commentbackpale = '#FAB8DA';
$CFG->ideabackpale = '#D0D0D0';
$CFG->mapbackpale = '#F9B257';

/**
 * These are the background colours used in Analytics graphs
 * They need to be darker versions of the above colours, as the pale versions are too pale on a graph.
 */
$CFG->challengeback = '#067EB0';
$CFG->issueback = '#DFC7EB';
$CFG->solutionback = '#A4AED4';
$CFG->proback ='#A9C89E';
$CFG->conback ='#D46A6A';
$CFG->peopleback = '#0000C0';
$CFG->resourceback = '#BCE482';
$CFG->plainback = '#D0D0D0';
$CFG->groupback = '#F4F5F7';
$CFG->argumentback = '#E1E353';
$CFG->voteback = '#F9B257';
$CFG->commentback = '#F777B9';
$CFG->ideaback = '#D0D0D0';
$CFG->mapback = '#F9B257';

$CFG->unknowntypeback = '#000000';


/** LEAVE ALL THE REMAINING SETTINGS ALONE **/

/** LINK TYPES **/
$CFG->LINK_ISSUE_CHALLENGE = 'is related to';
$CFG->LINK_SOLUTION_ISSUE = 'responds to';
$CFG->LINK_ISSUE_SOLUTION = 'responds to';
$CFG->LINK_PRO_SOLUTION = 'supports';
$CFG->LINK_CON_SOLUTION = 'challenges';
$CFG->LINK_RESOURCE_NODE = 'is related to';
$CFG->LINK_COMMENT_NODE = 'is related to';
$CFG->LINK_COMMENT_COMMENT = 'responds to';
$CFG->LINK_IDEA_NODE = 'responds to';
$CFG->LINK_DECISION_ISSUE = 'responds to';

/**
 * The file paths for the node type icons size 32 used.
 */
$CFG->challengeicon = $CFG->homeAddress."images/nodetypes/Default/challenge.png";
$CFG->issueicon = $CFG->homeAddress."images/nodetypes/Default/issue.png";
$CFG->solutionicon = $CFG->homeAddress."images/nodetypes/Default/solution.png";
$CFG->argumenticon = $CFG->homeAddress."images/nodetypes/Default/argument.png";
$CFG->proicon = $CFG->homeAddress."images/nodetypes/Default/plus.png";
$CFG->conicon = $CFG->homeAddress."images/nodetypes/Default/minus.png";
$CFG->resourceicon = $CFG->homeAddress."images/nodetypes/Default/reference.png";
$CFG->commenticon = $CFG->homeAddress."images/nodetypes/Default/comment.png";
$CFG->ideaicon = $CFG->homeAddress."images/nodetypes/Default/idea.png";
$CFG->decisionicon = $CFG->homeAddress."images/nodetypes/Default/decision.png";
$CFG->mapicon = $CFG->homeAddress."images/nodetypes/Default/map.png";

/**
 * The file paths for the node type icons size 64 used.
 */
$CFG->challengeiconbig = $CFG->homeAddress."images/nodetypes/Default/challenge64.png";
$CFG->issueiconbig = $CFG->homeAddress."images/nodetypes/Default/issue64.png";
$CFG->solutioniconbig = $CFG->homeAddress."images/nodetypes/Default/solution64.png";
$CFG->argumenticonbig = $CFG->homeAddress."images/nodetypes/Default/argument64.png";
$CFG->proiconbig = $CFG->homeAddress."images/nodetypes/Default/plus64.png";
$CFG->coniconbig = $CFG->homeAddress."images/nodetypes/Default/minus64.png";
$CFG->resourceiconbig = $CFG->homeAddress."images/nodetypes/Default/reference64.png";
$CFG->commenticonbig = $CFG->homeAddress."images/nodetypes/Default/comment64.png";
$CFG->ideaiconbig = $CFG->homeAddress."images/nodetypes/Default/idea64.png";
$CFG->decisioniconbig = $CFG->homeAddress."images/nodetypes/Default/decision64.png";
$CFG->mapiconbig = $CFG->homeAddress."images/nodetypes/Default/map64.png";

$CFG->DEFAULT_NODE_TYPE = "Idea";
$CFG->DEFAULT_USER_PHOTO= 'profile.png';
$CFG->IMAGE_THUMB_WIDTH= '32';

/** VIS PAGE UNIQUE NAMES **/
// Please do not change these
$CFG->VIS_PAGE_NETWORK = 'network';
$CFG->VIS_PAGE_SOCIAL = 'social';
$CFG->VIS_PAGE_SUNBURST = 'sunburst';
$CFG->VIS_PAGE_STACKEDAREA = 'stackedarea';
$CFG->VIS_PAGE_TOPICSPACE = 'topicspace';
$CFG->VIS_PAGE_BIASSPACE = 'biasspace';
$CFG->VIS_PAGE_CIRCLEPACKING = 'circlepacking';
$CFG->VIS_PAGE_ACTIVITY = 'activityanalysis';
$CFG->VIS_PAGE_USER_ACTIVITY = 'useractivityanalysis';
$CFG->VIS_PAGE_STREAM_GRAPH = 'streamgraph';
$CFG->VIS_PAGE_USER_OVERVIEW = 'overview';
$CFG->VIS_PAGE_CIRCLEPACKING_ATTENTION = 'attention';
$CFG->VIS_PAGE_EDGESENSE_HISTORY = 'edgesensehistory';
$CFG->VIS_PAGE_INTEREST_NETWORK = 'interestnetwork';
$CFG->VIS_PAGE_COMMUNITIES_NETWORK = 'communitiesnetwork';
$CFG->VIS_PAGE_SUNBURST_NETWORK = 'sunburstnetwork';
$CFG->VIS_PAGE_SUNBURST_NETWORK_BRANCH = 'sunburstnetworkbranch';
$CFG->VIS_PAGE_TREEMAP = 'treemap';
$CFG->VIS_PAGE_TREEMAP_BY_TYPE = 'treemapbytype';
$CFG->VIS_PAGE_TREEMAP_TOP_DOWN = 'treemaptopdown';
$CFG->VIS_PAGE_TREEMAP_TOP_DOWN_BY_TYPE = 'treemaptopdowntype';
$CFG->VIS_PAGE_TREE = 'tree';
$CFG->VIS_PAGE_TREE_BY_POSTS = 'treebyposts';

// Please do not change these
$CFG->MINI_PAGE_USER_CONTRIBUTIONS = 'usercontributions';
$CFG->MINI_PAGE_USER_VIEWING = 'userviewing';
$CFG->MINI_PAGE_HEALTH_PARTICIPATION = 'minihealthparticipation';
$CFG->MINI_PAGE_HEALTH_VIEWING = 'minihealthviewing';
$CFG->MINI_PAGE_HEALTH_CONTRIBUTION = 'minihealthcontribution';
$CFG->MINI_PAGE_WORD_STATS = 'miniwordstats';
$CFG->MINI_PAGE_ALERTS = 'minialerts';

// Please do not change these or Alerts will not work
$CFG->ALERT_UNSEEN_BY_ME = "unseen_by_me";
$CFG->ALERT_RESPONSE_TO_ME = "response_to_me";
$CFG->ALERT_UNRATED_BY_ME = "unrated_by_me";
$CFG->ALERT_LURKING_USER = 'lurking_user';
$CFG->ALERT_IGNORED_POST = 'ignored_post';
$CFG->ALERT_MATURE_ISSUE = 'mature_issue';
$CFG->ALERT_INACTIVE_USER = 'inactive_user';
$CFG->ALERT_INTERESTING_TO_ME = "interesting_to_me";
$CFG->ALERT_INTERESTING_TO_PEOPLE_LIKE_ME = "interesting_to_people_like_me";
$CFG->ALERT_SUPPORTED_BY_PEOPLE_LIKE_ME = "supported_by_people_like_me";
$CFG->ALERT_HOT_POST = "hot_post";
$CFG->ALERT_ORPHANED_IDEA = "orphaned_idea";
$CFG->ALERT_EMERGING_WINNER = "winning_idea";
$CFG->ALERT_CONTENTIOUS_ISSUE = "contentious_issue";
$CFG->ALERT_CONTROVERSIAL_IDEA = "controversial_idea";
$CFG->ALERT_INCONSISTENT_SUPPORT = "inconsistent_support";
$CFG->ALERT_PEOPLE_WITH_INTERESTS_LIKE_MINE = "person_with_interests_like_mine";
$CFG->ALERT_PEOPLE_WHO_AGREE_WITH_ME = "person_who_agree_with_me";
$CFG->ALERT_USER_GONE_INACTIVE = "user_gone_inactive";
$CFG->ALERT_IMMATURE_ISSUE = "immature_issue";
$CFG->ALERT_WELL_EVALUATED_IDEA = "well_evaluated_idea";
$CFG->ALERT_POORLY_EVALUATED_IDEA = "poorly_evaluated_idea";
$CFG->ALERT_RATING_IGNORED_ARGUMENT = "rating_ignored_argument";
$CFG->ALERT_UNSEEN_RESPONSE = "unseen_response";
$CFG->ALERT_UNSEEN_COMPETITOR = "unseen_competitor";
$CFG->ALERT_USER_IGNORED_COMPETITORS = "user_ignored_competitors";
$CFG->ALERT_USER_IGNORED_ARGUMENTS = "user_ignored_arguments";
$CFG->ALERT_USER_IGNORED_RESPONSES = "user_ignored_responses";

// setup the hub
require_once("setup.php");
?>
