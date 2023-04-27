<?php
session_start();
include('includes/config.php');
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Genrating CSRF Token
if (empty($_SESSION['token'])) {
  $_SESSION['token'] = bin2hex(random_bytes(32));
}

if (isset($_POST['submit'])) {
  //Verifying CSRF Token
  if (!empty($_POST['csrftoken'])) {
    if (hash_equals($_SESSION['token'], $_POST['csrftoken'])) {
      $name = mysqli_real_escape_string($con, $_POST['name']);
      $email = mysqli_real_escape_string($con, $_POST['email']);
      $comment = mysqli_real_escape_string($con, $_POST['comment']);
      $postid = intval($_GET['nid']);
      $st1 = '0';
      $query = mysqli_query($con, "insert into tblcomments(postId,name,email,comment,status) values('$postid','$name','$email','$comment','$st1')");
      if ($query) {
        echo "<script>alert('Commento inviato. Sarà pubblico dopo l'approvazione di un admin ');</script>";
        unset($_SESSION['token']);
      } else {
        echo "<script>alert('Errore!');</script>";
      }

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
  }
}
$postid = intval($_GET['nid']);

$sql = "SELECT viewCounter FROM tblposts WHERE id = '$postid'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $visits = $row["viewCounter"];
    $sql = "UPDATE tblposts SET viewCounter = $visits+1 WHERE id ='$postid'";
    $con->query($sql);
  }
} else {
  echo "Nessun risultato";
}



?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Notizie itiTV">
  <meta name="author" content="Macca Computer">
  <title>News | itiTV</title>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/modern-business.css" rel="stylesheet">

</head>

<body>
  <?php include('includes/header.php'); ?>
  <div class="container">



    <div class="row" style="margin-top: 4%">
      <div class="col-md-8">
        <?php
        $pid = intval($_GET['nid']);
        $currenturl = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];;
        $query = mysqli_query($con, "select tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url,tblposts.postedBy,tblposts.lastUpdatedBy,tblposts.UpdationDate from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.id='$pid'");
        while ($row = mysqli_fetch_array($query)) {
        ?>
          <div class="card mb-4">

            <div class="card-body">
              <h2 class="card-title"><?php echo htmlentities($row['posttitle']); ?></h2>
              <a class="badge bg-secondary text-decoration-none link-light" href="category.php?catid=<?php echo htmlentities($row['cid']) ?>" style="color:#fff"><?php echo htmlentities($row['category']); ?></a>
              <a class="badge bg-secondary text-decoration-none link-light" style="color:#fff"><?php echo htmlentities($row['subcategory']); ?></a>
              <p>
                <b>Postato da </b> <?php echo htmlentities($row['postedBy']); ?> il </b><?php echo htmlentities($row['postingdate']); ?> |
                <?php if ($row['lastUpdatedBy'] != '') : ?>
                  <b>Ultimo aggiornamento da </b> <?php echo htmlentities($row['lastUpdatedBy']); ?> il </b><?php echo htmlentities($row['UpdationDate']); ?>
              </p>
            <?php endif; ?>
            <p><strong>Condividi:</strong> <a href="http://www.facebook.com/share.php?u=<?php echo $currenturl; ?>" target="_blank">Facebook</a> |
              <a href="https://twitter.com/share?url=<?php echo $currenturl; ?>" target="_blank">Twitter</a> |
              <a href="https://web.whatsapp.com/send?text=<?php echo $currenturl; ?>" target="_blank">Whatsapp</a> |
              <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $currenturl; ?>" target="_blank">Linkedin</a> <b>Visualizzazioni:</b> <?php print $visits; ?>
            </p>
            <hr />

            <img class="img-fluid rounded" src="admin/postimages/<?php echo htmlentities($row['PostImage']); ?>" alt="<?php echo htmlentities($row['posttitle']); ?>">

            <p class="card-text"><?php
                                  $pt = $row['postdetails'];
                                  echo (substr($pt, 0)); ?></p>

            </div>
            <div class="card-footer text-muted">


            </div>
          </div>
        <?php } ?>






      </div>

      <!-- Sidebar Widgets Column -->
      <?php include('includes/sidebar.php'); ?>
    </div>
    <!-- /.row -->
    <!---Comment Section --->

    <div class="row" style="margin-top: -8%">
      <div class="col-md-8">
        <div class="card my-4">
          <h5 class="card-header">Commento:</h5>
          <div class="card-body">
            <form name="Comment" method="post">
              <input type="hidden" name="csrftoken" value="<?php echo htmlentities($_SESSION['token']); ?>">
              <div class="form-group">
                <input type="text" name="name" class="form-control" placeholder="Nome" required>
              </div>

              <div class="form-group">
                <input type="email" name="email" class="form-control" placeholder="Email istituzionale" required>
              </div>


              <div class="form-group">
                <textarea class="form-control" name="comment" rows="3" placeholder="Commenta" required></textarea>
              </div>
              <button type="submit" class="btn btn-primary" name="submit">Commenta</button>
            </form>
          </div>
        </div>

        <!---Comment Display Section --->

        <?php
        $sts = 1;
        $query = mysqli_query($con, "select name,comment,postingDate from  tblcomments where postId='$pid' and status='$sts'");
        while ($row = mysqli_fetch_array($query)) {
        ?>
          <div class="media mb-4">
            <img class="d-flex mr-3 rounded-circle" src="images/usericon.png" alt="">
            <div class="media-body">
              <h5 class="mt-0"><?php echo htmlentities($row['name']); ?> <br />
                <span style="font-size:11px;"><b>il</b> <?php echo htmlentities($row['postingDate']); ?></span>
              </h5>

              <?php echo htmlentities($row['comment']); ?>
            </div>
          </div>
        <?php } ?>

      </div>
    </div>
  </div>


  <?php include('includes/footer.php'); ?>


  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>