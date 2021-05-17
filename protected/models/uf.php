<?php

/** Modelagem da unidade de federação (UF).
 *  Criada em: 16/05/2021
 *  @author Felipe André - felipeandresouza@hotmail.com
 */
class uf extends CActiveRecord {

	/** @return CActiveRecord the static model of the specified AR class. */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/** @return string the associated database table name. */
	public function tableName()	{
		return 'uf';
	}

	/** @return array validation rules for model attributes. */
	public function rules()	{
		return array(

			array('uf_sigla','length','max' =>  2),
			array('uf_nome' ,'length','max' => 20)

		);
	}

	/** @return array relational rules. */
	public function relations()	{
		return array(

			'colaboradores' => array(self::HAS_MANY, 'colaborador', 'iduf_identidade'),
			'instituicoes'  => array(self::HAS_MANY, 'instituicao', 'inst_uf_id')

		);
	}

	/** @return array customized attribute labels (name => label) */
	public function attributeLabels() {
		return array(

			'uf_id_pk' => 'ID',
			'uf_sigla' => 'Sigla',
			'uf_nome'  => 'Nome'

		);
	}
	
}