<?php

/** Modelagem do colaborador.
 *  Atualizada em: 08/05/2021
 *  @author Felipe André <felipeandresouza@hotmail.com>
 */
class colaborador extends CActiveRecord {

	/** @return CActiveRecord the static model of the specified AR class. */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/** @return string the associated database table name */
	public function tableName()	{
		return 'colaborador';
	}

	/** @return array relational rules. */
	public function relations()	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'municipio' => array(self::BELONGS_TO, 'municipio', 'idmunicipio'),
			'banco' => array(self::BELONGS_TO, 'banco', 'colab_banco_id'),
			'iduf_identidade0' => array(self::BELONGS_TO, 'uf', 'iduf_identidade'),
			'idescolaridade0' => array(self::BELONGS_TO, 'escolaridade', 'idescolaridade'),
			'inscricaos' => array(self::HAS_MANY, 'inscricao', 'idColaborador'),
			'instituicoesDirigidas' => array(self::HAS_MANY, 'instituicao', 'inst_coordenador_id'),
			'usuarios' => array(self::HAS_MANY, 'usuario', 'idColaborador')
		);
	}

	/** @return array validation rules for model attributes. */
	public function rules()	{

		return array(

			// Identificação
			array('nome','length','max'=>60),
			array('cpf', 'ext.validators.CPFValidator','message'=>'O número de CPF informado é inválido!'),
			array('pispasep', 'ext.validators.PISValidator','message'=>'O número de PIS | PASEP | NIS | NIT informado é inválido!'),
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
			array('contacorrente','length','max' => 20),
			array('agencia'      ,'length','max' => 10),
            
			// Campos Obrigatórios
			array('nome, cpf, sexo, pispasep, doc_identidade, orgao_identidade, colab_banco_id, agencia, contacorrente, tipo_vinculo', 'required'),
			array('cpf','required', 'on'=>'formCPF'),
			array('pispasep, doc_identidade, colab_banco_id, agencia, contacorrente','required', 'on'=>'inscricaoPublico'),
			array('tipo_cadastro, status_cadastro, colab_banco_id, tipo_vinculo', 'numerical', 'integerOnly' => true),
		);
	}

	/** @return array customized attribute labels (name => label) */
	public function attributeLabels() {

		return array(

			// Identificação
			'idColaborador'    => 'Nº da Ficha',
			'nome'             => 'Nome',
			'cpf'              => 'CPF' ,
			'data_nascimento'  => 'Data de Nascimento',
			'sexo'             => 'Sexo',
			'idescolaridade'   => 'Escolaridade',
			'pispasep'         => 'PIS/PASEP',
			'doc_identidade'   => 'Nº do RG',
			'orgao_identidade' => 'Órgão',

			// Endereço
			'logradouro'      => 'Rua/Av',	
			'numero_endereco' => 'Número',
			'bairro'          => 'Bairro',
			'idmunicipio'     => 'Município',
			'cep'             => 'CEP',
			'complemento'     => 'Complemento',

			// Contatos
			'celular' => 'Celular',
			'email'   => 'e-mail',
			
			// Informações Bancárias
			'colab_banco_id' => 'Banco',
			'agencia'        => 'Agência',
			'contacorrente'  => 'Nº da Conta',

			// Informações Cadastrais
			'tipo_vinculo'    => 'Tipo Vínculo',
			'status_cadastro' => 'Status Cadastro',
			'observacoes'     => 'Observações'
			
		);
	}

	/** Prepara alguns campos antes de serem validados. */
	protected function beforeValidate(){

		$this->cpf = preg_replace( '/[^0-9]/is', '', $this->cpf);

		return true;
	}

	/** Prepara os campos antes de serem salvos no BD. */
	protected function beforeSave(){

		if (!parent::beforeSave())
			return false;

		// Recuperando dados da sessão
		$session=Yii::app()->getSession();	
		$usuario = $session["usuario"];
		
		// Preparando algumas strings
		$this->cep      = preg_replace( '/[^0-9]/is', '', $this->cep);
		$this->cpf      = preg_replace( '/[^0-9]/is', '', $this->cpf);
		$this->pispasep = preg_replace( '/[^0-9]/is', '', $this->pispasep);

		// Cadastro externo
		$this->tipo_cadastro = 1;

		// Vincula no objeto 'colaborador' qual usuário o criou/atualizou
		if (isset($usuario)) {
			$this->idusuario = $usuario->idUsuario;
			$this->idColaborador_atualizacao = $usuario->idColaborador;
		}

		return true;
	}
	
	// Definição dos Status de Cadastro (no código mesmo pq não tem modelo)
	const STATUS_PRE_CADASTRO = 0;
	const STATUS_ATIVADO      = 1;
	const STATUS_REJEITADO    = 2;
	const STATUS_INCOMPLETO   = 3;

	public function getStatusOptions() {

		return array(

			self::STATUS_PRE_CADASTRO => 'Pré-Cadastro',
			self::STATUS_ATIVADO      => 'Ativado',
			self::STATUS_REJEITADO    => 'Bloqueado',
			self::STATUS_INCOMPLETO   => 'Incompleto'

		);

	}

	public function getStatusText() {

		$options = $this->statusOptions;
		return isset($options[$this->status_cadastro]) ? $options[$this->status_cadastro] : "desconhecido ({$this->status_cadastro})";

	}

	// Definição dos Sexos (apenas ajustando os nomes para as views)
	const SEXO_MASCULINO = 'M';
	const SEXO_FEMININO  = 'F';

	public function getSexoOptions() {

		return array(

			self::SEXO_MASCULINO => 'Masculino',
			self::SEXO_FEMININO  => 'Feminino'

		);

	}
	
	public function getSexoText() {

		$options = $this->sexoOptions;
		return isset($options[$this->sexo]) ? $options[$this->sexo] : "desconhecido ({$this->sexo})";

	}
	
	public function behaviors(){
		return array('datetimeI18NBehavior'=>array('class'=>'ext.DateTimeI18NBehavior'));
	}

	// Retorna o PIS com a sua devida máscara (apenas se o PIS tiver exatamente 11 dígitos)
	public function getPisFormatado() {
		return (strlen($this->pispasep) == 11) ? vsprintf("%s%s%s.%s%s%s%s%s.%s%s-%s", str_split($this->pispasep)) : $this->pispasep;
	}
	
	// Retorna o CPF com a sua devida máscara (apenas se o CPF tiver exatamente 11 dígitos)
	public function getCpfFormatado() {
		return (strlen($this->cpf) == 11) ? vsprintf("%s%s%s.%s%s%s.%s%s%s-%s%s", str_split($this->cpf)) : $this->cpf;
	}

	public function getNomeNormalizado() {

		if ($this->nome == null)
			return null;
		
		$array = explode(" ", strtolower($this->nome));
		$nova  = "";

		foreach ($array as $parte) {

			$nova . strtoupper($parte[0]) . substr($parte, 1) . " ";

		}

		return $nova;
	}

}