<?php
/**
 * 용달코리아 v2 공통 헬퍼 함수 (PHP 7.4.33)
 */

/**
 * XSS 방지 출력 이스케이프
 */
function e($v): string
{
    return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');
}

/**
 * 신규(v2) 절대경로 URL 생성
 */
function url(string $path = ''): string
{
    return BASE_URL . '/' . ltrim($path, '/');
}

/**
 * 기존 사이트 레거시 절대경로 URL 생성
 */
function legacy(string $path = ''): string
{
    return LEGACY_URL . '/' . ltrim($path, '/');
}

/**
 * UTF-8 HTML 시스템 알림 메일 발송 (PHP 7.4.33 호환)
 */
function send_system_mail(string $to, string $subject, string $htmlBody, string $senderName = '', string $replyTo = ''): bool
{
    $fromEmail = defined('MAIL_FROM_EMAIL') ? MAIL_FROM_EMAIL : 'kch1414@ydkorea.co.kr';
    $senderName = $senderName ?: (defined('SITE_NAME') ? SITE_NAME : '용달코리아');
    
    // 한글 제목 및 발송자 인코딩 (RFC 2047)
    $encodedSubject = '=?UTF-8?B?' . base64_encode($subject) . '?=';
    $encodedSender = '=?UTF-8?B?' . base64_encode($senderName) . '?=';

    $headers = [];
    $headers[] = "From: {$encodedSender} <{$fromEmail}>";
    if (!empty($replyTo) && filter_var($replyTo, FILTER_VALIDATE_EMAIL)) {
        $headers[] = "Reply-To: {$replyTo}";
    }
    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-Type: text/html; charset=UTF-8";
    $headers[] = "Content-Transfer-Encoding: 8bit";
    $headers[] = "X-Mailer: YDKorea FormMail PHP/" . phpversion();
    $headers[] = "X-Priority: 1 (Highest)";

    $headerStr = implode("\r\n", $headers);

    return (bool) @mail($to, $encodedSubject, $htmlBody, $headerStr);
}

/**
 * 운송 상담 요청 알림 메일 발송 (main/formmail_01.php 연동)
 */
