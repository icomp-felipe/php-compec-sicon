<?php

/** Modelagem da unidade do município.
 *  Criada em: 16/05/2021
 *  @author Felipe André - felipeandresouza@hotmail.com
 */
class municipio extends CActiveRecord {
	
	/** @return CActiveRecord the static model of the specified AR class. */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/** @return string the associated database table name. */
	public function tableName()	{
		return 'municipio';
	}

	/** @return array validation rules for model attributes. */
	public function rules()	{
		return array(
			array('muni_nome','length','max' => 80)
		);
	}

	/** @return array relational rules. */
	public function relations() {

		return array(
			'colaboradores'=> array(self::HAS_MANY, 'colaborador', 'idmunicipio'),
			'instituicoes' => array(self::HAS_MANY, 'instituicao', 'inst_municipio_id')
		);

	}

	/** @return array customized attribute labels (name => label) */
	public function attributeLabels() {
		return array(

			'muni_id_pk' => 'ID',
			'muni_nome'  => 'Nome'

		);
	}
	
}