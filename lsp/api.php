<?
function getRssArray2($url)
{
    $parser = xml_parser_create();
    xml_parser_set_option( $parser, XML_OPTION_CASE_FOLDING, 0 );
    xml_parser_set_option( $parser, XML_OPTION_SKIP_WHITE, 1 );
    xml_parse_into_struct( $parser, getUrlData($url), $tags );
    xml_parser_free( $parser );
    
    $elements = array();
    $stack = array();
    foreach ( $tags as $tag )
    {
        $index = count( $elements );
        if ( $tag['type'] == "complete" || $tag['type'] == "open" )
        {
            $elements[$index] = array();
            $elements[$index]['name'] = $tag['tag'];
            $elements[$index]['attributes'] = $tag['attributes'];
            $elements[$index]['content'] = $tag['value'];
            
            if ( $tag['type'] == "open" )
            {    # push
                $elements[$index]['children'] = array();
                $stack[count($stack)] = &$elements;
                $elements = &$elements[$index]['children'];
            }
        }
        
        if ( $tag['type'] == "close" )
        {    # pop
            $elements = &$stack[count($stack) - 1];
            unset($stack[count($stack) - 1]);
        }
    }
    return $elements[0];
} 

include_once $path['syscore'].'function/utf8.func.php';
include_once $path['syscore'].'function/rss.func.php';
$getexg = 'http://www.naver.com/include/timesquare/widget/exchange.xml';

$RSS = getRssArray2($getexg);
$RSS['data'] = getUrlData(trim($getexg));
$RSS['utf8'] = strstr(strtolower(substr($RSS['data'],0,100)),'euc-kr')?false:true;

for($i=0; $i<=sizeof($RSS['children']); $i++){
	if($RSS['children'][$i]['name']!='currency') continue;
	for($j=0; $j<sizeof($RSS['children'][$i]['children']); $j++)
	{
		$PRS[$RSS['children'][$i]['children'][7]['content']][$RSS['children'][$i]['children'][$j]['name']] = $RSS['children'][$i]['children'][$j]['content'];
	}
}
//=====1차 배열 이름=====
//USD(미국),JPY(일본),EUR(유럽연합),CNY(중국),CHF(스위스),CAD(캐나다),AUD(호주),NZD(뉴질랜드),HKD(홍콩),SEK(스웨덴),DKK(덴마크)
//NOK(노르웨이),SAR(사우디아라비아),KWD(쿠웨이트),BHD(바레인),AED(아랍에미),THB(태국),SGD(싱가포르),INR(인도),MYR(말레이시아)
//IDR(인도네시아),PKR(파키스탄),BDT(방글라데시),PHP(필리핀),EGP(이집트),MXN(멕시코),BRL(브라질),TWD(대만),BND(브루나이),ILS(이스라엘),JOD(요르단)
//=====2차 배열 이름=====
//ename(국가:영문),hname(국가:영문),standard(기준),buy(살때),sell(팔때),send(송신),receive(수신),sign(통화),m_name(통화명),change_val

?>
<p class="right"><small>Update <?=substr(getDateFormat($RSS['children'][0]['content'],'xxxx.xx.xx xx:xx'),5)?></small></p>
<table class="table-row">
<colgroup>
<col />
<col />
<col style="color:red;" />
<col style="color:blue;" />
</colgroup>
<thead>
	<tr>
		<th>국가</th>
		<th>기준</th>
		<th>살때</th>
		<th>팔때</th>
	</tr>
</thead>
<tbody>
	<tr>
		<th class="fts11"><?=$PRS['USD']['hname']?></th>
		<td class="exchage"><?=$PRS['USD']['standard']?></td>
		<td class="exchage"><?=$PRS['USD']['buy']?></td>
		<td class="exchage"><?=$PRS['USD']['sell']?></td>
	</tr>
	<tr>
		<th class="fts11"><?=$PRS['JPY']['hname']?></th>
		<td class="exchage"><?=$PRS['JPY']['standard']?></td>
		<td class="exchage"><?=$PRS['JPY']['buy']?></td>
		<td class="exchage"><?=$PRS['JPY']['sell']?></td>
	</tr>
	<tr>
		<th class="fts11"><?=$PRS['EUR']['hname']?></th>
		<td class="exchage"><?=$PRS['EUR']['standard']?></td>
		<td class="exchage"><?=$PRS['EUR']['buy']?></td>
		<td class="exchage"><?=$PRS['EUR']['sell']?></td>
	</tr>
	<tr>
		<th class="fts11"><?=$PRS['CNY']['hname']?></th>
		<td class="exchage"><?=$PRS['CNY']['standard']?></td>
		<td class="exchage"><?=$PRS['CNY']['buy']?></td>
		<td class="exchage"><?=$PRS['CNY']['sell']?></td>
	</tr>
	<tr>
		<th class="fts11"><?=$PRS['CHF']['hname']?></th>
		<td class="exchage"><?=$PRS['CHF']['standard']?></td>
		<td class="exchage"><?=$PRS['CHF']['buy']?></td>
		<td class="exchage"><?=$PRS['CHF']['sell']?></td>
	</tr>
</tbody>
</table>
