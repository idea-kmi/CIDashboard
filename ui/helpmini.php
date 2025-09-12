<?php
	/********************************************************************************
	 *                                                                              *
	 *  (c) Copyright 2015 - 2025 The Open University UK                            *
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
	<h2><?php echo $LNG->HELP_EMBED_MINI_TITLE; ?></h2>
	<p><?php echo $LNG->HELP_EMBED_MINI_INTRO; ?></p>

	<h3><?php echo $LNG->HELP_EMBED_MINI_INDIVIDUAL; ?></h3>
	<p><?php echo $LNG->HELP_EMBED_MINI_IFRAME; ?></p>
	<div class="bg-light border border-1 mb-3">
        <pre class="mt-4 font-monospace">
 &lt;iframe src="<?php echo $CFG->homeAddress; ?>ui/minis/usercontributions.php?miniwithposts=false&lang=en&url=https%3A%2F%2Flitemap.net%2Fapi%2Fviews%2Fb6f0374d-da86-4b13-9fc7-a16f154a5ff0&langurl=&timeout=60" width="350" height="220" frameborder="0"&gt;&lt;/iframe&gt;
		</pre>
	</div>

	<p><?php echo $LNG->HELP_EMBED_MINI_PAGE; ?></p>
	<div class="bg-light border border-1 mb-3">
        <pre class="mt-4 font-monospace">
 <?php echo $CFG->homeAddress; ?>ui/minis/usercontributions.php?miniwithposts=false&lang=en&url=https%3A%2F%2Flitemap.net%2Fapi%2Fviews%2Fb6f0374d-da86-4b13-9fc7-a16f154a5ff0&langurl=&timeout=60 
		</pre>
	</div>

	<p><?php echo $LNG->HELP_EMBED_MINI_PARA1; ?></p>
	<p><?php echo $LNG->HELP_EMBED_MINI_VISES_TABLE; ?></p>

	<table class="table table-sm table-bordered table-striped">
		<tr>
			<td width="20%"><b><?php echo $LNG->HELP_EMBED_TABLE_VISES_HEADING1; ?></b></td>
			<td width="35%"><b><?php echo $LNG->HELP_EMBED_TABLE_VISES_HEADING2; ?></b></td>
			<td width="5%"><b><?php echo $LNG->HELP_EMBED_TABLE_VISES_HEADING3; ?></b></td>
			<td width="40%"><b><?php echo $LNG->HELP_EMBED_TABLE_VISES_HEADING4; ?></b></td>
			<td width="40%"><b><?php echo $LNG->HELP_EMBED_TABLE_VISES_HEADING5; ?></b></td>
		</tr>

		<?php
			include('minisdata.php');

			$count = 0;
			if (is_countable($minidata)) {
				$count = count($minidata);
			}
			for ($i=0; $i<$count; $i++) {
				$item = $minidata[$i];
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
			<td><span role="button" tableindex="0" class="active" onclick="setTabPushed($('tab-help-cif'),'help-cif');"><?php echo $LNG->HELP_EMBED_TABLE_URL_INFO; ?></span></td>
		</tr>
		<tr>
			<td>langurl</td>
			<td><?php echo $LNG->HELP_EMBED_TABLE_LANGURL_USE; ?></td>
			<td><span role="button" tableindex="0" class="active" onclick="setTabPushed($('tab-help-lang'),'help-lang');"><?php echo $LNG->HELP_EMBED_TABLE_LANGURL_INFO; ?></span></td>
		</tr>
		<tr>
			<td>timeout</td>
			<td><?php echo $LNG->HELP_EMBED_TABLE_TIMEOUT_USE; ?></td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>miniwithposts</td>
			<td><?php echo $LNG->HELP_EMBED_TABLE_WITHPOSTS_USE; ?></td>
			<td>&nbsp;</td>
		</tr>
	</table>

	<div>
		<h3><?php echo $LNG->HELP_EMBED_MINI_EXAMPLE; ?></h3>
		<div id="tab-content-mini-message"></div>
		<iframe id="miniexample" src="" width="350" height="220" frameborder="0"></iframe>
	</div>

	<div>
		<h3><?php echo $LNG->HELP_EMBED_MINI_DASHBOARD; ?></h3>
		<p><?php echo $LNG->HELP_EMBED_IFRAME_MINI_DASHBOARD; ?></p>
		<div class="bg-light border border-1 mb-3">
			<pre class="mt-4 font-monospace">
 &lt;iframe src="<?php echo $CFG->homeAddress; ?>ui/minis/minidashboard.php?vis=1%2Cp3%2C6&lang=en&title=Test%20Dashboard%20of%20Mini%20Visualisations&url=https%3A%2F%2Flitemap.net%2Fapi%2Fviews%2Fb6f0374d-da86-4b13-9fc7-a16f154a5ff0&langurl=&timeout=60" width="1000" height="400" style="overflow:auto" scrolling="auto" frameborder="1"&gt;&lt;/iframe&gt; 
			</pre>
		</div>
	</div>

	<p><?php echo $LNG->HELP_EMBED_PAGE_DASHBOARD; ?></p>
	<div class="bg-light border border-1 mb-3">
        <pre class="mt-4 font-monospace">
 <?php echo $CFG->homeAddress; ?>ui/minis/minidashboard.php?vis=1%2Cp3%2C6&lang=en&title=Test%20Dashboard%20of%20Mini%20Visualisations&url=https%3A%2F%2Flitemap.net%2Fapi%2Fviews%2Fb6f0374d-da86-4b13-9fc7-a16f154a5ff0&langurl=&timeout=60 
		</pre>
	</div>

	<p><?php echo $LNG->HELP_EMBED_MINI_PARA2; ?></p>
	<table class="table table-sm table-bordered table-striped">
		<tr>
			<td><b><?php echo $LNG->HELP_EMBED_TABLE_PARAMS_HEADING1; ?></b></td>
			<td><b><?php echo $LNG->HELP_EMBED_TABLE_PARAMS_HEADING2; ?></b></td>
		</tr>
		<tr>
			<td>vis</td>
			<td><?php echo $LNG->HELP_EMBED_TABLE_MINI_VIS_USE; ?></td>
		</tr>
		<tr>
			<td>title</td>
			<td><?php echo $LNG->HELP_EMBED_TABLE_MINI_TITLE_USE; ?></td>
		</tr>
	</table>

	<div class="mt-3 pt-2">
		<h3><?php echo $LNG->HELP_EMBED_MINI_DASH_EXAMPLE; ?></h3>
		<div id="tab-content-minidash-message"></div>
		<iframe id="minidashexample" src="" height="280"  style="overflow:auto" scrolling="auto" frameborder="0" class="w-100 border border-1"></iframe>
	</div>
</div>
