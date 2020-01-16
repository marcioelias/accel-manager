<div class="navbar navbar-default">
    <div class="container-fluid"> 
        <div class="navbar-header"> 
            <button type="button" class="collapsed navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-5" aria-expanded="false"> 
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> 
            </button> 
            <a href="{{ url('/') }}" class="navbar-brand">{{ $AppName }}</a> 
        </div> 
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-5"> 
            <p class="navbar-text navbar-right"><a href="{{ route('login') }}" class="navbar-link">Login</a></p> 
        </div> 
    </div>
</div>