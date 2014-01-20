<?php
/* @var $this ZhanrsController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	Yum::t('Zhanrs'),
);
?>
<?php echo BSHtml::pageHeader(Yum::t('Zhanrs')) ?>
<?php $this->widget('bootstrap.widgets.BsListView',array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
)); ?>