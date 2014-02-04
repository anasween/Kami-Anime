<?php 
$model = YumUser::model()->findByPk(Yii::app()->user->id);
?>
<div class="bs-sidebar hidden-xs hidden-sm affix profile">
    <?php echo $model->getAvatar(true); ?>
    <div class="shortinfo">
        <a href=""><?php echo $model->username; ?></a>
    </div>
    <div class="clearfix"></div>
    <?php
    echo BSHtml::stackedPills(array(
        array(
            'label' => Yum::t('Profile'),
            'url' => array('//profile/profile/view'),
            'visible' => Yum::hasModule('profile'),
            'active' => Yii::app()->controller->id === 'profile',
        ),
        array(
            'label' => Yum::t('Friends'),
            'url' => array('/friendship/friendship/index'),
            'visible' => Yum::hasModule('friendship'),
            'active' => Yii::app()->controller->id === 'friendship',
        ),
        array(
            'label' => Yum::t('Messages') . BSHtml::badge(YumMessage::unread(), array('pull' => BSHtml::PULL_RIGHT)),
            'url' => array('/message/message/index'),
            'active' => Yii::app()->controller->id === 'message',
        ),
        array(
            'label' => Yum::t('Groups'),
            'url' => array('/usergroup/groups/index'),
            'visible' => Yum::hasModule('usergroup'),
            'active' => Yii::app()->controller->id === 'groups',
        )
    ));
    ?>
</div>