<?php
/* @var $this CommentsController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	Yum::t('Comments'),
);
?>
<?php echo BSHtml::pageHeader(Yum::t('Comments')) ?>
<?php $this->widget('bootstrap.widgets.BsListView',array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
)); ?>