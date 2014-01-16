<div class="form">
<?php echo CHtml::beginForm(array('registration/ResendActivation'),'POST',array()); ?>

<div id="email">
<?php 
    if(isset($form->email))
    {
        echo CHtml::hiddenField('email',$form->email);
    }
    else
    {
        echo CHtml::activeLabelEx($user,'email');
        echo CHtml::textField('email',$form->email);
    }
?>
</div>
    <div id="resend_activation_text">
    <?php echo Yum::t("If you failed to recieve the activation email, click the Resend Activation button."); ?>
    </div>
    <?php
        echo BSHtml::submitButton(Yum::t("Resend Activation"), array(
            'color' => BSHtml::BUTTON_COLOR_PRIMARY,
            'icon' =>  BSHtml::GLYPHICON_THUMBS_UP,
        ));
    ?>

<?php echo CHtml::endForm(); ?>
</div><!-- form -->

