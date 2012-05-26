<?php 
$debugMode = 0;
define('classPrefix', "classes/", true);
$xmlPath = "../xml/index.xml";
include('classes/LangWriter.php');
include('inc/header.php');

$ce = new CheckError();
$ce->isFilled('nname', $txt->value['e_nname'], $txt->value['em_nname']);
$ce->isFilled('vname', $txt->value['e_vname'], $txt->value['em_vname']);
$ce->isFilled('ort', $txt->value['e_ort'], $txt->value['em_ort']);
$ce->isChecked('datenschutz', $txt->value['e_datenschutz'], $txt->value['em_datenschutz']);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="Content-Script-Type" content="text/javascript" />
	<title><?php echo $ce->hasError() ? $txt->value['errorTitle'].' | ' : ''?><?php echo $txt->value['title']?></title>

	<link rel="stylesheet" type="text/css" media="screen, projection" href="../../css/general.css" />
	<link rel="stylesheet" type="text/css" media="screen, projection" href="../css/style.css" />
	<!--[if lte IE 7]>
		<link rel="stylesheet" type="text/css" media="screen, projection" href="../css/general_ie7.css" />
		<link rel="stylesheet" type="text/css" media="screen, projection" href="../css/style_ie7.css" />
	<![endif]-->
	<!--[if lte IE 6]>
		<link rel="stylesheet" type="text/css" media="screen, projection" href="../css/general_ie6.css" />
	<![endif]-->
</head>
<body>
<div id="outer">
<?php if($ce->hasError()){ ?>
	<div class="invalidInfo">
		<p>
			<span><strong><?php echo $txt->value['errorTitle']?></strong> <?php echo $txt->value['errorMessage']?></span>
		</p>
		<a name="e_global" id="e_global"></a>
		<ul>
<?php
	$fieldNamesWithErrors = $ce->getFieldNamesWithErrors();
	foreach($fieldNamesWithErrors as $eItem){ ?>
			<li>
				<a href="#e_<?php echo $eItem?>"><?php echo $ce->getFieldName($eItem)?></a><?php echo !next($fieldNamesWithErrors) ? '' : ',' ?>
			</li>
<?php } ?>
		</ul>
	</div>
<?php  
	reset($fieldNamesWithErrors);
}
?>
	<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
		<fieldset class="v2">
			<legend><?php echo $txt->value['legend']?></legend>
			<p>
				<?php echo ($ce->hasError('nname')) ? '<a name="e_nname" id="e_nname"></a>' : '' ?>
				<label for="nname"<?php echo ($ce->hasError('nname')) ? ' class="hasError"' : '' ?>>
					<?php echo ($ce->hasError('nname')) ? '<strong>'.$ce->getMessage('nname').'</strong>' : '' ?>
					<span><?php echo $txt->value['nname']?></span>
					<input<?php echo ($ce->hasError('nname')) ? ' class="invalid"' : '' ?> type="text" id="nname" name="nname" />
				</label>
<?php if($ce->hasError('nname')) { ?>
				<span class="errorLinks"> 
				<a class="linkError" href="#e_global"><span><?php echo $txt->value['backToErrorList']?></span></a>
<?php if(next($fieldNamesWithErrors) != ''){ ?>
				<a class="linkError" href="#e_<?php echo current($fieldNamesWithErrors)?>"><span><?php echo $txt->value['nextError']?>: <?php echo $ce->getFieldName(current($fieldNamesWithErrors))?></span></a>
<?php } ?>
				</span>
<?php } ?>
			</p>
			<p>
				<?php echo ($ce->hasError('vname')) ? '<a name="e_vname" id="e_vname"></a>' : '' ?>
				<label for="vname"<?php echo ($ce->hasError('vname')) ? ' class="hasError"' : '' ?>>
					<?php echo ($ce->hasError('vname')) ? '<strong>'.$ce->getMessage('vname').'</strong>' : '' ?>
					<span><?php echo $txt->value['vname']?></span>
					<input<?php echo ($ce->hasError('vname')) ? ' class="invalid"' : '' ?> type="text" id="vname" name="vname" />
				</label>
<?php if($ce->hasError('vname')) { ?> 
				<span class="errorLinks"> 
				<a class="linkError" href="#e_global"><span><?php echo $txt->value['backToErrorList']?></span></a>
<?php if(next($fieldNamesWithErrors) != ''){ ?>
				<a class="linkError" href="#e_<?php echo current($fieldNamesWithErrors)?>"><span><?php echo $txt->value['nextError']?>: <?php echo $ce->getFieldName(current($fieldNamesWithErrors))?></span></a>
<?php } ?>
				</span>
<?php } ?>
			</p>
			<p>
				<?php echo ($ce->hasError('ort')) ? '<a name="e_ort" id="e_ort"></a>' : '' ?>
				<label for="ort"<?php echo ($ce->hasError('ort')) ? ' class="hasError"' : '' ?>>
					<?php echo ($ce->hasError('ort')) ? '<strong>'.$ce->getMessage('ort').'</strong>' : '' ?>
					<span><?php echo $txt->value['ort']?></span>
					<input<?php echo ($ce->hasError('ort')) ? ' class="invalid"' : '' ?> type="text" id="ort" name="ort" />
				</label>
<?php if($ce->hasError('ort')) { ?> 
				<span class="errorLinks"> 
				<a class="linkError" href="#e_global"><span><?php echo $txt->value['backToErrorList']?></span></a>
<?php if(next($fieldNamesWithErrors) != ''){ ?>
				<a class="linkError" href="#e_<?php echo current($fieldNamesWithErrors)?>"><span><?php echo $txt->value['nextError']?>: <?php echo $ce->getFieldName(current($fieldNamesWithErrors))?></span></a>
<?php } ?>
				</span>
<?php } ?>
			</p>
			<p class="raCheckboxes">
				<?php echo ($ce->hasError('datenschutz')) ? '<a name="e_datenschutz" id="e_datenschutz"></a>' : '' ?>
				<label for="datenschutz"<?php echo ($ce->hasError('datenschutz')) ? ' class="hasError"' : '' ?>>
					<?php echo ($ce->hasError('datenschutz')) ? '<strong>'.$ce->getMessage('datenschutz').'</strong>' : '' ?>
					<input<?php echo ($ce->hasError('nname')) ? ' class="invalid"' : '' ?> type="checkbox" id="datenschutz" name="datenschutz" />
					<span><?php echo $txt->value['datenschutz']?></span>
				</label>
<?php if($ce->hasError('datenschutz')) { ?> 
				<span class="errorLinks"> 
				<a class="linkError" href="#e_global"><span><?php echo $txt->value['backToErrorList']?></span></a>
<?php if(next($fieldNamesWithErrors) != ''){ ?>
				<a class="linkError" href="#e_<?php echo current($fieldNamesWithErrors)?>"><span><?php echo $txt->value['nextError']?>: <?php echo $ce->getFieldName(current($fieldNamesWithErrors))?></span></a>
<?php } ?>
				</span>
<?php } ?>
			</p>
		</fieldset>
		<button><?php echo $txt->value['buttonSend']?></button>
	</form>
</div>
</body>
</html>

