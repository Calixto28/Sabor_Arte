<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= $session['route'] ?>/resources/css/app.css">
        <link rel="stylesheet" href="<?= $session['route'] ?>/resources/css/menu.css">
        <link rel="stylesheet" href="<?= $session['route'] ?>/resources/fonts/css/fontawesome.min.css">
        <link rel="stylesheet" href="<?= $session['route'] ?>/resources/fonts/css/brands.min.css">
        <link rel="stylesheet" href="<?= $session['route'] ?>/resources/fonts/css/solid.min.css">
        <script type="text/javascript" src="<?= $session['route'] ?>/resources/js/jquery-3.6.0.min.js"></script>
        <title>Menu - Sabor Arte</title>
    </head>

    <body>
        <x-header_mesero></x-header_mesero>
        <article id="menu">
            <section class="list-products">
                @foreach ($productos as $producto)
                    <div id="product{{$producto->id}}" class="product">
                        <div class="product-img">
                            <img src="{{ asset('assets') . '/productos/'.$producto->multimedia }}" alt="Imagen producto">
                        </div>
                        <div class="product-name">
                            {{$producto->producto_descripcion}}
                        </div>
                        <div class="product-description">
                            {{$producto->producto_detalle}}
                        </div>
                        <div class="product-price">
                            $ {{$producto->precio}}
                        </div>
                        <form action="{{route('clientes.agregarProducto')}}" method="POST">
                            @csrf
                            <div class="product-count">
                                <div class="minus" data-id="{{$producto->id}}"><i class="fas fa-minus"></i></div>
                                <input type="number" class="count" min="1" value="0" name="cantidad">
                                <div class="plus" data-id="{{$producto->id}}"><i class="fas fa-plus"></i></div>
                            </div>
                            <input type="hidden" value="{{$producto->id}}" name="producto_id">
                            <div class="product-btn">
                                <input type="submit" value="Agregar" class="btn btn-orange" data-id="{{$producto->id}}" />
                            </div>
                        </form>


                    </div>
                @endforeach
            </section>
            <section class="cart">
                @if (!empty($orden))
                    <h2>Orden del Día</h2>
                    <div class="list-cart">
                        @foreach ($detalles as $detalle)
                        <div class="product-cart" id="productCart1">
                            <div class="information">{{$detalle->cantidad}}x {{$detalle->producto}}</div>
                            <div class="subtotal">${{$detalle->cantidad*$detalle->precio}}</div>
                        </div>
                        @endforeach

                    </div>
                    <div class="total">
                        Total: <span>${{$total}}</span>
                    </div>
                    <form class="btn-create-order" method="POST" action="{{route('clientes.generarOrden')}}">
                        @csrf
                        <input type="submit" class="btn btn-success" value="Generar orden" />
                    </form>
                @else
                    <h2>Aún no agregas productos a tu carrito</h2>
                @endif
            </section>
        </article>
        <script>
            $(document).ready(function () {
                $('.minus').click(function () {
                    let id = $(this).data('id')
                    let count = $('#product' + id + ' .count').val()
                    if (count > 0) {
                        count--;
                        $('#product' + id + ' .count').val(count)
                    }
                })
                $('.plus').click(function () {
                    let id = $(this).data('id')
                    let count = $('#product' + id + ' .count').val()
                    count++;
                    $('#product' + id + ' .count').val(count)
                })
            })
        </script>
    </body>

</html>