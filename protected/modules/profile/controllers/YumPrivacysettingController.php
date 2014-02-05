<?php

Yii::import('application.modules.user.controllers.YumController');
Yii::import('application.modules.user.models.Yum');
Yii::import('application.modules.profile.models.*');

class YumPrivacysettingController extends YumController {

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('update'),
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function beforeAction($action) {
        if (!Yum::module('profile')->enablePrivacySetting) {
            throw new CHttpException(404);
        }

        return parent::beforeAction($action);
    }

    public function actionUpdate() {
        $model = YumPrivacySetting::model()->findByPk(Yii::app()->user->id);

        $yumPrivacysetting = Yii::app()->request->getParam('YumPrivacysetting');

        if ($yumPrivacysetting != NULL) {
            $model->attributes = $yumPrivacysetting;

            $profile_privacy = 0;
            foreach ($_POST as $key => $value) {
                if ($value == 1 && substr($key, 0, 18) == 'privacy_for_field_') {
                    $data = (int) explode('_', $key)[3];
                    $profile_privacy += $data;
                }
            }

            $model->public_profile_fields = $profile_privacy;
            $model->validate();

            $yumProfile = Yii::app()->request->getParam('YumProfile');

            if ($yumProfile != NULL) {
                $profile = $model->user->profile;
                $profile->attributes = $yumProfile;
                if ($profile->validate()) {
                    $profile->save();
                }
            }

            if (!$model->hasErrors()) {
                $model->save();
                Yum::setFlash('Your privacy settings have been saved');
                $this->redirect(array('//profile/profile/view', 'id' => $model->user_id));
            }
        }

        // If the user does not have a privacy setting entry yet, create an
        // empty one
        if (!$model) {
            $model = new YumPrivacySetting();
            $model->user_id = Yii::app()->user->id;
            $model->save();
            $this->refresh();
        }

        $this->render(Yum::module('profile')->privacySettingView, array(
            'model' => $model,
            'profile' => isset($model->user) && isset($model->user->profile) ? $model->user->profile : null
        ));
    }

}
