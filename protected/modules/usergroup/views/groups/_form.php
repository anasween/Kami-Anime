<div class="form">
<p class="note">
<?php echo Yum::t('Fields with <span class="required">*</span> are required.');?>
</p>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'usergroup-create-form',
    'enableAjaxValidation'=>true,
    'htmlOptions' => array(
        'enctype'=>'multipart/form-data',
        'class' => 'well'
    ),
)); ?>

<?php echo $form->textFieldControlGroup($model,'title',array('maxlength'=>255)); ?>

<?php echo $form->textAreaControlGroup($model,'description'); ?>

<?php
echo BSHtml::buttonGroup(array(
    array(
        'label' => Yum::t('Cancel'), 
        'url' => array('groups/index'),
        'color' => BSHtml::BUTTON_COLOR_DANGER,
        'icon' =>  BSHtml::GLYPHICON_THUMBS_DOWN,
        'type' => BSHtml::BUTTON_TYPE_LINK
    ),
    array(
    'own' =>
        BSHtml::submitButton($model->isNewRecord ? Yum::t('Create') : Yum::t('Save'), array(
            'color' => BSHtml::BUTTON_COLOR_PRIMARY,
            'icon' =>  BSHtml::GLYPHICON_THUMBS_UP,
        )),
    )
));
?>
<?php $this->endWidget(); ?>
</div> <!-- form -->
