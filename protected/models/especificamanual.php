<?php

class Especificamanual extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'especificamanual':
	 * @var integer $idespecificamanual
	 * @var integer $idconcurso
	 * @var string $titulo
	 * @var string $path
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
		return 'especificamanual';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('titulo','length','max'=>50),
			array('path','length','max'=>100),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idespecificamanual' => 'Idespecificamanual',
			'idconcurso' => 'Idconcurso',
			'titulo' => 'Titulo',
			'path' => 'Path',
		);
	}
}