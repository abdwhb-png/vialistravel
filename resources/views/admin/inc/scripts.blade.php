<script src="{{ asset('admin/assets') }}/js/core/popper.min.js"></script>
<script src="{{ asset('admin/assets') }}/js/core/bootstrap.min.js"></script>
<script src="{{ asset('admin/assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
<script src="{{ asset('admin/assets') }}/js/plugins/smooth-scrollbar.min.js"></script>
<script src="{{ asset('/js/jquery-3.7.1.min.js') }}"></script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }

    function toTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
        $('html, body').scrollTop({
            top: 0,
            behavior: 'smooth'
        });
    }

    // function showConfig() {
    //     console.log('ok');
    //     $('#config-btn').trigger('click');
    // }
</script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.delete-btn', function(e) {
            e.preventDefault();
            var route = $(this).attr('data-route');
            if (!route)
                return
            var dialogText = $(this).attr('data-dialog') ?? "Do you want to delete this element ?"
            if (confirm(dialogText) == true) {
                location.replace(route);
            }
        });

        $('.badge-colors span[data-color="info"]').trigger('click');

        $('label.required').append('<span class="text-danger mx-1">*</span>');

        $('form').submit(function() {
            $('form input[type="submit"]')
                .attr('disabled', 'disabled')
                .css('background-color', '#cfcfcf')
                .addClass('border-0')
                .val('...');

            $('form button[type=submit]')
                .attr('disabled', 'disabled')
                .css('background-color', '#cfcfcf')
                .addClass('border-0')
                .text('...');
        });
    })
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('admin/assets') }}/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
