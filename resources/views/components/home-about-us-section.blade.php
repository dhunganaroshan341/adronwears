  <!-- about-us starts -->
  <section class="about-us bg-grey mt-2 ">
      <div class="container">
          <div class="about-image-box mb-4">
              <div class="row d-flex align-items-center justify-content-between">
                  <div class="col-lg-6">
                      <div class="about-content pt-4">
                          <h4 class="mb-1 font-weight-normal orange">
                              {{ $homeAboutContent->content_heading ?? 'About Om mundum Tours & Treks' }}</h4>
                          <h2 class="">
                              {{ $homeAboutContent->content_subheading ?? 'We\'re Truely Dedicated To Make Your Travel Experience' }}
                          </h2>
                          <p class="mb-2">
                              {!! $homeAboutContent->content ??
                                  'Top Tour Operators and Travel Agency. We offering in total 793 tours and
                                                                                                                                                                                                                  holidays throughout the world. Combined we have received 1532 customer reviews and an
                                                                                                                                                                                                                  average rating of 5 out of 5 stars. <br>Travel has helped us to understand the meaning
                                                                                                                                                                                                                  of life and it has helped us become better people. Each time we travel, we see the world
                                                                                                                                                                                                                  with new eyes' !!}
                          </p>
                          <div class="about-featured mb-0">
                              <ul>
                                  <li>Safety Travel System</li>
                                  <li>Budget-Friendly Tour</li>
                                  <li>Expert Trip Planning</li>
                                  <li>Fast Communication</li>
                                  <li>Right Solution & Guide</li>
                                  <li>24/7 Customer Support</li>
                              </ul>
                          </div>
                      </div>
                  </div>
                  <div class="col-lg-6">
                      <div class="about-image-main">
                          <div class="row">
                              <div class="col-md-6 ">
                                  <img src="{{ $homeAboutContent->image1 ?? asset('template/yatri_world/main-file/images/tibet.png') }}"
                                      alt="">
                              </div>
                              <div class="col-md-6">
                                  <img src="{{ $homeAboutContent->image2 ?? asset('template/yatri_world/main-file/images/tibet_vertical.jpg') }}"
                                      alt="">

                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <!-- why us starts -->
          @include('components.why-us-section')
          <!-- why us ends -->
      </div>
  </section>
  <!-- about-us ends -->
