<?php
echo Yum::t('You are not allowed to see this message.');
echo '<br />';
echo BSHtml::button(Yum::t('Return to your inbox'), array(
        'color' => BSHtml::BUTTON_COLOR_PRIMARY,
        'icon' =>  BSHtml::GLYPHICON_THUMBS_UP,
        'url' => array('index'),
        'type' => BSHtml::BUTTON_TYPE_LINK
    )
);