{!! field()->multiFileUpload('attachments' , __('families::dashboard.families.form.attachments')) !!}

@if(count($family->getMedia('images')))
    <div class="dd" id="nestable">
        <ol class="dd-list">
            @foreach($family->getMedia('images') as $media)
                <li class="dd-item" data-id="{{$media->id}}" id="attach-{{$media->id}}">

                    <div class="dd-handle row" style="height: auto">
                        <div class="col-md-2">
                            <img src="{{$media->getUrl()}}"
                                 class="img-responsive" style="max-height: 69px;">
                        </div>
                        <div class="col-md-8">
                            {{$media->name}}
                        </div>
                    </div>
                    <a style="position: absolute;top: 0;left: 0;padding: 6px 6px;" data-preview="holder" href="javascript:;" onclick="deleteRow('{{url(route('families.attachment.delete',[$family->id,$media->id]))}}',{{$media->id}})"
                       class="btn btn-danger btn-sm">
                        <i class="fa fa-trash"></i>
                    </a>

                </li>
            @endforeach
        </ol>
    </div>
    <div class="form-group">
        <button type="button" class="btn btn-lg blue re_order">
            {{__('apps::dashboard.buttons.sorting_btn')}}
        </button>
    </div>

    @push('scripts')
        <script>
            function deleteRow(url , id)
            {
                var _token  = $('input[name=_token]').val();

                bootbox.confirm({
                    message: '{{__('apps::dashboard.messages.delete')}}',
                    buttons: {
                        confirm: {
                            label: '{{__('apps::dashboard.buttons.yes')}}',
                            className: 'btn-success'
                        },
                        cancel: {
                            label: '{{__('apps::dashboard.buttons.no')}}',
                            className: 'btn-danger'
                        }
                    },

                    callback: function (result) {
                        if(result){

                            $.ajax({
                                method  : 'DELETE',
                                url     : url,
                                data    : {
                                    _token  : _token
                                },
                                success: function(msg) {
                                    toastr["success"](msg[1]);
                                    $('#attach-'+id).remove();
                                },
                                error: function( msg ) {
                                    toastr["error"](msg[1]);
                                }
                            });

                        }
                    }
                });
            }
        </script>
        <script type="text/javascript">
            $('.re_order').on('click', function (e) {

                var data = $('#nestable').nestable('serialize');
                var response ='';
                $.each(data ,function (order,object) {
                    response += (response == '' ? '' : '|') +order+':'+object.id;
                });

                $.ajax({

                    url: '{{url(route('families.attachment.sort',$family->id)).'?ordering='}}'+response,
                    type: 'GET',
                    success: function (data) {
                        if (data[0] == true) {
                            toastr["success"](data[1]);
                        } else {
                            console.log(data);
                            toastr["error"](data[1]);
                        }
                    },
                    error: function (data) {
                        console.log(data);
                    },
                });

            });
        </script>

        <script>

            $(document).ready(function () {

                var updateOutput = function (e) {
                    var list = e.length ? e : $(e.target),
                        output = list.data('output');
                    if (window.JSON) {
                        output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
                    } else {
                        output.val('JSON browser support required for this demo.');
                    }
                };

                // activate Nestable for list 1
                $('#nestable').nestable({
                    group: 1
                })
                    .on('change', updateOutput);

                // output initial serialised data
                updateOutput($('#nestable').data('output', $('#nestable-output')));
            });
        </script>
    @endpush
@endif
