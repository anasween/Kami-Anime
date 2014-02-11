<?php
/* @var $this SitesController */
/* @var $model Sites */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
        'id' => 'sites-form',
        'enableAjaxValidation' => true,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
            'class' => 'well'
        ),
    ));
    ?>

    <?php echo Yum::requiredFieldNote(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldControlGroup($model, 'title', array('maxlength' => 100)) ?>
    <?php echo $model->getLogo(); ?>
    <?php echo $form->fileFieldControlGroup($model, 'logo') ?>
    <?php
    echo BSHtml::submitButton($model->isNewRecord ? Yum::t('Create') : Yum::t('Save'), array(
        'color' => BSHtml::BUTTON_COLOR_PRIMARY,
        'icon' => BSHtml::GLYPHICON_THUMBS_UP,
    ));
    ?>

<?php $this->endWidget(); ?>

</div><!-- form -->
