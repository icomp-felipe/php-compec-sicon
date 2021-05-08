<?php

class EnvioEmail extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'envio_email':
	 * @var integer $idenvio_email
	 * @var integer $idColaborador
	 * @var integer $iddescricao_email
	 * @var string $datahoraenvio
	 * @var string $observacoesautomaticas
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
		return 'envio_email';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
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
			'iddescricao_email0' => array(self::BELONGS_TO, 'DescricaoEmail', 'iddescricao_email'),
			'idColaborador0' => array(self::BELONGS_TO, 'colaborador', 'idColaborador'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idenvio_email' => 'Idenvio Email',
			'idColaborador' => 'Id Colaborador',
			'iddescricao_email' => 'Iddescricao Email',
			'datahoraenvio' => 'Datahoraenvio',
			'observacoesautomaticas' => 'Observacoesautomaticas',
		);
	}
}