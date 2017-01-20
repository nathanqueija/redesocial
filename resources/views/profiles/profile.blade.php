@extends('layouts/app')


@section('content')
    <div class="container">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <p class="text-center">
                        Perfil de {{$user->name}}
                    </p>

                </div>

                <div class="panel-body">
                    <img class="img-responsive img-circle" src="{{Storage::url($user->avatar)}}" alt="">
                    <hr>
                    <p class="text-center">
                        @if(auth()->id() == $user->id)
                        <a href="{{route('profile.edit')}}" class="btn btn-lg btn-info">Editar perfil</a>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
@stop
