@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Usuario: <b>{{$name}}</b> </div>

                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Razon social</th>
                                <th>Direccion</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$name}}</td>
                                <td>{{$email}}</td>
                                <td>{{$taxname}}</td>
                                <td>{{$address}}</td>
                                <td>
                                    <!-- <button type="button" class="btn btn-primary"><i class="far fa-eye"></i></button> -->
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal"><i class="fas fa-edit"></i></button>
                                    
                                    <form method="POST" action="{{ url('/taxinfos/'.$tax_id.'/delete') }}" style="display: inline;">
                                        {{ csrf_field() }}
                                        <!-- {{ method_field('DELETE') }} -->
                                        <!-- @method('DELETE') -->
                                        <!-- <input type="hidden" name="_method" value="DELETE"> -->
                                            <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
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
                        @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade in">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('info') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Editar Información fiscal</h4>
            </div>
            <div class="modal-body">
                <form id="tax-form" method="POST" action="{{ url('/taxinfos/'.$tax_id) }}" role="form">
                    {{ csrf_field() }}

                    <!-- <input type="hidden" name="_method" value="PUT"> -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="form_tax_name">Nombre o Razon social *</label> Limite: <span id="limitname"></span>/<span id="topename"></span>
                                <input type="text" name="taxname" maxlength="32" id="taxname" value="{{$taxname}}" onKeyDown="limit(1)" onKeyUp="limit(1)" class="form-control" placeholder="Ingrese nombre o razon social" required="required" data-error="razon social es requerida.">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="form_taxaddress">Dirección fiscal</label> Limite: <span id="limittaxaddres"></span>/<span id="topetax"></span>
                                <textarea name="taxaddress" maxlength="65535" id="taxaddress" onKeyDown="limit(2)" onKeyUp="limit(2)" style="max-width: 718px;" class="form-control" placeholder="Ingrese dirección fiscal" rows="4" required="required" data-error="Debe ingresar una dirección valida.">{{$address}}</textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <input type="submit" class="btn btn-success btn-send" value="Editar">
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
            <div class="modal-footer">
                <button type="button" id="idclear" class="btn btn-danger" click="clear()">Borrar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

        $("#idclear").click(function() {
            $("#limitname").html(0);
            $("#limittaxaddres").html(0);
            $("#taxname").val('');
            $("#taxaddress").val('');
        });
    });
</script>
@endsection