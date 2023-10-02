<?php

class InscricaoPublicoController extends CController {

	public $defaultAction = 'autentica';

	function getSessionForm() {

		$session=Yii::app()->getSession();

		$form = new FormInscricaoPublico();

		$form->colaborador = $session["colaborador"];
		$form->concurso    = $session["concurso"   ];
		$form->instituicao = $session["instituicao"];
		$form->funcao      = $session["funcao"     ];

		$form->colab_nome       = $form->colaborador->nomeProprio;
		$form->colab_cpf        = $session["cpf"];
		$form->colab_rg         = $form->colaborador->colab_rg;
		$form->colab_nascimento = $form->colaborador->colab_nascimento;
		$form->colab_celular_1  = $form->colaborador->colab_celular_1;
		$form->colab_email      = $form->colaborador->colab_email;
		$form->colab_banco_id   = $form->colaborador->colab_banco_id;
		$form->colab_agencia    = $form->colaborador->colab_agencia;
		$form->colab_conta      = $form->colaborador->colab_conta;
		$form->colab_conta_dv   = $form->colaborador->colab_conta_dv;
		
		return $form;
	}

	function setSessionForm($form)	{

		$session=Yii::app()->getSession();

		$session["cpf"        ] = $form->colab_cpf;
		$session["colaborador"] = $form->colaborador;
		$session["concurso"   ] = $form->concurso;
		$session["instituicao"] = $form->instituicao;
		$session["funcao"     ] = $form->funcao;

	}
	
	function getUsuario() {
	
		$session=Yii::app()->getSession();
		return $session["usuario"];
	
	}

	
	/**
	 * Displays the CPF (Identificação do Contribuinte) page
	 */
	public function actionAutentica()
	{
		$form=new FormInscricaoPublico;
		$this->setSessionForm($form);
		// collect user input data
		if(isset($_POST['FormInscricaoPublico']))
		{
			$form->attributes=$_POST['FormInscricaoPublico'];
			// validate 
			if($form->validate('cpf')){

				if (isset($form->colaborador)) {

					$this->setSessionForm($form);
				
					$this->actionSelecionarConcurso();
					
					return;

				}
				else {

					$this->redirect(array('colaborador/create', 'inscPublico' => true));
					return;

				}

			}
		}
		$this->render('cpf',array('form'=>$form));
	}
	
	/**
	 * Exibe a página de seleção do concurso
	 */
	
	public function actionSelecionarConcurso()
	{
			
		//recupera dados da sessão e os dados postados
		$form = $this->getSessionForm();
		
		if(!isset($form,$form->colaborador))
		{
			$this->render('erro',array('form'=>$form,'mensagem'=>'Identificamos uma inconsistência no processo de inscrição, por favor reinicie o processo!'));	
			return;	
		}
		
		if(isset($_GET['idconcurso']))
		{
			
			$form->concurso = $this->loadConcurso($_GET['idconcurso']);		

			if($form->validate("selecionarConcurso"))
			{						
				$this->setSessionForm($form);			
				$this->actionSelecionarInstituicao();
				return;
			}
		}		

		if(isset($form->colab_cpf))
		{
			$models=$this->getConcursosEmAndamento();

			$this->render('concurso_etapa',array(
				'models'=>$models,
				'form'=>$form,
			));
		}

	}
	
	public function actionSelecionarInstituicao()
	{

		//recupera dados da sessão e os dados postados
		$form = $this->getSessionForm();
		
		if(!isset($form,$form->concurso,$form->colaborador))
		{
			$this->render('erro',array('form'=>$form,'mensagem'=>'Identificamos uma inconsistência no processo de inscrição, por favor reinicie o processo!'));	
			return;	
		}
		
		// consulta instituições disponíveis no processo
		$models = $this->getInstituicoesDisponiveis($form->concurso->conc_id_pk);	

		if (count($models) > 0) // há vagas
			// exibe a página de seleção de instituições
			$this->render('instituicao',array(
				'models'=>$models,
				'form'=>$form,
			));
		else
			$this->render('nao_ha_vagas',array('form'=>$form));		
		
	}	
	
	public function actionConfirmacao()
	{
		//recupera dados da sessão e os dados postados
		$form = $this->getSessionForm();
		
		if(isset($_GET['id']))
		{
			$form->instituicao = $this->loadinstituicao();
		}
		else
		{
			$this->render('erro',array('form'=>$form,'mensagem'=>'Identificamos uma inconsistência no processo de inscrição, por favor reinicie o processo!'));	
			return;	
		}
		
		$this->setSessionForm($form);	
		
		// exibe a página de confirmação
		$this->render('confirmacao',array(
			'form'=>$form,
		));
	}
	
