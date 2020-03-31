<?php
//啟動 Session
if (!isset($_SESSION)) {
  session_start();
}
//若表單送出時即先檢查驗證碼
if(isset($_POST['security_code'])){
	if(($_SESSION['security_code'] != $_POST['security_code'])||(empty($_SESSION['security_code']))){
		header("Location: ../information.php?auth=false");
		break;
	}
}
?>
<?php require_once('../Connections/student.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_student, $student);
$query_Recordset1 = "SELECT * FROM studadmin";
$Recordset1 = mysql_query($query_Recordset1, $student) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['username'])) {
  $loginUsername=$_POST['username'];
  $password=$_POST['password'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "../admin.php";
  $MM_redirectLoginFailed = "../information.php";
  $MM_redirecttoReferrer = true;
  mysql_select_db($database_student, $student);
  
  $LoginRS__query=sprintf("SELECT username, password FROM studadmin WHERE username=%s AND password=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $student) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && true) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<style>
  @charset "UTF-8";
* {
  font-family: 微軟正黑體;
  font-weight: 700;
  letter-spacing: 1px;
  color: white;
  
}

html, body {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
background-image: linear-gradient(to top, #9890e3 0%, #b1f4cf 100%);
}

.form {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
 
}

.login {
  position: relative;
  width: 350px;
  height: 470px;
  background-image: url(https://images.pexels.com/photos/323705/pexels-photo-323705.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940);
  background-size: cover;
  background-position: center center;
  background-repeat: no-repeat;
  opacity: 0.5;
  z-index: 999;
  border-radius:20px
}

.login2 {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  background: rgba(8, 25, 45, 0.7);
  width: 350px;
  height: 470px;
  z-index: -1;
}

input {
  border-radius: 10px;
  margin-bottom: 10px;
  background-color: rgba(189, 192, 186, 0.2);
  color: white;
  font-weight: 900;
}

.input-group {
  width: 200px;
  position: absolute;
  transform: translate(12%, 15%);
}

h1 {
  width: 100px;
  height: 50px;
  margin: 0px auto;
  text-align: center;
  margin-bottom: 30px;
}

.checkbox {
  margin-left: 15px;
  margin-top: 8px;
  margin-right: 10px;
}

button {
  width: 150px;
  margin-left: 70px;
  margin-top: 30px;
  border-radius: 15px;
  color: white;
  background-color: lightblue;
  background-color: #113285;
}

hr {
  width: 100px;
  size: 4;
  border: 3px solid black;
  line-height: 5px;
}
.top{
	margin-bottom:-50px;
	}

</style>
<script language="javascript" type="text/javascript">
//更換驗證碼圖片
function RefreshImage(valImageId) {
	var objImage = document.images[valImageId];
	if (objImage == undefined) {
		return;
	}
	var now = new Date();
	objImage.src = objImage.src.split('?')[0] + '?width=100&height=40&characters=5&s=' + new Date().getTime();
}
</script>
</head>
  
<body>
 <form id="form1" name="form1" method="POST" action="<?php echo $loginFormAction; ?>"> 
  <div class="form">
  <div class="login">
    <h1>user</h1>
      
    <hr/>
    <p class="top">帳號:admin1<br/>
      密碼:123456
      </p>
    <div class="input-group">
      <p>Name</p>
      <input name="username" type="text" id="username" placeholder="請輸入帳號" size="35"/>
      <p>Password</p>
      <p>
        <input name="password" type="password" id="password" placeholder="請輸入密碼" size="35"/>
        </p>
      <p><img src="CaptchaSecurityImages.php?width=100&amp;height=40&amp;characters=5" name="imgCaptcha" id="imgCaptcha" /><a href="javascript:void(0)" onclick="RefreshImage('imgCaptcha')" style="font-size:9pt">更換圖片<br />
      </a>
        <input name="security_code" type="text" id="security_code" value="請輸入上方驗證碼" maxlength="10" onfocus="this.value=''" />
      </p>
    
      <P>
        <input type="submit" name="button" id="button" value="送出" />
</P>
      <button type="button">Log In</button>
    </div>
    <div class="login2"> </div>
  </div>
</div>
</form>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
