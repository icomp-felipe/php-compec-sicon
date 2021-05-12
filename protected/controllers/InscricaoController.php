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
		$form->cpf = $session["cpf_inst"];
		$form->colaborador = $session["colaborador_inst"];
		$form->concurso = $session["concurso_inst"];
		$form->etapa = $session["etapa_inst"];
		$form->instituicao = $session["instituicao_inst"];
		$form->funcao = $session["funcao_inst"];
		$form->inscricao = $session["inscricao_inst"];

		$form->multiplosConcursos = $session["multiplosConcursos"];
		$form->multiplasInstituicoes = $session["multiplasInstituicoes"];

		$this->usuarioLogado = $session["usuario"];
		
		if (isset($form->colaborador))
		{		
			$form->banco = $form->colaborador->banco;
			$form->agencia = $form->colaborador->agencia;
			$form->contacorrente = $form->colaborador->contacorrente;	
			$form->pispasep = $form->colaborador->pispasep;
			$form->doc_identidade = $form->colaborador->doc_identidade;		
		}
		
		return $form;
	}

	function setSessionForm($form)
	{
		$session=Yii::app()->getSession();
		$session["cpf_inst"] = $form->cpf;
		$session["colaborador_inst"] = $form->colaborador;
		$session["concurso_inst"] = $form->concurso;
		$session["etapa_inst"] = $form->etapa;
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

		if (isset($_GET['idetapa']))
		{
			$form->multiplosConcursos = true;
			$form->etapa = $this->loadEtapa($_GET['idetapa']);
			$form->concurso = $form->etapa->concurso;	
			$this->setSessionForm($form);
			$this->actionSelecionarInstituicao();						
		}
		else
		{
			$models = $this->getConcursosEmAndamento();
			if(count($models)) {

				if (count($models) == 1) {

					$form->etapa    = $models[0]->etapas[0];
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
			if(!isset($form,$form->concurso,$form->etapa))
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

		$etapa = $form->etapa;
		$instituicao = $form->instituicao;

		$condition = 'idetapa = :idetapa and idinstituicao = :idinstituicao';
		$params = array(':idetapa' => $etapa->idetapa, ':idinstituicao' => $instituicao->idinstituicao);

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
			if(!isset($form,$form->concurso,$form->etapa, $form->instituicao))
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
			$models = $this->getFuncoesDisponiveis($form->etapa->idetapa, $form->instituicao->idinstituicao);
	
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
	
		if(!isset($form,$form->concurso,$form->etapa, $form->instituicao))
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

		if(!isset($form,$form->concurso,$form->etapa, $form->instituicao,$form->colaborador))
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
		$models = $this->getVagasDisponiveis($form->etapa->idetapa, $form->instituicao->idinstituicao, $form->funcao->idFuncao);
		
		if (!count($models) > 0) // há vagas
		{
			$this->render('nao_ha_vagas',array('form'=>$form));		
			return;
		}

		if (isset($_POST['FormInscricao'])) {

			$form->attributes = $_POST['FormInscricao'];

			if($form->validate('inscricao')) {

				$inscricao = isset($form->inscricao) ? $form->inscricao : new inscricao();

				$inscricao->idinstituicaoopcao1 = $form->instituicao->idinstituicao;
				$inscricao->idconcurso 			= $form->etapa->idconcurso;
				$inscricao->idColaborador		= $form->colaborador->idColaborador;
				$inscricao->selecionado			= 'W';
				$inscricao->tipoinscricao		= 2;
				$inscricao->candidatociente		= 'W';
				$inscricao->idFuncao			= $form->funcao->idFuncao;
				$inscricao->dt_hr				= date('Y-m-d H:i:s',time());
				$inscricao->idetapa 			= $form->etapa->idetapa;

				if($inscricao->save()) {
				
					$colaborador = $this->loadcolaborador($inscricao->idColaborador);
					$colaborador->banco = $_POST['FormInscricao']['banco'];
					$colaborador->agencia = $_POST['FormInscricao']['agencia'];
					$colaborador->contacorrente = $_POST['FormInscricao']['contacorrente'];
					$colaborador->pispasep = $_POST['FormInscricao']['pispasep'];
					$colaborador->doc_identidade = $_POST['FormInscricao']['doc_identidade'];
			
					if ($colaborador->save(false)) {
	
						$form->colaborador->banco = $colaborador->banco;
						$form->colaborador->agencia = $colaborador->agencia;
						$form->colaborador->contacorrente = $colaborador->contacorrente;
						$form->colaborador->pispasep = $colaborador->pispasep;
						$form->colaborador->doc_identidade = $colaborador->doc_identidade;
						
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
	
	
	public function loadetapa($id=null)
	{
		if($id!==null || isset($_GET['id']))
			return etapa::model()->findbyPk($id!==null ? $id : $_GET['id']);

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
			$params=array('idetapa'=>$form->etapa->idetapa);	
		}
		else
		{
			$condicao_usuario_interno = 'idResponsavel = :idresponsavel and ';	// somente escolas administradas pelo usuário
			$params=array('idresponsavel'=>$this->usuarioLogado->idColaborador,'idetapa'=>$form->etapa->idetapa);			
		}	
	
		$data = array(
					'order'=>' grupoinstituicao.nome, cod_interno desc',
					'condition'=>' '.$condicao_usuario_interno.
								   'idinstituicao in 
										(select idinstituicao from config_concurso cc1
												where idetapa  = :idetapa 
												  and vagasofertadasadicional > (select count(*) 
												  								from inscricao i1
																			   where cc1.idetapa  = i1.idetapa
																				 and cc1.idfuncao = i1.idfuncao
																				 and cc1.idinstituicao =
																				     i1.idinstituicaoopcao1
																				 and tipoinscricao = 2 /*instituic.*/))',
					'params'=>$params,
				 );

		$criteria=new CDbCriteria($data);

		return instituicao::model()->with('grupoinstituicao')->findAll($criteria);
	}
	
	public function getFuncoesDisponiveis($idetapa, $idinstituicao)
	{
		$data = array(
					'order'=>'nome',					
					'condition'=>' idfuncao in (1,2,3,5) and idfuncao in (select idfuncao 
													from config_concurso cc1 
													where idetapa = :idetapa
													  and idinstituicao = :idinstituicao
													  and vagasofertadasadicional > 
													  			(select count(*) 
												  						from inscricao i1
																		where cc1.idetapa  = i1.idetapa
																		  and cc1.idfuncao = i1.idfuncao
																		  and cc1.idinstituicao = i1.idinstituicaoopcao1
																		  and cc1.idinstituicao = i1.idinstituicaoopcao1
																		  and tipoinscricao = 2 /*instituic.*/))',
					'params'=>array('idetapa'=>$idetapa,'idinstituicao'=>$idinstituicao),					
				 );

		$criteria=new CDbCriteria($data);

		return funcao::model()->findAll($criteria);
	}
	
	public function getVagasDisponiveis($idetapa, $idinstituicao, $idfuncao)
	{
		$data = array(
					'order'=>'nome',					
					'condition'=>' idfuncao in (select idfuncao 
													from config_concurso cc1 
													where idetapa = :idetapa
													  and idinstituicao = :idinstituicao
													  and idfuncao = :idfuncao
													  and vagasofertadasadicional > 
													  			(select count(*) 
												  						from inscricao i1
																		where cc1.idetapa  = i1.idetapa
																		  and cc1.idfuncao = i1.idfuncao
																		  and cc1.idinstituicao = i1.idinstituicaoopcao1
																		  and cc1.idinstituicao = i1.idinstituicaoopcao1
																		  and tipoinscricao = 2 /*instituic.*/))',
					'params'=>array('idetapa'=>$idetapa,'idinstituicao'=>$idinstituicao,'idfuncao'=>$idfuncao),					
				 );

		$criteria=new CDbCriteria($data);

		return funcao::model()->findAll($criteria);
	}
	

}
