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
            <label for="varchar">Username</label>
            <input type="text" name="username" id="username" placeholder="Username"  value="{{$username}}" required>
        </div>
        @if($display_password == true)
            <div class="col-12 col-sm-6 col-md-4 mb-5">
                <label for="varchar">Contraseña</label>
                <input type="password" name="password" id="password" placeholder="Contraseña"  value="{{$password}}" required>
            </div>
        @endif
        <div class="col-12 col-sm-6 col-md-4 mb-5">
            <label for="varchar">Perfil</label>
            <select type="text" name="id_perfil" id="id_perfil" value="{{$id_perfil}}" required>
                <option value="0">--- Seleccione ---</option>
                <?php
                    foreach ($perfiles as $perfil) {
                        if($perfil['id'] == $id_perfil){
                ?>
                    <option selected value="<?= $perfil['id'] ?>"><?= $perfil['perfil_descripcion'] ?></option>
                <?php } else { ?>
                    <option value="<?= $perfil['id'] ?>"><?= $perfil['perfil_descripcion'] ?></option>
                <?php }
                    }
                ?>
            </select>
        </div>
        <div class="col-12 col-sm-6 col-md-4 mb-5">
            <label for="varchar">Nombre</label>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre"  value="{{$nombre}}" required>
        </div>
        <div class="col-12 col-sm-6 col-md-4 mb-5">
            <label for="varchar">Apellido Paterno</label>
            <input type="text" name="ape_paterno" id="ape_paterno" placeholder="Apellido Paterno"  value="{{$ape_paterno}}" required>
        </div>
        <div class="col-12 col-sm-6 col-md-4 mb-5">
            <label for="varchar">Apellido Materno</label>
            <input type="text" name="ape_materno" id="ape_materno" placeholder="Apellido Materno"  value="{{$ape_materno}}" required>
        </div>
        <div class="col-12 col-sm-6 col-md-4 mb-5">
            <label for="varchar">Correo Electrónico</label>
            <input type="email" name="email" id="email" placeholder="Correo Electrónico"  value="{{$email}}" required>
        </div>
        <div class="col-12 col-sm-6 col-md-4 mb-5">
            <label for="varchar">Teléfono</label>
            <input type="text" name="telefono" id="telefono" placeholder="Teléfono"  value="{{$telefono}}" required>
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