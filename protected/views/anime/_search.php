<?php
/* @var $this AnimeController */
/* @var $model Anime */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
    ));
    ?>

    <?php echo $form->textFieldControlGroup($model, 'name_ru', array('maxlength' => 100)); ?>

    <?php echo $form->textFieldControlGroup($model, 'name_en', array('maxlength' => 100)); ?>

    <?php echo $form->textFieldControlGroup($model, 'name_jp', array('maxlength' => 100)); ?>

    <?php echo $form->textFieldControlGroup($model, 'autor_id', array('maxlength' => 10)); ?>

    <div class="form-actions">
    <?php echo BSHtml::submitButton(Yum::t('Search'), array('color' => BSHtml::BUTTON_COLOR_PRIMARY,)); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->