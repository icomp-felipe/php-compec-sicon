<?php

class SiteController extends CController
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image
			// this is used by the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xEBF4FB,
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$session=Yii::app()->getSession();	
		$instituicoesDirigidas = null;
		$usuario = $session["usuario"];
		if (isset($usuario,$usuario->colaborador))
			$instituicoesDirigidas = $usuario->colaborador->instituicoesDirigidas;
		echo '';
					
		
		
		$this->render('index',array('instituicoesDirigidas'=>$instituicoesDirigidas));
	}
	
	public function actionEtapas()
	{
		$session=Yii::app()->getSession();	
		$etapas = null;
		$usuario = $session["usuario"];
		$instituicao = new instituicao();
		
		if (isset($usuario,$usuario->colaborador) and isset($_GET['id']))
		{
			$instituicao = $instituicao->getInstituicao($_GET['id']);
			$etapas = $instituicao->getEtapasEmQueParticipou($_GET['id']);
			
		}
		
		$this->render('etapas',array('models'=>$etapas,'instituicao'=>$instituicao));
	}	
	
	public function actionEntregaFolder()
	{		
	
		$instituicao = new instituicao();	
		$instituicao = $instituicao->getInstituicao($_GET['idinstituicao']);
		
		$etapa = new etapa();
		$etapa = $etapa->getEtapa($_GET['idetapa']);
		
		$relations = array('concurso'=>array('alias'=>'concurso'),
						   'colaborador'=>array('alias'=>'colaborador'),
						   'funcao'=>array('alias'=>'funcao'));
		
		$attributes = array('idinstituicaoopcao1' => $instituicao->idinstituicao, 
							'idconcurso' => $etapa->concurso->idconcurso);
		
		$inscricoes = inscricao::model()->with($relations)
										->findAllByAttributes($attributes,
											array('condition'=>"tipoinscricao=2",
												'order'=>'tipoinscricao, funcao.idfuncao, colaborador.nome'));
					
		$this->renderPartial('entrega_folder',array('model'=>$instituicao, 
												'inscricoes' => $inscricoes, 
												'descricaoConcursoSelecionado' => $etapa->concurso->descricao));
	}	
	

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$contact=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$contact->attributes=$_POST['ContactForm'];
			if($contact->validate())
			{
				$headers="From: {$contact->email}\r\nReply-To: {$contact->email}";
				mail(Yii::app()->params['adminEmail'],$contact->subject,$contact->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('contact'=>$contact));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$form=new LoginForm;
		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$form->attributes=$_POST['LoginForm'];
			// validate user input and redirect to previous page if valid
			if($form->validate())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('form'=>$form));
	}

	/**
	 * Logout the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionInstrucaoInstitucional()
	{
		$this->render('instrucoes_institucional');
	}	
	public function actionInstrucaoInternet()
	{
		$this->render('instrucoes_internet');
	}		
}