<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ route('inicio') }}">Viajes Laravel</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('inicio') }}">Inicio</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownOperators" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Operadores
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownOperators">
                    <a class="dropdown-item" href="{{ route('operatorsList') }}">Listado</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownTours" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Viajes
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownTours">
                    <a class="dropdown-item" href="{{ route('toursList') }}">Listado</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownCustomers" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Clientes
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownCustomers">
                    <a class="dropdown-item" href="#">Listado</a>
                    <a class="dropdown-item" href="#">Crear</a>
                    <a class="dropdown-item" href="#">Editar</a>
                    <a class="dropdown-item" href="#">Eliminar</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
