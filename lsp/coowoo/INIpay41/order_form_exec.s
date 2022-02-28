<?

require_once "../../include/include.php";

// SMS 서비스 모듈
require_once "../../sms/common/suremcfg.php";
require_once "../../sms/common/common.php";

html_cache_disable();

$CSiteUid	= request( 'CSiteUid' , 'cookie' );
$CUserID	= request( 'CUserID' , 'cookie' );

$pgid		= request( 'pgid' , 'post' );
$mid			= request( 'mid' , 'post' );
$uid			= request( 'uid' , 'post' );
$goodname	= request( 'goodname' , 'post' );
$currency	 	= request( 'currency' , 'post' );
$price		= request( 'price' , 'post' );
$buyername	= request( 'buyername' , 'post' );
$buyertel		= request( 'buyertel' , 'post' );
$buyeremail	= request( 'buyeremail', 'post' );
$paymethod	= request( 'paymethod', 'post' );
$encrypted	= request( 'encrypted' , 'post' );
$sessionkey	= request( 'sessionkey' , 'post' );
$cardcode	= request( 'cardcode' , 'post' );
$parentemail	= request( 'parentemail' , 'post' );
$useopt		= request( 'useopt' , 'post' );



// 이니시스 라이브러리
require("INIpay41Lib.php");
$inipay = new INIpay41;

$inipay->m_inipayHome = "/home/coowoo/www/INIpay41"; // 이니페이 홈디렉터리
$inipay->m_type = "securepay"; // 고정
$inipay->m_pgId = "INIpay".$pgid; // 고정
$inipay->m_subPgIp = "203.238.3.10"; // 고정
$inipay->m_keyPw = "1111"; // 키패스워드(상점아이디에 따라 변경)
$inipay->m_debug = "true"; // 로그모드("true"로 설정하면 상세로그가 생성됨.)
$inipay->m_mid = $mid; // 상점아이디
$inipay->m_uid = $uid; // INIpay User ID
$inipay->m_uip = getenv("REMOTE_ADDR"); // 고정
$inipay->m_goodName = $goodname;
$inipay->m_currency = $currency;
$inipay->m_price = $price;
$inipay->m_buyerName = $buyername;
$inipay->m_buyerTel = $buyertel;
$inipay->m_buyerEmail = $buyeremail;
$inipay->m_payMethod = $paymethod;
$inipay->m_encrypted = $encrypted;
$inipay->m_sessionKey = $sessionkey;
$inipay->m_url = "http://www.coowoo.com"; // 실제 서비스되는 상점 SITE URL로 변경할것
$inipay->m_cardcode = $cardcode; // 카드코드 리턴
$inipay->m_ParentEmail = $parentemail; // 보호자 이메일 주소(핸드폰 , 전화결제시에 14세 미만의 고객이 결제하면  부모 이메일로 결제 내용통보 의무, 다른결제 수단 사용시에 삭제 가능)

$inipay->m_useopt = $useopt;	// 현금영수증 요청 유무  추가

if ( $inipay->m_useopt == '0' )
{
	$useopt = 'income';
}
elseif ( $inipay->m_useopt == '1' )
{
	$useopt = 'expenses';
}

else
{
	$useopt = 'none';
}


$inipay->startAction();

$order_no		= trim( request( 'oid' , 'post' ) );
$rcv_user_name	= trim( request( 'rcv_user_name' , 'post' ) );
$rcv_postcode		= trim( request( 'rcv_postcode' , 'post' ) );
$rcv_address1		= addslashes( trim( request( 'rcv_address1' , 'post' ) ) );
$rcv_address2 	= addslashes( trim( request( 'rcv_address2' , 'post' ) ) );
$rcv_telephone1	= trim( request( 'rcv_telephone1' , 'post' ) );
$rcv_telephone2	= trim( request( 'rcv_telephone2' , 'post' ) );
$rcv_telephone3	= trim( request( 'rcv_telephone3' , 'post' ) );
$rcv_extension	= trim( request( 'rcv_extension', 'post' ) );
$rcv_handphone1	= trim( request( 'rcv_handphone1' , 'post' ) );
$rcv_handphone2	= trim( request( 'rcv_handphone2' , 'post' ) );
$rcv_handphone3	= trim( request( 'rcv_handphone3' , 'post' ) );
$rcv_email		= trim( request( 'rcv_email' , 'post' ) );
$delivery_code		= trim( request( 'delivery_code' , 'post' ) );
$memo			= trim( request( 'memo' , 'post' ) );

