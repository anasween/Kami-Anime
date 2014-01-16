<?php $this->title = Yum::t('Avatar administration');

$this->breadcrumbs = array(
	Yum::t('Users') => array('admin'),
	Yum::t('Avatars'));

$this->widget('bootstrap.widgets.BsListView', array(
    'dataProvider'=>$model->search(),
    'sortableAttributes' => array('username', 'createtime', 'status', 'lastvisit', 'avatar'),
    'itemView' => '_view',
));