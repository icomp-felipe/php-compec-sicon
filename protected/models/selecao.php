<?php

class Selecao extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'selecao':
	 * @var integer $idselecao
	 * @var integer $idinscricao
	 * @var string $observacoes
	 * @var integer $conceito
	 * @var integer $idinstituicao
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
		return 'selecao';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('conceito', 'numerical', 'integerOnly'=>true),
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
			'dia_etapa_selecao_faltases' => array(self::HAS_MANY, 'DiaEtapaSelecaoFaltas', 'idselecao'),
			'idinscricao0' => array(self::BELONGS_TO, 'Inscricao', 'idinscricao'),
			'idinstituicao0' => array(self::BELONGS_TO, 'Instituicao', 'idinstituicao'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idselecao' => 'Idselecao',
			'idinscricao' => 'Idinscricao',
			'observacoes' => 'Observacoes',
			'conceito' => 'Conceito',
			'idinstituicao' => 'Idinstituicao',
		);
	}
}