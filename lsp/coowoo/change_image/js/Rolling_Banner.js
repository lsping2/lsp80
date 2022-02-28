	                    <!--
	                        var downLayerId;
	                        var dropDegree = 10;
	                        var doDirect;
	                        var DirectTerm = 4500;
	                        var curDropIdx = 0;
                       
	                        function RollingDown(){
	                            clearInterval(doDirect);
	                            clearInterval(downLayerId);
                            
	                            for(i = curDropIdx ;i < document.all["RollingBanner"].length + curDropIdx;i++){
	                                document.all["RollingBanner"][i%document.all["RollingBanner"].length].style.posTop = document.all["RollingBanner"][i%document.all["RollingBanner"].length].style.posHeight * (-1*((i-curDropIdx)%document.all["RollingBanner"].length));
	                            }  
                            
		                        var temp = 'setInterval("DownLayer()",20)';                            
			                    downLayerId = eval(temp);
				                direction = "down";
	                        }
                       
	                        function DownLayer(){
			                    if(document.all["RollingBanner"][curDropIdx].style.posTop < document.all["RollingBanner"][curDropIdx].style.posHeight)
	                            {
	                                for(j = curDropIdx ;j < document.all["RollingBanner"].length + curDropIdx;j++){
	                                    document.all["RollingBanner"][j%document.all["RollingBanner"].length].style.posTop += dropDegree;
	                                }
	                            }
	                            else{
	                                clearInterval(downLayerId);
	                                
	                                for(j = curDropIdx ;j < document.all["RollingBanner"].length + curDropIdx;j++){
	                                    document.all["RollingBanner"][j%document.all["RollingBanner"].length].style.posTop = document.all["RollingBanner"][j%document.all["RollingBanner"].length].style.posHeight *((-1*((j-curDropIdx)%document.all["RollingBanner"].length))+1);
	                                }
	                                curDropIdx = (curDropIdx + 1) ;
	                                curDropIdx = curDropIdx > document.all["RollingBanner"].length-1 ? curDropIdx%document.all["RollingBanner"].length:curDropIdx;
	                                var temp = 'setInterval("RollingDown()",DirectTerm)';
	                                doDirect = eval(temp);
	                            }
	                        }
                       
		                    function RollingUp(){
	                            clearInterval(doDirect);
	                            clearInterval(downLayerId);
	                            var tempIdx = 0;
	                            for(i = 0;i<document.all["RollingBanner"].length;i++){
	                                tempIdx = (document.all["RollingBanner"].length + curDropIdx - i) %document.all["RollingBanner"].length;
                                
	                                document.all["RollingBanner"][tempIdx].style.posTop = i*document.all["RollingBanner"][tempIdx].style.posHeight;
                                
		                        }  
                            
	                            var temp = 'setInterval("UpLayer()",20)';                            
	                            downLayerId = eval(temp);
	                            direction = "up";
	                        }
                       
	                        function UpLayer(){
	                            var tempIdx = 0;
	                            if(document.all["RollingBanner"][curDropIdx].style.posTop < document.all["RollingBanner"][curDropIdx].style.posHeight && document.all["RollingBanner"][curDropIdx].style.posTop > document.all["RollingBanner"][curDropIdx].style.posHeight * (-1))
	                            {
	                                for(j = 0 ;j < document.all["RollingBanner"].length;j++){
	                                    tempIdx = (document.all["RollingBanner"].length + curDropIdx - j) %document.all["RollingBanner"].length;
	                                    document.all["RollingBanner"][tempIdx].style.posTop -= dropDegree;
	                                }
	                            }
	                            else{
	                                clearInterval(downLayerId);
	                                for(j = 0;j<document.all["RollingBanner"].length;j++){
	                                    tempIdx = (document.all["RollingBanner"].length + curDropIdx - j) % document.all["RollingBanner"].length;
	                                    
	                                    document.all["RollingBanner"][tempIdx].style.posTop = (j-1)*(document.all["RollingBanner"][tempIdx].style.posHeight);  
	                                }
	                                curDropIdx = (curDropIdx - 1) ;
	                                curDropIdx = curDropIdx < 0 ? document.all["RollingBanner"].length-1:curDropIdx;
	                                var temp = 'setInterval("RollingUp()",DirectTerm)';
	                                doDirect = eval(temp);
	                            }
	                        }

                        RollingDown();
                        //-->