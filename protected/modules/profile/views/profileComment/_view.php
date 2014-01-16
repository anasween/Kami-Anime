<div class="guestbook">
    <div class="guestbook-header">
        <strong><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</strong>
        <?php echo CHtml::link(CHtml::encode($data->user->username), array('//profile/profile/view', 'id' => $data->user_id)); ?>
        |
        <strong><?php echo CHtml::encode($data->getAttributeLabel('createtime')); ?>:</strong>
        <?php $locale = CLocale::getInstance(Yii::app()->language);
        echo $locale->getDateFormatter()->formatDateTime($data->createtime, 'medium', 'medium'); ?>
    </div>
	
    <div class="row" style="margin: 5px 0;">
        <div class="guestbook-avatar col-md-1">
            <?php echo $data->user->getAvatar(true); ?>
	</div>

	<div class="guestbook-comment col-md-11">
            <?php echo CHtml::encode($data->comment); ?>
	</div>
   </div>
	
    <div class="guestbook-footer" style="text-align: right;">
    <?php
        // the owner of the profile as well as the owner of the comment can remove
        if($data->user_id == Yii::app()->user->id || $data->profile_id == Yii::app()->user->id) 
        {
            $url = Yii::app()->createAbsoluteUrl('//profile/comments/delete', array('id'=>$data->id));
            echo BSHtml::submitButton(Yum::t('Remove comment'), array(
                'color' => BSHtml::BUTTON_COLOR_DANGER,
                'icon' => BSHtml::GLYPHICON_MINUS,
                'onclick'=>'js:bootbox.confirm("'.Yum::t('Are you sure to remove this comment from your profile?').'",
                    function(confirmed){
                       if(confirmed) {
                          window.location = "'.$url.'";
                       }
                    })'
            ));
        }		
    ?>
    </div>

</div>
