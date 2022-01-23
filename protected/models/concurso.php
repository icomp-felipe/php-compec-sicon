<?php

/** Modelagem do concurso.
 *  Atualizada em: 23/02/2022
 *  @author Felipe André - felipeandresouza@hotmail.com
 */
class concurso extends CActiveRecord {

	/** @return CActiveRecord the static model of the specified AR class. */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/** @return string the associated database table name */
	public function tableName() {
		return 'concurso';
	}

	/** @return array validation rules for model attributes. */
	public function rules() {
		return array(
			array('conc_nome', 'length', 'max' => 100),
			array('conc_ano', 'numerical', 'integerOnly' => true)
		);
	}

	/** @return array relational rules. */
	public function relations() {
		return array(
			'inscricaos' => array(self::HAS_MANY, 'inscricao', 'idconcurso'),
			'mapas' => array(self::HAS_MANY, 'config_concurso', 'mapa_concurso_id')
		);
	}

	 /** @return array customized attribute labels (name => label) */
	public function attributeLabels() {
		return array(
			'conc_nome' => 'Concurso'
		);
	}
	
}