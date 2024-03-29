<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/main';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    public function filters() {
        return array(
            'accessControl',
            'postOnly + delete'
        );
    }

    public function getUserMenu() {
        if (Yii::app()->user->isGuest) {
            $unreadMessages = '';
        } else {
            $unreadMessages = (YumMessage::unread() > 0) ? ' [' . YumMessage::unread() . ']' : '';
        }
        return array(
            array(
                'label' => Yum::t('Administration'),
                'url' => array('#'),
                'visible' => Yii::app()->user->can("admin"),
                'items' => array(
                    BSHtml::menuText(
                            Yum::t('Manage'), array('pull' => BSHtml::NAVBAR_NAV_PULL_RIGHT)
                    ),
                    array(
                        'label' => Yum::t('User administration'),
                        'url' => array('//user/user/admin'),
                        'visible' => Yum::hasModule('user') && Yii::app()->user->can("user", "admin")
                    ),
                    array(
                        'label' => Yum::t('Avatar administration'),
                        'url' => array('//avatar/avatar/admin'),
                        'visible' => Yum::hasModule('avatar') && Yii::app()->user->can("avatar", "admin")
                    ),
                    array(
                        'label' => Yum::t('Manage roles'),
                        'url' => array('//role/role/admin'),
                        'visible' => Yum::hasModule('role') && Yii::app()->user->can("role", "admin")
                    ),
                    array(
                        'label' => Yum::t('Manage permissions'),
                        'url' => array('//role/permission/admin'),
                        'visible' => Yum::hasModule('role') && Yii::app()->user->can("role", "admin")
                    ),
                    array(
                        'label' => Yum::t('Manage actions'),
                        'url' => array('//role/action/admin'),
                        'visible' => Yum::hasModule('role') && Yii::app()->user->can("role", "admin")
                    ),
                    array(
                        'label' => Yum::t('Manage friendships'),
                        'url' => array('//friendship/friendship/admin'),
                        'visible' => Yum::hasModule('friendship') && Yii::app()->user->can("friendship", "admin")
                    ),
                    array(
                        'label' => Yum::t('Ordered memberships'),
                        'url' => array('//membership/membership/admin'),
                        'visible' => Yum::hasModule('membership') && Yii::app()->user->can("membership", "admin")
                    ),
                    array(
                        'label' => Yum::t('Payment types'),
                        'url' => array('//membership/payment/admin'),
                        'visible' => Yum::hasModule('membership') && Yii::app()->user->can("membership", "admin")
                    ),
                    array(
                        'label' => Yum::t('Manage profiles'),
                        'url' => array('//profile/profile/admin'),
                        'visible' => Yum::hasModule('profile') && Yii::app()->user->can("profile", "admin")
                    ),
                    array(
                        'label' => Yum::t('Text translations'),
                        'url' => array('//user/translation/admin'),
                        'visible' => Yii::app()->user->can("translation", "admin")
                    ),
                    array(
                        'label' => Yum::t('Show profile visits'),
                        'url' => array('//profile/profile/visits'),
                        'visible' => Yii::app()->user->isAdmin()
                    ),
                    array(
                        'label' => Yum::t('Statistics'),
                        'url' => array('//user/statistics/index'),
                        'visible' => Yii::app()->user->isAdmin()
                    ),
                    array(
                        'label' => Yum::t('Manage news'),
                        'url' => array('/news/admin'),
                        'visible' => Yii::app()->user->can("news", "admin")
                    ),
                    array(
                        'label' => Yum::t('Manage comments'),
                        'url' => array('/comments/admin'),
                        'visible' => Yii::app()->user->can("comments", "admin")
                    ),
                    array(
                        'label' => Yum::t('Manage zhanrs'),
                        'url' => array('/zhanrs/admin'),
                        'visible' => Yii::app()->user->can("zhanrs", "admin")
                    ),
                    array(
                        'label' => Yum::t('Manage anime'),
                        'url' => array('/anime/admin'),
                        'visible' => Yii::app()->user->can("anime", "admin")
                    ),
                    array(
                        'label' => Yum::t('Manage sites'),
                        'url' => array('/sites/admin'),
                        'visible' => Yii::app()->user->can("sites", "admin")
                    ),
                )
            ),
            array(
                'label' => Yum::t('Create menu'),
                'url' => array('#'),
                'visible' => Yii::app()->user->can("create"),
                'items' => array(
                    BSHtml::menuText(
                            Yum::t('Creating'), array(
                        'pull' => BSHtml::NAVBAR_NAV_PULL_RIGHT,
                        'visible' => Yii::app()->user->can("create"),
                            )
                    ),
                    array(
                        'label' => Yum::t('Create new user'),
                        'url' => array('//user/user/create'),
                        'visible' => Yum::hasModule('user') && Yii::app()->user->can("user", "create")
                    ),
                    array(
                        'label' => Yum::t('Generate demo data'),
                        'url' => array('//user/user/generateData'),
                        'visible' => Yum::module()->debug
                    ),
                    array(
                        'label' => Yum::t('Create new role'),
                        'url' => array('//role/role/create'),
                        'visible' => Yum::hasModule('role') && Yii::app()->user->can("role", "create")
                    ),
                    array(
                        'label' => Yum::t('Grant permission'),
                        'url' => array('//role/permission/create'),
                        'visible' => Yum::hasModule('role') && Yii::app()->user->can("role", "create")
                    ),
                    array(
                        'label' => Yum::t('Create new action'),
                        'url' => array('//role/action/create'),
                        'visible' => Yum::hasModule('role') && Yii::app()->user->can("role", "create")
                    ),
                    array(
                        'label' => Yum::t('Create new payment type'),
                        'url' => array('//membership/payment/create'),
                        'visible' => Yum::hasModule('membership') && Yii::app()->user->can("membership", "create")
                    ),
                    array(
                        'label' => Yum::t('Create new usergroup'),
                        'url' => array('/usergroup/groups/create'),
                        'visible' => Yum::hasModule('usergroup') && Yii::app()->user->can("usergroup", "create")
                    ),
                    array(
                        'label' => Yum::t('Create new news'),
                        'url' => array('/news/create'),
                        'visible' => Yii::app()->user->can("news", "create")
                    ),
                    array(
                        'label' => Yum::t('Create new comment'),
                        'url' => array('/comments/create'),
                        'visible' => Yii::app()->user->can("comment", "create")
                    ),
                    array(
                        'label' => Yum::t('Create new zhanr'),
                        'url' => array('/zhanrs/create'),
                        'visible' => Yii::app()->user->can("zhanrs", "create")
                    ),
                    array(
                        'label' => Yum::t('Create new anime'),
                        'url' => array('/anime/create'),
                        'visible' => Yii::app()->user->can("anime", "create")
                    ),
                    array(
                        'label' => Yum::t('Create new site'),
                        'url' => array('/sites/create'),
                        'visible' => Yii::app()->user->can("sites", "create")
                    ),
                )
            ),
            array(
                'label' => Yum::t('Profile'),
                'visible' => Yum::hasModule('profile') && !Yii::app()->user->isGuest,
                'url' => array('#'),
                'items' => array(
                    BSHtml::menuText(
                            Yum::t('Signed in as') . ' ' . BSHtml::link(
                                    Yii::app()->user->loggedInAs(), array('site/user', 'id' => Yii::app()->user->id), array('class' => 'navbar-link')
                            ), array('pull' => BSHtml::NAVBAR_NAV_PULL_RIGHT)
                    ),
                    array(
                        'label' => Yum::t('My profile'),
                        'url' => array('//profile/profile/view'),
                        'visible' => Yum::hasModule('profile'),
                    ),
                    array(
                        'label' => Yum::t('Edit personal data'),
                        'url' => array('//profile/profile/update'),
                        'visible' => Yum::hasModule('profile'),
                    ),
                    array(
                        'label' => Yum::t('Upload avatar image'),
                        'url' => array('/avatar/avatar/editAvatar'),
                        'visible' => Yum::hasModule('avatar'),
                    ),
                    array(
                        'label' => Yum::t('Privacy settings'),
                        'url' => array('/profile/privacy/update'),
                        'visible' => Yum::hasModule('profile'),
                    ),
                    array(
                        'label' => Yum::t('My friends'),
                        'url' => array('/friendship/friendship/index'),
                        'visible' => Yum::hasModule('friendship')
                    ),
                    array(
                        'label' => Yum::t('Browse users'),
                        'url' => array('/user/user/browse'),
                        'visible' => Yum::hasModule('user'),
                    ),
                    array(
                        'label' => Yum::t('My groups'),
                        'url' => array('/usergroup/groups/index'),
                        'visible' => Yum::hasModule('usergroup')
                    ),
                    array(
                        'label' => Yum::t('Browse usergroups'),
                        'url' => array('/usergroup/groups/browse'),
                        'visible' => Yum::hasModule('usergroup')
                    ),
                )
            ),
            array(
                'label' => Yum::t('Messages') . $unreadMessages,
                'visible' => Yum::hasModule('message') && !Yii::app()->user->isGuest,
                'url' => array('#'),
                'class' => 'visible-sm visible-xs',
                'items' => array(
                    BSHtml::menuText(
                            Yum::t('Messages'), array('pull' => BSHtml::NAVBAR_NAV_PULL_RIGHT)
                    ),
                    array('label' => Yum::t('Admin inbox'), 'url' => array('/message/message/index')),
                    array('label' => Yum::t('Sent messages'), 'url' => array('/message/message/sent')),
                    array('label' => Yum::t('Write a message'), 'url' => array('/message/message/compose')),
                ),
            ),
            array(
                'label' => Yum::t('Misc'),
                'url' => array('#'),
                'visible' => !Yii::app()->user->isGuest,
                'items' => array(
                    BSHtml::menuText(
                            Yum::t('Misc'), array('pull' => BSHtml::NAVBAR_NAV_PULL_RIGHT)
                    ),
                    array(
                        'label' => Yum::t('Upload avatar for admin'), 'url' => array('//avatar/avatar/editAvatar'),
                        'visible' => Yum::hasModule('avatar')
                    ),
                    array(
                        'label' => Yum::t('Change admin password'),
                        'url' => array('//user/user/changePassword')
                    ),
                    array(
                        'label' => Yum::t('Logout'),
                        'url' => array('//user/user/logout')
                    ),
                )
            ),
        );
    }

}
