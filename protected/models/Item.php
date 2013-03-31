<?php
class Item extends CActiveRecord
{
	
	public function rules()
	{
		return array(
			array('image', 'file', 'types'=>'jpg, gif, png'),
			array('image', 'file','types'=>'jpg, gif, png', 'allowEmpty'=>true, 'on'=>'update'),
			array('title, image', 'length', 'max'=>255, 'on'=>'insert,update'),
			);
	}
}
?>