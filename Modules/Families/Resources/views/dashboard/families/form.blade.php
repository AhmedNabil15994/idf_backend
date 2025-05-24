
<div class="tab-pane active fade in" id="general">

    <h3 class="page-title">{{__('families::dashboard.families.form.tabs.general')}}</h3>

    <div class="col-md-10">

        @include('families::dashboard.families.fields.general')

    </div>
</div>

<div class="tab-pane fade in" id="family_members">

    <h3 class="page-title">{{__('families::dashboard.families.form.tabs.family_members')}}</h3>

    <div class="col-md-10">

        @include('families::dashboard.families.fields.members')

    </div>
</div>

<div class="tab-pane fade in" id="address">

    <h3 class="page-title">{{__('families::dashboard.families.form.tabs.address')}}</h3>

    <div class="col-md-10">

        @include('families::dashboard.families.fields.address')

    </div>
</div>

<div class="tab-pane fade in" id="attachments">

    <h3 class="page-title">{{__('families::dashboard.families.form.tabs.attachments')}}</h3>

    <div class="col-md-10">

        @include('families::dashboard.families.fields.attachments')

    </div>
</div>

<div class="tab-pane fade in" id="baskets">

    <h3 class="page-title">
        {{__('families::dashboard.families.form.tabs.baskets')}}
    </h3>

    <div class="col-md-10">

        @include('families::dashboard.families.fields.baskets')

    </div>
</div>