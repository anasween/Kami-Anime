<?php

/* @var $this AnimeController */
/* @var $dataProvider CActiveDataProvider */
?>

<?php

$this->breadcrumbs = array(
    Yum::t('Anime'),
);
echo '<div class="well">';
echo BSHtml::pageHeader(Yum::t('Anime'));
$this->widget('bootstrap.widgets.BsListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'emptyText' => Yum::t('No anime found')
));
echo '</div>';