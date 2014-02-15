<?php

/* @var $this AnimeController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php

$this->breadcrumbs = array(
    Yum::t('Anime') => array('index'),
    Yum::t('Anime zhanr search')
);
echo '<div class="well">';
echo BSHtml::pageHeader(Yum::t('Anime zhanr search'));
echo BSHtml::labelBs(Yum::t('Zhanrs'));
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'anime-form',
    'method' => 'GET',
    'action' => array('/anime/zhanrSearch'),
    'enableAjaxValidation' => true,
    'htmlOptions' => array(
        'class' => 'well',
        'enctype'=>'multipart/form-data'
    )
));
$this->widget('YumModule.components.select2.ESelect2', array(
    'name' => 'zhanrs',
    'htmlOptions' => array(
        'multiple' => 'multiple',
        'style' => 'width:100%;',
     ),
    'data' => CHtml::listData(Zhanrs::model()->findAll(), 'id', 'title'),
)); 
echo BSHtml::submitButton(Yum::t('Submit'), array('color' => BSHtml::BUTTON_COLOR_PRIMARY));
$this->endWidget();
$this->renderPartial('_loop', array('dataProvider'=>$dataProvider));
echo '</div>';
if (Yii::app()->user->can('urls','admin')) {
    $this->widget('bootstrap.widgets.BsModal', array(
        'id' => 'addUrlModal',
        'header' => Yum::t('Add url'),
        'content' => $this->renderPartial('//anime/_urlForm', array('model' => new Urls), true, true),
    ));
}