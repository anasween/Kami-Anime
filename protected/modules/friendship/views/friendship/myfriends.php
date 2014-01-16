<?php
$this->title = Yum::t('My friends');
$this->breadcrumbs = array(
            Yum::t('Friends')
        );

if($friends) 
{
    echo '<div class="view-light">';
    echo '<table width="100%">';

    foreach($friends as $friend) 
    {
        $options = array();
        $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
            'id'=>'groups-form',
            'enableAjaxValidation'=>false,
            'htmlOptions' => array(
                'enctype'=>'multipart/form-data',
                'class' => 'well'
            ),
        ));
        
        echo CHtml::activeHiddenField($friend, 'inviter_id');
        echo CHtml::activeHiddenField($friend, 'friend_id');

        if($friend->status == 1) 
        { // Confirmation Pending
            if($friend->inviter_id == Yii::app()->user->id) 
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
        else if($friend->status == 2) 
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
        if($friend->inviter_id == Yii::app()->user->id)
        {
            $label = $friend->invited;
        }
        else
        {
            $label = $friend->inviter;
        }
        $buttonGroup = BSHtml::buttonGroup($options);

        printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td class="text-right">%s</td></tr>',
                $label->getAvatar(true),
                CHtml::link($label->username, array('//profile/profile/view', 'id'=>$label->id)),
                $friend->getStatus(),
                CHtml::link(Yum::t('Write a message'), array('//message/message/compose', 'to_user_id'=>$label->id)),
                $friend->status != 3 ? $buttonGroup : ''
        );
        $this->endWidget();
    }
    echo '</table>';
    echo '</div>';
} 
else 
{
    echo Yum::t('You do not have any friends yet');
}