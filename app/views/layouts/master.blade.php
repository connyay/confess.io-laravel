<!DOCTYPE html>
  <html>
    <head>
    <title>@section('title')
    Confess.io
    @show
    &raquo; Anonymous Confessions</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="description" content="Read anonymous confessions posted by users just like you. Have something to confess? Feel free to post your anonymous confession here!" />
    <meta name="robots" content="INDEX,FOLLOW">
    <meta name="csrf-token" content="<?= csrf_token() ?>">
    {{ HTML::style('css/bootstrap.css') }}
    {{ HTML::style('css/styles.css') }}
    {{ HTML::style('css/media-queries.css') }}
    {{ HTML::script('js/modernizr.custom.js') }}
  </head>
    <body>
    <!-- nav -->
      <nav class="navbar  navbar-fixed-top" role="navigation">
      <!-- container -->
        <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ URL::to('ns') }}">Confess.io</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse  navbar-collapse  navbar-ex1-collapse">
            <ul class="nav  navbar-nav">
            @if(Request::is('ns'))
            <li class="active">Read</li>
            @else
            <li><a href="{{ URL::to('ns') }}">Read</a></li>
            @endif
            @if(Request::is('n/new'))
            <li class="active">Write</li>
            @else
            <li><a href="{{ URL::to('n/new') }}">Write</a></li>
            @endif
          </ul>
          </div><!-- /navbar-collapse -->
          </div><!-- /container -->
          </nav><!-- /nav -->
          <!-- main-content -->
            <div class="container  main-content">
              <div class="row">
              @yield('content')
            </div>
            </div><!-- /main-content -->
            <!-- footer -->
              <section class="footer">
                <div class="container">
                  <div class="row">
                    <ul class="list-unstyled list-inline col-12  col-sm-5  col-lg-4">
                    <li><a href="{{ URL::to('about') }}">About</a></li>
                    <li><a href="{{ URL::to('blog') }}">Blog</a></li>
                    <li><a href="{{ URL::to('contact') }}">Contact</a></li>
                    <li><a href="http://github.com/connyay/confess.io">Github</a></li>
                    <li><a href="http://twitter.com/confess_io">Twitter</a></li>
                  </ul>
                    <div class="col-12  col-sm-7  col-lg-5  col-lg-offset-3  text-right  hard--right">
                    <h3 class="footer--main-logo">Confess.io</h3>
                    <p>
                    Built with love by <a href="http://twitter.com/_connyay" target="_blank" class="underline">@_connyay</a> &#169; {{ date('Y') }}
                    </p>
                  </div>
                </div>
              </div>
              </section><!-- footer -->
              <!-- jQuery -->
              <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
              {{ HTML::script('js/bootstrap.min.js') }}
              @yield('scripts')
            </body>
          </html>
