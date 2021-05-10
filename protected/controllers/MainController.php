<?php

/** Controlador principal do sistema.
 *  Revisado em: 10/05/2021
 *  Felipe André - felipeandresouza@hotmail.com */
class MainController extends CController {

	/** Faz login no sistema. */
	public function actionLogin() {

		// Instanciando formulário de login
		$form = new FormLogin;

		// Executada após submeter o formulário
		if(isset($_POST['FormLogin'])) {

			// Preparando objeto de validação de dados
			$form->attributes = $_POST['FormLogin'];

			// Valida o usuário e o redireciona para a página anterior, se válido
			if($form->validate())
				$this->redirect(Yii::app()->user->returnUrl);

		}

		// Exibe a tela de login
		$this->render('login', array('form' => $form));
	}

	/** Faz logoff e redireciona o usuário para a homepage. */
	public function actionLogout() {

		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);

	}

	/** Comportamento da homepage */
	public function actionIndex() {

		// Recuperando sessão
		$session = Yii::app()->getSession();

		// Recuperando usuário logado
		$usuario = $session["usuario"];

		// Definindo colaborador logado e instituições que ele tem acesso
		$colaborador           = null;
		$instituicoesDirigidas = null;	

		// Recuperando colaborador e lista de instituições
		if (isset($usuario, $usuario->colaborador)) {
			$colaborador = $usuario->colaborador;
			$instituicoesDirigidas = $usuario->colaborador->instituicoesDirigidas;
		}
		
		// Renderizando o index
		$this->render('index', array('instituicoesDirigidas' => $instituicoesDirigidas, 'colaborador' => $colaborador));
	}
	
	/** Comportamento do menu de entrga de manual. */
	public function actionConcursosManual() {

		// Recuperando sessão
		$session=Yii::app()->getSession();

		// Recuperando usuário logado
		$usuario = $session["usuario"];

		// Definindo as variáveis da instituição e concursos
		$concursos   = null;
		$instituicao = new instituicao();
		
		// Recuperando os concursos que a instituição participa ou já participou
		if (isset($usuario, $usuario->colaborador) and isset($_GET['id'])) {

			$instituicao = $instituicao->getInstituicao($_GET['id']);
			$concursos   = $instituicao->getEtapasEmQueParticipou($_GET['id']);
			
		}
		
		// Renderizando a página
		$this->render('concursos_manual', array('models' => $concursos, 'instituicao' => $instituicao));
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

}