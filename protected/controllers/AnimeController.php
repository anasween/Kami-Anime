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
                'actions' => array('index', 'view', 'list', 'search'),
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
                'actions' => array('admin', 'createUrl', 'editUrl', 'addFromWA'),
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
    public function actionIndex($title = null) { 
        $dataProviderOptions = array(
            'sort'=>array(
                'defaultOrder'=>'modify DESC',
            ),
            'pagination'=>array(
                'pageSize'=>10,
            ),
        );
        
        if ($title) {
            $criteria=new CDbCriteria;
            $criteria->condition = '(name_ru LIKE \'%'.$title.'%\') OR (name_en LIKE \'%'.$title.'%\') OR (name_jp LIKE \'%'.$title.'%\')';
            $dataProviderOptions['criteria'] = $criteria;
        }
        
        $dataProvider = new CActiveDataProvider('Anime', $dataProviderOptions);
 
        if (Yii::app()->request->isAjaxRequest){
            $this->renderPartial('_loop', array(
                'dataProvider'=>$dataProvider,
            ));
            Yii::app()->end();
        } else {
            $this->render('index', array(
                'dataProvider'=>$dataProvider,
                'title' => $title
            ));
        }
    }
    
    /**
     * Show all news in list view.
     */
    public function actionList() {
        $criteria=new CDbCriteria;
        $criteria->order = 'name_ru ASC';
        $this->render('items', array(
            'models'=>Anime::model()->findAll($criteria),
        ));
    }
    
    public function actionSearch(array $options = null) {
        
        $dataProviderOptions = array(
            'sort'=>array(
                'defaultOrder'=>'modify DESC',
            ),
            'pagination'=>array(
                'pageSize'=>10,
            ),
        );
        if ($options) {
            $criteria=new CDbCriteria;
            $condition = '';
            if (isset($options['zhanrs'])) {
                foreach ($options['zhanrs'] as $zhanr) {
                    if ($condition) {
                        $condition .= ', '.$zhanr;
                    } else {
                        $condition .= $zhanr;
                    }
                }
                $condition = '(zhanrs.id IN ('.$condition.'))';
                $criteria->together = true;
                $criteria->with = array('zhanrs');
                $criteria->having = 'COUNT(t.id)='.count($options['zhanrs']);
                $criteria->group = 't.id';
            }
            if (isset($options['title'])) {
                if ($condition) {
                    $condition .= ' AND ';
                }
                $condition .= '((name_ru LIKE \'%'.$options['title'].'%\') OR (name_en LIKE \'%'.$options['title'].'%\') OR (name_jp LIKE \'%'.$options['title'].'%\'))';
            }
            if ($condition) {
                $criteria->condition = $condition;
                $dataProviderOptions['criteria'] = $criteria;
            }
        }
        $dataProvider = new CActiveDataProvider('Anime', $dataProviderOptions);
        $this->render('search', array(
            'dataProvider'=>$dataProvider,
            'options' => $options
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

    public function actionEditUrl() {
        if (isset($_POST['Urls'])) {
            $urls = Yii::app()->request->getParam('Urls');
            try {
                $model = Urls::model()->findByAttributes(array('anime_id' => $urls['anime_id'], 'site_id' => $urls['site_id']));
            } catch (Exception $e) {
                echo BSHtml::alert(BSHtml::ALERT_COLOR_DANGER, Yum::t('Error.'));
            }
            $model->url = $urls['url'];
            if ($model->save()) {
                echo BSHtml::alert(BSHtml::ALERT_COLOR_SUCCESS, Yum::t('Success. Url to this anime was updated.'));
                Yii::app()->end();
            } else {
                echo BSHtml::alert(BSHtml::ALERT_COLOR_DANGER, Yum::t('Error.'));
            }
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

    public function actionAddFromWA() {
        if (isset($_POST['ParseWA'])) {
            for ($i = $_POST['ParseWA']['from']; $i <= $_POST['ParseWA']['to']; $i++) {
                $urlWA = "http://www.world-art.ru/animation/animation.php?id=" . $i;
                echo 'Запрашиваю страницу ' . $urlWA . '<br>';
                $content = $this->getContent("https://web.archive.org/web/" . $urlWA);
                $attributes = $this->parseWAPage($content);
                $attributes['url'] = $urlWA;
                if ($attributes['name_ru']) {
                    try {
                        $alreadyExist = Anime::model()->findByAttributes(array('name_ru' => $attributes['name_ru']));
                    } catch (Exception $e) {
                        echo BSHtml::tag('p', array('style' => 'color: #ff9999'), 'Ошибка ' . $e);
                    }
                } else {
                    echo BSHtml::tag('p', array('style' => 'color: #ff9999'), 'Ошибка при парсинге.');
                    continue;
                }
                if (!$alreadyExist) {
                    try {
                        $this->createAnime($attributes);
                    } catch (Exception $e) {
                        if (strpos($e, ' Duplicate entry')) {
                            echo BSHtml::tag('p', array('style' => 'color: #ff9999'), 'Ошибка. Данное аниме уже есть в базе.');
                        } else {
                            echo BSHtml::tag('p', array('style' => 'color: #ff9999'), 'Ошибка ' . $e);
                        }
                    }
                } else {
                    echo BSHtml::tag('p', array('style' => 'color: #ff9999'), 'Ошибка. Данное аниме уже есть в базе.');
                }
            }
            Yii::app()->end();
        }
        $this->render('parseWA');
    }

    private function getContent($url) {
        $ch = curl_init(); // инициализация
        curl_setopt($ch, CURLOPT_URL, $url); // адрес страницы для скачивания
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; ru-RU; rv:1.7.12) Gecko/20050919 Firefox/1.0.7"); // каким браузером будем прикидываться
        curl_setopt($ch, CURLOPT_TIMEOUT, 3); //TIMEOUT
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // выводим загруженную страницу в переменную
        $content = $this->curl_redir_exec($ch); // скачиваем страницу
        curl_close($ch); // закрываем соединение
        return $content;
    }

    private function curl_redir_exec($ch) {
        static $curl_loops = 0;
        static $curl_max_loops = 20;
        if ($curl_loops >= $curl_max_loops) {
            $curl_loops = 0;
            return FALSE;
        }
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($ch);
        list($header, $data) = explode("\r\n\r\n", $data, 2);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($http_code == 301 || $http_code == 302) {
            $matches = array();
            preg_match('/Location:(.*?)\n/', $header, $matches);
            $url = @parse_url(trim(array_pop($matches)));
            if (!$url) {
                //couldn't process the url to redirect to  
                $curl_loops = 0;
                return $data;
            }
            $last_url = parse_url(curl_getinfo($ch, CURLINFO_EFFECTIVE_URL));
            if (!$url['scheme']) {
                $url['scheme'] = $last_url['scheme'];
            }
            if (!$url['host']) {
                $url['host'] = $last_url['host'];
            }
            if (!$url['path']) {
                $url['path'] = $last_url['path'];
            }
            $new_url = $url['scheme'] . '://' . $url['host'] . $url['path'] . ($url['query'] ? '?' . $url['query'] : '');
            curl_setopt($ch, CURLOPT_URL, $new_url);
            return $this->curl_redir_exec($ch);
        } else {
            $curl_loops = 0;
            return $data;
        }
    }

    private function parseWAPage($content) {
        $attributes = array();
        preg_match('|size=3><b>([^\[]+?)\s*\[.*?year=(\d+).*?font><br>([^<]+)<br>([^<]+)|is', $content, $matches);
        $attributes['name_ru'] = $matches[1];
        $attributes['name_en'] = $matches[3];
        $attributes['name_jp'] = $matches[4];
        $attributes['year'] = $matches[2];
        preg_match('|Жанр</b>:(.*?)<br>|is', $content, $matches);
        $attributes['zhanrsList'] = preg_replace('|<[^>]+>|is', '', str_replace('&nbsp;', '', $matches[1]));
        preg_match('|Тип</b>:\s*(.*?)<br>|is', $content, $matches);
        $type = explode(' (', $matches[1]);
        $series_count = explode(' эп', $type[1]);
        if (is_numeric($series_count[0])) {
            $attributes['series_count'] = $series_count[0];
        }
        unset($series_count);
        $type = explode(', ', $type[0]);
        $attributes['type'] = $type[0];
        unset($type);
        preg_match_all("#justify\s*class='review'>(.*?)(?:&copy;|</table)#is", $content, $matches, PREG_SET_ORDER);
        $attributes['description'] = '<p>' . trim(preg_replace('|<[^>]+>|is', '', $matches[0][1])) . '</p>';
        $attributes['autor_id'] = 3;
        return $attributes;
    }

    private function createAnime($attributes) {
        $anime = new Anime;
        $anime->attributes = $attributes;
        $anime->createtime = new CDbExpression('NOW()');
        $anime->modify = new CDbExpression('NOW()');
        If ($anime->save()) {
            $zhanrsID = array();
            $attributes['zhanrsList'] = explode(',', $attributes['zhanrsList']);
            foreach ($attributes['zhanrsList'] as $zhanr_low) {
                $zhanr = ucfirst($zhanr_low);
                If (!$zhanrModel = Zhanrs::model()->findByAttributes(array('title' => $zhanr))) {
                    $zhanrModel = new Zhanrs;
                    $zhanrModel->title = $zhanr;
                    $zhanrModel->save();
                }
                array_push($zhanrsID, $zhanrModel->id);
            }
            $anime->syncZhanrs($zhanrsID);
            $urls = new Urls;
            $urls->anime_id = $anime->id;
            $urls->site_id = 1;
            $urls->url = $attributes['url'];
            $urls->save();
            echo BSHtml::tag('p', array('style' => 'color: #99ff99'), $anime->name_ru . ' успешно добавлено.');
        } else {
            echo BSHtml::tag('p', array('style' => 'color: #ff9999'), 'Неверная ссылка.');
        }
    }

}
