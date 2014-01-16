<h1> <?php echo Yum::t('Registration'); ?> </h1>

<?php $this->breadcrumbs = array(Yum::t('Registration')); ?>

<div class="form">
<?php $activeform = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'registration-form',
    'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    'focus'=>array($form,'username'),
    'htmlOptions' => array(
        'enctype'=>'multipart/form-data',
        'class' => 'well'
    ),
));
?>

<?php echo Yum::requiredFieldNote(); ?>
<?php echo $activeform->errorSummary(array($form, $profile)); ?>

<?php echo $activeform->textFieldControlGroup($form,'username'); ?> 

<?php echo $activeform->textFieldControlGroup($profile,'email');?> 
    
<?php echo $activeform->textFieldControlGroup($profile,'firstname');?> 
    
<?php echo $activeform->textFieldControlGroup($profile,'lastname');?>
    
<?php echo $activeform->passwordFieldControlGroup($form,'password'); ?>

<?php echo $activeform->passwordFieldControlGroup($form,'verifyPassword'); ?>

<?php if(extension_loaded('gd') 
			&& Yum::module('registration')->enableCaptcha): ?>
    <?php $this->widget('CCaptcha'); ?>
    <?php echo BSHtml::activeTextFieldControlGroup($form,'verifyCode', array(
        'hint' => Yum::t('Please enter the letters as they are shown in the image above.') . '<br />' 
                . Yum::t('Letters are not case-sensitive.')
    )); ?>
<?php endif; ?>
    
<?php
    echo BSHtml::submitButton(Yum::t('Registration'), array(
        'color' => BSHtml::BUTTON_COLOR_PRIMARY,
        'icon' =>  BSHtml::GLYPHICON_THUMBS_UP,
    ));
?>

<?php $this->endWidget(); ?>
</div><!-- form -->
