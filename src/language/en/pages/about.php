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

$LNG->PAGE_ABOUT_TITLE = "About the ".$CFG->SITE_TITLE;

$LNG->PAGE_ABOUT_BODY = '<p>The Collective Intelligence Dashboard (CI dashboard) is an open online service that
						provides analytics visualisations for online debate platforms. It is a place in which analytics
						on conversational and social dynamics can be made visible and fed back to the community for
						further awareness and reflection on the state and outcomes of an online debate.
						This site gives an overview of all analytics visualisations we provide, allows to view them
						individually with demo and own data, to assemble a custom dashboard of visualisations,
						and provides the information necessary to embed the visualisations or the custom dashboard
						into other online debate platforms.</p>';
$LNG->PAGE_ABOUT_BODY .= '<p>CIDashboard uses your data passed to us in the
						<a href="http://purl.org/catalyst/jsonld" target="_blank">Catalyst Interchange Format (CIF)</a>.</p>';


$LNG->PAGE_ABOUT_BODY .= '<h2>Research</h2>';

$LNG->PAGE_ABOUT_BODY .= '<p>The CI Dashboard comes from research on Contested Collective Intelligence carried out by the <a href="idea.kmi.open.ac.uk">IDea group</a> from the Knowledge Media Institute.</p>';

$LNG->PAGE_ABOUT_BODY .= '<p>Contested Collective Intelligence (CCI) is a specific form of CI that emerges through structured
							discourse and argumentation. Mostly facilitated by argumentation-based online discussion tools,
							CCI aims at supporting collective sensemaking of complex societal dilemmas and seek to improve
							our collective capability to face complex problems by talking to each other and debating online.</p>';

$LNG->PAGE_ABOUT_BODY .= '<p>One of the key issues shared by most common platforms for online debate is poor visualization.
							In fact, online debate is still heavily dominated by text-based content, while most online users
							nowadays wish to have access to easy-to-understand image/video-based content that they can grasp
							very rapidly and share easily with their peers. Even though, conveying results of online
							deliberation with effective visualization methods is an open challenge. </p>';

$LNG->PAGE_ABOUT_BODY .= '<p style="font-style:italic">How would you visualize what happens in an online community?
							<br>How can we make idea and arguments more tangible so that they can be easily grasped, understood
							and shared?
							<br>How do we device intuitive, engaging, interactive visualisations for users to better explore
							and understand the main content, insights, outcomes and hidden dynamics of an online debate?</p>';

$LNG->PAGE_ABOUT_BODY .= '<p>The CIDashboard Website is the result of research work aimed at answering those questions.
							It consists of a new service which supports debate summarization, understanding and sensemaking
							by providing a variety of alternative visualisations of the state, content and results of an
							online discussion.<p>';

$LNG->PAGE_ABOUT_BODY .= '<p>Early user-requirements analysis of existing online community debating platforms revealed that
							there where the following main issues that we hoped to address:
							<ul>
							<li>Participants struggle to get an overview of what happened in an online community debate. (Who are the key
							members? What are the most relevant discussions? Etc).</li><br>
							<li>Participants are rarely aware of other people\'s contributions before they contribute to the debate (this also
							leads to poorly informed contribution and idea duplication).</li><br>
							<li>Newcomers do not know where to start contributing.</li><br>
							<li>Community managers do not know where new contributions would be mostly needed
							(debate management is ineffective because community managers are missing tools to
							analyse the debate and direct users attention).</li><br>
							<li>Community managers struggle to summarise the state of a debate to disseminate results and engage new users.</li>
							</ul>

							These issues informed the choice of visualisations, analytics and alerts that you will find on
							this website. It is our aim to provide \'embeddables\' that improve informed participation and
							the quality of contributions in an online debate site that uses them.</p>';

$LNG->PAGE_ABOUT_BODY .= '<h2>Tech Info</h2>';


$LNG->PAGE_ABOUT_BODY .= '<p>The Collective Intelligence dashboard  (<a href="https://cidashboard.net/">CI dashboard</a>)
							is a analytics visualisation service provider for other online discussion and Collective
							Intelligence platform providers, such as for instance
							<a target="_blank" href="http://assembl.org/">Assembl</a> - a large scale co-production system,
							<a target="_blank" href="https://debatehub.net/">DebateHub</a>  - a hub for structured debates,
							or <a target="_blank" href="https://litemap.net/">LiteMap</a> - a debate mapping tool. The communication between the analytics visualisation
							provider and the platforms is based on a standardised data format -
							the CATALYST Interchange format <a href="http://purl.org/catalyst/jsonld" target="_blank">Catalyst Interchange Format (CIF)</a>.
							The CIF format is modelled in terms of RDF and is serialised as JSON-LD. It provides a
							standardised description of online conversations. The CI dashboard uses the CIF data either
							directly to generate visualisations, or it requests CI statistics from the CATALYST metric service.
							This services calculates CI specific metrics from the CIF data and provides these to the
							CI dashboard.</p>';

$LNG->PAGE_ABOUT_BODY .= '<p>For more info on the Catalyst Metric Service download the
							<a target="_blank" href="http://catalyst-fp7.eu/wp-content/uploads/2014/06/CATALYST_D3.5.pdf">Deliberation Analytics Report</a>.';

$LNG->PAGE_ABOUT_BODY .= '<h2>Acknowledgments</h2>';

$LNG->PAGE_ABOUT_BODY .= '<p>'.$CFG->SITE_TITLE.' Design, Development and Testing was undertaken as part of the <a href="http://catalyst-fp7.eu/" target="_blank">Catalyst Project</a> by the ';
$LNG->PAGE_ABOUT_BODY .= '<a target="_blank" href="http://kmi.open.ac.uk/">Knowledge Media Institute</a> ';
$LNG->PAGE_ABOUT_BODY .= 'team (';
$LNG->PAGE_ABOUT_BODY .= '<a target="About" href="http://people.kmi.open.ac.uk/anna/index.html">Anna De Liddo</a> and ';
$LNG->PAGE_ABOUT_BODY .= '<a target="About" href="http://kmi.open.ac.uk/people/bachler">Michelle Bachler</a>).';
$LNG->PAGE_ABOUT_BODY .= ' We are also indebted to <a target="_blank" href="http://kmi.open.ac.uk/people/harry/">Harriett Cornish</a> for graphic design.</p> ';
?>