<?php
/* @var $this ContentController */
/* @var $model Content */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'content-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ContentType'); ?>
		<?php echo $form->dropDownList($model,'ContentType',  CHtml::listData(ContentType::model()->findAll(), 'Id', 'Type')); ?>
		<?php echo $form->error($model,'ContentType'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ProgramName'); ?>
		<?php echo $form->textField($model,'ProgramName',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'ProgramName'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Timing'); ?>
		<?php echo $form->textField($model,'Timing'); ?>
		<?php echo $form->error($model,'Timing'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Description'); ?>
		<?php echo $form->textArea($model,'Description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'Description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Url'); ?>
		<?php echo $form->textArea($model,'Url',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'Url'); ?>
	</div>

	<!--<div class="row">
		<?php echo $form->labelEx($model,'DateAndTime'); ?>
		<?php echo $form->textField($model,'DateAndTime'); ?>
		<?php echo $form->error($model,'DateAndTime'); ?>
	</div>-->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->