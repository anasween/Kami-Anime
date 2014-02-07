<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - ' . Yum::t('Error');
$this->breadcrumbs = array(
            Yum::t('Error')    
        );
echo '<div class="well">';
echo BSHtml::pageHeader(Yum::t('Error'), $code);
echo CHtml::encode($message);
echo '</div>';