<?php 
$this->pageTitle = Yum::t("Profile");
$this->breadcrumbs = array(
            Yum::t('Edit profile')
        );
$this->title = Yum::t('Edit profile');
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'profile-form',
    'enableAjaxValidation'=>true,
    'htmlOptions' => array(
        'enctype'=>'multipart/form-data',
        'class' => 'well'
    ),
)); ?>

<?php echo Yum::requiredFieldNote(); ?>

<?php echo $form->errorSummary(array($user, $profile)); ?>

<?php 
if(Yum::module()->loginType & UserModule::LOGIN_BY_USERNAME) 
{ 
    echo $form->TextFieldControlGroup($user,'username',array('size'=>20,'maxlength'=>20)); 
} 
?> 

<?php 
if(isset($profile) && is_object($profile)) 
{
    $this->renderPartial('/profile/_form', array('profile' => $profile, 'form'=>$form)); 
}
?>
	
    <div>
	<?php
        echo BSHtml::buttonGroup(array(
            array(
                'label' => Yum::t('Privacy settings'), 
                'url' => array('/profile/privacy/update'), 
                'visible'=>Yum::module('profile')->enablePrivacySetting,
                'color' => BSHtml::BUTTON_COLOR_INFO,
                'icon' =>  BSHtml::GLYPHICON_COG,
                'type' => BSHtml::BUTTON_TYPE_LINK
            ),
            array(
                'label' => Yum::t('Upload avatar Image'), 
                'url' => array('/avatar/avatar/editAvatar'),
                'visible'=>Yum::hasModule('avatar'),
                'color' => BSHtml::BUTTON_COLOR_INFO,
                'icon' =>  BSHtml::GLYPHICON_UPLOAD,
                'type' => BSHtml::BUTTON_TYPE_LINK
            ),
            array(
            'own' =>
                BSHtml::submitButton($user->isNewRecord ? Yum::t('Create my profile') : Yum::t('Save profile changes'), array(
                    'color' => BSHtml::BUTTON_COLOR_PRIMARY,
                    'icon' =>  BSHtml::GLYPHICON_THUMBS_UP,
                )),
            )
        ));?>

	<?php $this->endWidget(); ?>
    </div>
</div><!-- form -->
