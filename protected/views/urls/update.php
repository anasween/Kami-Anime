<?php
/* @var $this UrlsController */
/* @var $model Urls */
?>

<?php
$this->breadcrumbs=array(
	Yum::t('Urls')=>array('index'),
	$model->id=>array('admin'),
	Yum::t('Update'),
);
echo '<div class="well">';
echo BSHtml::pageHeader(Yum::t('Update'),Yum::t('Urls').' '.$model->id);
$this->renderPartial('_form', array('model'=>$model));
echo '</div>';