<?php

class concurso extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'concurso':
	 * @var integer $idconcurso
	 * @var integer $idinstituicaorealizadora
	 * @var integer $idinstituicaogestora
	 * @var string $descricao
	 * @var integer $ano
	 * @var integer $quantidade_etapas
	 * @var integer $etapa_atual
	 * @var integer $situacao
	 * @var string $datainicioinscricao
	 * @var string $datafiminscricao
	 * @var integer $clonado
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
		return 'concurso';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('descricao','length','max'=>50),
			array('descricao, ano, quantidade_etapas', 'required'),
			array('ano, quantidade_etapas, etapa_atual, situacao, clonado', 'numerical', 'integerOnly'=>true),
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
			'idinstituicaogestora0' => array(self::BELONGS_TO, 'instituicao', 'idinstituicaogestora'),
			'instituicaorealizadora' => array(self::BELONGS_TO, 'instituicao', 'idinstituicaorealizadora'),
			'descricao_emails' => array(self::HAS_MANY, 'descricaoEmail', 'idconcurso'),
			'especificamanuals' => array(self::HAS_MANY, 'especificamanual', 'idconcurso'),
			'inscricaos' => array(self::HAS_MANY, 'inscricao', 'idconcurso'),
			'vinculopreferencials' => array(self::HAS_MANY, 'vinculopreferencial', 'idconcurso'),
			'mapas' => array(self::HAS_MANY, 'config_concurso', 'mapa_concurso_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idconcurso' => 'Idconcurso',
			'idinstituicaorealizadora' => 'Idinstituicaorealizadora',
			'idinstituicaogestora' => 'Idinstituicaogestora',
			'descricao' => 'Descricao',
			'ano' => 'Ano',
			'quantidade_etapas' => 'Quantidade Etapas',
			'etapa_atual' => 'Etapa Atual',
			'situacao' => 'Situacao',
			'datainicioinscricao' => 'Datainicioinscricao',
			'datafiminscricao' => 'Datafiminscricao',
			'clonado' => 'Clonado',
		);
	}
}