<?php

$template = '<strong>%s:</strong> %s <br>';

if(Yum::hasModule('profile') && Yum::module('profile')->enablePrivacySetting) 
{
    if($data->privacy && $data->privacy->show_online_status) 
    {
        if($data->isOnline()) 
        {
            echo BSHtml::tag('strong', array('style' => 'text-align: center;'), Yum::t('User is Online!')) . '<br>';
        }
    }
}
printf($template, Yum::t('Username'), $data->username);
printf($template, Yum::t('First visit'), date(UserModule::$dateFormat, $data->createtime));
printf($template, Yum::t('Last visit'), date(UserModule::$dateFormat, $data->lastvisit));

if(Yum::hasModule('message'))
{
    echo BSHtml::link(Yum::t('Write a message'), array(
                            '//message/message/compose', 'to_user_id' => $data->id)) . '<br />';
}

if(Yum::hasModule('profile'))
{
    echo BSHtml::link(Yum::t('Visit profile'), array(
                            '//profile/profile/view', 'id' => $data->id));
}



