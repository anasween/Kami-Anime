<?php

Yii::setPathOfAlias('MessageModule', dirname(__FILE__));

Yii::import('MessageModule.models.*');

class MessageModule extends CWebModule {

    // System-wide configuration option on how users should be notified about
    // new internal messages by email. Available options:
    // None, Digest, Instant, User, Threshold
    // 'User' means to use the user-specific option in the user table
    public $notifyType = 'user';
    public $messageTable = '{{message}}';
    public $layout = 'application.modules.user.views.layouts.yum';
    public $dateFormat = 'Y-m-d G:i:s';
    public $inboxView = 'application.modules.message.views.message.index';
    public $inboxRoute = array('index');
    // Send a message to the user if the email changing has been succeeded
    public $notifyEmailChange = true;
    // Emails send from the message system will have this email adress as From:
    public $adminEmail = 'donotreply@kami-anime.net';
    public $controllerMap = array(
        'message' => array(
            'class' => 'MessageModule.controllers.YumMessageController'),
    );

}
