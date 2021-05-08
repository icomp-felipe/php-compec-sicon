<?php

class colaborador extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'colaborador':
	 * @var integer $idColaborador
	 * @var integer $idescolaridade
	 * @var integer $iduf_identidade
	 * @var integer $idmunicipio
	 * @var string $nome
	 * @var string $sexo
	 * @var string $data_nascimento
	 * @var string $doc_identidade
	 * @var string $orgao_identidade
	 * @var string $logradouro
	 * @var string $numero_endereco
	 * @var string $bairro
	 * @var string $cep
	 * @var string $ddd
	 * @var string $telefone
	 * @var string $celular
	 * @var string $email
	 * @var string $cpf
	 * @var integer $tipo_cadastro
	 * @var integer $status_cadastro
	 * @var integer $tipo_vinculo
	 * @var integer $anoatualgraduacao
	 * @var integer $matriculaufam
	 * @var string $cursoufam
	 * @var integer $matriculaservidor
	 * @var string $orgaoservidor
	 * @var string $observacoes
	 * @var string $banco
	 * @var string $contacorrente
	 * @var string $agencia
	 * @var string $pispasep
	 * @var integer $tipo_vinculo_old	 
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'colaborador';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{	
		return array(

			// Identificação
			array('nome','length','max'=>60),
			array('cpf', 'ext.validators.CCpfValidator','message'=>'O número de CPF informado é inválido!'),		
			array('cpf', 'unique',"allowEmpty"=>false, 'attributeName'=>'cpf','className'=>'colaborador', 'message'=>'O {attribute} "{value}" já foi cadastrado.','on'=>'create'),
			array('data_nascimento', 'type', 'type'=>'date',
                'dateFormat'=>Yii::app()->locale->dateFormat,
                'message' => '{attribute} inválida'
            ),
			array('sexo'            ,'length','max' => 1 ),
			array('pispasep'        ,'length','max' => 18),
			array('doc_identidade'  ,'length','max' => 20),
			array('orgao_identidade','length','max' => 10),
			
			// Endereço
			array('logradouro'      ,'length','max' => 50),
			array('numero_endereco' ,'length','max' => 5 ),
			array('bairro'          ,'length','max' => 80),
			array('cep'             ,'length','max' => 9 ),
			array('complemento'     ,'length','max' => 80),

			// Contatos
			array('celular','length','max' => 15),
			array('email'  ,'length','max' => 60),

			// Informações Bancárias
			array('banco'        ,'length','max' => 80),
			array('contacorrente','length','max' => 20),
			array('agencia'      ,'length','max' => 10),
            
			// Campos Obrigatórios
			array('nome, cpf, sexo, pispasep, doc_identidade, orgao_identidade, banco, agencia, contacorrente, tipo_vinculo', 'required'),
			array('cpf','required', 'on'=>'formCPF'),			
			array('tipo_cadastro, status_cadastro, tipo_vinculo', 'numerical', 'integerOnly' => true),
		);
	}
	
	protected function beforeValidate(){
		$this->cpf = str_replace('.','',$this->cpf);
		$this->cpf = str_replace('-','',$this->cpf);
		return true;
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'municipio' => array(self::BELONGS_TO, 'municipio', 'idmunicipio'),
			'iduf_identidade0' => array(self::BELONGS_TO, 'uf', 'iduf_identidade'),
			'idescolaridade0' => array(self::BELONGS_TO, 'escolaridade', 'idescolaridade'),
			'envio_emails' => array(self::HAS_MANY, 'envioEmail', 'idColaborador'),
			'inscricaos' => array(self::HAS_MANY, 'inscricao', 'idColaborador'),
			'instituicoesDirigidas' => array(self::HAS_MANY, 'instituicao', 'idResponsavel'),
			'usuarios' => array(self::HAS_MANY, 'usuario', 'idColaborador'),
			'vinculos' => array(self::HAS_MANY, 'vinculo', 'idColaborador'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idColaborador' => 'ID',
			'idescolaridade' => 'Escolaridade',
			'iduf_identidade' => 'UF do RG',
			'idmunicipio' => 'Município',
			'nome' => 'Nome',
			'sexo' => 'Sexo',
			'data_nascimento' => 'Data de Nascimento',
			'doc_identidade' => 'Nº do RG',
			'orgao_identidade' => 'Órgão',
			'logradouro' => 'Logradouro',
			'numero_endereco' => 'Número',
			'bairro' => 'Bairro',
			'cep' => 'CEP',
			'ddd' => 'DDD',
			'telefone' => 'Telefone',
			'celular' => 'Celular',
			'email' => 'e-mail',
			'complemento' => 'Complemento',
			'cpf' => 'CPF',
			'tipo_cadastro' => 'Tipo Cadastro',
			'status_cadastro' => 'Status Cadastro',
			'tipo_vinculo' => 'Tipo Vínculo',
			'anoatualgraduacao' => 'Anoatualgraduacao',
			'matriculaufam' => 'Matriculaufam',
			'cursoufam' => 'Cursoufam',
			'matriculaservidor' => 'Matriculaservidor',
			'orgaoservidor' => 'Orgaoservidor',
			'observacoes' => 'Observações',
			'banco' => 'Banco',
			'contacorrente' => 'Nº da Conta',
			'agencia' => 'Agência',
			'pispasep' => 'PIS/PASEP',
			'tipo_vinculo_old' => 'Tipo Vinculo Old',
		);
	}
	
	const SEXO_MASCULINO='M';
	const SEXO_FEMININO='F';
	public function getSexoOptions()
	{
		return array(
			self::SEXO_MASCULINO=>'Masculino',
			self::SEXO_FEMININO=>'Feminino',
		);
	}
	
	public function getSexoText()
	{
		$options=$this->sexoOptions;
		return isset($options[$this->sexo]) ? $options[$this->sexo] : "desconhecido ({$this->sexo})";
	}
	
	public function behaviors(){
		return array('datetimeI18NBehavior'=>array('class'=>'ext.DateTimeI18NBehavior'));
	}
	
	protected function beforeSave(){
		if (!parent::beforeSave())
			return false;

		$session=Yii::app()->getSession();	
		$usuario = $session["usuario"];
		
		$this->data_cadastro = null;
		$this->cep = str_replace('-','',$this->cep);
		$this->pispasep = str_replace('.','',$this->pispasep);
		$this->pispasep = str_replace('-','',$this->pispasep);
		$this->cpf = str_replace('.','',$this->cpf);
		$this->cpf = str_replace('-','',$this->cpf);
		$this->status_cadastro = 1;
		$this->tipo_cadastro = 1;
		if (isset($usuario))
			$this->idusuario = $usuario->idUsuario;
		return true;
	}	
	
	
}