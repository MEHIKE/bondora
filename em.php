<?php
include("Mail.php"); 
$email = "rynno.ruul@emt.ee";
$subject = "test subj";
$remote_id=1;
$name="mehike";
$link='<a href="http://213.168.4.222:80/shop/kinnitus.php?par='.$remote_id.'&em='.$email.'&kas='.$name.'">Kinnitamiseks vajuta siia!</a>';
 $body = "Hei,\n\n Vajuta kinnituseks lingile! \n\n ".$link;

$headers = 'From: rynno.ruul@emt.ee' . "\r\n" .
    'Reply-To: rynno.ruul@emt.ee' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'To: Mary <rynno.ruul@emt.ee>, Kelly <ruul.rynno@mail.ee>' . "\r\n";
$headers .= 'From: Birthday Reminder <rynno.ruul@emt.ee>' . "\r\n";
$headers .= 'Cc: rynno.ruul@emt.ee' . "\r\n";
$headers .= 'Bcc: ruul.rynno@mail.ee' . "\r\n";

$params = '-ODeliveryMode=d'; 
    
 if (mail($email, $subject, $body, $headers, $params)) {
   echo("<p>Message successfully sent!</p> ".$body." email=".$email." subject=".$subject." headers=".$headers);
  } else {
   echo("<p>Message delivery failed...</p> ".$body." email=".$email." subject=".$subject." headers=".$headers);
  }
  
  $to = "rynno.ruul@emt.ee";
 $subject = "Test mail";
 $message = "Hello! This is a simple email message.";
 $from = "rynno.ruul@emt.ee";
 $headers = "From:" . $from;
 mail($to,$subject,$message,$headers);
 echo "Mail Sent.";
 
 
 require_once "Mail.php";
 $from = "Sandra Sender <ruul.rynno@mail.ee>";
 $to = "Ramona Recipient <rynno.ruul@emt.ee>";
 $subject = "Hi!";
 $body = "Hi,\n\nHow are you?";
 
 $host = "mail.ee";
 $username = "ruul11";
 $password = "rynno247";
 
 $headers = array ('From' => $from,
   'To' => $to,
   'Subject' => $subject);
 $smtp = Mail::factory('smtp',
   array ('host' => $host,
     'auth' => true,
     'username' => $username,
     'password' => $password));
 
 $mail = $smtp->send($to, $headers, $body);
 
 echo $mail;
 
 // http://www.html-form-guide.com/email-form/php-script-not-sending-email.html
 
 //if (PEAR::isError($mail)) {
  // echo("<p>" . $mail->getMessage() . "</p>");
  //} else {
  // echo("<p>Message successfully sent!</p>");
  //}
 
 // $mail_object =& Mail::factory("smtp", $params); 

   // $mail_object->send($email, $headers, $body); 
  
  
?>