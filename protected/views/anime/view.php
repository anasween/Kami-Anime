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

if (Yii::app()->user->can('urls','admin')) {
    $this->widget('bootstrap.widgets.BsModal', array(
        'id' => 'addUrlModal',
        'header' => Yum::t('Add url'),
        'content' => $this->renderPartial('//anime/_urlForm', array('model' => new Urls), true, true),
    ));
}