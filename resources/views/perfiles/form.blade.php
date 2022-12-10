<div class="header-form">
    <div class="title-form">{{$title}}</div>
</div>
<form class="form-section" action="{{$action}}" method="POST">
    @csrf

    @if($method == true)
        @method('put')
    @endif
    <div class="row">
        <div class="col-12 col-sm-6 col-md-4 mb-5">
            <label for="varchar">Descripción</label>
            <input type="text" name="perfil_descripcion" id="perfil_descripcion" placeholder="Descripción"  value="{{$perfil_descripcion}}" required>
        </div>
        <div class="btn-section">
            <input type="hidden" name="id" id="id" value="{{$id}}" />
            <div onClick="history.go(-1); return false;" class="btn btn-secondary-outline-black">
                Cancelar
            </div>
            <button type="submit" class="btn btn-orange">
                {{$button}}
            </button>
        </div>
    </div>
</form>