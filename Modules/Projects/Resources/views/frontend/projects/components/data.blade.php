
@inject('prices','Modules\Donations\Entities\DonationPrice')
@foreach($projects as $project)
    @include('projects::frontend.projects.components.single-card',compact('project'))
@endforeach
@include('projects::frontend.projects.components.direct-donation-script')