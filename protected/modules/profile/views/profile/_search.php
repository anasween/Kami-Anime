<div class="wide form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'htmlOptions' => array(
        'enctype'=>'multipart/form-data',
        'class' => 'well',
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
    ),
)); ?>

<?php echo $form->textFieldControlGroup($model,'id',array('size'=>25,'maxlength'=>255)); ?>

<?php echo $form->textFieldControlGroup($model,'user_id',array('size'=>25,'maxlength'=>255)); ?>

<?php echo $form->textFieldControlGroup($model,'timestamp',array('size'=>25,'maxlength'=>255)); ?>

<?php echo $form->textFieldControlGroup($model,'privacy',array('size'=>25,'maxlength'=>255)); ?>

<?php echo $form->textFieldControlGroup($model,'email',array('size'=>25,'maxlength'=>255)); ?>

<?php 
echo BSHtml::submitButton(Yum::t('Search'), array(
            'color' => BSHtml::BUTTON_COLOR_PRIMARY,
            'icon' =>  BSHtml::GLYPHICON_SEARCH,
        ));
?>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
