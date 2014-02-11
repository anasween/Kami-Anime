<?php
/* @var $this NewsController */
/* @var $dataProvider CActiveDataProvider */
$this->breadcrumbs=array(
            Yum::t('News'),
        );

echo '<div class="well">';

echo BSHtml::pageHeader(Yum::t('News'));

$this->widget('bootstrap.widgets.BsListView',array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_shortView',
    'template' => '{items}{pager}'
));

echo '</div>';