<div class="tab-pane active fade in" id="global_setting">
    <h3 class="page-title">{{__('donations::dashboard.donate_resources.form.tabs.general')}}</h3>
    <div class="col-md-10">

        {!! field()->text('name', __('donations::dashboard.donate_resources.form.name')) !!}
        {!! field()->number('phone', __('donations::dashboard.donate_resources.form.phone')) !!}

    </div>

    <div class="col-md-10">

        <h3 class="page-title">{{__('donations::dashboard.donate_resources.form.tabs.items')}}</h3>
        <div class="items-form">

        </div>
        <div class="get-item-form" style="display:none">

            <div class="form-group">
                @inject('item_types','Modules\Donations\Entities\ItemType)
                {!! field()->text('categories[]' , __('families::dashboard.families.form.categories'),'categories') !!}
                {!! field()->text('quantity[]' , __('families::dashboard.families.form.quantity'),'quantity') !!}
                {!! field()->select('item_types[]' , __('families::dashboard.families.form.item_types'),
                pluckModelsCols($item_types->get(),'title','id',true)) !!}
                <span class="input-group-btn">
            <a data-input="images" data-preview="holder" class="btn btn-danger delete-item">
                <i class="fa fa-trash"></i>
            </a>
            </span>
                <hr>
                <span class="holder" style="margin-top:15px;max-height:100px;"></span>
            </div>
        </div>
        <div class="form-group">
            <button
                    type="button"
                    class="btn green btn-lg mt-ladda-btn ladda-button btn-circle btn-outline add-item"
                    data-style="slide-down"
                    data-spinner-color="#333">
            <span class="ladda-label">
                <i class="icon-plus"></i>
            </span>
            </button>
        </div>
    </div>
</div>



@push('scripts')
    <script>
        // item FORM / ADD NEW item
        $(document).ready(function () {
            var html = $("div.get-item-form").html();

            $(".add-item").click(function (e) {
                var content = html;
                content = content.replace('ex_qyn', '');
                content = content.replace('ex_categories', '');
                e.preventDefault();
                $(".items-form").append(content);
            });
        });

        // DELETE item BUTTON
        $(".items-form").on("click", ".delete-item", function (e) {
            e.preventDefault();
            $(this).closest('.form-group').remove();
        });
    </script>
@endpush
