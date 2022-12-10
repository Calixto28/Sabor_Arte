<div class="header-list">
    <div class="title-list">{{$title}}</div>
    <div class="btn-add">
        <a class="btn btn-secondary" href="javascript:history.back(-1);">Regresar</a>
    </div>
</div>
<div class="table-section">
    <table class="table table-striped-secondary mb-5">
        <thead>
            <tr class="color-white">
                <th scope="col">Producto</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rowsData as $data)
            <tr>
                <td>{{ $data['descripcion'] }}</td>
                <td>${{ number_format($data['total'],2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Pagination --}}
<div class="d-flex justify-content-center content-pagination">
    {!! $detallesOrden->links() !!}
</div>