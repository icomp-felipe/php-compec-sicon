<?php

/** Modelagem das categorias de colaborador.
 *  Criada em: 17/05/2021
 *  @author Felipe André - felipeandresouza@hotmail.com
 */
class categoria extends CActiveRecord {

	/** @return CActiveRecord the static model of the specified AR class. */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/** @return string the associated database table name */
	public function tableName()	{
		return 'categoria';
	}

	/** @return array validation rules for model attributes. */
	public function rules()	{
		return array(
			array('categ_nome','length','max' => 30)
		);
	}

	/** @return array relational rules. */
	public function relations()	{
		return array(
			'colaboradores' => array(self::HAS_MANY, 'colaborador', 'colab_categoria_id')
		);
	}

	/** @return array customized attribute labels (name => label) */
	public function attributeLabels() {
		return array(

			'categ_id_pk' => 'ID',
			'categ_nome'  => 'Categoria'

		);
	}
	
}