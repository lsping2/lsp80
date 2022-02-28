	                    <!--
	                        var downLayerId;
	                        var dropDegree = 10;
	                        var doDirect;
	                        var DirectTerm = 4500;
	                        var curDropIdx = 0;
                       
	                        function RollingDown(){
	                            clearInterval(doDirect);
	                            clearInterval(downLayerId);
                            
	                            for(i = curDropIdx ;i < document.all["RollingText"].length + curDropIdx;i++){
	                                document.all["RollingText"][i%document.all["RollingText"].length].style.posTop = document.all["RollingText"][i%document.all["RollingText"].length].style.posHeight * (-1*((i-curDropIdx)%document.all["RollingText"].length));
	                            }  
                            
		                        var temp = 'setInterval("DownLayer()",20)';                            
			                    downLayerId = eval(temp);
				                direction = "down";
	                        }
                       
	                        function DownLayer(){
			                    if(document.all["RollingText"][curDropIdx].style.posTop < document.all["RollingText"][curDropIdx].style.posHeight)
	                            {
	                                for(j = curDropIdx ;j < document.all["RollingText"].length + curDropIdx;j++){
	                                    document.all["RollingText"][j%document.all["RollingText"].length].style.posTop += dropDegree;
	                                }
	                            }
	                            else{
	                                clearInterval(downLayerId);
	                                
	                                for(j = curDropIdx ;j < document.all["RollingText"].length + curDropIdx;j++){
	                                    document.all["RollingText"][j%document.all["RollingText"].length].style.posTop = document.all["RollingText"][j%document.all["RollingText"].length].style.posHeight *((-1*((j-curDropIdx)%document.all["RollingText"].length))+1);
	                                }
	                                curDropIdx = (curDropIdx + 1) ;
	                                curDropIdx = curDropIdx > document.all["RollingText"].length-1 ? curDropIdx%document.all["RollingText"].length:curDropIdx;
	                                var temp = 'setInterval("RollingDown()",DirectTerm)';
	                                doDirect = eval(temp);
	                            }
	                        }
                       
		                    function RollingUp_TEXT(){
	                            clearInterval(doDirect);
	                            clearInterval(downLayerId);
	                            var tempIdx = 0;
	                            for(i = 0;i<document.all["RollingText"].length;i++){
	                                tempIdx = (document.all["RollingText"].length + curDropIdx - i) %document.all["RollingText"].length;
                                
	                                document.all["RollingText"][tempIdx].style.posTop = i*document.all["RollingText"][tempIdx].style.posHeight;
                                
		                        }  
                            
	                            var temp = 'setInterval("UpLayer()",20)';                            
	                            downLayerId = eval(temp);
	                            direction = "up";
	                        }
                       
	                        function UpLayer(){
	                            var tempIdx = 0;
	                            if(document.all["RollingText"][curDropIdx].style.posTop < document.all["RollingText"][curDropIdx].style.posHeight && document.all["RollingText"][curDropIdx].style.posTop > document.all["RollingText"][curDropIdx].style.posHeight * (-1))
	                            {
	                                for(j = 0 ;j < document.all["RollingText"].length;j++){
	                                    tempIdx = (document.all["RollingText"].length + curDropIdx - j) %document.all["RollingText"].length;
	                                    document.all["RollingText"][tempIdx].style.posTop -= dropDegree;
	                                }
	                            }
	                            else{
	                                clearInterval(downLayerId);
	                                for(j = 0;j<document.all["RollingText"].length;j++){
	                                    tempIdx = (document.all["RollingText"].length + curDropIdx - j) % document.all["RollingText"].length;
	                                    
	                                    document.all["RollingText"][tempIdx].style.posTop = (j-1)*(document.all["RollingText"][tempIdx].style.posHeight);  
	                                }
	                                curDropIdx = (curDropIdx - 1) ;
	                                curDropIdx = curDropIdx < 0 ? document.all["RollingText"].length-1:curDropIdx;
	                                var temp = 'setInterval("RollingUp_TEXT()",DirectTerm)';
	                                doDirect = eval(temp);
	                            }
	                        }

                        RollingDown();
                        //-->