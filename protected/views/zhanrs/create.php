<?php
    /* @var $this ZhanrsController */
    /* @var $model Zhanrs */
?>

<?php
$this->breadcrumbs=array(
	Yum::t('Zhanrs')=>array('index'),
	Yum::t('Create'),
);?>
<?php echo BSHtml::pageHeader(Yum::t('Create'),Yum::t('Zhanrs')) ?>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>