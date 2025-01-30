<?php	

	$body = "";
	$body .= "Hello<br><br>";
	$body .= "Thank you very much for your trust.<br><br>";

	// mail footer
	//
	$body .= <<<HTML
				<table cellpadding="0" cellspacing="0" width="480" style="margin-top: 3px;">
					<tbody>
						<tr>
							<td width="556" height="25" style="font-family: 'Helvetica', sans-serif;font-size:12px;line-height:14px;font-weight:400;color:#000000;margin:0px;letter-spacing: 0.4px;font-weight: normal;text-align: justify;">
								copyright & company name & logo
							</td>
						</tr>
						<tr>
							<td height="20"></td>
						</tr>
					</tbody>
				</table>

	HTML;
