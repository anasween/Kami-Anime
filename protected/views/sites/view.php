<?php
$this->breadcrumbs=array(
	Yum::t('Sites')=>array('index'),
	$model->id,
);

echo '<div class="well">';
echo BSHtml::pageHeader($model->title);
echo $model->getLogo();
echo '</div>';