
function formatCurrency(n)
{
	var reg = /(^[+-]?\d+)(\d{3})/;   // 정규식
    n += '';                          // 숫자를 문자열로 변환
    while (reg.test(n))
    n = n.replace(reg, '$1' + ',' + '$2');
  return n;
}

function float_change(float_val,chk_num){
    var num_format = 10;
    for (var i = 1; i < chk_num; i++) {
        num_format *= 10;
    }
    num_format = parseInt(num_format);
     return parseFloat(Math.round(parseFloat(float_val)*num_format)/num_format);    
}


function set_it(usd){
	$(".datatable *").remove();
	$.ajax({
		url: "https://api.coinmarketcap.com/v1/ticker/?limit=15", 
		dataType: "json", // json 타입으로 가져오기
		success: function (data) {
			$.each(data,function(index){
			  var c1=c2=c3 ="#339900";
			  var 	total = usd * (data[index].price_usd);
					total = formatCurrency(float_change(total,1));

			 var 	price_usd =  (data[index].price_usd);
					price_usd = formatCurrency(float_change(price_usd,1));
			if(data[index].percent_change_1h < 0) c1="#ff3300";
			if(data[index].percent_change_24h < 0) c2="#ff3300";
			if(data[index].percent_change_7h < 0) c3="#ff3300";
			
			$(".datatable").append( '<tr bgcolor="white"><td align=center>'+(data[index].rank)+'</td><td align=center>'+(data[index].symbol)+'<br><font color="#cdcdcd">'+(data[index].name)+'</font></td><td align=right>'+total+'</td><td align=right>'+price_usd+'</td><td align=right>'+(data[index].price_btc)+'</td><td align=center><font color="'+c1+'">'+(data[index].percent_change_1h)+'</font></td><td align=center><font color="'+c2+'">'+(data[index].percent_change_24h)+'</font></td><td align=center><font color="'+c3+'">'+(data[index].percent_change_7d)+'</font></td></tr>');
			});	
		}
	});

	$(".datatable2").show();
	setTimeout(function(){
		set_it(usd);
	},10000);
	

}