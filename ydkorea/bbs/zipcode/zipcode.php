<html>
<head>
<title>우편번호찾기</title>
<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>
<meta http-equiv='Cache-Control' content='no-cache'>
<meta name='Author' content='LeeDooHyung.com'>
<link rel="stylesheet" href="style.css" type="text/css">
</head>

<body bgcolor='#FFFFFF' text='#000000' leftmargin='0' topmargin='0' marginwidth='0' marginheight='0' onload='document.zip.query.focus();'>
<script>
function check_submit()
{
 if(!document.zip.query.value)
 {
  alert('주소를 입력하여 주세요');
  document.zip.query.focus();
  return false;
 }
 return true;
}
</script>

<?
//우편번호 데이터베이스 파일 지정
$zipfile = "zipcode.db";

echo ("

        <form name=zip method=post action='$PHP_SELF' onsubmit='return check_submit()'>
        <input type=hidden name=mode value=search>
        <input type=hidden name=form value=$form>
        <input type=hidden name=address value=$address>
        <table width='100%' height='30' cellpadding='2' cellspacing='1' border='0' bgcolor='666666'>
          <tr>
            <td align='center' bgcolor='EEEEEE'>
                <select name=searchmode onChange=document.zip.query.focus()>
                <option value=address>주소로 찾기
                <option value=code>우편번호로 찾기
                </select>
                <input type=text name=query size=16 style='ime-mode:active'>
            </td>
            <td align='center' bgcolor='DCDCDC'>
                <input type='submit' value='찾기'>
                <input type='button' value='닫기' onClick='javascript:window.close();opener.focus();'>
            </td>
          </tr>
        </table>
        </form>
");

        if($query) {
        echo ("
        <table width='100%' cellpadding='2' cellspacing='1' border='0' bgcolor='666666'>
        <tr>
                <td align=center bgcolor=A5A5A5 colspan='4'><b>검 색 결 과</b></td>
        </tr>
<tr align=center bgcolor=dddddd>
<td width='30' align=center>번호</td>
  <td width='50' align=center>우편번호</td>
  <td align=center>주&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;소</td>
  <td width='30' align=center>선택</td></font>
</tr>
                ");
                $query = chop($query);
                $datum = file("$zipfile");
                $i=0;
                while ($data = each($datum)) {
                        if(eregi("$query", $data[1])) {
                                $all_code = explode("|",$data[1]);
                                $i=$i+1;
				$add = "$all_code[1] " . "$all_code[2] " . "$all_code[3] " . "$all_code[4] ";
                                $juso = "$all_code[0] " . "$all_code[1] " . "$all_code[2] " . "$all_code[3] ";
                                echo ("
                                        
                                        <tr><td bgcolor='FFFFFF' align=center>$i</td>
                                        <td bgcolor='FFFFFF' align=center>$all_code[0]</td>
                                        <td bgcolor='FFFFFF'>&nbsp;$add</td>
                                        <td bgcolor='FFFFFF' align=center><a href=\"zipcode2.php?form=$form&address=$address&addr=$juso\">선택</a></td></tr>
                                        
                                        ");
                        }
                }
        echo ("<tr>
                <td bgcolor=dddddd align=center colspan='4'><b>총 $i 개가 검색되었습니다.</b>
                <br>
<div align=center><a href=# onclick=history.go(-2)><font color=black>뒤로가기</a> <font color=bbbbbb>|</font> <a href=# onclick=window.close()><font color=black>창 닫기</a>
        </td></tr>
        </table>
        ");

        } else {
        //초기화면
        echo ("
        <table width='100%' cellpadding='2' cellspacing='1' border='0' bgcolor='EEEEEE'>
        <tr bgcolor='EEEEEE'>
  <td align=center height='30'><b>우편번호 검색 </b>(Search Zipcode)</td>
</tr>
<tr bgcolor=white>
  <td>
                <br>
            <p align='center'>우편번호를 검색합니다.<br>
                찾고자 하는 동의 이름을 입력하여 주십시오.<br>
                ( 예: <b>미아</b> 또는 <b>미아9동</b> )<br>
                ( 예: 우편번호 찾기의 경우 <b>142-809</b> )<br><br>
                </td>
        </table>
                ");

        }

?>

</body>
</html>
