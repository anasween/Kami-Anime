<div class="form">
<?php 
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'user-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'htmlOptions' => array(
        'enctype'=>'multipart/form-data',
        'class' => 'well'
    ),
));
?>

<?php
// If errors occured, display errors for all involved models
$models = array($user, $passwordform);
if(isset($profile) && $profile !== false)
{
    $models[] = $profile;
}
$hasErrors = false;
foreach($models as $m)
{
    if($m->hasErrors())
    {
	$hasErrors = true;
        break;
    }
}
if($hasErrors) 
{
    echo '<div class="alert alert-error">';
    echo BsHtml::errorSummary($models);
    echo '</div>';
}
unset($hasErrors);
?>

<?php echo Yum::requiredFieldNote(); ?>
<div class="col-md-5">

<?php echo $form->textFieldControlGroup($user, 'username'); ?>

<?php echo $form->dropDownListControlGroup($user,'status',YumUser::itemAlias('UserStatus')); ?>

<?php echo $form->dropDownListControlGroup($user, 'superuser',YumUser::itemAlias('AdminStatus')); ?>
    
<p>
<?php 
if ($user->isNewRecord) 
{
    echo Yum::t('Leave password empty to generate a random Password'); 
}
else
{
   echo Yum::t('Leave password empty to keep it unchanged');  
}
?>
</p>

<?php $this->renderPartial('/user/passwordfields', array(
			'form'=>$passwordform)); ?>

<?php if(Yum::hasModule('role')) { 
    Yii::import('application.modules.role.models.*');
?>
<div class="roles" style="margin-bottom: 10px;">
<label> <?php echo Yum::t('User belongs to these roles'); ?> </label>

<?php 
$this->widget('YumModule.components.select2.ESelect2', array(
    'model' => $user,
    'attribute' => 'roles',
    'htmlOptions' => array(
            'multiple' => 'multiple',
            'style' => 'width:100%;'),
    'data' => CHtml::listData(YumRole::model()->findAll(), 'id', 'title'),
)); 
?>
</div>
<?php } ?>

</div>

<div class="col-md-6">
<?php 
if(Yum::hasModule('profile')) 
{
    $this->renderPartial(Yum::module('profile')->profileFormView, array(
        'profile' => $profile, 
        'form' => $form)
    ); 
}?>
</div>

<div class="clearfix"></div>

<?php
    echo BSHtml::submitButton($user->isNewRecord ? Yum::t('Create') : Yum::t('Save'), array(
        'color' => BSHtml::BUTTON_COLOR_PRIMARY,
        'icon' =>  BSHtml::GLYPHICON_THUMBS_UP,
    ));
?>

<?php $this->endWidget(); ?>
</div>
<div class="clearfix"></div>
