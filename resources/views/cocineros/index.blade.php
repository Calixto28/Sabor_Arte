<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= $session['route'] ?>/resources/css/app.css">
        <link rel="stylesheet" href="<?= $session['route'] ?>/resources/fonts/css/fontawesome.min.css">
        <link rel="stylesheet" href="<?= $session['route'] ?>/resources/fonts/css/brands.min.css">
        <link rel="stylesheet" href="<?= $session['route'] ?>/resources/fonts/css/solid.min.css">
        <script type="text/javascript" src="<?= $session['route'] ?>/resources/js/jquery-3.6.0.min.js"></script>
        <title>Ordenes - Sabor Arte</title>
    </head>

    <body>
        <header id="headerCocinero">
            <article>
                <section class="categorias">
                    <ul>
                        <li><a href="{{route('cocineros.index')}}">Ordenes</a></li>
                    </ul>
                </section>
                <section class="logout">
                    <a href="<?= env('APP_URL') ?>/logout">Salir</a>
                </section>
            </article>
        </header>
        <article id="ordenes">
            <section class="list-ordenes">
                @foreach ($ordenes as $orden)   
                    <div class="orden">
                        <div class="information">
                            <div class="btn-view-detail" data-id="{{$orden->id}}">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            <div class="number-orden">
                                Orden #{{$orden->id}} 
                            </div>
                        </div>
                        <div id="detailInformation{{$orden->id}}" class="detail-information">
                        </div>
                    </div>
                @endforeach
            </section>
        </article>
        <div class="modal">
            <div class="content-modal">
                
            </div>
        </div>
    </body>
</html>
<script>
    $(document).ready(function(){
        $('.btn-view-detail').click(function(){
            $('.content-detail').remove()
            let id = $(this).data('id')
            $.ajax({
                method: "POST",
                url: "mesero/getDetailOrden",
                data: { id: id, _token: "{{ csrf_token() }}" }
            }).done(function( res ) {
                for (i = 0; i < res.length; i++) {
                    let action = '<div class="check-producto-entregado"><i class="fas fa-check"></i></div>'
                    if(res[i].id_estatus == 1)
                        action = '<button class="btn btn-warning btn-producto" onclick="recetaProducto('+res[i].id+')"><i class="fas fa-file"></i></button> <button class="btn btn-primary btn-producto" onclick="productoCocinado('+res[i].id+')"><i class="fas fa-check"></i></button>'

                    let content = `<div id="contentDetail${res[i].id}" class="content-detail">
                        <div class="name-product">
                            ${res[i].cantidad}x ${res[i].producto}
                        </div>
                        <div class="btn-action">
                            ${action}
                        </div>
                    </div>`

                    $('#detailInformation'+id).append(content)
                }
            })
        })
        $('.modal').on("click",function(e) {
            var container = $(".content-modal");
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                $('.modal').removeClass('active');
            }
        });
    })
    function productoCocinado(id){
        $.ajax({
            method: "POST",
            url: "cocinero/productoCocinado",
            data: { id: id, _token: "{{ csrf_token() }}" }
        }).done(function( res ) {
            $('#contentDetail'+id+' .btn-action').html('')
            $('#contentDetail'+id+' .btn-action').html('<div class="check-producto-entregado"><i class="fas fa-check"></i></div>')
        })
    }
    function recetaProducto(id){
        $.ajax({
            method: "POST",
            url: "cocinero/recetaProducto",
            data: { id: id, _token: "{{ csrf_token() }}" }
        }).done(function( res ) {
            $('.content-modal').html('')
            $('.content-modal').html('<div class="text-receta">'+res+'</div>')
            $('.modal').addClass('active')
        })
    }
</script>