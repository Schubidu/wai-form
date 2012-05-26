<?php
function __autoload($Class) {
	include (classPrefix.$Class.".php");
}
if (!$debugMode && ((isset($_SERVER['HTTP_ACCEPT']) && stristr($_SERVER['HTTP_ACCEPT'],'application/xhtml+xml')) ||
stristr($_SERVER["HTTP_USER_AGENT"],"W3C_Validator")))
        header('Content-Type: application/xhtml+xml; charset=utf-8');
elseif(!$debugMode)
        header('Content-Type: text/html; charset=utf-8'); 
else
        header('Content-Type: text/plain; charset=utf-8'); 

$lang = ($_SERVER['HTTP_HOST'] == "spielwiese.dev.schult.info") ? "de" : "en";
$txt = new LangWriter($xmlPath, $lang);
if(!isset($noBackToMain)){;
	$backToMainTxt = new LangWriter("../../xml/index.xml", $lang);
	$backToMain = '<div id="backToMain"><a href="/index.php">'.$backToMainTxt->value["backToMain"].'</a></div>';
} else {
}
?>
