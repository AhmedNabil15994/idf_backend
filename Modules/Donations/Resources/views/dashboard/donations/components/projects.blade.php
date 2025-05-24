
<div class="portlet-body" style="    padding: 27px 12px 27px;">
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-striped">
            <thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center"> {{__('donations::dashboard.donations.datatable.project')}}</th>
                <th class="text-center"> {{__('donations::dashboard.donations.modal.amount')}}</th>
            </tr>
            </thead>
            <tbody>
            @if(!empty($projects) && count($projects))
                @foreach($projects as $project)
                    <tr>
                        <td>
                            {{$project->id}}
                        </td>
                        <td class="text-center">
                            {{$project->title}}
                        </td>
                        <td class="text-center">
                            {{optional($model->projects()->find($project->id))->pivot->amount}}
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="3" class="text-center">
                        {{__('donations::dashboard.donations.modal.data_not_found')}}
                    </td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>