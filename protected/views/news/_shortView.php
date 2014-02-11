<?php
$header = BSHtml::link($data->title, $this->createUrl('news/view',array('id'=>$data->id)));
if (Yii::app()->user->can('news'))
{
    $content = BSHtml::buttonGroup(array(
                    array(
                        'icon' => BSHtml::GLYPHICON_PLUS_SIGN, 
                        'url' => array('news/create'),
                        'visible' => Yii::app()->user->can('news', 'create'),
                        'color' => BSHtml::BUTTON_COLOR_SUCCESS,
                        'type' => BSHtml::BUTTON_TYPE_LINK,
                        'data-title' => Yum::t('Create'),
                        'title' => '',
                        'data-toggle' => 'tooltip'
                    ),
                    array(
                        'icon' => BSHtml::GLYPHICON_EDIT, 
                        'url' => array("news/update", "id"=>$data->id),
                        'visible' => Yii::app()->user->can('news', 'update'),
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
$footer = BSHtml::icon(BSHtml::GLYPHICON_EYE_OPEN) . ' '
                . $data->views . ' | '
                . '<a href="' . $this->createUrl('/profile/profile/view',array('id'=>$data->autor->id)) . '">'
                . BSHtml::icon(BSHtml::GLYPHICON_USER) . ' '
                . $data->autor->username 
                . '</a> | '
                . BSHtml::icon(BSHtml::GLYPHICON_CALENDAR) . ' '
                . Yii::app()->dateFormatter->format('d MMMM yyyy HH:mm:ss', $data->create_Date) . ' | '
                . BSHtml::icon(BSHtml::GLYPHICON_COMMENT) . ' '
                . count($data->comments);

$footer .= BSHtml::tag('div', array('class' => 'pull-right'), BSHtml::link(BSHtml::icon(BSHtml::GLYPHICON_CLOUD) . ' ' . Yum::t('More'), $this->createUrl('news/view',array('id'=>$data->id))));

$this->widget('bootstrap.widgets.BsPanel',array(
    'header' => $header,
    'body' => $data->text,
    'title' => true,
    'footer' => $footer
)); 