<?php

class configConcurso extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'config_concurso':
	 * @var integer $idFuncao
	 * @var integer $idetapa
	 * @var integer $idinstituicao
	 * @var integer $vagasofertadasnormal
	 * @var integer $vagasocupadasnormal
	 * @var double $remuneracaodia
	 * @var integer $quantidadesalas
	 * @var integer $idconfig_concurso
	 * @var integer $vagasofertadasadicional
	 * @var integer $vagasocupadasadicional
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
		return 'config_concurso';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('remuneracaodia', 'required'),
			array('vagasofertadasnormal, vagasocupadasnormal, quantidadesalas, vagasofertadasadicional, vagasocupadasadicional', 'numerical', 'integerOnly'=>true),
			array('remuneracaodia', 'numerical'),
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
			'idinstituicao0' => array(self::BELONGS_TO, 'instituicao', 'idinstituicao'),
			'concurso' => array(self::BELONGS_TO, 'concurso', 'mapa_concurso_id'),
			'idFuncao0' => array(self::BELONGS_TO, 'funcao', 'idFuncao'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idFuncao' => 'Id Funcao',
			'mapa_concurso_id' => 'Concurso',
			'idinstituicao' => 'Idinstituicao',
			'vagasofertadasnormal' => 'Vagasofertadasnormal',
			'vagasocupadasnormal' => 'Vagasocupadasnormal',
			'remuneracaodia' => 'Remuneracaodia',
			'quantidadesalas' => 'Quantidadesalas',
			'idconfig_concurso' => 'Idconfig Concurso',
			'vagasofertadasadicional' => 'Vagasofertadasadicional',
			'vagasocupadasadicional' => 'Vagasocupadasadicional',
		);
	}
}