<? 
function php_timer(){ 
  static $arr_timer; 
  if(!isset($arr_timer)){ 
  $arr_timer = explode(" ", microtime()); 
  }else{ 
    $arr_timer2 = explode(" ", microtime()); 
    $result = ($arr_timer2[1] - $arr_timer[1]); 
    $result = sprintf("%4f",$result); 
    return $result; 
  } 
  return false; 
} 
?> 
<? 
//----------------------------예제 
print("초기화"); 
print php_timer().'<br>'; 
print("2초 쉽니다."); 
sleep(2); 
print php_timer().'<br>'; 
print("3초 쉽니다."); 
sleep(3); 

?> 