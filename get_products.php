<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Methods: Content-Type');
header('Content-Type: application/json; charset=UTF8');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

include 'con.php';

$queryResult=$connect->query("SELECT p.ProductID, p.ProductName,p.ProductDetail, pt.ProductTypeName FROM product p INNER JOIN producttypes pt ON p.ProductTypeID = pt.ProductTypeID");

$result=array();

while($fetchData=$queryResult->fetch_assoc()){
	$result[]=$fetchData;
}

?>