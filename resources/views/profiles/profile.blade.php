@extends('layouts/app')


@section('content')
    <div class="container">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Perfil de {{$user->name}}
                </div>

                <div class="panel-body">
                    <img src="{{Storage::url($user->avatar)}}" width="70px" height="70px" style="border-radius: 50%;" alt="">
                </div>
            </div>
        </div>
    </div>
@stop
