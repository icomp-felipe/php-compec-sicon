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

		$form->colab_nome      = $form->colaborador->nomeProprio;
		$form->colab_cpf       = $session["cpf"];
		$form->colab_pis       = $form->colaborador->colab_pis;
		$form->colab_rg        = $form->colaborador->colab_rg;
		$form->colab_celular_1 = $form->colaborador->colab_celular_1;
		$form->colab_email     = $form->colaborador->colab_email;
		$form->colab_banco_id  = $form->colaborador->colab_banco_id;
		$form->colab_agencia   = $form->colaborador->colab_agencia;
		$form->colab_conta     = $form->colaborador->colab_conta;
		$form->colab_conta_dv  = $form->colaborador->colab_conta_dv;
		
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

				$this->setSessionForm($form);
				
				$this->actionSelecionarConcurso();
				
				return;
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
	
				$inscricao = new inscricao();

				$inscricao->idinstituicaoopcao1 = $form->instituicao->inst_id_pk;
				$inscricao->idconcurso 			= $form->concurso->conc_id_pk;
				$inscricao->idColaborador		= $form->colaborador->colab_id_pk;
				$inscricao->selecionado			= 'W';
				$inscricao->tipoinscricao		= 1;
				$inscricao->candidatociente		= 'W';
				$inscricao->idFuncao			= 1;
				$inscricao->dt_hr				= date('Y-m-d H:i:s',time());
		
				if($inscricao->save()) {
			
					$colaborador = $this->loadcolaborador($inscricao->idColaborador);

					$colaborador->colab_nome      = $_POST['FormInscricaoPublico']['colab_nome'     ];
					$colaborador->colab_pis       = $_POST['FormInscricaoPublico']['colab_pis'      ];
					$colaborador->colab_rg        = $_POST['FormInscricaoPublico']['colab_rg'       ];
					$colaborador->colab_email     = $_POST['FormInscricaoPublico']['colab_email'    ];
					$colaborador->colab_celular_1 = $_POST['FormInscricaoPublico']['colab_celular_1'];
					$colaborador->colab_banco_id  = $_POST['FormInscricaoPublico']['colab_banco_id' ];
					$colaborador->colab_agencia   = $_POST['FormInscricaoPublico']['colab_agencia'  ];
					$colaborador->colab_conta     = $_POST['FormInscricaoPublico']['colab_conta'    ];
					$colaborador->colab_conta_dv  = $_POST['FormInscricaoPublico']['colab_conta_dv' ];
					$colaborador->colab_update_id = $colaborador->colab_id_pk;

					$colaborador->setScenario('inscricaoPublico');

					if ($colaborador->save()) {

						$form->colaborador->banco           = $colaborador->banco;

						$form->colaborador->colab_nome      = $colaborador->colab_nome;
						$form->colaborador->colab_pis       = $colaborador->colab_pis;
						$form->colaborador->colab_rg        = $colaborador->colab_rg;
						$form->colaborador->colab_email     = $colaborador->colab_email;
						$form->colaborador->colab_celular_1 = $colaborador->colab_celular_1;						
						$form->colaborador->colab_banco_id  = $colaborador->colab_banco_id;
						$form->colaborador->colab_agencia   = $colaborador->colab_agencia;
						$form->colaborador->colab_conta     = $colaborador->colab_conta;
						$form->colaborador->colab_conta_dv  = $colaborador->colab_conta_dv;
						
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

		}

		$this->render('confirmacao', array('form' => $form));
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
					'order'=>'inst_nome',
					'condition'=>' inst_id_pk in 
										(select idinstituicao from config_concurso cc1
												where mapa_concurso_id  = :idconcurso 
												  and idfuncao = 1 /*fiscal*/
												  and vagasofertadasnormal > (select count(*) 
												  								from inscricao i1
																			   where cc1.mapa_concurso_id  = i1.idconcurso
																				 and cc1.idfuncao = i1.idfuncao
																				 and cc1.idinstituicao =
																				     i1.idinstituicaoopcao1
																				 and tipoinscricao = 1 /*internet*/))',
					'params'=>array('idconcurso' => $idconcurso),
				 );

		$criteria=new CDbCriteria($data);

		return instituicao::model()->findAll($criteria);
	}	
}