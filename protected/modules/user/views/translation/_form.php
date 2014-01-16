<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'translation-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'htmlOptions' => array(
        'enctype'=>'multipart/form-data',
        'class' => 'well'
    ),
)); ?>


<?php echo Yum::requiredFieldNote(); ?>

<?php echo $form->errorSummary($models); ?>

<?php echo $form->textFieldControlGroup($models[0],'message'); ?>
<?php echo $form->textFieldControlGroup($models[0],'category'); ?>

<hr />

<?php foreach($models as $model) { ?>
<div style="float: left"> 

    <?php echo BSHtml::label($model->language, 'translation_'.$model->language); ?>
    <?php echo BSHtml::textField('translation_'.$model->language, $model->translation, array(
        'class' => 'form-control'
    )); ?>

</div>
<?php } ?>

<div class="clearfix"></div>
    
<?php
    echo BSHtml::submitButton($models[0]->isNewRecord ? Yum::t('Create') : Yum::t('Save'), array(
        'color' => BSHtml::BUTTON_COLOR_PRIMARY,
        'icon' =>  BSHtml::GLYPHICON_THUMBS_UP,
    ));
?>

<?php $this->endWidget(); ?>

</div><!-- form -->