// 세금계산서
$company_reg_no	= trim( request( 'company_reg_no', 'post' ) );
$company_name	= trim( request( 'company_name', 'post' ) );
$owner_name		= trim( request( 'owner_name', 'post' ) );
$company_address = trim( request( 'company_address', 'post' ) );
$company_type	= trim( request( 'company_type', 'post' ) );
$company_item	= trim( request( 'company_item', 'post' ) );

$total_sell_price	= request( 'total_sell_price', 'post' );
$use_mileage		= request( 'use_mileage', 'post' );

$total_sell_price = (int)( $total_sell_price / 10 ) * 10;

$rcv_telephone = '';
if( $rcv_telephone1 )
{
	$rcv_telephone = "{$rcv_telephone1}-{$rcv_telephone2}-{$rcv_telephone3}";
}

$rcv_handphone = '';
if( $rcv_handphone1 )
{
	$rcv_handphone = "{$rcv_handphone1}-{$rcv_handphone2}-{$rcv_handphone3}";
}


$receipt_status = 'No';
$delivery_status = 'No';

$payment_etc = '';
if( 'Card' == $inipay->m_payMethod OR 'VCard' == $inipay->m_payMethod )
{
	if( $inipay->m_resultCode == "00" )
	{
		$receipt_status = 'Yes';
		$payment_etc = "승인번호 : " . $inipay->m_authCode;

		switch( $inipay->m_cardCode )
		{
			case '01'   : $card_company = "외환"; break;
			case '03'   : $card_company = "롯데"; break;
			case '04'   : $card_company = "현대"; break;
			case '06'   : $card_company = "국민"; break;
			case '011' : $card_company = "BC"; break;
			case '012' : $card_company = "삼성"; break;
			case '013' : $card_company = "LG"; break;
			case '014' : $card_company = "신한"; break;
			default : $cart_company = "Code : " . $inipay->m_cardCode;
		}

		$payment_etc .= "<br>카드사 : " . $card_company;
		if( 'VCard' == $inipay->m_payMethod ) $payment_etc .= " (ISP)";

		$receipt_status = 'Yes';

		$url_option = "tid=" . $inipay->m_tid . "&payMethod=" . $inipay->m_payMethod . "&authCode=" . $inipay->m_authCode . "&cardCompany=" . $card_company;

	}
	else
	{
		$payment_etc .= "카드결제 실패 (" . $inipay->m_ResultMsg . ")";
	}
	$payment = "신용카드";

}
if( 'DirectBank' == $inipay->m_payMethod )
{
	if( $inipay->m_resultCode == "00" )
	{	
		$receipt_status = 'Yes';
		$payment_etc = "실시간 계좌 이체 성공";
	}
	else
	{
		$payment_etc .= "실시간 계좌 이체 실패 (" . $inipay->m_ResultMsg . ")";
	}

	$payment = "실시간계좌이체";
}
if( 'VBank' == $inipay->m_payMethod )
{
	$payment = "무통장입금";

	switch( $inipay->m_vcdbank )
	{
		case '04' : $bank = "국민은행"; break;
		case '05' : $bank = "외환은행"; break;
		case '11' : $bank = "농협"; break;
		case '20' : $bank = "우리은행"; break;
		case '21' : $bank = "조흥은행"; break;
		case '26' : $bank = "신한은행"; break;
		case '81' : $bank = "하나은행"; break;
		case '88' : $bank = "신한은행"; break;
	}

	$payment_etc = "입금은행 : " . $bank;
	$payment_etc .= "<br>계좌번호 : " . $inipay->m_vacct;
	$payment_etc .= "<br>입금자명 : " . $inipay->m_nminput;
	$payment_etc .= "<br>입금예정일 : " . $inipay->m_dtinput;

	$url_option = "tid=" . $inipay->m_tid . "&payMethod=" . $inipay->m_payMethod . "&bank=" . $bank . "&vacct=" . $inipay->m_vacct . "&dtinput=" . $inipay->m_dtinput . "&nminput=" . $inipay->m_nminput;

}

