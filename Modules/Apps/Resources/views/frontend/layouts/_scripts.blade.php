<!-- Start JS FILES -->
<script src="{{asset('frontend/'.locale().'/js/jquery.min.js')}}"></script>
<script src="{{asset('frontend/'.locale().'/js/popper.min.js')}}"></script>
<script src="{{asset('frontend/'.locale().'/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/'.locale().'/js/wow.min.js')}}"></script>
<script src="{{asset('frontend/'.locale().'/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('frontend/'.locale().'/js/scrollIt.min.js')}}"></script>
<script src="{{asset('frontend/'.locale().'/js/nice-select.js')}}"></script>
{{--<script src="{{asset('frontend/'.locale().'/js/numscroller-1.0.js')}}"></script>--}}
<script src="{{asset('frontend/'.locale().'/js/datedropper.js')}}"></script>
<script src="{{asset('frontend/'.locale().'/js/dropzone.js')}}"></script>
<script src="{{asset('frontend/js/sweetalert2.all.js')}}"></script>

@stack('plugins-scripts')

{{--<script>--}}
{{--    if ($(".numscroller").length) {--}}
{{--        $.getScript("frontend/js/numscroller-1.0.js");--}}

{{--    }--}}
{{--</script>--}}
<script src="{{asset('frontend/'.locale().'/js/script.js')}}"></script>
<script src="{{asset('frontend/js/main.js')}}"></script>

<script>

    // DELETE ROW FROM DATATABLE
    function deleteRow(url,id=null,isclass = false)
    {
        var _token  = $('input[name=_token]').val();

        Swal.fire({
            title: '{{__('apps::dashboard.messages.delete')}}',
            showDenyButton: true,
            confirmButtonText: '{{__('apps::dashboard.buttons.yes')}}',
            denyButtonText: '{{__('apps::dashboard.buttons.no')}}',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    method  : 'DELETE',
                    url     : url,
                    data    : {
                        _token  : _token
                    },
                    success: function(msg) {
                        Swal.fire(
                            msg[1],
                            '',
                            'success'
                        )
                        
                        if(id){
                            if(isclass){

                                $('.'+id).remove();
                            }else{

                                $('#'+id).remove();
                            }
                        }
                    },
                    error: function( msg ) {
                        Swal.fire(
                            msg[1],
                            '',
                            'error'
                        )
                    }
                });
            }
        })
    }
</script>
@stack('scripts')