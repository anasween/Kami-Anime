<?php
/* @var $this CommentsController */
/* @var $model Comments */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id',array('maxlength'=>10)); ?>
    
    <?php
    echo $form->dropDownListControlGroup($model,'autor_id',
            CHtml::listData(YumUser::model()->findAll(), 'username', 'username'),
            array(
            )
    ); 
    ?>

    <?php echo $form->textAreaControlGroup($model,'text',array('rows'=>6)); ?>

    <?php echo $form->textFieldControlGroup($model,'createtime'); ?>

    <?php echo $form->textFieldControlGroup($model,'news_id',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'group_id',array('maxlength'=>10)); ?>
    <?php echo $form->textFieldControlGroup($model,'profile_id',array('maxlength'=>10)); ?>

        <div class="form-actions">
        <?php echo BSHtml::submitButton('Search',  array('color' => BSHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->