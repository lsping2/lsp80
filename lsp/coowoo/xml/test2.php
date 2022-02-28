<?php 

class Xml 
{ 
  var $tag; 
  var $value; 
  var $attributes; 
  var $next; 
} 

function xml2array($xml_string) 
{ 
  $Parser = xml_parser_create(); 
  xml_parser_set_option($Parser, XML_OPTION_CASE_FOLDING, 0); 
  xml_parser_set_option($Parser, XML_OPTION_SKIP_WHITE, 1); 
  xml_parse_into_struct($Parser, $xml_string, $Xml_Values); 
  xml_parser_free($Parser); 
  $XmlClass = array(); 
  $LastObj = array(); 
  $NowObj = &$XmlClass; 

  foreach($Xml_Values as $Xml_Key => $Xml_Value) 
  { 
      $Index = count($NowObj); 
      if($Xml_Value["type"] == "complete") 
      { 
          $NowObj[$Index] = new Xml; 
          $NowObj[$Index]->tag = $Xml_Value["tag"]; 
          $NowObj[$Index]->value = $Xml_Value["value"]; 
          $NowObj[$Index]->attributes = $Xml_Value["attributes"]; 
      } 
      elseif($Xml_Value["type"] == "open") 
      { 
          $NowObj[$Index] = new Xml; 
          $NowObj[$Index]->tag = $Xml_Value["tag"]; 
          $NowObj[$Index]->value = $Xml_Value["value"]; 
          $NowObj[$Index]->attributes = $Xml_Value["attributes"]; 
          $NowObj[$Index]->next = array(); 
          $LastObj[count($LastObj)] = &$NowObj; 
          $NowObj = &$NowObj[$Index]->next; 
      } 
      elseif($Xml_Value["type"] == "close") 
      { 
          $NowObj = &$LastObj[count($LastObj) - 1]; 
          unset($LastObj[count($LastObj) - 1]); 
      } 
      
  } 

  return $XmlClass; 
} 

$keyword = "cat";

if( !$page )
{
	$page = 1;
}

if (!$page_size)
{
		$page_size = 30;
}



$file="http://www.ingrampublishing.com/distributorImageSearch.do?language=en&page={$page}&pageSize={$page_size}&keywords={$keyword}&subscriptionGroupID=1"; 

if (!($fp = fopen($file, "r"))) { 
  die("XML 입력을 열 수 없습니다."); 
} 
while (!feof($fp)) { 
 $data .= fgets($fp, 1024); 
} 



$Xml = xml2array($data); 
//echo $Xml[0]->tag;
print_r($Xml); 


$last = count( $Xml[0]->next ) - 1;  // 페이지별 최대갯수
$total_record = $Xml[0]->next[$last]->attributes['total'];  // 전체갯수
echo "<br>";
echo "<br>";
echo "Total : " . $total;
echo "<br>";
$total_page = ceil( $total_record  / $page_size );  // 전체 페이지그룹 갯수
echo "<br>";
echo $code = $Xml[0]->next[1]->attributes['code'];
echo "<br>";
echo $width = $Xml[0]->next[1]->attributes['width'];
echo "<br>";
echo $height = $Xml[0]->next[1]->attributes['height'];
echo "<br>";
echo "<br>";
echo var_dump($Xml[0]->next[0]->attributes);

echo "<br>";
echo "<br>";

echo "<img src=\"http://comps.ingrampublishing.com/fpx-war/img/{$code}?s={$code}&w={$width}&h={$height}&ds=120&q=2;\">";









