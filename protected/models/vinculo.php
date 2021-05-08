<?php

class Vinculo extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'vinculo':
	 * @var integer $idVinculo
	 * @var integer $idinstituicao
	 * @var integer $idColaborador
	 * @var string $matricula
	 * @var string $ativa
	 * @var string $setor
	 * @var string $cargo
	 * @var integer $tipo_vinculo
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
		return 'vinculo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('matricula','length','max'=>10),
			array('ativa','length','max'=>1),
			array('setor','length','max'=>20),
			array('cargo','length','max'=>20),
			array('tipo_vinculo', 'numerical', 'integerOnly'=>true),
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
			'idColaborador0' => array(self::BELONGS_TO, 'colaborador', 'idColaborador'),
			'idinstituicao0' => array(self::BELONGS_TO, 'instituicao', 'idinstituicao'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idVinculo' => 'Id Vinculo',
			'idinstituicao' => 'Idinstituicao',
			'idColaborador' => 'Id Colaborador',
			'matricula' => 'Matricula',
			'ativa' => 'Ativa',
			'setor' => 'Setor',
			'cargo' => 'Cargo',
			'tipo_vinculo' => 'Tipo Vinculo',
		);
	}
}