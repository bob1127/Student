<?php require_once('Connections/student.php'); ?>
<?php require_once('Connections/student.php'); 
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

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysql_select_db($database_student, $student);
$query_Recordset1 = "SELECT * FROM stud ORDER BY stud_no ASC";
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

$queryString_Recordset1 = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_Recordset1") == false && 
        stristr($param, "totalRows_Recordset1") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<style type="text/css">
.title-1 {
	color: #FFF;
	background-color: #000;
}
.ERER {
	background-color: #FFC;
	font-size: 12px;
}
#form1 table tr .title-1 {
	font-size: 12px;
}

.QEEQEW {
	font-size: 24px;
	color: #FFF;
}
</style></head>

<body>
<form id="form1" name="form1" method="post" action="">
  <div align="center">
    <table class="form" width="1000" border="1" cellpadding="0" cellspacing="0" bgcolor="#CCCCCC">
      <tr>
        <th colspan="11" align="center" class="QEEQEW" scope="row">學員管理系統</th>
      </tr>
      <tr>
        <th width="7%" align="center" class="title-1" scope="row">學號 </th>
        <td width="7%" align="center" class="title-1">姓名 </td>
        <td width="7%" align="center" class="title-1">身分證字號 </td>
        <td width="7%" align="center" class="title-1">性別 </td>
        <td width="7%" align="center" class="title-1">出生日期 </td>
        <td width="7%" align="center" class="title-1">學校名稱 </td>
        <td width="7%" align="center" class="title-1">科系 </td>
        <td width="7%" align="center" class="title-1">手機 </td>
        <td width="7%" align="center" class="title-1">通訊地址 </td>
        <td width="7%" align="center" class="title-1">照片</td>
        <td width="7%" align="center" class="title-1">點擊次數</td>
      </tr>
      <?php do { ?>
        <tr class="ERER">
          <th width="7%" align="center" scope="row"><?php echo $row_Recordset1['stud_no']; ?></th>
          <td width="7%" align="center"><a href="results/identification.php?no=<?php echo $row_Recordset1['stud_no']; ?>" target="main"><?php echo $row_Recordset1['stud_name']; ?></a></td>
          <td width="7%" align="center"><?php echo $row_Recordset1['stud_id']; ?></td>
          <td width="7%" align="center"><?php echo $row_Recordset1['stud_sex']; ?></td>
          <td width="7%" align="center"><?php echo $row_Recordset1['stud_birthday']; ?></td>
          <td width="7%" align="center"><?php echo $row_Recordset1['stud_school']; ?></td>
          <td width="7%" align="center"><?php echo $row_Recordset1['stud_department']; ?></td>
          <td width="7%" align="center"><?php echo $row_Recordset1['stud_phone']; ?></td>
          <td width="7%" align="center"><?php echo $row_Recordset1['stud_address']; ?></td>
          <td width="7%" align="center"><?php echo $row_Recordset1['stud_photo']; ?></td>
          <td width="7%" align="center"><?php echo $row_Recordset1['stud_hits']; ?></td>
        </tr>
        <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
    </table>
    <table width="1000" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th width="726" align="left" scope="row">&nbsp;
        記錄 <?php echo ($startRow_Recordset1 + 1) ?> 到 <?php echo min($startRow_Recordset1 + $maxRows_Recordset1, $totalRows_Recordset1) ?> 共 <?php echo $totalRows_Recordset1 ?> </th>
        <td width="298" align="right">&nbsp;
          <table border="0">
            <tr>
              <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">第一頁</a>
                <?php } // Show if not first page ?></td>
              <td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
                <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">上一頁</a>
                <?php } // Show if not first page ?></td>
              <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">下一頁</a>
                <?php } // Show if not last page ?></td>
              <td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
                <a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">最後一頁</a>
                <?php } // Show if not last page ?></td>
            </tr>
        </table></td>
      </tr>
    </table>
  </div>
  <p align="center">&nbsp;</p>
</form>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
