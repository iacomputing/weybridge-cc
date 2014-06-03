<?php
class style {

private $title;


function __construct(){
if (session_id() == "")  session_start();
}

//head function
public function head($title, $description){
$this->title = $title;
global $CFG;
	//store previous pages - for the dead link error.log file
	if (isset($_SERVER['HTTP_REFERER'])){
		if (!isset($_SESSION['lastPage'])){
		$_SESSION['lastPage'] = $_SERVER['HTTP_REFERER'];
		} elseif (basename($_SESSION['lastPage']) != $CFG->wwwroot."/error/error.php"){
		$_SESSION['lastPage'] = $_SERVER['HTTP_REFERER'];
		}
	}
	
	//gzip compression
	if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) { 
	ob_start("ob_gzhandler"); 
	} else { 
	ob_start(); 
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Weybridge,Weybridge CC,Weybridge Childrens Centre,Sure Start Weybridge" />
<meta name="description" content="<?=$description;?>" />
<meta name="google-translate-customization" content="9fa1bb93add829b0-b2909cfa83e4d3e3-ge1c0eb85680ac44d-14"></meta>
<title><?= $this->title; ?> :: Weybridge Children's Centre</title>
<link href="/priv/css/media_screen.min.css?v=<?=$CFG->v;?>" rel="stylesheet" type="text/css" />
<link href='/priv/css/blue.min.css?v=1' rel='stylesheet' type='text/css' />
<?php
switch ($this->title) {
    case "Our Services":
        echo"<link href='/priv/css/green.min.css?v=1' rel='stylesheet' type='text/css' />";
        break;
    case "Activities":
        echo"<link href='/priv/css/orange.min.css?v=1' rel='stylesheet' type='text/css' />";
        break;	
    case "Contact Us":
        echo"<link href='/priv/css/red.min.css?v=1' rel='stylesheet' type='text/css' />";
        break;	
    case "Friends":
        echo"<link href='/priv/css/red.min.css?v=1' rel='stylesheet' type='text/css' />";
        break;					
    case "Links":
        echo"<link href='/priv/css/darkpink.min.css?v=1' rel='stylesheet' type='text/css' />";
        break;						
}
?>
<link href='/priv/css/jquery.lightbox-0.5.css?v=1' rel='stylesheet' type='text/css' />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:600italic' rel='stylesheet' type='text/css' />
<script src="/priv/javascripts/jquery.min.js?v=<?=$CFG->v;?>" type="text/javascript"></script>
<script src="/priv/javascripts/jquery.cookies.js?v=<?=$CFG->v;?>" type="text/javascript"></script>
<script src='/priv/javascripts/jquery.lightbox-0.5.js' type='text/javascript'></script>
<script src="/priv/javascripts/cufon-yui.js" type="text/javascript"></script>
<?php
if($this->title == "Contact Us"){?>
<script src='/priv/javascripts/jquery.validate.min.js' type='text/javascript'></script>
<script type="text/javascript">  
  $(document).ready(function(){
    $("#commentForm").validate();
  });
</script>
<?php	
}
?>
</head>
<?php
}

public function title($title){
	global $CFG;
?>
<body>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-16388402-3']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<div class="frame">
  <div class="header">
    <div class="logo"> <a href="/index.php"><img src="/images/logo.jpg" width="302" height="239" alt="Weybridge CC Logo" /></a></div>
    <div style="clear:both; height:0px;"></div>
    <div class="title">
		<h1><?=$this->title;?></h1>
    </div>
  </div>
  <div class="nav">
    <div class="button" id="purple"> <a href="/index.php">&nbsp;</a> </div>
    <div class="button" id="blue"> <a href="/theteam.php">&nbsp;</a> </div>
    <?php if($this->title == "The Team"){
	   echo"<ul>".
	   "<li><a href='#daphne'>Daphne Sohl</a></li>".
	   "<li><a href='#sarah'>Sarah Kroner</a></li>".
	   "<li><a href='#yvette'>Yvette Stephens</a></li>".
	   "<li><a href='#katie'>Katie Vinnicombe</a></li>".
	   "</ul>";
   }
   ?>
   <div class="button" id="green"> <a href="/ourservices.php">&nbsp;</a> </div>
    <?php if($this->title == "Our Services"){
	   echo"<ul>".
	   "<li><a href='#yourcentre'>Your Weybridge CC</a></li>".
	   "<li><a href='#infoadvice'>Information &amp; Advice</a></li>".
	   "<li><a href='#outreach'>Outreach</a></li>".
	   "<li><a href='#dropinsessions'>Drop In Sessions</a></li>".
	   "<li><a href='#familysupport'>Family Support</a></li>".
	   "<li><a href='#trainingemploymentadvice'>Training &amp; Employment Advice</a></li>".
	   "<li><a href='#policies'>Policies</a></li>".
	   "</ul>";
   }
   ?>
    <div class="button" id="orange"> <a href="/activities.php">&nbsp;</a> </div>
    <?php if($this->title == "Activities"){
	   echo"<ul>".
	   "<li><a href='#monday'>Mondays</a></li>".
	   "<li><a href='#tuesday'>Tuesdays</a></li>".
	   "<li><a href='#wednesday'>Wednesdays</a></li>".
	   "<li><a href='#thursday'>Thursdays</a></li>".
	   "<li><a href='#friday'>Fridays</a></li>".
	   "<li><a href='#saturday'>Saturdays</a></li>".	   
	   "<li><a href='#other'>Other Activities</a></li>".
	   "</ul>";
   }
   ?>
    <div class="button" id="red"> <a href="/contactus.php">&nbsp;</a> </div>
    <div class="button" id="pink"> <a href="/friends.php">&nbsp;</a> </div>
    <?php if($this->title == "Friends"){
	   echo"<ul>".
	   "<li><a href='#families'>Friends</a></li>".
	   "<li><a href='#thankyou'>Thank You</a></li>".
	   "<li><a href='#localbusiness'>Families</a></li>".
	   "</ul>";
   }
   ?>
    <div class="button" id="darkpink"> <a href="/links.php">&nbsp;</a> </div>
    <?php if($this->title == "Links"){
	   echo"<ul>".
	   "<li><a href='#'>General Information</a></li>".
	   "<li><a href='#health'>Health</a></li>".
	   "<li><a href='#children'>Children/Young People's Support</a></li>".
	   "<li><a href='#finance'>Finance</a></li>".
	   "<li><a href='#parent'>Parent Support</a></li>".
	   "<li><a href='#childcare'>Childcare &amp; Education</a></li>".
	   "<li><a href='#understandingchildhood'>Understanding Childhood</a></li>".
	   "</ul>";
   }
   ?>
    <div style="text-align:center; margin-top: 10px;"><a href="http://www.dcsf.gov.uk/everychildmatters/earlyyears/surestart/whatsurestartdoes/" target="_blank"><img src="/images/surestart.jpg" width="177" height="38" alt="Sure Start Children Centres" /></a><br />
      <br />
      <a href="http://www.education.gov.uk/" target="_blank"><img src="/images/dfe-logo.jpg" width="175" height="51" alt="DCSF" /></a> <br />
      <br />
      <a href="http://www.surreycc.gov.uk/" target="_blank"><img src="/images/surreycc.min.jpg" width="104" height="80" alt="Surrey County Council" /></a><a href="http://www.cleves.co.uk/" target="_blank"><img src="/images/cleves.jpg" width="56" height="80" alt="Surrey County Council" /></a><br />
      <br />
      <img src="/images/phone.jpg" width="16" height="16" alt="Tel:" />01932 820106<br />
      <img src="/images/email.jpg" width="16" height="16" alt="Email:" />contactus@weybridgecc.org<br>
<br>

      <div id="google_translate_element"></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, gaTrack: true, gaId: 'UA-16388402-3'}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        
      </div>
  </div>
  <div class="contentframe">
    <?php
}

public function footer(){
global $CFG;
?>
  </div>
  <div class="footer"><img src="/images/footer.min.jpg" width="600" height="118" alt="DCSF" /><br />
    &copy; Weybridge Childrens Centre
    <?php $year = getdate(); echo $year['year'];?>
    <br />
    <a href="/privacy-policy.php">Privacy Policy</a> | <a href="http://www.iacomputing.co.uk/Services/Website-Design.php" target="_blank" style="font-weight:normal; color:#000;">Web Design Surrey:</a> <a href="http://www.iacomputing.co.uk" target="_blank">IA Computing</a> </div>
</div>
</body>
</html>
<?php
}
}
?>