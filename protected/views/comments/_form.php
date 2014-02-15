<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'comment-form',
    'enableAjaxValidation'=>false,
    'htmlOptions' => array(
        'enctype'=>'multipart/form-data',
        'style' => 'margin: 10px',
    ),
)); 

    if ($model->news_id)
    {
        echo CHtml::hiddenField('Comments[news_id]', $model->news_id);
    }
    elseif ($model->group_id)
    {
        echo CHtml::hiddenField('Comments[group_id]', $model->group_id);
    }
    elseif ($model->profile_id)
    {
        echo CHtml::hiddenField('Comments[profile_id]', $model->profile_id);
    }
    elseif ($model->anime_id)
    {
        echo CHtml::hiddenField('Comments[anime_id]', $model->anime_id);
    }
    echo CHtml::hiddenField('Comments[autor_id]', Yii::app()->user->id);
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