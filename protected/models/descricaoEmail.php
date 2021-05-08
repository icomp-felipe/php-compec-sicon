<?php

class DescricaoEmail extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'descricao_email':
	 * @var integer $iddescricao_email
	 * @var string $texto
	 * @var string $titulo
	 * @var integer $eventogerador
	 * @var integer $idconcurso
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
		return 'descricao_email';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('titulo','length','max'=>100),
			array('eventogerador', 'numerical', 'integerOnly'=>true),
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
			'idconcurso0' => array(self::BELONGS_TO, 'Concurso', 'idconcurso'),
			'envio_emails' => array(self::HAS_MANY, 'EnvioEmail', 'iddescricao_email'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'iddescricao_email' => 'Iddescricao Email',
			'texto' => 'Texto',
			'titulo' => 'Titulo',
			'eventogerador' => 'Eventogerador',
			'idconcurso' => 'Idconcurso',
		);
	}
}