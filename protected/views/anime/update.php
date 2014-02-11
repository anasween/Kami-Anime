<?php
    /* @var $this AnimeController */
    /* @var $model Anime */
?>

<?php
$this->breadcrumbs=array(
	Yum::t('Anime')=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	Yum::t('Update'),
);
echo '<div class="well">';
echo BSHtml::pageHeader(Yum::t('Update'),Yum::t('Anime').' '.$model->id);
$this->renderPartial('_form', array('model'=>$model));
echo '</div>';