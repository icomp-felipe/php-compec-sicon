<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />

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
			<td width="115"><img src="images/ufam-logo-2021.png" width="97" height="100" /></td>
			<td width="867"><p class="titulo">COMPEC-UFAM</p></td>
		</tr>
	</table>

	<br />

	<div id="page">
	<div id="header">
	<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	<div id="mainmenu">
	<?php $this->widget('application.components.MainMenu',array(
		'items'=>array(
			array('label' => 'Início'                              , 'url' => array('/site/index')),
			array('label' => 'Site da COMPEC'                      , 'url' => 'https://www.compec.ufam.edu.br'),
			array('label' => 'Inscrição (Público)'                 , 'url' => array('/inscricaonet/CpfForm'   ), 'visible' => Yii::app()->user->isGuest),
			array('label' => 'Inscrição (Público - Restrito)'      , 'url' => array('/inscricaonet/CpfForm'   ), 'visible' => UserIdentity::isUsuarioInterno()),			
			array('label' => 'Inscrição (Institucional)'           , 'url' => array('/inscricaoInstitucional' ), 'visible' => !Yii::app()->user->isGuest && !UserIdentity::isUsuarioInterno()),
			array('label' => 'Inscrição (Institucional - Restrito)', 'url' => array('/inscricaoInstitucional' ), 'visible' => UserIdentity::isUsuarioInterno()),		
			array('label' => 'Colaboradores'                       , 'url' => array('/colaborador/admin'      ), 'visible' => !Yii::app()->user->isGuest),		
			array('label' => 'Área Restrita'                       , 'url' => array('/site/login'             ), 'visible' => Yii::app()->user->isGuest),
			array('label' => 'Logout'                              , 'url' => array('/site/logout'            ), 'visible' => !Yii::app()->user->isGuest)
		)
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