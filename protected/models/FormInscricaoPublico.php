<?php

class FormInscricaoPublico extends CFormModel {

	public $cpf;
	public $colaborador=null;
	public $concurso=null;
	public $instituicao=null;
	public $funcao=null;
	public $colab_banco_id=null;
	public $agencia=null;
	public $contacorrente=null;
	public $pispasep=null;
	public $doc_identidade=null;
	public $celular=null;
	public $email=null;
	public $ciente=false;
	
	public $errorCode = 0;

	// Constantes de validação de colaborador
	const ERRO_COLAB_SEM_CADASTRO = 1;
	const ERRO_COLAB_BLOQUEADO    = 2;

	public function rules() {

		return array(

			// CPF é um campo obrigatório no cenário 'cpf'
			array('cpf', 'required','on'=>'cpf'),

			// Validação (externa) dos dígitos do CPF, no cenário 'cpf'
			array('cpf', 'ext.validators.CPFValidator','message'=>'O CPF informado é inválido!','on'=>'cpf'),

			// Validação (interna) do colaborador, no cenário 'cpf':
			// 1. verifica se o mesmo possui cadastro;
			// 2. verifica se ele está apto a se inscrever (possui status_cadastro = 1)
			array('cpf', 'validarColaborador','on'=>'cpf'),

			// Validação (interna) do colaborador, no cenário 'selecionarConcurso':
			// Colaborador já foi inscrito no concurso selecionado?
			array('cpf', 'verificarDuplicidadeInscricao','on'=>'selecionarConcurso'),

			// Define campos obrigatórios no cenário 'inscricaoPublico'
			array('celular, email, pispasep, doc_identidade, colab_banco_id, agencia, contacorrente, ciente','required', 'on'=>'inscricaoPublico'),

			// Validação (interna) de ciência de procedimentos, no cenário 'inscricaoPublico'
			array('ciente', 'validarCiencia', 'on' => 'inscricaoPublico'),

			// Validação (externa) dos dígitos do PIS, no cenário 'inscricaoPublico'
			array('pispasep', 'ext.validators.PISValidator','message'=>'O PIS informado é inválido!','on'=>'inscricaoPublico')

		);
	}

	public function attributeLabels() {
		return array(

			'cpf'            => 'CPF',
			'celular'        => 'Celular (WhatsApp)',
			'concurso'       => 'Concurso',
			'instituicao'    => 'Instituição',
			'funcao'         => 'Função',
			'email'          => 'e-mail',
			'pispasep'       => 'PIS | PASEP | NIS | NIT',
			'doc_identidade' => 'Nº do RG',
			'colab_banco_id' => 'Banco',
			'agencia'        => 'Nº da Agência (s/ dígito)',
			'contacorrente'  => 'Nº da Conta (com dígito)'

		);
	}

	/** Verifica se o colaborador, identificado por seu CPF:
	 *  1. possui cadastro na base de dados;
	 *  2. está apto a se inscrever (possui status_cadastro = 1) */
	public function validarColaborador($attribute, $params) {

		if(!$this->hasErrors()) {

			// Recupera o cadastro do colaborador
			$this->colaborador = $this->validarCadastro($this->cpf);

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
				$this->addError('ciente', 'Por favor, confirme ciência dos dados e procedimentos de biossegurança');

		}

	}

	/** Busca o cadastro do colaborador identificado por 'cpf' e verifica se este existe e está ativo. */
	public function validarCadastro($cpf) {

		// Extrai apenas os dígitos do CPF
	    $cpf = preg_replace( '/[^0-9]/is', '', $cpf);
		
		// Recuperando o colaborador da base de dados
		$colaborador = colaborador::model()->findByAttributes(array('cpf' => $cpf));
		
		// Verifica se o colaborador possui cadastro
		if ($colaborador == null)
			$this->errorCode=self::ERRO_COLAB_SEM_CADASTRO;
		
		// Verifica se o colaborador está ativo
		elseif ($colaborador->status_cadastro != 1)
			$this->errorCode=self::ERRO_COLAB_BLOQUEADO;
		
		return $colaborador;
	}

	/** Verifica se o colaborador possui inscrição no concurso selecionado. */
	public function verificarDuplicidadeInscricao($attribute, $params) {
	
		if(!$this->hasErrors()) {
			
			// Recupera a inscrição do colaborador no concurso selecionado
			$inscricao = inscricao::verificarDuplicidadeInscricao($this->colaborador->idColaborador, $this->concurso->idconcurso);
			
			// Se existe inscrição, um erro é gerado
			if ($inscricao != null)
				$this->addError('cpf','Colaborador já possui inscrição no concurso selecionado!');

		}

	}

}