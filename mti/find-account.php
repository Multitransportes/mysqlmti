<?php
$usermail = $_POST['email'];
$nomcont = $_POST['nomcont'];
$Telefono = $_POST['Telefono'];
$asunto = $_POST['asunto'];

if (!empty($nomcont)) {
	$myusername = $nomcont;
	
    require_once('database/Database.php');
    $db = new Database();
    $sql = "SELECT * FROM ctasgmail WHERE ctasgmail_NOMBRE = 'tracking' AND ctasgmail_OFICINA = 1";
    $result = $db->getRow($sql);
    foreach($result as $x):
        $correo = $result['ctasgmail_CORREO'];
        $passwordp = $result['ctasgmail_PASSWORDP'];
        $cnt++;
    endforeach;
    if($cnt>0) {

    	require 'mail/PHPMailerAutoload.php';
      
        $messagetosent = "Buenos Dias a Tod@s</b>Por este medio les informo que el día de hoy nos esta contactando $myusername <b>$usermail</b>Telefono: $Telefono, asunto $asunto";

        // if (empty($correo)){
        //     $correo = "tracking@mtinter.com.mx";
        //     $passwordp = 'CJGjNzAN';            
        // }

        $mail = new PHPMailer;
        $mail->isSMTP();                              
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;                          
        //$mail->Username = "tracking@mtinter.com.mx";
        //$mail->Password = 'CJGjNzAN'; 
        $mail->Username = $correo;             
        $mail->Password = $passwordp; 
        $mail->SMTPSecure = 'tls';                           
        $mail->Port = 587;                                   

        //a quien se le va a enviar el correo con la informacion del contacto.
        $envmail = "nhernandez@mtinter.com.mx";
        $envnomb = "Nestor hernandez arenas";
        //$mail->setFrom('shopmanagerv2.0@gmail.com', 'Bwire Charles Mashauri');
        //$mail->addAddress("nhernandez@mtinter.com.mx", "Nestor hernandez arenas");     
        $mail->addAddress($envmail, $envnomb);     
        //$mail->addReplyTo('bwiremashauri5@gmail.com', 'Reply');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        $mail->isHTML(true);

        $mail->Subject = 'Contacto';
        $mail->Body    = $messagetosent;
        $mail->AltBody = 'you need HTML mail to view this content';

        if(!$mail->send()) {
           header("location:../?err=Could not send email 0");
        } else {
            header("location:../?in=Open $usermail for more information");
        }
    }
    $db->close();
}else{
	// include '../config/db_config.php';

 //    $sql = "SELECT * FROM users WHERE email = '$usermail'";
 //    $result = $conn->query($sql);

 //    if ($result->num_rows > 0) {
  
 //        while($row = $result->fetch_assoc()) {

 //            $myusername = $row['user_id'];
 //        	$mypassword = base64_decode($row['password']);
 //            $usermail = $row['email'];
 //        	$user_fullname = $row['fullname'];
        	
 //        	require 'mail/PHPMailerAutoload.php';
          
 //            $messagetosent = "Your username is <b>$myusername</b> and password is <b>$mypassword</b><br>Enjoy Shop Manager System<br>Bwire Charles Mashauri and Azizi Selemani Daudy<br>";

 //            $mail = new PHPMailer;
 //            $mail->isSMTP();                              
 //            $mail->Host = 'smtp.gmail.com';
 //            $mail->SMTPAuth = true;                          
 //            $mail->Username = 'shopmanagerv2.0@gmail.com';             
 //            $mail->Password = 'F1#0BkHr!mS0~9P';                       
 //            $mail->SMTPSecure = 'tls';                           
 //            $mail->Port = 587;                                   

 //            $mail->setFrom('shopmanagerv2.0@gmail.com', 'Bwire Charles Mashauri');
 //            $mail->addAddress($usermail, $user_fullname);     
 //            $mail->addReplyTo('bwiremashauri5@gmail.com', 'Reply');
 //            $mail->addCC('cc@example.com');
 //            $mail->addBCC('bcc@example.com');

 //            $mail->isHTML(true);                                 

 //            $mail->Subject = 'Password Recover';
 //            $mail->Body    = $messagetosent;
 //            $mail->AltBody = 'you need HTML mail to view this content';

 //            if(!$mail->send()) {
 //               header("location:../?err=Could not send email 1");
 //            } else {
 //                header("location:../?in=Open $usermail for more information");
 //            }
 //        }
 //    } else {
 //        header("location:../reset-password.php?err=Account with email $usermail was not found in database");
 //    }
 //    $conn->close();	
}


?>