<?php

class ConfirmaPublicoController extends CController {

	// Define a primeira tela a ser exibida ao acionar este controller
	public $defaultAction = 'concursoEmAndamento';

	// Recupera dados de sessão para o form
	function getSessionForm() {

		$session = Yii::app()->getSession();

		$form = new FormConfirmaPublico();

		$form->colaborador = $session["colaborador"];
		$form->inscricao   = $session["inscricao"];

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

	// Salva dados do form na sessão
	function setSessionForm($form)	{

		$session=Yii::app()->getSession();

		$session["cpf"        ] = $form->colab_cpf;
		$session["colaborador"] = $form->colaborador;
		$session["inscricao"  ] = $form->inscricao;

	}

	// Renderiza a tela de identificação do colaborador, caso haja concursos em andamento, senão, uma tela de erro.
	public function actionConcursoEmAndamento() {

		if ($this->inscricoesAbertas  ())
			$this->actionIdentificacao();
		else
			$this->render('nao_ha_concursos');

	}

	// Cuida da identificação do colaborador, por CPF.
	public function actionIdentificacao() {

		// Cria um novo form
		$form = new FormConfirmaPublico;
		$this->setSessionForm($form);

		// Se ocorre um POST...
		if(isset($_POST['FormConfirmaPublico'])) {

			$form->attributes = $_POST['FormConfirmaPublico'];
			
			// ...a inscrição do colaborador é buscada (diretamente no form) e se existe inscrição...
			if ($form->validate('identificacao')) {

				// ...é exibida a tela de atualização/confirmação de dados
				$this->setSessionForm($form);
				$this->redirect(array('confirmacao'));

			}

		}

		// Caso contrário, é exibida a tela de identificação
		$this->render('identificacao', array('form' => $form));

	}
	
	// Trata da tela de atualização/confirmação de dados e ciência de procedimentos.
	public function actionConfirmacao() {
		
		// Recupera dados da sessão
		$form = $this->getSessionForm();

		// Se existe inscrição...
		if (isset($form->inscricao)) {
			
			// ...e ela já foi confirmada ou não é inscrição pública de aplicador, a tela de 'confirmado' é exibida.
			if (($form->inscricao->candidatociente == 'S') || ($form->inscricao->idFuncao != 1) || ($form->inscricao->tipoinscricao != 1))
				$this->render('confirmado', array('form' => $form));
			
			// Caso contrário, é renderizada a página de atualização/confirmação de dados e ciência.
			else
				$this->render('confirmacao', array('form' => $form));

		}
		
	}
	
	// Atualiza os dados pessoais do colaborador na base de dados e confirma a inscrição.
	public function actionConfirmar() {

		// Recupera dados da sessão a partir dos dados postados
		$form = $this->getSessionForm();
		
		// Se houve um POST...
		if (isset($_POST['FormConfirmaPublico'])) {

			// ...seus dados são recuperados, ...
			$form->attributes = $_POST['FormConfirmaPublico'];

			// ...validados e se essa validação foi satisfeita...
			if ($form->validate('confirmaPublico')) {
	
				$inscricao = $form->inscricao;

				// ...a inscrição é marcada como 'confirmada' ...
				$inscricao->candidatociente	= 'S';
				$inscricao->dt_hr			= date('Y-m-d H:i:s', time());
		
				// ...e os dados pessoais do colaborador são atualizados
				if ($inscricao->save()) {
			
					$colaborador = $form->colaborador;

					$colaborador->colab_nome      = $_POST['FormConfirmaPublico']['colab_nome'     ];
					$colaborador->colab_pis       = $_POST['FormConfirmaPublico']['colab_pis'      ];
					$colaborador->colab_rg        = $_POST['FormConfirmaPublico']['colab_rg'       ];
					$colaborador->colab_email     = $_POST['FormConfirmaPublico']['colab_email'    ];
					$colaborador->colab_celular_1 = $_POST['FormConfirmaPublico']['colab_celular_1'];
					$colaborador->colab_banco_id  = $_POST['FormConfirmaPublico']['colab_banco_id' ];
					$colaborador->colab_agencia   = $_POST['FormConfirmaPublico']['colab_agencia'  ];
					$colaborador->colab_conta     = $_POST['FormConfirmaPublico']['colab_conta'    ];
					$colaborador->colab_conta_dv  = $_POST['FormConfirmaPublico']['colab_conta_dv' ];
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

						$this->render('erro', array('form' => $form, 'mensagem' => 'Identificamos uma inconsistência no processo de confirmação de inscrição, por favor reinicie o processo!'));
						return;

					}

					$this->redirect(array('confirmado'));

				}

				$this->setSessionForm($form);
				return;

			}

		}

		// Caso não haja POST, é renderizada a página de atualização/confirmação de dados
		$this->render('confirmacao', array('form' => $form));

	}	
	
	// Exibe uma tela de resumo da confirmação de inscrição
	public function actionConfirmado() {

		// Recupera dados da sessão a partir dos dados postados
		$form = $this->getSessionForm();
		
		$this->render('confirmado',array('form'=>$form));
		
	}

	// Verifica se o PSC - Etapas 1 e 2 está com inscrições abertas
	public function inscricoesAbertas() {

		$data = array(
			'condition' => 'conc_id_pk = 62 and conc_data_publico_inicio <= now() and conc_data_publico_fim >= now()'
		);

		$criteria = new CDbCriteria($data);
		$concurso = concurso::model()->find($criteria);

		return $concurso != null;
	}

}