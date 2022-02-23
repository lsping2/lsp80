<?

class HTML
{

	var $title		= "Anchorwave";
	var $subject		= "Anchorwave";
	var $description	= "";
	var $keywords	= "Anchorwave";
	var $charset		= "euc-kr";
	var $author		= "";
	var $favicon_url	= "http://wave.zedna.com";



	function Title( $location = "" )
	{
		switch( $location )
		{
			case 'User'	:
							echo "Anchorwave 유저화면";
							break;
			case 'Admin'	:
							echo "Anchorwave 관리자화면";
							break;
			default		:
							echo ":: Anchorwave ::";
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
