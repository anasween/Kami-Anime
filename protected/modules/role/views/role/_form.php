<div class="form">

<?php 
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'role-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'htmlOptions' => array(
        'enctype'=>'multipart/form-data',
        'class' => 'well'
    ),
));
?>

<?php echo Yum::requiredFieldNote(); ?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->TextFieldControlGroup($model,'title',array('maxlength'=>20)); ?>

<?php echo $form->TextAreaControlGroup($model,'description'); ?>	


<?php 
if(Yum::hasModule('membership')) 
{
    echo $form->TextFieldControlGroup($model, 'membership_priority',
        array(
            'hint' => Yum::t('Leave empty or set to 0 to disable membership for this role.') 
                . Yum::t('Set to >0 to enable membership for this role and set a priority.') 
                . Yum::t('Higher is usually more worthy. This is used to determine downgrade possibilities.'), 
        )); 
    echo $form->TextFieldControlGroup($model, 'price', array('hint' => Yum::t('How expensive is a membership? Set to 0 to disable membership for this role'))); 

    echo $form->TextFieldControlGroup($model, 'duration', array('hint' => Yum::t('How many days will the membership be valid after payment?'))); 
    
    echo '<div style="clear: both;"> </div>';
} 
?>
<?php
    echo BSHtml::submitButton($model->isNewRecord ? Yum::t('Create role') : Yum::t('Save role'), array(
        'color' => BSHtml::BUTTON_COLOR_PRIMARY,
        'icon' =>  BSHtml::GLYPHICON_THUMBS_UP,
    ));
?>

<?php $this->endWidget(); ?>
</div><!-- form -->

