<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>
<script src="{{ mix('js/bs4navbar.js') }}"></script>
<script>
    $('document').ready(function() {
        
        $('[data-toggle="tooltip"]').tooltip();

        $("#error-alert").fadeTo(8000, 600).slideUp(600, function(){
            $("#error-alert").slideUp(600);
        });
        $("#success-alert").fadeTo(5000, 600).slideUp(600, function(){
            $("#success-alert").slideUp(600);
        });
        
        @stack('document-ready')
    });
</script>