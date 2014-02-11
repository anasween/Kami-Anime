<?php
/* @var $this ZhanrsController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php
$this->breadcrumbs=array(
	Yum::t('Zhanrs'),
);
echo '<div class="well">';
echo BSHtml::pageHeader(Yum::t('Zhanrs')); 
$this->widget('bootstrap.widgets.BsListView',array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
));
echo '</div>';