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

/** CIF PAGE **/
$LNG->HELP_CIF_INTRO = 'The Catalyst Interchange Format (CIF) is a jsonld schema for representing conversational data from online forums, debating tools and dialogue mapping websites.';

$LNG->HELP_CIF_DOCS_MESSAGE = 'There are two key documents for understanding the Catalyst Interchange Format (CIF):';
$LNG->HELP_CIF_ARCHITECTURE = '<a target="_blank" href="https://catalyst-fp7.idea.kmi.open.ac.uk/catalyst-data/uploads/2014/03/D3.1-Software-Architecture-and-Cross-Platform-Interoperability-Specification.pdf">Software Architecture and Cross-Platform Interoperability Specification</a>';
$LNG->HELP_CIF_SCHEMA = '<a target="_blank" href="https://purl.org/catalyst/jsonld">The jsonld RDF schema</a>';


$LNG->HELP_CIF_MESSAGE = 'Below are some key concepts extracted from the interoperability specification:';
$LNG->HELP_CIF_QUOTE1 = 'Most Collective Intelligence tools allow organising concepts in some sort of structure
			that reflects the conversation back to the participants (a concept map in the very broadest sense).
			The core of this specification is a Data Model to represent the following in a systems-independent way
			while preserving as much semantics as practical:"';

$LNG->HELP_CIF_QUOTE1_POINT1 = 'The generic ideas of the concept map';
$LNG->HELP_CIF_QUOTE1_POINT2 = 'The people interacting with them';
$LNG->HELP_CIF_QUOTE1_POINT3 = 'The interactions these people have about the generic ideas (Messages, comments, votes, etc.)';

$LNG->HELP_CIF_MESSAGE2 = 'It goes on to say:';

$LNG->HELP_CIF_QUOTE2 = 'The type and amount of structure can vary greatly between systems,
						but we believe there are some useful levels of "shared semantics"
						that are achievable relatively easily.';

$LNG->HELP_CIF_QUOTE3 = 'The first and most basic level is sharing the raw structure of the concept map
						(nodes, edges) with very basic information (such as node title). This allows several
						visualisation tools to be applied, as well as a significant number of metrics.';

$LNG->HELP_CIF_QUOTE4 = 'The second level is to share more semantics about the nature of the concepts identified.
						The consortium agreed that using IBIS (Issue-Based Information System) as a common baseline
						would foster the emergence of initial tooling. While it has significant limitations,
						IBIS is a good choice because:';
$LNG->HELP_CIF_QUOTE4_POINT1 = 'It\'s widely used by existing Collective Intelligence software';
$LNG->HELP_CIF_QUOTE4_POINT2 = 'Many systems not using IBIS could transform at least a subset of their data into meaningful IBIS';

$LNG->HELP_CIF_MESSAGE3 = 'So, to leverage the visualisations and analytics we provide, the more detailed CIf
						you can provide us the better the results you will get. But even with very simple forum post
						trees there are many visualisations and alerts you can access.';


/** LANGUAGE OVERRRIDE PAGE **/

$LNG->HELP_LANG_COLUMN_TERM = 'Term Name';
$LNG->HELP_LANG_COLUMN_CIF = 'Cif Term / Explanation';
$LNG->HELP_LANG_COLUMN_SINGULAR = 'Default Singular';
$LNG->HELP_LANG_COLUMN_PLURAL = 'Default Plural';
$LNG->HELP_LANG_COLUMN_TEXT = ' 	Default Text';

$LNG->HELP_LANG_MESSAGE = "The following terms can be overridden in the visualisation interfaces by providing a url to a json file containing the overrides which you place in the 'Language override' field. You can override all or only some of the terms.";
$LNG->HELP_LANG_MESSAGE2 = "Below is an example of the expected structure of the json file. Remember you don't need to include all the terms, only those that you want to override.";
$LNG->HELP_LANG_NODE_TITLE = "Node label overrides & Bits";
$LNG->HELP_LANG_LINK_TITLE = "Link label overrides";
$LNG->HELP_LANG_LINK_MESSAGE = "Link labels are currently only used on the 'Conversation Network' visualisation.";

