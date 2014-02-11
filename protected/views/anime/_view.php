<?php
/* @var $this AnimeController */
/* @var $data Anime */

$header = BSHtml::link($data->name_ru . '/' . $data->name_en . ' [' . $data->year . ']', array('anime/view', 'id' => $data->id));
if (Yii::app()->user->can('news'))
{
    $content = BSHtml::buttonGroup(array(
        array(
            'icon' => BSHtml::GLYPHICON_PLUS_SIGN, 
            'url' => array('anime/create'),
            'visible' => Yii::app()->user->can('anime', 'create'),
            'color' => BSHtml::BUTTON_COLOR_SUCCESS,
            'type' => BSHtml::BUTTON_TYPE_LINK,
            'data-title' => Yum::t('Create'),
            'title' => '',
            'data-toggle' => 'tooltip'
        ),
        array(
            'icon' => BSHtml::GLYPHICON_EDIT, 
            'url' => array("anime/update", "id"=>$data->id),
            'visible' => Yii::app()->user->can('anime', 'update'),
            'color' => BSHtml::BUTTON_COLOR_WARNING,
            'type' => BSHtml::BUTTON_TYPE_LINK,
            'data-title' => Yum::t('Edit'),
            'title' => '',
            'data-toggle' => 'tooltip'
        ),
    ), array(
        'size' => BSHtml::BUTTON_SIZE_MINI
    ));
    if ($content !== '') {
        $header .= BSHtml::tag('div', array('class' => 'pull-right'), $content);
    }
}

$this->widget('bootstrap.widgets.BsPanel',array(
    'header' => $header,
    'body' => $this->renderPartial('_shortView', array('model'=>$data), true, true),
)); 