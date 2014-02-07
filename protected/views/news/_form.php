<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'id'=>'news-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array(
            'enctype'=>'multipart/form-data',
            'class' => 'well'
        ),
)); ?>

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
    <?php echo $form->textFieldControlGroup($model,'title',array('maxlength'=>100))?>
    <?php 
        $this->widget('ext.imperavi-redactor-widget.ImperaviRedactorWidget', array(
            'model' => $model,
            'attribute' => 'text',
            'options' => array(
                'lang' => 'ru',
                'toolbar' => true,
                'iframe' => true,
                'css' => 'wym.css',
                'buttons' => array(
                    'html', '|', 'formatting', '|', 'bold', 'italic', 'deleted', '|',
                    'unorderedlist', 'orderedlist', 'outdent', 'indent', '|',
                    'image', 'video', 'link', '|', '|', 'alignment', '|', 'horizontalrule'
                ),
            ),
            'htmlOptions' => array(
                'rows' => 20,
            ),
        ));
        echo '<br />';
    echo BSHtml::submitButton($model->isNewRecord ? Yum::t('Create') : Yum::t('Save'), array(
            'color' => BSHtml::BUTTON_COLOR_PRIMARY,
            'icon' => BSHtml::GLYPHICON_THUMBS_UP,
        ));
    ?>

<?php $this->endWidget(); ?>

</div>
