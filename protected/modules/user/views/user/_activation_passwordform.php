<?php $formBs=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'activation-password-form',
    'enableAjaxValidation'=>false,
    'htmlOptions' => array(
        'enctype'=>'multipart/form-data',
        'class' => 'well'
    ),
)); ?>
<?php echo $formBs->errorSummary($form); ?>

<?php echo CHtml::hiddenField('email', $email); ?>
<?php echo CHtml::hiddenField('activationKey', $key); ?>

<?php echo $formBs->PasswordFieldControlGroup($form,'password'); ?>

<?php echo $formBs->PasswordFieldControlGroup($form,'verifyPassword'); ?>

<?php
    echo BSHtml::submitButton(Yum::t('Submit'), array(
        'color' => BSHtml::BUTTON_COLOR_PRIMARY,
        'icon' =>  BSHtml::GLYPHICON_THUMBS_UP,
    ));
?>
<?php $this->endWidget(); ?>