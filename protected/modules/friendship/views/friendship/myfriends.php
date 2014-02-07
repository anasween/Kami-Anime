<?php
$this->title = Yum::t('My friends');
$this->breadcrumbs = array(
            Yum::t('Friends')
        );

echo '<div class="well">';

echo BSHtml::pageHeader(Yum::t('My friends'));

$this->widget('bootstrap.widgets.BsListView', array(
    'dataProvider' => $friends,
    'itemView' => '_myfriendsview',
    'template' => '{items}{pager}',
    'viewData' => array('model' => $friendModel),
    'emptyText' => Yum::t('You do not have any friends yet')
));

echo '</div>';