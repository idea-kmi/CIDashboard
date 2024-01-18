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

$vissequence = array(7,9,8,11,3,1,2,10,13,12,14,15,5,6,16,17,18,19,20,21,4,22,23);

$visnetwork = array(1,2,14,15,13);
$visstats = array(9,8,11,3,10,4,5,6);
$vistree = array(7,12,16,17,18,19,22,23,20,21);

$visdata = array();

$next = array();
$next[0] = $LNG->EMBED_VIS_TITLE_NETWORK;
$next[1] = 1;
$next[2] = $LNG->EMBED_VIS_DESC_NETWORK;
$next[3] = $CFG->homeAddress."images/visualisations/network-sm.png";
$next[4] = $CFG->homeAddress."ui/visualisations/fdgraph.php?";
$next[5] = $LNG->EMBED_VIS_DEPENDENT_NETWORK;
$next[6] = $CFG->VIS_PAGE_NETWORK;
$next[7] = 170;
$next[8] = true;
$next[9] = false;
array_push($visdata, $next);

$next = array();
$next[0] = $LNG->EMBED_VIS_TITLE_SOCIAL;
$next[1] = 2;
$next[2] = $LNG->EMBED_VIS_DESC_SOCIAL;
$next[3] = $CFG->homeAddress."images/visualisations/socialnetwork-sm.png";
$next[4] = $CFG->homeAddress."ui/visualisations/socialgraph.php?";
$next[5] = $LNG->EMBED_VIS_DEPENDENT_SOCIAL;
$next[6] = $CFG->VIS_PAGE_SOCIAL;
$next[7] = 170;
$next[8] = true;
$next[9] = false;
array_push($visdata, $next);

$next = array();
$next[0] = $LNG->EMBED_VIS_TITLE_SUNBURST;
$next[1] = 3;
$next[2] = $LNG->EMBED_VIS_DESC_SUNBURST;
$next[3] = $CFG->homeAddress."images/visualisations/sunburst-sm.png";
$next[4] = $CFG->homeAddress."ui/visualisations/sunburst.php?";
$next[5] = $LNG->EMBED_VIS_DEPENDENT_SUNBURST;
$next[6] = $CFG->VIS_PAGE_SUNBURST;
$next[7] = 150;
$next[8] = false;
$next[9] = false;
array_push($visdata, $next);

$next = array();
$next[0] = $LNG->EMBED_VIS_TITLE_STACKEDAREA;
$next[1] = 4;
$next[2] = $LNG->EMBED_VIS_DESC_STACKEDAREA;
$next[3] = $CFG->homeAddress."images/visualisations/stackedarea-sm.png";
$next[4] = $CFG->homeAddress."ui/visualisations/stackedarea.php?";
$next[5] = $LNG->EMBED_VIS_DEPENDENT_STACKEDAREA;
$next[6] = $CFG->VIS_PAGE_STACKEDAREA;
$next[7] = 170;
$next[8] = true;
$next[9] = false;
array_push($visdata, $next);

$next = array();
$next[0] = $LNG->EMBED_VIS_TITLE_TOPICSPACE;
$next[1] = 5;
$next[2] = $LNG->EMBED_VIS_DESC_TOPICSPACE;
$next[3] = $CFG->homeAddress."images/visualisations/topicspace-sm.png";
$next[4] = $CFG->homeAddress."ui/visualisations/topicspace.php?";
$next[5] = $LNG->EMBED_VIS_DEPENDENT_TOPICSPACE;
$next[6] = $CFG->VIS_PAGE_TOPICSPACE;
$next[7] = 170;
$next[8] = false;
$next[9] = true;
array_push($visdata, $next);

$next = array();
$next[0] = $LNG->EMBED_VIS_TITLE_BIASSPACE;
$next[1] = 6;
$next[2] = $LNG->EMBED_VIS_DESC_BIASSPACE;
$next[3] = $CFG->homeAddress."images/visualisations/biasspace-sm.png";
$next[4] = $CFG->homeAddress."ui/visualisations/biasspace.php?";
$next[5] = $LNG->EMBED_VIS_DEPENDENT_BIASSPACE;
$next[6] = $CFG->VIS_PAGE_BIASSPACE;
$next[7] = 170;
$next[8] = false;
$next[9] = true;
array_push($visdata, $next);

