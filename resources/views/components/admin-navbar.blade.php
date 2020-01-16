<div class="navbar navbar-default ">
    <div class="container-fluid"> 
        <div class="navbar-header"> 
            <button type="button" class="collapsed navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-5" aria-expanded="false"> 
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
            </button> 
            <a href="{{ url('/admin') }}" class="navbar-brand">{{ $AppName }}</a> 
        </div> 
        <div class="collapse">admin</div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-5"> 
            <p class="navbar-text navbar-right">
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"
                    class="navbar-link"><span class="glyphicon glyphicon-off"></span>
                        Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </p> 
        </div> 
    </div>
</div>
@php
    $action = explode('.', Route::current()->action['as']) 
@endphp

@if($action[1] == 'index')
    <div class="container-fluid">
        <ul class="nav nav-pills">
            <li role="presentation" {{ (Route::current()->uri == 'admin/company') ? 'class=active' : ''}} ><a href="{{ route('company.index') }}">Companies</a></li>
            <li role="presentation" {{ (Route::current()->uri == 'admin/plan') ? 'class=active' : ''}} ><a href="{{ route('plan.index') }}">Plans</a></li>
            <li role="presentation"><a href="#">Salesman</a></li>
        </ul>
    </div>
    <hr>
@endif