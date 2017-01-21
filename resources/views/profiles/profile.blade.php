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
                    <img class="img-responsive img-circle" style="margin: auto; width: 50%;" src="{{Storage::url($user->avatar)}}" alt="">
                    <hr>
                    <p class="text-center">
                        @if(auth()->id() == $user->id)
                        <a href="{{route('profile.edit')}}" class="btn btn-lg btn-info">Editar perfil</a>
                        @endif
                    </p>
                    <hr>
                    <h3 class="text-center">Sobre mim</h3>
                    <p class="text-center">
                        Moro em <b>{{$user->profile->location}}</b>
                    </p>
                    <p class="text-center">
                        {{$user->profile->about}}
                    </p>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="panel panel-default">
                <div class="body">
                    <friend :profile_user_id="{{$user->id}}"></friend>
                </div>
            </div>
        </div>
    </div>
@stop
