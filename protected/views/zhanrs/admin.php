<?php
/* @var $this ZhanrsController */
/* @var $model Zhanrs */


$this->breadcrumbs=array(
	Yum::t('Zhanrs')=>array('index'),
	Yum::t('Manage'),
);

Yii::app()->clientScript->registerScript('search',
    "
    $('.search-button').click(function(){
        $('.search-form').toggle(500);
            return false;
        });
        $('.search-form form').submit(function(){
            $('#zhanrs-grid').yiiGridView('update', {
            data: $(this).serialize()
        });
        return false;
    });"
);
echo '<div class="well">';
echo BSHtml::pageHeader(Yum::t('Manage'),Yum::t('Zhanrs')) ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo BSHtml::button(Yum::t('Advanced search'),array('class' =>'search-button', 'icon' => BSHtml::GLYPHICON_SEARCH,'color' => BSHtml::BUTTON_COLOR_PRIMARY), '#'); ?></h3>
    </div>
    <div class="panel-body">
        <p>
            You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>
                &lt;&gt;</b>
            or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
        </p>
        <div class="search-form" style="display:none">
            <?php $this->renderPartial('_search',array(
                'model'=>$model,
            )); ?>
        </div><!-- search-form -->

        <?php $this->widget('bootstrap.widgets.BsGridView',array(
        'id'=>'zhanrs-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'columns'=>array(
        		'id',
		'title',
        array(
        'class'=>'bootstrap.widgets.BsButtonColumn',
        ),
        ),
        )); ?>
    </div>
</div>
<?php
echo '</div>';