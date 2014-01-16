<div class="miniform">
<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'yum-user-form',
    'enableAjaxValidation'=>true,
    'htmlOptions' => array(
        'enctype'=>'multipart/form-data',
        'class' => 'well'
    ),
)); 
if(isset($_POST['returnUrl']))
{
    echo CHtml::hiddenField('returnUrl', $_POST['returnUrl']);
}
echo $form->errorSummary($model);
?>
<table>
<tr>
<td><?php echo $form->labelEx($model,'username') ?></td>
<td><?php echo $form->textField($model,'username',array('size'=>20,'maxlength'=>20)) ?></td>
<td><?php echo $form->error($model,'username') ?></td>
</tr>
<tr>
<td><?php echo $form->labelEx($model,'password') ?></td>
<td><?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>128)) ?></td>
<td><?php echo $form->error($model,'password') ?></td>
</tr>
<tr>
<td><?php echo $form->labelEx($model,'activationKey') ?></td>
<td><?php echo $form->textField($model,'activationKey',array('size'=>60,'maxlength'=>128)) ?></td>
<td><?php echo $form->error($model,'activationKey') ?></td>
</tr>
<tr>
<td><?php echo $form->labelEx($model,'createtime') ?></td>
<td><?php echo $form->textField($model,'createtime') ?></td>
<td><?php echo $form->error($model,'createtime') ?></td>
</tr>
<tr>
<td><?php echo $form->labelEx($model,'lastvisit') ?></td>
<td><?php echo $form->textField($model,'lastvisit') ?></td>
<td><?php echo $form->error($model,'lastvisit') ?></td>
</tr>
<tr>
<td><?php echo $form->labelEx($model,'lastpasswordchange') ?></td>
<td><?php echo $form->textField($model,'lastpasswordchange') ?></td>
<td><?php echo $form->error($model,'lastpasswordchange') ?></td>
</tr>
<tr>
<td><?php echo $form->labelEx($model,'superuser') ?></td>
<td><?php echo $form->textField($model,'superuser') ?></td>
<td><?php echo $form->error($model,'superuser') ?></td>
</tr>
<tr>
<td><?php echo $form->labelEx($model,'status') ?></td>
<td><?php echo $form->textField($model,'status') ?></td>
<td><?php echo $form->error($model,'status') ?></td>
</tr>
</table>	
<?php
echo BSHtml::buttonGroup(array(
        array(
            'label' => Yum::t('Cancel'), 
            'onClick' => "$('#dialog_yumuser').dialog('close');",
            'color' => BSHtml::BUTTON_COLOR_DANGER,
            'icon' =>  BSHtml::GLYPHICON_THUMBS_DOWN,
        ),
        array(
        'own' =>
            BSHtml::ajaxSubmitButton(Yum::t('Create'), 
                array('yumuser/miniCreate'), 
                array('update' => "#dialog_yumuser"), 
                array(
                'color' => BSHtml::BUTTON_COLOR_PRIMARY,
                'icon' =>  BSHtml::GLYPHICON_THUMBS_UP,
                'id' => 'submit_yumuser'
            )),
        )
    ));
$this->endWidget(); 

?></div> <!-- form -->
