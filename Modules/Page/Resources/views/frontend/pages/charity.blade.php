<div class="inner-page">
    <div class="container">
        <h2 class="title-page">{{$page['title']}}</h2>
        <div class="row">
            <div class="col-md-7">
                {!! $page['description'] !!}
            </div>
            <div class="col-md-5">
               @include('charities::frontend.charities.form')
            </div>
        </div>
    </div>
</div>