<header id="headerMesero">
    <article>
        <section class="categorias">
            <ul>
                <li><a href="{{route('meseros.index')}}">Ordenes</a></li>
                <li><a href="{{route('meseros.orden')}}">Generar Orden</a></li>
            </ul>
        </section>
        <section class="logout">
            <a href="<?= env('APP_URL') ?>/logout">Salir</a>
        </section>
    </article>
</header>