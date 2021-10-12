@extends("includes.index")
@section("content")
    <div class="container-scroller">
        @include('sections.navbar')
        <div class="container-fluid page-body-wrapper">
            @include('partials.sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('admin-section')
                </div>
                <!-- content-wrapper ends -->
                @include('partials.footer')
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
@endsection

@section('custom-js')
    <script src="../../vendors/summernote/dist/summernote-bs4.min.js"></script>
    <script src="../../js/dashboard.js"></script>
    <script src="../../js/editorDemo.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 500,
            });
        });
    </script>
@endsection
