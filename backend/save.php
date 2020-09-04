<?php
include '../connect.php';

if (isset($_POST["ProductID"])) {
  $strProductID = $_POST["ProductID"];
  $strName = $_POST["ProductName"];
  $strDetail = $_POST["ProductDetail"];
  $strProducttype = $_POST["ProductTypeID"];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if ($strProductID == 0) {
    echo $strProducttype;
    $queryResult = $connect->query("INSERT INTO product (ProductTypeID,ProductName,ProductDetail) VALUES ('" . $strProducttype . "','" . $strName . "','" . $strDetail . "')");
    $last_id = $connect->insert_id;
  } else {
    $queryResult = $connect->query("UPDATE product SET ProductName='" . $strName . "', ProductDetail='" . $strDetail . "', ProductTypeID ='" . $strProducttype . "'
    WHERE ProductID=" . $strProductID);
    $last_id = $strProductID;
  }
}
if ($queryResult) {
  echo "<script type='text/javascript'>";
  echo "window.location = 'edit.php?ProductID=$last_id'; ";
  echo "</script>";
} else {
  echo "<script type='text/javascript'>";
    echo "</script>";
  echo "บันทึกไม่สำเร็จ";  
}
// if(mysqli_query($connect, $queryResult)){
//   echo "Records inserted successfully.";
//   echo "<script type='text/javascript'>";
//   echo "window.location = 'product.php'; ";
//   echo "</script>";
// } else{
//   echo "ERROR: Could not able to execute $queryResult. " . mysqli_error($connect);
// }?>

<?php 
mysqli_close($connect); //ปิดการเชื่อมต่อ database 
?>
