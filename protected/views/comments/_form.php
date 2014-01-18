<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'id'=>'comment-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array(
            'enctype'=>'multipart/form-data',
            'class' => 'well'
        ),
)); ?>

<?php echo Yum::requiredFieldNote(); ?>
    
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
                'formatting', '|', 'bold', 'italic', 'deleted', '|',
                'unorderedlist', 'orderedlist', 'outdent', 'indent', '|',
                'image', 'video', 'link', '|', 'alignment', '|', 'horizontalrule'
            ),
        ),
        'htmlOptions' => array(
            'class' => 'span10',
            'rows' => 20,
        ),
    ));
    echo BSHtml::submitButton($model->isNewRecord ? Yum::t('Create') : Yum::t('Save'), array(
        'color' => BSHtml::BUTTON_COLOR_PRIMARY,
        'icon' => BSHtml::GLYPHICON_THUMBS_UP,
    ));
?>

<?php $this->endWidget(); ?>

</div>