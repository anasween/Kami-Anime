<?php
/* @var $this NewsController */
/* @var $model News */
$this->breadcrumbs = array(
            Yum::t('News')=>array('index'),
            Yum::t('Create'),    
        );
echo '<div class="well">';
echo BSHtml::pageHeader(Yum::t('Update new'));
$this->renderPartial('_form', array('model'=>$model));
echo '</div>';

