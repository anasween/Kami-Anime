<?php

class AnimeController extends Controller {
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
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('update'),
                'expression' => 'Yii::app()->user->can("anime", "update")'
            ),
            array('allow',
                'actions' => array('create'),
                'expression' => 'Yii::app()->user->can("anime", "create")'
            ),
            array('allow',
                'actions' => array('admin', 'createUrl'),
                'expression' => 'Yii::app()->user->can("anime", "admin")'
            ),
            array('allow',
                'actions' => array('delete'),
                'expression' => 'Yii::app()->user->can("anime", "delete")'
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
    public function actionView($id) {
        $model = $this->loadInternModel($id);
        $model->views = $model->views + 1;
        $model->save();
        
        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Anime;
        $model->animeZhanrs = new AnimeZhanrs;

        $this->performAjaxValidation($model);

        if (isset($_POST['Anime'])) {
            $model->attributes = $_POST['Anime'];
            $model->createtime = new CDbExpression('NOW()');
            if ($model->save()) {
                if (isset($_POST['Anime']['zhanrs'])) {
                    $model->syncZhanrs($_POST['Anime']['zhanrs']);
                } else {
                    $model->syncZhanrs();
                }
                $this->redirect(array('view', 'id' => $model->id));
            } else {
                throw new CHttpException(400, Yum::t('Invalid request. Please do not repeat this request again.'));
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

        $this->performAjaxValidation($model);

        if (isset($_POST['Anime'])) {
            $model->attributes = $_POST['Anime'];
            $model->modify = new CDbExpression('NOW()');
            if ($model->save()) {
                if (isset($_POST['Anime']['zhanrs'])) {
                    $model->syncZhanrs($_POST['Anime']['zhanrs']);
                } else {
                    $model->syncZhanrs();
                }
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
        $dataProvider = new CActiveDataProvider('Anime');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new Anime('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Anime'])) {
            $model->attributes = $_GET['Anime'];
        }

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Anime the loaded model
     * @throws CHttpException
     */
    public function loadInternModel($id) {
        $model = Anime::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, Yum::t('The requested page does not exist.'));
        }
        return $model;
    }
    
    public function loadAnimeZhanrsModel($id) {
        $model = AnimeZhanrs::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, Yum::t('The requested page does not exist.'));
        }
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Anime $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'anime-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    public function actionCreateUrl() {
        $model = new Urls;
        $model->unsetAttributes();
        
        if (isset($_POST['Urls'])) {
            $model->attributes = $_POST['Urls'];
            if ($model->save()) {
                echo BSHtml::alert(BSHtml::ALERT_COLOR_SUCCESS, Yum::t('Success. Url to this anime was add.'));
                Yii::app()->end();
            } else {
                echo BSHtml::alert(BSHtml::ALERT_COLOR_DANGER, Yum::t('Url to this site already exist.'));
            }
        }
    }

}
