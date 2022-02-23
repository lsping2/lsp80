<?

class HTML
{

	var $title		= "이미지쿠우";
	var $subject		= "국내, 해외 이미지 판매 사이트 - 이미지쿠우";
	var $description	= "";
	var $keywords	= "이미지, image, 싱글이미지, single, 이미지시디, imagecd, 실시간 다운로드, 이미지판매, VCD, V-CD";
	var $charset		= "euc-kr";
	var $author		= "webmaster@coowoo.com";
	var $favicon_url	= "http:://www.coowoo.com/favicon.ico";

	function HTML()
	{
	}

	function Title( $location = "" )
	{
		switch( $location )
		{
			case 'User'	:
							echo "이미지쿠우 유저화면";
							break;
			case 'Admin'	:	
							echo "이미지쿠우 관리자화면";
							break;
			default		:	
							echo ":: 이미지쿠우 ::";
		}
	}

	function Metatag()
	{
		echo "<META name=\"Subject\" content=\"" . $this->title . "\">\n<META name=\"description\" content=\"" . $this->description . "\">\n<META name=\"keywords\" content=\"" . $this->keywords ."\">\n<META http-equiv=\"content-type\" content=\"text/html; charset=" . $this->charset . "\">\n<META name=\"Author\" content=\"" . $this->author . "\">\n";
	}

	function Favicon()
	{
		echo "<META HTTP-EQUIV=\"Expires\" CONTENT=\"0\">\n<link rel=\"shortcut icon\" href=\"" . $this->favicon_url . "\">\n";
	}

}

?>
