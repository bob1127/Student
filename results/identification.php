<?php require_once('../Connections/student.php'); ?>
<?php require_once('../Connections/student.php'); ?>
<?php require_once('../Connections/student.php'); 
mysql_query("set names utf8")
?>
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
$query_Recordset1 = "SELECT * FROM stud";
$Recordset1 = mysql_query($query_Recordset1, $student) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);$colname_Recordset1 = "-1";
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
 background: linear-gradient(-180deg, #BCC5CE 0%, #929EAD 98%), radial-gradient(at top left, rgba(255,255,255,0.30) 0%, rgba(0,0,0,0.30) 100%);
 background-blend-mode: screen;
}

.form {
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;

}

.table {
  width: 450px;
  height: 600px;
  border: solid 1px black;
  position: relative;
  margin-left: 100px;
  background: linear-gradient(to left top, #316A7A 50%, white 50%);
  background-repeat: no-repeat
}

.title {
  width: 200px;
  height: 200px;
  border: solid 1px;
  
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
  width: 220px;
  height: 310px;
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
<form id="form1" action="POST">
  <div class="form">
    <div class="table">
      <div class="title">
        <div class="circle">
          <div align="center"><input style="width:200px;height:200px" name="" type="image" src="../images/<?php echo $row_Recordset1['stud_photo']; ?>" />          </div>
        </div>
      </div>
      <div class="left-info">
        <div align="center">
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
              <td>性別:<?php echo $row_Recordset1['stud_sex']; ?></td>
            </tr>
            <tr class="line4">
              <td>出生日期:<?php echo $row_Recordset1['stud_birthday']; ?></td>
            </tr>
          </table>
        </div>
      </div>
      <div class="right-info">
        <div align="center">
          <table class="top">
            <tr class="line1">
              <td style="text-align:center;" font-color:"white="font-color:"white">school</td>
            </tr>
            <tr class="line2">
              <td>學校:<?php echo $row_Recordset1['stud_school']; ?></td>
            </tr>
            <tr class="line3">
              <td>科系:<?php echo $row_Recordset1['stud_department']; ?></td>
            </tr>
          </table>
          <table class="bottom">
            <tr class="line1">
              <td style="text-align:center;">contact</td>
            </tr>
            <tr class="line2">
              <td>通訊地址:<?php echo $row_Recordset1['stud_address']; ?></td>
            </tr>
            <tr class="line3">
              <td>手機:<?php echo $row_Recordset1['stud_phone']; ?></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</form>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
