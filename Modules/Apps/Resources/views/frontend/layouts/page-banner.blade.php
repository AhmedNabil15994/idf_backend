@if(!empty($title))
    @push('styles')
        <style>
            @if(!empty($background) and $background)
                .page-banner {
                    background-image: url("{{$background}}");
                }
            @endif
        </style>
    @endpush
    <section class="page-banner d-flex align-items-center text-center">
        <div class="banner-container container">
            <h1>{!! $title !!}</h1>
        </div>
    </section>
@endif