$LNG->HELP_LANG_PRO_NAME = 'When Argument has only supporting links';
$LNG->HELP_LANG_CON_NAME = 'When Argument has only opposing links';
$LNG->HELP_LANG_DEBATE_NAME = 'Term used for a discussion/conversation/debate/dialogue';
$LNG->HELP_LANG_GROUP_NAME = 'Term used for top level grouping in some tree visualisations';

/** USERS AND PRIVACY PAGE **/
$LNG->HELP_USER_PARA1 = 'If you wish to display user names, descriptions or homepage
						links in any of the visualisations you select that require them,
						but you do not wish that data to be cached or stored on a server,
						you can optionally supply a separate url to get that data.
						The user url is only called and displayed by the browser and
						never the server, so that user data is not stored on any server.';

$LNG->HELP_USER_PARA2 = 'The user data must be supplied in <span class="active" onclick="setTabPushed($(\'tab-help-cif\'),\'help-cif\');">Catalyst Interchange Format (CIF)</span> containing CIF Agent
						objects with Agent "@id" parameters that match those supplied in the visualisation <span class="active" onclick="setTabPushed($(\'tab-help-cif\'),\'help-cif\');">CIF</span>
						data you give us.';

$LNG->HELP_USER_PARA3 = 'The user url must be https and the server processing the user url must be able to pick up
						the \'callback\' parameter we add to the their user url and wrap the reply json in the callback
						function we name. Here is an example of a user url with a callback function appended:
						<pre>https://debatehubdev.kmi.open.ac.uk/api/unobfuscatedusers/?id=1722128760457755001427202440&callback=processCIFUserData</pre>';

$LNG->HELP_USER_PARA4 = 'So, as an example, in the visualisation CIF data you would give us the user Agent entries with just the id parameters completed but no personal information, e.g.:';

$LNG->HELP_USER_PARA5 = 'Then when we called your user data url from the browser you would give us just the Agent entries again but this time with any user information like "fname" etc.. filled in. Remembering that the "@id" parameters must match those you supplied us in the visualisation data, e.g.:';

/** MOVIES **/
$LNG->HELP_MOVIES_TITLE_INTRO = 'Quick Intoduction';
$LNG->HELP_MOVIES_TITLE_LARGEVIS = 'Large Visualisations';
$LNG->HELP_MOVIES_TITLE_MINIVIS = 'Mini Visualisations';
$LNG->HELP_MOVIES_TITLE_ALERTS= 'Alerts';


/** LARGE AND MINI EMBED SHARED VARIABLES **/

$LNG->HELP_EMBED_TABLE_VISES_HEADING1 = 'Title';
$LNG->HELP_EMBED_TABLE_VISES_HEADING2 = 'Description';
$LNG->HELP_EMBED_TABLE_VISES_HEADING3 = 'ID';
$LNG->HELP_EMBED_TABLE_VISES_HEADING4 = 'URL base';
$LNG->HELP_EMBED_TABLE_VISES_HEADING5 = 'Uses withposts';

$LNG->HELP_EMBED_PARAMS_TABLE = 'Below is a table describing the url parameters that you can use with the <b>URL base</b> strings given above.:';
$LNG->HELP_EMBED_TABLE_PARAMS_HEADING1 = 'Parameter';
$LNG->HELP_EMBED_TABLE_PARAMS_HEADING2 = 'Default / Use';
$LNG->HELP_EMBED_TABLE_PARAMS_HEADING3 = 'Further Info';

$LNG->HELP_EMBED_TABLE_URL_USE = '(compulsory) Must return CIF formatted jsonld';
$LNG->HELP_EMBED_TABLE_URL_INFO = 'CIF help page';

$LNG->HELP_EMBED_TABLE_LANG_USE = '(optional) Currently available options are:  en (english, the default); de (German); es (Spanish); pt(Portuguese)';

$LNG->HELP_EMBED_TABLE_LANGURL_USE = '(optional) Must return correctly formatted json';
$LNG->HELP_EMBED_TABLE_LANGURL_INFO = 'Language Overriding help page';
$LNG->HELP_EMBED_TABLE_TIMEOUT_USE = '(optional - default is 60) Number of seconds to cache the visualisation CIF data for on our server.';
$LNG->HELP_EMBED_TABLE_WITHPOSTS_USE = '(optional - default is false) true/false; Only used with some individual visualisatoins (see above table), NOT dashboards. Indicates whether to include post data if present in the visualisation';


