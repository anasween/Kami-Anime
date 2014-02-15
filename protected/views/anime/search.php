<?php

/* @var $this AnimeController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php

$this->breadcrumbs = array(
    Yum::t('Anime') => array('index'),
    Yum::t('Anime advanced search')
);
echo '<div class="well">';
echo BSHtml::pageHeader(Yum::t('Anime advanced search'));
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'anime-form',
    'method' => 'GET',
    'action' => array('/anime/search'),
    'enableAjaxValidation' => true,
    'htmlOptions' => array(
        'class' => 'well',
        'enctype'=>'multipart/form-data'
    )
));
echo BSHtml::tag('h5', array(), Yum::t('Title'));
echo BSHtml::textField('options[title]', $options['title'], array('style' => 'width:100%;')); 
echo BSHtml::tag('h5', array(), Yum::t('Zhanrs'));
$this->widget('YumModule.components.select2.ESelect2', array(
    'name' => 'options[zhanrs]',
    'id' => 'zhanrsSearch',
    'value' => $options['zhanrs'],
    'htmlOptions' => array(
        'multiple' => 'multiple',
        'style' => 'width:100%;',
     ),
    'data' => CHtml::listData(Zhanrs::model()->findAll(), 'id', 'title'),
)); 
echo BSHtml::submitButton(Yum::t('Search'), array(
    'color' => BSHtml::BUTTON_COLOR_PRIMARY,
    'style' => 'margin-top: 10px'
));
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