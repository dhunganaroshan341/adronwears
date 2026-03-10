<section class="counter-main pb-6 pt-10"
    style="background-image: url('{{ asset('/template/yatri_world/main-file/images/bg/bg4.jpg') }}')">
    <div class="container">
        <div class="counter text-center">
            <div class="row">
                @foreach ($achievements as $achievement)
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="counter-item bg-lgrey">
                            <i class="{{ $achievement->icon_class }} white bg-navy mb-1"></i>
                            <h3 class="value mb-0 navy">{{ $achievement->count }}</h3>
                            <h4 class="m-0">{{ $achievement->title }}</h4>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="overlay"></div>
</section>
