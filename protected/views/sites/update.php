<?php
/* @var $this SitesController */
/* @var $model Sites */
$this->breadcrumbs = array(
            Yum::t('Sites')=>array('index'),
            $model->title=>array('view','id'=>$model->id),
            Yum::t('Update'),    
        );
echo '<div class="well">';
echo BSHtml::pageHeader(Yum::t('Update'), Yum::t('Sites') . ' ' . $model->id);
$this->renderPartial('_form', array('model'=>$model));
echo '</div>';