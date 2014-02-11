<?php
/* @var $this ZhanrsController */
/* @var $data Zhanrs */

$this->widget('bootstrap.widgets.BsPanel',array(
    'header' => '<b>' . CHtml::encode($data->getAttributeLabel('id')) . ': </b>' . CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)),
    'body' => '<b>' . CHtml::encode($data->getAttributeLabel('title')) . ': </b>' . CHtml::encode($data->title),
)); 