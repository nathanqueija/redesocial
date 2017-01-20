@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Edite seu perfil</div>

                    <div class="panel-body">
                        <form action="{{route('profile.update')}}" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="location">Local</label>
                                <input type="text" class="form-control" name="location" value="{{$info->location}}" required>
                            </div>
                            <div class="form-group">
                                <label for="about">Sobre</label>
                               <textarea name="about" id="about" cols="30" rows="10" class="form-control" required>{{$info->about}}</textarea>
                            </div>
                            <div class="form-group">
                                <p class="text-center">
                                    <button class="btn btn-primary btn-lg" type="submit">
                                        Salvar
                                    </button>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