$next = array();
$next[0] = $LNG->EMBED_VIS_TITLE_CIRCLEPACKING;
$next[1] = 7;
$next[2] = $LNG->EMBED_VIS_DESC_CIRCLEPACKING;
$next[3] = $CFG->homeAddress."images/visualisations/circlepacking-sm.png";
$next[4] = $CFG->homeAddress."ui/visualisations/circlepacking.php?";
$next[5] = $LNG->EMBED_VIS_DEPENDENT_CIRCLEPACKING;
$next[6] = $CFG->VIS_PAGE_CIRCLEPACKING;
$next[7] = 140;
$next[8] = true;
$next[9] = false;
array_push($visdata, $next);

$next = array();
$next[0] = $LNG->EMBED_VIS_TITLE_ACTIVITY;
$next[1] = 8;
$next[2] = $LNG->EMBED_VIS_DESC_ACTIVITY;
$next[3] = $CFG->homeAddress."images/visualisations/activityanalysis-sm.png";
$next[4] = $CFG->homeAddress."ui/visualisations/activityanalysis.php?";
$next[5] = $LNG->EMBED_VIS_DEPENDENT_ACTIVITY;
$next[6] = $CFG->VIS_PAGE_ACTIVITY;
$next[7] = 170;
$next[8] = true;
$next[9] = false;
array_push($visdata, $next);

$next = array();
$next[0] = $LNG->EMBED_VIS_TITLE_USER_ACTIVITY;
$next[1] = 9;
$next[2] = $LNG->EMBED_VIS_DESC_USER_ACTIVITY;
$next[3] = $CFG->homeAddress."images/visualisations/useractivityanalysis-sm.png";
$next[4] = $CFG->homeAddress."ui/visualisations/useractivityanalysis.php?";
$next[5] = $LNG->EMBED_VIS_DEPENDENT_USER_ACTIVITY;
$next[6] = $CFG->VIS_PAGE_USER_ACTIVITY;
$next[7] = 170;
$next[8] = true;
$next[9] = false;
array_push($visdata, $next);

$next = array();
$next[0] = $LNG->EMBED_VIS_TITLE_STREAM_GRAPH;
$next[1] = 10;
$next[2] = $LNG->EMBED_VIS_DESC_STREAM_GRAPH;
$next[3] = $CFG->homeAddress."images/visualisations/streamgraph-sm.png";
$next[4] = $CFG->homeAddress."ui/visualisations/streamgraph.php?";
$next[5] = $LNG->EMBED_VIS_DEPENDENT_STREAM_GRAPH;
$next[6] = $CFG->VIS_PAGE_STREAM_GRAPH;
$next[7] = 170;
$next[8] = true;
$next[9] = false;
array_push($visdata, $next);

$next = array();
$next[0] = $LNG->EMBED_VIS_TITLE_OVERVIEW;
$next[1] = 11;
$next[2] = $LNG->EMBED_VIS_DESC_OVERVIEW;
$next[3] = $CFG->homeAddress."images/visualisations/overview-sm.png";
$next[4] = $CFG->homeAddress."ui/visualisations/overview.php?";
$next[5] = $LNG->EMBED_VIS_DEPENDENT_OVERVIEW;
$next[6] = $CFG->VIS_PAGE_USER_OVERVIEW;
$next[7] = 170;
$next[8] = false;
$next[9] = false;
array_push($visdata, $next);

$next = array();
$next[0] = $LNG->EMBED_VIS_TITLE_CIRCLEPACKING_ATTENTION;
$next[1] = 12;
$next[2] = $LNG->EMBED_VIS_DESC_CIRCLEPACKING_ATTENTION;
$next[3] = $CFG->homeAddress."images/visualisations/circlepackingattention-sm.png";
$next[4] = $CFG->homeAddress."ui/visualisations/circlepackingattention.php?";
$next[5] = $LNG->EMBED_VIS_DEPENDENT_CIRCLEPACKING_ATTENTION;
$next[6] = $CFG->VIS_PAGE_CIRCLEPACKING_ATTENTION;
$next[7] = 170;
$next[8] = false;
$next[9] = true;
array_push($visdata, $next);

