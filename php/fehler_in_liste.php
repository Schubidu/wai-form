<?php 
header("Content-Tye: application/xhtml+xml;");
class CheckError{
	private $errorArray = array();
	private $hasPost = false;
	public function __construct(){
		$this->hasPost = ($_POST);
	}
	public function isFilled($field, $fieldName, $errorMessage){
		if($_POST[$field] == '' && $this->hasPost){
			$this->errorArray[$field] = array('name' => $fieldName, 'message' => $errorMessage);
			return false;
		};
		return true;
	}
	public function getMessage($field){
		return $this->errorArray[$field]['message'];
	}
	public function isChecked($field, $fieldName, $errorMessage){
		if($_POST[$field] == false && $this->hasPost){
			$this->errorArray[$field] = array('name' => $fieldName, 'message' => $errorMessage);
			return false;
		};
		return true;
	}
	public function hasError($fieldName = ''){
		if(!$this->hasPost) return false;
		if($fieldName != ''){
			return array_key_exists($fieldName, $this->errorArray);
		}
		return (count($this->errorArray)>0);
	}
	public function getFieldNamesWithErrors(){
		return array_keys($this->errorArray);
	}
	public function getFieldName($field){
		if(is_string($field) && array_key_exists($field, $this->errorArray)) {
			return $this->errorArray[$field]['name'];
		} elseif (is_int($field) && array_key_exists($field, $this->getFieldNamesWithErrors())) {
			$fields = $this->getFieldNamesWithErrors();
			return $fields[$field];
		}
	}
}

$ce = new CheckError();
$ce->isFilled('nname', 'Nachname', 'Bitte geben Sie einen Nachnamen an.');
$ce->isFilled('vname', 'Vorname', 'Bitte geben Sie einen Vornamen an.');
$ce->isFilled('ort', 'Ort', 'Bitte geben Sie einen Ort an.');
$ce->isChecked('datenschutz', 'Zustimmung Datenschutz', 'Um fortzufahren, müssen Sie den Datenschutzbestimmungen zustimmen.');

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<title>Möglichkeiten der Fehlermeldungen</title>

	<link rel="stylesheet" type="text/css" media="screen, projection" href="../css/general.css" />
	<!--[if lte IE 7]>
		<link rel="stylesheet" type="text/css" media="screen, projection" href="../css/general_ie7.css" />
	<![endif]-->
	<!--[if lte IE 6]>
		<link rel="stylesheet" type="text/css" media="screen, projection" href="../css/general_ie6.css" />
	<![endif]-->
	<style type="text/css" media="screen, projection">
		.linkError {
			position: relative;
			padding: 0;
			font-size: 1em;
		}
		
		/*.linkError span {
			position: absolute;
			left: -3000px;
			top: -3000px;
		}*/
		
		.linkError:focus span, .linkError span:active, .ieJumpLink {
			position: static;
			left: 0;
			top: 0;
		}

		body {
			padding: 15px;
		}
		fieldset, legend {
			border: 1px solid #000;
			padding: 2px;
		}
		fieldset {
			padding: 10px;
			margin-bottom: 15px;
			
		}
		p {
			padding-bottom: 10px;
		}
		.invalidInfo {
			color: #F00;
			background: #EFEFEF;
			padding: 5px;
			border: 1px solid #F00;
			margin-bottom: 15px;
		}
		.invalidInfo strong {
			display: block;
		}
		.invalidInfo p {
			padding-bottom: 0;
		}
		.invalidInfo li {
			display: inline;
		}
		.invalidInfo a {
			color: #F00;
		}
		.invalid {
			border: 2px solid #F00;
		}
		
		.v1 label, .v2 label span {
			width: 8em;
			float: left;
		}
		
		.v1 .error dfn, .v2 .hasError strong {
			font-style: normal;
			font-weight: bold;
			color: #F00;
			display: block;
		}
		
		.v2 .hasError strong {
			padding-bottom: 10px;
		}
		
		.raCheckboxes input {
			display:inline;
			float: none;
			
		}
		.raCheckboxes label span {
			display:inline;
			width: auto;
			float: none;
			
		}
	</style>
	<!--[if lte IE 7]>
	<style type="text/css" media="screen, projection">
		legend {
			margin-bottom: 10px;
			margin-left: -8px;
		}
	
	</style>
	<![endif]-->
