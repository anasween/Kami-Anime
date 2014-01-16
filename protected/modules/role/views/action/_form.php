<div class="form">

<?php 
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'action-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'htmlOptions' => array(
        'enctype'=>'multipart/form-data',
        'class' => 'well'
    ),
));
echo Yum::requiredFieldNote();
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->textFieldControlGroup($model,'title',array('maxlength'=>255)); ?>

<?php echo $form->textAreaControlGroup($model,'comment'); ?>

<?php echo $form->textFieldControlGroup($model,'subject',array('maxlength'=>255)); ?>

<?php
    echo BSHtml::submitButton($model->isNewRecord ? Yum::t('Create') : Yum::t('Save'), array(
        'color' => BSHtml::BUTTON_COLOR_PRIMARY,
        'icon' =>  BSHtml::GLYPHICON_THUMBS_UP,
    ));
?>

<?php $this->endWidget(); ?>

</div><!-- form -->
