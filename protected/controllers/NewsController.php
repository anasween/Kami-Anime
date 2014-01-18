<?php

class NewsController extends Controller
{
    public function accessRules() 
    {
        return array(
            array('allow',
                'actions'=>array('index', 'view', 'error'),
                'users'=>array('*'),
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
                'expression' => 'Yii::app()->user->can("news", "update")'
            ),
            array('allow',
                'actions'=>array('create'),
                'expression' => 'Yii::app()->user->can("news", "create")'
            ),
            array('allow',
                'actions'=>array('admin'),
                'expression' => 'Yii::app()->user->can("news", "admin")'
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
        $newsModel = $this->loadModel($id);
        $this->render('view',array(
            'model'=> $newsModel,
            'comments'=> $newsModel->getCommentsDataProvider(),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate()
    {
        $model=new News;

        $this->performAjaxValidation($model);

        if(isset($_POST['News']))
        {
            $model->attributes=$_POST['News'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
        }

        $this->render('create',array(
            'model'=>$model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model=$this->loadModel($id);

        $this->performAjaxValidation($model);

        if(isset($_POST['News']))
        {
            $model->attributes=$_POST['News'];
            if($model->save())
                $this->redirect(array('view','id'=>$model->id));
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
        $this->loadModel($id)->delete();
        
        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if(!isset($_GET['ajax']))
        {
            $this->redirect(Yii::app()->request->getParam('returnUrl', array('admin')));
        }
    }

    /**
     * Lists all models.
     */
    public function actionIndex()
    {
        $dataProvider=new CActiveDataProvider('News');

        $criteria=new CDbCriteria;
        $criteria->order = 'create_Date DESC';

        $pages=new CPagination(News::model()->count($criteria));
        $pages->pageSize=10;
        $pages->applyLimit($criteria);
        $news = News::model()->findAll($criteria);

        $this->render('index',array(
            'dataProvider'=>$dataProvider,
            'news' => $news, 
            'pages' => $pages,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin()
    {
        $model=new News('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['News']))
            $model->attributes=$_GET['News'];

        $this->render('admin',array(
            'model'=>$model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return News the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model=News::model()->findByPk($id);
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param News $model the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='news-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }
}
