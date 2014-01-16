<h3> <?php echo Yum::t('The comment has been saved'); ?> </h3>

<?php 
echo BSHtml::button($model->isNewRecord ? Yum::t('Create') : Yum::t('Save'), array(
    'color' => BSHtml::BUTTON_COLOR_PRIMARY,
    'icon' =>  BSHtml::GLYPHICON_THUMBS_UP,
    'onclick' => 'window.location.reload()'
));