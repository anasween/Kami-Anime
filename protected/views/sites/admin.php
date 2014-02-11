<?php
/* @var $this SitesController */
/* @var $model Sites */


$this->breadcrumbs = array(
    Yum::t('Sites') => array('index'),
    Yum::t('Manage'),
);

Yii::app()->clientScript->registerScript('search', "
    $('.search-button').click(function(){
        $('.search-form').toggle(500);
            return false;
        });
        $('.search-form form').submit(function(){
            $('#sites-grid').yiiGridView('update', {
            data: $(this).serialize()
        });
        return false;
    });"
);
echo '<div class="well">';
echo BSHtml::pageHeader(Yum::t('Manage'), Yum::t('Sites'))
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo BSHtml::button(Yum::t('Advanced search'), array('class' => 'search-button', 'icon' => BSHtml::GLYPHICON_SEARCH, 'color' => BSHtml::BUTTON_COLOR_PRIMARY), '#'); ?></h3>
    </div>
    <div class="panel-body">
        <div class="search-form" style="display:none">
            <?php
            $this->renderPartial('_search', array(
                'model' => $model,
            ));
            ?>
        </div><!-- search-form -->

        <?php
        $this->widget('bootstrap.widgets.BsGridView', array(
            'id' => 'sites-grid',
            'dataProvider' => $model->search(),
            'filter' => $model,
            'columns' => array(
                'id',
		'title',
		'logo',
                array(
                    'class' => 'bootstrap.widgets.BsButtonColumn',
                ),
            ),
        ));
        ?>
    </div>
</div>
<?php
echo '</div>';