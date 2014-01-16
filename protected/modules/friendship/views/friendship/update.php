<?php
$this->breadcrumbs=array(
	Yum::t('Friendships')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yum::t('Update'),
);
?>

<h1><?php echo Yum::t('Update Friendship') . ' ' . $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>