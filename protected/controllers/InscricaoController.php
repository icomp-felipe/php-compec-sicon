<?php

class InscricaoController extends CController
{

	public $defaultAction='selecionarConcursoEtapa';
	
	public $usuarioLogado = null;

	private $_model;

	function getSessionForm()
	{
		$form = new FormInscricao();
		$session=Yii::app()->getSession();
		$form->colab_cpf = $session["cpf_inst"];
		$form->colaborador = $session["colaborador_inst"];
		$form->concurso = $session["concurso_inst"];
		$form->instituicao = $session["instituicao_inst"];
		$form->funcao = $session["funcao_inst"];
		$form->inscricao = $session["inscricao_inst"];

		$form->multiplosConcursos = $session["multiplosConcursos"];
		$form->multiplasInstituicoes = $session["multiplasInstituicoes"];

		$this->usuarioLogado = $session["usuario"];
		
		if (isset($form->colaborador)) {

			$form->colab_pis      = $form->colaborador->colab_pis;
			$form->colab_rg       = $form->colaborador->colab_rg;
			$form->colab_banco_id = $form->colaborador->colab_banco_id;
			$form->colab_agencia  = $form->colaborador->colab_agencia;
			$form->colab_conta    = $form->colaborador->colab_conta;
			$form->colab_conta_dv = $form->colaborador->colab_conta_dv;
				
		}
		
		return $form;
	}

