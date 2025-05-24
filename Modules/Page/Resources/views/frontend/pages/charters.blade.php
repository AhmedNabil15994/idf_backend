@inject('charters','Modules\Catalog\Entities\ProjectCharter')
<div class="inner-page">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="faqs-categories">
                    <ul class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        @foreach($charters->active()->get() as $charter)
                            <li class="nav-item"><a class="nav-link {{$loop->first ? 'active' : ''}}"
                                                    href="#cat{{$charter->id}}" data-toggle="tab" role="tab"
                                                    aria-controls="home"
                                                    aria-selected="true">{{$charter->btn_title}}</a></li>

                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-md-9">
                <div class="tab-content" id="myTabContent">
                    @foreach($charters->active()->get() as $charter)
                        <div class="tab-pane fade show {{$loop->first ? 'active' : ''}}" id="cat{{$charter->id}}">
                            <h2 class="title-page">{{$charter->title}}</h2>
                            {!! $charter->description !!}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>