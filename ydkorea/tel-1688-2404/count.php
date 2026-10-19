<?
$mysql_host = 'localhost';   // DB 호스트명 
$mysql_user = 'kch1414';   // DB 사용자 계정 
$mysql_pwd  = 'tlssoehd00';    // DB 사용자 패스워드 
$mysql_db   = 'kch1414';     // DB name 

function dbcon() {
global $mysql_host, $mysql_user, $mysql_pwd, $mysql_db;

  $connect = @mysql_connect($mysql_host, $mysql_user, $mysql_pwd) or die("mysql_connect Error!!! mysql 계정 또는 패스워드를 확인하세요.");
  @mysql_select_db($mysql_db, $connect) or die("mysql_select_db Error!!! mysql DB명을 확인하세요.");
}

// 항상 DataBase를 연결함
dbcon();



  if(trim($start_date) == "") $start_date = date("Y-m-01");
  if(trim($end_date) == "") $end_date = date("Y-m-d");
  

  $today = date("Y-m-d");

  ?>
  <link rel="stylesheet" type="text/css" href="dp_picker.css">
<link type="text/css" rel="stylesheet" href="date_picker.css">
<link type="text/css" rel="stylesheet" href="text.css">
<script language="javascript" src="date_picker.js"></script>
<script language="javascript">

function document_load()
{
}

var date_re = /^\d{4}-\d{2}-\d{2}$/;
function search_submit(f)
{
	if (!f.start_date.value.match(date_re))
	{
		alert('검색기간 시작 날짜를 정확하게 입력해 주십시오.\n\nYYYY-MM-DD 형식으로 입력해 주십시오.');
		f.start_date.focus();
		DP_OpenPicker(f.start_date);
		return false;
	}
	if (!f.end_date.value.match(date_re))
	{
		alert('검색기간 종료 날짜를 정확하게 입력해 주십시오.\n\nYYYY-MM-DD 형식으로 입력해 주십시오.');
		f.end_date.focus();
		DP_OpenPicker(f.end_date);
		return false;
	}

//	alert('전송했다치면');
	return true;
}

</script>
<body onload="document_load()">
<br><br>
	<!--  금일 방문자수 -->
    <table width=100% cellspacing=0 cellpadding=0><form name="search" action="#" method="GET" onsubmit="return search_submit(this)"><caption align=top><h2>방문자수 리스트</h2>
	&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" name="start_date" value="<? echo $start_date;?>" size="10" class="DateInput" AUTOCOMPLETE="off" onblur="DP_PickerInput_blur()"> ~
    <input type="text" name="end_date" value="<? echo $end_date;?>" size="10" class="DateInput" AUTOCOMPLETE="off" onblur="DP_PickerInput_blur()"> <input type="text" name="acn_text" value="<? echo $acn_text;?>" size=10>
    <input type=submit value='검색'>
</caption>
<input type=hidden name=j value='s'>
</form><tr><td height=5></td></tr></table>
	<center>
    <table width=200 border=0 cellpadding=0 cellspacing=0 class=st_border1>
    <tr>
      <th width=100% class=st_bgc_color>금일 <font color="#721875"><?=date("Y")?>년 <?=date("m")?>월 <?=date("d")?>일 </font></th>
    </tr>
    <tr>
      <td align=center>
        <table border=0 cellpadding=0 cellspacing=0 width=200>
        <?
          // 검색
          $acn_text = trim($acn_text);

          $sql = " select count(*) from counter where substring(acn_datetime, 1, 10) between '$start_date' and '$end_date' and acn_referer like '%$acn_text%'";
          $result = mysql_query($sql);
          if($result) $cm_count_ser = mysql_result($result, 0, 0);

          // 오늘
          $sql = " select count(acn_id) from counter where substring(acn_datetime, 1, 10) = '".date("Y-m-d")."' ";
          $result = mysql_query($sql);
          if($result) $cm_count_today = mysql_result($result, 0, 0);

		  // 어제
//          $sql = " select count(acn_id) from counter where substring(acn_datetime, 1, 10) = '".date("Y-m-d", time()-86400)."' ";
          $sql = " select count(acn_id) from counter where substring(acn_datetime, 1, 10) = '".date ("Y-m-d", mktime (0,0,0,date("m"),date("d")-1,date("Y")))."' ";
		  $result = mysql_query($sql);
          if($result) $cm_count_yesterday = mysql_result($result, 0, 0);

          // 전체
          $sql = " select count(acn_id) from counter ";
          $result = mysql_query($sql);
          if($result) $cm_count_total = mysql_result($result, 0, 0);

          // 최대
          $sql = " select substring(acn_datetime, 1, 10) as sub_acn_datetime , count(acn_id) as cnt_acn_id from counter group by sub_acn_datetime order by cnt_acn_id desc limit 0, 1  ";
          $result = mysql_query($sql);
          if($result) $cm_count_max = mysql_result($result, 0, 1);

          // 최소
          //$sql = " select substring(acn_datetime, 1, 10) as sub_acn_datetime , count(acn_id) as cnt_acn_id from counter where substring(acn_datetime, 1, 10) < '".date("Y-m-d")."' group by sub_acn_datetime order by cnt_acn_id limit 0, 1  ";
          //$result = mysql_query($sql);
          //$row = mysql_fetch_array($result);
          //if($result) $cm_count_min = number_format($row[1]);
        ?>
        <tr><td height=20 bgcolor='#A5D7FF'>&nbsp;<font size=1>■</font> 금일 : <? echo $cm_count_today ?> 명</td></tr>
        <tr><td height=20 >&nbsp;<font size=1>■</font> 전일 : <? echo $cm_count_yesterday ?> 명</td></tr>
        <tr><td height=20 bgcolor='#A5D7FF'>&nbsp;<font size=1>■</font> 전체 : <? echo $cm_count_total ?> 명</td></tr>
        <tr><td height=20 >&nbsp;<font size=1>■</font> 최대 : <? echo $cm_count_max ?> 명</td></tr>
        <tr><td height=20 bgcolor='#A5D7FF'>&nbsp;<font size=1>■</font> 검색결과 : <? echo $cm_count_ser ?> 명</td></tr>

        </table>
      </td>
    </tr>
    </table>

