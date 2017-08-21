<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!--fonts-->
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!--jquery - required for bootstrap-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!--Bootstrap JS"-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title>Alex's Fakeshop</title>

    <!-- Styles -->
    <link href="{{ asset('css/Style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <header>
        <nav class="navbar navbar-default">
              <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="{{route('product.index')}}"><img class="logo" src="https://static.coolshop.com/_origami/images/logo/original/coolshop-logo.svg"></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-collapse">
                  <ul class="nav navbar-nav">
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Afdelinger <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="{{route('product.index')}}">Spil og Konsoller</a></li>
                      </ul>
                    </li>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                  <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>{{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="#">Not implemented</a></li>
                      </ul>
                    </li>
                  </ul>
                    {!! Form::open(['url' => 'product/search/{input}', 'method' => 'GET', 'class' => 'navbar-form navbar-right', 'role' => 'search']) !!}
                    <div class="input-group">
                    {!! Form::text('input', Request::get('input'), ['class' => 'form-control', 'placeholder' => 'Søg..']) !!}
                        <span class="input-group-btn">
                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                        </span>
                    </div>
                    {!! Form::close() !!}               
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container -->
            </nav>
            </header>

            <article>
            @yield('content')
            </article>

            <footer class="footer navbar-default"">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-4">
                            <p class="text-muted"><a href="{{route('product.index')}}">Produkt side</a></p>
                        </div>
                        <div class="col-xs-4">
                            
                        </div>
                        <div class="col-xs-4">
                            
                        </div>
                    </div>
                </div>
            </footer>
        <!-- Scripts -->
    </div>
    
</body>
</html>
