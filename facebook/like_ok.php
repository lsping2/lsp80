<?php
  $app_id = '207449892662791';
  $app_secret = 'b5a74a74f55e141d82ad46ac7eceb406';
  $page_id= '1';

echo $_GET['accessToken'];
exit;
  if(isset($_GET['accessToken'])){
  // Run fql query
  $fql_query_url = 'https://graph.facebook.com/'
. '/fql?q=SELECT+uid+FROM+page_fan+WHERE+page_id='.$page_id.'+AND+uid+IN+(SELECT+uid2+FROM+friend+WHERE+uid1=me())&'.$_GET['accessToken'];
  echo $fql_query_url;
  $fql_query_result = file_get_contents($fql_query_url);
  $fql_query_obj = json_decode($fql_query_result, true);

  //display results of fql query
  foreach($fql_query_obj as $v1){
    foreach($v1 as $v2){
        $x++;
    }
}
?>
