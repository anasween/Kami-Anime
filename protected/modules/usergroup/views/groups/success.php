<div class="well">
<?php 
echo Yum::t('The Usergroup {groupname} has been successfully created', array('groupname' => $model))
?>

<?php 
echo BSHtml::buttonGroup(array(
    array(
        'label' => Yum::t('Back'), 
        'url' => array('id' => $relation.'_done'),
        'color' => BSHtml::BUTTON_COLOR_PRIMARY,
        'icon' =>  BSHtml::GLYPHICON_HAND_LEFT,
        'type' => BSHtml::BUTTON_TYPE_LINK
    ),
    array(
        'label' => Yum::t('Add another Usergroup'), 
        'url' => array('id' => $relation.'_create'),
        'color' => BSHtml::BUTTON_COLOR_SUCCESS,
        'icon' =>  BSHtml::GLYPHICON_PLUS,
        'type' => BSHtml::BUTTON_TYPE_LINK
    )
));
?>
</div>