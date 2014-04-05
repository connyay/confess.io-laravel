<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@section('title')
        Confess.io
        @show
        &raquo; Anonymous Confessions</title>
        <meta name="description" content="Read anonymous confessions posted by users just like you. Have something to confess? Feel free to post your anonymous confession here!" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script>window._token = "{{{ Session::getToken() }}}";</script>
        {{ HTML::style('css/pure/pure.0.4.2.css') }}
        {{ HTML::style('css/main-grid.css') }}
        {{ HTML::style('css/layouts/main.css') }}
        <link rel="shortcut icon" href="{{{ asset('assets/ico/favicon.png') }}}"></head>
        <body>
            <div class="pure-g-r" id="layout">
                <div class="sidebar pure-u">
                    <header class="header">
                        <hgroup>
                        <h1 class="brand-title">Confess.io</h1>
                        <h2 class="brand-tagline">Anonymous Confessions</h2>
                        </hgroup>
                        <nav class="nav">
                            <ul class="nav-list">
                                <li class="nav-item">
                                    <a class="pure-button" href="{{ URL::to('ns') }}">Read</a>
                                </li>
                                <li class="nav-item">
                                    <a class="pure-button" href="{{ URL::to('n/new') }}">Write</a>
                                </li>
                            </ul>
                        </nav>
                    </header>
                </div>
                <div class="pure-u-1">
                    <div class="content">
                        <!-- content -->
                        @yield('content')
                        <!-- ./ content -->
                        <footer class="footer">
                            <div class="pure-menu pure-menu-horizontal pure-menu-open">
                                <ul>
                                    <li><a href="{{ URL::to('about') }}">About</a></li>
                                    <li><a href="{{ URL::to('blog') }}">Blog</a></li>
                                    <li><a href="{{ URL::to('contact') }}">Contact</a></li>
                                    <li><a href="http://github.com/connyay/confess">Github</a></li>
                                    <li><a href="http://twitter.com/confess_io">Twitter</a></li>
                                </ul>
                            </div>
                        </footer>
                    </div>
                </div>
            </div>
            @section('scripts') 
            @show
        </body>
    </html>