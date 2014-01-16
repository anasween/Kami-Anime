<?php
if(!$profile = $model->profile)
{
    return false;
}
    echo '<div id="friends">';
    if(isset($model->friends)) 
    {
        echo '<h2>' . Yum::t('Friends of {username}', array(
                                '{username}' => $model->username)) . '</h2>';
        
        foreach($model->friends as $friend) 
        {
            $this->renderPartial('application.modules.user.views.user._view', array('data' => $friend));
        }
    } 
    else 
    {
        echo Yum::t('{username} has no friends yet', array(
                                '{username}' => $model->username)); 
    }
echo '</div><!-- friends -->';

Yii::import('application.modules.friendship.controllers.YumFriendshipController');
echo YumFriendshipController::invitationLink(Yii::app()->user->id, $model->id);