<?php	

	$body = "";

	$body .= "Guten Tag,<br><br>";

	$body .= "vielen Dank für Ihr Vertrauen und Interesse an unserem Unternehmenswertrechner.<br><br>";
	
	$body .= "Bitte beachten Sie folgenden Hinweis:<br><br>";
	
	$body .= "Der Unternehmenswert ist nicht mit dem Wert des Eigenkapitals und somit dem anteiligen Verkaufspreis gleichzusetzen!<br>";
	$body .= "Um den Wert des Eigenkapitals zu ermitteln, muss zuvor eine Equity-Bridge durchgeführt werden.<br>";
	$body .= "Wenn Sie mehr über dieses Verfahren erfahren möchten, haben wir Ihnen unser ausführliches Whitepaper „Berechnung der Equity Bridge“ dieser E-Mail beigefügt.<br><br>";
	
	$body .= "<b>Der Wert Ihres Unternehmens beträgt, unter Berücksichtigung der obigen Hinweise,  ".$params['wert']." €. <br><br></b>";
	
	$body .= "Wenn Sie Ihren Unternehmenswert detailliert, marktgerecht und unter Berücksichtigung der Equity-Bridge ermitteln möchten, <br>";
	$body .= "erstellen unsere Experten Ihnen <b>eine ausführliche Bewertung zum Begrüßungspreis von nur 1.950 €.<br><br></b>";
	
	$body .= "Nehmen Sie unverbindlich und diskret Kontakt mit uns auf. <br><br><br>";


	// mail footer
	//
