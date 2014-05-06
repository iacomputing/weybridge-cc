<?php
include "priv/config.php";
session_start();
global $CFG;

header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");                  // Date in the past    
header('Last-Modified: '.gmdate('D, d M Y H:i:s') . ' GMT'); 
header('Cache-Control: no-store, no-cache, must-revalidate');     // HTTP/1.1 
header('Cache-Control: pre-check=0, post-check=0, max-age=0');    // HTTP/1.1 
header ("Pragma: no-cache"); 
header("Expires: 0"); 

include "captcha.class.php";
$captcha = new captcha;
$style = new style;
$description = "There are several ways to contact Weybridge CC. Call us on 01932 300106, Email us at contactus@weybridgecc.org or Visit us at The Churchfield Pavilion, Churchfield Road, Weybridge, Surrey, KT13 8DB";
$style->head("Contact Us", $description);
$style->title("Contact Us");

$name = "";
$email = "";
$subject = "";
$feedback = "";

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['feedback']) && isset($_POST['verif_box'])){
	if($captcha->verify($_POST['verif_box'])){		
		$to = "contactus@weybridgecc.org";
		$subject = $_POST['subject']." :: Weybridge Website Contact Form";
		$message = $_POST['feedback'];
		$from = $_POST['email'];
		$headers = "From: $from";
		mail($to,$subject,$message,$headers);
		$mailsent = 1;
	}
	else {
	// if verification code was incorrect then return to contact page and show error
		$wc = "true";
		$name = $_POST['name'];
		$email = $_POST['email'];
		$subject = $_POST['subject'];
		$feedback = $_POST['feedback'];
	}
}
?>

<div class="box">
  <div class="content">
    
    <div class="bar"></div>
    <h2> Address </h2>
Weybridge Sure Start Children's Centre,<br />
The Churchfield Pavilion,<br />
Churchfield Road,<br />
Weybridge,<br />
Surrey,<br />
KT13 8DB
    <h2> Telephone </h2>
01932 820106<br />
    <h2> Email </h2>
Daphne Sohl - Centre Leader - <a href="mailto:centreleader@weybridgecc.org">centreleader@weybridgecc.org</a><br />
Sarah Kroner - Outreach Worker - <a href="mailto:outreachworker@weybridgecc.org">outreachworker@weybridgecc.org</a><br />
Yvette Stephens & Katie Vinnicombe - Centre Advisers - <a href="mailto:centreadvisers@weybridgecc.org ">centreadvisers@weybridgecc.org </a><br />
<br />

  </div>
  <div class="bottom"> </div>
</div>
<div class="box">
  <div class="top">
    <h1> <a name="thursday" id="infoadvice4"></a>Feedback Form</h1>
    <div class="bar"></div>
  </div>
  <div class="content">
    <p />
    <form action="contactus.php" id="commentForm" method="post">
    <label for="name" style="display:block;">Name <span style="color:#F00">*</span></label>
    <input name="name" type="text" style="border:#F00 solid thin;" class="required" value="<?=$name;?>"/>
    <br />
    <br />
    <label for="email" style="display:block;">Email Address <span style="color:#F00">*</span></label>
    <input name="email" type="email" style="border:#F00 solid thin;" class="required email" value="<?=$email;?>"/>
    <br />
    <br />
    <label for="subject" style="display:block;">Subject <span style="color:#F00">*</span></label>
    <input name="subject" type="text" style="border:#F00 solid thin;" class="required" value="<?=$subject;?>"/>    
    <br />
    <br />    
    <label for="feedback" style="display:block;">Feedback <span style="color:#F00">*</span></label>
    <textarea name="feedback" style="width: 300px; height:100px; border:#F00 solid thin;" class="required" minlength="1"><?=$feedback;?></textarea>
	<br />
    <br />
    <label style="display:block;" for="verif_box">Please enter the text*:</label>
    <img name="captcha" id="captcha" src="<?=$CFG->wwwroot;?>/lib/captcha.php" alt="This is a verification image, type it in the box." height="50" style="cursor:pointer; display:block; margin-left: 2px;" onClick="reloadImg();"/>
    <input name="verif_box" type="text" id="verif_box" title="Enter the text shown above here." minlength="5" maxlength="5" class="required" />
    <?php if (isset($wc)){ ?>
    <script>$("#verif_box").valid();</script>
    <?php } ?>
    <br />
    <br />
    <input name="submit" type="submit" style=""/>
    </form>
    </div>
  <div class="bottom"> </div>
</div>
<?php $style->footer(); ?>
