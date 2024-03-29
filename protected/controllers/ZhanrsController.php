<?php

class ZhanrsController extends Controller {

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('index', 'view'),
                'expression' => 'Yii::app()->user->can("zhanrs", "read")'
            ),
            array('allow',
                'actions' => array('create'),
                'expression' => 'Yii::app()->user->can("zhanrs", "create")'
            ),
            array('allow',
                'actions' => array('update'),
                'expression' => 'Yii::app()->user->can("zhanrs", "update")'
            ),
            array('allow',
                'actions' => array('admin', 'delete'),
                'expression' => 'Yii::app()->user->can("zhanrs", "admin")'
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadInternModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Zhanrs;

        $this->performAjaxValidation($model);

        if (isset($_POST['Zhanrs'])) {
            $model->attributes = $_POST['Zhanrs'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
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
        $model = $this->loadInternModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Zhanrs'])) {
            $model->attributes = $_POST['Zhanrs'];
            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
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
            // we only allow deletion via POST request
            $this->loadInternModel($id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
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
        $dataProvider = new CActiveDataProvider('Zhanrs');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Zhanrs('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Zhanrs'])) {
            $model->attributes = $_GET['Zhanrs'];
        }

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Zhanrs the loaded model
     * @throws CHttpException
     */
    public function loadInternModel($id) {
        $model = Zhanrs::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, Yum::t('The requested page does not exist.'));
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Zhanrs $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'zhanrs-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
