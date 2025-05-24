<div class="col-md-12 col-sm-12">

    <div class="portlet green-meadow box">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-cogs"></i>
                {{__('families::charities.families.form.baskets')}}
            </div>
        </div>
        <div class="portlet-body" style="    padding: 27px 12px 27px;" id="options_builder">

            <div class="table-responsive">
                <table class="data-table table table-bordered">
                    <thead>
                    <th>{{__('families::charities.families.form.basket_name')}}</th>
                    <th>{{__('families::charities.families.form.baskets_numbers')}}</th>
                    </thead>
                    <tbody id="baskets_table_body" class="table_body">
                    @if($family->baskets()->get())
                        @foreach($family->baskets()->get() as $basket)
                            <tr>
                                <td>
                                    <input name="baskets[]" value="{{$basket->id}}" type="hidden">
                                    {!! field('search')->text('' , __('families::charities.families.form.baskets') , optional($basket->translate(locale()))->title , ['readonly' => 'readonly']) !!}
                                </td>
                                <td>
                                    {!! field('search')->text('basket_quantities[]' , __('families::charities.families.form.baskets_numbers'),
                                    $family->baskets()->count() && $family->baskets()->find($basket->id) ? $family->baskets()->find($basket->id)->pivot->quantity : null
                                     , ['readonly' => 'readonly']) !!}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>