<?
	$mysql_host = 'localhost';   // DB 호스트명 
	$mysql_user = 'kch1414';   // DB 사용자 계정 
	$mysql_pwd  = 'tlssoehd00';    // DB 사용자 패스워드 
	$mysql_db   = 'kch1414';     // DB name
	
	$connect = @mysql_connect($mysql_host, $mysql_user, $mysql_pwd);
	$status = mysql_select_db($mysql_db, $connect);
	
	$sql = "select * from companyinfo ";

	$result = mysql_query($sql,$connect);

	$name = mysql_result($result,0,1);
?>

<html>
	<body>
	<?echo("$name");?>
	</body>
</html>
