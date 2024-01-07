
@include('layouts.header')
    <main>
        <div id="main" class="container">
            <!-- メインコンテンツはここに表示されます -->
            @yield('content')
        </div>
    </main>
@include('layouts.footer')