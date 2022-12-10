<div class="header-list">
    <div class="title-list">{{$title}}</div>
    <div class="btn-add">
        <a class="btn btn-secondary" href="{{$action}}">Nuevo</a>
    </div>
</div>
<div class="table-section">
    <table class="table table-striped-secondary mb-5">
        <thead>
            <tr class="color-white">
                <th scope="col">#</th>
                <th scope="col">Etiqueta</th>
                <th scope="col">Url</th>
                <th scope="col">Icono</th>
                <th scope="col">Menú Padre</th>
                <th scope="col">Orden</th>
                <th scope="col" style="min-width:140px;width:140px;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($opciones_menu_data as $data)
            <tr>
                <td>{{ $data['id'] }}</td>
                <td>{{ $data['etiqueta'] }}</td>
                <td>{{ $data['url'] }}</td>
                <td align="center"><i class="fas {{ $data['fa_icon'] }}"></i></td>
                <td>{{ $data['parent'] }}</td>
                <td>{{ $data['orden'] }}</td>
                <td align="center" style="min-width:140px;width:140px;">
                    @foreach($data['acciones'] as $accion)
                        <a href="{{$accion['href']}}" class="btn-action-list {{$accion['class']}} text-white" title="{{$accion['title']}}"><li class="{{$accion['icon']}}"></li></a>
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Pagination --}}
<div class="d-flex justify-content-center content-pagination">
    {!! $opciones_menu->links() !!}
</div>