<?php
$this->breadcrumbs = array(
            Yum::t('Actions'),
        );

echo '<div class="well">';

echo BSHtml::pageHeader(Yum::t('Actions'));

$this->widget('bootstrap.widgets.BsListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
));

echo '</div>';