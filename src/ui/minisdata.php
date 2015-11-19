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

$minisequence = array(1,2,3,4,5,6);

$minidata = array();

$next = array();
$next[0] = $LNG->EMBED_MINI_TITLE_USER_CONTRIBUTIONS;
$next[1] = 1;
$next[2] = $LNG->EMBED_MINI_DESC_USER_CONTRIBUTIONS;
$next[3] = $CFG->homeAddress."images/visualisations/usercontributions-v-sm.png";
$next[4] = $CFG->homeAddress."ui/minis/usercontributions.php?";
$next[5] = $LNG->EMBED_MINI_DEPENDENT_USER_CONTRIBUTIONS;
$next[6] = $CFG->MINI_PAGE_USER_CONTRIBUTIONS;
$next[7] = 170;
$next[8] = true;
$next[9] = true; //include votes
array_push($minidata, $next);

$next = array();
$next[0] = $LNG->EMBED_MINI_TITLE_USER_VIEWING;
$next[1] = 2;
$next[2] = $LNG->EMBED_MINI_DESC_USER_VIEWING;
$next[3] = $CFG->homeAddress."images/visualisations/userviewing-v-sm.png";
$next[4] = $CFG->homeAddress."ui/minis/userviewing.php?";
$next[5] = $LNG->EMBED_MINI_DEPENDENT_USER_VIEWING;
$next[6] = $CFG->MINI_PAGE_USER_VIEWING;
$next[7] = 170;
$next[8] = true; //include posts
$next[9] = false; //include votes
array_push($minidata, $next);

$next = array();
$next[0] = $LNG->EMBED_MINI_TITLE_HEALTH_PARTICIPATION;
$next[1] = 3;
$next[2] = $LNG->EMBED_MINI_DESC_HEALTH_PARTICIPATION;
$next[3] = $CFG->homeAddress."images/visualisations/healthparticipation-sm.png";
$next[4] = $CFG->homeAddress."ui/minis/healthparticipation.php?";
$next[5] = $LNG->EMBED_MINI_DEPENDENT_HEALTH_PARTICIPATION;
$next[6] = $CFG->MINI_PAGE_HEALTH_PARTICIPATION;
$next[7] = 170;
$next[8] = true; //include posts
$next[9] = false; //include votes
array_push($minidata, $next);

$next = array();
$next[0] = $LNG->EMBED_MINI_TITLE_HEALTH_VIEWING;
$next[1] = 4;
$next[2] = $LNG->EMBED_MINI_DESC_HEALTH_VIEWING;
$next[3] = $CFG->homeAddress."images/visualisations/healthviewing-sm.png";
$next[4] = $CFG->homeAddress."ui/minis/healthviewing.php?";
$next[5] = $LNG->EMBED_MINI_DEPENDENT_HEALTH_VIEWING;
$next[6] = $CFG->MINI_PAGE_HEALTH_VIEWING;
$next[7] = 170;
$next[8] = true; //include posts
$next[9] = false; //include votes
array_push($minidata, $next);

$next = array();
$next[0] = $LNG->EMBED_MINI_TITLE_HEALTH_CONTRIBUTION;
$next[1] = 5;
$next[2] = $LNG->EMBED_MINI_DESC_HEALTH_CONTRIBUTION;
$next[3] = $CFG->homeAddress."images/visualisations/healthcontribution-sm.png";
$next[4] = $CFG->homeAddress."ui/minis/healthcontributions.php?";
$next[5] = $LNG->EMBED_MINI_DEPENDENT_HEALTH_CONTRIBUTION;
$next[6] = $CFG->MINI_PAGE_HEALTH_CONTRIBUTION;
$next[7] = 170;
$next[8] = true; //include posts
$next[9] = false; //include votes
array_push($minidata, $next);

$next = array();
$next[0] = $LNG->EMBED_MINI_TITLE_WORD_STATS;
$next[1] = 6;
$next[2] = $LNG->EMBED_MINI_DESC_WORD_STATS;
$next[3] = $CFG->homeAddress."images/visualisations/wordstats-sm.png";
$next[4] = $CFG->homeAddress."ui/minis/wordstats.php?";
$next[5] = $LNG->EMBED_MINI_DEPENDENT_WORD_STATS;
$next[6] = $CFG->MINI_PAGE_WORD_STATS;
$next[7] = 170;
$next[8] = true; //include posts
$next[9] = false; //include votes
array_push($minidata, $next);
?>
