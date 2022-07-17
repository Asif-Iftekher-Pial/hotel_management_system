{{-- <script data-cfasync="false" src="../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> --}}
<script src="{{ asset('assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
{{-- <script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/plugins/morris/morris.min.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/js/chart.morris.js') }}"></script> --}}
<script src="{{ asset('assets/js/script.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/summernote/dist/summernote-bs4.min.js') }}"></script>
{{-- sweet alert 2 --}}
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/plugins/toggle/bootstrap4-toggle.min.js') }}"></script>
@yield('backend_script')
{{-- error notification --}}
<script>
    setTimeout(function() {
        $('#alert').slideUp();
    }, 4000);
</script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            pagingType: 'full_numbers',
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>
<script>
    $(document).ready(function() {
        $('#summernoteTwo').summernote();
    });
</script>
{{-- image upload preview --}}
<script>
    $(document).ready(function() {
        $('#file-input').on('change', function() { //on file input change
            if (window.File && window.FileReader && window.FileList && window
                .Blob) //check File API supported browser
            {
                $('#thumb-output').html(''); //clear html of output element
                var data = $(this)[0].files; //this file data

                $.each(data, function(index, file) { //loop though each file
                    if (/(\.|\/)(gif|jpe?g|png)$/i.test(file
                            .type)) { //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function(file) { //trigger function on successful read
                            return function(e) {
                                var img = $('<img/>').addClass('thumb').attr('src',
                                    e.target.result); //create image element 
                                $('#thumb-output').append(
                                    img); //append image to output element
                            };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });
            } else {
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });
    });
</script>
{{-- image upload preview --}}
<script>
    $(document).ready(function() {
        $('#file-inputTwo').on('change', function() { //on file input change
            if (window.File && window.FileReader && window.FileList && window
                .Blob) //check File API supported browser
            {
                $('#thumb-outputTwo').html(''); //clear html of output element
                var data = $(this)[0].files; //this file data

                $.each(data, function(index, file) { //loop though each file
                    if (/(\.|\/)(gif|jpe?g|png)$/i.test(file
                            .type)) { //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function(file) { //trigger function on successful read
                            return function(e) {
                                var img = $('<img/>').addClass('thumb').attr('src',
                                    e.target.result); //create image element 
                                $('#thumb-outputTwo').append(
                                    img); //append image to output element
                            };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });
            } else {
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });
    });
</script>
{{-- Sweet Alert Toast --}}
{{-- <script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: 'success',
        title: 'Signed in successfully'
    })
</script> --}}

{{-- toastr notification --}}
<script>
    @if (Session::has('T-messege'))
        var type = "{{ Session::get('alert-type') }}"
        switch (type) {
            case 'success':
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                Toast.fire({
                    icon: 'success',
                    title: '{{ Session::get('T-messege') }}'
                })
            break;
        }
    @endif
</script>
<script>
    @if (Session::has('T-messege'))
        var type = "{{ Session::get('alert-type') }}"
        switch (type) {
            case 'error':
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })
                Toast.fire({
                    icon: 'error',
                    title: '{{ Session::get('T-messege') }}'
                })
            break;
        }
    @endif
</script>
