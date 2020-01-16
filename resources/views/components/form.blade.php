@php
    $btnAlign = isset($btnAlign) ? $btnAlign : 'Right';
    $btnColor = ['submit' => 'success', 'reset' => 'danger', 'button' => 'danger'];
    $fileUpload = (isset($fileUpload) && $fileUpload) ? 'enctype=multipart/form-data' : '';
    $cancelRoute = (isset($cancelRoute) ? $cancelRoute : false);
    $indexRoute = $cancelRoute ? $cancelRoute : explode('.', Route::current()->getAction()['as'])[0].'.index';  
    $routeUrl .= (count(Request()->all()) > 0) ? '?'.http_build_query(Request()->all()) : '';  
@endphp

{{-- {{ dd($routeUrl .= (count(Request()->all()) > 0) ? '?'.http_build_query(Request()->all()) : '') }} --}}

@if($title != '')
    <div class="card-header"><h3>{{__($title)}}</h3></div>
@endif
<div class="card-body mb-5">
    <form class="form" {{isset($formTarget) ? 'target='.$formTarget : ''}} role="form" method="POST" action="{{$routeUrl}}" {{$fileUpload}}>
        {{ csrf_field() }}

        @if(isset($method))
            @if($method != 'POST')
                <input name="_method" type="hidden" value="{{$method}}">
            @endif
        @endif

        @yield('formFields')

        {{--  <hr>  --}}
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-bottom">
            <div class="ml-auto">
                @if(is_array($formButtons))
                    @foreach($formButtons as $formButton)
                        @if(($formButton['type'] == 'submit') || ($formButton['type'] == 'reset'))
                            <button type="{{$formButton['type']}}" class="btn btn-{{$btnColor[$formButton['type']]}}" data-toggle="tooltip" data-placement="top" title="{{ __($formButton['label']) }}" data-original-title="{{ __($formButton['label']) }}">
                                @if(isset($formButton['icon']))
                                    <i class="fas fa-{{$formButton['icon']}}"></i>  
                                @else
                                    {{ __($formButton['label']) }}
                                @endif
                            </button>
                        @else
                            <a href="{{ route($indexRoute, Request()->all() ?? []) }}" class="btn btn-{{$btnColor[$formButton['type']]}}"  data-toggle="tooltip" data-placement="top" title="{{ __($formButton['label']) }}" data-original-title="{{ __($formButton['label']) }}">
                                @if(isset($formButton['icon']))
                                    <i class="fas fa-{{$formButton['icon']}}"></i>
                                @else
                                    {{ __($formButton['label']) }}
                                @endif
                            </a>
                        @endif
                    @endforeach
                @else
                    <button type="submit" class="btn btn-primary"  data-toggle="tooltip" data-placement="top" title="{{ __($formButton['label']) }}" data-original-title="{{ __($formButton['label']) }}">
                        @if(isset($formButton['icon']))
                            <span class="glyphicon glyphicon-{{$formButton['icon']}}"></span>
                        @else
                            {{ __($formButton['label']) }}
                        @endif
                    </button>
                @endif
            </div>
        </nav>
        {{--  <div class="form-group">
            <div class="{{ ($btnAlign == 'Right') ? 'float-right' : '' }} padding-bottom-15">
                
            </div>
        </div>  --}}
    </form>
</div>