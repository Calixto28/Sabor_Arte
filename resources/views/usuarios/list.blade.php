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
                <th scope="col">Username</th>
                <th scope="col">Nombre</th>
                <th scope="col">Perfil</th>
                <th scope="col">Email</th>
                <th scope="col">Teléfono</th>
                <th scope="col" style="min-width:140px;width:140px;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios_data as $data)
            <tr>
                <td>{{ $data['id'] }}</td>
                <td>{{ $data['username'] }}</td>
                <td>{{ $data['nombre'] }} {{ $data['ape_paterno'] }} {{ $data['ape_materno'] }}</td>
                <td>{{ $data['perfil_descripcion'] }}</td>
                <td>{{ $data['email'] }}</td>
                <td>{{ $data['telefono'] }}</td>
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
    {!! $usuarios->links() !!}
</div>