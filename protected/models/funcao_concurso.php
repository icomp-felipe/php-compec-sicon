<?php

/** Modelagem da função-concurso.
 *  Criada em: 19/07/2023
 *  @author Felipe André - felipeandresouza@hotmail.com
 */
class funcao_concurso extends CActiveRecord {

    /** @return CActiveRecord the static model of the specified AR class. */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/** @return string the associated database table name */
	public function tableName()	{
		return 'funcao_concurso';
	}

    /** @return array relational rules. */
	public function relations()	{
		return array(
			'concurso' => array(self::BELONGS_TO, 'concurso', 'fconc_conc_id'),
			'funcao' => array(self::BELONGS_TO, 'funcao', 'fconc_func_id')
		);
	}

    /** @return array validation rules for model attributes. */
	public function rules()	{

		return array(
			//array('banco_codigo', 'numerical', 'integerOnly' => true)
		);
	}

    /** @return array customized attribute labels (name => label) */
	public function attributeLabels() {

		return array(

            //'banco_nome'      => 'Banco'
			
		);
	}

}