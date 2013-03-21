<?php

/**
 * This is the model class for table "comment".
 *
 * The followings are the available columns in table 'comment':
 * @property integer $Id
 * @property integer $ContentId
 * @property string $Name
 * @property string $Email
 * @property string $Website
 * @property string $Comment
 * @property string $DateAndTime
 *
 * The followings are the available model relations:
 * @property Content $content
 */
class Comment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comment the static model class
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
		return 'comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ContentId, Name, Email, Comment', 'required'),
			array('ContentId', 'numerical', 'integerOnly'=>true),
			array('Name, Website', 'length', 'max'=>50),
			array('Email', 'length', 'max'=>60),
			array('DateAndTime', 'default', 'value'=>new CDbExpression('NOW()'), 'setOnEmpty'=>false, 'on'=>'insert'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('Id, ContentId, Name, Email, Website, Comment, DateAndTime', 'safe', 'on'=>'search'),
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
			'content' => array(self::BELONGS_TO, 'Content', 'ContentId'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'Id' => 'ID',
			'ContentId' => 'Content',
			'Name' => 'Name',
			'Email' => 'Email',
			'Website' => 'Website',
			'Comment' => 'Comment',
			'DateAndTime' => 'Date And Time',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('Id',$this->Id);
		$criteria->compare('ContentId',$this->ContentId);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('Email',$this->Email,true);
		$criteria->compare('Website',$this->Website,true);
		$criteria->compare('Comment',$this->Comment,true);
		$criteria->compare('DateAndTime',$this->DateAndTime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}