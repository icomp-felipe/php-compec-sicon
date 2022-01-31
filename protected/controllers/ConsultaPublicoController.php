<?php

class ConsultaPublicoController extends CController {

	public $defaultAction = 'identificacao';

	function getSessionForm() {

		$session=Yii::app()->getSession();

		$form = new ConsultaPublicoController();

		$form->colaborador = $session["colaborador"];

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

	}

	public function actionIdentificacao() {

		$form = new FormInscricaoConsulta;
		$this->setSessionForm($form);

		if(isset($_POST['FormInscricaoConsulta'])) {

			$form->attributes = $_POST['FormInscricaoConsulta'];
			
			if ($form->validate('identificacao')){

				$this->setSessionForm($form);
				$this->actionSelecionarConcurso();
				
				return;
			}

		}

		$this->render('identificacao', array('form' => $form));
	}
	
	public function actionConfirmacao() {
		
		// Recupera dados da sessão
		$form = $this->getSessionForm();
		
		// Exibe a página de confirmação
		$this->render('confirmacao',array(
			'form' => $form,
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
	
}