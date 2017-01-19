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

                    <img class="img-responsive img-rounded" src="{{Storage::url($user->avatar)}}" alt="">
                </div>
            </div>
        </div>
    </div>
@stop
