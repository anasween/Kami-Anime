<?php
$online = '';
if(Yum::hasModule('profile') && Yum::module('profile')->enablePrivacySetting) 
{
    if($data->privacy && $data->privacy->show_online_status) 
    {
        if($data->isOnline()) 
        {
            $online = 'online';
        }
    }
}
$divContent = $data->getAvatar(true);
$divContent .= BSHtml::tag('p',array(),$data->username);

echo BSHtml::tag('div',array(
            'class' => 'view_user' . $online,
            'id' => 'user_' . $data->id,
            'data-content' => $this->renderPartial('application.modules.user.views.user._tooltip', array('data' =>  $data),true,true),
            'data-toggle' => 'popover'
        ),
        $divContent);