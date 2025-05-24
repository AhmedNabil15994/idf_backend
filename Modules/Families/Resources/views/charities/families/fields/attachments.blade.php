@if(count($family->getMedia('images')))
    @foreach($family->getMedia('images') as $media)

        <div class=" row" style="height: auto">
            <a href="{{$media->getUrl()}}">
                <div class="col-md-2">
                    <img src="{{$media->getUrl()}}"
                         class="img-responsive">

                </div>
                <div class="col-md-8">
                    {{$media->name}}
                </div>
            </a>
        </div>
    @endforeach
@endif
