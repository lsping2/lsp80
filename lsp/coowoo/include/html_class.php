<?

class HTML
{

	var $title		= "�̹������";
	var $subject		= "����, �ؿ� �̹��� �Ǹ� ����Ʈ - �̹������";
	var $description	= "";
	var $keywords	= "�̹���, image, �̱��̹���, single, �̹����õ�, imagecd, �ǽð� �ٿ�ε�, �̹����Ǹ�, VCD, V-CD";
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
							echo "�̹������ ����ȭ��";
							break;
			case 'Admin'	:	
							echo "�̹������ ������ȭ��";
							break;
			default		:	
							echo ":: �̹������ ::";
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
