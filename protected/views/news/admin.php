<?php
/* @var $this NewsController */
/* @var $model News */
$this->breadcrumbs = array(
            Yum::t('News')=>array('index'),
            Yum::t('Manage'),    
        );?>
<div class="well">
<h1><?php echo Yum::t('Manage news') ?></h1>
<p>
Вы можете вставить оператор выражения (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
или <b>=</b>) в начало каждого из поисковых запросов.
</p>

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