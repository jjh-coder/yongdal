//수정소스의 상단소스
<?
$mailFrom = "$name<kch1414@ydkorea.co.kr>"; //<--이것을 삭제하고

<?php
require_once dirname(__FILE__) . '/../simpleSmtpMailer.php'; //한단게 위 폴더이 있을 때
require_once dirname(__FILE__) . '/simpleSmtpMailer.php'; // 같은 폴더에 있을 때
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
//위와 같이 수정한다 여기까지 상단 소스

//하단 기존 소스 
mail($adminemail, '회원가입 요청메일.', $content, $headers); //<--이것을 삭제하고 
//하단 수정할 소스
try {
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
} catch (Exception $e) {
error_log('[SMTP ERROR] ' . $e->getMessage());
}
//여기까지 붙여넣기 할것


//아래 끝부분에 formmail.html 메일을 보내고 다시 돌라갈 파일 이름입니다.

?>


// 참고 사함
<?
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";
$headers .= "Content-Type: text/html; charset=EUC_KR\n"; // 사용 하지말것
$headers .= "From: admin@test.com\r\n";

require_once __DIR__ . '/SimpleSmtpMailer.php'; //같은 폴더에 있을 때
//......
$file = __DIR__ . '/SimpleSmtpMailer.php';
if (file_exists($file)) {
require_once $file;
} else {
die('파일을 찾을 수 없습니다: ' . $file);
}
?>
//......
<?php
require_once __DIR__ . '/SimpleSmtpMailer.php';
$mailer = new SimpleSmtpMailer();
?>


//php 버전확인은 
<?php 하단에 
echo phpversion();
exit;
넣고 주소장에 url 주소 입력 후 엔터/ 예 : https://www.ydkorea.co.kr/main/formmail_1ap00.php

//php 핵심 소스는 
require_once dirname(__FILE__) . '/../simpleSmtpMailer.php';

$smtp_host = 'smtp.office365.com';
$smtp_port = 587;
$smtp_user = 'kch1414@ydkorea.co.kr';
$smtp_secure = 'tls';


$mailer = new SimpleSmtpMailer(
$smtp_host,
$smtp_port,
$smtp_user,
$smtp_pass,
$smtp_secure,
30
);
//여기까지 책심