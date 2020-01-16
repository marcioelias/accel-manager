<nav class="navbar navbar-default">
    {{--  <div class="container">  --}}
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-2">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            @guest
            <a class="navbar-brand" href="/">Sul Online</a>
            @else
            <a class="navbar-brand" href="/admin/home">Sul Online</a>
            @endguest
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="navbar-collapse-2">
            <ul class="nav navbar-nav navbar-right">
                @guest
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Acesso Adm.</b> <span class="caret"></span></a>
                    <ul id="login-dp" class="dropdown-menu">
                        <li>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <strong>Acesso a Área Administrativa</strong>
                                    </div>
                                    <div class="text-center divider">
                                    </div>
                                    <form class="form" role="form" method="POST" action="{{ route('login') }}" accept-charset="UTF-8" id="login-nav">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label class="sr-only" for="username">Email address</label>
                                            <input type="text" class="form-control" id="username" placeholder="Usuário" name="username" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="sr-only" for="password">Password</label>
                                            <input type="password" class="form-control" id="password" placeholder="Senha" name="password" required>
                                            <div class="help-block text-right"><a href="{{ route('password.request') }}">Esqueceu a senha?</a></div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                                        </div>
                                            <div class="checkbox">
                                                <label>
                                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Manter-se conectado
                                                </label>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                @else
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>{{ Auth::user()->name }}</b> <span class="caret"></span></a>
                    <ul id="login-dp" class="dropdown-menu">
                        <li>
                            <div class="row">
                                <div class="col col-md-12 col-lg-12">
                                    <div class="text-center">
                                        <a href="{{ route('logout') }}" 
                                            class="btn btn-danger btn-block"
                                            onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            Sair
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                @endguest

            </ul>
            <ul class="nav navbar-nav">
                <li>
                    <ul class="nav nav-pills">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">Profile</a></li>
                    <li class="disabled"><a href="#">Disabled</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Dropdown <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        </ul>
                    </li>
                    </ul>
                </li>
            </ul>
            @if(isset($menuItems))
            <ul class="nav navbar-nav{{--   navbar-right  --}}">
                @foreach($menuItems as $menuItem)
                <li><a href="{{$menuItem['url']}}">{{$menuItem['rotulo']}}</a></li>
                @endforeach
            </ul>
            @endif
        </div><!-- /.navbar-collapse -->
    {{--  </div>  --}}<!-- /.container -->
</nav><!-- /.navbar -->