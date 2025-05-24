<a class="btn btn-sm green" title="Edit" style="padding: 4px 5px;" data-toggle="modal" data-target="#show-donation-{{$record->id}}">
    <i class="fa fa-eye"></i>
</a>
<div class="modal fade" id="show-donation-{{$record->id}}" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><strong>{{__('donations::dashboard.donate_resources.datatable.name')}} : </strong>{{$record->name}}
                </p>
                <p><strong>{{__('donations::dashboard.donate_resources.datatable.phone')}} : </strong>{{$record->phone}}
                </p>
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">{{__('donations::dashboard.donate_resources.datatable.categories')}}</th>
                        <th scope="col" class="text-center">{{__('donations::dashboard.donate_resources.datatable.quantity')}}</th>
                        <th scope="col" class="text-center">{{__('donations::dashboard.donate_resources.datatable.item_type')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($record->items as $item)

                        <tr>
                            <th scope="row" class="text-center">{{$item->id}}</th>
                            <td style="max-width: 40px" class="text-center">{{$item->categories}}</td>
                            <td class="text-center">{{$item->quantity}}</td>
                            <td class="text-center">{{optional($item->type->translate(locale()))->title}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('apps::dashboard.buttons.cancel')}}</button>
            </div>
        </div>
    </div>
</div>