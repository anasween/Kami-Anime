<?php
/* @var $this AnimeController */
/* @var $model Anime */
?>

<?php
$this->breadcrumbs=array(
	Yum::t('Anime')=>array('index'),
	$model->name_ru,
);

$this->renderPartial('_view', array('data'=>$model));