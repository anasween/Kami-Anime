<?php

$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id' => 'urls-form',
    'enableAjaxValidation' => true,
    'htmlOptions' => array(
        'class' => 'well'
    )
        ));
echo BSHtml::tag('div', array('id' => 'urlsAlert'), '');
echo Yum::requiredFieldNote();
echo $form->errorSummary($model);
echo CHtml::hiddenField('Urls[anime_id]', '0');
echo $form->dropDownListControlGroup($model, 'site_id', CHtml::listData(Sites::model()->findAll(), 'id', 'title'));
echo $form->textFieldControlGroup($model, 'url', array('maxlength' => 250));
echo BSHtml::ajaxSubmitButton(Yum::t('Update'), array('/anime/editUrl'), array(
    'type' => 'POST',
    'update' => '#urlsAlert'
        ), array(
    'id' => 'urlsEditbtn'
));

echo BSHtml::ajaxSubmitButton(Yum::t('Add'), array('/anime/createUrl'), array(
    'type' => 'POST',
    'update' => '#urlsAlert'
        ), array(
    'id' => 'urlsAddbtn'
));
$this->endWidget();
