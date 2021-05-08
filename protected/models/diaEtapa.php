<?php

class DiaEtapa extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'dia_etapa':
	 * @var integer $iddia_etapa
	 * @var integer $idetapa
	 * @var string $datarealizacao
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
		return 'dia_etapa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('idetapa', 'required'),
			array('idetapa', 'numerical', 'integerOnly'=>true),
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
			'dia_etapa_selecao_faltases' => array(self::HAS_MANY, 'DiaEtapaSelecaoFaltas', 'iddia_etapa'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'iddia_etapa' => 'Iddia Etapa',
			'idetapa' => 'Idetapa',
			'datarealizacao' => 'Datarealizacao',
		);
	}
}