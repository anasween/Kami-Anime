<?php
/* @var $this CommentsController */
/* @var $model Comments */
?>

<?php
$this->breadcrumbs=array(
	Yum::t('Comments')=>array('index'),
	$model->id,
);
?>

<?php echo BSHtml::pageHeader(Yum::t('View'),Yum::t('Comments').' '.$model->id) ?>

<?php $this->widget('zii.widgets.CDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
        'id',
        'autor_id',
        'text',
        'createtime',
        'news_id',
    ),
));