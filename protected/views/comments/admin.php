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
                array(           
                    'name'=>'autor_id',
                    'value'=>'$data->autor->username',
                ),
                'text',
                'createTime',
                'news_id',
                array(
                    'class'=>'bootstrap.widgets.BsButtonColumn',
                    'buttons'=>array(
                        'view' => array(
                            'url' => 'Yii::app()->createUrl("news/view", array("id"=>$data->news_id))'
                        )
                    ),
                ),
            ),
        )); ?>
    </div>
</div>




