<?php
$this->title = Yum::t('Manage roles'); 
$this->breadcrumbs = array(
            Yum::t('Roles')=>array('index'),
            Yum::t('Manage'),
        );
?>

<?php $this->widget('bootstrap.widgets.BsGridView', array(
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        array(
            'name' => 'title',
            'type' => 'raw',
            'value'=> 'CHtml::link(CHtml::encode($data->title),
                array("//role/role/view","id"=>$data->id))',
        ),
        'description',
        array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'class'=>'bootstrap.widgets.BsButtonColumn',
        ),
    ),
));