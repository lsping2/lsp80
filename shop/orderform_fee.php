<?php
include_once('./_common.php');
include_once('./_head.php');

$g5['title'] = ':::::회비납부/후원금:::::';

$default['de_pg_service'] ="kcp";
$default['de_card_use'] = "y";
// 전자결제를 사용할 때만 실행

    if($default['de_pg_service']) {
       $g5['body_script'] = 'onload="CheckPayplusInstall();"';
    }

echo "==>".G5_SHOP_PATH;

include_once('../head.sub.php');

$od_id = "1643468";
$goods = $good_name; // good_name
$tot_price = $good_mny; // good_mny
$tot_sell_price = $good_mny; // good_mny
$order_action_url = '/shop/orderform_feeupdate.php';


require_once('./settle_'.$default['de_pg_service'].'.inc.php');


// 결제대행사별 코드 include (스크립트 등)
require_once('./'.$default['de_pg_service'].'/orderform.12.php');
?>

<!-- 호출안되서 추가 lsping -->
<script type="text/javascript"> 
jQuery(document).ready(function(){		
	CheckPayplusInstall();
});
</script>

<style type="text/css">
<!--
.style1 {font-size:16px;	font-weight:bold;color:#FFFFFF;font-family:"-윤고딕120";}
.style4 {font-size: 12px;}
.style7 {color: #FF0000;}
.style8 {font-size: 14px;}
.style9 {color: #000000;}
.style11 {font-size: 12px;color: #000000;}
-->
</style>

<form name="forderform" id="forderform" method="post" action="<?php echo $order_action_url; ?>" onsubmit="return forderform_check(this);" autocomplete="off">
<div id="sod_frm">
	<table width="574" height="700" border="1" align="center" cellpadding="0" cellspacing="0" bordercolordark="white" bordercolorlight="#A0A0A0">
	<tr bgcolor="#606060">
		<td height="59" colspan="4" bgcolor="#666666" width="570"><div align="center" class="style1"><span style="font-size:14pt;">결제테스트</span></div></td>
	</tr>


	<tr bgcolor="#FFFFFF">
		<td height="52" colspan="4" bgcolor="#E0E0E0" width="570">
			<div align="center" class="style8"><b><span style="font-size:12pt;">결제테스트&nbsp;</span></b></div>
		</td>
	</tr>
	
	
    <input type="hidden" name="od_price" value="<?php echo $tot_sell_price; ?>">
    <input type="hidden" name="org_od_price" value="<?php echo $tot_sell_price; ?>">
    <input type="hidden" name="od_send_cost" value="0">
    <input type="hidden" name="od_send_cost2" value="0">
    <input type="hidden" name="item_coupon" value="0">
    <input type="hidden" name="od_coupon" value="0">
    <input type="hidden" name="od_send_coupon" value="0">

    <?php
    // 결제대행사별 코드 include (결제대행사 정보 필드)
    require_once('./'.$default['de_pg_service'].'/orderform.22.php');
    ?>
	<tr bgcolor="#FFFFFF">
		<td rowspan="3" bgcolor="#E0E0E0" height="208" width="73">
			<div align="center" class="style4">결재<br>하기</div>
		</td>
		<td height="81" colspan="3" bgcolor="#D5E3F7" width="495">
		
			<table width="500" height="40" align="center" cellpadding="0" cellspacing="0" bordercolordark="white" bordercolorlight="#A0A0A0" style="border-collapse:collapse;">
			<tr>
				<td width="50" height="20" class="style4" style="border-width:1; border-color:black; border-style:none;">&nbsp;성 &nbsp;&nbsp;명 :</td>
				<td width="200" class="style4" style="border-width:1; border-color:black; border-style:none;">&nbsp;<input type="text" size="15" name="username" maxlength="8" value="이승표테스트"></td>
				<td width="50" class="style4" style="border-width:1; border-color:black; border-style:none;">아이디 :</td>
				<td width="200" class="style4" style="border-width:1; border-color:black; border-style:none;">&nbsp;<input type="text" size="15" name="userid" maxlength="8" readonly value="<?=$member[mb_id]?>"></td>
			</tr>
			<tr>
				<td height="20" class="style4" style="border-width:1; border-color:black; border-style:none;">&nbsp;집전화 :</td>
				<td class="style4" style="border-width:1; border-color:black; border-style:none;">&nbsp;<input type="text" size="15" name="usertel" maxlength="13" value="<?=$member[mb_tel]?>"> &quot;-&quot;를 포함</td>
				<td class="style4" style="border-width:1; border-color:black; border-style:none;">휴대폰 :</td>
				<td class="style4" style="border-width:1; border-color:black; border-style:none;">&nbsp;<input type="text" size="15" name="userhp" maxlength="13" value="<?=$member[mb_hp]?>"> &quot;-&quot;를 포함</td>
			</tr>
			<tr>
				<td height="20" class="style4" style="border-width:1; border-color:black; border-style:none;">&nbsp;e-mail :</td>
				<td class="style4" style="border-width:1; border-color:black; border-style:none;">&nbsp;<input type="text" size="15" name="od_email" maxlength="13" value="<?=$member[mb_email]?>"></td>
				<td class="style4" style="border-width:1; border-color:black; border-style:none;">&nbsp;</td>
				<td class="style4" style="border-width:1; border-color:black; border-style:none;">&nbsp;</td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height="84" colspan="3" bgcolor="#FFFFFF" width="495">
			<div align="center" class="style4">
				<?php
				$multi_settle == 0;
				$checked = '';

				$escrow_title = "";
				if ($default['de_escrow_use']) {
					$escrow_title = "에스크로 ";
				}
				if ($default['de_bank_use'] || $default['de_vbank_use'] || $default['de_iche_use'] || $default['de_card_use'] || $default['de_hp_use']) {
					echo '<fieldset id="sod_frm_paysel">';
					echo '<legend>결제방법 선택</legend>';
				}
				// 무통장입금 사용
				if ($default['de_bank_use']) {
					$multi_settle++;
					//echo '<input type="radio" id="od_settle_bank" name="od_settle_case" value="무통장" '.$checked.'> <label for="od_settle_bank">무통장입금</label>'.PHP_EOL;
					$checked = '';
				}
				// 가상계좌 사용
				if ($default['de_vbank_use']) {
					$multi_settle++;
					echo '<input type="radio" id="od_settle_vbank" name="od_settle_case" value="가상계좌" '.$checked.'> <label for="od_settle_vbank">'.$escrow_title.'가상계좌</label>'.PHP_EOL;
					$checked = '';
				}
				// 계좌이체 사용
				if ($default['de_iche_use']) {
					$multi_settle++;
					//echo '<input type="radio" id="od_settle_iche" name="od_settle_case" value="계좌이체" checked> <label for="od_settle_iche">'.$escrow_title.'실시간 계좌이체(권장)</label>'.PHP_EOL;
					$checked = '';
				}
				// 신용카드 사용
				if (true) {
					$multi_settle++;
					echo '<input type="radio" id="od_settle_card" name="od_settle_case" value="신용카드" checked> <label for="od_settle_card">신용카드</label>'.PHP_EOL;
					$checked = '';
				}
				// 휴대폰 사용
				if ($default['de_hp_use']) {
					$multi_settle++;
					echo '<input type="radio" id="od_settle_hp" name="od_settle_case" value="휴대폰" '.$checked.'> <label for="od_settle_hp">휴대폰</label>'.PHP_EOL;
					$checked = '';
				}
				$temp_point = 0;
				if ($default['de_bank_use']) {
					// 은행계좌를 배열로 만든후
					$str = explode("\n", trim($default['de_bank_account']));
					if (count($str) <= 1) {
						$bank_account = '<input type="hidden" name="od_bank_account" value="'.$str[0].'">'.$str[0].PHP_EOL;
					} else {
						$bank_account = '<select name="od_bank_account" id="od_bank_account">'.PHP_EOL;
						$bank_account .= '<option value="">선택하십시오.</option>';
						for ($i=0; $i<count($str); $i++) {
							//$str[$i] = str_replace("\r", "", $str[$i]);
							$str[$i] = trim($str[$i]);
							$bank_account .= '<option value="'.$str[$i].'">'.$str[$i].'</option>'.PHP_EOL;
						}
						$bank_account .= '</select>'.PHP_EOL;
					}
					echo '<div id="settle_bank" style="display:none">';
					echo '<label for="od_bank_account" class="sound_only">입금할 계좌</label>';
					echo $bank_account;
					echo '<br><label for="od_deposit_name">입금자명</label>';
					echo '<input type="text" name="od_deposit_name" id="od_deposit_name" class="frm_input" size="10" maxlength="20">';
					echo '</div>';
				}
				if ($default['de_bank_use'] || $default['de_vbank_use'] || $default['de_iche_use'] || $default['de_card_use'] || $default['de_hp_use']) {
					echo '</fieldset>';
				}
				if ($multi_settle == 0) {
					echo '<p>결제할 방법이 없습니다.<br>운영자에게 알려주시면 감사하겠습니다.</p>';
				}
				?>
			</div>
		</td>
	</tr>
	<tr>
		<td height="41" colspan="3" bgcolor="#E0E0E0" width="495">
			<div align="justify" class="style4">
				<p style="line-height:150%;">&nbsp;&nbsp;&nbsp;&nbsp;<span class="style9">※ 계좌이체 및 신용카드는 공인인증서 또는 안심체크가 필요합니다. <br>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;다만, 핸드폰 납부는 공인인증서 및 안심체크가 필요하지 않습니다.</span>
			</div>
		</td>
	</tr>

	</table>

    <?php
    // 결제대행사별 코드 include (주문버튼)
    require_once('./'.$default['de_pg_service'].'/orderform.32.php');
    ?>
    </form>

    <?php
    if ($default['de_escrow_use']) {
        // 결제대행사별 코드 include (에스크로 안내)
        require_once('./'.$default['de_pg_service'].'/orderform.42.php');
    }
    ?>
</div>

<script>
/*
$amt_1 = 30000; // 연회비
$amt_2 = 400000; // 기사 평생회비
$amt_3 = 500000; // 관리사 평생회비
$amt_4 = 600000; // 기술사 평생회비
$amt_5 = 50000; // 특별기금
*/
function amt_etc(val) {
	var good_mny = document.forderform.good_mny;
	var od_price = document.forderform.od_price;
	var org_od_price = document.forderform.org_od_price;
	
	good_mny = val;
	od_price = val;
	org_od_price = val;
}

good_name.value = "<?=$good_name?>";
		good_mny.value = "<?=good_mny?>";
		od_pric.valuee = "<?=$amt_1?>";
		org_od_price.value = "<?=$amt_1?>";
		exAmt1.disabled = true;
		exAmt2.disabled = true;
		exAmt3.disabled = true;

		/*
function sel_order(val) {
	var good_name = document.forderform.good_name;
	var good_mny = document.forderform.good_mny;
	var od_price = document.forderform.od_price;
	var org_od_price = document.forderform.org_od_price;
	var exAmt1 = document.forderform.exAmt1;
	var exAmt2 = document.forderform.exAmt2;
	var exAmt3 = document.forderform.exAmt3;

	if (val == "1") {
		good_name.value = "연회비";
		good_mny.value = "<?=$amt_1?>";
		od_pric.valuee = "<?=$amt_1?>";
		org_od_price.value = "<?=$amt_1?>";
		exAmt1.disabled = true;
		exAmt2.disabled = true;
		exAmt3.disabled = true;
	} else if (val == "2") {
		good_name.value = "기사 평생회비";
		good_mny.value = "<?=$amt_2?>";
		od_price.value = "<?=$amt_2?>";
		org_od_price.value = "<?=$amt_2?>";
		exAmt1.disabled = true;
		exAmt2.disabled = true;
		exAmt3.disabled = true;
	} else if (val == "3") {
		good_name.value = "관리사 평생회비";
		good_mny.value = "<?=$amt_3?>";
		od_price.value = "<?=$amt_3?>";
		org_od_price.value = "<?=$amt_3?>";
		exAmt1.disabled = true;
		exAmt2.disabled = true;
		exAmt3.disabled = true;
	} else if (val == "4") {
		good_name.value = "기술사 평생회비";
		good_mny.value = "<?=$amt_4?>";
		od_price.value = "<?=$amt_4?>";
		org_od_price.value = "<?=$amt_4?>";
		exAmt1.disabled = true;
		exAmt2.disabled = true;
		exAmt3.disabled = true;
	} else if (val == "5") {
		good_name.value = "특별기금";
		good_mny.value = "<?=$amt_5?>";
		od_price.value = "<?=$amt_5?>";
		org_od_price.value = "<?=$amt_5?>";
		exAmt1.disabled = true;
		exAmt2.disabled = true;
		exAmt3.disabled = true;
	} else if (val == "6") {
		good_name.value = "후원금";
		good_mny.value = "";
		od_price.value = "";
		org_od_price.value = "";
		exAmt1.disabled = true;
		exAmt2.disabled = false;
		exAmt3.disabled = true;
	} else if (val == "7") {
		good_name.value = "출자금";
		good_mny.value = "";
		od_price.value = "";
		org_od_price.value = "";
		exAmt1.disabled = true;
		exAmt2.disabled = true;
		exAmt3.disabled = false;
	}
}

*/


$(function() {
    $("#od_settle_bank").on("click", function() {
        $("[name=od_deposit_name]").val( $("[name=od_name]").val() );
        $("#settle_bank").show();
    });
    $("#od_settle_iche,#od_settle_card,#od_settle_vbank,#od_settle_hp").bind("click", function() {
        $("#settle_bank").hide();
    });
});

function calculate_tax()
{
    var $it_prc = $("input[name^=it_price]");
    var $cp_prc = $("input[name^=cp_price]");
    var sell_price = tot_cp_price = 0;
    var it_price, cp_price, it_notax;
    var tot_mny = comm_free_mny = tax_mny = vat_mny = 0;
    var temp_point = 0;

    $it_prc.each(function(index) {
        it_price = parseInt($(this).val());
        cp_price = parseInt($cp_prc.eq(index).val());
        sell_price += it_price;
        tot_cp_price += cp_price;
        it_notax = $("input[name^=it_notax]").eq(index).val();
        if(it_notax == "1") {
            comm_free_mny += (it_price - cp_price);
        } else {
            tot_mny += (it_price - cp_price);
        }
    });

    tot_mny += (temp_point);
    if(tot_mny < 0) {
        comm_free_mny = comm_free_mny + tot_mny;
        tot_mny = 0;
    }

    tax_mny = Math.round(tot_mny / 1.1);
    vat_mny = tot_mny - tax_mny;
    $("input[name=comm_tax_mny]").val(tax_mny);
    $("input[name=comm_vat_mny]").val(vat_mny);
    $("input[name=comm_free_mny]").val(comm_free_mny);
}

function forderform_check(f)
{
    errmsg = "";
    errfld = "";
    var deffld = "";

    var settle_case = document.getElementsByName("od_settle_case");
    var settle_check = false;
    var settle_method = "";
    for (i=0; i<settle_case.length; i++)
    {
        if (settle_case[i].checked)
        {
            settle_check = true;
            settle_method = settle_case[i].value;
            break;
        }
    }
    if (!settle_check)
    {
        alert("결제방식을 선택하십시오.");
        return false;
    }

    var od_price = parseInt(f.od_price.value);

    var max_point = 0;
    if (typeof(f.max_temp_point) != "undefined")
        max_point  = parseInt(f.max_temp_point.value);

    var tot_price = od_price;

    if (document.getElementById("od_settle_iche")) {
        if (document.getElementById("od_settle_iche").checked) {
            if (tot_price < 150) {
                alert("계좌이체는 150원 이상 결제가 가능합니다.");
                return false;
            }
        }
    }
    if (document.getElementById("od_settle_card")) {
        if (document.getElementById("od_settle_card").checked) {
            if (tot_price < 100) {
                alert("신용카드는 100원 이상 결제가 가능합니다.");
                return false;
            }
        }
    }
    if (document.getElementById("od_settle_hp")) {
        if (document.getElementById("od_settle_hp").checked) {
            if (tot_price < 350) {
                alert("휴대폰은 350원 이상 결제가 가능합니다.");
                return false;
            }
        }
    }

    <?php if($default['de_tax_flag_use']) { ?>
    calculate_tax();
    <?php } ?>

    // pay_method 설정
    <?php if($default['de_pg_service'] == 'kcp') { ?>
    switch(settle_method)
    {
        case "계좌이체":
            f.pay_method.value = "010000000000";
            break;
        case "가상계좌":
            f.pay_method.value = "001000000000";
            break;
        case "휴대폰":
            f.pay_method.value = "000010000000";
            break;
        case "신용카드":
            f.pay_method.value = "100000000000";
            break;
        default:
            f.pay_method.value = "무통장";
            break;
    }
    <?php } else if($default['de_pg_service'] == 'lg') { ?>
    switch(settle_method)
    {
        case "계좌이체":
            f.LGD_CUSTOM_FIRSTPAY.value = "SC0030";
            f.LGD_CUSTOM_USABLEPAY.value = "SC0030";
            break;
        case "가상계좌":
            f.LGD_CUSTOM_FIRSTPAY.value = "SC0040";
            f.LGD_CUSTOM_USABLEPAY.value = "SC0040";
            break;
        case "휴대폰":
            f.LGD_CUSTOM_FIRSTPAY.value = "SC0060";
            f.LGD_CUSTOM_USABLEPAY.value = "SC0060";
            break;
        case "신용카드":
            f.LGD_CUSTOM_FIRSTPAY.value = "SC0010";
            f.LGD_CUSTOM_USABLEPAY.value = "SC0010";
            break;
        default:
            f.LGD_CUSTOM_FIRSTPAY.value = "무통장";
            break;
    }
    <?php } ?>

    // 결제정보설정
    <?php if($default['de_pg_service'] == 'kcp') { ?>
    f.buyr_name.value = f.username.value;
    f.buyr_mail.value = f.od_email.value;
    f.buyr_tel1.value = f.usertel.value;
    f.buyr_tel2.value = f.userhp.value;

    if(f.pay_method.value != "무통장") {
        if(jsf__pay( f )) {
            return true;
        } else {
            return false;
        }
    } else {
        return true;
    }
    <?php } if($default['de_pg_service'] == 'lg') { ?>
    f.LGD_BUYER.value = f.username.value;
    f.LGD_BUYEREMAIL.value = f.od_email.value;
    f.LGD_BUYERPHONE.value = f.userhp.value;
    f.LGD_AMOUNT.value = f.good_mny.value;
    //f.LGD_RECEIVER.value = f.od_b_name.value;
    //f.LGD_RECEIVERPHONE.value = f.od_b_hp.value;
    <?php if($default['de_escrow_use']) { ?>
    //f.LGD_ESCROW_ZIPCODE.value = f.od_b_zip1.value + f.od_b_zip2.value;
    //f.LGD_ESCROW_ADDRESS1.value = f.od_b_addr1.value;
    //f.LGD_ESCROW_ADDRESS2.value = f.od_b_addr2.value;
    f.LGD_ESCROW_BUYERPHONE.value = f.userhp.value;
    <?php } ?>
    <?php if($default['de_tax_flag_use']) { ?>
    f.LGD_TAXFREEAMOUNT.value = f.comm_free_mny.value;
    <?php } ?>

    if(f.LGD_CUSTOM_FIRSTPAY.value != "무통장") {
          Pay_Request("<?php echo $od_id; ?>", f.LGD_AMOUNT.value, f.LGD_TIMESTAMP.value);
    } else {
        f.submit();
    }
    <?php } ?>
}
</script>

<?php
//include_once('./_tail.php');

// 결제대행사별 코드 include (스크립트 실행)
require_once('./'.$default['de_pg_service'].'/orderform.52.php');
?>