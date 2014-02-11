<?php
/* @var $this NewsController */
/* @var $model News */
$this->breadcrumbs = array(
            Yum::t('News')=>array('index'),
            Yum::t('Manage'),    
        );?>
<div class="well">
<?php echo BSHtml::pageHeader(Yum::t('Manage'), Yum::t('News')) ?>

<?php 
$columns=array(
        'id',
        array(           
            'name'=>'autor_id',
            'value'=>'$data->autor->username',
        ),
        'title',
        'create_Date',
        array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
            'class'=>'bootstrap.widgets.BsButtonColumn',
        ),
    );
$this->widget(
    'bootstrap.widgets.BsGridView',
    array(
        'dataProvider' => $model->search(),
        'filter' => $model,
        'columns' => $columns,
        'type' => BSHtml::GRID_TYPE_HOVER,
    )
);?>
</div>