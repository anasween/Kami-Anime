<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="ru" />
        <!--CSS-->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        
        <?php
        $cs        = Yii::app()->clientScript;
        $themePath = Yii::app()->baseUrl;

        /**
         * StyleSHeets
         */
        $cs->registerCssFile($themePath . '/css/bootstrap.min.css');
        $cs->registerCssFile($themePath . '/css/bootstrap-theme.min.css');

        /**
         * JavaScripts
         */
        $cs->registerCoreScript('jquery', CClientScript::POS_END);
        $cs->registerCoreScript('jquery.ui', CClientScript::POS_END);
        $cs->registerScriptFile($themePath . '/js/bootstrap.min.js', CClientScript::POS_END);
        $cs->registerScript('tooltip', "$('[data-toggle=\"tooltip\"]').tooltip();$('[data-toggle=\"popover\"]').tooltip()", CClientScript::POS_READY);
        ?>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="<?php
        echo Yii::app()->baseUrl . '/js/html5shiv.js';
        ?>"></script>
            <script src="<?php
        echo Yii::app()->baseUrl . '/js/respond.min.js';
        ?>"></script>
        <![endif]-->

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
    <?php
    //Generating items for top menu
    $menuItems = array(
        array(
            'label' => Yum::t('Main'), 
            'url' => array('/'.Yii::app()->defaultController), 
            'active'=>Yii::app()->controller->id==Yii::app()->defaultController,
        ),
        array(
            'label' => Yum::t('Anime'), 
            'url' => '#', 
            'active'=>Yii::app()->controller->id=='anime',
            'items' => array(
                array(
                    'label' => '123',
                )
            ),
            'visible' => false
        ),
        array(
            'label' => Yum::t('Manga'), 
            'url' => '#', 
            'active'=>Yii::app()->controller->id=='manga',
            'visible' => false
        ),
        array(
            'label' => Yum::t('Dorams'), 
            'url' => '#', 
            'active'=>Yii::app()->controller->id=='dorama',
            'visible' => false
        ),
       
    );
    $rightMenuItems = $this->getUserMenu();
    $rightMenuItems[] = array(
                            'label'=>Yum::t('Login'), 
                            'url'=>array('//user/login'), 
                            'visible'=>Yii::app()->user->isGuest,
                            'active'=>Yii::app()->controller->action->id=='login',
                        );
    
    $this->widget('bootstrap.widgets.BsNavbar',
        array(
            'collapse' => true,
            'brandLabel' => BSHtml::icon(BSHtml::GLYPHICON_HOME),
            'brandUrl' => Yii::app()->homeUrl,
            'items' => array(
                array(
                    'class' => 'bootstrap.widgets.BsNav',
                    'type' => 'navbar',
                    'activateParents' => true,
                    'items' => $menuItems,
                ),
                array(
                    'class' => 'bootstrap.widgets.BsNav',
                    'type' => 'navbar',
                    'activateParents' => true,
                    'items' => $rightMenuItems,
                    'htmlOptions' => array(
                        'pull' => BSHtml::NAVBAR_NAV_PULL_RIGHT
                    )
                )
            ),
        )
    );
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php if(isset($this->breadcrumbs)):?>
                        <?php $this->widget(
                            'bootstrap.widgets.BsBreadcrumb',
                            array(
                                'homeLink' => BSHtml::openTag('li') . BSHtml::icon(BSHtml::GLYPHICON_HOME) . BSHtml::closeTag('li'),
                                'links' => $this->breadcrumbs,
                            )); ?>
                <?php endif?>

                <?php echo $content; ?>
            </div>
        </div>
        <div class="row-fluid">    
            <footer class="span12">
                Copyright &copy; 2007-<?php echo date('Y'); ?> by Kami-Anime. Все права защищены.
            </footer>
        </div>
    </div>
</body>
</html>