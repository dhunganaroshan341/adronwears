<script>
    $(document).ready(function() {
        $('.slider-store').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            fade: true,
            asNavFor: '.slider-thumbs'
        });

        $('.slider-thumbs').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            asNavFor: '.slider-store',
            dots: false,
            centerMode: true,
            focusOnSelect: true
        });
    });
</script>
