<?php
class RegistrationController extends CController
{
	public $layout = '//layouts/main';

	public function filters()
	{
		return array(
				'accessControl',
			);
	}
	public function init(){
		Yii::app()->theme = 'customized';
		parent::init();

	}
	public function accessRules()
	{
		return array(
				array(
					'allow',
					'actions'=>array('register'),
					'users'=>array('?'),
					),
			);
	}
	public function actionRegister()
	{

		$model = new Registration;
		//$this->performAjaxValidation($model);
		if($model->validate()){
		if(isset($_POST['Registration']))
		{
			//$model->attributes=$_POST['Registration'];
			$model->firstName = $_POST['firstName'];
			$model->lastName = $_POST['lastName'];
			$model->email = $_POST['email'];
			$model->emailConfirm = $_POST['emailConfirm'];
			//$model->website = $_POST['website'];
			$model->location = $_POST['location'];
			$model->password = $_POST['password'];
			$model->passwordConfirm = $_POST['passwordConfirm'];
			$model->birthday = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
			if($model->save())
				$this->redirect(Yii::app()->homeUrl);
		}}
		//$this->renderPartial('/site/pages/register', array('model'=>$model));
		$this->redirect(Yii::app()->homeUrl.'#register');
	}
	public function loadModel($id)
	{
		$model=Registration::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='register-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
?>