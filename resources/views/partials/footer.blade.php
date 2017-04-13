<!-- Scripts -->
<script src="{{ asset('js/all.js') }}"></script>
<script src="{{ asset('js/jquery-1.12.4.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>

<script>
    $(document).ready(function() {
        $('#contacts').DataTable({

//            "order": [[ 3, "desc" ]]
        });
    } );
</script>

<script>
    $('div.alert').not('.alert-important').delay(2000).slideUp(400);
</script>
