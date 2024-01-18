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
 ?>


<div style="background:transparent;clear:both; float:left; width: 100%;margin-top:10px;">
	<div style="clear:both;float:left;"><?php echo $LNG->HELP_USER_PARA1; ?></div>

	<div style="clear:both;float:left;margin-top:10px;"><?php echo $LNG->HELP_USER_PARA2; ?></div>

	<div style="clear:both;float:left;margin-top:10px;"><?php echo $LNG->HELP_USER_PARA3; ?></div>

	<div style="clear:both;float:left;"><?php echo $LNG->HELP_USER_PARA4; ?></div>
	<div style="color:black;clear:both;float:left;">
	<pre>
	...
	{
		"@type": "Agent",
		"@id": "main_site:agents/3PAgpYJCTXJV8fpjRnROsPzJrNwqdJAwewPULnZq1Q%3D%3D"
	},
	{
		"@type": "Agent",
		"@id": "main_site:agents/3PaHB97mVdmSWSYa9HmRtfLhXnuereJgD3jTOmJZ"
	},
	{
		"@type": "Agent",
		"@id": "main_site:agents/3PaHB97mVdhama%2BhPIJif%2BO0K0sF"
	},
	{
		"@type": "Agent",
		"@id": "main_site:agents/1YqwWAXoGpx99g4isKTxKHptqYYKREr3qCVLpw%3D%3D"
	},
	...
	</pre>
	</div>

	<div style="clear:both;float:left;"><?php echo $LNG->HELP_USER_PARA5; ?></div>
	<div style="color:black;clear:both;float:left;">
	<pre>
{
    "@context": [
        "http://purl.org/catalyst/jsonld",
        {
            "main_site": "http://debatehubdev.kmi.open.ac.uk/api/"
        }
    ],
    "@graph": [
        {
            "@type": "Agent",
            "@id": "main_site:agents/3PAgpYJCTXJV8fpjRnROsPzJrNwqdJAwewPULnZq1Q%3D%3D",
            "img": "url to user image",
            "fname": "Lee-Sean Huang"
        },
        {
            "@type": "Agent",
            "@id": "main_site:agents/3PaHB97mVdmSWSYa9HmRtfLhXnuereJgD3jTOmJZ",
            "img": "url to user image",
            "fname": "Anna De Liddo"
        },
        {
            "@type": "Agent",
            "@id": "main_site:agents/3PaHB97mVdhama%2BhPIJif%2BO0K0sF",
            "description": "CIDashboard software developer",
            "img": "url to user image",
            "homepage": "http://kmi.open.ac.uk/people/bachler/",
            "fname": "Michelle Bachler - Yahoo"
        },
        {
            "@type": "Agent",
            "@id": "main_site:agents/1YqwWAXoGpx99g4isKTxKHptqYYKREr3qCVLpw%3D%3D",
            "img": "url to user image",
            "fname": "Thomas Ullmann"
        },
    ]
}

	</pre>
	</div>
</div>
