<?php
    /* @var $this ZhanrsController */
    /* @var $model Zhanrs */
?>

<?php
$this->breadcrumbs=array(
	Yum::t('Zhanrs')=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	Yum::t('Update'),
); 
echo '<div class="well">';
echo BSHtml::pageHeader(Yum::t('Update'),Yum::t('Zhanrs').' '.$model->id);
$this->renderPartial('_form', array('model'=>$model));
echo '</div>';