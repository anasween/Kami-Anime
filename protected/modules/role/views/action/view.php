<?php
$this->breadcrumbs = array(
            Yum::t('Actions')=>array('index'),
            $model->title,
        );
echo '<div class="well">';
echo BSHtml::pageHeader(Yum::t('Action'), $model->title);

$this->widget('bootstrap.widgets.BsDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'comment',
		'subject',
	),
));

echo '</div>';