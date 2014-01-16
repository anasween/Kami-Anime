<div class="view_user">
<?php echo CHtml::link($data->getAvatar(true), array('//avatar/avatar/editAvatar', 'id' => $data->id)); ?> 
<p> <?php echo CHtml::link($data->username, array('//avatar/avatar/editAvatar', 'id' => $data->id)); ?> </p>
</div>
