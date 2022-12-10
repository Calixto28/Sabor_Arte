<x-layout>
    <div class="signupform-body">
        <div class="signupform-container">
            <h1 class="signup-title">INICIAR SESIÓN</h1>
            <form class="signupform" action="{{route('login.store')}}" method="POST">
                @csrf
                <div class="signupform__logo">
                    <img>
                </div>
                <div class="signupform__name-group">
                    <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 24 24">
                    <path d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm0 22c-3.123 0-5.914-1.441-7.749-3.69.259-.588.783-.995 1.867-1.246 2.244-.518 4.459-.981 3.393-2.945-3.155-5.82-.899-9.119 2.489-9.119 3.322 0 5.634 3.177 2.489 9.119-1.035 1.952 1.1 2.416 3.393 2.945 1.082.25 1.61.655 1.871 1.241-1.836 2.253-4.628 3.695-7.753 3.695z" />
                    </svg>
                    <input type="text" placeholder="Usuario" class="" name="usuario" autofocus>
                </div>
                <div class="signupform__name-group">
                    <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 24 24">
                    <path d="M10 17c0 .552-.447 1-1 1s-1-.448-1-1 .447-1 1-1 1 .448 1 1zm3 0c0 .552-.447 1-1 1s-1-.448-1-1 .447-1 1-1 1 .448 1 1zm3 0c0 .552-.447 1-1 1s-1-.448-1-1 .447-1 1-1 1 .448 1 1zm2-7v-4c0-3.313-2.687-6-6-6s-6 2.687-6 6v4h-3v14h18v-14h-3zm-10-4c0-2.206 1.795-4 4-4s4 1.794 4 4v4h-8v-4zm11 16h-14v-10h14v10z" />
                    </svg>
                    <input type="password" placeholder="Contraseña" name="password" class="">
                </div>
                <div class="footer">
                    <button type="submit">INGRESAR</button>
                    <p>¿Ya tienes una cuenta? <a href="./registrarse">Registrarse</a></p>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="resources/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="resources/js/app.js"></script>
    <script>
        $(document).ready(function(){
            var response = getParameterByName('response');
            if(response == '200'){
                var actions = {
                    type: 'success',
                    message: 'Se ha registrado correctamente',
                    textConfirm: 'Cerrar',
                    textCancel: ''
                };
                actionModal(actions);
            }else if(response == '501'){
                var actions = {
                    type: 'danger',
                    message: 'El usuario y la contraseña son incorrectos.',
                    textConfirm: 'Cerrar',
                    textCancel: ''
                };
                actionModal(actions);
            }else if(response == '502'){
                var actions = {
                    type: 'danger',
                    message: 'El usuario esta dado de baja.',
                    textConfirm: 'Cerrar',
                    textCancel: ''
                };
                actionModal(actions);
            }else if(response == '503'){
                var actions = {
                    type: 'danger',
                    message: 'La contraseña es incorrecta.',
                    textConfirm: 'Cerrar',
                    textCancel: ''
                };
                actionModal(actions);
            }else if(response == '504'){
                var actions = {
                    type: 'danger',
                    message: 'La cuenta ha sido bloqueada, contacta a un administrador/gerente.',
                    textConfirm: 'Cerrar',
                    textCancel: ''
                };
                actionModal(actions);
            }
        });
        function actionModal(actions){
            switch (actions['type']) {
                case 'success':{
                    $('body').append('<div class="modal active modal-success">'+
                        '<div class="content-modal">'+
                            '<div class="icon-modal"><img src="resources/img/icon/icon-success.png" alt=""></div>'+
                            '<div class="title-modal">¡Exito!</div>'+
                            '<div class="message-modal">'+actions['message']+'</div>'+
                            '<div class="btn-section"><button class="btn btn-success" onclick="btnCancel()">'+actions['textConfirm']+'</button></div>'+
                        '</div>'+
                    '</div>');
                }break;
                case 'warning':{
                    $('body').append('<div class="modal active modal-warning">'+
                        '<div class="content-modal">'+
                            '<div class="icon-modal"><img src="resources/img/icon/icon-warning.png" alt=""></div>'+
                            '<div class="title-modal">¡Alerta!</div>'+
                            '<div class="message-modal">'+actions['message']+'</div>'+
                            '<div class="btn-section"><button class="btn btn-secondary-outline-black" onclick="btnCancel()">'+actions['textCancel']+'</button><button class="btn btn-warning" onclick="btnAccept()">'+actions['textConfirm']+'</button></div>'+
                        '</div>'+
                    '</div>');
                }break;
                case 'danger':{
                    $('body').append('<div class="modal active modal-danger">'+
                        '<div class="content-modal">'+
                            '<div class="icon-modal"><img src="resources/img/icon/icon-danger.png" alt=""></div>'+
                            '<div class="title-modal">¡Error!</div>'+
                            '<div class="message-modal">'+actions['message']+'</div>'+
                            '<div class="btn-section"><button class="btn btn-danger" onclick="btnCancel()">'+actions['textConfirm']+'</button></div>'+
                        '</div>'+
                    '</div>');
                }break;
                default:
                    alert('Hubo un error');
                break;
            }
        }
        function btnAccept(){
            location.reload();
        }
        function btnCancel(){
            $('.modal').remove();
        }
    </script>
</x-layout>
<!-- <x-footer>
  <h1>hola</h1>
</x-footer> -->