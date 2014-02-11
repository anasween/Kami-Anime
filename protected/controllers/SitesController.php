<?php

class SitesController extends Controller {

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl',
            'postOnly + delete',
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
                'expression' => 'Yii::app()->user->can("sites", "update")'
            ),
            array('allow',
                'actions' => array('create'),
                'expression' => 'Yii::app()->user->can("sites", "create")'
            ),
            array('allow',
                'actions' => array('admin', 'index', 'view'),
                'expression' => 'Yii::app()->user->can("sites", "admin")'
            ),
            array('allow',
                'actions' => array('delete'),
                'expression' => 'Yii::app()->user->can("sites", "delete")'
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Sites;

        $this->performAjaxValidation($model);

        if (isset($_POST['Sites'])) {
            $model->attributes = $_POST['Sites'];
            if ($model->save()) {
                $this->redirect(array('admin'));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        $this->performAjaxValidation($model);

        if (isset($_POST['Sites'])) {
            $model->attributes = $_POST['Sites'];
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
        $this->loadModel($id)->delete();

        if (!isset($_GET['ajax'])) {
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
        }
    }

    /**
     * Index action. Redirect to admin action.
     */
    public function actionIndex() {
        $this->actionAdmin();
    }
    
    /**
     * Show view.
     * @param integer $id
     */
    public function actionView($id) {
        $model = $this->loadModel($id);
        
        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Sites('search');
        $model->unsetAttributes();
        if (isset($_GET['Sites'])) {
            $model->attributes = $_GET['Sites'];
        }

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Sites the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Sites::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, Yum::t('The requested page does not exist.'));
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Sites $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'sites-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
