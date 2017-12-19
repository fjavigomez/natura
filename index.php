<?php    
    session_set_cookie_params(0);
    include_once('init.php');
    include_once('config.php');
    include_once(DOC_ROOT.'/libraries.php');

    if (!isset($_SESSION)){        
        session_start();
    }

    $pages = array(
        'login',
        'login2',
        'logout',
        'homepage',
        'hospitalizacion',
		'consulta',
        'inventario',
        'aseguradora',
        'facturacion',
        'usuarios',
    );

    $page = $_GET['page'];


    if(!in_array($page, $pages)){
        $page = 'homepage';
    }

    include_once(DOC_ROOT.'/modules/user.php');
    include_once(DOC_ROOT.'/modules/'.$page.'.php');

    $smarty->assign('page', $page);
    $smarty->assign('section', $_GET['section']);

    $pageTpl =  $page;
    if($_GET['section']){
        $pageTpl =  $_GET['page']."_".$_GET['section'];
    }

    if($_SESSION['logo'] != ''){
        $logo = WEB_ROOT.'/logotipos/'.$_SESSION['logo'];
    } else {
        $logo = WEB_ROOT.'/img/logo.jpg';
    }

    $smarty->assign('pageTpl', $pageTpl);
    $smarty->assign('lang', $lang);
    $smarty->assign('logo', $logo);
    $smarty->display(DOC_ROOT.'/templates/index.tpl');
?>