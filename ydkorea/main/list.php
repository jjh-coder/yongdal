<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<?php
$mysql_host = 'localhost';
$mysql_user = 'kch1414';
$mysql_pwd = 'tlssoehd00';
$mysql_db = 'kch1414';
$connect = mysqli_connect($mysql_host, $mysql_user, $mysql_pwd, $mysql_db);
if (!$connect) {
    die("DB 연결 실패: " . mysqli_connect_error());
}
mysqli_set_charset($connect, "utf8");

$id = isset($_GET['id']) ? mysqli_real_escape_string($connect, $_GET['id']) : '';
?>
<html>
<head>
   <title>용달코리아 국내 최대의 화물 네트워크 - YDKOREA.CO.KR - </title>
   <META CHARSET="UTF-8">
   <META http-equiv="Content-Language">
   <META http-equiv="Keywords" CONTENT="HTML,CSS,JAVASCRITP,DESIGN">
   <META HTTP-EQUIV="Description" CONTENT="HTML,CSS,JAVACRIPT,DESIGN, 에 관한 모든정보가 이곳에 이곳에 있습니다">
   <META NAME="Keywords" CONTENT="용달코리아 용달 개인용달 개별용달 개별화물 화물 이삿짐 사무실이사 용달이사 용달화물 지역용달 지역화물
      지방화물 용달운임 리턴공차 포장이사 원룸이사 용차 지방화물 보관이사 익스프레스 24 2424 EXPRESS">
   <META NAME="Description" CONTENT="서울시 성동구 마장동에 위치한 용달코리아 용달네트워크 업체 소화물
       중형화물 지방화물알선 용달 이삿짐 사무실이사 포장이사 전문업체 온라인견적제공">