if( '00' != $inipay->m_resultCode ) 
{

?>

<html>
<head>
<title>결제 에러페이지</title>
<link rel="stylesheet" href="../css/style.css" type="text/css">
<script language=javascript>
	var openwin=window.open("childwin.html","childwin","width=300,height=160");
	openwin.close();
</script>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<? require_once "../top.html" ?>

<!------------------ 메인 시작  ------------------------->
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td width="835" background="images/search_bg2.gif">
	  <table width="835" height="528" border="0" cellpadding="0" cellspacing="0">
        <tr> 
          <td height="54" colspan="5"><img src="images/title.gif" width="835" height="54"></td>
        </tr>
        <tr> 
          <td colspan="3" align="center" valign="top"><br>
            <br>
            <table width="385" height="169" border="0" cellpadding="0" cellspacing="0" background="images/error_bg.gif">
              <tr>
                <td align="right" valign="bottom"><table width="62%" height="70" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td valign="top" style="padding-right:5pt"><b><?=$inipay->m_resultMsg?></b></td>
                    </tr>
                  </table></td>
              </tr>
            </table>
            <table width="385" border="0" cellspacing="5" cellpadding="0">
              <tr>
                <td height="35" align="right" valign="bottom"><!-- 버튼 --><a href="#"><img src="images/btn_back.gif" width="240" height="25" border=0 onClick="history.back()"></a></td>
              </tr>
            </table></tr>
        <tr> 
          <td height="35" colspan="5" background="images/search_bottom3.gif">&nbsp;</td>
        </tr>
      </table>
	</td>
    <td bgcolor="#E2DFD8">&nbsp;</td>
  </tr>
</table>
<!------------------------------ 메인 끝 --------------------------------->

<? require_once "../bottom.html" ?>

</body>
</html>

<?

}

$db = new MYSQL;
$db2 = new MYSQL;



// 주문정보 저장
$query = "
				INSERT INTO order_info		(	
											order_no ,
											tid ,
											useopt ,
											user_id ,
											rcv_user_name ,
											rcv_postcode ,
											rcv_address1 ,
											rcv_address2 ,
											rcv_telephone ,
											rcv_extension ,
											rcv_handphone ,
											rcv_email ,
											delivery_code ,
											memo ,
											total_sell_price ,
											payment ,
											payment_etc ,
											use_mileage ,
											reg_date ,
											delivery_date ,
											order_class ,
											receipt_status ,
											delivery_status ,
											cancel_status ,
											use_status
										)
										VALUES
										(	
											'$order_no' ,
											'$inipay->m_tid' ,
											'$useopt' ,
											'$CUserID' ,
											'$rcv_user_name' ,
											'$rcv_postcode' ,
											'$rcv_address1' ,
											'$rcv_address2' ,
											'$rcv_telephone' ,
											'$rcv_extension' ,
											'$rcv_handphone' ,
											'$rcv_email' ,
											'$delivery_code' ,
											'$memo' ,
											'$total_sell_price' ,
											'$payment' ,
											'$payment_etc' ,
											'$use_mileage' ,
											now() ,
											'' ,
											'Online' ,
											'$receipt_status' ,
											'$delivery_status' ,
											'No' ,
											'Yes'
										)
";

$db->query( $query );

// 세금계산서
$query = "
			INSERT INTO tax_bill (
								tax_bill_no ,
								company_reg_no ,
								company_name ,
								owner_name ,
								company_address ,
								company_type ,
								company_item ,
								order_no ,
								reg_date
							)
							VALUES
							(
								NULL ,
								'$company_reg_no' ,
								'$company_name' ,
								'$owner_name' ,
								'$company_address' ,
								'$company_type' ,
								'$company_item' ,
								'$order_no' ,
								now()
							)
";
$db->query( $query );


