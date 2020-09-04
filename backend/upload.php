<?php
include '../connect.php';

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

//Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
  if($_FILES['fileToUpload']['size'] == 0) {
    echo "<script type='text/javascript'>";
            // echo "window.location = 'product.php?type=Image'; ";
            echo "window.location = 'product.php'; ";
            echo "</script>";
    }else{
      $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
      if ($check !== false) {
        // echo "File is an image - " . $check["mime"] . ".";
        if (isset($_POST["ProductID"])) {
          $strProductID = $_POST["ProductID"];
          if ($strProductID == 0) {
            $queryResult = $connect->query("INSERT INTO product (ProductTypeID,ProductImage) VALUES (1,'" . $target_file . "')");
          $strProductID = $connect->insert_id;
          }else{
            $queryResult = $connect->query("UPDATE product SET ProductImage='" . $target_file . "' WHERE ProductID=" . $strProductID);
          }
        }
    
        if ($queryResult) {
          if (isset($_POST["type"])) {
            echo "<script type='text/javascript'>";
            echo "window.location = 'product.php'; ";
            echo "</script>";
          }else{
            echo "<script type='text/javascript'>";
            echo "window.location = 'edit.php?ProductID=$strProductID'; ";
            echo "</script>";
          }      
        $uploadOk = 1;
        } 
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
    }  
}
// else if (isset($_GET["ProductID"])) {
//   $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
//   if ($check !== false) {
//     // echo "File is an image - " . $check["mime"] . ".";
//     if (isset($_GET["ProductID"])) {
//       $strProductID = $_GET["ProductID"];
//     }
//     $queryResult = $connect->query("UPDATE product SET ProductImage='" . $target_file . "' WHERE ProductID=" . $strProductID);

//     echo "<script type='text/javascript'>";
//     echo "window.location = 'edit.php?ProductID=$strProductID'; ";
//     echo "</script>";
//     $uploadOk = 1;
//     $result = mysqli_query($connect, $queryResult);
//   } else {
//     echo "File is not an image.";
//     $uploadOk = 0;
//   }
// }

//Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

//Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

//Allow certain file formats
if (
  $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif"
) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

//Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
  //if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}


mysqli_close($connect); //ปิดการเชื่อมต่อ database 
