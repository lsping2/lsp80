<?php
include_once('./_common.php');
//include_once(G5_LIB_PATH.'/mailer.lib.php');

if ($od_settle_case != '무통장' && $default['de_pg_service'] == 'lg' && !$_POST['LGD_PAYKEY']) {
    alert('결제등록 요청 후 주문해 주십시오.');
}
$error = "";
$od_price = (int)$_POST['od_price'];
$i_price = (int)$_POST['od_price'];

if ($od_settle_case == "무통장") {
    $ca_id == "bank";

} else if ($od_settle_case == "계좌이체") {
    $ca_id == "iche";
    switch($default['de_pg_service']) {
        case 'lg':
            include G5_SHOP_PATH.'/lg/xpay_result.php';
            break;
        default:
            include G5_SHOP_PATH.'/kcp/pp_ax_hub.php';
            $bank_name  = iconv("cp949", "utf-8", $bank_name);
            break;
    }
    $od_tno             = $tno;
    $od_receipt_price   = $amount;
    $od_receipt_point   = $i_temp_point;
    $od_receipt_time    = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3 \\4:\\5:\\6", $app_time);
    $od_bank_account    = $od_settle_case;
    $od_deposit_name    = $od_name;
    $od_bank_account    = $bank_name;
    $pg_price           = $amount;
    $od_misu            = $i_price - $od_receipt_price;

} else if ($od_settle_case == "가상계좌") {
    $ca_id == "vbank";
    switch($default['de_pg_service']) {
        case 'lg':
            include G5_SHOP_PATH.'/lg/xpay_result.php';
            break;
        default:
            include G5_SHOP_PATH.'/kcp/pp_ax_hub.php';
            $bankname   = iconv("cp949", "utf-8", $bankname);
            $depositor  = iconv("cp949", "utf-8", $depositor);
            break;
    }
    $od_receipt_point   = $i_temp_point;
    $od_tno             = $tno;
    $od_receipt_price   = 0;
    $od_bank_account    = $bankname.' '.$account;
    $od_deposit_name    = $depositor;
    $pg_price           = $amount;
    $od_misu            = $i_price - $od_receipt_price;

} else if ($od_settle_case == "휴대폰") {
    $ca_id == "hp";
    switch($default['de_pg_service']) {
        case 'lg':
            include G5_SHOP_PATH.'/lg/xpay_result.php';
            break;
        default:
            include G5_SHOP_PATH.'/kcp/pp_ax_hub.php';
            break;
    }
    $od_tno             = $tno;
    $od_receipt_price   = $amount;
    $od_receipt_point   = $i_temp_point;
    $od_receipt_time    = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3 \\4:\\5:\\6", $app_time);
    $od_bank_account    = $commid.' '.$mobile_no;
    $pg_price           = $amount;
    $od_misu            = $i_price - $od_receipt_price;

} else if ($od_settle_case == "신용카드") {
    $ca_id == "card";
    switch($default['de_pg_service']) {
        case 'lg':
            include G5_SHOP_PATH.'/lg/xpay_result.php';
            break;
        default:
            include .'./kcp/pp_ax_hub.php';
            $card_name  = iconv("cp949", "utf-8", $card_name);
            break;
    }
    $od_tno             = $tno;
    $od_app_no          = $app_no;
    $od_receipt_price   = $amount;
    $od_receipt_point   = $i_temp_point;
    $od_receipt_time    = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", "\\1-\\2-\\3 \\4:\\5:\\6", $app_time);
    $od_bank_account    = $card_name;
    $pg_price           = $amount;
    $od_misu            = $i_price - $od_receipt_price;

} else {
    die("od_settle_case Error!!!");
}
if ($_POST['radiobutton'] == "1") {
	$kind = "일회";
} else if ($_POST['radiobutton'] == "2" || $_POST['radiobutton'] == "3" || $_POST['radiobutton'] == "4") {
	$kind = "평회";
} else if ($_POST['radiobutton'] == "5") {
	$kind = "특기";
} else if ($_POST['radiobutton'] == "6") {
	$kind = "후원";
} else if ($_POST['radiobutton'] == "7") {
	$kind = "출자";
}