// 장바구니 정보 -> 주문상품 정보
$query = "
				SELECT	product_class ,
						product_order_no ,
						product_no ,
						folder_no ,
						original_sell_price ,
						sell_price ,
						discount_rate ,
						discount_price ,
						mileage_rate ,
						mileage_price ,
						cp_discount_rate ,
						cp_discount_price ,
						cp_mileage_rate ,
						cp_mileage_price ,
						quantity ,
						coupon_no ,
						manufacture_code ,
						rm_title ,
						rm_sponsor ,
						rm_usage
				FROM	cart_info
				WHERE	cart_uid = '$CSiteUid'
";
$db->query( $query );

$cd_sell_status = 'No';
for( $loop=0; $loop<$db->total_record(); $loop++ )
{
	$db->fetch();

	$rs_product_class		= $db->result( 'product_class' );
	$rs_product_order_no	= $db->result( 'product_order_no' );
	$rs_product_no		= $db->result( 'product_no' );
	$rs_folder_no			= $db->result( 'folder_no' );
	$rs_original_sell_price	= $db->result( 'original_sell_price' );
	$rs_sell_price			= $db->result( 'sell_price' );
	$rs_discount_rate		= $db->result( 'discount_rate' );
	$rs_discount_price		= $db->result( 'discount_price' );
	$rs_mileage_rate		= $db->result( 'mileage_rate' );
	$rs_mileage_price		= $db->result( 'mileage_price' );
	$rs_cp_discount_rate	= $db->result( 'cp_discount_rate' );
	$rs_cp_discount_price	= $db->result( 'cp_discount_price' );
	$rs_cp_mileage_rate	= $db->result( 'cp_mileage_rate' );
	$rs_cp_mileage_price	= $db->result( 'cp_mileage_price' );
	$rs_quantity			= $db->result( 'quantity' );
	$rs_coupon_no		= $db->result( 'coupon_no' );
	$rs_rm_title			= $db->result( 'rm_title' );
	$rs_rm_sponsor		= $db->result( 'rm_sponsor' );
	$rs_rm_usage			= $db->result( 'rm_usage' );
	$rs_manufacture_code	= $db->result( 'manufacture_code' );

	@mkdir( "/home/coowoo/www/home/mypage/download/" . $CUserID );

	if( 'single' == $rs_product_class ) 
	{
		
		$key1 = "S";

	}

	if( 'cd' == $rs_product_class ) 
	{
		$key1 = "D";
		$cd_sell_status = 'Yes';
	}
	if( 'vcd' == $rs_product_class ) $key1 = "V";
	$key1 .= sprintf( "%03d", rand( 1, 999 ) );

	$c = 0;
	while(1)
	{

		$key2 = my_random_string( 6, 3 );

		$license_key = "{$key1}-{$key2}";

		$query2 = "SELECT * FROM order_product WHERE license_key = '$license_key'";
		$db2->query( $query2 );

		if( !$db2->total_record() AND ++$c < 1000 ) break; 
	}

	// 쿠폰 사용 제품 판매가 업데이트
	if( $rs_cp_discount_rate )
	{
		$sell_price = $rs_sell_price - ( $rs_sell_price / 100 ) * $rs_cp_discount_rate;
	}
	elseif( $rs_cp_discount_price )
	{
		$sell_price = $rs_sell_price - $rs_cp_discount_price;
	}
	else
	{
		$sell_price = $rs_sell_price;
	}

	$query2= "
			INSERT INTO order_product	(
										order_no ,
										product_class ,
										product_order_no ,
										product_no ,
										manufacture_code ,
										folder_no ,
										original_sell_price ,
										sell_price ,
										discount_rate ,
										discount_price ,
										mileage_rate ,
										mileage_price ,
										cp_discount_rate ,
										cp_discount_price ,
										cp_mileage_rate ,
										cp_mileage_price ,
										quantity ,
										coupon_no ,
										rm_title ,
										rm_sponsor ,
										rm_usage ,
										license_key ,
										datacraft_resultkey ,
										datacraft_image_name
									)
									VALUES
									(
										'$order_no' ,
										'$rs_product_class' ,
										'$rs_product_order_no' ,
										'$rs_product_no' ,
										'$rs_manufacture_code' ,
										'$rs_folder_no' ,
										'$rs_original_sell_price' ,
										'$sell_price' ,
										'$rs_discount_rate' ,
										'$rs_discount_price' ,
										'$rs_mileage_rate' ,
										'$rs_mileage_price' ,
										'$rs_cp_discount_rate' ,
										'$rs_cp_discount_price' ,
										'$rs_cp_mileage_rate' ,
										'$rs_cp_mileage_price' ,
										'$rs_quantity' ,
										'$rs_coupon_no' ,
										'$rs_rm_title' ,
										'$rs_rm_sponsor' ,
										'$rs_rm_usage' ,
										'$license_key' ,
										'$datacraft_resultkey' ,
										'$datacraft_image_name'
									)
	";
	$db2->query( $query2 );

	if( 'single' == $rs_product_class ) 
	{
		
		$image_no = $rs_product_no;
		$folder_no = $rs_folder_no;

		$query2 = "
					SELECT	image_name ,
							single_order_no
					FROM	product_images
					WHERE	image_no = '$image_no'									
		";
		$db2->query( $query2 );
		$db2->fetch();

		$rs_image_name		= $db2->result( 'image_name' );
		$rs_single_order_no	= $db2->result( 'single_order_no' );


		image_request( $CUserID, $rs_single_order_no, $folder_no );

		// 데이터크래프트 구매키 받아오기
		if( '035' == $rs_manufacture_code )
		{

			$temp = explode( "." , $rs_image_name );
			$image = $temp[0];

			if( '565' == $rs_folder_no OR '569' == $rs_folder_no OR '572' == $rs_folder_no ) $image .= "_72A";
			if( '566' == $rs_folder_no OR '570' == $rs_folder_no OR '573' == $rs_folder_no ) $image .= "_350A";
			if( '567' == $rs_folder_no OR '571' == $rs_folder_no ) $image .= "_350B";
			if( '568' == $rs_folder_no ) $image .= "_350D";
				
			$rtn = '';
			$fp = fopen( "http://www.datacraft-kr.com/DefaultJsp/SetReservation.jsp?IID={$image}&VID=289&UID=289", "r" );
			if( $fp )
			{
				while( !feof( $fp ) ) $rtn .= fgets( $fp , 4096 );
			}
			$rtn = trim( $rtn );
		
			$query = "
					UPDATE order_product	SET		datacraft_resultkey = '$rtn' ,
												datacraft_image_name = '$image'
					WHERE	order_no = '$order_no'
					AND		product_no = '$rs_product_no'
			";
			$db2->query( $query );

		}


	}


	// 사용쿠폰 삭제
	$query2 = "
			SELECT		cp.publish_no
			FROM		coupon.coupon_publish_info as cpi
			LEFT JOIN		coupon.coupon_publish as cp
			ON			cpi.publish_no = cp.publish_no
			WHERE		cp.coupon_no = '$rs_coupon_no'
			AND			cpi.user_id = '$CUserID'
	";
	$db2->query( $query2 );
	$db2->fetch();
	$rs_publish_no	= $db2->result( 'publish_no' );

	$query2 = "
			DELETE FROM coupon.coupon_publish_info WHERE publish_no = '$rs_publish_no' AND user_id = '$CUserID'
	";
	$db2->query( $query2 );

}

