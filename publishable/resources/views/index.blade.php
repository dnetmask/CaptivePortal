@extends('cautiveportal::layouts.master')

@section('header_assets')

@endsection

@section('header')
    <div class="container">
        <div class="row">
            <div class="col">

            </div>
        </div>
    </div>
@endsection


@section('content')
    <div class="container">
        <div class="welcome">
            {!! setting('site.welcome') !!}
        </div>

        <div class="main-form">
            {{ Form::open(['id' => 'form']) }}
                <div class="form-group">
                    {{ Form::text('name', old('name'), ['placeholder'=> 'Nombre*', 'required']) }}
                    <label id="name-error" class="error" for="name">{{ $errors->first('name') }}</label>
                </div>
                <div class="form-group">
                    {{ Form::email('email', old('email'), ['placeholder'=> 'Email*', 'required']) }}
                    <label id="email-error" class="error" for="email">{{ $errors->first('email') }}</label>
                </div>

                <div class="form-group">
                    <label>
                        {{ Form::checkbox('accept', '1', '', ['required' => true]) }}
                        He leído y acepto los
                        <a href="#" data-toggle="modal" data-target="#modal-terms-conditions">Términos y condiciones de uso</a>
                    </label>
                </div>

                <div class="form-group">
                    {!!  Form::button('Conectarme!', ['class' => 'btn btn-primary', 'id' => 'submit-button', 'type' => 'submit'])  !!}
                </div>
            {{ Form::close() }}
        </div>
    </div>

    @include('cautiveportal::partials.modal-terms-conditions')
@endsection

@section('footer-scripts')
    <script>
        var $form = $('#form');

        if ($form.length > 0) {
            $form.validate({

                rules: {
                    name: {
                        required: true,
                    },

                    email: {
                        required: true,
                        email: true,
                    },

                    accept: {
                        required: true
                    },

                },
                messages: {

                    name: {
                        required: "Ingresa tu nombre",
                    },

                    email: {
                        required: "Ingresa tu email",
                        email: "Ingresa un email válido",
                    },

                    accept: {
                        required: 'Debe aceptar términos y condiciones'
                    },

                },
                submitHandler: function(form) {
                    $('#submit-button').html('<img src="{{ asset('images/loader.gif')  }}"> Enviando...').attr('disabled', 'disabled');

                    $form[0].submit();
                }
            })
        }
    </script>
@endsection