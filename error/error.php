<?php include "../priv/config.php"; 
session_start();
$style = new style;
$style->head("Error");
?>
</head>
<body>
<?php
$style->title();

if(isset($_GET['e'])){
$e = $_GET['e'];
echo "You have recieved error ".$e.".<br />";
	switch ($e){
	case "400": echo "Bad Request."; break;
	case "401": echo "Unauthorized."; break;
	case "403": echo "Access Forbidden."; break;
	case "404": echo "Page Not Found."; break;
	case "405": echo "Method Not Allowed."; break;
	case "408": echo "Request Timed Out."; break;
	case "410": echo "Page removed."; break;
	case "411": echo "Length Required."; break;
	case "412": echo "Precondition Failed."; break;
	case "413": echo "Request Entity Too Large."; break;
	case "414": echo "Request URI Too Large."; break;
	case "415": echo "Unsupported Media Type."; break;
	case "500": echo "Internal Server Error."; break;
	case "501": echo "Not Implemented."; break;
	case "502": echo "Bad Gateway."; break;
	case "503": echo "Service Unavailable."; break;
	case "506": echo "Variant Also Varies."; break;
	}
	echo "<br />";
	
	if ((isset($_SESSION['lastPage'])) && ($_SESSION['lastPage'] != "")){
	$fhd = fopen("deadlinks.log", 'a+') or die("can't open file");
	$theNewData = "[DEAD LINK]:".date("Y-m-d")." From: ".$_SESSION['lastPage'].chr(13).chr(10).
					"To: ".$_SERVER['REQUEST_URI'].chr(13).chr(10).chr(13).chr(10);
	fwrite($fhd, $theNewData)or die("can't write to file");
	fclose($fhd);
	}	
	
} else {
echo "Error.";
}
?>
<br /><br />

<a href="javascript: history.back();">Back</a> | <a href="<?php echo $CFG->wwwroot; ?>">Home</a>
<?php $style->footer(); ?>