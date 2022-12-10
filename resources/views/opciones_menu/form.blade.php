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
            <label for="varchar">Etiqueta</label>
            <input type="text" name="etiqueta" id="etiqueta" placeholder="Etiqueta"  value="{{$etiqueta}}" required>
        </div>
        <div class="col-12 col-sm-6 col-md-4 mb-5">
            <label for="varchar">Clave Padre</label>
            <select type="text" name="parent_menu_id" id="parent_menu_id" value="{{$parent_menu_id}}" required>
                <option value="0">--- Seleccione ---</option>
                <?php
                    foreach ($list_parents as $parent) {
                        if($parent['id'] == $parent_menu_id){
                ?>
                    <option selected value="<?= $parent['id'] ?>"><?= $parent['etiqueta'] ?></option>
                <?php } else { ?>
                    <option value="<?= $parent['id'] ?>"><?= $parent['etiqueta'] ?></option>
                <?php }
                    }
                ?>
            </select>
        </div>
        <div class="col-12 col-sm-6 col-md-4 mb-5">
            <label for="varchar">Enlace</label>
            <input type="text" name="url" id="url" placeholder="Enlace" value="{{$url}}" class="{{$disabled_url}}" {{$disabled_url}}>
        </div>
        <div class="col-12 col-sm-6 col-md-4 mb-5">
            <label for="varchar">Icono</label>
            <input type="text" name="fa_icon" id="fa_icon" placeholder="Icono" value="{{$fa_icon}}" class="{{$disabled_fa_icon}}" {{$disabled_fa_icon}}>
        </div>
        <div class="col-12 col-sm-6 col-md-4 mb-5">
            <label for="varchar">Orden</label>
            <input type="text" name="orden" id="orden" placeholder="Orden" value="{{$orden}}" required>
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

<script>
    $(document).ready(function() {
        $("#parent_menu_id").change(function(){
            if($(this).val() == 0){
                $("#fa_icon").prop("disabled", false);
                $("#url").prop("disabled", true);
                $("#fa_icon").removeClass('disabled');
                $("#url").addClass('disabled');
                $("#url").val('');
            }else{
                $("#url").removeClass('disabled');
                $("#fa_icon").addClass('disabled');
                $("#fa_icon").val('');
                $("#fa_icon").prop("disabled", true);
                $("#url").prop("disabled", false);
            }
        });
    });
</script>