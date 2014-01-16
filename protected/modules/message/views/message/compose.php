<?php 
if(!$this->title) 
{
    $this->title = Yum::t('Compose new message'); 
}
if(!$to_user_id)
{
    $this->breadcrumbs = array(
                Yum::t('Messages'), 
                Yum::t('Compose')
            );
}
?>

<div class="form">

<?php 
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'yum-message-form',
    'action' => array('//message/message/compose'),
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'htmlOptions' => array(
        'enctype'=>'multipart/form-data',
        'class' => 'well'
    ),
));
?>

<?php echo Yum::requiredFieldNote(); 

echo $form->errorSummary($model); 

echo CHtml::hiddenField('YumMessage[answered]', $answer_to);

if($to_user_id) 
{
    echo CHtml::hiddenField('YumMessage[to_user_id]', $to_user_id);
    echo Yum::t('This message will be sent to {username}', array(
                            '{username}' => YumUser::model()->findByPk($to_user_id)->username));
} 
else 
{
    echo $form->dropDownListControlGroup(
            $model, 
            'to_user_id',
            CHtml::listData(Yii::app()->user->data()->getFriends(), 'id', 'username'),
            array(
                'hint' => Yum::t('Only your friends are shown here')
            )
    );
}
?>
<?php echo $form->textFieldControlGroup($model,'title',array('size'=>45,'maxlength'=>45)); ?>

<?php echo $form->textAreaControlGroup($model,'message',array('rows'=>6, 'cols'=>50)); ?>

<?php
    echo BSHtml::submitButton($model->isNewRecord ? Yum::t('Send') : Yum::t('Save'), array(
        'color' => BSHtml::BUTTON_COLOR_PRIMARY,
        'icon' =>  BSHtml::GLYPHICON_ENVELOPE,
    ));
?>

<?php $this->endWidget(); ?>

</div><!-- form -->