<?

 $to = ((100 / $cm_count_total) * ($cm_count_today));
$ye = ((100 / $cm_count_total) * $cm_count_yesterday);
$ser = ((100 / $cm_count_total) * $cm_count_ser);
//echo date ("Y-m-d", mktime (0,0,0,date("m"),date("d")-$i,date("Y")));
//echo ((100/$cm_count_total) * 0);
$tomot = '".date("M")."';
$toyear=  '".date("Y")."';
?>
	<table width='100%' border=0>
	<tr>
		<td height=50>
		</td>
	</tr>
	<tr>
		<td align=center>
<?
if($j==''){
?>
			<table width='600'  border='1' cellpadding=4 cellspacing=0 bordercolorlight='#000000' bordercolordark='#FFFFFF'>
				<tr>
					<td width='100' height=20 align=center class=st_bgc_title>금일</td>
					<td width='500' height=20><img src='./image/block.gif' width='<? echo (substr($to,0,3) * 4); ?>' height=10>&nbsp; <? echo substr($to,0,3); ?>%&nbsp; <? echo $cm_count_today ?>명</td>
				</tr>
				<tr>
					<td width='100' height=20 align=center class=st_bgc_title>전일</td>
					<td width='500' height=20><img src='./image/block.gif' width='<? echo (substr($ye,0,3) * 4); ?>' height=10>&nbsp; <? echo substr($ye,0,3); ?>%&nbsp; <? echo $cm_count_yesterday ?>명</td></td>
				</tr>
				<tr>
					<td width='100' height=20 align=center class=st_bgc_title>검색</td>
					<td width='500' height=20><img src='./image/block.gif' width='<? echo (substr($ser,0,3) * 4); ?>' height=10>&nbsp; <? echo substr($ser,0,3); ?>%&nbsp; <? echo $cm_count_ser ?>명</td></td>
				</tr>
				<tr>
					<td height=20 colspan=2 align=center><a href='?j=d&i_year=<? echo date("Y") ;?>&i_month=<? echo date("m") ;?>'>일별</a>&nbsp; <a href='?j=m&yy=<? echo date("Y") ;?>'>월별</a></td>
				</tr>
			</table>
<!--///////////////////////////////////////////
//    일별조건 시작                               //
///////////////////////////////////////////-->

<? }else if($j=='d'){ 
function Month_Day($i_month,$i_year){
	$day=1;
	while(checkdate($i_month,$day,$i_year)){
		$day++;
	}
		$day--;
		return $day;
}	

$str_str = Month_Day($i_month,$i_year);
	?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function aa(){
	document.for_day.submit();
}
//-->
</SCRIPT>
				<table width='600' border=0>
					<tr>
						<td><form name=for_day method=get action='count.php'>
			            <select name=i_year>
              <option value='2003'>년 도
              <option value='2003'>2003
              <option value='2004'>2004
              <option value='2005'>2005
              <option value='2006'>2006
              <option value='2007'>2007
              <option value='2008'>2008
              <option value='2009'>2009
              <option value='2010'>2010

            </select>

            <select name=i_month onchange="aa();" >
              <option value='<? echo $tomot ?>'>&nbsp;달&nbsp;
              <option value='1'>1월
              <option value='2'>2월
              <option value='3'>3월
              <option value='4'>4월
              <option value='5'>5월
              <option value='6'>6월
              <option value='7'>7월
			  <option value='8'>8월
              <option value='9'>9월
              <option value='10'>10월
              <option value='11'>11월
              <option value='12'>12월
            </select>
            <input type=hidden name=j value='d'>
          </form>
						</td>
					</tr>
				</table>
			<table width='600'  border='1' cellpadding=4 cellspacing=0 bordercolorlight='#000000' bordercolordark='#FFFFFF'>
				<tr>
					<td colspan=2 height=30 align=center class=st_bgc_title><b><? echo $i_year ?>년&nbsp;<? echo $i_month ?>월</b></td>
				</tr>

	<?
		$sql = " select count(acn_id) from counter where substring(acn_datetime, 1, 4) = $i_year and substring(acn_datetime, 6, 7) = $i_month ";
		$result = mysql_query($sql);
		if($result) $yearmot = mysql_result($result, 0, 0);

	$i = 1;
	while($i <= $str_str){
		  $sql = " select count(acn_id) from counter where substring(acn_datetime, 1, 4) = $i_year and substring(acn_datetime, 6, 7) = $i_month and substring(acn_datetime, 9, 10) = $i ";
			  $result = mysql_query($sql);
			  if($result) $motday = mysql_result($result, 0, 0);
		
	@$total = ((100 / $yearmot) * $motday);

				  ?>
				<tr>
					<td width='100' height=20 align=center class=st_bgc_title><? echo $i ?>일</td>
					<td width='500' height=20><img src='./image/block.gif' width='<? echo (substr($total,0,3) * 4); ?>' height=10>&nbsp; <? echo substr($total,0,3); ?>%&nbsp; <? echo $motday ?>명</td>
				</tr>
	<? 
$i++;					  
				  } ?>
					<td height=20 colspan=2 align=center><a href='?j=d&i_year=<? echo date("Y") ;?>&i_month=<? echo date("m") ;?>'> 일별</a>&nbsp; <a href='?j=m&yy=<? echo date("Y") ;?>'>월별</td>
				</tr>
			</table>
<!--///////////////////////////////////////////
//    월별조건 시작                               //
///////////////////////////////////////////-->

<? }else if($j=='m'){ 

	?>
<SCRIPT LANGUAGE="JavaScript">
<!--
function gg(){
	document.for_mot.submit();
}
//-->
</SCRIPT>
				<table width='600' border=0>
					<tr>
						<td><form name=for_mot method=get action='count.php'>
            <select name=yy onchange="gg();" >
              <option value='2003'>년 도
              <option value='2003'>2003
              <option value='2004'>2004
              <option value='2005'>2005
              <option value='2006'>2006
              <option value='2007'>2007
              <option value='2008'>2008
              <option value='2009'>2009
              <option value='2010'>2010

            </select>
            <input type=hidden name=j value='m'>
          </form>
						</td>
					</tr>
				</table>
				<table width='600'  border='1' cellpadding=4 cellspacing=0 bordercolorlight='#000000' bordercolordark='#FFFFFF'>
					<tr>
						<td colspan=2 height=30 align=center class=st_bgc_title><b><? echo $yy ?>년</b></td>
					</tr>

	<?

		$sql = " select count(acn_id) from counter where substring(acn_datetime, 1, 4) = $yy ";
		$result = mysql_query($sql);
		if($result) $year = mysql_result($result, 0, 0);

	$i = 1;
	while($i < 13){
			  $sql = " select count(acn_id) from counter where substring(acn_datetime, 6, 7) = $i and substring(acn_datetime, 1, 4) = $yy";
			  $result = mysql_query($sql);
			  if($result) $cm_count_mot = mysql_result($result, 0, 0);
		
	@$total = ((100 / $year) * $cm_count_mot);
	?>
					<tr>
						<td width='100' height=20 align=center class=st_bgc_title><? echo $i ?>월</td>
						<td width='500' height=20><img src='./image/block.gif' width='<? echo (substr($total,0,3) * 4); ?>' height=10>&nbsp; <? echo substr($total,0,3); ?>%&nbsp; <? echo $cm_count_mot ?>명</td>
					</tr>
	<?
	$i++;	
	} ?>
					<tr>
						<td height=20 colspan=2 align=center><a href='?j=d&i_year=<? echo date("Y") ;?>&i_month=<? echo date("m") ;?>'> 일별</a>&nbsp; <a href='?j=m&yy=<? echo date("Y") ;?>'>월별</td>
					</tr>
				</table>

<!--///////////////////////////////////////////
//    검색조건 시작                               //
///////////////////////////////////////////-->

<? }else if($j=='s'){ ?>
			<table width='600'  border='1' cellpadding=4 cellspacing=0 bordercolorlight='#000000' bordercolordark='#FFFFFF'>
				<tr>
					<td colspan=2 height=30 align=center class=st_bgc_title><b><? echo "$start_date 부터 $end_date 까지&nbsp;";
if(!$acn_text=="")echo "<br>$acn_text 이용"; ?> 방문자</b></td>
				</tr>
				<tr>
					<td width='100' height=20 align=center class=st_bgc_title>검색</td>
					<td width='500' height=20><img src='./image/block.gif' width='<? echo (substr($ser,0,3) * 4); ?>' height=10>&nbsp; <? echo substr($ser,0,3); ?>%&nbsp; <? echo $cm_count_ser ?>명</td></td>
				</tr>
				<tr>
					<td height=20 colspan=2 align=center><a href='?j=d&i_year=<? echo date("Y") ;?>&i_month=<? echo date("m") ;?>'> 일별</a>&nbsp; <a href='?j=m&yy=<? echo date("Y") ;?>'>월별</td>
				</tr>
			</table>

<? } ?>
		</td>
	</tr>
	</table>
	<script language="javascript">
DP_InitPicker();
</script>
    <!--//  금일 방문자수 -->
