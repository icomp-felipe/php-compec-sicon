<?php

class SqlKeys extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'sql_keys':
	 * @var string $key
	 * @var string $value
	 * @var integer $timestamp
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
		return 'sql_keys';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('key','length','max'=>15),
			array('value','length','max'=>15),
			array('key, value, timestamp', 'required'),
			array('timestamp', 'numerical', 'integerOnly'=>true),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'key' => 'Key',
			'value' => 'Value',
			'timestamp' => 'Timestamp',
		);
	}
}