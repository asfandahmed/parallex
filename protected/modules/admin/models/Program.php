<?php

/**
 * This is the model class for table "program".
 *
 * The followings are the available columns in table 'program':
 * @property integer $id
 * @property string $name
 * @property string $url
 * @property string $description
 * @property integer $imageId
 * @property string $timing
 * @property integer $status
 * @property string $type
 * @property string $upVotes
 * @property string $downVotes
 */
class Program extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Program the static model class
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
		return 'program';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, url, description, imageId, timing, type', 'required'),
			array('imageId, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('type, upVotes, downVotes', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, url, description, imageId, timing, status, type, upVotes, downVotes', 'safe', 'on'=>'search'),
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
			'id' => 'ID',
			'name' => 'Name',
			'url' => 'Url',
			'description' => 'Description',
			'imageId' => 'Image',
			'timing' => 'Timing',
			'status' => 'Status',
			'type' => 'Type',
			'upVotes' => 'Up Votes',
			'downVotes' => 'Down Votes',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('imageId',$this->imageId);
		$criteria->compare('timing',$this->timing,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('upVotes',$this->upVotes,true);
		$criteria->compare('downVotes',$this->downVotes,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}