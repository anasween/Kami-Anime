<?php

/* @var $this AnimeController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php

$this->breadcrumbs = array(
    Yum::t('Anime'),
);
echo '<div class="well">';
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'anime-form',
    'method' => 'GET',
    'enableAjaxValidation' => true,
    'htmlOptions' => array(
        'class' => 'well',
        'enctype'=>'multipart/form-data'
    )
));
echo BSHtml::labelBs(Yum::t('Search'));
echo BSHtml::textField('title', $title); 
echo BSHtml::submitButton(Yum::t('Search'), array('color' => BSHtml::BUTTON_COLOR_INFO,'size' => BSHtml::BUTTON_SIZE_SMALL));
echo BSHtml::linkButton(Yum::t('Advanced search'), array(
    'color' => BSHtml::BUTTON_COLOR_PRIMARY,
    'size' => BSHtml::BUTTON_SIZE_SMALL,
    'url' => array('/anime/search')
));
$this->endWidget();
echo BSHtml::pageHeader(Yum::t('Anime'));
$this->renderPartial('_loop', array('dataProvider'=>$dataProvider));
echo '</div>';
if (Yii::app()->user->can('urls','admin')) {
    $this->widget('bootstrap.widgets.BsModal', array(
        'id' => 'addUrlModal',
        'header' => Yum::t('Add url'),
        'content' => $this->renderPartial('//anime/_urlForm', array('model' => new Urls), true, true),
    ));
}