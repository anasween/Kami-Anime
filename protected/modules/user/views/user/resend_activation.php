<?php 
$this->pageTitle=Yum::t("Activate");

$this->breadcrumbs=array(
	Yum::t('Login') => array('//user/user/login'),
	Yum::t('Activate')
    );

$this->title = Yum::t('Activate'); 
?>

<?php 
if(Yii::app()->user->hasFlash('registration'))
{ 
?>
<div class="success">
<?php echo Yii::app()->user->getFlash('registration'); ?>
</div>
<?php 
}
?>

<?php if($activateFromWeb): ?>
<div class="form">
<?php echo BSHtml::beginFormBs(array('registration/activation'),'GET',array()); ?> 

<div id="activatiion_code">
<?php echo Yum::t("Enter the activation code you received below."); ?>
<?php 
if(isset($form->email))
{ 
    echo CHtml::hiddenField('email',$form->email);  
}
else
{ 
    echo BSHtml::textFieldControlGroup('email',$form->email);
}
?>

<?php echo BSHtml::textFieldControlGroup('activationKey'); //fixme ?> 
</div>
<?php
    echo BSHtml::submitButton(Yum::t('Activate'), array(
        'color' => BSHtml::BUTTON_COLOR_PRIMARY,
        'icon' =>  BSHtml::GLYPHICON_THUMBS_UP,
    ));
?>
</div>
<?php echo BSHtml::endForm(); ?>
</div> <!--form -->
<?php endif;?>

<?php echo $this->renderPartial('/user/_resend_activation_partial', array('user'=>$user,'form'=>$form)); ?>
