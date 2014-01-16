<?php
$this->pageTitle = Yum::t('Login');
$this->title = Yum::t('Login');
$this->breadcrumbs = array(
            Yum::t('Login')   
        );?>
<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
    'id'=>'auth-form',
    'enableAjaxValidation'=>true,
    'htmlOptions' => array(
        'enctype'=>'multipart/form-data',
        'class' => 'well'
    ),
)); ?>

<div class="row">
    
    <?php echo $form->errorSummary($model); ?>

    <div class="col-md-5 loginform">
        <p> <?php echo Yum::t('Please fill out the following form with your login credentials:'); ?> </p>

        <?php echo $form->TextFieldControlGroup($model,'username', array('class'=>'span10','labelOptions'=>array('label'=>'Логин или E-mail'))) ?>

        <?php echo $form->PasswordFieldControlGroup($model,'password', array('class'=>'span10','labelOptions'=>array('label'=>Yum::t('Password')))); ?>

        <?php if ($model->scenario == 'captcha' && CCaptcha::checkRequirements()) { ?>
         <div>
                <?php $this->widget('CCaptcha'); ?>
                <?php echo $form->TextFieldControlGroup($model, 'verifyCode', array('class'=>'span10')); ?>
        </div>
        <?php } ?>
        <?php
            echo BSHtml::submitButton(Yum::t("Login"), array(
                'color' => BSHtml::BUTTON_COLOR_PRIMARY,
                'icon' =>  BSHtml::GLYPHICON_THUMBS_UP,
            ));
        ?>
    </div>

    <?php if(Yum::module()->loginType & UserModule::LOGIN_BY_HYBRIDAUTH 
                    && Yum::module()->hybridAuthProviders) { ?>
        <div class="col-md-5 hybridauth">
        <?php echo Yum::t('You can also login by') . ': <br />'; 
        foreach(Yum::module()->hybridAuthProviders as $provider) 
                echo CHtml::link(
                                CHtml::image(
                                        Yii::app()->getAssetManager()->publish(
                                                Yii::getPathOfAlias(
                                                        'application.modules.user.assets.images').'/'.strtolower($provider).'.png'),
                                        $provider) . $provider, $this->createUrl(
                                                '//user/auth/login', array('hybridauth' => $provider)), array(
                                                'class' => 'social')) . '<br />'; 
        ?>
        </div>

    <div class="clearfix"></div>

    <?php } ?>

    <div class="col-md-10">
        <p class="hint">
            <?php 
            if(Yum::hasModule('registration'))
            {
                echo BSHtml::buttonGroup(array(
                    array(
                        'label' => Yum::t("Registration"), 
                        'url' => Yum::module('registration')->registrationUrl, 
                        'visible' => Yum::module('registration')->enableRegistration,
                        'color' => BSHtml::BUTTON_COLOR_SUCCESS,
                        'icon' =>  BSHtml::GLYPHICON_PLUS,
                        'type' => BSHtml::BUTTON_TYPE_LINK
                    ),
                    array(
                        'label' => Yum::t("Lost password?"), 
                        'url' => Yum::module('registration')->recoveryUrl,
                        'visible' => Yum::module('registration')->enableRecovery,
                        'color' => BSHtml::BUTTON_COLOR_WARNING,
                        'icon' =>  BSHtml::GLYPHICON_LOCK,
                        'type' => BSHtml::BUTTON_TYPE_LINK
                    )
                ));
            }
            ?>
        </p>
    </div>
</div>
<?php $this->endWidget(); ?>