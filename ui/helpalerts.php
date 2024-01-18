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

<div class="py-3">

	<div class="mb-3">
		<p>
			<?php echo $LNG->HELP_ALERT_INTRO; ?>
				<a href="http://cci.mit.edu/klein/deliberatorium.html" target="_blank" title="http://cci.mit.edu/klein/deliberatorium.html">
				<i class="active">powered by Deliberatorium Analytics</i>
				<img src="<?php echo $HUB_FLM->getImagePath('deliberatorium-analytics-logo.png'); ?>" style="vertical-align:middle;width:30px; height:30px;" alt="" />
			</a>
		</p>
	</div>

	<p><?php echo $LNG->HELP_EMBED_ALERT_TABLE; ?></p>

	<table class="table table-sm table-bordered table-striped">
		<tr>
			<td width="20%"><b><?php echo $LNG->HELP_EMBED_TABLE_ALERT_HEADING1; ?></b></td>
			<td width="40%"><b><?php echo $LNG->HELP_EMBED_TABLE_ALERT_HEADING2; ?></b></td>
			<td width="5%"><b><?php echo $LNG->HELP_EMBED_TABLE_ALERT_HEADING3; ?></b></td>
			<td width="10%"><b><?php echo $LNG->HELP_EMBED_TABLE_ALERT_HEADING4; ?></b></td>
			<td width="25%"><b><?php echo $LNG->HELP_EMBED_TABLE_ALERT_HEADING5; ?></b></td>
		</tr>

		<?php
			include('alertdata.php');

			$count = 0;
			if (is_countable($alertdata)) {
				$count = count($alertdata);
			}
			for ($i=0; $i<$count; $i++) {
				$item = $alertdata[$i];
				if ($item[5] == 'true') {
					echo '<tr>';
					echo '<td>'.$item[0].'</td>';
					echo '<td>'.$item[2].'</td>';
					echo '<td>'.$item[1].'</td>';
					echo '<td>'.$item[3].'</td>';
					echo '<td>'.$item[6].'</td>';
					echo '</tr>';
				}
			}
		?>
	</table>

	<div class="mt-3 py-2">
		<p><?php echo $LNG->HELP_EMBED_ALERT_IFRAME; ?></p>
			
		<div class="bg-light border border-1 mb-3">
			<pre class="mt-4 px-2 font-monospace">
 &lt;iframe src="<?php echo $CFG->homeAddress; ?>ui/minis/alerts.php? userids=&lang=en&url=https%3A%2F%2Flitemap.net%2Fapi%2Fviews%2Fb6f0374d-da86-4b13-9fc7-a16f154a5ff0&userurl=&langurl=&timeout=60&alerts=24%2C25%2C15%2C16%2C19%2C7%2C8%2C9%2C14%2C17%2C18%2C20%2C23" width="500" height="300" style="overflow:auto" scrolling="auto" frameborder="0"&gt;&lt;/iframe&gt; 
			</pre>
		</div>
	</div>

	<div class="mt-3 py-2">
		<p><?php echo $LNG->HELP_EMBED_ALERT_PAGE; ?></p>
		<div class="bg-light border border-1 mb-3">
			<pre class="mt-4 px-2 font-monospace">
 <?php echo $CFG->homeAddress; ?>ui/minis/alerts.php?userids=false&lang=en&url=https%3A%2F%2Flitemap.net%2Fapi%2Fviews%2Fb6f0374d-da86-4b13-9fc7-a16f154a5ff0&userurl=&langurl=&timeout=60&alerts=24%2C25%2C15%2C16%2C19%2C7%2C8%2C9%2C14%2C17%2C18%2C20%2C23
			</pre>
		</div>
	</div>

	<p class="mt-3"><?php echo $LNG->HELP_EMBED_ALERT_PARA1; ?></p>
	<p class="mt-3"><?php echo $LNG->HELP_ALERT_PARAMS_TABLE; ?></p>
		<div class="bg-light border border-1 mb-3">
			<pre class="mt-4 px-2 font-monospace">
 <?php echo $CFG->homeAddress; ?>ui/minis/alerts.php?
			</pre>
		</div>
	</div>

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
			<td>userids</td>
			<td><?php echo $LNG->HELP_ALERT_TABLE_USERIDS_USE; ?></td>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td>alerts</td>
			<td><?php echo $LNG->HELP_ALERT_TABLE_ALERTS_USE; ?></td>
			<td>&nbsp;</td>
		</tr>
	</table>

	<div class="mt-3 py-3">
		<h3><?php echo $LNG->HELP_EMBED_ALERTS_EXAMPLE; ?></h3>
		<div id="tab-content-alerts-message"></div>
		<iframe id="alertsexample" src="" width="500" height="300" style="overflow:auto" scrolling="auto" frameborder="0"></iframe>
	</div>
</div>
