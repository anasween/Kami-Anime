<?php
    /* @var $this ZhanrsController */
    /* @var $model Zhanrs */

$this->breadcrumbs=array(
	Yum::t('Zhanrs')=>array('index'),
	Yum::t('Create'),
);
echo '<div class="well">';
echo BSHtml::pageHeader(Yum::t('Create'),Yum::t('Zhanrs'));
$this->renderPartial('_form', array('model'=>$model));
echo '</div>';