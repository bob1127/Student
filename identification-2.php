<?php require_once('Connections/student.php'); ?>
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

$colname_Recordset1 = "-1";
if (isset($_GET['no'])) {
  $colname_Recordset1 = $_GET['no'];
}
mysql_select_db($database_student, $student);
$query_Recordset1 = sprintf("SELECT * FROM stud WHERE stud_no = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $student) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
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
}

html, body {
  height: 768px;
  width: 1024px;
}

.form {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  border: solid 1px red;
}

.table {
  width: 450px;
  height: 600px;
  border: solid 1px black;
  position: relative;
}

.title {
  width: 200px;
  height: 200px;
  border: solid 1px;
  background: linear-gradient(to left top, #316A7A 50%, white 50%);
  display: flex;
  align-items: center;
  justify-content: center;
}

.circle {
  border-radius: 50%;
  width: 180px;
  height: 180px;
  background-color: #E9EBF5;
  display: flex;
  align-items: center;
  justify-content: center;
}

.circle img {
  width: 150px;
  height: 165px;
  border-radius: 50%;
}

input {
  width: 100px;
  height: 20px;
}

.left-info {
  width: 200px;
  height: 390px;
  border: solid 1px black;
  background-color: #AAB6C4;
}

table {
  width: 180px;
  height: 300px;
  border: none;
  margin-top: 20px;
  margin-left: 8px;
}

tr, td, th {
  border: solid 1px;
  text-align: left;
}

tr.line1 {
  height: 30px;
  background-color: #316A7A;
  color: white;
}

.right-info {
  width: 248px;
  height: 590px;
  position: absolute;
  right: 0;
  top: 0;
  background-color: #E9EBF5;
}

.right-info table {
  height: 250px;
  width: 230px;
}

</style>
</head>

<body>
<form id="form1" name="form1" method="post" action="">

<div class="form">
  <div class="table">
    <div class="title">
      <div class="circle"><img src="https://www.holoface.photos/static/images/products/20190313152023K4LxaUg.jpg?auto=yes&amp;bg=666&amp;fg=444&amp;text=Second%20slide" alt=""/></div>
    </div>
    <div class="left-info">
      <table>
        <tr class="line1">
          <td style="text-align:center;" font-color:"white="font-color:"white">information</td>
        </tr>
        <tr class="line2">
          <td>學號:<?php echo $row_Recordset1['stud_no']; ?></td>
        </tr>
        <tr class="line3">
          <td>姓名:<?php echo $row_Recordset1['stud_name']; ?></td>
        </tr>
        <tr class="line4">
          <td>身分證字號:<?php echo $row_Recordset1['stud_id']; ?></td>
        </tr>
        <tr class="line4">
          <td>性別:</td>
        </tr>
        <tr class="line4">
          <td>出生日期:</td>
        </tr>
      </table>
    </div>
    <div class="right-info">
      <table class="top">
        <tr class="line1">
          <td style="text-align:center;" font-color:"white="font-color:"white">school</td>
        </tr>
        <tr class="line2">
          <td>學校:</td>
        </tr>
        <tr class="line3">
          <td>科系:</td>
        </tr>
      </table>
      <table class="bottom">
        <tr class="line1">
          <td style="text-align:center;">contact</td>
        </tr>
        <tr class="line2">
          <td>通訊地址:</td>
        </tr>
        <tr class="line3">
          <td>手機:</td>
        </tr>
      </table>
    </div>
  </div>
</div>
</form>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
