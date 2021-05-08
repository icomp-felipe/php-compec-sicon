<?php

/**
 * CpfForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class CpfForm extends CFormModel
{
	public $cpf;
	public $colaborador=null;
	public $concurso=null;
	public $etapa=null;	
	public $instituicao=null;
	public $funcao=null;
	public $banco=null;
	public $agencia=null;
	public $contacorrente=null;
	public $pispasep=null;
	public $doc_identidade=null;
	
	public $errorCode=0;
	const ERROR_CADASTRO_NAO_ENCONTRADO=1;
	const ERROR_CADASTRO_COM_PENDENCIAS=2;	

	/**
	 * Declares the validation rules.
	 * The rules state that cpf is required,
	 * and need to be :
	 * 1. cadastrado
	 * 2. n�o possuir restri��es de concursos anteriores
	 */
	public function rules()
	{
			return array(
			// cpf is required
			array('cpf', 'required','on'=>'cpf'),
			// cpf � v�lido
			array('cpf', 'ext.validators.CCpfValidator','message'=>'O CPF informado est&aacute; incorreto!','on'=>'cpf'),
			// cpf est� cadastrado e n�o possui restri��o em concursos anteriores
			array('cpf', 'validarColaborador','on'=>'cpf'),		
			array('cpf', 'verificarDuplicidadeInscricao','on'=>'selecionarConcurso'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'cpf'=>'CPF',		
		);
	}

	/**
	 * Verifica se:
	 *    1. se o cpf est� cadastrado
	 *    2. se o cpf n�o possui restri��es em concursos anteriores
	 * This is the 'cadastrado' validator as declared in rules().
	 */
	public function validarColaborador($attribute,$params)
	{
		if(!$this->hasErrors())  // we only want to authenticate when no input errors
		{
			$this->colaborador = new colaborador();
		
			$this->colaborador = $this->validarCadastro($this->cpf);

			switch($this->errorCode)
			{
				case self::ERROR_CADASTRO_NAO_ENCONTRADO:
					$this->addError('cpf','Infelizmente seu CPF n�o est� cadastrado em nosso Banco de Dados.');
					break;
				case self::ERROR_CADASTRO_COM_PENDENCIAS:
					$this->addError('cpf','Identificamos pend�ncia(s) em seu cadastro. Por favor dirija-se � sede da COMPEC para maiores esclarecimentos. ');
					break;
			}			
		}
	}

	public function validarCadastro($cpf)
	{		
//		$cpf = str_pad(ereg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);
	    $cpf = str_replace('.','',$cpf);
	    $cpf = str_replace('-','',$cpf);		
	    $cpf = str_pad($cpf, STR_PAD_LEFT);		
		
		$colaborador = colaborador::model()->findByAttributes(array('cpf' => $cpf));
		
		if ($colaborador == null)
			$this->errorCode=self::ERROR_CADASTRO_NAO_ENCONTRADO;
		elseif ($colaborador->status_cadastro > 1)
			$this->errorCode=self::ERROR_CADASTRO_COM_PENDENCIAS;		
		
		return $colaborador;
	}

	/**
	 * Verifica se o cpf j� est� inscrito no concurso
	 */
	public function verificarDuplicidadeInscricao($attribute,$params)
	{
	
		if(!$this->hasErrors())  // we only want to authenticate when no input errors
		{
			
			$inscricao = inscricao::verificarDuplicidadeInscricao($this->colaborador->idColaborador, $this->etapa->idetapa);
			
			if ($inscricao != null)
			{
				$this->addError('cpf','Verificamos que sua inscri��o neste concurso j� foi realizada!');
//				$this->addError('cpf','Verificamos que sua inscri��o neste concurso j� foi realizada! Procure a COMPEC (3305-4199 / 4213) para realizar altera��es.');
				
			}
		}
	}
}
