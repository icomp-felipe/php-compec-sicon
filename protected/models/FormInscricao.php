<?php

class FormInscricao extends CFormModel {

	// Objetos
	public $colaborador = null;
	public $concurso    = null;
	public $instituicao = null;
	public $funcao      = null;
	public $inscricao   = null;

	// Atributos do Colaborador
	public $colab_cpf        = null;
	public $colab_nascimento = null;
	public $colab_pis        = null;
	public $colab_rg         = null;
	public $colab_celular_1  = null;
	public $colab_email      = null;
	public $colab_banco_id   = null;
	public $colab_agencia    = null;
	public $colab_conta      = null;
	public $colab_conta_dv   = null;

	// Controle de formulário
	public $multiplosConcursos    = false;
	public $multiplasInstituicoes = false;
	public $errorCode             = 0;
		
	// Constantes de validação de colaborador
	const ERRO_COLAB_SEM_CADASTRO = 1;
	const ERRO_COLAB_BLOQUEADO    = 2;

	public function rules()	{

		return array(

			// CPF é um campo obrigatório no cenário 'selecionarColaborador'
			array('colab_cpf', 'required', 'on' => 'selecionarColaborador'),

			// Validação (externa) dos dígitos do CPF no cenário 'selecionarColaborador'
			array('colab_cpf', 'ext.validators.CPFValidator','message' => 'O CPF informado está incorreto!','on' => 'selecionarColaborador'),

			// Validação (interna) do colaborador, no cenário 'selecionarColaborador':
			// 1. verifica se o mesmo possui cadastro;
			// 2. verifica se ele está apto a se inscrever (possui status_cadastro = 1)
			array('colab_cpf', 'validarColaborador', 'on' => 'selecionarColaborador'),

			// Validação (interna) do colaborador, no cenário 'selecionarColaborador':
			// Colaborador já foi inscrito no concurso selecionado?
			array('colab_cpf', 'verificarDuplicidadeInscricao', 'on' => 'selecionarColaborador'),

			// Define campos obrigatórios no cenário 'inscricao'
			array('colab_pis, colab_nascimento, colab_rg, colab_banco_id, colab_agencia, colab_conta, colab_conta_dv','required', 'on' => 'inscricao'),

			// Validação (externa) dos dígitos do PIS, no cenário 'inscricao'
			array('colab_pis', 'ext.validators.PISValidator', 'message' => 'O PIS informado é inválido!','on' => 'inscricao')

		);
	}

	public function attributeLabels() {
		return array(

			'colab_cpf'        => 'CPF',
			'colab_pis'        => 'PIS | PASEP | NIS | NIT',
			'colab_nascimento' => 'Data de Nascimento',
			'colab_rg'         => 'Nº do RG',
			'colab_banco_id'   => 'Banco',
			'colab_agencia'    => 'Nº da Agência',
			'colab_conta'      => 'Nº da Conta',
			'colab_conta_dv'   => 'Dígito da Conta'

		);
	}

	/** Verifica se o colaborador, identificado por seu CPF:
	 *  1. possui cadastro na base de dados;
	 *  2. está apto a se inscrever (possui status_cadastro = 1) */
	public function validarColaborador($attribute, $params)	{

		if(!$this->hasErrors()) {

			// Recupera o cadastro do colaborador
			$this->colaborador = $this->validarCadastro($this->colab_cpf);

			// Se o colaborador não possui cadastro, ou não está ativo, o switch é ativado
			switch($this->errorCode) {

				case self::ERRO_COLAB_SEM_CADASTRO:
					$this->addError('cpf','Colaborador sem cadastrado na Base de Dados da COMPEC.');
					break;

				case self::ERRO_COLAB_BLOQUEADO:
					$this->addError('cpf','Colaborador com cadastro bloqueado!<br>Entre em contato com a COMPEC para mais informações.');
					break;
				
			}

		}
	}
	
	/** Busca o cadastro do colaborador identificado por 'cpf' e verifica se este existe e está ativo. */
	private function validarCadastro($cpf) {

		// Extrai apenas os dígitos do CPF
	    $cpf = preg_replace( '/[^0-9]/is', '', $cpf);
		
		// Recuperando o colaborador da base de dados
		$colaborador = colaborador::model()->findByAttributes(array('colab_cpf' => $cpf));
		
		// Verifica se o colaborador possui cadastro
		if ($colaborador == null)
			$this->errorCode=self::ERRO_COLAB_SEM_CADASTRO;
		
		// Verifica se o colaborador está ativo
		elseif ($colaborador->colab_status != 1)
			$this->errorCode=self::ERRO_COLAB_BLOQUEADO;
		
		return $colaborador;
	}

	/** Verifica se o colaborador possui inscrição no concurso selecionado. */
	public function verificarDuplicidadeInscricao($attribute, $params) {
	
		if (!$this->hasErrors() && $this->colaborador != null)  {
			
			// Recupera a inscrição do colaborador no concurso selecionado
			$inscricao = inscricao::verificarDuplicidadeInscricao($this->colaborador->colab_id_pk, $this->concurso->conc_id_pk);
			
			// Se existe inscrição, um erro é gerado
			if ($inscricao != null)
				$this->addError('cpf','Colaborador já possui inscrição no concurso selecionado!');

		}

	}
	
}