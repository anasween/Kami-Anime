<?php
$this->breadcrumbs = array(
            Yum::t('Actions')=>array('index'),
            $model->title,
        );
?>

<h1> <?php echo $model->title; ?></h1>

<?php $this->widget('bootstrap.widgets.BsDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'comment',
		'subject',
	),
));