// Add smooth scrolling to all links
$("a").on('click', function(event) {
  // Make sure this.hash has a value before overriding default behavior
  if (this.hash !== "") {
    // Prevent default anchor click behavior
    event.preventDefault();

    // Store hash
    var hash = this.hash;
    var target = $(hash);

    // Check if target element exists
    if (target.length) {
      // Using jQuery's animate() method to add smooth page scroll
      $('html, body').animate({
        scrollTop: target.offset().top
      }, 800, function(){
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    }
  }
});



$(window).scroll(function(){

  if( $(window).scrollTop() > 10 ){

    $('.tabs-navbar1').addClass('navbar-sticky')

  } else {
    $('.tabs-navbar1').removeClass('navbar-sticky')
  }
});
      
