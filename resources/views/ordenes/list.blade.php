<div class="header-list">
    <div class="title-list">{{$title}}</div>
</div>
<div class="table-section">
    <table class="table table-striped-secondary mb-5">
        <thead>
            <tr class="color-white">
                <th scope="col"># Orden</th>
                <th scope="col">Nombre Cliente/Mesero</th>
                <th scope="col" style="min-width:140px;width:140px;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ordenes_data as $data)
            <tr>
                <td>{{ $data['id'] }}</td>
                <td>{{ $data['nombre'] }}</td>
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
    {!! $ordenes->links() !!}
</div>