// VCD & SINGLE인 경우 배송과 적립금 처리...
if( 'No' == $cd_sell_status AND 'Yes' == $receipt_status )
{

	$query = "
					UPDATE order_info SET receipt_status = 'Yes', delivery_status = 'Yes' WHERE order_no = '$order_no'
	";
	$db->query( $query );

	$query = "
					SELECT	sum( sell_price ) as sell_price ,
								sum( ( sell_price / 1.1 / 100 ) * mileage_rate ) as mileage
					FROM	order_product
					WHERE	order_no = '$order_no'
					GROUP BY order_no 
	";
	$db2->query( $query );
	$db2->fetch();

	$rs_sell_price = $db2->result( 'sell_price' );
	$rs_mileage = (int)$db2->result( 'mileage' );


	if( $rs_mileage )
	{

		$query = "
						INSERT INTO mileage_log VALUES ( NULL , '$rs_mileage', '구매제품에 따른 쿠우머니' , now(), '$CUserID' , '$order_no' )
		";
		$db->query( $query );
		$query = "
						UPDATE user_info SET mileage = mileage + $rs_mileage WHERE user_id = '$CUserID'
		";
		$db->query( $query );

	}

}


if( $use_mileage )
{
	$query = "
					INSERT INTO mileage_log VALUES ( NULL , '-{$use_mileage}', '제품구매시 사용' , now(), '$CUserID' , '$order_no' )
	";
	$db->query( $query );
	$query = "
					UPDATE user_info SET mileage = mileage - $use_mileage WHERE user_id = '$CUserID'
	";
	$db->query( $query );

}


