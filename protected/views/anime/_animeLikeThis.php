<?php
/** @var $anime Anime[] */

$items = array();
foreach ($anime as $a) {
    $item = array(
        'label' => $a->name_ru.' ['.$a->year.']',
        'url' => array('/anime/view', 'id' => $a->id)
    );
    array_push($items, $item);
}
$this->widget('bootstrap.widgets.BsListGroup', array(
    'htmlOptions' => array('style' => 'margin: 0;'),
    'items' => $items,
));