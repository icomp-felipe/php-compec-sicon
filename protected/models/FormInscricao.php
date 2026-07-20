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
	public $colab_celular    = null;
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
			array('colab_nascimento, colab_banco_id, colab_agencia, colab_conta, colab_conta_dv','required', 'on' => 'inscricao')

		);
	}

	public function attributeLabels() {
		return array(

			'colab_cpf'        => 'CPF',
			'colab_nascimento' => 'Data de Nascimento',
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
		elseif (isset($colaborador)) {

			$data = array(
				'condition'=>'colab_id_pk = :colab_id_pk and block_ativo and block_data_validade >= curdate()',
				'join'=>'join inscricao on block_insc_id = insc_id_pk
						 join colaborador on insc_colab_id = colab_id_pk
						 join mapa on insc_mapa_id = mapa_id_pk
						 join funcao_concurso on mapa_fconc_id = fconc_id_pk
						 join funcao on fconc_func_id = func_id_pk
						 join concurso on fconc_conc_id = conc_id_pk',
				'params'=>array('colab_id_pk' => $colaborador->colab_id_pk)
			 );

			$criteria=new CDbCriteria($data);

			$bloqueio = bloqueio::model()->find($criteria);

			if (isset($bloqueio))	
				$this->errorCode=self::ERRO_COLAB_BLOQUEADO;

		}
		
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