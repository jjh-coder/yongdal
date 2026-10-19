<?
	if($logcorp_xml_send != true){
		$ptc = strstr($_SERVER['SERVER_PROTOCOL'],"HTTPS") ? "https://" : "http://";
		if(!isset($_SESSION)) @session_start();
		$logsrid = $_COOKIE['logsrid'];
		if($logsrid == ""){
			$microtime = split("\.", microtime(true));
			$logsrid = substr(md5(session_id()),0,26)."-".date("Ymd") . substr($microtime[0], -5). substr($microtime[1], 0, 2);
		}
		if(session_id()){
			$_SESSION['logsid']=md5(session_id());
			$_SESSION['logref']=urlencode($_SERVER['HTTP_REFERER']);
			$logcorp_pV = "logra=".$_SERVER['REMOTE_ADDR']."&logsid=".md5(session_id())."&logsrid=".$logsrid."&logua=".urlencode($_SERVER['HTTP_USER_AGENT'])."&logha=".urlencode($_SERVER['HTTP_ACCEPT'])."&logref=".urlencode($_SERVER['HTTP_REFERER'])."&logurl=".urlencode($ptc.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'])."&cdkey=kch1414&asp=asp21"; 
			$logcorp_headers =  "GET /jserver.php?".$logcorp_pV." HTTP/1.0\r\nHost: j1.http.or.kr\r\nConnection: Close\r\n\r\n";
			$logcorp_fp = @fsockopen("j1.http.or.kr", 80, $errno, $errstr,0.2); 
			if($logcorp_fp) {
				fwrite($logcorp_fp, $logcorp_headers);
				fclose($logcorp_fp);
			}
			$logcorp_xml_send = True;
			setcookie("logsrid", $logsrid, time()+259200000, "/",str_replace("www.","",$_SERVER['SERVER_NAME']));
		}
	}
/*
* 특허번호 : 10-1029990
* 특허명 : 접속 정보 제공 시스템 및 방법
* 특허권자 : 주식회사 로그
* 본 프로그램 소스는 (주)로그에서 개발.배포한 것으로 등록특허 제 10-1029990호(접속 정보 제공 시스템 및 방법)의 특허 기술이 적용되었습니다.
* 특허권자의 허락없이 사용,배포,판매 등의 행위를 할 경우 특허법 제128조 및 제225조에 따라 민.형사상 책임을 질 수 있습니다.
*/
?>