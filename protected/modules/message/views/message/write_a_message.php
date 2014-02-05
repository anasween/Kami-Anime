<?php
if(Yum::module('message')->messageSystem != YumMessage::MSG_NONE 
		&& $model->id != Yii::app()->user->id) 
{
    
$this->widget('bootstrap.widgets.BsModal', array(
    'id' => 'yum-message-modal',
    'header' => Yum::t('Send message'),
    'content' => $this->renderPartial(
                Yum::module()->messageComposeView, 
                array(
                    'model' => new YumMessage,
                    'to_user_id' => $model->id,
                    'answer_to' => ''
                ), 
                true, 
                true
            ),
    'footer' => ''
));
echo BSHtml::button(Yum::t('Write a message to this User'), array(
        'color' => BSHtml::BUTTON_COLOR_INFO,
        'icon' =>  BSHtml::GLYPHICON_SEND,
        'data-toggle' => 'modal',
        'data-target' => '#yum-message-modal',
    ));
}