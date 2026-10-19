<html>
<head>
<title>상세주소를 기입하세요.</title>
<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
<meta http-equiv='Cache-Control' content='no-cache'>
<meta name='Author' content='LeeDooHyung.com'>
<link rel="stylesheet" href="style.css" type="text/css">
</head>

<body bgcolor='#FFFFFF' text='#000000' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0' onload='document.zip.address.focus();'>

<?
echo ("
<script language='JavaScript'>
<!--
        function copy() {
                var addr = document.zip.addr.value;
                var address = document.zip.address.value;
                opener.document.$form.$address.value = addr+ \" \" +address;
                opener.document.$form.$address.focus();
                window.close();
        }
//-->
</script>
");

if($addr) {
echo ("
<tr bgcolor=white>
<form name='zip' method='post' action='$PHP_SELF' onSubmit='copy();'>
  
<table width='100%' cellpadding='2' cellspacing='1' border='1' bgcolor='A5A5A5' bordercolordark='8D8D8D' bordercolorlight='#666666'>
        <tr align=center>
       	<td align=center height='30'><b>상세주소 입력</b></td></tr>
	<tr align=center><td bgcolor='FFFFFF' height='150'>
        <br><input type='text' name='addr' size='55' value='$addr'>
        <br>상세주소(번지포함) : <input type='text' name='address' size='35'>
        <br><br>예) 138-19 금호빌딩 3층 (주)펜엔페이퍼
        <br><input type='submit' value='확 인'><br></td></tr>
	<tr align=center><td bgcolor='E2E2E2'><div align=center><a href=# onclick=history.go(-2)><font color=black>뒤로가기</a> <font color=bbbbbb>|</font> <a href=# onclick=window.close()><font color=black>창 닫기</a></div></td></tr>
</table>
</form>
");
} else {
echo ("
<script>window.close();</script>
        ");
}
?>

</body>
</html>
