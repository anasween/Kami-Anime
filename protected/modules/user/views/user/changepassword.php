<?php 
$this->pageTitle = Yum::t("Change password");

$this->breadcrumbs = array(
            Yum::t("Change password")
        );
?>
<h2><?php echo Yum::t('Change password'); ?></h2>
<?php
if(isset($expired) && $expired)
{
    $this->renderPartial('password_expired');
}
?>

<div class="form">
<?php 
$formTb = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'password-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
    'type' => 'vertical',
    'htmlOptions' => array(
        'enctype'=>'multipart/form-data',
        'class' => 'well'
    ),
));
?>
<?php echo Yum::requiredFieldNote(); ?>
<?php echo BSHtml::errorSummary($form); ?>

<?php 
if(!Yii::app()->user->isGuest) 
{
    echo $formTb->PasswordFieldControlGroup($form,'currentPassword'); 
} 
?>

<?php $this->renderPartial('application.modules.user.views.user.passwordfields', array('form'=>$form)); ?>

<?php
    echo BSHtml::submitButton(Yum::t('Save'), array(
        'color' => BSHtml::BUTTON_COLOR_PRIMARY,
        'icon' =>  BSHtml::GLYPHICON_THUMBS_UP,
    ));
?>

<?php $this->endWidget(); ?>
</div><!-- form -->
