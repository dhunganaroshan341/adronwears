<div class="partners mt-2">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="title" style="padding-bottom:1px">
                {{ $title ?? 'Affiliated With' }}
            </h2>
        </div>

        <div class="attract-slider owl-carousel">
            @foreach ($Brands as $Brand)
            <div class="Brand-logo item">
                <img src="{{ $Brand->image_url ?? asset('template/yatri_world/main-file/images/Brands/logo-01.png') }}"
                    alt="{{ $Brand->name ?? 'Brand' }}">
            </div>
            @endforeach
        </div>
    </div>
</div>
@push('styles')
<style>
    /* Partners Carousel Logos */
    .attract-slider .Brand-logo img {
        display: block;
        width: 100%;
        height: 130px;
        object-fit: contain;
        position: relative;
    }

    /* Each Brand logo container */
    .attract-slider .Brand-logo.item {
        background: white;
        margin: 0 10px 20px;
        position: relative;
        /* no pointer cursor */
    }
</style>
@endpush