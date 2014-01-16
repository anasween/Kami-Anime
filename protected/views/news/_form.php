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
    <?php echo $form->dropDownListControlGroup($model,'autor_id',
            CHtml::listData(YumUser::model()->findAll(), 'id', 'username'),
            array(
                'val' => Yii::app()->user->id,
            )
    ); ?>
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
                'class' => 'span10',
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
