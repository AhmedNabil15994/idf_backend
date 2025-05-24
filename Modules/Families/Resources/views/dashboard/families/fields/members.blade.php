<div class="col-md-10">
    <div class="members-form">
        @foreach($family->members_info as $member)
            <div class="form-group">
                {!! field()->text('members_names[]' , __('families::dashboard.families.form.name'),$member->name) !!}
                {!! field()->text('members_national_ids[]' , __('families::dashboard.families.form.national_id'),$member->national_id) !!}
                <span class="input-group-btn">
            <a data-input="images" data-preview="holder" class="btn btn-danger delete-member">
                <i class="fa fa-trash"></i>
            </a>
            </span>
                <hr>
                <span class="holder" style="margin-top:15px;max-height:100px;"></span>
            </div>
        @endforeach
    </div>
    <div class="get-member-form" style="display:none">

        <div class="form-group">
            {!! field()->text('members_names[]' , __('families::dashboard.families.form.name'),'ex_members_name') !!}
            {!! field()->text('members_national_ids[]' , __('families::dashboard.families.form.national_id'),'ex_members_national_id') !!}
            <span class="input-group-btn">
            <a data-input="images" data-preview="holder" class="btn btn-danger delete-member">
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
                class="btn green btn-lg mt-ladda-btn ladda-button btn-circle btn-outline add-member"
                data-style="slide-down"
                data-spinner-color="#333">
            <span class="ladda-label">
                <i class="icon-plus"></i>
            </span>
        </button>
    </div>
</div>

@push('scripts')
    <script>
        // member FORM / ADD NEW member
        $(document).ready(function () {
            var html = $("div.get-member-form").html();

            $(".add-member").click(function (e) {
                var content = html;
                content = content.replace('ex_members_name', '');
                content = content.replace('ex_members_national_id', '');
                e.preventDefault();
                $(".members-form").append(content);
            });
        });

        // DELETE member BUTTON
        $(".members-form").on("click", ".delete-member", function (e) {
            e.preventDefault();
            $(this).closest('.form-group').remove();
        });
    </script>
@endpush