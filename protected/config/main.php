<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(

	'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',

	'name'              => 'Inscrição de Colaboradores',
	'defaultController' => 'main',
	
	'charset' => 'utf-8',

	'language'       => 'pt-br',
	'sourceLanguage' => 'pt_br',

	// Carregando componente 'log'
	'preload' => array('log'),

	// Carregando modelos e classes de componentes
	'import' => array(
		'application.models.*',
		'application.components.*',
	),

	// Componentes da aplicação
	'components' => array(

		'log' => array(
			'class'  => 'CLogRouter',
			'routes' => array(
					array(
						'class'  => 'CFileLogRoute',
						'levels' => 'error, warning',
					),
			),
		),
		'user' => array(

			// Ativa autenticação baseada em cookies
			'allowAutoLogin'=>true,
		),

		// Configurações do Bando de Dados
		'db' => array(
			'connectionString'   =>'mysql:host=localhost;dbname=sis_fiscalcompec',
			'username'           => 'sis_fiscalcompec',
			'password'           => '20sicon08',
			'enableParamLogging' => true,
			'emulatePrepare'     => true
		)

	),

	// Parâmetros a nível de aplicação que podem ser acessados
	// via Yii::app()->params['nomeParametro']
	'params'=>array(

		// Usado na página de contatos
		'adminEmail'=>'felipeandresouza@hotmail.com',

	)

);