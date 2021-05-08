<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="language" content="en" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

<style type="text/css">
<!--
#tarja {
	background-image: url(images/bgTarja.gif);
}
.titulo {font-family: Arial, Helvetica, sans-serif; font-weight: bold; font-size: 16px;}
.subtitulo {
	font-size: 14px;
	font-family: Arial, Helvetica, sans-serif;
}
.error {
	font-family: "Trebuchet MS", Verdana, Arial, sans-serif;
	font-size: 9pt;
	font-weight: bold;
	color: #FF0000;
}
-->
</style>
<title><?php echo $this->pageTitle; ?></title>
</head>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0" >
  <tr>
    <td width="431" id="tarja"><img src="images/ufamTarja.gif" width="431" height="31" /></td>
    <td width="783" id="tarja">&nbsp;</td>
  </tr>
</table>

<table width="100%" border="0" cellpadding="5" cellspacing="0" >
  <tr>
    <td width="115"><img src="images/ufamLogo.gif" width="97" height="100" /></td>
    <td width="867"><p class="titulo">COMPEC- UFAM</p>
    </strong></td>
  </tr>
</table>
<br />
<div id="page">

<div id="header">
<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
<div id="mainmenu">
<?php $this->widget('application.components.MainMenu',array(
	'items'=>array(
		array('label'=>'Início', 'url'=>array('/site/index')),		
		array('label'=>'Iniciar ativação', 'url'=>array('/inscricaonet/CpfForm'),'visible'=>Yii::app()->user->isGuest),
		array('label'=>'Iniciar ativação Internet ( Em teste )', 'url'=>array('/inscricaonet/CpfForm'),'visible'=>UserIdentity::isUsuarioInterno()),			
		array('label'=>'COMPEC', 'url'=>'http://www.comvest.ufam.edu.br'),		
		array('label'=>'Iniciar ativação Institucional', 'url'=>array('/inscricaoInstitucional'), 'visible'=>!Yii::app()->user->isGuest && !UserIdentity::isUsuarioInterno()),
		array('label'=>'Iniciar ativação Institucional (Em teste)', 'url'=>array('/inscricaoInstitucional'), 'visible'=>UserIdentity::isUsuarioInterno()),		
		array('label'=>'Colaboradores', 'url'=>array('/colaborador/admin'), 'visible'=>!Yii::app()->user->isGuest),		
		array('label'=>'Acessar Área Institucional', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
		array('label'=>'Sair', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
	),
)); ?>
</div><!-- mainmenu -->
</div><!-- header -->

<div id="content">
<?php echo $content; ?>
</div><!-- content -->

<div id="footer">

</div><!-- footer -->

</div><!-- page -->
</body>

</html>