<?php

/** Modelagem do usuário.
 *  Criada em: 16/05/2021
 *  @author Felipe André - felipeandresouza@hotmail.com
 */
class usuario extends CActiveRecord {

	/** @return CActiveRecord the static model of the specified AR class. */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/** @return string the associated database table name. */
	public function tableName() {
		return 'usuario';
	}

	/** @return array validation rules for model attributes. */
	public function rules()	{
		return array(

			array('user_login','length','max' => 20),
			array('user_senha','length','max' => 41)

		);
	}

	/** @return array relational rules. */
	public function relations()	{
		
		return array(
			'colaborador' => array(self::BELONGS_TO, 'colaborador', 'user_colab_id')
		);

	}

	/** @return array customized attribute labels (name => label) */
	public function attributeLabels() {
		return array(

			'user_id_pk'       => 'ID de Usuário',
			'user_login'       => 'Login',
			'user_senha'       => 'Senha',
			'user_colab_id'    => 'Colaborador',
			'user_create_date' => 'Data de Criação',
			'user_update_date' => 'Data de Atualização'

		);
	}
	
}