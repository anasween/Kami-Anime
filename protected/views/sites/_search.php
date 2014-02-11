<?php
/* @var $this SitesController */
/* @var $model Sites */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

    <?php echo $form->textFieldControlGroup($model,'title',array('maxlength'=>255)); ?>

    <div class="form-actions">
        <?php echo BSHtml::submitButton(Yum::t('Search'),  array('color' => BSHtml::BUTTON_COLOR_PRIMARY,));?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->