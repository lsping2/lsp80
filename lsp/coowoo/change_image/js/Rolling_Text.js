	                    <!--
	                        var DownLayer2Id2;
	                        var dropDegree2 = 10;
	                        var doDirect2;
	                        var DirectTerm2 = 4500;
	                        var curDropIdx2 = 0;
                       
	                        function RollingDown_Text(){
	                            clearInterval(doDirect2);
	                            clearInterval(DownLayer2Id2);
                            
	                            for(i = curDropIdx2 ;i < document.all["RollingText"].length + curDropIdx2;i++){
	                                document.all["RollingText"][i%document.all["RollingText"].length].style.posTop = document.all["RollingText"][i%document.all["RollingText"].length].style.posHeight * (-1*((i-curDropIdx2)%document.all["RollingText"].length));
	                            }  
                            
		                        var temp = 'setInterval("DownLayer2()",20)';                            
			                    DownLayer2Id2 = eval(temp);
				                direction = "up";
	                        }
                       
	                        function DownLayer2(){
			                    if(document.all["RollingText"][curDropIdx2].style.posTop < document.all["RollingText"][curDropIdx2].style.posHeight)
	                            {
	                                for(j = curDropIdx2 ;j < document.all["RollingText"].length + curDropIdx2;j++){
	                                    document.all["RollingText"][j%document.all["RollingText"].length].style.posTop += dropDegree2;
	                                }
	                            }
	                            else{
	                                clearInterval(DownLayer2Id2);
	                                
	                                for(j = curDropIdx2 ;j < document.all["RollingText"].length + curDropIdx2;j++){
	                                    document.all["RollingText"][j%document.all["RollingText"].length].style.posTop = document.all["RollingText"][j%document.all["RollingText"].length].style.posHeight *((-1*((j-curDropIdx2)%document.all["RollingText"].length))+1);
	                                }
	                                curDropIdx2 = (curDropIdx2 + 1) ;
	                                curDropIdx2 = curDropIdx2 > document.all["RollingText"].length-1 ? curDropIdx2%document.all["RollingText"].length:curDropIdx2;
	                                var temp = 'setInterval("RollingDown_Text()",DirectTerm2)';
	                                doDirect2 = eval(temp);
	                            }
	                        }
                       
		                    function RollingUp_Text(){
	                            clearInterval(doDirect2);
	                            clearInterval(DownLayer2Id2);
	                            var tempIdx = 0;
	                            for(i = 0;i<document.all["RollingText"].length;i++){
	                                tempIdx = (document.all["RollingText"].length + curDropIdx2 - i) %document.all["RollingText"].length;
                                
	                                document.all["RollingText"][tempIdx].style.posTop = i*document.all["RollingText"][tempIdx].style.posHeight;
                                
		                        }  
                            
	                            var temp = 'setInterval("UpLayer2()",20)';                            
	                            DownLayer2Id2 = eval(temp);
	                            direction = "up";
	                        }
                       
	                        function UpLayer2(){
	                            var tempIdx = 0;
	                            if(document.all["RollingText"][curDropIdx2].style.posTop < document.all["RollingText"][curDropIdx2].style.posHeight && document.all["RollingText"][curDropIdx2].style.posTop > document.all["RollingText"][curDropIdx2].style.posHeight * (-1))
	                            {
	                                for(j = 0 ;j < document.all["RollingText"].length;j++){
	                                    tempIdx = (document.all["RollingText"].length + curDropIdx2 - j) %document.all["RollingText"].length;
	                                    document.all["RollingText"][tempIdx].style.posTop -= dropDegree2;
	                                }
	                            }
	                            else{
	                                clearInterval(DownLayer2Id2);
	                                for(j = 0;j<document.all["RollingText"].length;j++){
	                                    tempIdx = (document.all["RollingText"].length + curDropIdx2 - j) % document.all["RollingText"].length;
	                                    
	                                    document.all["RollingText"][tempIdx].style.posTop = (j-1)*(document.all["RollingText"][tempIdx].style.posHeight);  
	                                }
	                                curDropIdx2 = (curDropIdx2 - 1) ;
	                                curDropIdx2 = curDropIdx2 < 0 ? document.all["RollingText"].length-1:curDropIdx2;
	                                var temp = 'setInterval("RollingUp_Text()",DirectTerm2)';
	                                doDirect2 = eval(temp);
	                            }
	                        }

                        RollingDown_Text();
                        //-->