$next = array();
$next[0] = $LNG->EMBED_VIS_TITLE_EDGESENSE_HISTORY;
$next[1] = 13;
$next[2] = $LNG->EMBED_VIS_DESC_EDGESENSE_HISTORY;
$next[3] = $CFG->homeAddress."images/visualisations/edgesensehistory-sm.png";
$next[4] = $CFG->homeAddress."ui/visualisations/edgesensehistory.php?";
$next[5] = $LNG->EMBED_VIS_DEPENDENT_EDGESENSE_HISTORY;
$next[6] = $CFG->VIS_PAGE_EDGESENSE_HISTORY;
$next[7] = 90;
$next[8] = false;
$next[9] = false;
array_push($visdata, $next);

$next = array();
$next[0] = $LNG->EMBED_VIS_TITLE_INTEREST_NETWORK;
$next[1] = 14;
$next[2] = $LNG->EMBED_VIS_DESC_INTEREST_NETWORK;
$next[3] = $CFG->homeAddress."images/visualisations/interestnetwork-sm.png";
$next[4] = $CFG->homeAddress."ui/visualisations/fdinterestgraph.php?";
$next[5] = $LNG->EMBED_VIS_DEPENDENT_INTEREST_NETWORK;
$next[6] = $CFG->VIS_PAGE_INTEREST_NETWORK;
$next[7] = 160;
$next[8] = true;
$next[9] = true;
array_push($visdata, $next);

$next = array();
$next[0] = $LNG->EMBED_VIS_TITLE_COMMUNITIES_NETWORK;
$next[1] = 15;
$next[2] = $LNG->EMBED_VIS_DESC_COMMUNITIES_NETWORK;
$next[3] = $CFG->homeAddress."images/visualisations/communitynetwork-sm.png";
$next[4] = $CFG->homeAddress."ui/visualisations/fdcommunitiesgraph.php?";
$next[5] = $LNG->EMBED_VIS_DEPENDENT_COMMUNITIES_NETWORK;
$next[6] = $CFG->VIS_PAGE_COMMUNITIES_NETWORK;
$next[7] = 160;
$next[8] = true;
$next[9] = true;
array_push($visdata, $next);

$next = array();
$next[0] = $LNG->EMBED_VIS_TITLE_SUNBURST_NETWORK_BRANCH;
$next[1] = 16;
$next[2] = $LNG->EMBED_VIS_DESC_SUNBURST_NETWORK_BRANCH;
$next[3] = $CFG->homeAddress."images/visualisations/sunburstnetworkbranch-sm.png";
$next[4] = $CFG->homeAddress."ui/visualisations/sunburstnetworkbranch.php?";
$next[5] = $LNG->EMBED_VIS_DEPENDENT_SUNBURST_NETWORK_BRANCH;
$next[6] = $CFG->VIS_PAGE_SUNBURST_NETWORK_BRANCH;
$next[7] = 136;
$next[8] = true;
$next[9] = false;
array_push($visdata, $next);

$next = array();
$next[0] = $LNG->EMBED_VIS_TITLE_SUNBURST_NETWORK;
$next[1] = 17;
$next[2] = $LNG->EMBED_VIS_DESC_SUNBURST_NETWORK;
$next[3] = $CFG->homeAddress."images/visualisations/sunburstnetwork-sm.png";
$next[4] = $CFG->homeAddress."ui/visualisations/sunburstnetwork.php?";
$next[5] = $LNG->EMBED_VIS_DEPENDENT_SUNBURST_NETWORK;
$next[6] = $CFG->VIS_PAGE_SUNBURST_NETWORK;
$next[7] = 150;
$next[8] = true;
$next[9] = false;
array_push($visdata, $next);

