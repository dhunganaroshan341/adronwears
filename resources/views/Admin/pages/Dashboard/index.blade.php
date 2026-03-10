@extends('Admin.layout.master')
@section('content')
    <div class="container-fluid">
        <div class="main-panel">
            <div class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="home-tab">
                            {{-- <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview"
                                            role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#audiences"
                                            role="tab" aria-selected="false">Audiences</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#demographics"
                                            role="tab" aria-selected="false">Demographics</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link border-0" id="more-tab" data-bs-toggle="tab" href="#more"
                                            role="tab" aria-selected="false">More</a>
                                    </li>
                                </ul>
                                <div>
                                    <div class="btn-wrapper">
                                        <a href="#" class="btn btn-otline-dark align-items-center"><i
                                                class="icon-share"></i> Share</a>
                                        <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i>
                                            Print</a>
                                        <a href="#" class="btn btn-primary text-white me-0"><i
                                                class="icon-download"></i> Export</a>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="tab-content tab-content-basic">
                                <div class="tab-pane fade show active" id="overview" role="tabpanel"
                                    aria-labelledby="overview">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div
                                                class="statistics-details d-flex align-items-center justify-content-between">

                                                <div>
                                                    <p class="statistics-title">Total User</p>
                                                    <h3 class="rate-percentage">{{ $totaluser }}</h3>
                                                </div>
                                                <div>
                                                    <p class="statistics-title">Admin</p>
                                                    <h3 class="rate-percentage">{{ $admin }}</h3>
                                                </div>
                                                <div>
                                                    <p class="statistics-title">User</p>
                                                    <h3 class="rate-percentage">{{ $user }}</h3>
                                                </div>
                                                <div class="d-none d-md-block">
                                                    <p class="statistics-title">Total Post</p>
                                                    <h3 class="rate-percentage">{{ $totalpost }}</h3>
                                                </div>
                                                <div class="d-none d-md-block">
                                                    <p class="statistics-title">Total packages</p>
                                                    <h3 class="rate-percentage">{{ $totalPackages }}</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 d-flex flex-column">
                                            <div class="row flex-grow">
                                                <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                                                    <div class="card card-rounded">
                                                        <div class="card-body">
                                                            <div
                                                                class="d-sm-flex justify-content-between align-items-start">
                                                                <div>
                                                                    <h4 class="card-title card-title-dash">Performance Line
                                                                        Chart</h4>
                                                                    <h5 class="card-subtitle card-subtitle-dash">Bar Graph
                                                                        Data from DataSet</h5>
                                                                </div>
                                                            </div>
                                                            <div class="mt-4">
                                                                <canvas id="performanceLine"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <!-- partial -->
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var ctx = document.getElementById('performanceLine').getContext('2d');
            var dashboardBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Admin', 'User', 'Total Post', 'Todays Post'],
                    datasets: [{
                        label: 'Dashboard Data',
                        data: [
                            {{ $admin }},
                            {{ $user }},
                            {{ $totalpost }},
                            {{ $today_post }},
                        ],
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(0, 140, 70, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(0, 140, 70, 1)',
                            'rgba(153, 102, 255, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 50
                        }
                    }
                }
            });
        })
    </script>
@endsection
