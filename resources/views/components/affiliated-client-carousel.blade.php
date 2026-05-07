<div class="partners mt-2">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="title" style="padding-bottom:1px">Affiliates</h2>
        </div>

        <div class="attract-slider owl-carousel">
            @foreach ($Brands as $Brand)
            <div class="Brand-logo item">
                <img src="{{ $Brand->image_url ?? asset('template/yatri_world/main-file/images/Brands/logo-01.png') }}"
                    alt="{{ $Brand->name ?? 'Brand' }}">
                @if (isset($Brand->name) || isset($Brand->description))
                <div class="Brand-tooltip">
                    <strong>{{ $Brand->name ?? '' }}</strong><br>
                    <span>{{ $Brand->description ?? '' }}</span>
                </div>
                @endif
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
        /* fixed height for logos */
        object-fit: contain;
        /* maintain aspect ratio */
        position: relative;
    }

    /* Each Brand logo container */
    .attract-slider .Brand-logo.item {
        background: white;
        margin: 0 10px 20px;
        position: relative;
        /* for tooltip positioning */
        cursor: pointer;
    }

    /* Tooltip container */
    .Brand-tooltip {
        position: absolute;
        bottom: 140px;
        /* above the logo */
        left: 50%;
        transform: translateX(-50%);
        background-color: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 14px;
        text-align: center;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, transform 0.3s ease;
        z-index: 100;
    }

    /* Arrow under tooltip */
    .Brand-tooltip::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        transform: translateX(-50%);
        border-width: 5px;
        border-style: solid;
        border-color: rgba(0, 0, 0, 0.8) transparent transparent transparent;
    }

    /* Show tooltip on hover */
    .attract-slider .Brand-logo.item:hover .Brand-tooltip {
        opacity: 1;
        visibility: visible;
        transform: translateX(-50%) translateY(-5px);
    }
</style>
@endpush