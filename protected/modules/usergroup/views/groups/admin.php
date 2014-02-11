<?php
$this->breadcrumbs=array(
	Yum::t('Usergroups')=>array('index'),
	Yum::t('Manage'),
);
Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
        $('.search-form').toggle(500);
        return false;
    });
    $('.search-form form').submit(function(){
        $.fn.yiiGridView.update('usergroup-grid', {
            data: $(this).serialize()
        });
        return false;
    });
");

echo '<div class="well">';
echo BSHtml::pageHeader(Yum::t('Manage usergroups'));

echo BSHtml::linkButton(Yum::t('Advanced search'),array(
    'class'=>'search-button',
    'color' => BSHtml::BUTTON_COLOR_DEFAULT
    )); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>

<?php
$this->widget('bootstrap.widgets.BsGridView', array(
	'id'=>'usergroup-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'owner_id',
		'title',
		'description',
		array(
                    'class'=>'bootstrap.widgets.BsButtonColumn',
		),
	),
)); 

echo '</div>';