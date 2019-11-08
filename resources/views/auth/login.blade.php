@extends('layouts.app')
<?php set_time_limit(900); ?>
@section('content')
<br>
<br>
<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-10 col-sm-offset-1">
    <div class="col-xs-12">

        <center>
            <div class="fullcard shadowdiv whiteback radius5sm" style="max-width:600px; border: 1px solid #a4baca; box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);">
                <div class="fullcard radius5smtop" style="background-color:#2f638c; padding:20px;">
                    <center>
                        <h3 style="color:#FFFFFF">TEST HQ RENTAL</h3>
                    </center>

                </div>

                <div class="col-sm-12" style="border: 4px #2f638c solid; background-color:#d8d8d842;">
                    <div class="fullcard" style="padding:20px;">

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                            {{ csrf_field() }}
                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                            <input id="email" type="email" name="email" placeholder="Email" class="form-control icons" value="{{ old('email') }}" required autofocus>
                            <br>
                            <input d="password" type="password" name="password" placeholder="Password" class="form-control icons">
                            <br>
                            <div class="sm-p-t-10 clearfix">
                                <button type="submit" class="btn botonhover btn-primary font-montserrat all-caps">
                                    Login
                                </button>
                            </div>
                            <div class="clearfix"></div>
                        </form>

                    </div>
                </div>



            </div>
        </center>
    </div>
</div>
@endsection