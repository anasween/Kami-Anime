<?php
if(isset($_GET['returnTo']))
{
    $url = array($_GET['returnTo']);
}
if(!isset($url)) 
{
    $url = array('profilecomment/admin');
}
echo BSHtml::buttonGroup(array(
        array(
            'label' => Yum::t('Cancel'), 
            'url' => $url,
            'color' => BSHtml::BUTTON_COLOR_DANGER,
            'icon' =>  BSHtml::GLYPHICON_THUMBS_DOWN,
            'type' => BSHtml::BUTTON_TYPE_LINK
        ),
        array(
        'own' =>
            BSHtml::submitButton(Yum::t('Create'), array(
                'color' => BSHtml::BUTTON_COLOR_PRIMARY,
                'icon' =>  BSHtml::GLYPHICON_THUMBS_UP,
            )),
        )
    ));