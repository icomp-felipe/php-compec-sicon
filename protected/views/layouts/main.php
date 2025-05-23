<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
	<link rel="apple-touch-icon" href="images/icon/apple-touch-icon.png" >
	<link rel="apple-touch-icon" href="images/icon/apple-touch-icon-57x57.png" sizes="57x57" >
	<link rel="icon" href="images/icon/favicon-200x200.png" type="image/png" sizes="200x200" >

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
	<title>Sicon v.2.0 - UFAM</title>
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
			array('label' => 'Início'                        , 'url' => array('/main/index')),
			array('label' => 'Site da COMPEC'                , 'url' => 'https://www.compec.ufam.edu.br'),
			array('label' => 'Documentos'                    , 'url' => array('/documentos')),
			array('label' => 'Inscrição (Público)'           , 'url' => array('/inscricaoPublico'       ), 'visible' => Yii::app()->user->isGuest),
			//array('label' => 'Inscrição (Público - Confirmação)'   , 'url' => array('/confirmaPublico'        ), 'visible' => Yii::app()->user->isGuest),
			array('label' => 'Inscrição (Público - Consulta)', 'url' => array('/inscricaoConsulta'      ), 'visible' => Yii::app()->user->isGuest),			
			array('label' => 'Inscrição (Institucional)'     , 'url' => array('/inscricao'              ), 'visible' => !Yii::app()->user->isGuest && !UserIdentity::isUsuarioInterno()),
			array('label' => 'Área da Coordenação'           , 'url' => array('/main/login'             ), 'visible' => Yii::app()->user->isGuest),
			array('label' => 'Logout'                        , 'url' => array('/main/logout'            ), 'visible' => !Yii::app()->user->isGuest)
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