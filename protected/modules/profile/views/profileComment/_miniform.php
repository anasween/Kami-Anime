<div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'profile-comment-form',
    'enableAjaxValidation'=>true,
    'htmlOptions' => array(
        'enctype'=>'multipart/form-data',
        'class' => 'well'
    ),
)); 
echo $form->errorSummary($model);

echo $form->textFieldControlGroup($model,'user_id');

echo $form->textFieldControlGroup($model,'profile_id'); 

echo $form->textAreaControlGroup($model,'comment',array('rows'=>6, 'cols'=>50)); 

echo $form->textFieldControlGroup($model,'createtime'); 

echo BSHtml::buttonGroup(array(
        array(
            'label' => Yum::t('Cancel'), 
            'visible'=>Yum::module('avatar')->enableGravatar,
            'color' => BSHtml::BUTTON_COLOR_DANGER,
            'icon' =>  BSHtml::GLYPHICON_THUMBS_DOWN,
            'onClick' => "$('#".$relation."_dialog').dialog('close');"
        ),
        array(
            'label' => Yum::t('Create'), 
            'color' => BSHtml::BUTTON_COLOR_PRIMARY,
            'icon' =>  BSHtml::GLYPHICON_THUMBS_UP,
            'id' => "submit_".$relation
        ),
    ));
$this->endWidget(); 

?></div> <!-- form -->
