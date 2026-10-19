<?php

require_once dirname(__FILE__) . '/../simpleSmtpMailer.php';
$smtp_host = 'smtp.office365.com';
$smtp_port = 587;
$smtp_user = 'kch1414@ydkorea.co.kr';
$smtp_pass = 'aatlssoehd**133';
$smtp_secure = 'tls';
$mailFrom = "$name<kch1414@ydkorea.co.kr>";
//여기까지
$headers = "From: $mailFrom\n";
$headers .= "Reply-To: $e_mail\n";
$headers .= "X-Mailer: sir PHP Mailer V0.9 - www.offisave.co.kr\n";
$headers .= "X-Priority: 3\n";
$headers .= "Content-Type: text/html; charset=utf-8"; //// Mime type 
if($cc)
     $headers .= "cc:$cc\n"; // CC to
   if($bcc)
     $headers .= "bcc:$bcc\n"; // BCCs to
//여기까지는 수정하지 마세요

//메일을 받아볼 주소 수정이 필요할시 뒤에 이메일 주소부분만 수정하세요 
$adminemail = "kch1412@naver.com";


    // 메일 내용을 만들고
    $content = "
      <!--
        $HTTP_REFERER
      -->
<html>
<head>
<title>회원가입 요청메일</title>
</head>
<body>
<p>
<table width=600 align=center border= cellpadding= cellspacing=0 bordercolorlight='#cccccc' bordercolordark='#FFFFFF'>
	<tr>
		<td width=600  align=center bgcolor='#FFFFFF'>회원가입 요청메일</td>
		</tr></table><br>	

<table width=600 align=center border='1' cellpadding=4 cellspacing=0 bordercolorlight='#cccccc' bordercolordark='#FFFFFF'>
	<tr>
		<td width=100  bgcolor='#cccccc'>&nbsp; 성 &nbsp; &nbsp; 명</td>
		<td>&nbsp; $name</td>
	</tr>
	<tr>
		<td width=100  bgcolor='#cccccc'>&nbsp; 회 사 명</td>
		<td>&nbsp; $c_name</td>
	</tr>
	<tr>
		<td bgcolor='#cccccc'>&nbsp; E-Mail</td>
		<td>&nbsp; $e_mail</td>
	</tr>
	<tr>
		<td bgcolor='#cccccc'>&nbsp; 전화번호</td>
		<td>&nbsp; $tel</td>
	</tr>
	<tr>
		<td bgcolor='#cccccc'>&nbsp; 핸 드 폰</td>
		<td>&nbsp; $hp</td>
	</tr>
	<tr>
		<td width=100  bgcolor='#cccccc'>&nbsp; 보유차량</td>
		<td>&nbsp; $car</td>
	</tr>
    <tr>
		<td width=100  bgcolor='#cccccc'>&nbsp; 차량번호</td>
		<td>&nbsp; $car_no</td>
	</tr>
	<tr>
		<td width=100  bgcolor='#cccccc'>&nbsp; 주 &nbsp; &nbsp; 소</td>
		<td>&nbsp; $ad</td>
	</tr>
    <tr>
        <td width=100  bgcolor='#cccccc'>&nbsp; 자기소개</td>
		<td>&nbsp; $fro</td>
	</tr>
</table>
<p>
$s_order
</body>
</html>";

//메일 보내는 명령어 아래 회원가입 요청메일 이라는 것이 메일을 직접 받았을때 제목 입니다.


$mailer = new SimpleSmtpMailer(
$smtp_host,
$smtp_port,
$smtp_user,
$smtp_pass,
$smtp_secure,
30
);
$mailer->send(
$smtp_user,
$adminemail,
'회원가입 요청메일.',
strip_tags($content),
$name,
''
);


//아래 끝부분에 formmail.html 메일을 보내고 다시 돌라갈 파일 이름입니다.
  echo "<meta http-equiv=\"refresh\" content=\"0;url=/main/club_01.html\">";

?>
