<div class="col-md-12">

    <div class="members-form">
        <div class="table-scrollable">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th> #</th>
                    <th> {{__('families::charities.families.form.name')}} </th>
                    <th> {{__('families::charities.families.form.national_id')}} </th>
                </tr>
                </thead>
                <tbody>
                @if(count($family->members_info))
                    @foreach($family->members_info as $member)
                        <tr>
                            <td> {{$member->id}} </td>
                            <td> {{$member->name}} </td>
                            <td> {{$member->national_id}} </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
