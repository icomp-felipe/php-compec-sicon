<?php

class FormInscricao extends CFormModel {

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
	public $inscricao=null;
	public $multiplosConcursos=false;
	public $multiplasInstituicoes=false;
	
	public $errorCode = 0;

	// Constantes de validação de colaborador
	const ERRO_COLAB_SEM_CADASTRO = 1;
	const ERRO_COLAB_BLOQUEADO    = 2;

	public function rules()	{

		return array(

			// CPF é um campo obrigatório no cenário 'selecionarColaborador'
			array('cpf', 'required', 'on' => 'selecionarColaborador'),

			// Validação (externa) dos dígitos do CPF no cenário 'selecionarColaborador'
			array('cpf', 'ext.validators.CPFValidator','message'=>'O CPF informado est&aacute; incorreto!','on' => 'selecionarColaborador'),

			// Validação (interna) do colaborador, no cenário 'selecionarColaborador':
			// 1. verifica se o mesmo possui cadastro;
			// 2. verifica se ele está apto a se inscrever (possui status_cadastro = 1)
			array('cpf', 'validarColaborador', 'on' => 'selecionarColaborador'),

			// Validação (interna) do colaborador, no cenário 'selecionarColaborador':
			// Colaborador já foi inscrito no concurso selecionado?
			array('cpf', 'verificarDuplicidadeInscricao', 'on' => 'selecionarColaborador'),

			// Define campos obrigatórios no cenário 'inscricao'
			array('pispasep, doc_identidade, colab_banco_id, agencia, contacorrente','required', 'on' => 'inscricao'),

			// Validação (externa) dos dígitos do PIS, no cenário 'inscricao'
			array('pispasep', 'ext.validators.PISValidator', 'message' => 'O PIS informado é inválido!','on' => 'inscricao')

		);
	}

	public function attributeLabels() {
		return array(

			'cpf'            => 'CPF',
			'pispasep'       => 'PIS | PASEP | NIS | NIT',
			'doc_identidade' => 'Nº do RG',
			'colab_banco_id' => 'Nome do Banco',
			'agencia'        => 'Nº da Agência',
			'contacorrente'  => 'Nº da Conta'

		);
	}

	/** Verifica se o colaborador, identificado por seu CPF:
	 *  1. possui cadastro na base de dados;
	 *  2. está apto a se inscrever (possui status_cadastro = 1) */
	public function validarColaborador($attribute, $params)	{

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
	
	/** Busca o cadastro do colaborador identificado por 'cpf' e verifica se este existe e está ativo. */
	private function validarCadastro($cpf) {

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
	
		if (!$this->hasErrors() && $this->colaborador != null)  {
			
			// Recupera a inscrição do colaborador no concurso selecionado
			$inscricao = inscricao::verificarDuplicidadeInscricao($this->colaborador->idColaborador, $this->concurso->idconcurso);
			
			// Se existe inscrição, um erro é gerado
			if ($inscricao != null)
				$this->addError('cpf','Colaborador já possui inscrição no concurso selecionado!');

		}

	}
	
}