<script src="/js/jquery-1.8.3.min.js"></script>
<meta charset="utf-8">
<?
include_once('./jquery-ui/datepicker.php'); 
?>

<form name="res_form">
<Table>
<tr>
   <td class="typd20"><font color="#FF0000">*</font> Pick-up Date</td>
   <td class="typd4"><input type="text" name="s_ymd" id="s_ymd" class="datepicker" style="width:100px; height:26px; vertical-align:bottom;border:1px solid #DFDFDF; background-color:#E7EAFC; cursor:pointer;" readonly></td>
   <td class="typd20"><font color="#FF0000">*</font> Drop-off Date</td>
   <td class="typd4">
	   <span><input type="text" name="e_ymd" id="e_ymd"  class="datepicker" style="width:100px; height:26px; vertical-align:bottom;border:1px solid #DFDFDF; background-color:#E7EAFC; cursor:pointer;" readonly onfocus="fn_Duration();">
	   <span style="padding:0 0 0 5px;"><input type="text" name="hope_term" id="hope_term" value="0" style="width:40px;"  onfocus="fn_Duration();"  class="input_basic" readonly></span>
	   <span>Days</span>
   </td>
</tr>
</table>
</form>

<script>
	$(function(){ // 날짜 입력
		$("#s_ymd, #e_ymd").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true });
	});


   function fn_Duration(){

      var s_day = document.getElementById("s_ymd").value;
      var e_day = document.getElementById("e_ymd").value;
      
      
      if((s_day.length ==10)&&(e_day.length ==10)){

         if (s_day==e_day){
      	  	 var s_year  = s_day.substring(0,4);
            var s_month = s_day.substring(5,7);
            var s_day   = s_day.substring(8,10);
            var e_year  = e_day.substring(0,4);
            var e_month = e_day.substring(5,7);
            var e_day   = e_day.substring(8,10);
  
            a1=new Date(s_year,s_month-1,s_day).getTime(); 
            a2=new Date(e_year,e_month-1,e_day).getTime();

            iAddDays=parseInt((a2-a1)/(1000*60*60*24),10);
            document.res_form.hope_term.value = iAddDays+1;

      	  }else{

            var s_year  = s_day.substring(0,4);
            var s_month = s_day.substring(5,7);
            var s_day   = s_day.substring(8,10);
            var e_year  = e_day.substring(0,4);
            var e_month = e_day.substring(5,7);
            var e_day   = e_day.substring(8,10);
  
            a1=new Date(s_year,s_month-1,s_day).getTime(); 
            a2=new Date(e_year,e_month-1,e_day).getTime();

            iAddDays=parseInt((a2-a1)/(1000*60*60*24),10);
            document.res_form.hope_term.value = iAddDays;
         }
      }
   }
</script>