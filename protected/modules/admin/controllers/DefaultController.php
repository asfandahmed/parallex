<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}
	/* for changing theme in admin panel by asfand*/
	public function init()
	{
		Yii::app()->theme = 'classic';
		Yii::app()->name = 'Administration panel';
	}
}