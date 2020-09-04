<?php 
session_start();
        if(isset($_POST['Username'])){
				//connection
                  include("connection.php");
				//รับค่า user & password
                  $Username = $_POST['Username'];
                  $Password = md5($_POST['Password']);
				//query 
                  $sql="SELECT * FROM User Where Username='".$Username."' and Password='".$Password."' ";
 
                  $result = mysqli_query($con,$sql);
				
                  if(mysqli_num_rows($result)==1){
 
                      $row = mysqli_fetch_array($result);
 
                      $_SESSION["ID"] = $row["ID"];
                      $_SESSION["name"] = $row["Firstname"]." ".$row["Lastname"];
                      $_SESSION["level"] = $row["Userlevel"];
 
                      if($_SESSION["level"]=="A"){ //ถ้าเป็น admin ให้กระโดดไปหน้า admin_page.php
 
                        Header("Location: product.php");
 
                      }
 
                      if ($_SESSION["level"]=="M"){  //ถ้าเป็น member ให้กระโดดไปหน้า user_page.php
 
                        Header("Location: user_page.php");
 
                      }
 
                  }else{
                    echo "<script>";
                        echo "alert(\" user หรือ  password ไม่ถูกต้อง\");"; 
                        echo "window.history.back()";
                    echo "</script>";
 
                  }
 
        }else{
 
 
             Header("Location: login.php"); //user & password incorrect back to login again
 
        }
?>