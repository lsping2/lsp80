<?
/*
���� : ��۳���   Email �߼�
���� : ��۵�Ͻ� �����ۼ��ڿ��� Email �߼۵Ǹ�, ������� ��Ͻ� ���� ��۵���ڿ��Ե� Email �߼۵�

���� : lsp80
������ : 2007�� 04�� 05��
������Ʈ: 2007�� 04�� 05��
*/

require_once "../../../include/include.php";
html_cache_disable();
require_once "../../login/login_check.php";
login_check( $PHP_SELF );

$comment	= request( 'comment','post' );
$diary_no		= request( 'diary_no','post' );
$working_date	= request( 'working_date','post' );

$db = new MYSQL;
$db2 = new MYSQL;
$db3 = new MYSQL;

$query = "
			INSERT INTO intranet.business_diary_reply SET	reply_no	= NULL ,
													diary_no	= '$diary_no' ,
													comment	= '$comment' ,
													user_id	= '$s_user_id'  ,
													reg_date = now()
";
$db->query( $query );

$query = "
	SELECT		bd.user_id, ui.user_name, ui.user_email, bd.comment, DATE_FORMAT( bd.reg_date, '%Y-%m-%d %H:%i' ) as reg_date
	FROM		intranet.business_diary as bd
	LEFT JOIN		intranet.user_info as ui
	ON			bd.user_id = ui.user_id
	WHERE		bd.diary_no = {$diary_no}

	UNION

	SELECT		bdr.user_id, ui.user_name, ui.user_email, bdr.comment, DATE_FORMAT( bdr.reg_date, '%Y-%m-%d %H:%i' ) as reg_date
	FROM		intranet.business_diary_reply as bdr
	LEFT JOIN		intranet.user_info as ui
	ON			bdr.user_id = ui.user_id
	WHERE		bdr.diary_no = {$diary_no}

	ORDER BY	reg_date ASC		
";
$db->query( $query );

for( $loop=0; $loop<$db->total_record(); $loop++ )
{
	$db->fetch();
	$rs_user_id		= $db->result( 'user_id' );
	$rs_user_name	= $db->result( 'user_name' );
	$rs_user_email	= $db->result( 'user_email' );
	$rs_comment		= $db->result( 'comment' );
	$rs_reg_date		= $db->result( 'reg_date' );
	
	$message .= " {$rs_user_name}($rs_user_email} - {$rs_reg_date}\n\n";
	$message .= $rs_comment;
	$message .= "\n\n---------------------------------------------------------------------------------------------\n\n";

	if( !in_array( $rs_user_email, $email ) ) $email[] = $rs_user_email;
}

$message = nl2br( $message );

 $query = "
			SELECT	user_email ,
					user_name
			FROM	intranet.user_info
			WHERE	use_status = 'Yes'
			AND		user_id  = '$s_user_id'
";
$db2->query( $query );
$db2->fetch();
$rs_user_email	= $db2->result( 'user_email' );
$rs_user_name	= $db2->result( 'user_name' );


for( $loop=0; $loop<count( $email ); $loop++ )
{

	my_smail2( $rs_user_name, $rs_user_email, $rs_user_email, $email[$loop], "(���������Խ��� �亯 : $SUserName) ", $message );	

}

/*

// ���� �ۼ���
 $query = "
			SELECT	distinct(user_email) ,
					user_id 
			FROM	intranet.user_info
			WHERE	use_status = 'Yes'
			AND		user_id  = '$first_user_id'
";
$db->query( $query );

$db->fetch();
$send_name		= $SUserName;
$returned_email	= '';
$to_email  = $db->result( 'user_email' );  // �����ۼ��� �ּ�



// ���� ��۴� �ۼ��� email ��������
 $query = "
			SELECT	distinct(user_email)
			FROM	intranet.user_info
			WHERE	use_status = 'Yes'
			AND		user_id  = '$s_user_id'
";
$db2->query( $query );
$db2->fetch();
$from_email   = $db2->result( 'user_email' );  // �����ۼ��� �ּ�



list($year,$month,$day) = explode("-" , $working_date);

$subject = $year."��".$month."��".$day."�� �������� ���";


my_smail2( $send_name, $from_email, $returned_email, $to_email, "(���������Խ��� : $SUserName) ".$subject, $comment );	

// ����� ������� ���� ######## ��۴� id  �ѹ��� ������##########
 $query = "
			SELECT	user_id 
			FROM	intranet.business_diary_reply 
			WHERE	diary_no = '$diary_no'
			ORDER BY  reg_date ASC
					
					
";
$db->query( $query ); 
for( $loop=0; $loop<$db->total_record(); $loop++ )
{


$db->fetch();
 $user_id[]	=  $db->result( 'user_id' );   //��۴� id


// ����� ����� ���ο��� ���Ϲ�� �ȵǵ��� �ֱٰ��� ������ $loop2���� ��� ##########
$loop2 = $loop-1;

$query = "
			SELECT	user_email
			FROM	intranet.user_info
			WHERE	use_status = 'Yes'
			AND		user_id  = '$user_id[$loop2]'
			
";
$db2->query( $query );

$db2->fetch();
$send_name		= $SUserName;
$returned_email	= '';
echo $to_email       = $db2->result( 'user_email' );  // �����ۼ��� �ּ�
$subject = $year."��".$month."��".$day."�� �������� ���";



// ���Ϻ����� 
my_smail2( $send_name, $from_email, $returned_email, $to_email, "(���������Խ��� : $SUserName) ".$subject, $comment );	

*/
	
js_code( "parent.window.location.reload();" );
?>




