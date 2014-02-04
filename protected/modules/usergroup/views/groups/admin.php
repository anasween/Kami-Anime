<?php
$this->breadcrumbs=array(
	Yum::t('Usergroups')=>array('index'),
	Yum::t('Manage'),
);
Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
        $('.search-form').toggle();
        return false;
    });
    $('.search-form form').submit(function(){
        $.fn.yiiGridView.update('usergroup-grid', {
            data: $(this).serialize()
        });
        return false;
    });
");
		?>

<h1> <?php echo Yum::t('Manage usergroups'); ?></h1>

<?php echo CHtml::link(Yum::t('Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>

<?php
$locale = CLocale::getInstance(Yii::app()->language);

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
)); ?>
