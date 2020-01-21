<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark border-bottom border-secondary">
    <a class="navbar-brand" href="{{ url('/') }}">
        @if(is_file('images/logo.png'))
            <img src="{{ asset('images/logo.png') }}" alt="{{ env('APP_NAME') }}">
        @else
            {{ env('APP_NAME') }} 
        @endif
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavBar" aria-controls="mainNavBar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNavBar">
        @auth
        {{--  Left Align Begin --}}
        {{--  Controle de Acesso  --}}
        <ul class="nav navbar-nav mr-auto">
            @role(['admin'])
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownControleAcesso" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Controle de Acesso
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownControleAcesso">
                    <li class="nav-item dropdown">
                        @permission('listar-user')
                        <li><a class="dropdown-item" href="{{route('user.index')}}">Usuários</a></li>
                        @endpermission
                        @permission('listar-role')
                        <li><a class="dropdown-item" href="{{route('role.index')}}">Perfis de Acesso</a></li>
                        @endpermission
                    </li>
                </ul>
            </li>
            @endrole
        </ul>
        {{--  Left Align End  --}}
        {{--  Right Align Begin  --}}
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    <i class="fas fa-user-circle fa-lg"></i>  {{ Auth::user()->name }} <span class="caret"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                    <li><a class="dropdown-item" href="{{route('user.profile')}}"><i class="fas fa-user-cog"></i> Minha Conta</a></li>
                    <div class="dropdown-divider"></div>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            <i class="fas fa-power-off"></i> Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
        {{--  Right Align End  --}}
        @endauth
    </div>
</nav>