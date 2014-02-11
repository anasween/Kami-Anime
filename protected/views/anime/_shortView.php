<?php

/* @var $this AnimeController */
/* @var $model Anime */

echo BSHtml::tag('h1', array('style' => 'text-align: center;'), $model->name_ru);
echo BSHtml::tag('h2', array('style' => 'text-align: center;'), $model->name_en);
echo BSHtml::tag('h3', array('style' => 'text-align: center;'), $model->name_jp);
if ($model->poster) {
    echo BSHtml::imageThumbnail($model->getPoster());
}
$content = BSHtml::tag('strong', array(), Yum::t('Year')) . ': ';
echo BSHtml::tag('p', array('style' => 'text-align: center;'), $content . $model->year);
$content = BSHtml::tag('strong', array(), Yum::t('Description')) . ': ';
echo BSHtml::tag('p', array(), $content . $model->description);
unset($content);