</head>
<body>
<div id="outer">
<?php if($ce->hasError()){ ?>
	<div class="invalidInfo">
		<p>
			<span><strong>Es ist ein Fehler aufgetreten!</strong> Bitte überprüfen Sie Ihre Eingaben in folgenden Feldern:</span>
		</p>
		<a name="e_global" id="e_global"></a>
		<ul>
<?php foreach($ce->getFieldNamesWithErrors() as $eItem){ ?>
			<li>
				<a href="#e_<?=$eItem?>"><?=$ce->getFieldName($eItem)?></a>,
			</li>
<?php } ?>
		</ul>
	</div>
<?php } 
	$fieldNamesWithErrors = $ce->getFieldNamesWithErrors();
?>
	<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
		<fieldset class="v2">
			<legend>Ihre Angaben</legend>
			<p>
				<?=($ce->hasError('nname')) ? '<a name="e_nname" id="e_nname"></a>' : '' ?>
				<label for="nname"<?=($ce->hasError('nname')) ? ' class="hasError"' : '' ?>>
					<?=($ce->hasError('nname')) ? '<strong>'.$ce->getMessage('nname').'</strong>' : '' ?>
					<span>Name</span>
					<input<?=($ce->hasError('nname')) ? ' class="invalid"' : '' ?> type="text" id="nname" name="nname" />
				</label>
<?php if($ce->hasError('nname')) { ?> 
				<a class="linkError" href="#e_global"><span>zurück zur Fehlerliste</span></a>
<?php if(next($fieldNamesWithErrors) != ''){ ?>
				<a class="linkError" href="#e_<?=current($fieldNamesWithErrors)?>"><span>zum nächsten Fehler: <?=$ce->getFieldName(current($fieldNamesWithErrors))?></span></a>
<?php }} ?>
			</p>
			<p>
				<?=($ce->hasError('vname')) ? '<a name="e_vname" id="e_vname"></a>' : '' ?>
				<label for="vname"<?=($ce->hasError('vname')) ? ' class="hasError"' : '' ?>>
					<?=($ce->hasError('vname')) ? '<strong>'.$ce->getMessage('vname').'</strong>' : '' ?>
					<span>Vorname</span>
					<input<?=($ce->hasError('vname')) ? ' class="invalid"' : '' ?> type="text" id="vname" name="vname" />
				</label>
<?php if($ce->hasError('vname')) { ?> 
				<a class="linkError" href="#e_global"><span>zurück zur Fehlerliste</span></a>
<?php if(next($fieldNamesWithErrors) != ''){ ?>
				<a class="linkError" href="#e_<?=current($fieldNamesWithErrors)?>"><span>zum nächsten Fehler: <?=$ce->getFieldName(current($fieldNamesWithErrors))?></span></a>
<?php }} ?>
			</p>
			<p>
				<?=($ce->hasError('ort')) ? '<a name="e_ort" id="e_ort"></a>' : '' ?>
				<label for="ort"<?=($ce->hasError('ort')) ? ' class="hasError"' : '' ?>>
					<?=($ce->hasError('ort')) ? '<strong>'.$ce->getMessage('ort').'</strong>' : '' ?>
					<span>Ort</span>
					<input<?=($ce->hasError('nname')) ? ' class="invalid"' : '' ?> type="text" id="ort" name="ort" />
				</label>
<?php if($ce->hasError('ort')) { ?> 
				<a class="linkError" href="#e_global"><span>zurück zur Fehlerliste</span></a>
<?php if(next($fieldNamesWithErrors) != ''){ ?>
				<a class="linkError" href="#e_<?=current($fieldNamesWithErrors)?>"><span>zum nächsten Fehler: <?=$ce->getFieldName(current($fieldNamesWithErrors))?></span></a>
<?php }} ?>
			</p>
			<p class="raCheckboxes">
				<?=($ce->hasError('datenschutz')) ? '<a name="e_datenschutz" id="e_datenschutz"></a>' : '' ?>
				<label for="datenschutz"<?=($ce->hasError('datenschutz')) ? ' class="hasError"' : '' ?>>
					<?=($ce->hasError('datenschutz')) ? '<strong>'.$ce->getMessage('datenschutz').'</strong>' : '' ?>
					<input<?=($ce->hasError('nname')) ? ' class="invalid"' : '' ?> type="checkbox" id="datenschutz" name="datenschutz" />
					<span>Ja, ich stimme den Datenschutzbestimmungen zu.</span>
				</label>
<?php if($ce->hasError('datenschutz')) { ?> 
				<a class="linkError" href="#e_global"><span>zurück zur Fehlerliste</span></a>
<?php if(next($fieldNamesWithErrors) != ''){ ?>
				<a class="linkError" href="#e_<?=current($fieldNamesWithErrors)?>"><span>zum nächsten Fehler: <?=$ce->getFieldName(current($fieldNamesWithErrors))?></span></a>
<?php }} ?>
			</p>
		</fieldset>
		<button>Absenden</button>
	</form>
</div>
</body>
</html>

