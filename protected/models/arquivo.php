<?php

/** Modelagem dos caminhos de arquivo.
 *  Criada em: 02/10/2023
 *  @author Felipe André - felipeandresouza@hotmail.com
 */
class arquivo extends CActiveRecord {

    /** @return CActiveRecord the static model of the specified AR class. */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/** @return string the associated database table name */
	public function tableName()	{
		return 'arquivo';
	}

    /** @return array relational rules. */
	public function relations()	{
		return array(
			'concurso' => array(self::BELONGS_TO, 'concurso', 'arq_conc_id')
		);
	}

    /** @return array validation rules for model attributes. */
	public function rules()	{

		return array(
			array('arq_tipo', 'numerical', 'integerOnly' => true)
		);
	}

    /** @return array customized attribute labels (name => label) */
	public function attributeLabels() {

		return array(

            'arq_tipo'    => 'Tipo de Arquivo',
			'arq_caminho' => 'Caminho do Arquivo',
			'arq_nome'    => 'Nome do Arquivo'
			
		);
	}

}