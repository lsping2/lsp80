<?

function login_check( $request_url = "" )
{

        global $s_user_uid;
        global $s_user_id;
        global $s_user_name;
        global $s_user_level;

	global $SUserUid;
	global $SUserID;
	global $SUserName;
	global $SUserLevel;

        session_start();

        $SUserUid	= request( 'S_USER_UID'         , 'session' );
        $SUserID		= request( 'S_USER_ID'          , 'session' );
        $SUserName	= request( 'S_USER_NAME'        , 'session' );
        $SUserLevel	= request( 'S_USER_LEVEL'       , 'session' );

	// �ٸ� ���������� �Ʒ� �װ��� �������� ������� ����
        $s_user_uid	= request( 'S_USER_UID'         , 'session' );
        $s_user_id	= request( 'S_USER_ID'          , 'session' );
        $s_user_name	 = request( 'S_USER_NAME'        , 'session' );
        $s_user_level   = request( 'S_USER_LEVEL'       , 'session' );;

/*
        if( !$s_user_uid )
        {

                if( 'none' == $request_url )
                {
                        echo "<font style='font-size:9pt>�α��� ������ �����Ǿ����ϴ�.</font>";
                }
                elseif( $request_url )
                {
                        $URL = $SERVER_CONFIG[ 'admin_location' ] . "/admin/login/login.html?request_url=" . $request_url;
                }
                else
                {
                        $URL = $SERVER_CONFIG[ 'admin_location' ] . "/admin/login/login.html?request_url=" . $_SERVER["PHP_SELF"];
                }

                echo "<script language=javascript>window.open( \"{$URL}\", '_self' )</script>";
                exit;
        }
*/
}

?>
