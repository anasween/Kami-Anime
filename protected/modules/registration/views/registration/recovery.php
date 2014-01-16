<?php 
$this->pageTitle = Yum::t('Password recovery');

$this->breadcrumbs=array(
	Yum::t('Login') => Yum::module()->loginUrl,
	Yum::t('Restore')
    );

?>
<?php if(Yum::hasFlash()) {
echo '<div class="success">';
echo Yum::getFlash(); 
echo '</div>';
} else {
echo '<h2>'.Yum::t('Password recovery').'</h2>';
?>

<div class="form">
<?php echo BSHtml::beginFormBs(); ?>

    <?php echo BSHtml::errorSummary($form); ?>

    <?php echo BSHtml::activeTextFieldControlGroup($form,'login_or_email', array(
        'hint' => Yum::t("Please enter your user name or email address.")
    )) ?>
	
    <?php
        echo BSHtml::submitButton(Yum::t('Restore'), array(
            'color' => BSHtml::BUTTON_COLOR_PRIMARY,
            'icon' =>  BSHtml::GLYPHICON_THUMBS_UP,
        ));
    ?>

<?php echo BSHtml::endForm(); ?>
</div><!-- form -->
<?php } ?>
