<?php
    /* @var $this CommentsController */
    /* @var $model Comments */
?>

<?php
$this->breadcrumbs=array(
	Yum::t('Comments')=>array('index'),
	Yum::t('Create'),
);
?>
<?php echo BSHtml::pageHeader(Yum::t('Create'),Yum::t('Comments')) ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>