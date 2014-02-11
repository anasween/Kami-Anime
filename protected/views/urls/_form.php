<?php
/* @var $this UrlsController */
/* @var $model Urls */
/* @var $form BSActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
        'id' => 'urls-form',
        'enableAjaxValidation' => true,
        'htmlOptions' => array(
            'class' => 'well'
        )
    ));
    ?>

    <?php echo Yum::requiredFieldNote(); ?>

    <?php echo $form->errorSummary($model); ?>
    
    <?php
    echo $form->LabelEx($model, 'anime_id');
    $this->widget('YumModule.components.select2.ESelect2', array(
        'model' => $model,
        'attribute' => 'anime_id',
        'htmlOptions' => array(
            'multiple' => false,
            'style' => 'width:100%;',
         ),
        'data' => CHtml::listData(Anime::model()->findAll(), 'id', 'name_ru'),
    )); 
    ?>
    
    <?php
    echo $form->LabelEx($model, 'site_id');
    $this->widget('YumModule.components.select2.ESelect2', array(
        'model' => $model,
        'attribute' => 'site_id',
        'htmlOptions' => array(
            'multiple' => false,
            'style' => 'width:100%;',
         ),
        'data' => CHtml::listData(Sites::model()->findAll(), 'id', 'title'),
    )); 
    ?>

    <?php echo $form->textFieldControlGroup($model, 'url', array('maxlength' => 250)); ?>

    <?php
    echo BSHtml::submitButton($model->isNewRecord ? Yum::t('Create') : Yum::t('Save'), array(
        'color' => BSHtml::BUTTON_COLOR_PRIMARY,
        'icon' => BSHtml::GLYPHICON_THUMBS_UP,
    ));
    ?>

    <?php $this->endWidget(); ?>

</div><!-- form -->