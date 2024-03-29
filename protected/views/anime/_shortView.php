<?php

/* @var $this AnimeController */
/* @var $model Anime */

$isView = (Yii::app()->controller->action->id === 'view');

echo BSHtml::tag('h1', array('style' => 'text-align: center;'), $model->name_ru);
echo BSHtml::tag('h2', array('style' => 'text-align: center;'), $model->name_en);
echo BSHtml::tag('h3', array('style' => 'text-align: center;'), $model->name_jp);
echo $model->getPoster();
$content = BSHtml::tag('strong', array(), Yum::t('Zhanrs')) . ': ';
$zhanrs = $model->getZhanrs();
$count = count($zhanrs);
if ($zhanrs) {
    foreach ($zhanrs as $zhanr) {
        $content .= BSHtml::link($zhanr->title, array('/anime/search', 'options' => array('zhanrs' => $zhanr->id)));
        $content .= (!--$count) ? '.' : ', ';
    }
}
echo BSHtml::tag('p', array('style' => 'text-align: center;'), $content);
$content = BSHtml::tag('strong', array(), Yum::t('Type')) . ': ';
echo BSHtml::tag('p', array('style' => 'text-align: center;'), $content . $model->type . ' (' . $model->series_count . ' эп.)');
$content = BSHtml::tag('strong', array(), Yum::t('Useful urls')) . ': ';
$urls = $model->urls;
unset($count);
$count = count($urls);
if (Yii::app()->user->can('urls', 'admin')) {
    $content .= BSHtml::icon(BSHtml::GLYPHICON_PLUS, array(
        'class' => 'url-moder url-add-link',
        'data-title' => Yum::t('Create'),
        'title' => '',
        'data-toggle' => 'tooltip'
    ));
    $allContent = BSHtml::tag('div', array(
        'class' => 'anime-useful-urls',
        'anime-id' => $model->id,
    ), $content);
    echo BSHtml::tag('div', array('style' => 'text-align: center;'), $allContent);
} else {
    if ($urls) {
        echo BSHtml::tag('p', array('style' => 'text-align: center;'), $content);
    }
}
$content = '';
if ($urls) {
    foreach ($urls as $url) {
        if (Yii::app()->user->can('urls', 'admin')) {
            $divContent = BSHtml::link($url->site->title, $url->url, array());
            $divContent .= BSHtml::icon(BSHtml::GLYPHICON_PENCIL, array(
                'class' => 'url-moder url-edit-link',
                'data-title' => Yum::t('Edit'),
                'title' => '',
                'data-toggle' => 'tooltip'
            ));
            $divContent .= BSHtml::icon(BSHtml::GLYPHICON_REMOVE, array(
                'class' => 'url-moder url-delete-link',
                'data-title' => Yum::t('Delete'),
                'title' => '',
                'data-toggle' => 'tooltip'
            ));
            $divContent .= (!--$count) ? '.' : ', ';
            $content .= BSHtml::tag('div', array(
                'class' => 'anime-useful-urls',
                'anime-id' => $model->id,
                'site-id' => $url->site->id
            ), $divContent);
        } else {
            $content .= BSHtml::link($url->site->title, $url->url, array());
            $content .= (!--$count) ? '.' : ', ';
        }
    }
}
echo BSHtml::tag('div', array('style' => 'text-align: center;'), $content);
if ($model->description) {
    $content = BSHtml::tag('strong', array(), Yum::t('Description')) . ': ';
    echo BSHtml::tag('p', array(), $content . $model->description);
}

if ($isView) {
    $this->widget('bootstrap.widgets.BsPanelGroup', array(
        'collapse' => true,
        'items' => array(
            array(
                'header' => Yum::t('Anime like this'),
                'body' => $this->renderPartial('_animeLikeThis', array('anime' => $model->getAnimeLikeThis()), true),
                'color' => BSHtml::BUTTON_COLOR_PRIMARY
            ),
        )
    ));
    $this->widget('bootstrap.widgets.BsPanelGroup', array(
        'collapse' => true,
        'items' => array(
            array(
                'header' => '1231231',
                'body' => '1231231',
            ),
            array(
                'header' => '1231231',
                'body' => '1231231',
            ),
            array(
                'header' => '1231231',
                'body' => '1231231',
            ),
        )
    ));
}