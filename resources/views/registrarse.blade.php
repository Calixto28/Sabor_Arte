<x-layout>
  <div class="signupform-body">
    <div class="signupform-container">
      <h1 class="signup-title">¡Regístrarse!</h1>
      <form class="signupform" action="{{route('registrarse.registro')}}" method="POST">
        @csrf
        <input type="text" placeholder="Usuario" name="username" required>
        <input type="password" placeholder="Contraseña" name="password" required>
        <input type="text" placeholder="Nombre(es)" name="nombre" required>
        <input type="text" placeholder="Apellido Paterno" name="ape_paterno" required>
        <input type="text" placeholder="Apellido Materno" name="ape_materno" required>
        <input type="email" placeholder="Correo electrónico" name="email" required>
        <input type="text" placeholder="Teléfono" name="telefono" required>
        <div class="singupform-button">
          <button type="submit">Registrarme</button>
          <p>¿Ya tienes una cuenta? <a href="./login">Ingresar</a></p>
        </div>
      </form>
    </div>
  </div>
</x-layout>