<div class="single_item">
    <div class="row">
        @if(empty($sub_item))
            <div class="col-md-6">
                {!! field('frontend_no_label')->text('name',__('donations::frontend.donate_resources.form.name'),null,[
                'required' => true
                ]) !!}
            </div>
            <div class="col-md-6">
                {!! field('frontend_no_label')->text('phone',__('donations::frontend.donate_resources.form.phone'),null,[
                'required' => true
                ]) !!}
            </div>
            <div class="col-md-6">
                {!! field('frontend_no_label')->text('categories[0]',__('donations::frontend.donate_resources.form.categories'),null,[
                    'required' => true,
                    'data-name' => 'categories.0'
                ]) !!}
            </div>
            <div class="col-md-3">
                {!! field('frontend_no_label')->number('quantities[0]',__('donations::frontend.donate_resources.form.quantity'),null,[
                    'required' => true,
                    'data-name' => 'quantities.0'
                ]) !!}
            </div>
            <div class="col-md-3">
                {!! field('frontend_no_label')->select('item_types[0]',__('donations::frontend.donate_resources.form.item_type'),$itemTypes,null,[
                    'class' => 'nice-select form-control',
                    'style' => 'margin-bottom: 0px;',
                    'data-name' => 'item_types.0'
                ]) !!}
            </div>

        @else
            <div class="col-md-4">
                {!! field('frontend_no_label')->text('categories[:rand]',__('donations::frontend.donate_resources.form.categories'),null,[
                'required' => true,
                'data-name' => 'categories.:rand']) !!}
            </div>
            <div class="col-md-3">
                {!! field('frontend_no_label')->number('quantities[:rand]',__('donations::frontend.donate_resources.form.quantity'),null,[
                'required' => true,
                'data-name' => 'quantities.:rand']) !!}
            </div>
            <div class="col-md-3">
                {!! field('frontend_no_label')->select('item_types[:rand]',__('donations::frontend.donate_resources.form.item_type'),$itemTypes,null,[
                        'class' => 'nice-select form-control',
                        'style' => 'margin-bottom: 0px;',
                        'data-name' => 'item_types.:rand'
                ]) !!}
            </div>
            <div class="col-md-2">
                <div class="d-flex justify-content-end">
                    <button class="btn trash-btn theme-btn">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>
