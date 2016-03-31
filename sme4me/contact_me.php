<?php
	
$name = $_POST['name'];
$email_address = $_POST['email'];
$message = $_POST['message'];
$fund = $_POST['fund'];
$number = $_POST['number'];

echo $name;
echo $email_address;
echo $message;
echo $fund;
echo $number;
$to = 'suanumoni@gmail.com'; //Just write your email
$email_subject = "$name needs SME4ME's services. URGENT!";
$email_body = "$name details are avaiable below. Please treat as confidential. <br/>".
			  "Full Name: $name <br/><br/>".
			  "Fund Required: $fund <br/><br/> Phone Number: $number <br/><br/>".
		      "Email: $email_address <br/><br/> Describe your dream: <br/> $message";
$headers="From:<$email_address>\n";
$headers.="Content-Type:text/html; charset=UTF-8";
if($email_address != "") {
	mail($to,$email_subject,$email_body,$headers);
	return true;
}

?>