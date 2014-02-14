<?php 
$model = YumUser::model()->findByPk(Yii::app()->user->id);
?>
<div class="bs-sidebar hidden-xs hidden-sm affix profile well">
    <?php
    $unreadMessages = YumMessage::unread();
    $messageLabel = Yum::t('Messages');
    $messageLabel .= ($unreadMessages) ? BSHtml::badge($unreadMessages, array('pull' => BSHtml::PULL_RIGHT)) : '';
    $this->widget('bootstrap.widgets.BsListGroup', array(
        'items' => array(
            array(
                'label' => Yum::t('Profile'),
                'url' => array('//profile/profile/view'),
                'visible' => Yum::hasModule('profile'),
                'active' => Yii::app()->controller->id === 'profile',
                'items' => array(
                    array(
                        'label' => Yum::t('Friends'),
                        'url' => array('/friendship/friendship/index'),
                        'visible' => Yum::hasModule('friendship'),
                        'active' => Yii::app()->controller->id === 'friendship',
                    ),
                    array(
                        'label' => $messageLabel,
                        'url' => array('/message/message/index'),
                        'active' => Yii::app()->controller->id === 'message',
                    ),
                )
            ),
            array(
                'label' => Yum::t('Friends'),
                'url' => array('/friendship/friendship/index'),
                'visible' => Yum::hasModule('friendship'),
                'active' => Yii::app()->controller->id === 'friendship',
            ),
            array(
                'label' => $messageLabel,
                'url' => array('/message/message/index'),
                'active' => Yii::app()->controller->id === 'message',
            ),
            array(
                'label' => Yum::t('Groups'),
                'url' => array('/usergroup/groups/index'),
                'visible' => Yum::hasModule('usergroup'),
                'active' => Yii::app()->controller->id === 'groups',
            )
        ),
    ));
    ?>
</div>