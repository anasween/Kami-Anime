<?php

$columns = YumProfile::getProfileFields();

 $this->widget('bootstrap.widgets.BsGridView', array(
    'id'=>'profiles-grid',
    'dataProvider'=>$dataProvider,
    'filter'=>null,
    'columns'=>$columns,
)
);


