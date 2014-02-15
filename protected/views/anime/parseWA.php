<?php
echo '<div class="well">';
echo BSHtml::pageHeader(Yum::t('Парсинг аниме с WA'));
echo BSHtml::tag('div', array('id' => 'info', 'class' => 'well'), '');
$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
        'id' => 'parseWA-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'class' => 'well',
            'enctype'=>'multipart/form-data'
        )
    ));
echo BSHtml::numberField('ParseWA[from]', 1, array('id' => 'valueFrom'));
echo BSHtml::numberField('ParseWA[to]', 10, array('id' => 'valueTo'));
echo BSHtml::button(Yum::t('Parse'), array(
    'id' => 'parseWAbtn',
    'data-loading-text' => Yum::t('Loading...')
));
$this->endWidget();
echo BSHtml::pageHeader(Yum::t('Парсинг связей с WA'));
echo BSHtml::tag('div', array('id' => 'info-connections', 'class' => 'well'), '');
$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
        'id' => 'parseWAConnections-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array(
            'class' => 'well',
            'enctype'=>'multipart/form-data'
        )
    ));
echo BSHtml::numberField('ParseConnectionsWA[from]', 1, array('id' => 'valueConnectionsFrom'));
echo BSHtml::numberField('ParseConnectionsWA[to]', 10, array('id' => 'valueConnectionsTo'));
echo BSHtml::button(Yum::t('Parse'), array(
    'id' => 'parseConnectionsWAbtn',
    'data-loading-text' => Yum::t('Loading...')
));
$this->endWidget();
echo '</div>';
Yii::app()->clientScript->registerScript('parseWA', "
    function ajaxAction() {
        var from = parseInt($('#valueFrom').val(), 10);
        var to = parseInt($('#valueTo').val(), 10);
        if (from <= to) {
            $('#parseWAbtn').button('loading');
            jQuery.ajax({
                'type':'POST',
                'url':'". $this->createUrl('/anime/addFromWA')."',
                'cache':false,
                'data':'ParseWA[from]='+from+'&ParseWA[to]='+from,
                'success':function(html){
                    jQuery('#info').html(html);
                    var from = parseInt($('#valueFrom').val(), 10);
                    $('#valueFrom').val(from + 1);
                    ajaxAction();
                }
            });
        } else {
            $('#parseWAbtn').button('reset');
        }
    }
    jQuery('body').on('click','#parseWAbtn',function(){
        ajaxAction();
        return false;
    });
    function ajaxConnectionsAction() {
        var from = parseInt($('#valueConnectionsFrom').val(), 10);
        var to = parseInt($('#valueConnectionsTo').val(), 10);
        if (from <= to) {
            $('#parseConnectionsWAbtn').button('loading');
            jQuery.ajax({
                'type':'POST',
                'url':'". $this->createUrl('/anime/addConnectionsFromWA')."',
                'cache':false,
                'data':'ParseConnectionsWA[from]='+from+'&ParseConnectionsWA[to]='+from,
                'success':function(html){
                    jQuery('#info-connections').html(html);
                    var from = parseInt($('#valueConnectionsFrom').val(), 10);
                    $('#valueConnectionsFrom').val(from + 1);
                    ajaxConnectionsAction();
                }
            });
        } else {
            $('#parseConnectionsWAbtn').button('reset');
        }
    }
    jQuery('body').on('click','#parseConnectionsWAbtn',function(){
        ajaxConnectionsAction();
        return false;
    });
", CClientScript::POS_END);