<link rel="stylesheet" type="text/css" href="../mystyle.css">
<style type="text/css"> td { font-size: 12pt ; }
 <!--
 td {font-size:13px;}
 a:link {text-decoration:none;}
 a:visited {text-decoration:none;}
 a:active {text-decoration:none;}
 a:hover {text-decoration:none; color:#CC0000; background:none;}
-->
 </style>
<script type="text/javascript">
var favoriteurl = "http://www.ydkorea.co.kr/";
var favoritetitle = "<b>용달코리아</b>" .replace("<b>","").replace("</b>","");
 function addfavorites(){
 if(document.all)
  window.external.AddFavorite(favoriteurl,favoritetitle)
}
 </script>
<!-------  회원테이블 모서리 ------>
 <style type="text/css">
hgroup{
border:4px solid #bfe1db; border-radius:5px; width:986px;  
 }
</style>
<!--------- 회원테이블 모서리 ----->
<script language="JavaScript">
<!--
function namosw_init_marquee(layername1, layername2, dir, scrollamount, scrolldelay, behavior, loop, cliplen, length, height)
{
  var is_ns4 = !document.getElementById && (navigator.appName.indexOf('Netscape', 0) != -1);
   var is_ns6 = document.getElementById && (navigator.appName.indexOf('Netscape', 0) != -1);


  var layer1, layer2;

 if (layername1 == '' || layername2 == '')
    return;
 
  if (is_ns4) {
    layer1 = document.layers[layername1];
    if (!layer1)
      return;
    layer2 = document.layers[layername1].document.layers[layername2];
  } else if (is_ns6) {
    layer1 = document.getElementById(layername1);
     layer2 = document.getElementById(layername2);
  } else {
    layer1 = document.all(layername1);
    layer2 = document.all(layername2);
  }

  if (document.all) {
    if (dir == 'l' || dir == 'r') {
       layer1.style.clip = 'rect(auto ' + cliplen + ' auto 0)';
      layer1.style.pixelWidth = cliplen;
      if (behavior == 's' || behavior == 'l')
        layer2.style.pixelLeft = (dir == 'l') ? cliplen : -length;
       else
        layer2.style.pixelLeft = (dir == 'l') ? Math.max(0, -length+cliplen) : Math.min(0, -length+cliplen);
    } else if (dir == 't' || dir == 'b') {
      layer1.style.clip = 'rect(0 auto ' + cliplen + ' auto)';
       layer1.style.pixelHeight = cliplen;
      if (behavior == 's' || behavior == 'l')
        layer2.style.pixelTop = (dir == 't') ? cliplen : -length;
      else
        layer2.style.pixelTop = (dir == 't') ? Math.max(0, -length+cliplen) : Math.min(0, -length+cliplen);
     }
  } else if (is_ns4) {
    if (dir == 'l' || dir == 'r') {  
      layer1.clip.width  = cliplen;
      layer1.clip.height = height;
      if (behavior == 's' || behavior == 'l')
         layer2.left = (dir == 'l') ? cliplen : -length;
      else
        layer2.left = (dir == 'l') ? Math.max(0, -length+cliplen) : Math.min(0, -length+cliplen);
    } else if (dir == 't' || dir == 'b') {
       layer1.clip.height = cliplen;
      if (behavior == 's' || behavior == 'l')
        layer2.top = (dir == 't') ? cliplen : -length;
      else
        layer2.top = (dir == 't') ? Math.max(0, -length+cliplen) : Math.min(0, -length+cliplen);
     }
  } else if (is_ns6) {
    if (dir == 'l' || dir == 'r') {  
      layer1.style.clip = 'rect(auto ' + cliplen + ' auto 0)';
      if (behavior == 's' || behavior == 'l')
         layer2.style.left = (dir == 'l') ? cliplen : -length;
      else
        layer2.style.left = (dir == 'l') ? Math.max(0, -length+cliplen) : Math.min(0, -length+cliplen);
    } else if (dir == 't' || dir == 'b') {
       layer1.style.clip = 'rect(0 auto ' + cliplen + ' auto)';
      if (behavior == 's' || behavior == 'l')
        layer2.style.top = (dir == 't') ? cliplen : -length;
      else
         layer2.style.top = (dir == 't') ? Math.max(0, -length+cliplen) : Math.min(0, -length+cliplen);
    }
  }

  layer1.m_layer    = layer2;
  layer1.m_dir      = dir;
  layer1.m_amount   = scrollamount;
   layer1.m_delay    = scrolldelay;
  layer1.m_behavior = behavior;
  layer1.m_loop     = loop;
  layer1.m_cliplen  = cliplen;
  layer1.m_length   = length;

  if (layer1.m_behavior == 'l') {
    if (layer1.m_loop == -1)
       layer1.m_loop = 1;
  }

  layer1.m_interval = setInterval("namosw_marquee_scroll('" + layername1 + "');", scrolldelay);
}

function namosw_marquee_scroll(layername)
{
 // local functions
//
function get_left(l)
{
  var is_ns4 = !document.getElementById && (navigator.appName.indexOf('Netscape', 0) != -1);
  var is_ns6 = document.getElementById && (navigator.appName.indexOf('Netscape', 0) != -1);
 
  if      (is_ns4) return l.left;
  else if (is_ns6) return parseInt(l.style.left);
  else             return l.style.pixelLeft;
}

function set_left(l, value)
{
  var is_ns4 = !document.getElementById && (navigator.appName.indexOf('Netscape', 0) != -1);
   var is_ns6 = document.getElementById && (navigator.appName.indexOf('Netscape', 0) != -1);

  if (is_ns4)       l.left = value;
  else if (is_ns6)  l.style.left = value;
  else              l.style.pixelLeft = value;
 }

function get_top(l)
{
  var is_ns4 = !document.getElementById && (navigator.appName.indexOf('Netscape', 0) != -1);
  var is_ns6 = document.getElementById && (navigator.appName.indexOf('Netscape', 0) != -1);
 
  if (is_ns4)       return l.top;
  else if (is_ns6)  return l.style.top;
  else              return l.style.pixelTop;
}

function set_top(l, value)
{
  var is_ns4 = !document.getElementById && (navigator.appName.indexOf('Netscape', 0) != -1);
   var is_ns6 = document.getElementById && (navigator.appName.indexOf('Netscape', 0) != -1);

  if (is_ns4)
    l.top = value;
  else if (is_ns6)
    l.style.top = value
  else
    l.style.pixelTop = value;
 }
// ------------------------
  var is_ns4 = !document.getElementById && (navigator.appName.indexOf('Netscape', 0) != -1);
  var is_ns6 = document.getElementById && (navigator.appName.indexOf('Netscape', 0) != -1);
 
  var layer, layer2;

  if (is_ns4)      layer = document.layers[layername];
  else if (is_ns6) layer = document.getElementById(layername);
  else             layer = document.all[layername];

  layer2 = layer.m_layer;
 
  if (layer.m_behavior == 's') {   // scroll
    if (layer.m_dir == 'l') {
      if (get_left(layer2) >= -layer.m_length) {
        set_left(layer2, get_left(layer2)-layer.m_amount);
      } else {
         if (layer.m_loop > 0) layer.m_loop--;
        set_left(layer2, layer.m_cliplen);
      }
    } else if (layer.m_dir == 'r') {
      if (get_left(layer2) < layer.m_cliplen) {
        set_left(layer2, get_left(layer2) + layer.m_amount);
       } else {
        if (layer.m_loop > 0) layer.m_loop--;
        set_left(layer2, -layer.m_length);
      }
    } else if (layer.m_dir == 't') {
      if (get_top(layer2) >= -layer.m_length) {
         set_top(layer2, get_top(layer2) - layer.m_amount);
      } else {
        if (layer.m_loop > 0) layer.m_loop--;
        set_top(layer2, layer.m_cliplen);
      }
    } else if (layer.m_dir == 'b') {
       if (get_top(layer2) < layer.m_cliplen) {
        set_top(layer2, get_top(layer2) + layer.m_amount);
      } else {
        if (layer.m_loop > 0) layer.m_loop--;
        set_top(layer2, -layer.m_length);
       }
    }
    if (layer.m_loop == 0)
      clearInterval(layer.m_interval);
  } else if (layer.m_behavior == 'a') {   // alternate
    if (layer.m_dir == 'l') {
      if (get_left(layer2) > Math.min(0, -layer.m_length+layer.m_cliplen)) {
         set_left(layer2, get_left(layer2)-layer.m_amount);
      } else {
        if (layer.m_loop > 0) layer.m_loop--;
        layer.m_dir = 'r';
      }
    } else if (layer.m_dir == 'r') {
       if (get_left(layer2) < Math.max(0, -layer.m_length+layer.m_cliplen)) {
        set_left(layer2, get_left(layer2)+layer.m_amount);
      } else {
        if (layer.m_loop > 0) layer.m_loop--;
 layer.m_dir = 'l';
       }
    } else if (layer.m_dir == 't') {
      if (get_top(layer2) > Math.min(0, -layer.m_length+layer.m_cliplen)) {
        set_top(layer2, get_top(layer2) - layer.m_amount);
      } else {
         if (layer.m_loop > 0) layer.m_loop--;
        layer.m_dir = 'b';
      }
    } else if (layer.m_dir == 'b') {
      if (get_top(layer2) < Math.max(0, -layer.m_length+layer.m_cliplen)) {
         set_top(layer2, get_top(layer2)+layer.m_amount);
      } else {
        if (layer.m_loop > 0) layer.m_loop--;
 layer.m_dir = 't';
      }
    }
  } else if (layer.m_behavior == 'l') {   // slide
     if (layer.m_dir == 'l') {
      if (get_left(layer2) > 0) {
        set_left(layer2, Math.max(0, get_left(layer2)-layer.m_amount));
      } else {
        if (layer.m_loop > 0) layer.m_loop--;
  set_left(layer2, layer.m_cliplen);
      }
    } else if (layer.m_dir == 'r') {
      if (get_left(layer2)+layer.m_length < layer.m_cliplen) {
        set_left(layer2, Math.min(get_left(layer2)+layer.m_amount, layer.m_cliplen-layer.m_length));
       } else {
        if (layer.m_loop > 0) layer.m_loop--;
        set_left(layer2, -layer.m_length);
      }
    } else if (layer.m_dir == 't') {
      if (get_top(layer2) > 0) {
        set_top(layer2, Math.max(0, get_top(layer2) - layer.m_amount));
       } else {
        if (layer.m_loop > 0) layer.m_loop--;
        set_top(layer2, layer.m_cliplen);
      }
    } else if (layer.m_dir == 'b') {
      if (get_top(layer2)+layer.m_length < layer.m_cliplen) {
         set_top(layer2, Math.min(get_top(layer2)+layer.m_amount, layer.m_cliplen-layer.m_length));
      } else {
        if (layer.m_loop > 0) layer.m_loop--;
        set_top(layer2, -layer.m_length);
      }
     }
    if (layer.m_loop == 0)
      clearInterval(layer.m_interval);
  }
}

// -->
</script>

<script language="JavaScript">
<!--
function na_restore_img_src(name, nsdoc)
 {
  var img = eval((navigator.appName.indexOf('Netscape', 0) != -1) ? nsdoc+'.'+name : 'document.all.'+name);
  if (name == '')
    return;
  if (img && img.altsrc) {
     img.src    = img.altsrc;
    img.altsrc = null;
  }
}

function na_preload_img()
{
  var img_list = na_preload_img.arguments;
  if (document.preloadlist == null)
    document.preloadlist = new Array();
   var top = document.preloadlist.length;
  for (var i=0; i < img_list.length-1; i++) {
    document.preloadlist[top+i] = new Image;
    document.preloadlist[top+i].src = img_list[i+1];
  }
}

function na_change_img_src(name, nsdoc, rpath, preload)
 {
  var img = eval((navigator.appName.indexOf('Netscape', 0) != -1) ? nsdoc+'.'+name : 'document.all.'+name);
  if (name == '')
    return;
  if (img) {
    img.altsrc = img.src;
     img.src    = rpath;
  }
}

 

// -->
</script>
</head>

 <body bgcolor="#ffffff" leftmargin="3" topmargin="0" OnLoad=" namosw_init_marquee('layer1', 'marqueechildlayer0', 't', 48, 2000, 'a', -1, 48, 101, 495);na_preload_img(false, '../images/logo_over.gif', '../images/cheonan_over.gif', '../images/chungju_over.gif', '../images/daejeon_over.gif', '../images/jeonju_over.gif', '../images/gwangju_over.gif', '../images/busan_over.gif', '../images/ulsan_over.gif', '../images/daegu_over.gif', '../images/wonju_over.gif', '../images/chuncheon_over.gif', '../images/pohang_over.gif', '../images/gangneung_over.gif', '../images/changwon_over.gif', '../images/masan_over.gif');">
           
        <table  width="990" height="" border="0" cellspacing="0" cellpadding="0" align="center">
             <tr>
                <td rowspan="2"width="15%" height="" align=""><a href="http://www.ydkorea.co.kr" onfocus="this.blur()" target="_top" OnMouseOut="na_restore_img_src('image15', 'document')" OnMouseOver="na_change_img_src('image15', 'document', '../images/logo_over.gif', true)"><img src="../images/logo_01.gif" border="0" name="image15"></a></td>
 
                <td width="35%" height="25" bgcolor="#EEFFFF" align="left" valign="bottom">&nbsp;
                    <a onclick="try{window.external.AddFavorite(location.href, document.title);}catch(e){alert('이 브라우저에서는 즐겨찾기 기능을 사용할 수 없습니다. Ctrl 키와 D 키를 동시에 눌러서 즐겨찾기에 추가할 수 있습니다.')}; return false;" href="javascript://" onfocus="this.blur()" target="_top"><span style="background-color:yellow;">즐겨찾기에 추가하기</span></a></td>
                 <td width="50%"  bgcolor="#EEFFFF" align="right" valign="bottom">
                    <a href="http://www.ydkorea.co.kr" onfocus="this.blur()" target="_top">home </a>&nbsp;&nbsp;&nbsp;
                     <a href="http://www.ydkorea.co.kr/bbs/admin_setup.php" onfocus="this.blur()" target="_top">admin&nbsp;</a></td></tr>
             <tr>
                <td colspan="2" width="85%"  bgcolor="#99FFFF" height="40">
                    <table width="100%" height="35" border="0" cellspacing="0" cellpadding="0">
                         <tr bgcolor="#99FFFF">
                            <td width="101" align="center" onMouseOver="this.style.background='#33CCFF'" onMouseOut="this.style.background='#99ffff'">
                                 <a href="info.html" onfocus="this.blur()" target="_top">회사소개</a></td>
                            <td align="center"><img src="../images/menu_bg1.gif"width="1" height="16" border="0"></td>
                             <td width="109" align="center" onMouseOver="this.style.background='#33CCFF'" onMouseOut="this.style.background='#99ffff'">
                                <a href="online_con.html" onfocus="this.blur()" target="_top">온라인상담</a></td>
                             <td align="center"><img src="../images/menu_bg1.gif" width="1" height="16" border="0"></td>
                            <td width="118" align="center" onMouseOver="this.style.background='#33CCFF'" onMouseOut="this.style.background='#99ffff'">
                                 <a href="tel_con.html" onfocus="this.blur()" target="_top">전화상담방법</a></td>
                            <td align="center"><img src="../images/menu_bg1.gif" width="1"  height="16" border="0"></td>
                             <td width="101" align="center"  onMouseOver="this.style.background='#33CCFF'" onMouseOut="this.style.background='#99ffff'">
                                <a href="trt.html" onfocus="this.blur()" target="_top">운송요금</a></td>
                             <td align="center"><img src="../images/menu_bg1.gif" width="1" height="16" border="0"></td>
                            <td width="101" align="center"  onMouseOver="this.style.background='#33CCFF'" onMouseOut="this.style.background='#99ffff'">
                                 <a href="car_size.html" onfocus="this.blur()" target="_top">차량규격</a>  </td>
                            <td align="center"><img src="../images/menu_bg1.gif" width="1" height="16" border="0"></td>
                             <td width="100" align="center"  onMouseOver="this.style.background='#33CCFF'" onMouseOut="this.style.background='#99ffff'">
                                <a href="car_club.html" onfocus="this.blur()" target="_top">차주회원모집</a></td>
                             <td align="center"><img src="../images/menu_bg1.gif" width="1" height="16" border="0"></td>
                            <td width="100" align="center"  onMouseOver="this.style.background='#33CCFF'" onMouseOut="this.style.background='#99ffff'">
                                 <a href="service.html" onfocus="this.blur()" target="_top">서비스안내</a></td>
                            <td align="center"><img src="../images/menu_bg1.gif" width="1" height="16" border="0"></td>
                             <td width="100" align="center" onMouseOver="this.style.background='#33CCFF'" onMouseOut="this.style.background='#99ffff'">
                                <a href="http://www.ydkorea.co.kr/bbs/zboard.php?id=Qwrite" onfocus="this.blur()" target="_top"></a></td>
                         </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="3" width="990" height="" align="center"><img src="../images/top_09.jpg" width="992" height="80" border="0"></td>
             </tr>
        </table>

        <table width="992" height="" border="0" cellspacing="0" cellpadding="1" align="center" bgcolor="#CDCDCD">
             <tr>
                <td>
                    <table width="100%" height="" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                         <tr>
                            <td width="100%" valign="top">
                               <table width="200" height="340" border="0" cellspacing="0" cellpadding="0">
                                     <tr>
                                        <td>
                                            <table width="100%" height="340" border="0" cellspacing="2" cellpadding="7">
                                                 <tr>
                                                    <td bgcolor="#ffffff"><img src="../images/left_menu01.gif"></td></tr>
                       <tr>
         <td bgcolor="#F0F0F0"><img src="../images/bl_03.gif"><strong><font size="3" face="굴림" color="blue">&nbsp;바로가기 메뉴</font></strong></td></tr>
                           <tr bgcolor="#F0F0F0"><td onMouseOver="this.style.background='#33CCFF'" onMouseOut="this.style.background='#F0F0F0'"><img src="../images/bl_07.gif">&nbsp;<a href="/main/list.php?id=07" onfocus="this.blur()" target="_top">best 용달</a></td></tr>
       <tr bgcolor="#F0F0F0"><td onMouseOver="this.style.background='#33CCFF'" onMouseOut="this.style.background='#F0F0F0'"><img src="../images/bl_07.gif">&nbsp;<a href="/main/list.php?id=08" onfocus="this.blur()" target="_top">1.4 t , &nbsp;2.5 t , &nbsp;5 t</a></td></tr>
       <tr bgcolor="#F0F0F0"><td onMouseOver="this.style.background='#33CCFF'" onMouseOut="this.style.background='#F0F0F0'"><img src="../images/bl_07.gif">&nbsp;<a href="/main/list.php?id=09" onfocus="this.blur()" target="_top">탑차 ( 1 t ~ 5 t )</a></td></tr>
       <tr bgcolor="#F0F0F0"><td onMouseOver="this.style.background='#33CCFF'" onMouseOut="this.style.background='#F0F0F0'"><img src="../images/bl_07.gif">&nbsp;<a href="/main/list.php?id=10" onfocus="this.blur()" target="_top">리프트차 ( 1t , 1.4 t )</a></td></tr>      
       <tr bgcolor="#F0F0F0"><td onMouseOver="this.style.background='#33CCFF'" onMouseOut="this.style.background='#F0F0F0'"><img src="../images/bl_07.gif">&nbsp;<a href="/main/freight.html" onfocus="this.blur()" target="_top">화물예약</a></td></tr>
       <tr bgcolor="#F0F0F0"><td onMouseOver="this.style.background='#33CCFF'" onMouseOut="this.style.background='#F0F0F0'"><img src="../images/bl_07.gif">&nbsp;<a href="/main/car_list_03.html" onfocus="this.blur()" target="_top">지방화물안내</a></td></tr>
                                             </table>
                                        </td>
                                    </tr>
                                </table>
                           </td>
                           <td valign="top"><p style="margin-top:6px">
                                 <table width="780" height="" align="center" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                                    <tr>
                                         <td width="497" height="350" align="center"><span style="margin-left:16px">
                                                <img src="../images/smap_0.gif" width="494" height="338" border="0" alt="" usemap="#smap">
                                                 <map name="smap">
                                                    <area shape="rect" coords="309, 206, 351, 227" href="/main/list.php?id=11" onFocus="blur();" target="_top" alt="강남구">
                                                     <area shape="rect" coords="384, 152, 427, 173" href="/main/list.php?id=12" onFocus="blur();" target="_top" alt="강동구">
                                                     <area shape="rect" coords="84, 141, 133, 159"   href="/main/list.php?id=13" onFocus="blur();" target="_top" alt="강서구">
                                                     <area shape="rect" coords="265, 74, 305, 91"     href="/main/list.php?id=14" onFocus="blur();" target="_top" alt="강북구">
                                                     <area shape="rect" coords="208, 234, 250, 255" href="/main/list.php?id=15" onFocus="blur();" target="_top" alt="관악구">
                                                     <area shape="rect" coords="335, 156, 374, 177" href="/main/list.php?id=16" onFocus="blur();" target="_top" alt="광진구">
                                                     <area shape="rect" coords="112, 207, 152, 226" href="/main/list.php?id=17" onFocus="blur();" target="_top" alt="구로구">
                                                     <area shape="rect" coords="161, 229, 200, 248" href="/main/list.php?id=18" onFocus="blur();" target="_top" alt="금천구">
                                                     <area shape="rect" coords="325, 43, 361, 64"    href="/main/list.php?id=19" onFocus="blur();" target="_top"  alt="노원구">
                                                     <area shape="rect" coords="285, 53, 323, 70"    href="/main/list.php?id=20" onFocus="blur();" target="_top"  alt="도봉구">
                                                     <area shape="rect" coords="294, 129, 346, 146" href="/main/list.php?id=21" onFocus="blur();" target="_top" alt="동대문구">
                                                     <area shape="rect" coords="208, 199, 251, 215" href="/main/list.php?id=22" onFocus="blur();" target="_top" alt="동작구">
                                                     <area shape="rect" coords="165, 146, 204, 166" href="/main/list.php?id=23" onFocus="blur();" target="_top" alt="마포구">
                                                     <area shape="rect" coords="184, 129, 238, 146" href="/main/list.php?id=24" onFocus="blur();" target="_top" alt="서대문구">
                                                     <area shape="rect" coords="270, 220, 306, 243" href="/main/list.php?id=25" onFocus="blur();" target="_top" alt="서초구">
                                                     <area shape="rect" coords="292, 152, 338, 171" href="/main/list.php?id=26" onFocus="blur();" target="_top" alt="성동구">
                                                     <area shape="rect" coords="266, 104, 314, 122" href="/main/list.php?id=27" onFocus="blur();" target="_top" alt="성북구">
                                                     <area shape="rect" coords="355, 192, 402, 211" href="/main/list.php?id=28" onFocus="blur();" target="_top" alt="송파구">
                                                     <area shape="rect" coords="118, 182, 160, 202" href="/main/list.php?id=29" onFocus="blur();" target="_top" alt="양천구">
                                                     <area shape="rect" coords="170, 181, 223, 197" href="/main/list.php?id=30" onFocus="blur();" target="_top" alt="영등포구">
                                                     <area shape="rect" coords="236, 174, 270, 185" href="/main/list.php?id=31" onFocus="blur();" target="_top" alt="용산구">
                                                     <area shape="rect" coords="184, 85, 235, 105"   href="/main/list.php?id=32" onFocus="blur();" target="_top" alt="은평구">
                                                     <area shape="rect" coords="238, 121, 276, 141" href="/main/list.php?id=33" onFocus="blur();" target="_top" alt="종로구">
                                                     <area shape="rect" coords="256, 145, 294, 163" href="/main/list.php?id=34" onFocus="blur();" target="_top" alt="중구">
                                                     <area shape="rect" coords="338, 105, 380, 125" href="/main/list.php?id=35" onFocus="blur();" target="_top" alt="중랑구">
                                                     <area shape="rect" coords="386, 101, 466, 121" href="/main/list.php?id=36" onFocus="blur();" target="_top" alt="구리/남양주">
                                                     <area shape="rect" coords="158, 271, 217, 294" href="/main/list.php?id=37" onFocus="blur();" target="_top" alt="군포/의왕">
                                                     <area shape="rect" coords="397, 242, 455, 263" href="/main/list.php?id=38" onFocus="blur();" target="_top" alt="성남/분당">
                                                     <area shape="rect" coords="146, 298, 204, 317" href="/main/list.php?id=39" onFocus="blur();" target="_top" alt="평택/송탄">
                                                     <area shape="rect" coords="320, 298, 381, 319" href="/main/list.php?id=40" onFocus="blur();" target="_top" alt="수원/병점">
                                                     <area shape="rect" coords="41, 207, 95, 232"    href="/main/list.php?id=41" onFocus="blur();" target="_top" alt="안산/시흥">
                                                     <area shape="rect" coords="242, 265, 303, 290" href="/main/list.php?id=42" onFocus="blur();" target="_top" alt="안양/과천">
                                                     <area shape="rect" coords="238, 296, 300, 319" href="/main/list.php?id=43" onFocus="blur();" target="_top" alt="오산/동탄">
                                                     <area shape="rect" coords="20, 117, 78, 140"    href="/main/list.php?id=44" onFocus="blur();" target="_top" alt="인천/부평">      
                                                    <area shape="rect" coords="100, 283, 153, 309"    href="/main/list.php?id=45" onFocus="blur();" target="_top" alt="화성/발안">
                                                     <area shape="rect" coords="107, 252, 160, 273" href="/main/list.php?id=46" onFocus="blur();" target="_top" alt="광명시">
                                                     <area shape="rect" coords="210, 18, 262, 37"    href="/main/list.php?id=47" onFocus="blur();" target="_top" alt="양주시">
                                                     <area shape="rect" coords="381, 56, 451, 77"    href="/main/list.php?id=48" onFocus="blur();" target="_top" alt="의정부시">
                                                     <area shape="rect" coords="368, 18, 423, 37"    href="/main/list.php?id=49" onFocus="blur();" target="_top" alt="포천시">
                                                     <area shape="rect" coords="426, 211, 479, 234" href="/main/list.php?id=50" onFocus="blur();" target="_top" alt="광주시">
                                                     <area shape="rect" coords="127, 88, 188, 111"  href="/main/list.php?id=51" onFocus="blur();" target="_top" alt="고양시">
                                                     <area shape="rect" coords="53, 83, 108, 99"     href="/main/list.php?id=52" onFocus="blur();" target="_top" alt="김포시">
                                                     <area shape="rect" coords="24, 176, 74, 193"    href="/main/list.php?id=53" onFocus="blur();" target="_top" alt="부천시">
                                                     <area shape="rect" coords="361, 266, 410, 287" href="/main/list.php?id=54" onFocus="blur();" target="_top" alt="용인시">
                                                     <area shape="rect" coords="145, 48, 198, 67"    href="/main/list.php?id=55" onFocus="blur();" target="_top" alt="파주시">
                                                     <area shape="rect" coords="425, 172, 478, 193" href="/main/list.php?id=56" onFocus="blur();" target="_top" alt="하남시">
                                                 </map>
                                                <map name="ImageMap1">
                                                    <area shape="rect" coords="945, 8, 856, 34" href="club.html" onfocus="this.blur()" target="_top">
                                                 </map>
                                        </td> 
                                        <td width="" align="center">
                                            <table width="250" height="" border="0" cellspacing="0" cellpadding="0">
                                                 <tr>
                                                    <td>
                                                        <table width="100%" align="center" border="0" cellspacing="0" cellpadding="2">
                                                             <tr>
                                                                <td colspan="2" bgcolor="#ffffff" align="center" height="55"><strong><font size="4" face="굴림" color="blue">전 국&nbsp; 광 역 시</font></strong>
                                                                     <hr width="90%" color="sky blue">
                                                                </td>
                                                            </tr>
                                                             <tr>
                                                                <td bgcolor="#ffffff" align="center">      
                                                                    <a href="list.php?id=57" onfocus="this.blur()" target="_top" OnMouseOut="na_restore_img_src('image1', 'document')" OnMouseOver="na_change_img_src('image1', 'document', '../images/cheonan_over.gif', true)"><img src="../images/cheonan.gif" width="95" height="27" border="0" name="image1"></a></td>
                                                                 <td bgcolor="#ffffff" align="center">
                                                                    <a href="list.php?id=58" onfocus="this.blur()" target="_top" OnMouseOut="na_restore_img_src('image2', 'document')" OnMouseOver="na_change_img_src('image2', 'document', '../images/chungju_over.gif', true)"><img src="../images/chungju.gif" width="95" height="27" border="0" name="image2"></a></td>
                                                             </tr>
                                                            <tr>
                                                                <td bgcolor="#ffffff" align="center">
                                                                     <a href="list.php?id=59" onfocus="this.blur()" target="_top" OnMouseOut="na_restore_img_src('image3', 'document')" OnMouseOver="na_change_img_src('image3', 'document', '../images/daejeon_over.gif', true)"><img src="../images/daejeon.gif" width="95" height="27" border="0" name="image3"></a></td>
                                                                 <td bgcolor="#ffffff" align="center">
                                                                    <a href="list.php?id=60" onfocus="this.blur()" target="_top" OnMouseOut="na_restore_img_src('image4', 'document')" OnMouseOver="na_change_img_src('image4', 'document', '../images/jeonju_over.gif', true)"><img src="../images/jeonju.gif" width="95" height="27" border="0" name="image4"></a></td>
                                                             </tr>
                                                            <tr>
                                                                <td bgcolor="#ffffff" align="center">
                                                                     <a href="list.php?id=61" onfocus="this.blur()" target="_top" OnMouseOut="na_restore_img_src('image13', 'document')" OnMouseOver="na_change_img_src('image13', 'document', '../images/gwangju_over.gif', true)"><img src="../images/gwangju.gif" width="95" height="27" border="0" name="image13"></a></td>
                                                                 <td bgcolor="#ffffff" align="center">
                                                                    <a href="list.php?id=62" onfocus="this.blur()" target="_top" OnMouseOut="na_restore_img_src('image5', 'document')" OnMouseOver="na_change_img_src('image5', 'document', '../images/busan_over.gif', true)"><img src="../images/busan.gif" width="95" height="27" border="0" name="image5"></a></td>
                                                             </tr>
															 <tr>
                                                                 <td bgcolor="#ffffff" align="center">
                                                                    <a href="list.php?id=71" onfocus="this.blur()" target="_top" OnMouseOut="na_restore_img_src('image17', 'document')" OnMouseOver="na_change_img_src('image17', 'document', '../images/gumi_over.gif', true)"><img src="../images/gumi.gif" width="95" height="27" border="0" name="image17"></a></td>
																 <td bgcolor="#ffffff" align="center">
                                                                    <a href="list.php?id=64" onfocus="this.blur()" target="_top" OnMouseOut="na_restore_img_src('image7', 'document')" OnMouseOver="na_change_img_src('image7', 'document', '../images/daegu_over.gif', true)"><img src="../images/daegu.gif" width="95" height="27" border="0" name="image7"></a></td>
                                                             </tr>
                                                            <tr>
                                                                <td bgcolor="#ffffff" align="center">
                                                                     <a href="list.php?id=65" onfocus="this.blur()" target="_top" OnMouseOut="na_restore_img_src('image8', 'document')" OnMouseOver="na_change_img_src('image8', 'document', '../images/wonju_over.gif', true)"><img src="../images/wonju.gif" width="95" height="27" border="0" name="image8"></a></td>
                                                                 <td bgcolor="#ffffff" align="center">
                                                                    <a href="list.php?id=66" onfocus="this.blur()" target="_top" OnMouseOut="na_restore_img_src('image9', 'document')" OnMouseOver="na_change_img_src('image9', 'document', '../images/chuncheon_over.gif', true)"><img src="../images/chuncheon.gif" width="95" height="27" border="0" name="image9"></a></td>
                                                             </tr>
                                                            <tr>
                                                                <td bgcolor="#ffffff" align="center">
                                                                     <a href="list.php?id=67" onfocus="this.blur()" target="_top" OnMouseOut="na_restore_img_src('image10', 'document')" OnMouseOver="na_change_img_src('image10', 'document', '../images/pohang_over.gif', true)"><img src="../images/pohang.gif" width="95" height="27" border="0" name="image10"></a></td>
                                                                 <td bgcolor="#ffffff" align="center">
                                                                    <a href="list.php?id=68" onfocus="this.blur()" target="_top" OnMouseOut="na_restore_img_src('image11', 'document')" OnMouseOver="na_change_img_src('image11', 'document', '../images/gangneung_over.gif', true)"><img src="../images/gangneung.gif" width="95" height="27" border="0" name="image11"></a></td>
                                                             </tr>
                                                            <tr>
                                                                <td bgcolor="#ffffff" align="center">
                                                                     <a href="list.php?id=69" onfocus="this.blur()" target="_top" OnMouseOut="na_restore_img_src('image12', 'document')" OnMouseOver="na_change_img_src('image12', 'document', '../images/changwon_over.gif', true)"><img src="../images/changwon.gif" width="95" height="27" border="0" name="image12"></a></td>
                                                                 <td bgcolor="#ffffff" align="center">
                                                                    <a href="list.php?id=82" onfocus="this.blur()" target="_top" OnMouseOut="na_restore_img_src('image14', 'document')" OnMouseOver="na_change_img_src('image14', 'document', '../images/suncheon_over.gif', true)"><img src="../images/suncheon.gif" width="95" height="27" border="0" name="image14"></a></td>
                                                             </tr>
															 <tr>
															    <td bgcolor="#ffffff" align="center">
							                                         <a href="list.php?id=77" onfocus="this.blur()" target="_top" OnMouseOut="na_restore_img_src('image16', 'document')" OnMouseOver="na_change_img_src('image16', 'document', '../images/jinju_over.gif', true)"><img src="../images/jinju.gif" width="95" height="27" border="0" name="image16"></a></td>			<td bgcolor="#ffffff" align="center">
                                                                     <a href="list.php?id=63" onfocus="this.blur()" target="_top" OnMouseOut="na_restore_img_src('image6', 'document')" OnMouseOver="na_change_img_src('image6', 'document', '../images/ulsan_over.gif', true)"><img src="../images/ulsan.gif" width="95" height="27" border="0" name="image6"></a></td>

                                                               <tr>
															    <td bgcolor="#ffffff" align="center">
							                                         <a href="list.php?id=79" onfocus="this.blur()" target="_top" OnMouseOut="na_restore_img_src('image18', 'document')" OnMouseOver="na_change_img_src('image18', 'document', '../images/yangsan_over.gif', true)"><img src="../images/yangsan.gif" width="95" height="27" border="0" name="image18"></a></td>
                                                                <td bgcolor="#ffffff" align="center">
                                                                       <a href="list.php?id=80" onfocus="this.blur()" target="_top" OnMouseOut="na_restore_img_src('image19', 'document')" OnMouseOver="na_change_img_src('image19', 'document', '../images/sejong_over.gif', true)"><img src="../images/sejong.gif" width="95" height="27" border="0" name="image19"></a></td></tr>

                                                            <?php
                                                            $sql = "select * from area_banner where id = '$id' order by rand()";
                                                            $result2 = mysqli_query($connect, $sql);
                                                            if ($result2 && mysqli_num_rows($result2) > 0) {
                                                                $row2 = mysqli_fetch_row($result2);
                                                                $html = $row2[3] ?? '';
                                                                echo $html;
                                                            }
                                                            ?>

                                                        </table>
                                                    </td>
                                                </tr>
                                             </table>
                                        </td>
                                    </tr>
                                </table></td>
                         </tr>
                    </table>
                </td>
            </tr>
        </table>
  
<!-- 회원시작 list page-->



        <table width="980" align="center" border="0"  bgcolor= "" cellspacing="0" cellpadding="5">
            <tr>
                <td>
				<hgroup>
                    <table  width="980" align="" border="0"  bgcolor= "ffffff" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>

                                <table bgcolor="ffffff" border="0" border color="" align="" cellpadding=""  cellspacing="">
                                    <tr>
                                        <td width="980" height="30" align="center">
                                            <img src="../images/topimg/region_<?php echo htmlspecialchars($id); ?>.gif" border="0" width="970" height="30" usemap="#ImageMap1">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
 <!-- 2011/11/24 수정 시작 -->
 
                                <p style="margin-top:5px;">
								
                                <table width="986" align="certer" bgcolor="ffffff" border="0" cellpadding="0"  cellspacing="0">
                               <?php
							   
							  
                                 $sql = "select * from company where id = '$id' order by rand()";



                                 $result = mysqli_query($connect,$sql);
                                 if(!$result){
                                 die(mysqli_error($connect));
                                  }
                                  $total_record = mysqli_num_rows($result);
								  
			  
								  
                                  $row_cnt = ceil($total_record / 6);
								  $result_cnt = 0;
                                    
                                    
                                    
                                    for ($i = 0; $i < $row_cnt; $i++) {
                                    ?>
                                        <tr>
                                    <?php
                                        for ($j = 0; $j < 6; $j++) {
                                            if($total_record <= $result_cnt) {
												$code = "&nbsp;";
                                                $name = "&nbsp;";
                                                $explain = "&nbsp;";
                                                $tel = "&nbsp;";
									?>
											<td width="130" height=""  align="left">&nbsp;</td>
									<?php
                                            } else {
                                            $row = mysqli_fetch_assoc($result);
                                            $code = $row['code'];
                                            $name = $row['name'];
                                            $tel = $row['tel'];
                                            $explain = $row['detail'];
											
									?>
                                            <td width="130" height=""  align="left"><p style="margin:0px 0px 0px 8px">
                                                <table bgcolor="fffff" border="0" border color="" align="center" cellpadding="0"  cellspacing="0"
                                                       onClick="window.open('/jijum/<?php echo $code; ?>.html', '', 'width=565, height=467 left=0 top=0 scrollbars=no menubar=no directories=no, location=yes')"style="cursor:pointer;">
                                                    <tr>
                                                        <td align="center">
                                                            <table width ="130"  bgcolor="ffffff" border="0" border color="blue" align="center" cellpadding="0"  cellspacing="0">
                                                                <tr>
                                                                    <td width="130" height="20" align="center"><b><font size="3" face="굴림" color="#003300"><?php echo $name; ?></b></font>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <table width ="130"  bgcolor="#f4feff" border="1" bordercolor="blue" align="center" cellpadding="0"  cellspacing="0"  border color="#0a255e" style="border-collapse:collapse;">
                                                                            <tr>
                                                                                <td width="130" height="50" align="center"><font color="#ff6688"><b><?php echo $explain; ?></b></font></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td width="130" bgcolor="#5555ff" height="22" align="center" valign="bottom"><b><font face="굴림" size="3" color="#ffffff"><?php echo $tel; ?></span></font></b></td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                    <?php
                                            }
                                    
                                            $result_cnt++;
                                        }
                                    ?>
                                        </tr>
                                        <tr>
                                            <td colspan="6" height="10">&nbsp;</td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
<!-- 2011/11/24 수정 종료 -->
                            </td>
                        </tr>
                    </table>
				</hgroup>
                </td>
            </tr>
        </table>

        <div id="layer1" style="width:495px; height:50px; position:absolute; left:550px; top:80px; z-index:1;">
            <div id="marqueechildlayer0" style="position:absolute; left:0; top:0; width:100%; height:100%;" namo_marquee>
                <p><b><font color="red"><span style="font-size:16pt;">각 업체</span></font><span style="font-size:18;"><font color="black">와</font></span></b><span style="font-size:22;"> </span><b><font color="red"><span style="font-size:16pt;">상담</span></font><span style="font-size:18;"><font color="black">하시면</font></span></b><span style="font-size:22;"> </span><b><font color="red"><span style="font-size:16pt;">직 거래</span></font><span
                            style="font-size:18;"><font color="black">가</font></span></b><span style="font-size:22;"> </span><b><font color=""><span style="font-size:16pt;">이루어</span></font></b><span style="font-size:22;"><b></b></span><b><span style="font-size:20;">집니다</span></b><br><br>
                <b> <span style="font-size:24;"> </span><span style="font-size:16pt;">상담</span></font><font color="black"><span style="font-size:14pt;">, </span></font><font color="red"><span style="font-size:16pt;">예약</span></font></b><span style="font-size:18;"><b><font color="black">은</font> </b></span><b><font color="red"><span style="font-size:16pt;">1688-2404</span></font></b></p>
                <p>&nbsp;</p>
            </div>
        </div>
<!-- 2011/11/17 수정 끝 -->
<p style="margin:5px 0px 5px 0px">
<table width="992" height="" bgcolor="#ffffff" border="0" align="center" cellspacing="0" cellpadding="0">
<tr>
 <td width="140" height="150" align="left"><a href="/main/stu_mov.html" onfocus="this.blur()" target="_top">
 <img src="../images/stu.jpg" border="0"></a></td>
 <td width="154" height="150" align="center"><a href="/main/yd_mov.html" onfocus="this.blur()" target="_top">
 <img src="../images/yda.jpg" border="0"></a></td>
 <td width="154" height="150" align="center"><a href="/main/room_mov.html" onfocus="this.blur()" target="_top">
 <img src="../images/one.jpg" border="0"></a></td>
 <td width="154" height="150" align="center"><a href="/main/gen_mov.html" onfocus="this.blur()" target="_top">
 <img src="../images/gen.jpg" border="0"></a></td>
 <td width="154" height="150" align="center"><a href="/main/pack_mov.html" onfocus="this.blur()" target="_top">
 <img src="../images/pac.jpg" border="0"></a></td>
 <td width="154" height="150" align="center"><a href="/main/off_mov.html" onfocus="this.blur()" target="_top">
 <img src="../images/off.jpg" border="0"></a></td>
 <td width="140" height="150" align="right"><a href="/main/kee_mov.html" onfocus="this.blur()" target="_top">
 <img src="../images/kee.jpg" border="0"></a></td>
</tr>
</table>
</p>
          <table width="994" bgcolor="#8af99d"  border="0" align="center" cellspacing="0" cellpadding="0">
             <tr>
                <td width="300" align="center" valign="middle"><img src="../images/logo_02.gif"></td>
                <td width="540" height="90"  align="left">
                     <font face="굴림"  size="2">
                    용달코리아 &nbsp; 관허4-42 &nbsp; 사업자 등록번호 206-01-76008  <br>
                    (133-752) &nbsp; 서울특별시 성동구 마장로42길 14 (마장동, 세림상가 301호)  <br>
                     Copyright(c) 2004 http://www.ydkorea.co.kr Allright reserved  TEL : 1688-2404</font>
                </td>
                <td width="136" align="left" valign="middle">
                     &nbsp;
                </td>
            </tr>
		</table>
		<table>
            <tr>
				<td width="100%" height="9"></td>
            </tr>
            </table>
       
        <!--- count program 시작입니다 --->
        <?php
        //지우지 마세요 count프로그램 입니다.
        $remote_addr = $_SERVER['REMOTE_ADDR'] ?? '';
        $http_referer = $_SERVER['HTTP_REFERER'] ?? '';
        $remote_addr_esc = mysqli_real_escape_string($connect, $remote_addr);
        $http_referer_esc = mysqli_real_escape_string($connect, $http_referer);
        $today = date("Y-m-d");

        $sql = "select acn_id from counter where substring(acn_datetime, 1, 10) = '$today' and acn_ip = '$remote_addr_esc'";
        $c_res = mysqli_query($connect, $sql);
        if ($c_res && mysqli_num_rows($c_res) < 1) {
            $sql = "insert into counter values ('', now(), '$remote_addr_esc', '$http_referer_esc')";
            mysqli_query($connect, $sql);
        }
        ?>
		<body oncontextmenu="return false" ondragstart="return false" onselectstart="return false">

<!-- naver 공통 적용 스크립트 (웹)  -->  
<script type="text/javascript" src="//wcs.naver.net/wcslog.js"> </script> 
<script type="text/javascript"> 
if (!wcs_add) var wcs_add={};
wcs_add["wa"] = "s_2cb6a2ac0ff9";
if (!_nasa) var _nasa={};
if(window.wcs){
wcs.inflow();
wcs_do(_nasa);
}
</script>
<!-- naver 공통 적용 스크립트 end (웹)  -->


<!-- Smartlog 스마트 로그 -->
<script type="text/javascript"> 
    var hpt_info={'_account':'UHPT-16768'};
</script>
<script language="javascript" src="//a22.smlog.co.kr/smart.js" charset="utf-8"></script>
<noscript><img src="//a22.smlog.co.kr/smart_bda.php?_account=16768" style="display:none;width:0;height:0;" border="0"/></noscript>
    </body>
</html>

