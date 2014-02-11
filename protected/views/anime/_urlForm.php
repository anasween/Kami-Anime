<div class="form">

    <?php
    $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
        'id' => 'urls-form-' . $id,
        'enableAjaxValidation' => true,
        'htmlOptions' => array(
            'class' => 'well'
        )
    ));
    ?>
    
    <?php echo BSHtml::tag('div', array('id' => 'urls-alert-'.$id), ''); ?>

    <?php echo Yum::requiredFieldNote(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php
    echo CHtml::hiddenField('Urls[anime_id]', $id);
    ?>

    <?php
    echo $form->dropDownListControlGroup($model, 'site_id', CHtml::listData(Sites::model()->findAll(), 'id', 'title'));
    ?>

    <?php echo $form->textFieldControlGroup($model, 'url', array('maxlength' => 250)); ?>
    
    <?php echo BSHtml::ajaxSubmitButton(Yum::t('Add'), array('/anime/createUrl'), array(
        'type' => 'POST',
        'update' => '#urls-alert-'.$id
    )); ?>

    <?php $this->endWidget(); ?>

</div>
