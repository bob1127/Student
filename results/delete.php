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

$colname_Recordset1 = "-1";
if (isset($_GET['stud_no'])) {
  $colname_Recordset1 = $_GET['stud_no'];
}
mysql_select_db($database_student, $student);
$query_Recordset1 = sprintf("SELECT * FROM stud WHERE stud_no = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $student) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>無標題文件</title>
<style type="text/css">
.GSE {	color: #FFF;
}
.QEW {	color: #666;
	font-size: 14px;
}
.ＷＥＱ {
	color: #FFF;
}
</style>
</head>

<body>
<form name="form1" method="post" action="">
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <table width="400" border="1" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <th colspan="2" bgcolor="#FF7B89" class="GSE" scope="row">刪除學生資訊</th>
    </tr>
    <tr>
      <th width="155" align="center" class="QEW" scope="row">學號 </th>
      <td width="239" align="center"><label for="stud_no"></label>
        <input name="stud_no" type="text" id="stud_no" value="<?php echo $row_Recordset1['stud_no']; ?>" /></td>
    </tr>
    <tr>
      <th align="center" class="QEW" scope="row">姓名 </th>
      <td align="center"><label for="stud_name"></label>
        <input name="stud_name" type="text" id="stud_name" value="<?php echo $row_Recordset1['stud_name']; ?>" /></td>
    </tr>
    <tr>
      <th align="center" class="QEW" scope="row">身分證字號 </th>
      <td align="center"><input name="stud_id" type="text" id="stud_id" value="<?php echo $row_Recordset1['stud_id']; ?>" /></td>
    </tr>
    <tr>
      <th align="center" class="QEW" scope="row">性別 </th>
      <td align="center"><input name="stud_sex" type="text" id="stud_sex" value="<?php echo $row_Recordset1['stud_sex']; ?>" /></td>
    </tr>
    <tr>
      <th align="center" class="QEW" scope="row">出生日期 </th>
      <td align="center"><input name="stud_birthday" type="text" id="stud_birthday" value="<?php echo $row_Recordset1['stud_birthday']; ?>" /></td>
    </tr>
    <tr>
      <th align="center" class="QEW" scope="row">學校名稱 </th>
      <td align="center"><input name="stud_school" type="text" id="stud_school" value="<?php echo $row_Recordset1['stud_school']; ?>" /></td>
    </tr>
    <tr>
      <th align="center" class="QEW" scope="row">科系 </th>
      <td align="center"><input name="stud_department" type="text" id="stud_department" value="<?php echo $row_Recordset1['stud_department']; ?>" /></td>
    </tr>
    <tr>
      <th align="center" class="QEW" scope="row">手機 </th>
      <td align="center"><input name="stud_phone" type="text" id="stud_phone" value="<?php echo $row_Recordset1['stud_phone']; ?>" /></td>
    </tr>
    <tr>
      <th align="center" class="QEW" scope="row">通訊地址 </th>
      <td align="center"><input name="stud_address" type="text" id="stud_address" value="<?php echo $row_Recordset1['stud_address']; ?>" /></td>
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
      <th colspan="2" bgcolor="#FF7B89" scope="row"><span class="ＷＥＱ">是否確定刪除     </span>　　
<input type="submit" name="button" id="button" value="確認" />
      　
      <input name="button2" type="reset" id="button2" value="回主畫面" /></th>
    </tr>
  </table>
</form>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
