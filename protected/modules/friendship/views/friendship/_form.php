<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'groups-form',
    'enableAjaxValidation'=>false,
    'htmlOptions' => array(
        'enctype'=>'multipart/form-data',
        'class' => 'well'
    ),
)); ?>
    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model->inviter,'username',array(
                            'size'=>20,'maxlength'=>25,'readonly'=>'readonly')); ?>

    <?php echo $form->DropDownListControlGroup($model, 'status',
            array(
                '0' => Yum::t('No friendship requested'),
                '1' => Yum::t('Confirmation pending'),
                '2' => Yum::t('Friendship confirmed'),
                '3' => Yum::t('Friendship rejected')
            )
        ); ?>
    <?php echo $form->textFieldControlGroup($model->invited,'username',array(
                                    'size'=>20,'maxlength'=>25,'readonly'=>'readonly')); ?>

    <?php echo $form->textAreaControlGroup($model,'message'); ?>

    <?php
        echo BSHtml::submitButton($model->isNewRecord ? Yum::t('Create') : Yum::t('Save'), array(
            'color' => BSHtml::BUTTON_COLOR_PRIMARY,
            'icon' =>  BSHtml::GLYPHICON_THUMBS_UP,
        ));
    ?>
    
<?php $this->endWidget(); ?>

</div><!-- form -->
