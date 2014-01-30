<?php
/* @var $this ZhanrsController */
/* @var $model Zhanrs */
/* @var $form BSActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'id'=>'zhanrs-form',
	'enableAjaxValidation'=>true,
	'layout' => BSHtml::FORM_LAYOUT_HORIZONTAL,
        'htmlOptions' => array(
            'enctype'=>'multipart/form-data',
            'class' => 'well'
        ),
)); ?>

    <?php echo Yum::requiredFieldNote(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model,'title',array('maxlength'=>255)); ?>

    <?php echo BSHtml::formActions(array(
        BSHtml::submitButton(Yum::t('Create'), array('color' => BSHtml::BUTTON_COLOR_PRIMARY)),
    )); ?>

    <?php $this->endWidget(); ?>

</div><!-- form -->