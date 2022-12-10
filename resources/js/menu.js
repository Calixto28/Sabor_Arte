function actionModal(actions){
    switch (actions['type']) {
        case 'success':{
            $('body').append('<div class="modal active modal-success">'+
                '<div class="content-modal">'+
                    '<div class="icon-modal"><img src="resources/img/icon/icon-success.png" alt=""></div>'+
                    '<div class="title-modal">¡Exito!</div>'+
                    '<div class="message-modal">'+actions['message']+'</div>'+
                    '<div class="btn-section"><button class="btn btn-success" onclick="btnAccept()">'+actions['textConfirm']+'</button></div>'+
                '</div>'+
            '</div>');
        }break;
        case 'warning':{
            $('body').append('<div class="modal active modal-warning">'+
                '<div class="content-modal">'+
                    '<div class="icon-modal"><img src="resources/img/icon/icon-warning.png" alt=""></div>'+
                    '<div class="title-modal">¡Alerta!</div>'+
                    '<div class="message-modal">'+actions['message']+'</div>'+
                    '<div class="btn-section"><button class="btn btn-secondary-outline-black" onclick="btnCancel()">'+actions['textCancel']+'</button><button class="btn btn-warning" onclick="btnAccept()">'+actions['textConfirm']+'</button></div>'+
                '</div>'+
            '</div>');
        }break;
        case 'danger':{
            $('body').append('<div class="modal active modal-danger">'+
                '<div class="content-modal">'+
                    '<div class="icon-modal"><img src="resources/img/icon/icon-danger.png" alt=""></div>'+
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