@extends('Admin.layout.master')

@section('content')
    <div class="container-fluid">

        {{-- Date Range Filter --}}
        <div class="row mb-3">
            <div class="col-md-3">
                <label for="startDate" class="form-label fw-semibold">
                    <i class="mdi mdi-calendar-start"></i> Start Date
                </label>
                <input type="date" id="startDate" class="form-control" />
            </div>
            <div class="col-md-3">
                <label for="endDate" class="form-label fw-semibold">
                    <i class="mdi mdi-calendar-end"></i> End Date
                </label>
                <input type="date" id="endDate" class="form-control" />
            </div>
            <div class="col-md-6 d-flex align-items-end gap-2 mt-2 mt-md-0">
                <button id="filterBtn" class="btn btn-primary">
                    <i class="mdi mdi-filter-outline"></i> Filter
                </button>
                <button id="resetBtn" class="btn btn-secondary">
                    <i class="mdi mdi-refresh"></i> Reset
                </button>
            </div>
        </div>

        {{-- Status Filter Buttons --}}
        <div class="row mb-4">
            <div class="col-12 d-flex flex-wrap gap-2">
                <button class="btn btn-primary btn-status-filter" data-status="all">
                    <i class="mdi mdi-format-list-bulleted"></i> All
                </button>
                <button class="btn btn-success btn-status-filter" data-status="confirmed">
                    <i class="mdi mdi-check-circle-outline"></i> Confirmed
                </button>
                <button class="btn btn-danger btn-status-filter" data-status="cancelled">
                    <i class="mdi mdi-cancel"></i> Cancelled
                </button>
                <button class="btn btn-warning btn-status-filter" data-status="pending">
                    <i class="mdi mdi-timer-sand"></i> Pending
                </button>
                <button class="btn btn-info btn-status-filter" data-status="active">
                    <i class="mdi mdi-clipboard-check-outline"></i> Completed
                </button>
            </div>
        </div>


        {{-- Booking Table --}}
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle" id="show-booking-data">
                <thead class="table-dark">
                    <tr>
                        <th>S.N</th>

                        <th>Status</th>

                        <th>Package</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Booking Type</th>
                        <th>Booking Date</th>
                        <th>No. of People</th>
                        <th>Price</th>
                        <th>Action</th>

                        <th>Submitted At</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Data will come from backend --}}
                </tbody>
            </table>
        </div>

    </div>

    {{-- MDI Icons CDN --}}
@endsection
