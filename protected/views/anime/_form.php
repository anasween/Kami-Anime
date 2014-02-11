<?php
/* @var $this AnimeController */
/* @var $model Anime */
/* @var $form BSActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
        'id' => 'anime-form',
        'enableAjaxValidation' => true,
        'htmlOptions' => array(
            'class' => 'well',
            'enctype'=>'multipart/form-data'
        )
    ));
    ?>

    <?php echo Yum::requiredFieldNote(); ?>

    <?php echo $form->errorSummary($model); ?>
    
    <?php
    echo $form->LabelEx($model, 'autor_id');
    $this->widget('YumModule.components.select2.ESelect2', array(
        'model' => $model,
        'attribute' => 'autor_id',
        'value' => Yii::app()->user->id,
        'htmlOptions' => array(
            'multiple' => false,
            'style' => 'width:100%;',
         ),
        'data' => CHtml::listData(YumUser::model()->findAll(), 'id', 'username'),
    )); 
    ?>

    <?php echo $form->textFieldControlGroup($model, 'name_ru', array('maxlength' => 100)); ?>

    <?php echo $form->textFieldControlGroup($model, 'name_en', array('maxlength' => 100)); ?>

    <?php echo $form->textFieldControlGroup($model, 'name_jp', array('maxlength' => 100)); ?>
    
    <?php if($model->poster){
        echo BSHtml::imageThumbnail($model->getPoster());
    } ?>
    <?php echo $form->fileFieldControlGroup($model, 'poster'); ?>

    <?php echo $form->numberFieldControlGroup($model, 'year', array('maxlength' => 4)); ?>

    <?php 
    $this->widget('ext.imperavi-redactor-widget.ImperaviRedactorWidget', array(
            'model' => $model,
            'attribute' => 'description',
            'options' => array(
                'lang' => 'ru',
                'toolbar' => true,
                'iframe' => true,
                'css' => 'wym.css',
                'buttons' => array(
                    'html', '|', 'formatting', '|', 'bold', 'italic', 'deleted', '|',
                    'unorderedlist', 'orderedlist', 'outdent', 'indent', '|', 'alignment', '|', 'horizontalrule'
                ),
            ),
            'htmlOptions' => array(
                'rows' => 20,
            ),
        ));
        echo '<br />';
    ?>

    <?php
    echo BSHtml::submitButton($model->isNewRecord ? Yum::t('Create') : Yum::t('Save'), array('color' => BSHtml::BUTTON_COLOR_PRIMARY));
    ?>

    <?php $this->endWidget(); ?>

</div><!-- form -->