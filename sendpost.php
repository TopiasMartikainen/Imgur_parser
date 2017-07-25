<?php

	if( ! isset($argv) )die("ONLY SERVER CAN RUN!");

	function post($time, $content){

		$gmail_your_name = "XXXXX";
		$gmail_username = "XXXXX";
		$gmail_password = "XXXXX";
		$gmail_email = "XXXXX@XXXXX.XXX";
		$blogger_secret_key = "XXXXX";
		$blogger_url = "XXXXX.XXX";
		$email_title = "Imgur's best posts ".$time." GMT";

		$email_body = "".$content;

		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->isHTML(true);
		$mail->SMTPDebug=2;
		$mail->Debugoutput = 'html';
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "ssl";
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 465;
		$mail->Username = $gmail_email;
		$mail->Password = $gmail_password;

		$To = trim($gmail_username.'.'.$blogger_secret_key.'@blogger.com',"\r\n");

		$mail->setFrom($gmail_email, $gmail_your_name);
		$mail->Subject = $email_title;
		$mail->Body = $email_body;
		$mail->AddAddress($To);
		$mail->set('X-Priority', '3');

		if (!$mail->send()) {
			$fp = fopen('erros/'.$date.'.txt', 'w');
			fwrite($fp, json_encode($mail->ErrorInfo));
			fclose($fp);
				echo "Mailer Error: " . $mail->ErrorInfo;
		} else {
				echo "Message sent!";
		}
		
	}

?>
