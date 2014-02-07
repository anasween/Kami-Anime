<div class="row well">
<?php
$options = array();
$form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'groups-form' . $data->inviter_id . $data->friend_id,
    'enableAjaxValidation'=>false,
    'htmlOptions' => array(
        'enctype'=>'multipart/form-data',
    ),
));

echo CHtml::activeHiddenField($model[$index], 'inviter_id');
echo CHtml::activeHiddenField($model[$index], 'friend_id');

if($data->status == 1) 
{ // Confirmation Pending
    if($data->inviter_id == Yii::app()->user->id) 
    {
        $options[] = array(
        'own' =>
            BSHtml::submitButton(Yum::t('Cancel request'), array(
                'color' => BSHtml::BUTTON_COLOR_DANGER,
                'icon' =>  BSHtml::GLYPHICON_THUMBS_DOWN,
                'id'=>'cancel_request', 
                'name'=>'YumFriendship[cancel_request]'
            )),
        );
    } 
    else 
    {
        $options[] = array(
        'own' =>
            BSHtml::submitButton(Yum::t('Confirm'), array(
                'color' => BSHtml::BUTTON_COLOR_PRIMARY,
                'icon' =>  BSHtml::GLYPHICON_THUMBS_UP,
                'id'=>'add_request',
                'name'=>'YumFriendship[add_request]'
            )),
        );
        $options[] = array(
        'own' =>
            BSHtml::submitButton(Yum::t('Cancel request'), array(
                'color' => BSHtml::BUTTON_COLOR_DANGER,
                'icon' =>  BSHtml::GLYPHICON_THUMBS_DOWN,
                'id'=>'deny_request',
                'name'=>'YumFriendship[deny_request]'
            )),
        );
    }
} 
else if($data->status == 2) 
{ // Users are friends
    $options[] = array(
    'own' =>
        BSHtml::submitButton(Yum::t('Cancel request'), array(
            'color' => BSHtml::BUTTON_COLOR_DANGER,
            'icon' =>  BSHtml::GLYPHICON_THUMBS_DOWN,
            'id'=>'deny_request',
            'name'=>'YumFriendship[deny_request]'
        )),
    );
}
if($data->inviter_id == Yii::app()->user->id)
{
    $label = $data->invited;
}
else
{
    $label = $data->inviter;
}
$buttonGroup = BSHtml::buttonGroup($options);

printf('<div class="col-md-3" style="text-align: center;">%s</div><div class="col-md-3">%s</div><div class="col-md-6" style="text-align: right;">%s</div>',
        $label->getUserAvatarWithInfo(),
        $data->getStatus(),
        $data->status != 3 ? $buttonGroup : ''
);
$this->endWidget();
?>
</div>