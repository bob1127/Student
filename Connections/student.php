
<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_student = "localhost";
$database_student = "student";
$username_student = "root";
$password_student = "123456";
$student = mysql_pconnect($hostname_student, $username_student, $password_student) or trigger_error(mysql_error(),E_USER_ERROR); 
?>