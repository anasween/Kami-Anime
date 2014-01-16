<?php if(Yum::module()->enablepStrength) 
{  
    Yum::register('js/pStrength.jquery.js'); 
    Yii::app()->clientScript->registerScript('', "
            $('#YumUserChangePassword_password').pStrength({
                    'onPasswordStrengthChanged' : function(passwordStrength, percentage) {
                    $('#password-strength').html('".Yum::t('Password strength').":' + percentage + '%');
                    },
    });
    ");
}
?>
<?php echo BSHtml::activePasswordFieldControlGroup($form,'password'); ?>

<?php if(Yum::module()->displayPasswordStrength) { ?>
    <div id="password-strength"></div>
<?php } ?>

<?php echo BSHtml::activePasswordFieldControlGroup($form,'verifyPassword'); 