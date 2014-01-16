<?php $this->title = Yum::t('Permission Denied'); ?>
<div class="hint">
    <p> <?php echo Yum::t('You are not allowed to view this profile.'); ?> </p>
    <p> 
        <?php 
        echo BSHtml::button(Yum::t('Back to your profile'), array(
                'color' => BSHtml::BUTTON_COLOR_PRIMARY,
                'icon' =>  BSHtml::GLYPHICON_HAND_LEFT,
                'url' => array('profile/profile'),
                'type' => BSHtml::BUTTON_TYPE_LINK
            )
        );
        ?> 
    </p>
</div>
