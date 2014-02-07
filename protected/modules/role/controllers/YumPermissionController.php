<?php

Yii::import('application.modules.user.controllers.YumController');
Yii::import('application.modules.user.models.*');
Yii::import('application.modules.role.models.*');

class YumPermissionController extends YumController {

    public $defaultAction = 'admin';

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('admin', 'create', 'index', 'delete'),
                'expression' => 'Yii::app()->user->isAdmin()',
            ),
            array('deny', // deny all other users
                'users' => array('*'),
            ),
        );
    }

    public function actionIndex() {
        $this->render('view', array('actions' => YumAction::model()->findAll()));
    }

    public function actionDelete() {
        $permission = YumPermission::model()->findByPk($_GET['id']);
        if ($permission->delete()) {
            Yum::setFlash(Yum::t('The permission has been removed'));
        } else {
            Yum::setFlash(Yum::t('Error while removing the permission'));
        }

        $this->redirect(array('//role/permission/admin'));
    }

    public function actionAdmin() {
        $this->layout = Yum::module('role')->layout;
        $model = new YumPermission('search');
        $model->unsetAttributes();

        if (isset($_GET['YumPermission'])) {
            $model->attributes = $_GET['YumPermission'];
        }

        $this->render('admin', array(
            'model' => $model,
            'rolefilter' => CHtml::listData(YumRole::model()->findAll(), 'id', 'title'),
            'actionfilter' => CHtml::listData(YumAction::model()->findAll(), 'id', 'title')
        ));
    }

    public function actionCreate() {
        $this->layout = Yum::module()->layout;
        $model = new YumPermission;

        $this->performAjaxValidation($model, 'permission-create-form');

        if (isset($_POST['YumPermission'])) {
            $yumPermission = Yii::app()->request->getPost('YumPermission');
            $model->attributes = $yumPermission;
            if ($model->validate()) {
                if ($yumPermission['type'] == 'user') {
                    $model->subordinate = $yumPermission['subordinate_id'];
                    $model->principal = $yumPermission['principal_id'];
                } elseif ($yumPermission['type'] == 'role') {
                    $model->subordinate_role = $yumPermission['subordinate_id'];
                    $model->principal_role = $yumPermission['principal_id'];
                }
                if ($model->save()) {
                    $this->redirect(array('admin'));
                }
                return;
            }
        }
        $model->type = 'user'; // preselect 'user'
        $this->render('create', array('model' => $model));
    }

}
