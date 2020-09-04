<?php
error_reporting(~E_NOTICE);
// error_reporting(~0);
include 'connect.php';
?>
<!doctype html>
<html lang="en">

<head>
  <title>Backend</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

  <title>Hello, world!</title>
</head>

<body>
  <div class="container">
    <h1>Hello, world!</h1>
    <?php include 'menu.php'; ?>
    <div class="row">
      <?php
      $queryResult = $connect->query("SELECT p.ProductID, p.ProductName,p.ProductDetail,p.ProductImage, pt.ProductTypeName FROM product p INNER JOIN producttypes pt ON p.ProductTypeID = pt.ProductTypeID WHERE p.ProductName LIKE'%$my_header%'");

      $result = array();

      while ($fetchData = $queryResult->fetch_assoc()) {
        $result[] = $fetchData;
      }
      foreach ($result as $pd) {
      ?>
        <div class="col-md-4">
          <div class="card" style="width: 18rem;">
            <h4 class="card-title"><?php echo $pd['ProductTypeName']; ?></h4>
            <img src="<?php echo $pd['ProductImage']; ?>" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title"><?php echo $pd['ProductID']; ?></h5>
              <p class="card-text"><?php echo $pd['ProductName']; ?></p>
              <p><?php echo $pd['ProductDetail']; ?></p>
              <a href="#" class="btn btn-primary">รายละเอียด</a>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>