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

<?php
if(!$to_user_id) 
{
    echo '<div class="well">';
    echo BSHtml::pills(array(
        array(
            'label' => Yum::t('Admin inbox'), 
            'url' => array('/message/message/index')
        ),
        array(
            'label' => Yum::t('Sent messages'), 
            'url' => array('/message/message/sent')
        ),
        array(
            'label' => Yum::t('Write a message'), 
            'url' => array('/message/message/compose'),
            'active' => true
        ),
    ), array(
        'justified' => true,
        'style' => 'margin-bottom: 10px;'
    ));
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
    echo $form->LabelEx($model, 'to_user_id');
    $this->widget('YumModule.components.select2.ESelect2', array(
        'model' => $model,
        'attribute' => 'to_user_id',
        'htmlOptions' => array(
            'multiple' => false,
            'style' => 'width:100%;',
         ),
        'data' => CHtml::listData(Yii::app()->user->data()->getFriends(), 'id', 'username'),
    )); 
}
?>
<?php echo $form->textFieldControlGroup($model,'title',array('size'=>45,'maxlength'=>45)); ?>

<?php 
    echo $form->LabelEx($model, 'message');
    $this->widget('ext.imperavi-redactor-widget.ImperaviRedactorWidget', array(
            'model' => $model,
            'attribute' => 'message',
            'options' => array(
                'lang' => 'ru',
                'toolbar' => true,
                'iframe' => true,
                'css' => 'wym.css',
                'buttons' => array(
                    'html', '|', 'formatting', '|', 'bold', 'italic', 'deleted', '|',
                    'unorderedlist', 'orderedlist', 'outdent', 'indent', '|',
                    'image', 'video', 'link', '|', '|', 'alignment', '|', 'horizontalrule'
                ),
            ),
            'htmlOptions' => array(
                'rows' => 20,
            ),
        ));
?>

<?php
    echo BSHtml::submitButton($model->isNewRecord ? Yum::t('Send') : Yum::t('Save'), array(
        'color' => BSHtml::BUTTON_COLOR_PRIMARY,
        'icon' =>  BSHtml::GLYPHICON_ENVELOPE,
    ));
?>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php 
if(!$to_user_id) {
    echo '</div>';
}