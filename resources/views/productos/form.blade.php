<div class="header-form">
    <div class="title-form">{{$title}}</div>
</div>
<form class="form-section" action="{{$action}}" method="POST" enctype="multipart/form-data">
    @csrf

    @if($method == true)
        @method('put')
    @endif
    <div class="row">
        <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-5">
            <label for="varchar">Descripción</label>
            <input type="text" name="producto_descripcion" id="producto_descripcion" placeholder="Descripción Español"  value="{{$producto_descripcion}}" required>
        </div>
        <div class="col-8 col-sm-4 col-md-4 col-lg-2 mb-5">
            <label for="varchar">Precio</label>
            <input type="number" name="precio" id="precio" placeholder="Precio"  value="{{$precio}}">
        </div>
        <div class="col-12 mb-5">
            <label for="varchar">Detalle</label>
            <textarea name="producto_detalle" id="producto_detalle" rows="10" cols="80">{{$producto_detalle}}</textarea>
        </div>
        <div class="col-12 mb-5">
            <label for="varchar">Receta</label>
            <textarea name="producto_receta" id="producto_receta" rows="10" cols="80">{{$producto_receta}}</textarea>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-5">
            <label for="varchar">Categoría</label>
            <select type="text" name="id_categoria" id="id_categoria" value="{{$id_categoria}}" required>
                <option value="0">--- Seleccione ---</option>
                <?php
                    foreach ($categorias as $categoria) {
                        if($categoria['id'] == $id_categoria){
                ?>
                    <option selected value="<?= $categoria['id'] ?>"><?= $categoria['categoria_descripcion'] ?></option>
                <?php } else { ?>
                    <option value="<?= $categoria['id'] ?>"><?= $categoria['categoria_descripcion'] ?></option>
                <?php }
                    }
                ?>
            </select>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-2 mb-5">
            <label for="varchar">Orden</label>
            <input type="number" name="orden" id="orden" placeholder="Orden"  value="{{$orden}}" required>
        </div>
        <div class="col-12 col-sm-12 col-lg-6 mb-5">
            <label for="varchar">Multimedia</label>
            <div class="col-12">
                <div id="content_multimedia" class="{{$active_multimedia}}">
                    @if($multimedia != '')
                        @if($type_multimedia == 'image')
                            <img src="{{$session['route']}}/assets/productos/{{$multimedia}}" />
                            <div class="toils-user">
                                <i class="fas fa-times-circle delete-image"></i>
                                <i class="fas fa-search-plus img-preview" data-image="{{$session['route']}}/assets/productos/{{$multimedia}}"></i>
                            </div>
                        @else
                            <video autoplay class="video" controls> <source src="{{$session['route']}}/assets/productos/{{$multimedia}}" type="video/mp4; "/></video>
                            <div class="toils-video">
                                <i class="fas fa-times-circle delete-video"></i>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
            <div class="col-12">
                <div id="select_images"><i class="fas fa-photo-video"></i> Seleccionar Multimedia</div>
                <input class="d-none" type="file" id="file" name="file">
            </div>
        </div>
        <div class="btn-section">
            <input type="text" class="form-control d-none" name="multimedia_new" id="multimedia_new" value="{{$multimedia}}"/>
            <input type="text" class="form-control d-none" name="multimedia" id="multimedia" value="{{$multimedia}}"/>
            <input type="text" class="form-control d-none" name="multimedia_old" id="multimedia_old" value="{{$multimedia_old}}"/>
            <input type="hidden" name="id" id="id" value="{{$id}}" />
            <div onClick="history.go(-1); return false;" class="btn btn-secondary-outline-black">
                Cancelar
            </div>
            <button type="submit" class="btn btn-orange">
                <?= $button ?>
            </button>
        </div>
    </div>
</form>
<div id="preview_image" class="modal">
    <div class="content-modal-img">
        <div id="image_content" class="modal-content">
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace('producto_detalle_es');
    CKEDITOR.replace('producto_detalle_en');
    $(document).ready(function(){
        $("#select_images").click(function(){
            $("#file").click();
        });
        $("#file").on("change", function(){
            var image_verify = true;
            var image = $("#file").prop("files")[0];
            var navegador = window.URL || window.webkitURL;
            var certify = validarExtension(image);
            if(certify == true){
                var type = $("#file").prop("files")[0]['type'];
                let posicion = type.indexOf('video');
                $("#content_multimedia").removeClass('active');
                $("#content_multimedia").html('');
                $("#multimedia").val('');
                $("#multimedia_new").val($("#file").prop("files")[0]['name']);
                var objeto_url = navegador.createObjectURL(image);
                if (posicion !== -1){
                    $("#content_multimedia").prepend('<video autoplay class="video" controls> <source src="'+objeto_url+'" type="video/mp4; "/></video><div class="toils-video"><i class="fas fa-times-circle delete-video"></i></div>');
                }else{
                    $("#content_multimedia").prepend('<img src="'+objeto_url+'" /><div class="toils-user"><i class="fas fa-times-circle delete-image"></i><i class="fas fa-search-plus img-preview" data-image="'+objeto_url+'"></i></div>');
                }
                $("#content_multimedia").addClass('active');
            }else{
                image_verify = false;
            }
            if(image_verify == false){
                var actions = {
                    type: 'danger',
                    message: 'Algunos archivos no estan dentro de los formatos permitidos (.png, .gif, .jpeg, .jpg, .bmp, .tiff, .tif, .jfif, .mp4, .svg).',
                    textConfirm: 'Cerrar',
                    textCancel: ''
                };
                actionModal(actions);
            }
        });
        $(document).on('click', '.delete-image', function () {
            $("#content_multimedia").html('');
            $("#content_multimedia").removeClass('active');
            $('#multimedia').val('');
            $("#multimedia_new").val('');
        });
        $(document).on('click', '.delete-video', function () {
            $("#content_multimedia").html('');
            $("#content_multimedia").removeClass('active');
            $('#multimedia').val('');
            $("#multimedia_new").val('');
        });
        $(document).on('click', '.img-preview', function () {
            var image = $(this).data('image');
            $("#image_content").html('');
            $("#image_content").append('<img src="'+image+'" width="100%" height="auto">');
            $(function(){
                $("#preview_image").appendTo("body");
            });
            $('#preview_image').addClass('active');
        });
        $('#preview_image').on("click",function(e) {
            var container = $(".content-modal-img");
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                $('#preview_image').removeClass('active');
            }
        });
    });

</script>