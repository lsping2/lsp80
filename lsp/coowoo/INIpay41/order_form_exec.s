<?

require_once "../../include/include.php";

// SMS ���� ���
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



// �̴Ͻý� ���̺귯��
require("INIpay41Lib.php");
$inipay = new INIpay41;

$inipay->m_inipayHome = "/home/coowoo/www/INIpay41"; // �̴����� Ȩ���͸�
$inipay->m_type = "securepay"; // ����
$inipay->m_pgId = "INIpay".$pgid; // ����
$inipay->m_subPgIp = "203.238.3.10"; // ����
$inipay->m_keyPw = "1111"; // Ű�н�����(�������̵� ���� ����)
$inipay->m_debug = "true"; // �α׸��("true"�� �����ϸ� �󼼷αװ� ������.)
$inipay->m_mid = $mid; // �������̵�
$inipay->m_uid = $uid; // INIpay User ID
$inipay->m_uip = getenv("REMOTE_ADDR"); // ����
$inipay->m_goodName = $goodname;
$inipay->m_currency = $currency;
$inipay->m_price = $price;
$inipay->m_buyerName = $buyername;
$inipay->m_buyerTel = $buyertel;
$inipay->m_buyerEmail = $buyeremail;
$inipay->m_payMethod = $paymethod;
$inipay->m_encrypted = $encrypted;
$inipay->m_sessionKey = $sessionkey;
$inipay->m_url = "http://www.coowoo.com"; // ���� ���񽺵Ǵ� ���� SITE URL�� �����Ұ�
$inipay->m_cardcode = $cardcode; // ī���ڵ� ����
$inipay->m_ParentEmail = $parentemail; // ��ȣ�� �̸��� �ּ�(�ڵ��� , ��ȭ�����ÿ� 14�� �̸��� ���� �����ϸ�  �θ� �̸��Ϸ� ���� �����뺸 �ǹ�, �ٸ����� ���� ���ÿ� ���� ����)

$inipay->m_useopt = $useopt;	// ���ݿ����� ��û ����  �߰�

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

// ���ݰ�꼭
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
		$payment_etc = "���ι�ȣ : " . $inipay->m_authCode;

		switch( $inipay->m_cardCode )
		{
			case '01'   : $card_company = "��ȯ"; break;
			case '03'   : $card_company = "�Ե�"; break;
			case '04'   : $card_company = "����"; break;
			case '06'   : $card_company = "����"; break;
			case '011' : $card_company = "BC"; break;
			case '012' : $card_company = "�Ｚ"; break;
			case '013' : $card_company = "LG"; break;
			case '014' : $card_company = "����"; break;
			default : $cart_company = "Code : " . $inipay->m_cardCode;
		}

		$payment_etc .= "<br>ī��� : " . $card_company;
		if( 'VCard' == $inipay->m_payMethod ) $payment_etc .= " (ISP)";

		$receipt_status = 'Yes';

		$url_option = "tid=" . $inipay->m_tid . "&payMethod=" . $inipay->m_payMethod . "&authCode=" . $inipay->m_authCode . "&cardCompany=" . $card_company;

	}
	else
	{
		$payment_etc .= "ī����� ���� (" . $inipay->m_ResultMsg . ")";
	}
	$payment = "�ſ�ī��";

}
if( 'DirectBank' == $inipay->m_payMethod )
{
	if( $inipay->m_resultCode == "00" )
	{	
		$receipt_status = 'Yes';
		$payment_etc = "�ǽð� ���� ��ü ����";
	}
	else
	{
		$payment_etc .= "�ǽð� ���� ��ü ���� (" . $inipay->m_ResultMsg . ")";
	}

	$payment = "�ǽð�������ü";
}
if( 'VBank' == $inipay->m_payMethod )
{
	$payment = "�������Ա�";

	switch( $inipay->m_vcdbank )
	{
		case '04' : $bank = "��������"; break;
		case '05' : $bank = "��ȯ����"; break;
		case '11' : $bank = "����"; break;
		case '20' : $bank = "�츮����"; break;
		case '21' : $bank = "��������"; break;
		case '26' : $bank = "��������"; break;
		case '81' : $bank = "�ϳ�����"; break;
		case '88' : $bank = "��������"; break;
	}

	$payment_etc = "�Ա����� : " . $bank;
	$payment_etc .= "<br>���¹�ȣ : " . $inipay->m_vacct;
	$payment_etc .= "<br>�Ա��ڸ� : " . $inipay->m_nminput;
	$payment_etc .= "<br>�Աݿ����� : " . $inipay->m_dtinput;

	$url_option = "tid=" . $inipay->m_tid . "&payMethod=" . $inipay->m_payMethod . "&bank=" . $bank . "&vacct=" . $inipay->m_vacct . "&dtinput=" . $inipay->m_dtinput . "&nminput=" . $inipay->m_nminput;

}

