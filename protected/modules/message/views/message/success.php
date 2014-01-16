<?php 
$this->title = Yum::t('Your message has been sent');
$this->breadcrumbs=array(
	Yum::t('Messages')=>array('index'),
	Yum::t('Success'));
?>
<p>
    <?php
        echo BSHtml::button(Yum::t('Back to inbox'), array(
            'color' => BSHtml::BUTTON_COLOR_PRIMARY,
            'icon' =>  BSHtml::GLYPHICON_HAND_LEFT,
            'type' => BSHtml::BUTTON_TYPE_LINK
        ));
    ?>
</p>