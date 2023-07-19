<?php

/** Modelagem do mapa.
 *  Criada em: 19/07/2023
 *  @author Felipe André - felipeandresouza@hotmail.com
 */
class mapa extends CActiveRecord {

    /** @return CActiveRecord the static model of the specified AR class. */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/** @return string the associated database table name */
	public function tableName()	{
		return 'mapa';
	}

    /** @return array relational rules. */
	public function relations()	{
		return array(
			//'colaborador' => array(self::HAS_MANY, 'colaborador', 'colab_banco_id')
			'funcaoConcurso' => array(self::BELONGS_TO, 'funcao_concurso', 'mapa_fconc_id'),
			'instituicao' => array(self::BELONGS_TO, 'instituicao', 'mapa_inst_id')
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