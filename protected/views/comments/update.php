<?php
    /* @var $this CommentsController */
    /* @var $model Comments */
?>

<?php
$this->breadcrumbs=array(
	Yum::t('Comments')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yum::t('Update'),
);
?>
<?php echo BSHtml::pageHeader(Yum::t('Update'),Yum::t('Comments').' '.$model->id) ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>