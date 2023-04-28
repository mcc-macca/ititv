<?php
session_start();
include('includes/config.php');
require 'vendor/autoload.php';

function mailCommenta($categoria, $name, $email, $comment){
    // set variabili SMTP

      //lettura dati da database
      $maildatacheck = $con->query("SELECT * FROM tblmail");
      $destdatacheck = $con->query("SELECT * FROM tblmaildest");
      $maildata = mysqli_fetch_assoc($maildatacheck);

      //use PHPMailer\PHPMailer\PHPMailer;
      $mail = new PHPMailer(true);
      //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
      $mail->isSMTP();
      $mail->SMTPDebug = 1;
      $mail->SMTPAutoTLS = false;
      $mail->SMTPSecure = false;
      $mail->Host = ''.$maildata['server'].'';
      $mail->SMTPAuth = true;
      $mail->Username = ''.$maildata['emailSender'].'';
      $mail->Password = ''.$maildata['emailPassword'].'';
      //$mail->SMTPSecure = 'tls';
      $mail->Port = 25;

      $mail->setFrom(''.$maildata['setFromMailName'].'', ''.$maildata['setFromName'].'');
      
      // aggiungi i destinatari
      while($destdata = mysqli_fetch_assoc($destdatacheck)){
        $mail->addAddress($destdata['email'], $destdata['name']);
      }

      $mail->Subject = 'Nuovo commento su itiTV';
      $mail->Body = "Nuovo commento su itiTV.<br>
                    Corri ad accettarlo!<br>
                    Commentato da: $name <br>
                    Email: $email <br>
                    Il: ". date("Y-m-d H:i:s") ."<br>
                    Testo: <br>
                    <code>$comment</code>
                    ";
      $mail->AltBody = "TESTO PROVA.";

      if (!$mail->send()) {
        echo "ERRORE!";
      }
}