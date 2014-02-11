<?php

/* @var $this AnimeController */
/* @var $model Anime */

$this->breadcrumbs = array(
    Yum::t('Anime') => array('index'),
    Yum::t('Create'),
);
echo '<div class="well">';
echo BSHtml::pageHeader(Yum::t('Create'), Yum::t('Anime'));
$this->renderPartial('_form', array('model' => $model));
echo '</div>';
