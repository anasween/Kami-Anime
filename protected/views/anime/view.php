<?php
/* @var $this AnimeController */
/* @var $model Anime */
?>

<?php
$this->breadcrumbs=array(
	Yum::t('Anime')=>array('index'),
	$model->id,
);

$header = $model->name_ru . '/' . $model->name_en . ' [' . $model->year . ']';
if (Yii::app()->user->can('anime'))
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
            'url' => array("anime/update", "id"=>$model->id),
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
    'body' => $this->renderPartial('_shortView', array('model'=>$model), true, true),
    'title' => true,
)); 