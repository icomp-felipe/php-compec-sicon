<?php

class SqlIden extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'sql_iden':
	 * @var integer $ID
	 * @var string $UniqueID
	 * @var string $Server
	 * @var string $Password
	 * @var string $User
	 * @var string $Database
	 * @var string $Timestamp
	 * @var integer $Status
	 * @var string $Data
	 * @var integer $Cookies
	 * @var integer $IpLock
	 * @var string $Ip
	 * @var integer $NoTimeout
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
		return 'sql_iden';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('UniqueID','length','max'=>24),
			array('Server','length','max'=>60),
			array('User','length','max'=>60),
			array('Timestamp','length','max'=>11),
			array('Ip','length','max'=>15),
			array('UniqueID, Server, Password, User, Database, Timestamp, Data, Ip', 'required'),
			array('Status, Cookies, IpLock, NoTimeout', 'numerical', 'integerOnly'=>true),
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
			'UniqueID' => 'Unique',
			'Server' => 'Server',
			'Password' => 'Password',
			'User' => 'User',
			'Database' => 'Database',
			'Timestamp' => 'Timestamp',
			'Status' => 'Status',
			'Data' => 'Data',
			'Cookies' => 'Cookies',
			'IpLock' => 'Ip Lock',
			'Ip' => 'Ip',
			'NoTimeout' => 'No Timeout',
		);
	}
}