	public function actionConfirmar() {

		//recupera dados da sessão e os dados postados
		$form = $this->getSessionForm();
		
		if (isset($_POST['FormInscricaoPublico'])) {

			$form->attributes = $_POST['FormInscricaoPublico'];

			if($form->validate('inscricaoPublico')) {
	
				$data = array(
					'select'=>'mapa_id_pk, mapa_vagas, inst_nome, count( case when insc_id_pk is not null then if(insc_ativa, 1, null) end ) as inscricoes',
					'condition'=>'mapa_vaga_publica and fconc_conc_id = :idconcurso and mapa_inst_id = :instid',
					'join'=>'join inscricao on insc_mapa_id = mapa_id_pk
							 join funcao_concurso fc on mapa.mapa_fconc_id = fc.fconc_id_pk
							 join instituicao on mapa_inst_id = inst_id_pk',
					'group'=>'inst_municipio_id, inst_codigo, inst_id_pk, mapa_vagas',
					'having'=>'mapa_vagas > inscricoes',
					'params'=>array('idconcurso' => $form->concurso->conc_id_pk, 'instid' => $form->instituicao->inst_id_pk),
				 );

				$criteria=new CDbCriteria($data);

				$mapa = mapa::model()->find($criteria);

				if (isset($mapa)) {

					$inscricao = new inscricao();

					$inscricao->insc_mapa_id = $mapa->mapa_id_pk;
					$inscricao->insc_colab_id = $form->colaborador->colab_id_pk;
					$inscricao->insc_ativa = 1;
					$inscricao->insc_create_datetime = date('Y-m-d H:i:s',time());
					$inscricao->insc_update_datetime = date('Y-m-d H:i:s',time());
					$inscricao->insc_update_acao = 'I';
					$inscricao->insc_update_colab_id = $form->colaborador->colab_id_pk;
			
					if($inscricao->save()) {
				
						$colaborador = $this->loadcolaborador($inscricao->insc_colab_id);
	
						$colaborador->colab_nome       = $_POST['FormInscricaoPublico']['colab_nome'      ];
						$colaborador->colab_rg         = $_POST['FormInscricaoPublico']['colab_rg'        ];
						$colaborador->colab_email      = $_POST['FormInscricaoPublico']['colab_email'     ];
						$colaborador->colab_nascimento = $_POST['FormInscricaoPublico']['colab_nascimento'];
						$colaborador->colab_celular_1  = $_POST['FormInscricaoPublico']['colab_celular_1' ];
						$colaborador->colab_banco_id   = $_POST['FormInscricaoPublico']['colab_banco_id'  ];
						$colaborador->colab_agencia    = $_POST['FormInscricaoPublico']['colab_agencia'   ];
						$colaborador->colab_conta      = $_POST['FormInscricaoPublico']['colab_conta'     ];
						$colaborador->colab_conta_dv   = $_POST['FormInscricaoPublico']['colab_conta_dv'  ];
						$colaborador->colab_update_id  = $colaborador->colab_id_pk;
	
						$colaborador->setScenario('inscricaoPublico');
	
						if ($colaborador->save()) {
	
							$form->colaborador->banco           = $colaborador->banco;
	
							$form->colaborador->colab_nome       = $colaborador->colab_nome;
							$form->colaborador->colab_rg         = $colaborador->colab_rg;
							$form->colaborador->colab_email      = $colaborador->colab_email;
							$form->colaborador->colab_nascimento = $colaborador->colab_nascimento;
							$form->colaborador->colab_celular_1  = $colaborador->colab_celular_1;						
							$form->colaborador->colab_banco_id   = $colaborador->colab_banco_id;
							$form->colaborador->colab_agencia    = $colaborador->colab_agencia;
							$form->colaborador->colab_conta      = $colaborador->colab_conta;
							$form->colaborador->colab_conta_dv   = $colaborador->colab_conta_dv;
							
						}
						else {									
							$inscricao->delete();
							$this->render('erro', array('form' => $form, 'mensagem' => 'Identificamos uma inconsistência no processo de inscrição, por favor reinicie o processo!'));	
							return;	
						}
	
						$this->redirect(array('confirmado'));
	
					}

					$this->setSessionForm($form);
					return;

				}
				else {

					$this->render('nao_ha_vagas',array('form'=>$form));
					return;

				}

				
			}

		}

		$this->render('confirmacao', array('form' => $form));
	}	
	
	public function actionConfirmado()
	{
		//recupera dados da sessão e os dados postados
		$form = $this->getSessionForm();
		$arquivo = arquivo::model()->findByAttributes(array('arq_conc_id' => $form->concurso->conc_id_pk, 'arq_tipo' => 4));

		$this->render('confirmado', array('form' => $form, 'arquivo' => $arquivo));
		
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
	
	public function loadcolaborador($id)
	{
		return colaborador::model()->findbyPk($id!==null ? $id : $_GET['id']);
	}
	
	public function getConcursosEmAndamento($id=null) {
		$data = array(
			'order' => 'conc_id_pk desc',
			'condition' => 'conc_data_publico_inicio <= now() and conc_data_publico_fim >= now()'
		);

		$criteria = new CDbCriteria($data);

		return concurso::model()->findAll($criteria);
	}
	
	public function getInstituicoesDisponiveis($idconcurso)
	{
		$data = array(
					'select'=>'inst_id_pk, inst_codigo, inst_nome, inst_logradouro, inst_numero, inst_cep, inst_bairro, inst_maps, inst_municipio_id, inst_uf_id, muni_id_pk, muni_nome, mapa_id_pk, mapa_vagas, count(insc_id_pk) as inscricoes',
					'condition'=>'fconc_conc_id = :idconcurso and fconc_func_id = 1 and mapa_vaga_publica and (insc_ativa or insc_id_pk is null)',
					'join'=>'join mapa on mapa_inst_id = inst_id_pk
							 join funcao_concurso on mapa_fconc_id = fconc_id_pk
							 join municipio on instituicao.inst_municipio_id = muni_id_pk
							 join uf on instituicao.inst_uf_id = uf.uf_id_pk
							 left join inscricao on mapa_id_pk = insc_mapa_id',
					'group'=>'inst_municipio_id, inst_codigo, inst_id_pk, mapa_vagas',
					'having'=>'mapa_vagas > inscricoes',
					'params'=>array('idconcurso' => $idconcurso),
				 );

		$criteria=new CDbCriteria($data);

		return instituicao::model()->findAll($criteria);
	}	
}