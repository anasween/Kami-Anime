<div class="form">
<p class="note"> <?php echo Yum::requiredFieldNote(); ?> </p>

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
            'id'=>'profile-comment-form',
            'enableAjaxValidation'=>true,
            'htmlOptions' => array(
                'enctype'=>'multipart/form-data',
                'class' => 'well'
            ),
    )); 
echo $form->errorSummary($comment);

echo CHtml::hiddenField('YumProfileComment[profile_id]', $profile->id); ?>

<?php echo $form->textAreaControlGroup($comment,'comment',array('rows'=>6, 'cols'=>50)); ?>

<?php
echo BSHtml::submitButton(Yum::t('Write comment'), array(
            'color' => BSHtml::BUTTON_COLOR_PRIMARY,
            'icon' =>  BSHtml::GLYPHICON_THUMBS_UP,
            'id'=>'write_comment',
        ));
?>
<?php 
Yii::app()->clientScript->registerScript("write_comment", " 
    $('#write_comment').unbind('click');
    $('#write_comment').click(function(){
            jQuery.ajax({'type':'POST',
                    'url':'".$this->createUrl('//profile/comments/create')."',
                    'cache':false,
                    'data':jQuery(this).parents('form').serialize(),
                    'success':function(html){
                        window.location.reload();
                    }});
            return false;});
    ");


$this->endWidget(); ?>

</div>
