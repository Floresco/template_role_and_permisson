<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="FloysTech">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="icon" href="data:image/svg+xml, <svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🩺</text></svg>"/>
    <title>{{$title ?? 'DOCTOR CONSULT'}}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link class="js-stylesheet" href="{{asset('assets/css/select2.min.css')}}" rel="stylesheet">
    <link class="js-stylesheet" href="{{asset('assets/css/select2-bootstrap4.css')}}" rel="stylesheet">
    <link class="js-stylesheet" href="{{asset('assets/css/light.css')}}" rel="stylesheet">
    <style>
        body {
            opacity: 0;
        }
    </style>
</head>
<!--
  HOW TO USE:
  data-theme: default (default), dark, light, colored
  data-layout: fluid (default), boxed
  data-sidebar-position: left (default), right
  data-sidebar-layout: default (default), compact
-->

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
<div class="wrapper">
    <x-layouts.partials.sidebar/>

    <div class="main">
        <x-layouts.partials.navbar/>
        <main class="content">
            <div class="container-fluid p-0">
                {{$head_btn ?? null}}
                <x-layouts.partials.head-title :title="$title"/>
                <div class="row">
                    {{$slot}}
                </div>
            </div>
        </main>

        <footer class="footer">
            <div class="container-fluid">
                <div class="row text-muted">
                    <div class="col-6 text-start">
                        <p class="mb-0">
                            &copy;
                            <a href="#" target="_blank" class="text-muted"><strong>FloysTech</strong></a> with ❤️
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
{{--<x-layouts.partials.modal/>--}}
<script src="{{asset('assets/js/app.js')}}"></script>
<script src="{{asset('assets/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dataTables.bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/js/datatables.js')}}"></script>
<script src="{{asset('assets/js/block-ui.js')}}"></script>
<script src="{{asset('assets/js/select2.min.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
{{$js ?? null}}
</body>

</html>
