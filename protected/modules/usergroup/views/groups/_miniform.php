<div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'usergroup-form',
    'enableAjaxValidation'=>true,
    'htmlOptions' => array(
        'enctype'=>'multipart/form-data',
        'class' => 'well'
    ),
)); 
echo $form->errorSummary($model);
?>
<?php echo $form->textFieldControlGroup($model,'owner_id'); ?>

<?php echo $form->textFieldControlGroup($model,'title',array('size'=>60,'maxlength'=>255)); ?>

<?php echo $form->textAreaControlGroup($model,'description',array('rows'=>6, 'cols'=>50)); ?>

<?php
echo BSHtml::buttonGroup(array(
    array(
        'label' => Yum::t('Cancel'), 
        'onClick' => "$('#".$relation."_dialog').dialog('close');",
        'color' => BSHtml::BUTTON_COLOR_DANGER,
        'icon' =>  BSHtml::GLYPHICON_THUMBS_DOWN,
    ),
    array(
    'own' =>
        BSHtml::submitButton(Yum::t('Create'), array(
            'color' => BSHtml::BUTTON_COLOR_PRIMARY,
            'icon' =>  BSHtml::GLYPHICON_THUMBS_UP,
            'id' => "submit_".$relation
        )),
    )
));
$this->endWidget(); 

?></div> <!-- form -->