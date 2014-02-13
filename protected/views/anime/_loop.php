<?php
$this->widget('bootstrap.widgets.BsListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'emptyText' => Yum::t('No anime found'),
    'ajaxUpdate'=>false,
    'sortableAttributes'=>array(
        'modify' => Yum::t('Last change'),
        'year' => Yum::t('Year'),
        'name_jp' => Yum::t('NaJp'),
        'name_en' => Yum::t('NaEn'),
        'name_ru' => Yum::t('NaRu'),
    ),
    'template' => '
        {sorter}{items}
        <div class="col-md-12" style="text-align: center;">{pager}</div>'
));