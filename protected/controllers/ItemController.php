<?php
class ItemController extends CController
{
	public function actionCreate()
	{
		$model = new Item;
		if(isset($_POST['Item']))
		{
			$model->attributes=$_POST["Item"];
			$model->image=CUploadedFile::getInstance($model, 'image');
			if($model->save())
			{
				$model->image->saveAs(Yii::app()->request->baseUrl.'/images/'.$model->image);
			}
		}
		$this->render('create', array('model'=>$model));
	}
}
?>