/** EMBED LARGE VISUALISATIONS PAGE **/

$LNG->HELP_EMBED_LARGE_INTRO = 'This help page will describe the large visualisation embed urls and their parameters and show some examples of use.';

$LNG->HELP_EMBED_LARGE_TITLE = 'Embeddding Large Visualisations';
$LNG->HELP_EMBED_LARGE_INDIVIDUAL = 'Individual Large Visualisations';
$LNG->HELP_EMBED_LARGE_DASHBOARD = 'Dashboard of Large Visualisations';

$LNG->HELP_EMBED_LARGE_IFRAME = 'An example of an iframe embed block for a single visualisation is: ';
$LNG->HELP_EMBED_LARGE_PAGE = 'An example of a url for a full page link for a single visualisation is: ';

$LNG->HELP_EMBED_LARGE_PARA1 = 'You will notice that the src url for the iframe and the url for the full page link are basically the same.
						Though strictly speaking the full page link url does not require the width and height parameters, they are
						there because the url creation for both in centralised.';

$LNG->HELP_EMBED_LARGE_VISES_TABLE = 'Below is a table describing the individual large visualisation. The <b>URL base</b> is the first part of biulding a url to call that individual visualisation:';

$LNG->HELP_EMBED_TABLE_USERURL_USE = '(optional) Must be a https url returning CIF formatted jsonld wrapped in our callback function';
$LNG->HELP_EMBED_TABLE_USERURL_INFO = 'User and Privacy help page';
$LNG->HELP_EMBED_TABLE_WITHTITLE_USE = '(optional - default is true) true/false; indicates whether to display our title above the visualisation. When used on a dashboard url, this applies to all visualisations';
$LNG->HELP_EMBED_TABLE_WITHDESC_USE = '(optional - default is true) true/false; indicates whether to display our description above the visualisation. When used on a dashboard url, this applies to all visualisations';
$LNG->HELP_EMBED_TABLE_WIDTH_USE = '(optional - default 1000) Only used on iframe src url. Please include this if you make a change to the default iframe width property we set';
$LNG->HELP_EMBED_TABLE_HEIGHT_USE = '(optional - default 1000) Only used on iframe src url. Please include this if you make a change to the default iframe height property we set';

$LNG->HELP_EMBED_IFRAME_DASHBOARD = 'An example of an iframe embed block for a dashboard of large visualisations is: ';
$LNG->HELP_EMBED_PAGE_DASHBOARD = 'An example of a url for a full page link for a dashboard of large visualisations is: ';
$LNG->HELP_EMBED_PARA2 = 'You will notice that again the src url for the iframe and the url for the full page link are basically the same.
							However,  unlike when embedding individual visualisations, with dashboards the page called is always
							<b>'.$CFG->homeAddress.'ui/visualisations/index.php?</b>, but it has some additional parameters as given below:';

$LNG->HELP_EMBED_TABLE_VIS_USE = '(compulsory) This string indicates which visualisations you have selected for your dashboard as well as the order they are to be displayed.
									It is a comma separate string of the large visualisation ID numbers, as given in the Large Visualisations table above. Some of the visualisation ID numbers can have a letter after them.
									The letter <b>p</b>  before an ID number denotes you wish to include posts (withposts) for that visualisation (see the Large visualisation table above for which visualisations this applies to).
									For the Edgesense visualisation you can also have <b>c</b> before its ID number to denote you want the network only.';
$LNG->HELP_EMBED_TABLE_TITLE_USE = '(optional) Title - a title for your dashboard.';

$LNG->HELP_EMBED_LARGE_EXAMPLE = 'Example iframe of a single large visualisation:';
$LNG->HELP_EMBED_LARGE_DASH_EXAMPLE = 'Example iframe of a dashboard of large visualisations:';


/** EMBED MINI VISUALISATIONS PAGE **/

