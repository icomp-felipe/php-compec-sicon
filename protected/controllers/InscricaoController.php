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

			$form->colab_pis        = $form->colaborador->colab_pis;
			$form->colab_rg         = $form->colaborador->colab_rg;
			$form->colab_nascimento = $form->colaborador->colab_nascimento;
			$form->colab_banco_id   = $form->colaborador->colab_banco_id;
			$form->colab_agencia    = $form->colaborador->colab_agencia;
			$form->colab_conta      = $form->colaborador->colab_conta;
			$form->colab_conta_dv   = $form->colaborador->colab_conta_dv;
				
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

		$condition = 'fconc_conc_id = :idconcurso and mapa_inst_id = :idinstituicao and mapa_vaga_publica = 0';
		$params = array(':idconcurso' => $concurso->conc_id_pk, ':idinstituicao' => $instituicao->inst_id_pk);

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
			$inscricao = $this->loadInscricao($_POST['id']);

			$inscricao->insc_ativa = 0;
			$inscricao->insc_update_acao = 'C';
			$inscricao->insc_update_colab_id = $this->usuarioLogado->user_colab_id;
			$inscricao->insc_update_datetime = date('Y-m-d H:i:s',time());
			$inscricao->save();

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
			$models = $this->getFuncoesDisponiveis($form->concurso->conc_id_pk, $form->instituicao->inst_id_pk);
	
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
		
		if (isset($_GET['colab_cpf']))
			$form->colab_cpf = $_GET['colab_cpf'];
			
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
		$models = $this->getVagasDisponiveis($form->concurso->conc_id_pk, $form->instituicao->inst_id_pk, $form->funcao->func_id_pk);
		
		if (!count($models) > 0) // há vagas
		{
			$this->render('nao_ha_vagas',array('form'=>$form));		
			return;
		}

		if (isset($_POST['FormInscricao'])) {

			$form->attributes = $_POST['FormInscricao'];

			if($form->validate('inscricao')) {

				$data = array(
					'condition'=>'mapa_vaga_publica = 0 and fconc_conc_id = :idconcurso and mapa_inst_id = :instid',
					'join'=>'join funcao_concurso fc on mapa.mapa_fconc_id = fc.fconc_id_pk',
					'params'=>array('idconcurso' => $form->concurso->conc_id_pk, 'instid' => $form->instituicao->inst_id_pk),
				 );

				$criteria=new CDbCriteria($data);

				$mapa = mapa::model()->find($criteria);

				$inscricao = isset($form->inscricao) ? $form->inscricao : new inscricao();

				$inscricao->insc_mapa_id = $mapa->mapa_id_pk;
				$inscricao->insc_colab_id = $form->colaborador->colab_id_pk;
				$inscricao->insc_ativa = 1;
				$inscricao->insc_create_datetime = date('Y-m-d H:i:s',time());
				$inscricao->insc_update_datetime = date('Y-m-d H:i:s',time());
				$inscricao->insc_update_acao = 'I';
				$inscricao->insc_update_colab_id = $this->usuarioLogado->user_colab_id;
				
				if($inscricao->save()) {
				
					$colaborador = $this->loadcolaborador($inscricao->insc_colab_id);

					$colaborador->colab_pis        = $_POST['FormInscricao']['colab_pis'     ];
					$colaborador->colab_rg         = $_POST['FormInscricao']['colab_rg'      ];
					$colaborador->colab_banco_id   = $_POST['FormInscricao']['colab_banco_id'];
					$colaborador->colab_nascimento = $_POST['FormInscricao']['colab_nascimento'];
					$colaborador->colab_agencia    = $_POST['FormInscricao']['colab_agencia' ];
					$colaborador->colab_conta      = $_POST['FormInscricao']['colab_conta'   ];
					$colaborador->colab_conta_dv   = $_POST['FormInscricao']['colab_conta_dv'];
					
					if ($colaborador->save(false)) {
	
						$form->colaborador->colab_pis        = $colaborador->colab_pis;
						$form->colaborador->colab_rg         = $colaborador->colab_rg;
						$form->colaborador->colab_nascimento = $colaborador->colab_nascimento;
						$form->colaborador->banco            = $colaborador->banco;
						$form->colaborador->colab_banco_id   = $colaborador->colab_banco_id;
						$form->colaborador->colab_agencia    = $colaborador->colab_agencia;
						$form->colaborador->colab_conta      = $colaborador->colab_conta;
						$form->colaborador->colab_conta_dv   = $colaborador->colab_conta_dv;
						
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
		
	public function getConcursosEmAndamento($id=null) {
	
		$data = array(
			'order' => 'conc_id_pk desc',
			'condition'=>'conc_data_interno_inicio <= now() and conc_data_interno_fim >= now() '
		);

		$criteria=new CDbCriteria($data);

		return concurso::model()->findAll($criteria);
	}
	
	public function getInstituicoesDisponiveis($form)
	{

		$condicao_usuario_interno= '';
		$params=array();
		
		if(UserIdentity::isUsuarioInterno()) //se for usuário interno da COMPEC
		{
			$condicao_usuario_interno = '';	// pode inscrever em qualquer escola
			$params=array('idconcurso'=>$form->concurso->conc_id_pk);	
		}
		else
		{
			$condicao_usuario_interno = 'inst_coordenador_id = :idresponsavel and ';	// somente escolas administradas pelo usuário
			$params=array('idresponsavel'=>$this->usuarioLogado->user_colab_id, 'idconcurso'=>$form->concurso->conc_id_pk);			
		}	
	
		 $data = array(
					'select'=>'inst_id_pk, inst_codigo, inst_nome, inst_logradouro, inst_numero, inst_cep, inst_bairro, inst_maps, inst_municipio_id, inst_uf_id, muni_id_pk, muni_nome, mapa_id_pk, mapa_vagas, count(insc_id_pk) as inscricoes',
					'condition'=>' '.$condicao_usuario_interno.'fconc_conc_id = :idconcurso and mapa_vaga_publica = 0 and (insc_ativa or insc_id_pk is null)',
					'join'=>'join mapa on mapa_inst_id = inst_id_pk
							 join funcao_concurso on mapa_fconc_id = fconc_id_pk
							 join municipio on instituicao.inst_municipio_id = muni_id_pk
							 join uf on instituicao.inst_uf_id = uf.uf_id_pk
							 left join inscricao on mapa_id_pk = insc_mapa_id',
					'group'=>'inst_municipio_id, inst_codigo, inst_id_pk',
					'having'=>'mapa_vagas > inscricoes',
					'params'=>$params
				 );

		$criteria=new CDbCriteria($data);

		return instituicao::model()->findAll($criteria);
	}
	
	public function getFuncoesDisponiveis($mapa_concurso_id, $idinstituicao)
	{
		$data = array(
					'select'=>'func_id_pk, func_nome, func_apelido, mapa_vagas, count(insc_id_pk) as inscricoes',
					'join'=>'join funcao_concurso fc on funcao.func_id_pk = fc.fconc_func_id
							 join mapa m on fc.fconc_id_pk = m.mapa_fconc_id
							 left join inscricao i on m.mapa_id_pk = i.insc_mapa_id',
					'condition'=>'fconc_conc_id = :mapa_concurso_id
								  and mapa_inst_id = :idinstituicao
								  and mapa_vaga_publica = 0
								  and (insc_ativa or insc_id_pk is null)',
					'group'=>'func_id_pk, mapa_vagas',
					'having'=>'mapa_vagas > inscricoes',
					'params'=>array('mapa_concurso_id'=>$mapa_concurso_id,'idinstituicao'=>$idinstituicao),					
				 );

		$criteria=new CDbCriteria($data);

		return funcao::model()->findAll($criteria);
	}
	
	public function getVagasDisponiveis($mapa_concurso_id, $idinstituicao, $idfuncao)
	{
		$data = array(
			'select'=>'func_id_pk, func_nome, func_apelido, mapa_vagas, count(insc_id_pk) as inscricoes',
			'join'=>'join funcao_concurso fc on funcao.func_id_pk = fc.fconc_func_id
					 join mapa m on fc.fconc_id_pk = m.mapa_fconc_id
					 left join inscricao i on m.mapa_id_pk = i.insc_mapa_id',
			'condition'=>'fconc_conc_id = :mapa_concurso_id
						  and fconc_func_id = :func_id_pk
						  and mapa_inst_id = :idinstituicao
						  and mapa_vaga_publica = 0
						  and (insc_ativa or insc_id_pk is null)',
			'group'=>'func_id_pk, mapa_vagas',
			'having'=>'mapa_vagas > inscricoes',
			'params'=>array('mapa_concurso_id'=>$mapa_concurso_id,'idinstituicao'=>$idinstituicao,'func_id_pk'=>$idfuncao)
		 );

		$criteria=new CDbCriteria($data);

		return funcao::model()->findAll($criteria);
	}
	

}
