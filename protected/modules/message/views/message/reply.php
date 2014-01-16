<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
			'id'=>'yum-message-form',
			'action' => array('//message/message/compose'),
			'enableAjaxValidation'=>true,
                        'htmlOptions' => array(
                            'enctype'=>'multipart/form-data',
                            'class' => 'well'
                        ),
                    )); ?>

<?php 
echo Yum::requiredFieldNote(); 

echo $form->errorSummary($model);

echo CHtml::hiddenField('YumMessage[to_user_id]', $to_user_id);
echo CHtml::hiddenField('YumMessage[answered]', $answer_to);
echo Yum::t('This message will be sent to {username}', array(
                '{username}' => YumUser::model()->findByPk($to_user_id)->username));
?>

<?php echo $form->textFieldControlGroup($model,'title',array('size'=>45,'maxlength'=>45)); ?>

<?php echo $form->textAreaControlGroup($model,'message',array('rows'=>6, 'cols'=>50)); ?>

<?php
    echo BSHtml::submitButton(Yum::t('Reply'), array(
        'color' => BSHtml::BUTTON_COLOR_PRIMARY,
        'icon' =>  BSHtml::GLYPHICON_THUMBS_UP,
    ));
?>

<?php $this->endWidget(); ?>

</div><!-- form -->
