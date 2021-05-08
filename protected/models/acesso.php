<?php

class Acesso extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'acesso':
	 * @var integer $idacesso
	 * @var integer $idgrupo
	 * @var integer $idfuncionalidade
	 * @var string $consulta
	 * @var string $alteracao
	 * @var string $exclusao
	 * @var string $inclusao
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
		return 'acesso';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('consulta','length','max'=>1),
			array('alteracao','length','max'=>1),
			array('exclusao','length','max'=>1),
			array('inclusao','length','max'=>1),
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
			'idfuncionalidade0' => array(self::BELONGS_TO, 'Funcionalidades', 'idfuncionalidade'),
			'idgrupo0' => array(self::BELONGS_TO, 'Grupo', 'idgrupo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idacesso' => 'Idacesso',
			'idgrupo' => 'Idgrupo',
			'idfuncionalidade' => 'Idfuncionalidade',
			'consulta' => 'Consulta',
			'alteracao' => 'Alteracao',
			'exclusao' => 'Exclusao',
			'inclusao' => 'Inclusao',
		);
	}
}