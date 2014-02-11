<?php
/* @var $this NewsController */
/* @var $model News */

$this->breadcrumbs = array(
            Yum::t('News')=>array('index'),
            $model->title=>array('view','id'=>$model->id),
            Yum::t('Upadate'),   
        );

echo '<div class="well">';
echo BSHtml::pageHeader(Yum::t('Update new'), $model->title);
$this->renderPartial('_form', array('model'=>$model));
echo '</div>';