// 주문등록 SMS 문자메세지 발송 (관리자)

$sms = new SuremPacket;

$query = "
			SELECT ui.user_id, ui.user_name, oi.receipt_status, oi.delivery_status, DATE_FORMAT( oi.reg_date, '%c월%e일' ) as order_date FROM order_info as oi, user_info as ui WHERE oi.user_id = ui.user_id AND order_no = '$order_no'
";
$db->query( $query );
$db->fetch();
$rs_user_id			= $db->result( 'user_id' );
$rs_user_name		= $db->result( 'user_name' );
$rs_receipt_status		= $db->result( 'receipt_status' );
$rs_delivery_status		= $db->result( 'delivery_status' );
$rs_order_date		= $db->result( 'order_date' );

if( 'Yes' == $SERVER_CONFIG['sms_use' ] )
{

	$name = "{$rs_user_name}({$rs_user_id})";

	if( 'Yes' == $rs_delivery_status ) $order_status = "완료주문";
	elseif( 'Yes' == $rs_receipt_status ) $order_status = "입금완료";
	else $order_status = "입금준비중";

	$message = "이미지쿠우 주문등록 / $name / $order_no / " . number_format( $total_sell_price ) . "원 / $order_status";

	$result = $sms->sendsms( 0 , "011" , "9715", "2772" , $message, "00000000", "000000", "02", "2285" , "1375" , "이미지쿠우" );
	$result = $sms->sendsms( 0 , "016" , "274", "3138" , $message, "00000000", "000000", "02", "2285" , "1375" , "이미지쿠우" );
	$result = $sms->sendsms( 0 , "011" , "9873", "6227" , $message, "00000000", "000000", "02", "2285" , "1375" , "이미지쿠우" );
	$result = $sms->sendsms( 0 , "010" , "6292", "2174" , $message, "00000000", "000000", "02", "2285" , "1375" , "이미지쿠우" );
	$result = $sms->sendsms( 0 , "011" , "792", "5626" , $message, "00000000", "000000", "02", "2285" , "1375" , "이미지쿠우" );
	$result = $sms->sendsms( 0 , "010" , "8842", "8411" , $message, "00000000", "000000", "02", "2285" , "1375" , "이미지쿠우" );

	// 주문접수 SMS 문자메세지 발송 (고객)

	if( $rcv_handphone1 )
	{
		$handphone[0] = $rcv_handphone1;
		$handphone[1] = $rcv_handphone2;
		$handphone[2] = $rcv_handphone3;
	}
	else
	{
		$query = "
				SELECT	handphone
				FROM	user_info
				WHERE	user_id = '$rs_user_id'
		";
		$db->query( $query );
		$db->fetch();
		$rs_handphone = $db->result( 'handphone' );

		$handphone = explode( "-" , $rs_handphone );

	}

	if( count( $handphone ) == 3 )
	{

		$query = "
				SELECT	order_sms
				FROM	order_info
				WHERE	order_no = '$order_no'
		";
		$db->query( $query );
		$db->fetch();
		$rs_order_sms = $db->result( 'order_sms' );

		if( 'No' == $rs_order_sms )
		{
			$message = "{$rs_user_name}고객님 {$rs_order_date} 주문이 접수되었습니다. 건강한 하루 되세요 / 이미지쿠우";
			$result = $sms->sendsms( 0 , $handphone[0] , $handphone[1], $handphone[2] , $message, "00000000", "000000", "02", "2285" , "1375" , "이미지쿠우" );

			$query = "
					UPDATE order_info	SET		order_sms = 'Yes'
									WHERE	order_no = '$order_no'
			";
			$db->query( $query );

		}

	}

}

// 주문등록 이메일 발송
include "../mail/mail_order.html";

meta_go( "order_confirm.html?order_no={$order_no}&{$url_option}" );

?>
