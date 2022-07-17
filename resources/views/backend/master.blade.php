@include('backend.partials.head')


<body>
    <div class="main-wrapper">

        @include('backend.partials.header')

        @include('backend.partials.sidebar')

        <div class="page-wrapper">
            <div class="content container-fluid">
                {{-- <div class="page-header">
                    <div class="row">
                        <div class="col-sm-12 mt-5">
                            <h3 class="page-title mt-3">Good Morning Soeng Souy!</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ul>
                        </div>
                    </div>
                </div> --}}

                @yield('main')

               
            </div>
        </div>
    </div>

    @include('backend.partials.script')

</body>

</html>
