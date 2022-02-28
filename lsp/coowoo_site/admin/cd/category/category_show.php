<?

require_once "../../../include/include.php";

require_once "../../login/login_check.php";
login_check( $PHP_SELF );

?>
<html>
<head>
<title><?$HTML->Title( 'Admin' )?></title>
<link rel="stylesheet" href="../../admin_style.css" type="text/css">
</head>

<?

function category_show( $gid = 0 , $thread = '' , $last_total_record = 0 , $last_loop = 0 )
{

	global $max_depth;

	$thread_length = strlen( $thread );

	if( $thread_length )
	{
		$thread_length += 3;
	}
	else
	{
		$thread_length = 3;
	}

	$gid_query = '';
	if( $gid )
	{
		$gid_query = "AND category_gid = $gid";
	}

	$db = new MYSQL();

	$query = "
						SELECT		category_no ,
										category_gid ,
										category_thread ,
										category_name
						FROM		cd_category
						WHERE		category_thread LIKE '$thread%'
						AND			length( category_thread ) = $thread_length
						$gid_query
						ORDER BY	category_sort ASC
	";
	$db->query( $query );
	$total_record = $db->total_record();

	$space = '';
    for( $loop = 0; $loop < $thread_length; $loop++ )
    {
		$space .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    }

    for( $loop=0; $loop < $total_record; $loop++ )
    {
		$db->fetch();
		$rs_category_no		= $db->result( 'category_no' );
		$rs_category_gid		= $db->result( 'category_gid' );
		$rs_category_thread	= $db->result( 'category_thread' );
		$rs_category_name	= $db->result( 'category_name' );

        echo "<tr height=20>";

        $thread_length = ( strlen( $rs_category_thread )  ) / 3;


        for( $loop2 = 1; $loop2 <= $max_depth; $loop2++ )
        {
            if( $loop2 == $thread_length )
            {
                echo "<td>&nbsp;<input type=checkbox name=CategoryList[] value='{$rs_category_no}'>&nbsp;<a name='#{$rs_category_no}'><a href='' target ='_blank'>$rs_category_name</a></td>";
            }
            elseif ( $loop2 == $thread_length - 1 )
            {
                if( $loop == $total_record - 1 )
                {
                    echo "<td align=right><img src='pointer2.gif'></td>";
                }
                else
                {
                    echo "<td align=right><img src='pointer1.gif'></td>";
                }
            }
            elseif ( $loop2 < $thread_length - 1 )
            {
                echo "<td align=right style='padding-left:5pt'><img src='pointer3.gif'></td>";
            }
            else
            {
                if( $loop2 == $max_depth AND 2 == $thread_length )
                {
                    echo "<td align=center><a href='#CategoryTop'>&lt;<font face=tahoma><b>Top</b></font>&gt;";
                }
                else
                {
                    echo "<td>&nbsp</td>";
                }
            }
        }
        echo "</tr>";

        category_show( $rs_category_gid, $rs_category_thread, $total_record, $loop );

    }
}

$db = new MYSQL();
$query = "SELECT MAX( LENGTH( category_thread ) ) as max_thread FROM keyword_category";
$db->query( $query );
$db->fetch();
$max_depth = $db->result( 'max_thread' );

?>

<table border=0 cellpadding=0 cellspacing=0>

<? category_show() ?>

</table>