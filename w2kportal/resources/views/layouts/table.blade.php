    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-secondary">
                        <div class="row">
                            @yield('header')
                        </div>
                            @yield('otherforms')
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                            @yield('table')
                    </div>
                            @yield('footer')
                </div>
            </div>
        </div>
    </div>
   