<?php

class DiaEtapaSelecaoFaltas extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'dia_etapa_selecao_faltas':
	 * @var integer $iddia_etapa_selecao
	 * @var integer $iddia_etapa
	 * @var integer $idselecao
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
		return 'dia_etapa_selecao_faltas';
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
			'idselecao0' => array(self::BELONGS_TO, 'Selecao', 'idselecao'),
			'iddia_etapa0' => array(self::BELONGS_TO, 'DiaEtapa', 'iddia_etapa'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'iddia_etapa_selecao' => 'Iddia Etapa Selecao',
			'iddia_etapa' => 'Iddia Etapa',
			'idselecao' => 'Idselecao',
		);
	}
}