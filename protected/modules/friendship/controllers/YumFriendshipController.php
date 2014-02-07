<?php

Yii::import('application.modules.user.controllers.YumController');
Yii::import('application.modules.user.components.*');
Yii::import('application.modules.user.models.*');
Yii::import('application.modules.friendship.models.*');

class YumFriendshipController extends YumController {

    // make sure that friendship is enabled in the configuration
    public function beforeAction($action) {
        if (!Yum::hasModule('friendship')) {
            return false;
        }
        return(parent::beforeAction($action));
    }

    public function actionIndex() {
        if (isset($_POST['YumFriendship']['inviter_id']) && isset($_POST['YumFriendship']['friend_id'])) {
            $friendship = YumFriendship::model()->find(
                    'inviter_id = :inviter_id and friend_id = :friend_id', array(
                ':inviter_id' => $_POST['YumFriendship']['inviter_id'],
                ':friend_id' => $_POST['YumFriendship']['friend_id']));

            if (isset($friendship)) {
                if ($friendship->inviter_id == Yii::app()->user->id || $friendship->friend_id == Yii::app()->user->id) {
                    if (isset($_POST['YumFriendship']['add_request'])) {
                        $friendship->acceptFriendship();
                    } elseif (isset($_POST['YumFriendship']['deny_request'])) {
                        $friendship->status = 3;
                        $friendship->save();
                    } elseif (isset($_POST['YumFriendship']['ignore_request'])) {
                        $friendship->status = 0;
                        $friendship->save();
                    } elseif (isset($_POST['YumFriendship']['cancel_request']) || isset($_POST['YumFriendship']['remove_friend'])) {
                        $friendship->delete();
                    }
                }
            }
        }

        $user = YumUser::model()->findByPk(Yii::app()->user->id);
        $this->render('myfriends', array(
            'friends' => $user->getFriendshipsDataProvider(),
            'friendModel' => $user->getFriendships(),
        ));
    }

    public function actionAdmin() {
        $model = new YumFriendship('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['YumFriendship'])) {
            $model->attributes = $_GET['YumFriendship'];
        }

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionInvite($user_id = null) {
        if (isset($_POST['user_id'])) {
            $user_id = $_POST['user_id'];
        }

        if ($user_id == null) {
            return false;
        }

        if (isset($_POST['message']) && isset($user_id)) {
            $friendship = new YumFriendship;
            if ($friendship->requestFriendship(Yii::app()->user->id, $_POST['user_id'], $_POST['message'])) {
                Yum::setFlash('The friendship request has been sent');
                $this->redirect(array('//profile/profile/view', 'id' => $user_id));
            }
        }

        $this->render('invitation', array(
            'inviter' => YumUser::model()->findByPk(Yii::app()->user->id),
            'invited' => YumUser::model()->findByPk($user_id),
            'friendship' => isset($friendship) ? $friendship : null,
        ));
    }

    public function ActionConfirmFriendship($id, $key) {
        $friendship = YumFriendship::model()->findByPK($id);

        if ($friendship->friend_id == $key) {
            $friendship->acceptFriendship();
            $verified = true;
        } else {
            $verified = false;
        }
        return $verified;
    }

    public static function invitationLink($inviter, $invited) {
        if ($inviter === $invited) {
            return false;
        }
        if (!is_object($inviter)) {
            $inviter = YumUser::model()->findByPk($inviter);
        }
        if (!is_object($invited)) {
            $invited = YumUser::model()->findByPk($invited);
        }

        $friends = $inviter->getFriends(true);
        if ($friends && $friends[0] != NULL) {
            foreach ($friends as $friend) {
                if ($friend->id == $invited->id) {
                    return false;
                }
            }
        }

        return array('//friendship/friendship/invite', 'user_id' => $invited->id);
    }

}