function send_consult_mail(array $data): bool
{
    $adminEmail = defined('ADMIN_NOTIFY_EMAIL') ? ADMIN_NOTIFY_EMAIL : 'kch1412@naver.com';
    $name = htmlspecialchars($data['name'] ?? '', ENT_QUOTES, 'UTF-8');
    $tel = htmlspecialchars($data['tel'] ?? '', ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($data['email'] ?? '', ENT_QUOTES, 'UTF-8');
    $moveDate = htmlspecialchars($data['move_date'] ?? '미정', ENT_QUOTES, 'UTF-8');
    $carType = htmlspecialchars($data['car_type'] ?? '-', ENT_QUOTES, 'UTF-8');
    $startArea = htmlspecialchars($data['start_area'] ?? '-', ENT_QUOTES, 'UTF-8');
    $endArea = htmlspecialchars($data['end_area'] ?? '-', ENT_QUOTES, 'UTF-8');
    $story = nl2br(htmlspecialchars($data['story'] ?? '', ENT_QUOTES, 'UTF-8'));
    $clientIp = htmlspecialchars($data['client_ip'] ?? ($_SERVER['REMOTE_ADDR'] ?? ''), ENT_QUOTES, 'UTF-8');
    $now = date('Y년 m월 d일 H시 i분');

    $subject = "운송 상담 요청메일. [{$name}]";

    $html = <<<HTML
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>운송 상담 요청 메일</title>
</head>
<body style="font-family:'Malgun Gothic',dotum,sans-serif; color:#333; line-height:1.6; margin:0; padding:20px; background:#f4f4f4;">
  <table width="650" align="center" cellpadding="0" cellspacing="0" style="background:#fff; border:1px solid #ddd; border-radius:8px; overflow:hidden; box-shadow:0 2px 5px rgba(0,0,0,0.05);">
    <tr>
      <td style="background:#1E3A8A; color:#fff; padding:20px 24px; font-size:20px; font-weight:bold;">
        용달코리아 운송 상담 요청메일
      </td>
    </tr>
    <tr>
      <td style="padding:24px;">
        <table width="100%" cellpadding="10" cellspacing="0" border="1" bordercolor="#e2e8f0" style="border-collapse:collapse; font-size:14px;">
          <tr>
            <td width="130" bgcolor="#f8fafc" style="font-weight:bold; color:#475569;">성 명</td>
            <td style="font-weight:bold; color:#1e293b;">{$name}</td>
          </tr>
          <tr>
            <td bgcolor="#f8fafc" style="font-weight:bold; color:#475569;">전화번호</td>
            <td style="font-weight:bold; color:#2563eb;">{$tel}</td>
          </tr>
          <tr>
            <td bgcolor="#f8fafc" style="font-weight:bold; color:#475569;">이 메 일</td>
            <td>{$email}</td>
          </tr>
          <tr>
            <td bgcolor="#f8fafc" style="font-weight:bold; color:#475569;">운송/이사 희망일</td>
            <td>{$moveDate}</td>
          </tr>
          <tr>
            <td bgcolor="#f8fafc" style="font-weight:bold; color:#475569;">차량 종류</td>
            <td>{$carType}</td>
          </tr>
          <tr>
            <td bgcolor="#f8fafc" style="font-weight:bold; color:#475569;">출발지 &rarr; 도착지</td>
            <td><strong>{$startArea}</strong> &rarr; <strong>{$endArea}</strong></td>
          </tr>
          <tr>
            <td bgcolor="#f8fafc" style="font-weight:bold; color:#475569;">상담 및 화물 내용</td>
            <td style="line-height:1.7; background:#fafafa;">{$story}</td>
          </tr>
          <tr>
            <td bgcolor="#f8fafc" style="font-weight:bold; color:#475569;">접수 일시</td>
            <td style="color:#64748b; font-size:13px;">{$now} (IP: {$clientIp})</td>
          </tr>
        </table>
        <div style="margin-top:20px; text-align:center;">
          <a href="tel:{$tel}" style="display:inline-block; background:#2563eb; color:#fff; text-decoration:none; padding:10px 24px; border-radius:6px; font-weight:bold;">
            고객에게 바로 전화걸기 ({$tel})
          </a>
        </div>
      </td>
    </tr>
    <tr>
      <td style="background:#f8fafc; border-top:1px solid #eee; padding:14px 24px; font-size:12px; color:#888; text-align:center;">
        본 메일은 용달코리아(ydkorea.co.kr) 홈페이지 온라인 상담 접수 시스템에서 발송되었습니다.
      </td>
    </tr>
  </table>
</body>
</html>
HTML;

    return send_system_mail($adminEmail, $subject, $html, $name, $data['email'] ?? '');
}

/**
 * 차주회원 가입 신청 알림 메일 발송 (main/formmail_1.php 연동)
 */
function send_club_mail(array $data): bool
{
    $adminEmail = defined('ADMIN_NOTIFY_EMAIL') ? ADMIN_NOTIFY_EMAIL : 'kch1412@naver.com';
    $name = htmlspecialchars($data['name'] ?? '', ENT_QUOTES, 'UTF-8');
    $cName = htmlspecialchars($data['c_name'] ?? '', ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($data['e_mail'] ?? '', ENT_QUOTES, 'UTF-8');
    $tel = htmlspecialchars($data['tel'] ?? '', ENT_QUOTES, 'UTF-8');
    $hp = htmlspecialchars($data['hp'] ?? '', ENT_QUOTES, 'UTF-8');
    $car = htmlspecialchars($data['car'] ?? '', ENT_QUOTES, 'UTF-8');
    $carNo = htmlspecialchars($data['car_no'] ?? '', ENT_QUOTES, 'UTF-8');
    $ad = htmlspecialchars($data['ad'] ?? '', ENT_QUOTES, 'UTF-8');
    $fro = nl2br(htmlspecialchars($data['fro'] ?? '', ENT_QUOTES, 'UTF-8'));
    $clientIp = htmlspecialchars($data['client_ip'] ?? ($_SERVER['REMOTE_ADDR'] ?? ''), ENT_QUOTES, 'UTF-8');
    $now = date('Y년 m월 d일 H시 i분');

    $subject = "회원가입 요청메일. [{$name} / {$cName}]";

    $html = <<<HTML
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>회원가입 요청메일</title>
</head>
<body style="font-family:'Malgun Gothic',dotum,sans-serif; color:#333; line-height:1.6; margin:0; padding:20px; background:#f4f4f4;">
  <table width="650" align="center" cellpadding="0" cellspacing="0" style="background:#fff; border:1px solid #ddd; border-radius:8px; overflow:hidden; box-shadow:0 2px 5px rgba(0,0,0,0.05);">
    <tr>
      <td style="background:#0F766E; color:#fff; padding:20px 24px; font-size:20px; font-weight:bold;">
        용달코리아 차주회원 가입 신청메일
      </td>
    </tr>
    <tr>
      <td style="padding:24px;">
        <table width="100%" cellpadding="10" cellspacing="0" border="1" bordercolor="#e2e8f0" style="border-collapse:collapse; font-size:14px;">
          <tr>
            <td width="130" bgcolor="#f8fafc" style="font-weight:bold; color:#475569;">성 명</td>
            <td style="font-weight:bold; color:#1e293b;">{$name}</td>
          </tr>
          <tr>
            <td bgcolor="#f8fafc" style="font-weight:bold; color:#475569;">회사명 (상호)</td>
            <td style="font-weight:bold;">{$cName}</td>
          </tr>
          <tr>
            <td bgcolor="#f8fafc" style="font-weight:bold; color:#475569;">핸 드 폰</td>
            <td style="font-weight:bold; color:#2563eb;">{$hp}</td>
          </tr>
          <tr>
            <td bgcolor="#f8fafc" style="font-weight:bold; color:#475569;">일반 전화</td>
            <td>{$tel}</td>
          </tr>
          <tr>
            <td bgcolor="#f8fafc" style="font-weight:bold; color:#475569;">이 메 일</td>
            <td>{$email}</td>
          </tr>
          <tr>
            <td bgcolor="#f8fafc" style="font-weight:bold; color:#475569;">보유 차량</td>
            <td><strong style="color:#0f766e;">{$car}</strong></td>
          </tr>
          <tr>
            <td bgcolor="#f8fafc" style="font-weight:bold; color:#475569;">차량 번호</td>
            <td><strong>{$carNo}</strong></td>
          </tr>
          <tr>
            <td bgcolor="#f8fafc" style="font-weight:bold; color:#475569;">현주소/활동지역</td>
            <td>{$ad}</td>
          </tr>
          <tr>
            <td bgcolor="#f8fafc" style="font-weight:bold; color:#475569;">자기소개/경력</td>
            <td style="line-height:1.7; background:#fafafa;">{$fro}</td>
          </tr>
          <tr>
            <td bgcolor="#f8fafc" style="font-weight:bold; color:#475569;">신청 일시</td>
            <td style="color:#64748b; font-size:13px;">{$now} (IP: {$clientIp})</td>
          </tr>
        </table>
        <div style="margin-top:20px; text-align:center;">
          <a href="tel:{$hp}" style="display:inline-block; background:#0f766e; color:#fff; text-decoration:none; padding:10px 24px; border-radius:6px; font-weight:bold;">
            차주님에게 바로 전화걸기 ({$hp})
          </a>
        </div>
      </td>
    </tr>
    <tr>
      <td style="background:#f8fafc; border-top:1px solid #eee; padding:14px 24px; font-size:12px; color:#888; text-align:center;">
        본 메일은 용달코리아(ydkorea.co.kr) 차주회원 가입 신청 시스템에서 발송되었습니다.
      </td>
    </tr>
  </table>
</body>
</html>
HTML;

    return send_system_mail($adminEmail, $subject, $html, $name, $data['e_mail'] ?? '');
}

