@include('dash.head')

    <body>
        <div id="main-wrapper">
            @include('dash.nav-header')
            @include('dash.header')
            @include('dash.sidebar')
            <div class="content-body">
                @yield('body-content')
            </div>
            @include('dash.footer')
        </div>
        @include('dash.scripts')
        @yield('scripts')
    </body>
</html>