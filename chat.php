<script>U=window.U=window.U||{},U.events=U.events||[],U.chat=function(n){return{on:function(e,t){U.events.push([n,e,t])},off:function(e){for(var t=U.events.length;t>0;)U.events[--t][0]==n&&U.events[t][1]==e&&U.events.splice(t,1)}}};</script>

<?php
include_once("_common.php");

if(!function_exists('uchat_array2data')) {
	function uchat_array2data($arr) {
		$arr['time'] = time();
		ksort($arr);
		$arr = array_filter($arr);
		$arr['hash'] = md5(implode($arr['token'], $arr));
		unset($arr['token']);
		foreach ($arr as $k => &$v){ $v = $k.' '.urlencode($v); }
		return implode("|", $arr);
	}
}
$joinData = array();
$joinData['room'] = 'lsp80';
$joinData['token'] = '690ccf1899255d6a59c8b7794797e0bc';

$joinData['nick'] = $member['mb_nick'];
$joinData['id'] = $member['mb_id'];
$joinData['level'] = $member['mb_level'];
$joinData['auth'] = $is_admin?"admin":"";
if($is_member) {
	$uicon_file = "/data/member/".substr($member['mb_id'],0,2)."/".$member['mb_id'].".gif";
	if(file_exists((G5_PATH?G5_PATH:$g4['path']).$uicon_file))
		$joinData['icons'] = $uicon_file;
}
//$joinData['nickcon'] = '';
//$joinData['other'] = '';
?>
<script async src="//client.uchat.io/uchat.js"></script>

<script>
    U.chat('lsp80').on('after.create', function( room, data ) {
    // room.skin json 은 create 에서 정의되므로 after이여야된다.
      room.skin.menubar.add( {
        id : 'alert'
        , title : "its alert!!"
        , html : '<div>hi</div>'
        , condition : function ( room, data ) {
           if(room.my.auth > 1) // 멤버이상이라면 표시하지 않는다.
             return false;
        }
        , onClick : function( room, data ) {
            room.print('hi ! '+room.my.nick+'<br><span style="font-size:20px;">html야!!</span>');
        }     
      });

      room.skin.userMenu.add( {
        id : 'test'
        , text : '테스트야~'
        , onClick : function ( room, data ) {
            if(room.my.nick == data.target)
              alert(' 이건 나야! ');
            else
              alert( '안뇽 '+data.target );
          }
      });
    });
  </script>
</u-chat>

<u-chat room='<?php echo $joinData['room'];?>' user_data='<?php echo uchat_array2data($joinData); ?>' style="display:inline-block; width:500px; height:500px;"></u-chat>

  