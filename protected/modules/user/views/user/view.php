<?php

$profiles = Yum::hasModule('profile');

if (Yum::module()->loginType & UserModule::LOGIN_BY_EMAIL & $profiles) {
    $this->title = Yum::t('View user "{email}"', array(
                '{email}' => $model->profile->email));
} else {
    $this->title = Yum::t('View user "{username}"', array(
                '{username}' => $model->username));
}

$this->breadcrumbs = array(
    Yum::t('Users') => array('index'),
    $model->username
);

echo Yum::renderFlash();

echo '<div class="well">';

echo BSHtml::pageHeader($this->title);

if (Yii::app()->user->isAdmin()) {
    $attributes = array(
        'id',
    );

    if (!Yum::module()->loginType & UserModule::LOGIN_BY_EMAIL) {
        $attributes[] = 'username';
    }

    if ($profiles && $model->profile) {
        foreach (YumProfile::getProfileFields() as $field) {
            array_push($attributes, array(
                'label' => Yum::t($field),
                'type' => 'raw',
                'value' => $model->profile->getAttribute($field)
            ));
        }
    }

    array_push($attributes,
        array(
            'name' => 'createtime',
            'value' => date(UserModule::$dateFormat, $model->createtime),
        ), 
        array(
            'name' => 'lastvisit',
            'value' => date(UserModule::$dateFormat, $model->lastvisit),
        ), 
        array(
            'name' => 'lastpasswordchange',
            'value' => date(UserModule::$dateFormat, $model->lastpasswordchange),
        ), 
        array(
            'name' => 'superuser',
            'value' => YumUser::itemAlias("AdminStatus", $model->superuser),
        ), 
        array(
            'name' => 'status',
            'value' => YumUser::itemAlias("UserStatus", $model->status),
        )
    );

    $this->widget(
            'bootstrap.widgets.BsDetailView', array(
        'data' => $model,
        'attributes' => $attributes,
            )
    );
} else {
    // For all users
    $attributes = array(
        'username',
    );

    if ($profiles) {
        $profileFields = YumProfile::getProfileFields();
        if ($profileFields) {
            foreach ($profileFields as $field) {
                array_push($attributes, array(
                    'label' => Yum::t($field),
                    'name' => $field,
                    'value' => $model->profile->getAttribute($field),
                        )
                );
            }
        }
    }

    array_push($attributes, array(
        'name' => 'createtime',
        'value' => date(UserModule::$dateFormat, $model->createtime),
            ), array(
        'name' => 'lastvisit',
        'value' => date(UserModule::$dateFormat, $model->lastvisit),
            )
    );

    $this->widget(
            'bootstrap.widgets.BsDetailView', array(
        'data' => $model,
        'attributes' => $attributes,
            )
    );
}


if (Yum::hasModule('role') && Yii::app()->user->isAdmin()) {
    Yii::import('application.modules.role.models.*');
    echo '<h2>' . Yum::t('This user belongs to these roles:') . '</h2>';

    if ($model->roles) {
        $roles = array();
        foreach ($model->roles as $role) {
            array_push($roles, array(
                'label' => $role->title,
                'url' => array('//role/role/view', 'id' => $role->id)
            ));
        }
        echo BSHtml::stackedPills($roles);
    } else {
        printf('<p>%s</p>', Yum::t('None'));
    }
}

$buttons = array();

if (Yii::app()->user->isAdmin()) {
    array_push(
            $buttons, array(
        'label' => Yum::t('Manage Users'),
        'url' => array('//user/user/admin'),
        'color' => BSHtml::BUTTON_COLOR_INFO,
        'type' => BSHtml::BUTTON_TYPE_LINK,
        'icon' => BSHtml::GLYPHICON_TH
            ), array(
        'label' => Yum::t('Update User'),
        'url' => array('user/update', 'id' => $model->id),
        'color' => BSHtml::BUTTON_COLOR_INFO,
        'type' => BSHtml::BUTTON_TYPE_LINK,
        'icon' => BSHtml::GLYPHICON_EDIT
            )
    );
}

if (Yum::hasModule('profile')) {
    array_push(
            $buttons, array(
        'label' => Yum::t('Visit profile'),
        'url' => array('//profile/profile/view', 'id' => $model->id),
        'color' => BSHtml::BUTTON_COLOR_INFO,
        'type' => BSHtml::BUTTON_TYPE_LINK,
        'icon' => BSHtml::GLYPHICON_USER
            )
    );
}

echo BSHtml::buttonGroup($buttons, array('style' => 'margin-top: 10px;'));

echo '</div>';