<?php
if(Yum::module('message')->messageSystem != YumMessage::MSG_NONE 
		&& $model->id != Yii::app()->user->id) 
{

$this->beginWidget(
    'bootstrap.widgets.BsModal',
    array('id' => 'yum-message-modal')
); ?>
 
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h4><?php echo Yum::t('Send message'); ?></h4>
    </div>
 
    <div class="modal-body">
        <?php 
        $this->renderPartial(
            Yum::module()->messageComposeView, 
            array(
                'model' => new YumMessage,
                'to_user_id' => $model->id,
                'answer_to' => ''
            ), 
            false, 
            true
        ); 
        ?>
    </div>
 
<?php 
$this->endWidget(); 
echo BSHtml::button(Yum::t('Write a message to this User'), array(
        'color' => BSHtml::BUTTON_COLOR_INFO,
        'icon' =>  BSHtml::GLYPHICON_SEND,
        'data-toggle' => 'modal',
        'data-target' => '#yum-message-modal',
    ));
}