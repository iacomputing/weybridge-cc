<?php
class captcha {

private $bgimages = array();
private $bg;
private $font;
private $fonts;
private $filename;
private $colour;
private $fontSize;
private $image;
private $minFontSize;
private $maxFontSize;
private $str;
private $allowedChars = array();
private $length;
private $bgPath;
private $width;
private $height;
private $captchaStr;
private $salt;


function __construct(){
	global $CFG;	
	
	//backgrounds path
	$this->bgPath = $CFG->dirroot."/priv/includes/classes/captcha";
	
	//length of capctha string
	$this->length = 5;
	
	//prevent characters that could be mistaken - i.e '1', 'l' and 'I' or 'O' and '0'
	$this->allowedChars = array('a','b','c','d','e','f','g','h','j','k','m','n','p','q','r','s','t','u','v','w','x','y','2','3','4','5','6','7','8','9');
	
	//width of image
	$this->width = '200';
	
	//height of image
	$this->height = '50';
	
	//min and max font sizes
	$this->minFontSize = 20;
	$this->maxFontSize = 26;
	$this->salt = 'GTRFK97N65VMY';

}

public function create(){
	
	$this->selectBG();
	$this->createString();
	$this->drawChar();
	//imagefilter($this->image, IMG_FILTER_GRAYSCALE);
	// add noise
	for ($c = 0; $c < 200; $c++){
		$x = rand(0,$this->width-1);
		$y = rand(0,$this->height-1);
		imagesetpixel($this->image, $x, $y, 0x000000);
	}
	imagefilter($this->image, IMG_FILTER_BRIGHTNESS, 60);
	//imagefilter($this->image, IMG_FILTER_NEGATE);
	$debug = 0;
	if ($debug != 1 ){
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");                  // Date in the past    
	header('Last-Modified: '.gmdate('D, d M Y H:i:s') . ' GMT'); 
	header('Cache-Control: no-store, no-cache, must-revalidate');     // HTTP/1.1 
	header('Cache-Control: pre-check=0, post-check=0, max-age=0');    // HTTP/1.1 
	header ("Pragma: no-cache"); 
	header("Expires: 0"); 
	header("Content-type: image/png");
	imagejpeg($this->image);
	readfile($this->image);
	//echo $_SESSION['captcha'];
	}
}

public function verify($input){
	$input = hash("sha512",(md5(strtoupper($input).$this->salt))); 
	//echo "input: $input<br />S".$_SESSION['captcha'];
	if ($input != $_SESSION['captcha']){
		return false;	
	} else {
		return true;
	}
}

private function selectBG(){
	//init file array position counter
	$i = -1;
	foreach (glob($this->bgPath.'/'."*.jpg") as $file){
		//increment array pos	
		$i++;
		//add item to file
		$this->bgimages[] = $file;
		
	}
	$this->filename = $this->bgimages[rand(0, $i)];
	$this->image = imagecreatefromjpeg($this->filename);
	//$this->image = imagecreatetruecolor(200, 50);
	//imagefilter($this->bg, IMG_FILTER_COLORIZE, 0, 0, 100);
	imagefilter($this->image, IMG_FILTER_BRIGHTNESS, 20);
	//imagefilter($this->bg, IMG_FILTER_CONTRAST, -20);
	//imagefilter($this->bg, IMG_FILTER_GRAYSCALE);
	//imagefilter($this->bg, IMG_FILTER_NEGATE);
	//imagefilter($this->bg, IMG_FILTER_PIXELATE, 2, true);
	//imagefilter($this->bg, IMG_FILTER_EDGEDETECT);
	//imagefilter($this->bg, IMG_FILTER_EMBOSS);
	//imagefilter($this->bg, IMG_FILTER_GAUSSIAN_BLUR);
	//imagefilter($this->bg, IMG_FILTER_SELECTIVE_BLUR);
	//imagefilter($this->bg, IMG_FILTER_MEAN_REMOVAL);
	//imagefilter($this->bg, IMG_FILTER_SMOOTH, 50);
	
}

private function drawChar(){
	
	$spacing = (int)(($this->width -5) / $this->length);
	
	for($i=0; $i < $this->length; $i++){
	$this->selectFont();
	$this->selectFontColour();
	$this->selectFontSize();
	$this->selectFontAngle();
	
	$charDetails = imagettfbbox($this->fontSize, $this->angle, $this->font, $this->str[$i]);
	
	// calculate character starting coordinates
	$x = $spacing / 4 + $i * $spacing;
	$charHeight = $charDetails[2] - $charDetails[5];
	$y = $this->height / 2 + $charHeight / 4;
	
	
	
	imagettftext($this->image, $this->fontSize, $this->angle, $x, $y, $this->colour, $this->font, $this->str[$i]);
	}
}

private function selectFont(){
	//init file array position counter
	$i = -1;
	foreach (glob($this->bgPath.'/'."*.ttf") as $file){
		//increment array pos	
		$i++;
		//add item to file
		$this->fonts[] = $file;
	}
	$this->font = $this->fonts[rand(0, $i)];
}

private function selectFontColour(){
	
	$this->colour = imagecolorallocate($this->image, rand(20, 60), rand(20, 60), rand(60, 90));
	return;

}

private function selectFontSize(){
	$this->fontSize = rand($this->minFontSize, $this->maxFontSize);
}

private function selectFontAngle(){
	$this->angle = rand(-30, 30);
}

private function createString(){
	unset($_SESSION['captcha']);
	
	for ($i=0;$i<$this->length; $i++){
	$this->str[] =	strtoupper($this->allowedChars[mt_rand(0,count($this->allowedChars)-1)]);
	$this->captchaStr .= $this->str[$i];
	}
	//echo $this->captchaStr."<br /><br />";
	$this->captchaStr =  hash("sha512",(md5(strtoupper($this->captchaStr).$this->salt))); 
	
	$_SESSION['captcha'] = $this->captchaStr;
	//echo $_SESSION['captcha'];
	return;
}

}
?>