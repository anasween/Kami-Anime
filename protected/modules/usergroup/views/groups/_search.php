<div class="wide form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
    'htmlOptions' => array(
        'enctype'=>'multipart/form-data',
        'class' => 'well'
    ),
)); ?>

    <?php echo $form->textFieldControlGroup($model,'id'); ?>
    <?php echo $form->textFieldControlGroup($model,'owner_id'); ?>
    <?php echo $form->textFieldControlGroup($model,'title',array('size'=>60,'maxlength'=>255)); ?>
    <?php echo $form->textAreaControlGroup($model,'description',array('rows'=>6, 'cols'=>50)); ?>
    
    <?php
        echo BSHtml::submitButton(Yum::t('Search'), array(
            'color' => BSHtml::BUTTON_COLOR_INFO,
            'icon' =>  BSHtml::GLYPHICON_SEARCH,
        ));
    ?>
    
<?php $this->endWidget(); ?>

</div><!-- search-form -->
