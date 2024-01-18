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

<div class="py-3">
	<h2><?php echo $LNG->HELP_EMBED_LARGE_TITLE; ?></h2>
	<p><?php echo $LNG->HELP_EMBED_LARGE_INTRO; ?></p>

	<h3><?php echo $LNG->HELP_EMBED_LARGE_INDIVIDUAL; ?></h3>
	<p><?php echo $LNG->HELP_EMBED_LARGE_IFRAME; ?></p>
	<div class="bg-light border border-1 mb-3">
        <pre class="mt-4 font-monospace">
 &lt;iframe src="<?php echo $CFG->homeAddress; ?>ui/visualisations/circlepacking.php?width=1000&height=1000&withposts=false&lang=en&url=https%3A%2F%2Flitemap.net%2Fapi%2Fconversations%2F6d417f98-39b5-4d52-8759-90a297d7dd0e&userurl=&langurl=&timeout=60" width="1000" height="1000" style="overflow:auto" scrolling="auto" frameborder="1"&gt;&lt;/iframe&gt; 
		</pre>
	</div>

	<p><?php echo $LNG->HELP_EMBED_LARGE_PAGE; ?></p>
	<div class="bg-light border border-1 mb-3">
        <pre class="mt-4 font-monospace">
 <?php echo $CFG->homeAddress; ?>ui/visualisations/circlepacking.php?width=1000&height=1000&withposts=false&lang=en&url=https%3A%2F%2Flitemap.net%2Fapi%2Fconversations%2F6d417f98-39b5-4d52-8759-90a297d7dd0e&userurl=&langurl=&timeout=60 
		</pre>
	</div>

	<p><?php echo $LNG->HELP_EMBED_LARGE_PARA1; ?></p>
	<p><?php echo $LNG->HELP_EMBED_LARGE_VISES_TABLE; ?></p>

	<table class="table table-sm table-bordered table-striped">
		<tr>
			<td width="20%"><b><?php echo $LNG->HELP_EMBED_TABLE_VISES_HEADING1; ?></b></td>
			<td width="35%"><b><?php echo $LNG->HELP_EMBED_TABLE_VISES_HEADING2; ?></b></td>
			<td width="5%"><b><?php echo $LNG->HELP_EMBED_TABLE_VISES_HEADING3; ?></b></td>
			<td width="40%"><b><?php echo $LNG->HELP_EMBED_TABLE_VISES_HEADING4; ?></b></td>
			<td width="40%"><b><?php echo $LNG->HELP_EMBED_TABLE_VISES_HEADING5; ?></b></td>
		</tr>

		<?php
			include('visdata.php');

			$count = 0;
			if (is_countable($visdata)) {
				$count = count($visdata);
			}
			for ($i=0; $i<$count; $i++) {
				$item = $visdata[$i];
				echo '<tr>';
				echo '<td>'.$item[0].'</td>';
				echo '<td>'.$item[2].'</td>';
				echo '<td>'.$item[1].'</td>';
				echo '<td>'.$item[4].'</td>';
				if ($item[8]) {
					echo '<td>true</td>';
				} else {
					echo '<td>false</td>';
				}
				echo '</tr>';
			}
		?>
	</table>

	<p><?php echo $LNG->HELP_EMBED_PARAMS_TABLE; ?></p>

	<table class="table table-sm table-bordered table-striped">
		<tr>
			<td><b><?php echo $LNG->HELP_EMBED_TABLE_PARAMS_HEADING1; ?></b></td>
			<td><b><?php echo $LNG->HELP_EMBED_TABLE_PARAMS_HEADING2; ?></b></td>
			<td><b><?php echo $LNG->HELP_EMBED_TABLE_PARAMS_HEADING3; ?></b></td>
		</tr>
		<tr>
			<td>url</td>
			<td><?php echo $LNG->HELP_EMBED_TABLE_URL_USE; ?></td>
			<td><span class="active" onclick="setTabPushed($('tab-help-cif'),'help-cif');"><?php echo $LNG->HELP_EMBED_TABLE_URL_INFO; ?></span></td>
		</tr>
		<tr>
			<td>userurl</td>
			<td><?php echo $LNG->HELP_EMBED_TABLE_USERURL_USE; ?></td>
			<td><span class="active" onclick="setTabPushed($('tab-help-user'),'help-user');"><?php echo $LNG->HELP_EMBED_TABLE_USERURL_INFO; ?></span></td>
		</tr>
		<tr>
			<td>langurl</td>
			<td><?php echo $LNG->HELP_EMBED_TABLE_LANGURL_USE; ?></td>
			<td><span class="active" onclick="setTabPushed($('tab-help-lang'),'help-lang');"><?php echo $LNG->HELP_EMBED_TABLE_LANGURL_INFO; ?></span></td>
		</tr>
		<tr>
			<td>timeout</td>
			<td><?php echo $LNG->HELP_EMBED_TABLE_TIMEOUT_USE; ?></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>withposts</td>
			<td><?php echo $LNG->HELP_EMBED_TABLE_WITHPOSTS_USE; ?></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>withtitle</td>
			<td><?php echo $LNG->HELP_EMBED_TABLE_WITHTITLE_USE; ?></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>withdesc</td>
			<td><?php echo $LNG->HELP_EMBED_TABLE_WITHDESC_USE; ?></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>width</td>
			<td><?php echo $LNG->HELP_EMBED_TABLE_WIDTH_USE; ?></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>height</td>
			<td><?php echo $LNG->HELP_EMBED_TABLE_HEIGHT_USE; ?></td>
			<td>&nbsp;</td>
		</tr>
	</table>

	<div>
		<h3><?php echo $LNG->HELP_EMBED_LARGE_EXAMPLE; ?></h3>
		<div id="tab-content-vis-message"></div>
		<iframe id="largeexample" src="" width="1000" height="1000" frameborder="0"></iframe>
	</div>

	<div>
		<h3><?php echo $LNG->HELP_EMBED_LARGE_DASHBOARD; ?></h3>
		<p><?php echo $LNG->HELP_EMBED_IFRAME_DASHBOARD; ?></p>
		<div class="bg-light border border-1 mb-3">
			<pre class="mt-4 font-monospace">
 &lt;iframe src="<?php echo $CFG->homeAddress; ?>ui/visualisations/index.php?width=1000&height=1000&vis=p7%2C8%2Cp1%2C16%2C21%2C23&lang=en&title=Test%20Dashboard%20of%20Large%20Visualisations&url=https%3A%2F%2Flitemap.net%2Fapi%2Fconversations%2F6d417f98-39b5-4d52-8759-90a297d7dd0e&userurl=&langurl=&timeout=60" width="1000" height="1000" style="overflow:auto" scrolling="auto" frameborder="1"&gt;&lt;/iframe&gt;
			</pre>
		</div>
	</div>

	<p><?php echo $LNG->HELP_EMBED_PAGE_DASHBOARD; ?></p>
	<div class="bg-light border border-1 mb-3">
        <pre class="mt-4 font-monospace">
 <?php echo $CFG->homeAddress; ?>ui/visualisations/index.php?width=1000&height=1000&vis=p7%2C8%2Cp1%2C16%2C21%2C23&lang=en&title=Test%20Dashboard%20of%20Large%20Visualisations&url=https%3A%2F%2Flitemap.net%2Fapi%2Fconversations%2F6d417f98-39b5-4d52-8759-90a297d7dd0e&userurl=&langurl=&timeout=60 
 		</pre>
	</div>

	<p><?php echo $LNG->HELP_EMBED_PARA2; ?></p>
	<table class="table table-sm table-bordered table-striped">
		<tr>
			<td><b><?php echo $LNG->HELP_EMBED_TABLE_PARAMS_HEADING1; ?></b></td>
			<td><b><?php echo $LNG->HELP_EMBED_TABLE_PARAMS_HEADING2; ?></b></td>
		</tr>
		<tr>
			<td>vis</td>
			<td><?php echo $LNG->HELP_EMBED_TABLE_VIS_USE; ?></td>
		</tr>
		<tr>
			<td>title</td>
			<td><?php echo $LNG->HELP_EMBED_TABLE_TITLE_USE; ?></td>
		</tr>
	</table>

	<div class="mt-3 pt-2">
		<h3><?php echo $LNG->HELP_EMBED_LARGE_DASH_EXAMPLE; ?></h3>
		<div id="tab-content-visdash-message"></div>
		<iframe id="largedashexample" src="" height="1000" style="overflow:auto" scrolling="auto" frameborder="0" class="w-100 border border-1"></iframe>
	</div>
</div>