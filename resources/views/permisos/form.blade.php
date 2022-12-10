<div class="header-form">
    <div class="title-form">{{$title}}</div>
</div>
<form class="form-section" action="{{$action}}" method="POST">
    @csrf

    @if($method == true)
        @method('put')
    @endif
    <div class="table-section">
        <table id="list_users_permissions" class="table table-striped-secondary mb-5">
            <thead>
                <tr>
                    <th></th>
                    <th>Principales</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if($opciones_menu != null){ ?>
                    <?php foreach($opciones_menu as $parent_menu){ ?>
                        <tr>
                            <td style="text-align:center;"><input type="checkbox" name="<?= $parent_menu['id_menu'] ?>" id="parent_<?= $parent_menu['id_menu'] ?>" class="parents" data-id="<?= $parent_menu['id_menu'] ?>" data-checked="<?= $parent_menu['checked'] ?>" <?= $parent_menu['checked'] ?>></td>
                            <td><?= $parent_menu['etiqueta'] ?></td>
                            <td></td>
                        </tr>
                        <?php if($parent_menu['opciones_children'] != null){ ?>
                            <?php foreach($parent_menu['opciones_children'] as $son_menu){ ?>
                                <tr>
                                    <td style="text-align:center;"><input type="checkbox" class="check_<?= $son_menu['parent_menu_id'] ?> children"  name="<?= $son_menu['id_menu'] ?>" id="son_<?= $son_menu['id_menu'] ?>" data-id="<?= $son_menu['id_menu'] ?>" data-parent="<?= $son_menu['parent_menu_id'] ?>" data-checked="<?= $son_menu['checked'] ?>" <?= $son_menu['checked'] ?>></td>
                                    <td></td>
                                    <td><?= $son_menu['etiqueta'] ?></td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
        <div class="btn-section">
            <input type="hidden" name="id" id="id" value="<?= $perfil['id_perfil'] ?>" />
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
    $(".parents").click(function(){
        var id_parent = $(this).data('id');
        if($('#parent_'+id_parent).prop('checked'))
            $('.check_'+id_parent).prop('checked', true);
        else
            $('.check_'+id_parent).prop('checked', false);
    });
    $(".children").click(function(){
        var id_son = $(this).data('id');
        var id_parent = $(this).data('parent');
        if($('#son_'+id_son).prop('checked'))
            $('#parent_'+id_parent).prop('checked', true);
    });
</script>