if( '00' != $inipay->m_resultCode ) 
{

?>

<html>
<head>
<title>���� ����������</title>
<link rel="stylesheet" href="../css/style.css" type="text/css">
<script language=javascript>
	var openwin=window.open("childwin.html","childwin","width=300,height=160");
	openwin.close();
</script>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">

<? require_once "../top.html" ?>

<!------------------ ���� ����  ------------------------->
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
                <td height="35" align="right" valign="bottom"><!-- ��ư --><a href="#"><img src="images/btn_back.gif" width="240" height="25" border=0 onClick="history.back()"></a></td>
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
<!------------------------------ ���� �� --------------------------------->

<? require_once "../bottom.html" ?>

</body>
</html>

<?

}

$db = new MYSQL;
$db2 = new MYSQL;



// �ֹ����� ����
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

// ���ݰ�꼭
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


// ��ٱ��� ���� -> �ֹ���ǰ ����
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

	// ���� ��� ��ǰ �ǸŰ� ������Ʈ
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

		// ������ũ����Ʈ ����Ű �޾ƿ���
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


	// ������� ����
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

// VCD & SINGLE�� ��� ��۰� ������ ó��...
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
						INSERT INTO mileage_log VALUES ( NULL , '$rs_mileage', '������ǰ�� ���� ���Ӵ�' , now(), '$CUserID' , '$order_no' )
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
					INSERT INTO mileage_log VALUES ( NULL , '-{$use_mileage}', '��ǰ���Ž� ���' , now(), '$CUserID' , '$order_no' )
	";
	$db->query( $query );
	$query = "
					UPDATE user_info SET mileage = mileage - $use_mileage WHERE user_id = '$CUserID'
	";
	$db->query( $query );

}


// �ֹ���� SMS ���ڸ޼��� �߼� (������)

$sms = new SuremPacket;

$query = "
			SELECT ui.user_id, ui.user_name, oi.receipt_status, oi.delivery_status, DATE_FORMAT( oi.reg_date, '%c��%e��' ) as order_date FROM order_info as oi, user_info as ui WHERE oi.user_id = ui.user_id AND order_no = '$order_no'
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

	if( 'Yes' == $rs_delivery_status ) $order_status = "�Ϸ��ֹ�";
	elseif( 'Yes' == $rs_receipt_status ) $order_status = "�ԱݿϷ�";
	else $order_status = "�Ա��غ���";

	$message = "�̹������ �ֹ���� / $name / $order_no / " . number_format( $total_sell_price ) . "�� / $order_status";

	$result = $sms->sendsms( 0 , "011" , "9715", "2772" , $message, "00000000", "000000", "02", "2285" , "1375" , "�̹������" );
	$result = $sms->sendsms( 0 , "016" , "274", "3138" , $message, "00000000", "000000", "02", "2285" , "1375" , "�̹������" );
	$result = $sms->sendsms( 0 , "011" , "9873", "6227" , $message, "00000000", "000000", "02", "2285" , "1375" , "�̹������" );
	$result = $sms->sendsms( 0 , "010" , "6292", "2174" , $message, "00000000", "000000", "02", "2285" , "1375" , "�̹������" );
	$result = $sms->sendsms( 0 , "011" , "792", "5626" , $message, "00000000", "000000", "02", "2285" , "1375" , "�̹������" );
	$result = $sms->sendsms( 0 , "010" , "8842", "8411" , $message, "00000000", "000000", "02", "2285" , "1375" , "�̹������" );

	// �ֹ����� SMS ���ڸ޼��� �߼� (��)

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
			$message = "{$rs_user_name}���� {$rs_order_date} �ֹ��� �����Ǿ����ϴ�. �ǰ��� �Ϸ� �Ǽ��� / �̹������";
			$result = $sms->sendsms( 0 , $handphone[0] , $handphone[1], $handphone[2] , $message, "00000000", "000000", "02", "2285" , "1375" , "�̹������" );

			$query = "
					UPDATE order_info	SET		order_sms = 'Yes'
									WHERE	order_no = '$order_no'
			";
			$db->query( $query );

		}

	}

}

// �ֹ���� �̸��� �߼�
include "../mail/mail_order.html";

meta_go( "order_confirm.html?order_no={$order_no}&{$url_option}" );

?>
