<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title> {{config('app.name')}}</title>

    
    <link rel="stylesheet" href="{{asset('/css/app.css')}}" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/script.js"></script>
  </head>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper" id="app">

    {{-- navbar --}}
    @include('template.navbar')

      {{-- sidebar --}} 
      @include('template.sidebar')

      <div class="content-wrapper mt-10">
        {{-- <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0">Starter Page</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Starter Page</li>
                </ol>
              </div>
            </div>
          </div>
        </div> --}}

        <div class="content">
          <div class="container-fluid">
            <div class="row">
              <router-view></router-view>
            </div>
          </div>
        </div>
      </div>

      <aside class="control-sidebar control-sidebar-dark">
        <div class="p-3">
          <h5>Title</h5>
          <p>Sidebar content</p>
        </div>
      </aside>

      
      <footer class="main-footer">
        <div class="float-right d-none d-sm-inline">Anything you want</div>

        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
      </footer>
     
    </div>

    <script src="{{asset('/js/app.js')}}"></script>
  </body>
</html>
