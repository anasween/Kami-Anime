<div class="tooltip" id="tooltip_<?php echo $data->id; ?>"> 
    <?php // $this->renderPartial('application.modules.user.views.user._tooltip', array('data' =>  $data)); ?>
</div>

<?php
$online = '';
if(Yum::hasModule('profile') && Yum::module('profile')->enablePrivacySetting) 
{
    if($data->privacy && $data->privacy->show_online_status) 
    {
        if($data->isOnline()) 
        {
            $online = true;
        }
    }
}

?>

<div class="view_user <?php echo $online ? 'online' : ''; ?>" id="user_<?php echo $data->id;?>"> 

<?php echo CHtml::link($data->getAvatar(true), array('//profile/profile/view', 'id' => $data->id)); ?>
<?php printf('<p>%s</p>', $data->username); ?>
</div>

<?php
//Yii::app()->clientScript->registerScript('tooltip_'.$data->id, "
//$('#user_{$data->id}').popover({
//'position': 'top',
//'offset': [0, -50],
//'tip': '#tooltip_{$data->id}',
//'predelay': 100,
//'fadeOutSpeed': 100,
//
//}); 
//");