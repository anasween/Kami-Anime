<?php
/* @var $this NewsController */
/* @var $dataProvider CActiveDataProvider */
$this->breadcrumbs=array(
            Yum::t('News'),
        );
?><h1>Новости</h1>

<div class="row">
    <div class="col-md-12">
        <?php 
        foreach ($news as $value)
        {
            $this->renderPartial('_shortView', array('model'=>$value));
        }
        ?>
        <?php 
            $this->widget('bootstrap.widgets.BsPager', array(
                'pages' => $pages
            ));
        ?>
        <div class="pagination">
        <?php
        //echo BSHtml::pagination($pages);
        ?>
        </div>
    </div>
</div>
