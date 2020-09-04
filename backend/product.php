<?php
session_start();
$ID = $_SESSION['ID'];
$name = $_SESSION['name'];
$level = $_SESSION['level'];

if ($level != 'A') {
    Header("Location: index.php");
}

error_reporting(~E_NOTICE);
ini_set('display_errors', 1);
error_reporting(~0);
include '../connect.php';

$queryResult = $connect->query("SELECT p.ProductID, p.ProductName,p.ProductDetail,p.ProductImage, pt.ProductTypeName FROM product p INNER JOIN producttypes pt ON p.ProductTypeID = pt.ProductTypeID");

$result = array();

while ($fetchData = $queryResult->fetch_assoc()) {
    $result[] = $fetchData;
}

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>


<body>
    <form action="logout.php">
        <h1>Member Page</h1>
        <h3> สวัสดี คุณ <?php echo $name; ?> สถานะ <?php echo $level; ?> </h3>
        <input type="submit" value="ออกจากระบบ">
    </form>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <table width="650" border="1">
            <tr>
                <th width="91">
                    <div align="center">ProductImage </div>
                </th>
                <th width="98">
                    <div align="center">ProductTypeName </div>
                </th>
                <th width="198">
                    <div align="center">ProductName </div>
                </th>
                <th width="50">
                    <div align="center">ProductDetail </div>
                </th>
                <th>
                    <button align="center"><a href="edit.php?ProductID=0">New</a></td>
                </th>
            </tr>
            <?php
            foreach ($result as $pd) {
            ?>
                <tr>
                    <td>
                        <form action="upload.php" name="frmAdd" method="post" enctype="multipart/form-data">
                            <input type="hidden" class="form-control" name="ProductID" value="<?php echo $pd["ProductID"]; ?>">
                            <input type="hidden" class="form-control" name="type" value="product">
                            <img src="<?php echo $pd["ProductImage"]; ?>" style="width: 50%;">
                            <input type="file" name="fileToUpload" id="fileToUpload">
                            <input id="Upload" type="submit" value="Upload Image" name="submit">
                        </form>
                    </td>
                    <td>
                        <div align="center"><?php echo $pd["ProductTypeName"]; ?></div>
                    </td>
                    <td><?php echo $pd["ProductName"]; ?></td>
                    <td><?php echo $pd["ProductDetail"]; ?></td>
                    <td align="center"><a href="edit.php?ProductID=<?php echo $pd["ProductID"]; ?>">Edit</a></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </form>
</body>

</html>