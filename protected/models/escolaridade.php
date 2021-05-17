<?php

/** Modelagem dos níveis de escolaridade do colaborador.
 *  Criada em: 17/05/2021
 *  @author Felipe André - felipeandresouza@hotmail.com
 */
class escolaridade extends CActiveRecord {
	
	/** @return CActiveRecord the static model of the specified AR class. */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/** @return string the associated database table name */
	public function tableName()	{
		return 'escolaridade';
	}

	/** @return array validation rules for model attributes. */
	public function rules()	{
		return array(

			array('esco_descricao','length','max' => 40),
			array('esco_nivel'    ,'required'),
			array('esco_nivel'    ,'numerical', 'integerOnly' => true)

		);
	}

	/** @return array relational rules. */
	public function relations()	{
		
		return array(

			'colaboradores' => array(self::HAS_MANY, 'colaborador', 'colab_escolaridade_id')

		);
	}

	/** @return array customized attribute labels (name => label) */
	public function attributeLabels() {
		return array(

			'esco_id_pk'     => 'ID',
			'esco_descricao' => 'Descrição',
			'esco_nivel'     => 'Nivel'

		);
	}
}