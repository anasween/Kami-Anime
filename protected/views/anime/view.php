<?php
/* @var $this AnimeController */
/* @var $model Anime */
?>

<?php
$this->breadcrumbs=array(
	Yum::t('Anime')=>array('index'),
	$model->name_ru,
);

$this->renderPartial('_view', array('data'=>$model));

if (Yii::app()->user->can('comment', 'create'))
{
    echo '<div class="well">';
    echo BSHtml::Button(Yum::t('Write a comment'), array(
        'color' => BSHtml::BUTTON_COLOR_PRIMARY,
        'icon' =>  BSHtml::GLYPHICON_COMMENT,
        'onClick' => "$('#comment-add-form').toggle(500)",
        'style' => 'margin: 10px',
    ));
    echo BSHtml::tag('div', array(
        'id' => 'comment-add-form',
        'style' => 'overflow: hidden; display: block;',
    ), $this->renderPartial('//comments/_form', array('model'=>$commentModel), true));
    echo '</div>';
}
$this->widget('bootstrap.widgets.BsListView', array(
    'dataProvider' => $comments,
    'itemView' => '//comments/_view', 
    'template' => '{items}{pager}',
    'emptyText' => ''
)); 

if (Yii::app()->user->can('urls','admin')) {
    $this->widget('bootstrap.widgets.BsModal', array(
        'id' => 'addUrlModal',
        'header' => Yum::t('Add url'),
        'content' => $this->renderPartial('//anime/_urlForm', array('model' => new Urls), true),
    ));
}

Yii::app()->clientScript->registerScript('comment-add-form-toogle-script',"
    $('#comment-add-form').toggle(500);
",CClientScript::POS_END);