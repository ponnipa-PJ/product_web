<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>ThaiCreate.Com PHP & MySQL (mysqli)</title>
</head>

<body>
    <?php
    include '../connect.php';
    ini_set('display_errors', 1);
    error_reporting(~0);
    $strProductID = null;

    if (isset($_GET["ProductID"])) {
        $strProductID = $_GET["ProductID"];
    }
    // $serverName = "localhost";
    // $userName = "root";
    // $userPassword = "";
    // $dbName = "aqua_sites_pd";

    $queryResult = $connect->query("SELECT p.ProductID, p.ProductName,p.ProductDetail,p.ProductImage,p.ProductTypeID, pt.ProductTypeName FROM product p INNER JOIN producttypes pt ON p.ProductTypeID = pt.ProductTypeID where p.ProductID = $strProductID");

    $result = $queryResult->fetch_array(MYSQLI_ASSOC);

    // $conn = mysqli_connect($serverName, $userName, $userPassword, $dbName);

    // $sql = "SELECT p.ProductID, p.ProductName,p.ProductDetail,p.ProductImage,p.ProductTypeID, pt.ProductTypeName FROM product p INNER JOIN producttypes pt ON p.ProductTypeID = pt.ProductTypeID where p.ProductID = $strProductID";

    // $query = mysqli_query($conn, $sql);

    // $result = mysqli_fetch_array($query, MYSQLI_ASSOC);

    $queryResultProductType = $connect->query("SELECT * FROM producttypes where Valid = true");
    $ProductTypeData = array();

    while ($fetchProductTypeData = $queryResultProductType->fetch_assoc()) {
        $ProductTypeData[] = $fetchProductTypeData;
    }
    ?>
    <div class="container">
        <form action="save.php" name="frmAdd" method="post">
            <div class="form-group">
                <input type="hidden" class="form-control" name="ProductID" value="<?php echo $result["ProductID"]; ?>" placeholder="กรอกชื่อสินค้า">
            </div>
            <select id="ProductTypeID" name="ProductTypeID" class="form-control">
                <option value="1" name="1">--- เลือก ---</option>
                <?php
                foreach ($ProductTypeData as $pro) {
                ?>
                    <option value="<?php echo $pro["ProductTypeID"]; ?>" <?php if ($pro["ProductTypeID"] == $result["ProductTypeID"]) {
                                                                                echo "selected";
                                                                            }  ?> name="<?php echo $pro["ProductTypeID"]; ?>"><?php echo $pro["ProductTypeName"] ?></option>
                <?php
                }
                ?>
            </select>
            <div class="form-group">
                <label for="exampleInputEmail1">ชื่อสินค้า</label>
                <input type="text" class="form-control" name="ProductName" value="<?php echo $result["ProductName"]; ?>" placeholder="กรอกชื่อสินค้า">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">รายละเอียดสินค้า</label>
                <input type="text" class="form-control" name="ProductDetail" value="<?php echo $result["ProductDetail"]; ?>" placeholder="กรอกรายละเอียดสินค้า">
            </div>
            <!-- <a href="product.php"></a>Back -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <div class="form-group" id="myDIV">
            <form action="upload.php" name="frmAdd" method="post" enctype="multipart/form-data">
                <input type="hidden" class="form-control" name="ProductID" value="<?php echo $result["ProductID"]; ?>">
                <img id="Image" src="<?php echo $result["ProductImage"]; ?>" style="width: 50%;">
                <img id="noImage" style="width: 50%;">
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Upload Image" name="submit">
            </form>
        </div>
    </div>

    <!-- <form action="upload.php" name="frmAdd" method="post" enctype="multipart/form-data"> -->

    <?php
    mysqli_close($connect);
    ?>
</body>

</html>

<!-- <script>
    var id = "<?php echo $strProductID ?>";
    if (id == 0) {
        var x = document.getElementById("myDIV");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script> -->

<script>
    var ProductID = "<?php echo $strProductID ?>";
    var ProductImage = "<?php echo $result["ProductImage"] ?>";
    var Image = document.getElementById("Image");
    var noImage = document.getElementById("noImage");
    if (ProductImage == null || ProductID == 0) {
        Image.style.display = "none";
        noImage.style.display = "block";
    } else {
        noImage.style.display = "none";
        Image.style.display = "block";
    }
</script>