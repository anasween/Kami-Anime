<?php

/* @var $this AnimeController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php

$this->breadcrumbs = array(
    Yum::t('Anime'),
);
echo '<div class="well">';
echo BSHtml::pageHeader(Yum::t('Anime'));
$this->renderPartial('_loop', array('dataProvider'=>$dataProvider));
echo '</div>';
if (Yii::app()->user->can('urls','admin')) {
    $this->widget('bootstrap.widgets.BsModal', array(
        'id' => 'addUrlModal',
        'header' => Yum::t('Add url'),
        'content' => $this->renderPartial('//anime/_urlForm', array('model' => new Urls), true, true),
    ));
}