$next = array();
$next[0] = $LNG->EMBED_VIS_TITLE_TREEMAP;
$next[1] = 18;
$next[2] = $LNG->EMBED_VIS_DESC_TREEMAP;
$next[3] = $CFG->homeAddress."images/visualisations/treemap-sm.png";
$next[4] = $CFG->homeAddress."ui/visualisations/treemap.php?";
$next[5] = $LNG->EMBED_VIS_DEPENDENT_TREEMAP;
$next[6] = $CFG->VIS_PAGE_TREEMAP;
$next[7] = 170;
$next[8] = true;
$next[9] = false;
array_push($visdata, $next);

$next = array();
$next[0] = $LNG->EMBED_VIS_TITLE_TREEMAP_BY_TYPE;
$next[1] = 19;
$next[2] = $LNG->EMBED_VIS_DESC_TREEMAP_BY_TYPE;
$next[3] = $CFG->homeAddress."images/visualisations/treemapbytype-sm.png";
$next[4] = $CFG->homeAddress."ui/visualisations/treemapbytype.php?";
$next[5] = $LNG->EMBED_VIS_DEPENDENT_TREEMAP_BY_TYPE;
$next[6] = $CFG->VIS_PAGE_TREEMAP_BY_TYPE;
$next[7] = 170;
$next[8] = true;
$next[9] = false;
array_push($visdata, $next);

$next = array();
$next[0] = $LNG->EMBED_VIS_TITLE_TREEMAP_TOP_DOWN;
$next[1] = 20;
$next[2] = $LNG->EMBED_VIS_DESC_TREEMAP_TOP_DOWN;
$next[3] = $CFG->homeAddress."images/visualisations/treemaptopdown-sm.png";
$next[4] = $CFG->homeAddress."ui/visualisations/treemaptopdown.php?";
$next[5] = $LNG->EMBED_VIS_DEPENDENT_TREEMAP_TOP_DOWN;
$next[6] = $CFG->VIS_PAGE_TREEMAP_TOP_DOWN;
$next[7] = 170;
$next[8] = true;
$next[9] = false;
array_push($visdata, $next);

$next = array();
$next[0] = $LNG->EMBED_VIS_TITLE_TREEMAP_TOP_DOWN_BY_TYPE;
$next[1] = 21;
$next[2] = $LNG->EMBED_VIS_DESC_TREEMAP_TOP_DOWN_BY_TYPE;
$next[3] = $CFG->homeAddress."images/visualisations/treemaptopdownbytype-sm.png";
$next[4] = $CFG->homeAddress."ui/visualisations/treemaptopdownbytype.php?";
$next[5] = $LNG->EMBED_VIS_DEPENDENT_TREEMAP_TOP_DOWN_BY_TYPE;
$next[6] = $CFG->VIS_PAGE_TREEMAP_TOP_DOWN_BY_TYPE;
$next[7] = 170;
$next[8] = true;
$next[9] = false;
array_push($visdata, $next);

$next = array();
$next[0] = $LNG->EMBED_VIS_TITLE_TREE;
$next[1] = 22;
$next[2] = $LNG->EMBED_VIS_DESC_TREE;
$next[3] = $CFG->homeAddress."images/visualisations/tree-sm.png";
$next[4] = $CFG->homeAddress."ui/visualisations/treezoom.php?";
$next[5] = $LNG->EMBED_VIS_DEPENDENT_TREE;
$next[6] = $CFG->VIS_PAGE_TREE;
$next[7] = 170;
$next[8] = true;
$next[9] = false;
array_push($visdata, $next);

$next = array();
$next[0] = $LNG->EMBED_VIS_TITLE_TREE_BY_POSTS;
$next[1] = 23;
$next[2] = $LNG->EMBED_VIS_DESC_TREE_BY_POSTS;
$next[3] = $CFG->homeAddress."images/visualisations/treeposts-sm.png";
$next[4] = $CFG->homeAddress."ui/visualisations/treezoomposts.php?";
$next[5] = $LNG->EMBED_VIS_DEPENDENT_TREE_BY_POSTS;
$next[6] = $CFG->VIS_PAGE_TREE_BY_POSTS;
$next[7] = 170;
$next[8] = false;
$next[9] = false;
array_push($visdata, $next);

?>
