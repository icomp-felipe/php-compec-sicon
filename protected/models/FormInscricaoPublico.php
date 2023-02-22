<?php

class FormInscricaoPublico extends CFormModel {

	// Objetos
	public $colaborador = null;
	public $concurso    = null;
	public $instituicao = null;
	public $funcao      = null;

	// Atributos do Colaborador
	public $colab_nome       = null;
	public $colab_cpf        = null;
	public $colab_pis        = null;
	public $colab_rg         = null;
	public $colab_nascimento = null;
	public $colab_celular_1  = null;
	public $colab_email      = null;
	public $colab_banco_id   = null;
	public $colab_agencia    = null;
	public $colab_conta      = null;
	public $colab_conta_dv   = null;
	
	// Controle de formulário
	public $ciente    = false;
	public $errorCode = 0;

	// Constantes de validação de colaborador
	const ERRO_COLAB_SEM_CADASTRO = 1;
	const ERRO_COLAB_BLOQUEADO    = 2;

	public function rules() {

		return array(

			// CPF é um campo obrigatório no cenário 'cpf'
			array('colab_cpf', 'required','on' => 'cpf'),

			// Validação (externa) dos dígitos do CPF, no cenário 'cpf'
			array('colab_cpf', 'ext.validators.CPFValidator','message' => 'O CPF informado é inválido!', 'on' => 'cpf'),

			// Validação (externa) do endereço de e-mail, no cenário 'inscricaoPublico'
			array('colab_email', 'ext.validators.EmailValidator','message' => 'O e-mail informado é inválido!', 'on' => 'inscricaoPublico'),

			// Validação (interna) do colaborador, no cenário 'cpf':
			// 1. verifica se o mesmo possui cadastro;
			// 2. verifica se ele está apto a se inscrever (possui status_cadastro = 1)
			array('colab_cpf', 'validarColaborador', 'on' => 'cpf'),

			// Validação (interna) do colaborador, no cenário 'selecionarConcurso':
			// Colaborador já foi inscrito no concurso selecionado?
			array('colab_cpf', 'verificarDuplicidadeInscricao', 'on' => 'selecionarConcurso'),

			// Define campos obrigatórios no cenário 'inscricaoPublico'
			array('colab_nome, colab_nascimento, colab_pis, colab_rg, colab_celular_1, colab_email, colab_banco_id, colab_agencia, colab_conta, colab_conta_dv, ciente', 'required', 'on' => 'inscricaoPublico'),

			// Validação (interna) de ciência de procedimentos, no cenário 'inscricaoPublico'
			array('ciente', 'validarCiencia', 'on' => 'inscricaoPublico'),

			// Validação (externa) dos dígitos do PIS, no cenário 'inscricaoPublico'
			array('colab_pis', 'ext.validators.PISValidator', 'message'=>'O PIS informado é inválido!', 'on' => 'inscricaoPublico')

		);
	}

	public function attributeLabels() {
		return array(

			'concurso'        => 'Concurso',
			'instituicao'     => 'Instituição',
			'funcao'          => 'Função',

			'colab_nome'       => 'Nome',
			'colab_cpf'        => 'CPF',
			'colab_nascimento' => 'Data de Nascimento',
			'colab_pis'        => 'PIS | PASEP | NIS | NIT',
			'colab_rg'         => 'Nº do RG',
			'colab_celular_1'  => 'Celular (WhatsApp)',
			'colab_email'      => 'e-mail',
			'colab_banco_id'   => 'Banco',
			'colab_agencia'    => 'Nº da Agência (s/ dígito)',
			'colab_conta'      => 'Nº da Conta (s/ dígito)',
			'colab_conta_dv'   => 'Dígito da conta'

		);
	}

	/** Verifica se o colaborador, identificado por seu CPF:
	 *  1. possui cadastro na base de dados;
	 *  2. está apto a se inscrever (possui status_cadastro = 1) */
	public function validarColaborador($attribute, $params) {

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

	/** Verifica se o checkbox de ciência foi marcado. */
	public function validarCiencia($attribute, $params) {
		
		if(!$this->hasErrors()) {

			if ($this->ciente == false)
				$this->addError('ciente', 'Por favor, confirme ciência dos dados pessoais e bancários');

		}

	}

	/** Busca o cadastro do colaborador identificado por 'cpf' e verifica se este existe e está ativo. */
	public function validarCadastro($colab_cpf) {

		// Extrai apenas os dígitos do CPF
	    $colab_cpf = preg_replace( '/[^0-9]/is', '', $colab_cpf);
		
		// Recuperando o colaborador da base de dados
		$colaborador = colaborador::model()->findByAttributes(array('colab_cpf' => $colab_cpf));
		
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
	
		if(!$this->hasErrors()) {
			
			// Recupera a inscrição do colaborador no concurso selecionado
			$inscricao = inscricao::verificarDuplicidadeInscricao($this->colaborador->colab_id_pk, $this->concurso->conc_id_pk);
			
			// Se existe inscrição, um erro é gerado
			if ($inscricao != null)
				$this->addError('cpf','Colaborador já possui inscrição no concurso selecionado!');

		}

	}

}