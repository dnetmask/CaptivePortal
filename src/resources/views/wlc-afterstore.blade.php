@extends('cautiveportal::layouts.master')

@section('content')
    {{ Form::open(array('url' => $switchUrl, 'method' => 'post', 'id' => 'frm')) }}
        {{ Form::hidden('redirect_url', $redirectUrl) }}
        {{ Form::hidden('buttonClicked', $buttonClicked) }}
        {{ Form::hidden('err_flag', $errFlag) }}
    {{ Form::close() }}
@endsection

@section('footer-scripts')
    <script>
        $('document').ready(function() {
            document.getElementById('frm').submit();
            return;
        });
    </script>
@endsection