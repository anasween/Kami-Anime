<?php

class UrlsController extends Controller {

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('update'),
                'expression' => 'Yii::app()->user->can("urls", "update")'
            ),
            array('allow',
                'actions' => array('admin', 'index', 'view'),
                'expression' => 'Yii::app()->user->can("urls", "admin")'
            ),
            array('allow',
                'actions' => array('delete'),
                'expression' => 'Yii::app()->user->can("urls", "delete")'
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView() {
        $this->actionAdmin();
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadInternModel($id);

        $this->performAjaxValidation($model);

        if (isset($_POST['Urls'])) {
            $model->attributes = $_POST['Urls'];
            if ($model->save()) {
                $this->redirect(array('admin'));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            $this->loadInternModel($id)->delete();
            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
        } else {
            throw new CHttpException(400, Yum::t('Invalid request. Please do not repeat this request again.'));
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $this->actionAdmin();
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Urls('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Urls'])) {
            $model->attributes = $_GET['Urls'];
        }

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Urls the loaded model
     * @throws CHttpException
     */
    public function loadInternModel($id) {
        $model = Urls::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, Yum::t('The requested page does not exist.'));
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Urls $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'urls-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
