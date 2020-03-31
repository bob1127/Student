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
$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

$colname_Recordset1 = "''";
if (isset($_GET['search'])) {
  $colname_Recordset1 = $_GET['search'];
}
mysql_select_db($database_student, $student);
$query_Recordset1 = sprintf("SELECT * FROM stud WHERE stud_no = %s", GetSQLValueString($colname_Recordset1, "text"));
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
$Recordset1 = mysql_query($query_limit_Recordset1, $student) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysql_query($query_Recordset1);
  $totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<style>
  input:focus{
	  background-color: #FC9;
	  	  }
  td:hover{
	  background-color: #777;
	  cursor: pointer;
	  color: white;
	  }
  th:hover{
	  background-color: #777;
	  cursor: pointer;
	  color: white;
	  }	  
</style>
</head>

<body>
<form action="search.php" method="get" name="form1" target="main" id="form1">
  <p>
    <label for="search"></label>
    <input name="search" type="text" id="search" size="20" />
    <input type="submit" name="button" id="button" value="送出" />
  </p>
  <p>(請入搜尋的關鍵字)</p>
  <p>&nbsp;</p>
  <table width="100%" border="1" cellspacing="0" cellpadding="0">
    <tr>
      <th width="20%" align="center" valign="middle" scope="row">學號</th>
      <td width="20%" align="center" valign="middle">姓名</td>
      <td width="20%" align="center" valign="middle">科系</td>
      <td width="20%" align="center" valign="middle">地址</td>
      <td width="20%" align="center" valign="middle">照片</td>
    </tr>
    <?php do { ?>
      <tr>
        <th width="20%" align="center" valign="middle" scope="row"><?php echo $row_Recordset1['stud_no']; ?></th>
        <td width="20%" align="center" valign="middle"><?php echo $row_Recordset1['stud_name']; ?></td>
        <td width="20%" align="center" valign="middle"><?php echo $row_Recordset1['stud_department']; ?></td>
        <td width="20%" align="center" valign="middle"><?php echo $row_Recordset1['stud_address']; ?></td>
        <td width="20%" align="center" valign="middle"><img src="images/<?php echo $row_Recordset1['stud_photo']; ?>" width="50" height="50" /></td>
      </tr>
      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  </table>
  <p>&nbsp;</p>
</form>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