$LNG->HELP_EMBED_MINI_INTRO = 'This help page will describe the mini visualisation embed urls and their parameters and show some examples of use.';
$LNG->HELP_EMBED_MINI_TITLE = 'Embeddding Mini Visualisations';
$LNG->HELP_EMBED_MINI_INDIVIDUAL = 'Individual Mini Visualisations';
$LNG->HELP_EMBED_MINI_DASHBOARD = 'Dashboard of Mini Visualisations';

$LNG->HELP_EMBED_MINI_IFRAME = 'An example of an iframe embed block for a single visualisation is: ';
$LNG->HELP_EMBED_MINI_PAGE = 'An example of a url for a full page link for a single visualisation is: ';

$LNG->HELP_EMBED_MINI_PARA1 = 'You will notice that the src url for the iframe and the url for the full page link are basically the same.';

$LNG->HELP_EMBED_MINI_VISES_TABLE = 'Below is a table describing the individual mini visualisation. The <b>URL base</b> is the first part of biulding a url to call that individual visualisation:';
$LNG->HELP_EMBED_IFRAME_MINI_DASHBOARD = 'An example of an iframe embed block for a dashboard of mini visualisations is: ';
$LNG->HELP_EMBED_PAGE_MINI_DASHBOARD = 'An example of a url for a full page link for a dashboard of mini visualisations is: ';

$LNG->HELP_EMBED_MINI_PARA2 = 'You will notice that again the src url for the iframe and the url for the full page link are basically the same.
							However,  unlike when embedding individual visualisations, with dashboards the page called is always
							<b>'.$CFG->homeAddress.'ui/minis/minidashboard.php?</b>, but it has some additional parameters as given below:';

$LNG->HELP_EMBED_TABLE_MINI_VIS_USE = '(compulsory) This string indicates which visualisations you have selected for your dashboard as well as the order they are to be displayed.
									It is a comma separate string of the large visualisation ID numbers, as given in the Large Visualisations table above. Some of the visualisation ID numbers can have a letter after them.
									The letter <b>p</b>  before an ID number denotes you wish to include posts (withposts) for that visualisation).';
$LNG->HELP_EMBED_TABLE_MINI_TITLE_USE = '(optional) Title - a title for your dashboard.';

$LNG->HELP_EMBED_MINI_EXAMPLE = 'Example iframe of a single mini visualisation:';
$LNG->HELP_EMBED_MINI_DASH_EXAMPLE = 'Example iframe of a dashboard of mini visualisations:';


/** ALERT PAGE **/
$LNG->HELP_ALERT_INTRO = 'This help page will describe the alerts, alert embed urls and their parameters. All the alerts are ';

$LNG->HELP_EMBED_ALERT_IFRAME = 'An example of an iframe embed block for a set of alerts is: ';
$LNG->HELP_EMBED_ALERT_PAGE = 'An example of a url for a full page link for a set of alerts is: ';

$LNG->HELP_EMBED_ALERT_PARA1 = 'You will notice that the src url for the iframe and the url for the full page link are basically the same.';

$LNG->HELP_EMBED_ALERT_TABLE = 'Below is a table describing the individual Alerts and their dependencies:';

$LNG->HELP_EMBED_TABLE_ALERT_HEADING1 = 'Title';
$LNG->HELP_EMBED_TABLE_ALERT_HEADING2 = 'Description';
$LNG->HELP_EMBED_TABLE_ALERT_HEADING3 = 'ID';
$LNG->HELP_EMBED_TABLE_ALERT_HEADING4 = 'Metric ID';
$LNG->HELP_EMBED_TABLE_ALERT_HEADING5 = 'Data Dependencies';

$LNG->HELP_ALERT_PARAMS_TABLE = 'Below is a table describing the url parameters that you can use with the <b>URL base</b>:';

$LNG->HELP_ALERT_TABLE_ALERTS_USE = '(compulsory) This string indicates which alerts you have selected. It is a comma separate string of the large alerts ID numbers, as given in the alerts table above.';
$LNG->HELP_ALERT_TABLE_USERIDS_USE = '(optional) This string indicates which users you want to generate alerts for. It is a comma separated list of the user ids as found in the Visualisation data supplied in the url parameter.';

$LNG->HELP_EMBED_ALERTS_EXAMPLE = 'Example iframe of a list of alerts:';
?>
