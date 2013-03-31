<?php
class Registration extends CActiveRecord{

	public $id;
	public $firstName;
	public $lastName;
	public $email;
	public $emailConfirm;
	public $website;
	public $location;
	public $password;
	public $passwordConfirm;
	public $birthday;
	public $lastLogin;
	public $registerDate;
	public $type;

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function tableName()
	{
		return 'user';
	}
	public function rules()
	{
		return array(
				//array('firstName, lastName, email, location, password, birthday', 'required'),
				array('type', 'numerical', 'integerOnly'=>true),
				//array('birthday', 'date'),
				array('passwordConfirm', 'compare', 'compareAttribute'=>'password', 'on'=>'insert'),
				array('emailConfirm', 'compare', 'compareAttribute'=>'email', 'on'=>'insert'),
				array('registerDate', 'default', 'value'=> new CDbExpression('NOW()'), 'setOnEmpty'=>false, 'on'=>'insert'),
				array('lastLogin', 'default', 'value'=> new CDbExpression('NOW()'), 'setOnEmpty'=>false, 'on'=>'insert'),
				array('firstName, lastName, email, website, location, password', 'length', 'max'=>255),
			);
	}

	public function attributesLabel()
	{
		return array(
				'id' => 'ID',
				'firstName' => 'First Name',
				'lastName' => 'Last Name',
				'email' => 'Email',
				'emailConfirm' => 'Confirm Email',
				'website' => 'Website',
				'location' => 'Location',
				'password' => 'Password',
				'passwordConfirm' => 'Confirm Password',
				'birthday' => 'Birthday',
				//'lastLogin' => 'Last Login',
				//'registerDate' => 'Register Date',
				//'type' => 'Type',
			);
	}
}
	
?>