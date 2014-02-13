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
    
    <?php echo BSHtml::tag('div', array('id' => 'urlsAlert'), ''); ?>

    <?php echo Yum::requiredFieldNote(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php
    echo CHtml::hiddenField('Urls[anime_id]', '0');
    ?>

    <?php
    echo $form->dropDownListControlGroup($model, 'site_id', CHtml::listData(Sites::model()->findAll(), 'id', 'title'));
    ?>

    <?php echo $form->textFieldControlGroup($model, 'url', array('maxlength' => 250)); ?>
    
    <?php echo BSHtml::ajaxSubmitButton(Yum::t('Update'), array('/anime/editUrl'), array(
        'type' => 'POST',
        'update' => '#urlsAlert'
    ), array(
        'id' => 'urlsEditbtn'
    )); ?>
    
    <?php echo BSHtml::ajaxSubmitButton(Yum::t('Add'), array('/anime/createUrl'), array(
        'type' => 'POST',
        'update' => '#urlsAlert'
    ), array(
        'id' => 'urlsAddbtn'
    )); ?>

    <?php $this->endWidget(); ?>

</div>
