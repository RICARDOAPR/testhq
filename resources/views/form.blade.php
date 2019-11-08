@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Por favor, Complete los siguientes campos:</div>

                <div class="panel-body">
                    <form id="tax-form" method="POST" action="{{ url('/taxinfos') }}" role="form">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="form_tax_name">Nombre o Razon social *</label> Limite: <span id="limitname"></span>/<span id="topename"></span>
                                    <input type="text" name="taxname" maxlength="32" id="taxname" onKeyDown="limit(1)" onKeyUp="limit(1)" class="form-control" placeholder="Ingrese nombre o razon social" required="required" data-error="razon social es requerida.">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="form_taxaddress">Dirección fiscal</label> Limite: <span id="limittaxaddres"></span>/<span id="topetax"></span>
                                    <textarea name="taxaddress" maxlength="65535" id="taxaddress" onKeyDown="limit(2)" onKeyUp="limit(2)" style="max-width: 718px;" class="form-control" placeholder="Ingrese dirección fiscal" rows="4" required="required" data-error="Debe ingresar una dirección valida."></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-success btn-send" value="Guardar información">
                            </div>
                            <div class="col-md-12">
                                @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade in">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ session('error') }}
                                </div>
                                @endif
                                @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade in">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ session('success') }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('scripts')
<script>
    function limit(type) {

        if (type == 1) {
            var taxname = $("#taxname").val().length;
            var topename = $("#topename").html();

            if (taxname >= topename) {
                alert("El limite de este texto es de " + topename + " caracteres");
            }

            $("#limitname").html(taxname);
        } else if (type == 2) {
            var taxaddress = $("#taxaddress").val().length;
            var topetax = $("#topetax").html();

            if (taxaddress >= topetax) {
                alert("El limite de este texto es de " + topetax + " caracteres");
            }

            $("#limittaxaddres").html(taxaddress);
        } else {
            alert("type desconocido");
        }
    }

    $(document).ready(function() {

        $("#limitname").html(0);
        $("#topename").html(32);
        $("#limittaxaddres").html(0);
        $("#topetax").html(65535);
    });
</script>
@endsection