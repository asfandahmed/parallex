<?php
/* @var $this ContentController */
/* @var $data Content */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Id), array('view', 'id'=>$data->Id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ContentType')); ?>:</b>
	<?php echo CHtml::encode($data->ContentType); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ProgramName')); ?>:</b>
	<?php echo CHtml::encode($data->ProgramName); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Timing')); ?>:</b>
	<?php echo CHtml::encode($data->Timing); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Description')); ?>:</b>
	<?php echo CHtml::encode($data->Description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Url')); ?>:</b>
	<?php echo CHtml::encode($data->Url); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DateAndTime')); ?>:</b>
	<?php echo CHtml::encode($data->DateAndTime); ?>
	<br />


</div>