<?php
$this->title = Yum::t('Manage users');

$this->breadcrumbs = array(
            Yum::t('Users'),
            Yum::t('Manage')
        );

echo '<div class="well">';
echo BSHtml::pageHeader(Yum::t('Manage users'));

echo BSHtml::linkButton(Yum::t('Create new User'), array(
        'color' => BSHtml::BUTTON_COLOR_SUCCESS,
        'icon' =>  BSHtml::GLYPHICON_PLUS,
        'url' => array('//user/user/create')
    ));

$columns = array(
    array(
        'class'=>'bootstrap.widgets.BsButtonColumn',
        'header' => Yum::t('Actions'),
    ),
    array(
        'name'=>'id',
        'filter' => false,
        'type'=>'raw',
        
        'value'=>'CHtml::link($data->id, array("//user/user/update","id"=>$data->id))',
    ),
    array(
        'name'=>'username',
        'type'=>'raw',
        
        'value'=>'CHtml::link(CHtml::encode($data->username), array("//user/user/view","id"=>$data->id))',
    ),
);

if(Yum::hasModule('profile') && isset($profile))
{
    foreach(Yum::module('profile')->gridColumns as $column)
    {
        $columns[] = array(
            'header' => Yum::t($column),
            'filter' => BSHtml::textField('YumProfile['.$column.']', $profile->$column, array('class' => 'form-control')),
            'name' => 'profile.'.$column,
            
        );
    }
}
$columns[] = array(
    'name'=>'status',
    'filter' => array(
        '0' => Yum::t('Not active'),
        '1' => Yum::t('Active'),
        '-1' => Yum::t('Banned'),
        '-2' => Yum::t('Deleted')),
    'value'=>'YumUser::itemAlias("UserStatus",$data->status)',
    
);
$columns[] = array(
    'name'=>'superuser',
    'filter' => array(0 => Yum::t('No'), 1 => Yum::t('Yes')),
    'value'=>'YumUser::itemAlias("AdminStatus",$data->superuser)',
    
);

if(Yum::hasModule('role'))
{
    $columns[] = array(
        'header'=>Yum::t('Roles'),
        'name'=>'filter_role',
        'type' => 'raw',
        'visible' => Yum::hasModule('role'),
        'filter' => CHtml::listData(YumRole::model()->findAll(), 'id', 'title'),
        'value'=>'$data->getRoles()',
        
    );
}

$this->widget(
        'bootstrap.widgets.BsGridView',
        array(
            'dataProvider'=>$model->search(),
            'filter' => $model,
            'columns'=>$columns,
        )
);

echo '</div>';