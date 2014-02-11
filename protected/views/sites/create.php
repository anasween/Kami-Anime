<?php
/* @var $this SitesController */
/* @var $model Sites */
$this->breadcrumbs = array(
            Yum::t('Sites')=>array('index'),
            Yum::t('Create'),    
        );
echo '<div class="well">';
echo BSHtml::pageHeader(Yum::t('Create'), Yum::t('Sites'));
$this->renderPartial('_form', array('model'=>$model));
echo '</div>';
