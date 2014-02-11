<?php

class CommentsController extends Controller
{
    /**
    * Specifies the access control rules.
    * This method is used by the 'accessControl' filter.
    * @return array access control rules
    */
    public function accessRules()
    {
        return array(
            array('allow',
                'actions'=>array('index', 'view'),
                'users'=>array('@'),
            ),
            array('allow',
                'actions'=>array(
                    'admin',
                    'delete',
                    'create',
                    'update',
                    'index',
                    'view'
                ),
                'expression' => 'Yii::app()->user->isAdmin()'
            ),
            array('allow',
                'actions'=>array('update'),
                'expression' => 'Yii::app()->user->can("comments", "update")'
            ),
            array('allow',
                'actions'=>array('create'),
                'users'=>array('@'),
            ),
            array('allow',
                'actions'=>array('admin'),
                'expression' => 'Yii::app()->user->can("comments", "admin")'
            ),
            array('allow',
                'actions'=>array('delete'),
                'expression' => 'Yii::app()->user->can("comments", "delete")'
            ),
            array('deny',  // deny all other users
                'users'=>array('*'),
            ),
        );
    }

    /**
    * Displays a particular model.
    * @param integer $id the ID of the model to be displayed
    */
    public function actionView($id)
    {
        $this->render('view',array(
            'model'=>$this->loadInternModel($id),
        ));
    }

    /**
    * Updates a particular model.
    * If update is successful, the browser will be redirected to the 'view' page.
    * @param integer $id the ID of the model to be updated
    */
    public function actionUpdate($id)
    {
        $model=$this->loadInternModel($id);

        if(isset($_POST['Comments']))
        {
            $model->attributes=$_POST['Comments'];
            if ($model->save()) {
                $this->redirect(array('//news/view', 'id' => $model->news_id));
            }
        }

        $this->render('update',array(
            'model'=>$model,
        ));
    }

    /**
    * Deletes a particular model.
    * If deletion is successful, the browser will be redirected to the 'admin' page.
    * @param integer $id the ID of the model to be deleted
    */
    public function actionDelete($id)
    {
        if (Yii::app()->request->isPostRequest) {
            $comment = $this->loadInternModel($id);
            $news_id = $comment->news_id;
            $comment->delete();
            unset($comment);

            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('//news/view', 'id' => $news_id));
            }
        } else {
            throw new CHttpException(400, Yum::t('Invalid request. Please do not repeat this request again.'));
        }
    }

    /**
    * Lists all models.
    */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('Comments');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }

    /**
    * Manages all models.
    */
    public function actionAdmin()
    {
        $model=new Comments('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Comments'])) {
            $model->attributes = $_GET['Comments'];
        }

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
    * Returns the data model based on the primary key given in the GET variable.
    * If the data model is not found, an HTTP exception will be raised.
    * @param integer $id the ID of the model to be loaded
    * @return Comments the loaded model
    * @throws CHttpException
    */
    public function loadInternModel($id)
    {
        $model=Comments::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }

    /**
    * Performs the AJAX validation.
    * @param Comments $model the model to be validated
    */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='comments-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}