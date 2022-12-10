function openMenu(){
    var open = $('.btn-menu').data('active');
    if(open == false){
        $('.container').addClass('active');
        $('.content-menu').addClass('active');
        $('.btn-menu').data('active',true);
    }else if(open == true){
        $('.container').removeClass('active');
        $('.content-menu').removeClass('active');
        $('.btn-menu').data('active',false);
    }
}
function validarExtension(datos) {
    var extensionesValidas = ".png, .gif, .jpeg, .jpg, .bmp, .tiff, .tif, .jfif, .mp4, .svg";
    var ruta = datos['name'];
    var extension = ruta.substring(ruta.lastIndexOf('.') + 1).toLowerCase();
    var extensionValida = extensionesValidas.indexOf(extension);

    if(extensionValida < 0) {
        return false;
    } else {
        return true;
    }
}
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}