/*
// 주문서에 입력
$sql = " insert order_data set 
				ca_id			= '$ca_id',
                mb_id			= '{$member['mb_id']}',
                mb_name	= '$username',
                mb_tel		= '$usertel',
                mb_hp		= '$userhp',
                kind			= '$kind',
                price			= '$od_price',
                wdate			= '".G5_TIME_YMDHIS."'
                ";
$result = sql_query($sql, false);

if ($od_settle_case != "가상계좌"){
	$sql = " update g5_member  set 
					mb_level 			= '6'
				 where mb_id		= '{$member['mb_id']}'
					";
	$result = sql_query($sql, false);
}
*/
/*
// 주문정보 입력 오류시 결제 취소
if (!$result) {
    if ($tno) {
        $cancel_msg = '주문정보 입력 오류';
        switch($default['de_pg_service']) {
            case 'lg':
                include G5_SHOP_PATH.'/lg/xpay_cancel.php';
                break;
            default:
                include G5_SHOP_PATH.'/kcp/pp_ax_hub_cancel.php';
                break;
        }
    }
    // 관리자에게 오류 알림 메일발송
    $error = 'order';
    include G5_SHOP_PATH.'/ordererrormail.php';

    die('<p>고객님의 주문 정보를 처리하는 중 오류가 발생해서 주문이 완료되지 않았습니다.</p><p>'.strtoupper($default['de_pg_service']).'를 이용한 전자결제(신용카드, 계좌이체, 가상계좌 등)은 자동 취소되었습니다.');
}
*/
// include_once(G5_SHOP_PATH.'/ordermail1.inc.php');
// include_once(G5_SHOP_PATH.'/ordermail2.inc.php');

// SMS BEGIN --------------------------------------------------------
// 주문고객과 쇼핑몰관리자에게 SMS 전송
/*
if ($config['cf_sms_use'] && ($default['de_sms_use2'] || $default['de_sms_use3'])) {
    $sms_contents = array($default['de_sms_cont2'], $default['de_sms_cont3']);
    $recv_numbers = array($od_hp, $default['de_sms_hp']);
    $send_numbers = array($default['de_admin_company_tel'], $od_hp);

    include_once(G5_LIB_PATH.'/icode.sms.lib.php');

    $SMS = new SMS; // SMS 연결
    $SMS->SMS_con($config['cf_icode_server_ip'], $config['cf_icode_id'], $config['cf_icode_pw'], $config['cf_icode_server_port']);
    $sms_count = 0;

    for($s=0; $s<count($sms_contents); $s++) {
        $sms_content = $sms_contents[$s];
        $recv_number = preg_replace("/[^0-9]/", "", $recv_numbers[$s]);
        $send_number = preg_replace("/[^0-9]/", "", $send_numbers[$s]);

        $sms_content = str_replace("{이름}", $od_name, $sms_content);
        $sms_content = str_replace("{보낸분}", $od_name, $sms_content);
        $sms_content = str_replace("{받는분}", $od_b_name, $sms_content);
        $sms_content = str_replace("{주문번호}", $od_id, $sms_content);
        $sms_content = str_replace("{주문금액}", number_format($tot_ct_price + $od_send_cost + $od_send_cost2), $sms_content);
        $sms_content = str_replace("{회원아이디}", $member['mb_id'], $sms_content);
        $sms_content = str_replace("{회사명}", $default['de_admin_company_name'], $sms_content);

        $idx = 'de_sms_use'.($s + 2);

        if($default[$idx] && $recv_number) {
            $SMS->Add($recv_number, $send_number, $config['cf_icode_id'], iconv("utf-8", "euc-kr", stripslashes($sms_content)), "");
            $sms_count++;
        }
    }

    // 무통장 입금 때 고객에게 계좌정보 보냄
    if ($od_settle_case == '무통장' && $default['de_sms_use2'] && $od_misu > 0) {
        $sms_content = $od_name."님의 입금계좌입니다.\n금액:".number_format($od_misu)."원\n계좌:".$od_bank_account."\n".$default['de_admin_company_name'];

        $recv_number = preg_replace("/[^0-9]/", "", $od_hp);
        $send_number = preg_replace("/[^0-9]/", "", $default['de_admin_company_tel']);
        $SMS->Add($recv_number, $send_number, $config['cf_icode_id'], iconv("utf-8", "euc-kr", $sms_content), "");
        $sms_count++;
    }

    if($sms_count > 0)
        $SMS->Send();
}
*/
// SMS END   --------------------------------------------------------

goto_url('../index.php?od_id='.$od_id.'&amp;uid='.$uid);

?>

<html>
    <head>
        <title>주문정보 기록</title>
        <script>
            // 결제 중 새로고침 방지 샘플 스크립트 (중복결제 방지)
            function noRefresh()
            {
                /* CTRL + N키 막음. */
                if ((event.keyCode == 78) && (event.ctrlKey == true))
                {
                    event.keyCode = 0;
                    return false;
                }
                /* F5 번키 막음. */
                if(event.keyCode == 116)
                {
                    event.keyCode = 0;
                    return false;
                }
            }

            document.onkeydown = noRefresh ;
        </script>
    </head>
</html>