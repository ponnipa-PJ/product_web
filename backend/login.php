<?php session_start();?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Form Login</title>
<meta http-equiv="X-UA-Compatible">
</head>
<body>
<div class="container">
      <form name="frmlogin"  method="post" action="checklogin.php">
        <p> </p>
        <p><b> Login Form </b></p>
        <p> ชื่อผู้ใช้ :
          <input type="text"   id="Username" required name="Username" placeholder="Username">
        </p>
        <p>รหัสผ่าน :
          <input type="password"   id="Password"required name="Password" placeholder="Password">
        </p>
        <p>
          <button type="submit">Login</button>
          &nbsp;&nbsp;
          <button type="reset">Reset</button>
          <br>
        </p>
      </form>
      </div>
</body>
</html>