$body .= <<<HTML
			<table cellpadding="0" cellspacing="0" width="480" style="margin-top: 3px;">
				<tbody>
					<tr>
						<td width="556" height="25" style="font-family: 'Helvetica', sans-serif;font-size:12px;line-height:14px;font-weight:400;color:#000000;margin:0px;letter-spacing: 0.4px;font-weight: normal;text-align: justify;">
							Mit freundlichem Gruß
						</td>
					</tr>
					<tr>
						<td height="20"></td>
					</tr>
				</tbody>
			</table>
			<table cellpadding="0" cellspacing="0" width="480">
				<tr>
					<td style="">
						<p style="font-family: 'Helvetica', sans-serif;font-size:14px;line-height:20px;margin:0px;color: #6e7b86;font-weight: normal;">
							<span style="font-family: 'Helvetica', sans-serif;font-size:19px;line-height:20px;margin:0px;color: #393333;font-weight: bold;">
								Thomas Salzmann
							</span><br>Geschäftsführung<br>
							<img src="https://i.postimg.cc/7Pm98t3J/Untitled-2.png">
						</p>
						<img src="https://everto-consulting.de/wp-content/uploads/2017/06/170305_Logo_Everto_Consulting_mit-Rahmen-01.png">
					</td>
				</tr>
				<tr>
					<td height="20"></td>
				</tr>
				<tr>
					<td style="">
						<table cellpadding="0" cellspacing="0">
							<tr>
								<td width="40" align="left">
									<img src="https://i.postimg.cc/8zD0BXVy/m.png">
								</td>
								<td align="left" style="font-family: 'Helvetica', sans-serif;font-size:14px;">
									Telefon: <a href="tel:+49 (0) 40 55 55 73 364" target="new"
										style="text-decoration:none;color:#393333"> +49 (0) 40 55 55 73 364</a> <br>

									Mobile:
									<a href="tel:+49 (0) 171 816 59 22" target="new" style="text-decoration:none;color:#393333"> +49
										(0) 171 816 59 22</a>
								</td>
							</tr>
							<tr>
								<td height="10"></td>
							</tr>
							<tr>
								<td width="40" align="left">
									<img src="https://i.postimg.cc/HxfSJB29/rr.png">
								</td>

								<td align="left" style="font-family: 'Helvetica', sans-serif;font-size:14px;">
									<a href="mailto:t.salzmann@everto-consulting.de" target="new"
										style="text-decoration:none;color:#393333"> t.salzmann@everto-consulting.de</a>
								</td>
							</tr>

							<tr>
								<td height="10"></td>
							</tr>
							<tr>
								<td width="40" align="left">
									<img src="https://i.postimg.cc/MZC4XK3J/lo.png">
								</td>

								<td align="left"
									style="font-family: 'Helvetica', sans-serif;font-size:14px;line-height:20px;margin:0px;color: #393333;font-weight: normal;">
									Baumwall 7 20459 Hamburg
								</td>
							</tr>

						</table>
					</td>

				</tr>


				<tr>
					<td height="20"></td>
				</tr>
				<tr>
					<td style="">
						<p style="font-family: 'Helvetica', sans-serif;font-size:13px;line-height:20px;margin:0px;color: #6e7b86">
							Geschäftsführung: Thomas Salzmann<br>
							Sitz der Gesellschaft: Hamburg<br>
							Amtsgericht HH: HRB102037
						</p>
					</td>
				</tr>
				<tr>
					<td height="20"></td>
				</tr>
			</table>
			<table cellpadding="0" cellspacing="0" width="570" style="margin-top: 3px;">
				<tbody>
					<tr>
						<td width="556"
							style="font-family: 'Helvetica', sans-serif;font-size:13px;line-height:16px;font-weight:400;color:#6e7b86;margin:0px;letter-spacing: 0.4px;font-weight: normal;text-align: justify;">

							Der Inhalt dieser E-Mail ist streng vertraulich und ausschließlich für die bezeichnete Person oder
							Einrichtung bestimmt.
							Falls Sie nicht der bezeichnete Adressat sind oder die E-Mail irrtümlicherweise erhalten haben sollten,
							verständigen Sie
							uns bitte unverzüglich telefonisch unter +49 (0) 40 55 55 73 364 und löschen diese E-Mail. Beachten Sie
							bitte, dass die
							Erstellung von Kopien, die Weitergabe oder sonstige Veranlassungen aufgrund dieser E-Mail unzulässig
							sind.
						</td>
					</tr>
					<tr>
						<td height="20"></td>
					</tr>
				</tbody>
			</table>
			<table cellpadding="0" cellspacing="0" width="480" style="margin-top: 3px;">
				<tbody>
					<tr>

						<td style="font-family: 'Helvetica', sans-serif;font-size:10px;line-height:14px;font-weight:400;color:#6e7b86;margin:0px;letter-spacing: 0.4px;font-weight: normal;text-align: justify;">
							<a href="https://www.provenexpert.com/everto-consulting/" data-elementor-open-lightbox="">
								<img width="136" height="127" src="https://everto-consulting.de/wp-content/uploads/2019/10/image001.png" class="attachment-large size-large" alt=""></a>
						</td>
						<td style="font-family: 'Helvetica', sans-serif;font-size:10px;line-height:14px;font-weight:400;color:#6e7b86;margin:0px;letter-spacing: 0.4px;font-weight: normal;text-align: justify;padding-left: 10px">
							<a href="https://unternehmen.handelsblatt.com/unternehmensverkauf-berater.html"
								data-elementor-open-lightbox="">
								<img width="180" height="" src="https://everto-consulting.de/wp-content/uploads/2019/03/8-formatOriginal.png" alt=""> </a>
						</td>

						<td style="font-family: 'Helvetica', sans-serif;font-size:10px;line-height:14px;font-weight:400;color:#6e7b86;margin:0px;letter-spacing: 0.4px;font-weight: normal;text-align: justify;padding-left: 10px">
							<a href="https://www.youtube.com/channel/UCDyIwaCbTp_wa-q08-pSbkQ" data-elementor-open-lightbox="">
								<img width="40" height="40" src="https://everto-consulting.de/wp-content/uploads/2019/10/image002.png" alt=""></a>
						</td>
					</tr>
				</tbody>
			</table>
HTML;
