<?php
$this->breadcrumbs=array(
	Yum::t('Friendships')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yum::t('Update'),
);
?>
<?php BSHtml::pageHeader(Yum::t('Update Friendship') . ' ' . $model->id) ?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>