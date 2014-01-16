<?php
$this->title = Yum::t('Friendship administration');
$this->breadcrumbs = array(Yum::t('Friends'), Yum::t('Admin'));

printf('<p>%s</p>', Yum::t('All friendships in the system'));

$this->widget('bootstrap.widgets.BsGridView', array(
	'dataProvider'=>$model->search(),
	'enableSorting' => true,
	'enablePagination' => true,
	'filter' => $model,
	'columns' => array(
            array(
                'name' => 'inviter_id',
                'value' => '$data->inviter->username'
            ),
            array(
                'name' => 'friend_id',
                'value' => '$data->invited->username'
            ),
            array(
                'name' => 'requesttime',
                'value' => 'date(Yum::module()->dateTimeFormat, $data->requesttime)'
            ),
            array(
                'name' => 'acknowledgetime',
                'value' => 'date(Yum::module()->dateTimeFormat, $data->acknowledgetime)'
            ),
            array(
                'name' => 'updatetime',
                'value' => 'date(Yum::module()->dateTimeFormat, $data->updatetime)'
            ),
            array(
                'name' => 'status',
                'value' => '$data->getStatus()'
            ),
        )
    )
); 