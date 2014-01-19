<?php
/* @var $this CommentsController */
/* @var $model Comments */


$this->breadcrumbs=array(
	Yum::t('Comments')=>array('index'),
	Yum::t('Manage'),
);

Yii::app()->clientScript->registerScript('search',
    "
    $('.search-button').click(function(){
        $('.search-form').toggle();
            return false;
        });
        $('.search-form form').submit(function(){
            $('#comments-grid').yiiGridView('update', {
            data: $(this).serialize()
        });
        return false;
    });"
);
?>
<?php echo BSHtml::pageHeader(Yum::t('Manage'),Yum::t('Comments')) ?>
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
            'id'=>'comments-grid',
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'columns'=>array(
                'id',
                'autor_id',
                'text',
                'createTime',
                'news_id',
                array(
                    'class'=>'bootstrap.widgets.BsButtonColumn',
                ),
            ),
        )); ?>
    </div>
</div>




