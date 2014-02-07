<?php $this->title = Yum::t('Avatar administration');

$this->breadcrumbs = array(
	Yum::t('Users') => array('admin'),
	Yum::t('Avatars'));

echo '<div class="well">';

$this->widget('bootstrap.widgets.BsListView', array(
    'dataProvider'=>$model->search(),
    'sortableAttributes' => array('username', 'createtime', 'status', 'lastvisit', 'avatar'),
    'itemView' => '_view',
));

echo '</div>';