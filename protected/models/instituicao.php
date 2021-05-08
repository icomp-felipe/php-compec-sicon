<?php

class instituicao extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'instituicao':
	 * @var integer $idinstituicao
	 * @var integer $idResponsavel
	 * @var integer $idgrupoinstituicao
	 * @var integer $idbairro
	 * @var string $nome
	 * @var string $logradouro
	 * @var string $numero_endereco
	 * @var string $cep
	 * @var string $ddd
	 * @var string $telefone
	 * @var string $fax
	 * @var string $email
	 * @var string $ativa
	 * @var integer $tipo
	 * @var integer $cod_interno
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
		return 'instituicao';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('nome','length','max'=>100),
			array('logradouro','length','max'=>50),
			array('numero_endereco','length','max'=>5),
			array('cep','length','max'=>8),
			array('ddd','length','max'=>2),
			array('telefone','length','max'=>8),
			array('fax','length','max'=>8),
			array('email','length','max'=>60),
			array('ativa','length','max'=>1),
			array('tipo, cod_interno', 'numerical', 'integerOnly'=>true),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'concursos' => array(self::HAS_MANY, 'concurso', 'idinstituicaorealizadora'),
			'config_concursos' => array(self::HAS_MANY, 'configConcurso', 'idinstituicao'),
			'inscricaos' => array(self::HAS_MANY, 'inscricao', 'idinstituicaoopcao2'),
			'bairro' => array(self::BELONGS_TO, 'bairro', 'idbairro'),
			'grupoinstituicao' => array(self::BELONGS_TO, 'grupoinstituicao', 'idgrupoinstituicao', 'alias'=>'grupoinstituicao'),
			'idResponsavel0' => array(self::BELONGS_TO, 'colaborador', 'idResponsavel'),
			'selecaos' => array(self::HAS_MANY, 'selecao', 'idinstituicao'),
			'vinculos' => array(self::HAS_MANY, 'vinculo', 'idinstituicao'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idinstituicao' => 'Idinstituicao',
			'idResponsavel' => 'Id Responsavel',
			'idgrupoinstituicao' => 'Idgrupoinstituicao',
			'idbairro' => 'Idbairro',
			'nome' => 'Nome',
			'logradouro' => 'Logradouro',
			'numero_endereco' => 'Numero Endereco',
			'cep' => 'Cep',
			'ddd' => 'Ddd',
			'telefone' => 'Telefone',
			'fax' => 'Fax',
			'email' => 'Email',
			'ativa' => 'Ativa',
			'tipo' => 'Tipo',
			'cod_interno' => 'Cod Interno',
		);
	}
	
	public function getEndereco()
	{
	
		$endereco = null;
		$endereco = $this->logradouro;
		$endereco = $endereco . (isset($endereco) && ($endereco!='') && ($this->numero_endereco!='')?', ':'').$this->numero_endereco;
		$endereco = $endereco . (isset($endereco) && ($endereco!='') && isset($this->bairro)?', ':'').$this->bairro->nome;
		return $endereco;
	}

	public function getEtapasEmQueParticipou($id=null)
	{
	
		$data = array(
				'order'=>'idetapa desc',
				'condition'=>'idinstituicao = '.$id);

		$criteria=new CDbCriteria($data);
		$criteria->distinct = true;
		$criteria->select = array('idetapa');

		return configConcurso::model()->findAll($criteria);
	}	
	

	public function getInstituicao($id=null)
	{
	
		if($id==null)
			$id = $this->idinstituicao;
			
		return $this->model()->findbyPk($id);
	}	
	
	
	
}