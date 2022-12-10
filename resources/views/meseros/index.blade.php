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
        <x-header_mesero></x-header_mesero>
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
                            @if($orden->id_estatus == 4)
                                <div class="actions">
                                    <div class="btn btn-success btn-orden-entregada" data-id="{{$orden->id}}">
                                        Orden Entregada
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div id="detailInformation{{$orden->id}}" class="detail-information">
                        </div>
                    </div>
                @endforeach
            </section>
        </article>
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
                    let action = '<div class="minus-producto-entregado"><i class="fas fa-minus"></i></div>'
                    if(res[i].id_estatus == 7)
                        action = '<button class="btn btn-primary btn-producto" onclick="productoEntregado('+res[i].id+')"><i class="fas fa-check"></i></button>'
                    else if(res[i].id_estatus == 8)
                        action = '<div class="check-producto-entregado"><i class="fas fa-check"></i></div>'

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
        $('.btn-orden-entregada').click(function(){
            let id = $(this).data('id')
            $.ajax({
                method: "POST",
                url: "mesero/ordenServida",
                data: { id: id, _token: "{{ csrf_token() }}" }
            }).done(function( res ) {
                location.reload();
            })
        })
    })
    function productoEntregado(id){
        $.ajax({
            method: "POST",
            url: "mesero/productoEntregado",
            data: { id: id, _token: "{{ csrf_token() }}" }
        }).done(function( res ) {
            $('#contentDetail'+id+' .btn-action').html('')
            $('#contentDetail'+id+' .btn-action').html('<div class="check-producto-entregado"><i class="fas fa-check"></i></div>')
        })
    }
</script>