<?php
$content = '';
$letters = array();
foreach ($models as $anime) {
    $letter = mb_substr($anime->name_ru, 0,1,"UTF-8");
    if (!in_array($letter, $letters)) {
        array_push($letters, $letter);
        $content .= BSHtml::tag('h3', array('id' => $letter), $letter);
    }
    if (Yii::app()->user->can('urls', 'admin')) {
        $divContent = BSHtml::link($anime->name_ru, array('view', 'id'=>$anime->id), array('style' => 'display: inline-block'));
        $divContent .= BSHtml::link(BSHtml::icon(BSHtml::GLYPHICON_PENCIL, array(
            'class' => 'url-moder url-edit-link',
            'data-title' => Yum::t('Edit'),
            'title' => '',
            'data-toggle' => 'tooltip'
        )), array('/anime/update', 'id' => $anime->id), array('style' => 'display: inline-block;'));
        $content .= BSHtml::tag('div', array(
            'class' => 'anime-useful-urls block',
        ), $divContent);
    } else {
        $content .= BSHtml::link($anime->name_ru, array('view', 'id'=>$anime->id), array('style' => 'display: block'));
    }
}
foreach ($letters as $letter) {
    echo BSHtml::link($letter, '#'.$letter, array()) . ' | ';
}
echo $content;