<?php
/* @var $this ZhanrsController */
/* @var $model Zhanrs */
?>

<?php
$this->breadcrumbs=array(
	Yum::t('Zhanrs')=>array('index'),
	$model->title,
);
echo '<div class="well">';
echo BSHtml::pageHeader(Yum::t('View'),Yum::t('Zhanrs').' '.$model->id) ?>
<div class="moder-panel">
<?php 
if (Yii::app()->user->can('zhanrs'))
{
    echo BSHtml::buttonDropdown(Yum::t('Actions'), 
            array(
                array(
                    'label' => Yum::t('Create'), 
                    'url' => array('zhanrs/create'),
                    'visible' => Yii::app()->user->can('zhanrs', 'create'),
                ),
                array(
                    'label' => Yum::t('Update'), 
                    'url' => array("zhanrs/update", "id"=>$model->id),
                    'visible' => Yii::app()->user->can('zhanrs', 'update'),
                ),
                array(
                    'label' => Yum::t('Delete'), 
                    'url'=>'#', 
                    'linkOptions'=>array(
                        'submit'=>array('zhanrs/delete', 'id'=>$model->id),
                        'confirm' => Yum::t('Are you sure to delete this item?'),
                    ),
                    'visible' => Yii::app()->user->can('zhanrs', 'delete'),
                ),
            ),
            array(
                'color' => BSHtml::BUTTON_COLOR_PRIMARY
            )
        );
} ?>
</div>
<?php
$this->widget('bootstrap.widgets.BsDetailView',array(
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed table-hover',
    ),
    'data'=>$model,
    'attributes'=>array(
        'id',
        'title',
    ),
));
echo '</div>';