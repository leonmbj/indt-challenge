<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>INDT Challenge - LEON</title>

    <!-- Bootstrap -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

</head>
<body>
<div class="container">

    <div class="row">

        <div class="col-md-12">

            <div class="import">

                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger fade in" role="alert">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ $error }}
                    </div>
                @endforeach

                @if (isset($success))
                    <div class="alert alert-success fade in" role="alert">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        Arquivo importado com sucesso!
                    </div>
                @endif

                @if (isset($otherError))
                    <div class="alert alert-danger fade in" role="alert">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ $otherError }}
                    </div>
                @endif

                <div class="panel panel-default">

                    <div class="panel-heading"><strong>Importar arquivo</strong>
                        <small></small>
                    </div>

                    <div class="panel-body">

                        <form id="import" action="/import" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="input-group image-preview">
                                <input id="import-label" placeholder="" type="text"
                                       class="form-control image-preview-filename" disabled="disabled">

                                <span class="input-group-btn">

                                    <div class="btn btn-default image-preview-input">
                                        <span class="glyphicon glyphicon-folder-open"></span>
                                        <span class="image-preview-input-title">Selecionar Arquivo</span>
                                        <input id="import-file" type="file" accept="text/plain, text/csv"
                                               name="file"/>
                                    </div>
                                    <button id="import-submit" type="button"
                                            class="btn btn-labeled btn-primary">
                                        <span class="btn-label">
                                            <i class="glyphicon glyphicon-upload"></i>
                                        </span> Upload
                                    </button>

                                </span>

                            </div>

                        </form>

                        <br/>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="row">

        <div class="col-md-12">
            <div id="ajaxResponse">

            </div>
        </div>
    </div>

</div>
</body>

<script>

    $(document).ready(function () {

        $.ajax({
            type: "GET",
            url: "/listbooksandauthors",

            success: function (msg) {

                var result = '<table class="table"><thead><tr><th class="col-md-6">Livro</th><th>Autor</th></tr></thead><tbody>';

                msg.forEach(function (value, index) {
                    result = result + '<tr><th scope="row">' + value.title + '</th><td>' + value.author + '</td></tr>';

                });

                result = result + '</tbody></table>';

                $("#ajaxResponse").append(result);

            }
        });

    });

    //    $('.alert').click(function () {
    //        $(this).hide();
    //    });

</script>

</html>
