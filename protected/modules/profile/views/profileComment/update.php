<?php
$this->breadcrumbs=array(
	Yum::t('Profile Comments')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yum::t('Update'),
);
?>

<h1> <?php echo Yum::t('Update ProfileComment') . ' ' . $model->id; ?> </h1>
<?php
$this->renderPartial('_form', array('model'=>$model));