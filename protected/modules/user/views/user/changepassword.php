<?php 
$this->pageTitle = Yum::t("Change password");

$this->breadcrumbs = array(
            Yum::t("Change password")
        );
echo '<div class="well">';
echo BSHtml::pageHeader(Yum::t('Change password'));

if(isset($expired) && $expired)
{
    $this->renderPartial('password_expired');
}
?>

<div class="form">
<?php 
$formBs = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'password-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
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
    echo $formBs->PasswordFieldControlGroup($form,'currentPassword'); 
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
<?php
echo '</div>';
