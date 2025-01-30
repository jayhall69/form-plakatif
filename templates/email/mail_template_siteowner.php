<?php	

	$body = "";
    $body .= "<br>Name: " . $params['formdata']['username'];
    $body .= "<br>Email: " . $params['formdata']['email'];
    $body .= "<br>Phone: " . $params['formdata']['phone'];
    $body .= "<br>Goal: " . $params['formdata']['goal'];
    $body .= "<br>Project type: " . $params['formdata']['projecttype'];
    $body .= "<br>Budget: " . $params['formdata']['budget'];

?>