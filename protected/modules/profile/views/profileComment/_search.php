<div class="wide form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'htmlOptions' => array(
        'enctype'=>'multipart/form-data',
        'class' => 'well',
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
    ), 
)); ?>

<?php echo $form->textFieldControlGroup($model,'id'); ?>
    
<?php echo $form->textFieldControlGroup($model,'user_id'); ?>
    
<?php echo $form->textFieldControlGroup($model,'profile_id'); ?>
    
<?php echo $form->textAreaControlGroup($model,'comment',array('rows'=>6, 'cols'=>50)); ?>
    
<?php echo $form->textFieldControlGroup($model,'createtime'); ?>
    
<?php 
echo BSHtml::submitButton(Yum::t('Search'), array(
            'color' => BSHtml::BUTTON_COLOR_PRIMARY,
            'icon' =>  BSHtml::GLYPHICON_SEARCH,
        ));
?>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
