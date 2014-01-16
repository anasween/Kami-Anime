<?php
$this->breadcrumbs= array(
            Yum::t('Groups')=>array('index'),
        );
?>

<h1><?php echo Yum::t('View Friendship') . ' ' . $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.BsDetailView', array(
	'data'=>$model,
	'attributes'=>array(
            'id',
            'inviter.username',
            'status',
            'invited.username',
            'acknowledgetime',
            'requesttime',
            'updatetime',
            'message',	
	),
)); 