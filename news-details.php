<?php
session_start();
include('includes/config.php');
require 'lib/function.php';
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
  <title>Visualizza notizia | itiTV</title>
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
        $currenturl = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];;
        $query = mysqli_query($con, "select tblposts.PostTitle as posttitle,tblposts.PostImage,tblcategory.CategoryName as category,tblcategory.id as cid,tblsubcategory.Subcategory as subcategory,tblposts.PostDetails as postdetails,tblposts.PostingDate as postingdate,tblposts.PostUrl as url,tblposts.postedBy,tblposts.lastUpdatedBy,tblposts.UpdationDate from tblposts left join tblcategory on tblcategory.id=tblposts.CategoryId left join  tblsubcategory on  tblsubcategory.SubCategoryId=tblposts.SubCategoryId where tblposts.id='$pid'");
        while ($row = mysqli_fetch_array($query)) {
        ?>
          <div class="card mb-4 bg-dark text-white">

            <div class="card-body">
              <h2 class="card-title"><?php echo htmlentities($row['posttitle']); ?></h2>
              <a class="badge bg-secondary text-decoration-none link-light" href="category.php?catid=<?php echo htmlentities($row['cid']) ?>" style="color:#fff"><?php echo htmlentities($row['category']); ?></a>
              <a class="badge bg-secondary text-decoration-none link-light" style="color:#fff"><?php echo htmlentities($row['subcategory']); ?></a>
              <p>
                <b>Postato da </b> <?php echo htmlentities($row['postedBy']); ?><b> il </b><?php echo htmlentities($row['postingdate']); ?><br>
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

            <p class="card-text text-white"><?php
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
        <div class="card my-4 bg-dark text-white">
          <h5 class="card-header">Commento:</h5>
          <div class="card-body">
            <form name="Comment" method="post">
              <input type="hidden" name="csrftoken" value="<?php echo htmlentities($_SESSION['token']); ?>">
              <div class="form-group">
                <input type="text" name="name" class="form-control bg-dark text-white" placeholder="Nome" required>
              </div>

              <div class="form-group">
                <input type="email" name="email" class="form-control bg-dark text-white" placeholder="Email istituzionale" required>
              </div>


              <div class="form-group">
                <textarea class="form-control bg-dark text-white" name="comment" rows="3" placeholder="Commenta" required></textarea>
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
            <div class="media-body text-white">
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