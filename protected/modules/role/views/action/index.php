<?php
$this->breadcrumbs = array(
            Yum::t('Actions'),
        );
?>

<h1><?php echo Yum::t('Actions'); ?></h1>

<?php $this->widget('bootstrap.widgets.BsListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
));