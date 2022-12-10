<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Panel de Administraci&oacute;n</title>
        <link rel="stylesheet" href="<?= $session['route'] ?>/resources/css/app.css">
        <link rel="stylesheet" href="<?= $session['route'] ?>/resources/fonts/css/fontawesome.min.css">
        <link rel="stylesheet" href="<?= $session['route'] ?>/resources/fonts/css/brands.min.css">
        <link rel="stylesheet" href="<?= $session['route'] ?>/resources/fonts/css/solid.min.css">
        <script type="text/javascript" src="<?= $session['route'] ?>/resources/js/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" src="<?= $session['route'] ?>/resources/js/app.js"></script>
        <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
        <script>
            function actionModal(actions){
                switch (actions['type']) {
                    case 'success':{
                        $('body').append('<div class="modal active modal-success">'+
                            '<div class="content-modal">'+
                                '<div class="icon-modal"><img src="<?= $session['route'] ?>/resources/img/icon/icon-success.png" alt=""></div>'+
                                '<div class="title-modal">¡Exito!</div>'+
                                '<div class="message-modal">'+actions['message']+'</div>'+
                                '<div class="btn-section"><button class="btn btn-success" onclick="btnAccept()">'+actions['textConfirm']+'</button></div>'+
                            '</div>'+
                        '</div>');
                    }break;
                    case 'warning':{
                        $('body').append('<div class="modal active modal-warning">'+
                            '<div class="content-modal">'+
                                '<div class="icon-modal"><img src="<?= $session['route'] ?>resources/img/icon/icon-warning.png" alt=""></div>'+
                                '<div class="title-modal">¡Alerta!</div>'+
                                '<div class="message-modal">'+actions['message']+'</div>'+
                                '<div class="btn-section"><button class="btn btn-secondary-outline-black" onclick="btnCancel()">'+actions['textCancel']+'</button><button class="btn btn-warning" onclick="btnAccept()">'+actions['textConfirm']+'</button></div>'+
                            '</div>'+
                        '</div>');
                    }break;
                    case 'danger':{
                        $('body').append('<div class="modal active modal-danger">'+
                            '<div class="content-modal">'+
                                '<div class="icon-modal"><img src="<?= $session['route'] ?>/resources/img/icon/icon-danger.png" alt=""></div>'+
                                '<div class="title-modal">¡Error!</div>'+
                                '<div class="message-modal">'+actions['message']+'</div>'+
                                '<div class="btn-section"><button class="btn btn-danger" onclick="btnCancel()">'+actions['textConfirm']+'</button></div>'+
                            '</div>'+
                        '</div>');
                    }break;
                    default:
                        alert('Hubo un error');
                    break;
                }
            }
            function btnAccept(){
                location.reload();
            }
            function btnCancel(){
                $('.modal').remove();
            }
        </script>
    </head>
    <body>
        <header>
            <div class="row content-header">
                <div class="btn-menu col-2 col-md-1" data-active="false">
                    <i class="fas fa-bars" onclick="openMenu()"></i>
                </div>
                <div class="information-user col-8 col-md-10">
                    <?= $session['nombre'].' '.$session['ape_paterno'].' '.$session['ape_materno'] ?>
                </div>
                <div class="btn-logout col-2 col-md-1">
                    <a href="<?= $session['route'] ?>/logout"><i class="fas fa-power-off"></i></a>
                </div>
            </div>
            <div class="content-menu">
                <div class="menu">
                    <div class="title-menu">MEN&Uacute;</div>
                    <?php if($session['menu'] != null){
                        foreach($session['menu'] as $menu){ ?>
                            <div class="parent style-menu">
                                <div class="active-parent">
                                    <i class="fas <?= $menu['fa_icon'] ?>"></i><span> <?= $menu['etiqueta'] ?></span>
                                </div>
                                <?php if($menu['children_menu'] != null){ ?>
                                    <div class="submenu">
                                        <?php foreach ($menu['children_menu'] as $submenu){ ?>
                                            <a href="<?= $session['route'] ?>/<?= $submenu['url'] ?>">
                                                <div class="children">
                                                    <div class="active-children">
                                                        <span class="icon-ball"><i class="fas fa-circle"></i></span>
                                                        <span> <?= $submenu['etiqueta'] ?></span>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php } ?>
                                    </div>
                                <?php } ?>
                            </div>
                    <?php }
                    } ?>
                </div>
            </div>
        </header>

        <div class="container">