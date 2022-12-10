<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="resources/css/main.css">
        <title>Home - Sabor Arte</title>
    </head>
    <body>

        <x-nav></x-nav>
        <div class="BodyPP">
            <div class="contenedorPP">
                <br><br><br><br>
                <img class="imNo" src="https://thumbs.dreamstime.com/b/cocineros-14984731.jpg" width=500px>
                <div class="cPP">
                    <p class="tPP">Sobre nosotros</p>
                    <p class="pPP">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Molestiae quam adipisci possimus consequatur veniam quidem accusamus labore ipsam, explicabo nulla dicta omnis unde nihil. Excepturi atque earum aliquid molestiae impedit?</p>
                </div>
                <div class="encerrarcards">
                    @php
                    $items=[
                    ['ImagenPlatillo'=>'https://cdn2.cocinadelirante.com/sites/default/files/styles/gallerie/public/images/2021/04/receta-sencilla-ensalada-de-pollo-con-mango.jpg',
                    'NombrePlatillo'=>'Ensalada de Pollo con Mango', 'precio'=>'$345'],
                    ['ImagenPlatillo'=>'https://cdn2.cocinadelirante.com/sites/default/files/styles/gallerie/public/images/2021/04/receta-sencilla-ensalada-de-pollo-con-mango.jpg',
                    'NombrePlatillo'=>'Ensalada de Pollo con Mango', 'precio'=>'$345']
                    ];
                    @endphp
                    <x-platillos :items="$items"></x-platillos>
                </div>
                <div class="ContenedorInfo">
                    <div class="linea">
                        <label class="iPP">Info. de Contacto</label>    
                        <label class="siPP">733-332-45-89</label>
                    </div>
                    <div class="linea">
                        <label class="iPP">Dirección</label>    
                        <label class="siPP">Iguala-Taxco, Adolfo Lopez Mateos,</label>
                        <label class="siPP">40030 Iguala de la Independencia, Gro.</label>
                    </div>
                    <label class="iPP">Mapa</label>    
                    <div class="mapa">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3784.764199385376!2d-99.58075649999999!3d18.4490124!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85cc4b321e111a9b%3A0x747fec28bc3a8877!2sIguala%20-%20Taxco%2C%20Guerrero!5e0!3m2!1ses-419!2smx!4v1667885309415!5m2!1ses-419!2smx" width="600" height="420" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>        
                    </div>
                </div>
                <div class="body22">
                    <x-res></x-res>
                </div>
            </div>
            <x-footer>
                <div class="img">
                    <img src="https://www.logogenio.es/icons/preview/5358" width="200px">
                </div>
            </x-footer>
        </div>

    </body>
</html>