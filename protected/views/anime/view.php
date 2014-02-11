<?php
/* @var $this AnimeController */
/* @var $model Anime */
?>

<?php
$this->breadcrumbs=array(
	Yum::t('Anime')=>array('index'),
	$model->id,
);

$this->renderPartial('_view', array('data'=>$model));