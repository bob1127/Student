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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO stud (stud_no, stud_name, stud_id, stud_sex, stud_birthday, stud_school, stud_department, stud_phone, stud_address, stud_hits) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['stud_no'], "int"),
                       GetSQLValueString($_POST['stud_name'], "text"),
                       GetSQLValueString($_POST['stud_id'], "text"),
                       GetSQLValueString($_POST['stud_sex'], "text"),
                       GetSQLValueString($_POST['stud_birthday'], "date"),
                       GetSQLValueString($_POST['stud_school'], "text"),
                       GetSQLValueString($_POST['stud_department'], "text"),
                       GetSQLValueString($_POST['stud_phone'], "text"),
                       GetSQLValueString($_POST['stud_address'], "text"),
                       GetSQLValueString($_POST['stud_hits'], "int"));

  mysql_select_db($database_student, $student);
  $Result1 = mysql_query($insertSQL, $student) or die(mysql_error());

  $insertGoTo = "../information.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_student, $student);
$query_Recordset1 = "SELECT * FROM stud";
$Recordset1 = mysql_query($query_Recordset1, $student) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<style type="text/css">
body{ 
background-image: linear-gradient(to top, #dad4ec 0%, #dad4ec 1%, #f3e7e9 100%);

	}
.ERER {
	font-size: 14px;
	color: #333;
}
.GSE {
	color: #FFF;
}
.QEW {
	color: #666;
	font-size: 14px;
}
</style></head>

<body>
<form action="<?php echo $editFormAction; ?>" method="POST" enctype="multipart/form-data" name="form1" id="form1">
  <p><br />
    <br />
  </p>
  <p><br />
    <br />
    <br />
  </p>
 <div class="form">
  <table width="400" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <th colspan="2" bgcolor="#209DB3" class="GSE" scope="row">新增學生資訊</th>
    </tr>
    <tr>
      <th width="155" align="center" class="QEW" scope="row">學號 </th>
      <td width="239" align="center"><label for="stud_no"></label>
      <input type="text" name="stud_no" id="stud_no" /></td>
    </tr>
    <tr>
      <th align="center" class="QEW" scope="row">姓名 </th>
      <td align="center"><label for="stud_name"></label>
      <input type="text" name="stud_name" id="stud_name" /></td>
    </tr>
    <tr>
      <th align="center" class="QEW" scope="row">身分證字號 </th>
      <td align="center"><input type="text" name="stud_id" id="stud_id" /></td>
    </tr>
    <tr>
      <th align="center" class="QEW" scope="row">性別 </th>
      <td align="center"><input type="text" name="stud_sex" id="stud_sex" /></td>
    </tr>
    <tr>
      <th align="center" class="QEW" scope="row">出生日期 </th>
      <td align="center"><input name="stud_birthday" type="text" id="stud_birthday" /></td>
    </tr>
    <tr>
      <th align="center" class="QEW" scope="row">學校名稱 </th>
      <td align="center"><input type="text" name="stud_school" id="stud_school" /></td>
    </tr>
    <tr>
      <th align="center" class="QEW" scope="row">科系 </th>
      <td align="center"><input type="text" name="stud_department" id="stud_department" /></td>
    </tr>
    <tr>
      <th align="center" class="QEW" scope="row">手機 </th>
      <td align="center"><input type="text" name="stud_phone" id="stud_phone" /></td>
    </tr>
    <tr>
      <th align="center" class="QEW" scope="row">通訊地址 </th>
      <td align="center"><input type="text" name="stud_address" id="stud_address" /></td>
    </tr>
    <tr>
      <th align="center" class="QEW" scope="row">相片</th>
      <td align="center"><label for="stud_photo"></label>
      <input type="file" name="stud_photo" id="stud_photo" /></td>
    </tr>
    <tr>
      <th align="center" class="QEW" scope="row">點擊次數</th>
      <td align="center"><input type="text" name="stud_hits" id="stud_hits" /></td>
    </tr>
    <tr>
      <th colspan="2" bgcolor="#209DB3" scope="row"><input type="submit" name="button" id="button" value="送出" />
      <input type="reset" name="button2" id="button2" value="重製" /></th>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
 </div>
</form>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
