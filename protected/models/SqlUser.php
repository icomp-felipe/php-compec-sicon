<?php

class SqlUser extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'sql_user':
	 * @var integer $ID
	 * @var integer $Admin
	 * @var integer $toUser
	 * @var string $Name
	 * @var string $Password
	 * @var string $Server
	 * @var string $Database
	 * @var string $Tables
	 * @var string $Admin_User
	 * @var string $Admin_Pass
	 * @var string $UnID
	 * @var string $EMail
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
		return 'sql_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('UnID','length','max'=>20),
			array('EMail', 'required'),
			array('Admin, toUser', 'numerical', 'integerOnly'=>true),
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
			'ID' => 'Id',
			'Admin' => 'Admin',
			'toUser' => 'To User',
			'Name' => 'Name',
			'Password' => 'Password',
			'Server' => 'Server',
			'Database' => 'Database',
			'Tables' => 'Tables',
			'Admin_User' => 'Admin User',
			'Admin_Pass' => 'Admin Pass',
			'UnID' => 'Un',
			'EMail' => 'Email',
		);
	}
}