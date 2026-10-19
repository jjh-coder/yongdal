<?php
        $mailTo		=	"dandyboy03@hanmail.net";	// 받는 메일 주소;
        $mailFrom	=	"help@ydkorea.co.kr";	// 

        $mailSubject = "메일 테스트 제목입니다.";
        $mailContent = "감사합니다.";

        $mailHeader = "From: $mailFrom\r\n";
        $mailHeader .= "MIME-Version: 1.0\r\n";
        $mailHeader .= "Content-type: text/html; charset=utf-8";

        $mailResult = mail ($mailTo, $mailSubject, $mailContent, $mailHeader,'-f'.$mailFrom);

        if (true == $mailResult) {
                echo "메일 발송 완료";
        }
        else {
                echo "메일 발송 실패";
        }
?>

