<?php
$this->title = Yum::t('Browse users');
$this->breadcrumbs = array(
            Yum::t('Browse users')
        );
?>
<div class="search_options">

<?php 
$form=$this->beginWidget(
    'bootstrap.widgets.BsActiveForm', 
    array(
        'layout' => BSHtml::FORM_LAYOUT_SEARCH,
        'id'=>'user-browse-form',
        'enableAjaxValidation'=>false,
        'htmlOptions' => array(
            'enctype'=>'multipart/form-data',
            'class' => 'well'
        ),
    )
);  
?>
<fieldset>
<?php
echo BSHtml::textFieldControlGroup('search_username', $search_username, array(
    'submit' => array('//user/user/browse'),
    'class' => 'form-control',
    'style' => 'width: 200px',
    'append' =>BSHtml::submitButton(Yum::t('Search'), array(
                    'color' => BSHtml::BUTTON_COLOR_INFO,
                    'icon' =>  BSHtml::GLYPHICON_SEARCH,
                ))
));
?>
</fieldset>
<?php 
$this->endWidget();

$this->widget('bootstrap.widgets.BsListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view', 
    'template' => '{summary} {sorter} {items} <div style="clear:both;"></div> {pager}',
    'sortableAttributes'=>array(
        'username',
        'lastvisit',
    ),
));

?>

</div>

<div style="clear: both;"> </div>


