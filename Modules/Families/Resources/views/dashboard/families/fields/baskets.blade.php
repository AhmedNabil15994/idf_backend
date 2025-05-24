<div class="col-md-12 col-sm-12">

    <div class="portlet green-meadow box">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-cogs"></i>
                {{__('families::dashboard.families.form.baskets')}}
            </div>
        </div>
        <div class="portlet-body" style="    padding: 27px 12px 27px;" id="options_builder">

            @inject('baskets','Modules\Baskets\Entities\FoodBasket')
            <div class="table-responsive">
                <table class="data-table table table-bordered">
                    <thead>
                    <th>{{__('families::dashboard.families.form.basket_name')}}</th>
                    <th>{{__('families::dashboard.families.form.baskets_numbers')}}</th>
                    </thead>
                    <tbody id="baskets_table_body" class="table_body">
                        @foreach($baskets->get() as $basket)
                            <tr>
                                <td>
                                    <input name="baskets[]" value="{{$basket->id}}" type="hidden">
                                    {!! field('search')->text('' , __('families::dashboard.families.form.baskets') , optional($basket->translate(locale()))->title , ['readonly' => 'readonly']) !!}
                                </td>
                                <td>
                                    {!! field('search')->select('basket_quantities[]' , __('families::dashboard.families.form.baskets_numbers') , basketBuildArray($basket->quantity),
                                    $family->baskets()->count() && $family->baskets()->find($basket->id) ? $family->baskets()->find($basket->id)->pivot->quantity : null
                                    ) !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@if ($family->trashed())
    {!! field()->checkBox('trash_restore', __('families::dashboard.families.form.restore')) !!}
@endif
<script>
    import Input
        from "../../../../../../../public/admin/tinymce/modules/tinymce/src/themes/silver/test/ts/phantom/components/input/InputTest";

    export default {
        components: {Input}
    }
</script>