<?php
/*########################################################################################
## Standard Configuration File 
########################################################################################*/

unset($CFG);

$CFG->website_maintenance = 0;
$CFG->v = "0.0.0.1";

//development
if ($_SERVER['SERVER_NAME']== "localhost"){ //sitename - e.g. "adtracker"
$CFG->dbtype    = 'mysql';
$CFG->dbhost    = 'localhost';
$CFG->dbname    = 'dbname';
$CFG->dbuser    = 'root';
$CFG->dbpass    = 'rootwdp'; 
$CFG->wwwroot   = 'http://localhost/sites/weybridge/public_html';
$CFG->dirroot  	= 'c://xampp/htdocs/sites/weybridge/public_html';

ini_set(sendmail_from, "webforms@iacomputing.co.uk");
ini_set(SMTP, "iacserver2.iacomputing.co.uk");
ini_set(smtp_port, 25);
$CFG->enquiryemail = "marc@iacomputing.co.uk";

ini_set('display_errors', 1); 
error_reporting(E_ALL);

//testing - if not development
} elseif ($_SERVER['SERVER_NAME']== "weybridgecc"){ //sitename - e.g. "adtracker"
$CFG->dbtype    = 'mysql';
$CFG->dbhost    = 'localhost';
$CFG->dbname    = 'dbname';
$CFG->dbuser    = 'root';
$CFG->dbpass    = 'rootwdp'; 
$CFG->wwwroot   = 'http://weybridgecc';
$CFG->dirroot  	= 'c://xampp/htdocs/sites/weybridge/public_html';

ini_set(sendmail_from, "webforms@iacomputing.co.uk");
ini_set(SMTP, "iacserver2.iacomputing.co.uk");
ini_set(smtp_port, 25);
$CFG->enquiryemail = "marc@iacomputing.co.uk";

ini_set('display_errors', 1); 
error_reporting(E_ALL);

}elseif ($_SERVER['SERVER_NAME']== "testweb.iacomputing.co.uk"){
$CFG->dbhost    = 'localhost';
$CFG->dbname    = 'ianet_adtracker2';
$CFG->dbuser    = 'root';
$CFG->dbpass    = 'rootwdp'; 
$CFG->wwwroot   = 'http://testweb.iacomputing.co.uk/currentsites/daphne/public_html/';
$CFG->dirroot  	= 'c://xampp/htdocs/currentsites/daphne/public_html/';

ini_set(sendmail_from, "webforms@adtracker.iacomputing.net");
$CFG->enquiryemail = "enquiries@adtracker.iacomputing.net";

ini_set('display_errors', 0); 
error_reporting(E_ALL ^ E_NOTICE);
ini_set('log_errors', 'On');
ini_set('error_log','error_log.log');

//live
} else {

$CFG->dbhost    = '83.170.70.202';
$CFG->dbname    = 'ianet_adtracker2';
$CFG->dbuser    = 'ianet_webuser';
$CFG->dbpass    = 'F1n4l.F4nt4sy';
$CFG->wwwroot   = 'http://www.weybridgecc.org';
$CFG->dirroot  	= '/home/daphne/public_html';

ini_set(sendmail_from, "webforms@weybridgecc.org");
$CFG->enquiryemail = "daphsohl@googlemail.com";
	
ini_set('display_errors', 0); 
error_reporting(E_ALL ^ E_NOTICE);
ini_set('log_errors', 'On');
ini_set('error_log','error_log.log');
}

//Do Not Reply address for mailers
$CFG->donotreply = "donotreply@weybridgecc.org";

//include paths
set_include_path($CFG->dirroot.'/priv/'. PATH_SEPARATOR .
				$CFG->dirroot.'/priv/includes/'. PATH_SEPARATOR .
				$CFG->dirroot.'/priv/includes/classes/style/' . PATH_SEPARATOR .
				$CFG->dirroot.'/priv/includes/classes/captcha/'); // Include Paths

//default includes - whichever you need
//include "mysql.class.php";
//include "auth.class.php";
//include "encryption.class.php";
include "style.class.php";
?>