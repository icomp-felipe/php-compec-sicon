<?php

class MainController extends CController {

	/**This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users. */
	public function actionIndex() {

		// renders the view file 'protected/views/main/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$session=Yii::app()->getSession();

		$instituicoesDirigidas = null;
		$colaborador = null;
		$usuario = $session["usuario"];

		if (isset($usuario, $usuario->colaborador)) {
			$instituicoesDirigidas = $usuario->colaborador->instituicoesDirigidas;
			$colaborador = $usuario->colaborador;
		}
		
		$this->render('index',array('instituicoesDirigidas'=>$instituicoesDirigidas, 'colaborador' => $colaborador));
	}
	
	public function actionEtapas() {

		$session=Yii::app()->getSession();	
		$etapas  = null;
		$usuario = $session["usuario"];
		$instituicao = new instituicao();
		
		if (isset($usuario,$usuario->colaborador) and isset($_GET['id'])) {

			$instituicao = $instituicao->getInstituicao($_GET['id']);
			$etapas      = $instituicao->getEtapasEmQueParticipou($_GET['id']);
			
		}
		
		$this->render('etapas',array('models'=>$etapas,'instituicao'=>$instituicao));
	}	
	
	public function actionEntregaManual() {		
	
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
					
		$this->renderPartial('entrega_manual',array('model'=>$instituicao, 
												'inscricoes' => $inscricoes, 
												'descricaoConcursoSelecionado' => $etapa->concurso->descricao));
	}	

	/** Displays the login page	 */
	public function actionLogin() {

		$form=new LoginForm;

		// collect user input data
		if(isset($_POST['LoginForm'])) {

			$form->attributes=$_POST['LoginForm'];

			// validate user input and redirect to previous page if valid
			if($form->validate())
				$this->redirect(Yii::app()->user->returnUrl);

		}

		// display the login form
		$this->render('login',array('form'=>$form));
	}

	/** Logout the current user and redirect to homepage. */
	public function actionLogout() {

		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);

	}

}