	function setSessionForm($form) {

		$session=Yii::app()->getSession();

		$session["cpf_inst"] = $form->colab_cpf;
		$session["colaborador_inst"] = $form->colaborador;
		$session["concurso_inst"] = $form->concurso;
		$session["instituicao_inst"] = $form->instituicao;
		$session["funcao_inst"] = $form->funcao;
		$session["inscricao_inst"] = $form->inscricao;
		$session["multiplosConcursos"] = $form->multiplosConcursos;
		$session["multiplasInstituicoes"] = $form->multiplasInstituicoes;

	}


	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'list' and 'show' actions
				'actions'=>array(),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('selecionarConcursoEtapa','selecionarInstituicao','selecionarFuncao','selecionarColaborador','confirmacao','confirmar','confirmado'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	
	/**
	 * Exibe a página de seleção de concursos e etapas
	 */
	public function actionSelecionarConcursoEtapa()
	{
	
		$form = new FormInscricao();


		if (isset($_GET['idconcurso']))
		{
			$form->multiplosConcursos = true;
			//$form->etapa = $this->loadEtapa($_GET['idetapa']);
			//$form->concurso = $form->etapa->concurso;

			$form->concurso = $this->loadConcurso($_GET['idconcurso']);

			$this->setSessionForm($form);
			$this->actionSelecionarInstituicao();						
		}
		else
		{
			
			$models = $this->getConcursosEmAndamento();

			if(count($models)) {

				if (count($models) == 1) {

					$form->concurso = $models[0];

					$this->setSessionForm($form);
					$this->actionSelecionarInstituicao();

				}
				else
					$this->render('concurso_etapa',array('models'=>$models));
			}
			else
			{
				$this->render('nao_ha_concursos',array('models'=>$models));		
			}
		}
	}
	
	/**
	 * Exibe a página de seleção de instituições
	 */	
	public function actionSelecionarInstituicao()
	{
		$form = $this->getSessionForm();
		
		if (isset($_GET['idinstituicao']))
		{
			$form->multiplasInstituicoes = true;
			$form->instituicao = $this->loadinstituicao($_GET['idinstituicao']);
			$this->setSessionForm($form);
			$this->actionListarInscritos();
		}
		else
		{
			if(!isset($form,$form->concurso))
			{
				$this->render('erro',array('form'=>$form,'mensagem'=>'Identificamos uma inconsistência no processo de inscrição de colaboradores, por favor reinicie o processo!'));
				return;	
			}
		
			// consulta instituições disponíveis no processo
			$models = $this->getInstituicoesDisponiveis($form);

			if (count($models) > 0) // há vagas
			
				if (count($models) == 1) {

					$form->instituicao = $models[0];

					$this->setSessionForm($form);
					//$this->actionSelecionarFuncao();
					$this->actionListarInscritos();

				}
				else {

					$this->render('instituicao',array(
						'models'=>$models,
						'form'=>$form,
					));

				}
			else
				$this->render('nao_ha_vagas',array('form'=>$form));		
		}
	}

	public function actionListarInscritos() {

		$this->processAdminCommand();

		$form = $this->getSessionForm();

		$concurso = $form->concurso;
		$instituicao = $form->instituicao;

		$condition = 'idconcurso = :idconcurso and idinstituicao = :idinstituicao';
		$params = array(':idconcurso' => $concurso->idconcurso, ':idinstituicao' => $instituicao->inst_id_pk);

		$criteria = new CDbCriteria(array('condition' => $condition, 'params' => $params));

		$sort=new CSort('inscritos');
		$sort->applyOrder($criteria);

		$inscricoes = inscritos::model()->findAll($criteria);

		$this->render('lista_inscritos',array('form' => $form, 'inscricoes' => $inscricoes, 'sort' => $sort));

	}

	protected function processAdminCommand()
	{
		if(isset($_POST['command'], $_POST['id']) && $_POST['command']==='delete')
		{
			$this->loadInscricao($_POST['id'])->delete();
			// reload the current page to avoid duplicated delete actions
			$this->refresh();
		}
	}

	public function loadInscricao($id)
	{
		return inscricao::model()->findbyPk($id);
	}

	/**
	 * Exibe a página de seleção de funções
	 */	
	public function actionSelecionarFuncao()
	{
		$form = $this->getSessionForm();
		
		if (isset($_GET['idfuncao']))
		{
			$form->funcao = $this->loadfuncao($_GET['idfuncao']);
			$this->setSessionForm($form);
			$this->actionConfirmar();
		}
		else
		{		
			if(!isset($form,$form->concurso,$form->instituicao))
			{
				$this->render('erro',array('form'=>$form,'mensagem'=>'Identificamos uma inconsistência no processo de inscrição de colaboradores, por favor reinicie o processo!'));
				return;	
			}

			if (isset($_GET['idinscricao'])) {
				$form->inscricao   = $this->loadInscricao($_GET['idinscricao']);
				$form->colaborador = $form->inscricao->colaborador;
				$this->setSessionForm($form);
			}
			
			// consulta funções disponíveis no processo
			$models = $this->getFuncoesDisponiveis($form->concurso->idconcurso, $form->instituicao->inst_id_pk);
	
			if (count($models) > 0) // há vagas
				// exibe a página de seleção de instituições
				$this->render('funcao',array(
					'models'=>$models,
					'form'=>$form,
				));
			else
				$this->render('nao_ha_vagas',array('form'=>$form));		
		}
	}		
	
	/**
	 * Exibe a página de seleção de colaboradores
	 */
	public function actionSelecionarColaborador() {
	
		$form = $this->getSessionForm();
	
		if(!isset($form,$form->concurso, $form->instituicao))
		{
			$this->render('erro',array('form'=>$form,'mensagem'=>'Identificamos uma inconsistência no processo de inscrição de colaboradores, por favor reinicie o processo!'));
				return;	
		}
	
		if(isset($_POST['FormInscricao']))
		{
			$form->attributes=$_POST['FormInscricao'];
			if($form->validate('selecionarColaborador')){

				$this->setSessionForm($form);			
				//if (isset($form->colaborador))
					//$this->actionAtualizarColaborador();
				//else
					//$this->actionCriarColaborador();
				$this->actionSelecionarFuncao();
				return;
			}
		}
		
		if (isset($_GET['cpf']))
			$form->cpf = $_GET['cpf'];
			
		$this->setSessionForm($form);	
		
		$this->render('colaborador',array('form'=>$form));
	}	
	
	public function actionCriarColaborador()
	{

		$form = $this->getSessionForm();	
		$model=new colaborador;
		if(isset($_POST['colaborador']))
		{
			$model->attributes=$_POST['colaborador'];
			if($model->save())
				$this->redirect(array('show','id'=>$model->idColaborador,'form'=>$form));
		}
		$this->render('criaColaborador',array('model'=>$model,'form'=>$form));
	}
	
	public function actionAtualizarColaborador()
	{
		$form = $this->getSessionForm();
		$model = $form->colaborador;
		if(isset($_POST['colaborador']))
		{
			$model->attributes=$_POST['colaborador'];
			if($model->save())
				$this->redirect(array('show','id'=>$model->idColaborador));
		}
		$this->render('atualizaColaborador',array('model'=>$model,'form'=>$form));
	}
	
	public function actionConfirmacao()
	{
	
		$form = $this->getSessionForm();	

		if(!isset($form,$form->concurso, $form->instituicao,$form->colaborador))
		{
			$this->render('erro',array('form'=>$form,'mensagem'=>'Identificamos uma inconsistência no processo de inscrição de colaboradores, por favor reinicie o processo!'));
				return;	
		}
		
		// exibe a página de seleção de instituições
		$this->render('confirmacao',array(
			'form'=>$form,
		));
	}	
	
	public function actionConfirmar() {

		//recupera dados da sessão e os dados postados
		$form = $this->getSessionForm();
		
		// consulta se há vaga disponíveis no processo, na instituicao e na funcao selecionada
		$models = $this->getVagasDisponiveis($form->concurso->idconcurso, $form->instituicao->inst_id_pk, $form->funcao->idFuncao);
		
		if (!count($models) > 0) // há vagas
		{
			$this->render('nao_ha_vagas',array('form'=>$form));		
			return;
		}

		if (isset($_POST['FormInscricao'])) {

			$form->attributes = $_POST['FormInscricao'];

			if($form->validate('inscricao')) {

				$inscricao = isset($form->inscricao) ? $form->inscricao : new inscricao();

				$inscricao->idinstituicaoopcao1 = $form->instituicao->inst_id_pk;
				$inscricao->idconcurso 			= $form->concurso->idconcurso;
				$inscricao->idColaborador		= $form->colaborador->colab_id_pk;
				$inscricao->selecionado			= 'W';
				$inscricao->tipoinscricao		= 2;
				$inscricao->candidatociente		= 'W';
				$inscricao->idFuncao			= $form->funcao->idFuncao;

				if($inscricao->save()) {
				
					$colaborador = $this->loadcolaborador($inscricao->idColaborador);

					$colaborador->colab_pis      = $_POST['FormInscricao']['colab_pis'     ];
					$colaborador->colab_rg       = $_POST['FormInscricao']['colab_rg'      ];
					$colaborador->colab_banco_id = $_POST['FormInscricao']['colab_banco_id'];
					$colaborador->colab_agencia  = $_POST['FormInscricao']['colab_agencia' ];
					$colaborador->colab_conta    = $_POST['FormInscricao']['colab_conta'   ];
					$colaborador->colab_conta_dv = $_POST['FormInscricao']['colab_conta_dv'];
					
					if ($colaborador->save(false)) {
	
						$form->colaborador->colab_pis      = $colaborador->colab_pis;
						$form->colaborador->colab_rg       = $colaborador->colab_rg;
						$form->colaborador->banco          = $colaborador->banco;
						$form->colaborador->colab_banco_id = $colaborador->colab_banco_id;
						$form->colaborador->colab_agencia  = $colaborador->colab_agencia;
						$form->colaborador->colab_conta    = $colaborador->colab_conta;
						$form->colaborador->colab_conta_dv = $colaborador->colab_conta_dv;
						
					}
					else {									
						$inscricao->delete();
						$this->render('erro',array('form'=>$form,'mensagem'=>'Identificamos uma inconsistência no processo de inscrição, por favor reinicie o processo!'));	
						return;	
					}

					$this->redirect(array('confirmado'));
			
				}

				$this->setSessionForm($form);
				return;

			}

		}

		$this->render('confirmacao',array('form' => $form));
	}	
	
	public function actionConfirmado()
	{
		//recupera dados da sessão e os dados postados
		$form = $this->getSessionForm();
		
		$this->render('confirmado',array('form'=>$form));
		
	}		
	
	
	public function loadConcurso($id=null)
	{
		if($id!==null || isset($_GET['id']))
			return concurso::model()->findbyPk($id!==null ? $id : $_GET['id']);

		return null;
	}

	
	public function loadinstituicao($id=null)
	{
		if($id!==null || isset($_GET['id']))
			return instituicao::model()->findbyPk($id!==null ? $id : $_GET['id']);

		return null;
	}
	public function loadfuncao($id=null)
	{
		if($id!==null || isset($_GET['id']))
			return funcao::model()->findbyPk($id!==null ? $id : $_GET['id']);

		return null;
	}
	
	public function loadcolaborador($id)
	{
		return colaborador::model()->findbyPk($id!==null ? $id : $_GET['id']);
	}
		
	public function getConcursosEmAndamento($id=null)
	{
	
		$condicao_usuario_interno='';
		if(UserIdentity::isUsuarioInterno())
			$condicao_usuario_interno = ' || emteste = 1';
	
	
		$data = array(
				'order'=>'idconcurso desc',
				'condition'=>'datainicioinscricao <= curdate() and datafiminscricao >= curdate() '.$condicao_usuario_interno,
					  );

			$criteria=new CDbCriteria($data);

		return concurso::model()->findAll($criteria);
	}
	
	public function getInstituicoesDisponiveis($form)
	{

		$condicao_usuario_interno= '';
		$params=array();
		
		if(UserIdentity::isUsuarioInterno() && $form->concurso->emteste==1) //se for usuário interno da comvest e o concurso estiver em teste
		{
			$condicao_usuario_interno = '';	// pode inscrever em qualquer escola
			$params=array('idconcurso'=>$form->concurso->idconcurso);	
		}
		else
		{
			$condicao_usuario_interno = 'inst_coordenador_id = :idresponsavel and ';	// somente escolas administradas pelo usuário
			$params=array('idresponsavel'=>$this->usuarioLogado->user_colab_id, 'idconcurso'=>$form->concurso->idconcurso);			
		}	
	
		$data = array(
					'order'=>' inst_codigo',
					'condition'=>' '.$condicao_usuario_interno.
								   'inst_id_pk in 
										(select idinstituicao from config_concurso cc1
												where mapa_concurso_id  = :idconcurso 
												  and vagasofertadasadicional > (select count(*) 
												  								from inscricao i1
																			   where cc1.mapa_concurso_id  = i1.idconcurso
																				 and cc1.idfuncao = i1.idfuncao
																				 and cc1.idinstituicao =
																				     i1.idinstituicaoopcao1
																				 and tipoinscricao = 2 /*instituic.*/))',
					'params'=>$params,
				 );

		$criteria=new CDbCriteria($data);

		return instituicao::model()->findAll($criteria);
	}
	
	public function getFuncoesDisponiveis($mapa_concurso_id, $idinstituicao)
	{
		$data = array(
					'order'=>'nome',					
					'condition'=>' idfuncao in (1, 2, 3, 5, 7, 19, 30, 34, 43) and idfuncao in (select idfuncao 
													from config_concurso cc1 
													where mapa_concurso_id = :mapa_concurso_id
													  and idinstituicao = :idinstituicao
													  and vagasofertadasadicional > 
													  			(select count(*) 
												  						from inscricao i1
																		where cc1.mapa_concurso_id  = i1.idconcurso
																		  and cc1.idfuncao = i1.idfuncao
																		  and cc1.idinstituicao = i1.idinstituicaoopcao1
																		  and tipoinscricao = 2 /*instituic.*/))',
					'params'=>array('mapa_concurso_id'=>$mapa_concurso_id,'idinstituicao'=>$idinstituicao),					
				 );

		$criteria=new CDbCriteria($data);

		return funcao::model()->findAll($criteria);
	}
	
	public function getVagasDisponiveis($mapa_concurso_id, $idinstituicao, $idfuncao)
	{
		$data = array(
					'order'=>'nome',					
					'condition'=>' idfuncao in (select idfuncao 
													from config_concurso cc1 
													where mapa_concurso_id = :mapa_concurso_id
													  and idinstituicao = :idinstituicao
													  and idfuncao = :idfuncao
													  and vagasofertadasadicional > 
													  			(select count(*) 
												  						from inscricao i1
																		where cc1.mapa_concurso_id  = i1.idconcurso
																		  and cc1.idfuncao = i1.idfuncao
																		  and cc1.idinstituicao = i1.idinstituicaoopcao1
																		  and tipoinscricao = 2 /*instituic.*/))',
					'params'=>array('mapa_concurso_id'=>$mapa_concurso_id,'idinstituicao'=>$idinstituicao,'idfuncao'=>$idfuncao),					
				 );

		$criteria=new CDbCriteria($data);

		return funcao::model()->findAll($criteria);
	}
	

}
