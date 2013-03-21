<?php
/* @var $this ContentTypeController */
/* @var $model ContentType */

$this->breadcrumbs=array(
	'Content Types'=>array('index'),
	$model->Id,
);

$this->menu=array(
	array('label'=>'List ContentType', 'url'=>array('index')),
	array('label'=>'Create ContentType', 'url'=>array('create')),
	array('label'=>'Update ContentType', 'url'=>array('update', 'id'=>$model->Id)),
	array('label'=>'Delete ContentType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ContentType', 'url'=>array('admin')),
);
?>

<h1>View ContentType #<?php echo $model->Id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Id',
		'Type',
	),
)); ?>
