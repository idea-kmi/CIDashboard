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
include_once("../../config.php");

include_once($HUB_FLM->getCodeDirPath("ui/header.php"));
?>

<div style="float:left;padding:10px;padding-top:0px;padding-botton:0px;">
<center><h1><?php echo $CFG->SITE_TITLE; ?> Releases</h1></center>

<h2>0.01 Alpha - October 2013 - November 2014</h2>
<p>Initial development:
<ol>
<li>HTML5 canvased based Large Visualisations:
<ul>
<li>Conversation Nesting visualisation</li>
<li>Activity Analysis</li>
<li>User Activity Analysis</li>
<li>Quick Overview</li>
<li>People and Issue Ring</li>
<li>Contribution Stream</li>
<li>Contribution River</li>
</ul>
</li>

<li>HTML5 canvased based Large Visualisations incorporating remote Metrics:
<ul>
<li>Attention Map</li>
<li>Rating Bias</li>
<li>Activity Bias</li>
</ul>
</li>

<li>Reader to load remote CIF (Catalyst Interchance Format) data and then processing to convert that  for each separate visualisations requirements.</li>
<li>Caching system to speed up multiple hits on visualisations for the same data with timeout specified by the user.</li>
<li>Website interface to demo, preview visualisations with external data and to obtain the embed code and link code for external use.</li>
<li>A dashboard system to build and arrange multiple visualisations into a single embeddable or linkable to page view.</li>

</ol>
</p>

<h2>0.1 Alpha - 26th November 2015</h2>
<p>Mini Dashboard Page with facilities to preview, demo and get embeddables for the follow HTML5 canvased based viusalisation:
<ul>
<li>User Contributions</li>
<li>User Viewing Activity</li>
<li>Participation Indicator</li>
<li>Viewing Activity Indicator</li>
<li>Contribution Activity Indicator</li>
<li>Word Counts</li>
</ul>
</p>

<h2>0.2 Alpha - 21st April 2015</h2>
<p>
<ol>
<li>Handling user obfuscation: Accept a second url to separate user details from core visualisation data. User data is only called from the client side to unobfuscate user details in the visualisation and is never stored or seen by the sever.</li>
<li>New alerts page. List alert metrics that can be requested on a CIF data set, and provide an interface to test them and generate an embeddable.</li>
</ol>
</p>

<h2>0.3 Alpha - 10th June 2015</h2>
<p>New large Visualisations and Edgesense integration:
<ul>
<li>Edgesense Social Network</li>
<li>Community Interest Network</li>
<li>Sub-Communities Network</li>
</ul>
</p>

<h2>0.4 Alpha - 25th June 2015</h2>
<p>New large Visualisations:
<ul>
<li>Conversation Sunburst Network by Branch</li>
<li>Conversation Sunburst Network by Type</li>
<li>Conversation Treemap</li>
<li>Conversation Treemap By Type</li>
<li>Conversation Treemap - Top down</li>
</ul>
</p>

<h2>0.5 Alpha - 20th August 2015</h2>
<p>New large Visualisations:
<ul>
<li>Collapsible Tree</li>
<li>Collapsible Tree by Posts</li>
</ul>
</p>

<h2>0.6 Alpha - 7th September 2015</h2>
<ul>
<li>New redesign of interface for grouping large visualisations and making the menu system cleaner.</li>
<li>New language terms override feature to allow users to tailor the node and link names that appear in the visualisations to be more specific to their communities.</li>
<li>postMessage messages added to Collapsible Tree & Collapsible Tree by Posts visualisations.</li>
</ul>
</p>

<h2>0.7 Alpha - 13th October 2015</h2>
<p>
New language options for embeddables.
<br>Currently options are: English, German, Spanish and Portuguese.
</p>

<h2>1.0 - 19th November 2015</h2>
<p>
Help pages added.
</p>

</div>
<?php
include_once($HUB_FLM->getCodeDirPath("ui/footer.php"));
?>