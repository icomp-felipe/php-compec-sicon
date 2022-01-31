<?php

class FormConfirmaPublico extends CFormModel {

	// Objetos
	public $colaborador = null;
	public $inscricao   = null;

	// Atributos do Colaborador
	public $colab_nome      = null;
	public $colab_cpf       = null;
	public $colab_pis       = null;
	public $colab_rg        = null;
	public $colab_celular_1 = null;
	public $colab_email     = null;
	public $colab_banco_id  = null;
	public $colab_agencia   = null;
	public $colab_conta     = null;
	public $colab_conta_dv  = null;

	// Controle de formulário
	public $ciente = false;

    public function rules() {

		return array(

			// CPF é um campo obrigatório no cenário 'identificacao'
			array('colab_cpf', 'required','on' => 'identificacao'),

			// Validação (externa) dos dígitos do CPF, no cenário 'identificacao'
			array('colab_cpf', 'ext.validators.CPFValidator','message' => 'O CPF informado é inválido!','on' => 'identificacao'),

			// Validação (externa) do endereço de e-mail, no cenário 'confirmaPublico'
			array('colab_email', 'ext.validators.EmailValidator','message' => 'O e-mail informado é inválido!', 'on' => 'confirmaPublico'),

            // Validação (interna) do colaborador, no cenário 'identificacao':
			// * Verifica se existe inscrição do colaborador, identificado por seu CPF;
			array('colab_cpf', 'validarInscricao', 'on' => 'identificacao'),

			// Define campos obrigatórios no cenário 'confirmaPublico'
			array('colab_nome, colab_pis, colab_rg, colab_celular_1, colab_email, colab_banco_id, colab_agencia, colab_conta, colab_conta_dv, ciente', 'required', 'on' => 'confirmaPublico'),

			// Validação (interna) de ciência de procedimentos, no cenário 'confirmaPublico'
			array('ciente', 'validarCiencia', 'on' => 'confirmaPublico'),

			// Validação (externa) dos dígitos do PIS, no cenário 'confirmaPublico'
			array('colab_pis', 'ext.validators.PISValidator', 'message'=>'O PIS informado é inválido!', 'on' => 'confirmaPublico')

		);
	}

	public function attributeLabels() {

		return array(

			'colab_cpf' => 'CPF'

		);
	}

    /** Verifica se existe inscrição do colaborador no concurso selecionado. */
	public function validarInscricao($attribute, $params) {

		if (!$this->hasErrors()) {

            // Extrai apenas os dígitos do CPF
	        $cpf = preg_replace( '/[^0-9]/is', '', $this->colab_cpf);
		
		    // Recuperando o colaborador da base de dados
		    $this->colaborador = colaborador::model()->findByAttributes(array('colab_cpf' => $cpf));

			// Verifica se o colaborador possui cadastro
		    if ($this->colaborador == null)
				$this->addError('colab_cpf', 'Colaborador sem cadastrado na Base de Dados da COMPEC.');

			// Se possui cadastro, busca sua inscrição no PSC 2021 - Etapas 1 e 2
			else {

				$this->inscricao = inscricao::model()->findByAttributes(array('idColaborador' => $this->colaborador->colab_id_pk, 'idconcurso' => 62));

				if ($this->inscricao == null)
					$this->addError('colab_cpf', 'Inscrição não encontrada');

			}

		}

	}

	/** Verifica se o checkbox de ciência foi marcado. */
	public function validarCiencia($attribute, $params) {
		
		if(!$this->hasErrors())
	
			if ($this->ciente == false)
				$this->addError('ciente', 'Por favor, confirme ciência da nova data do concurso, dados pessoais, bancários e procedimentos de biossegurança');
	
	}

}