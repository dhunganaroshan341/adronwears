@extends('Admin.layout.master')

@section('content')
<div class="container">
    <x-admin.breadcrumb />

    {{-- 🔍 Filters --}}
    <div class="card shadow-sm mb-2 p-2">
        <form method="GET" class="mb-4">
            <div class="row g-2">

                {{-- Search --}}
                <div class="col-md-3">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                        placeholder="Search name, phone, email">
                </div>

                {{-- Status --}}
                <div class="col-md-2">
                    <select name="status" class="form-control">
                        <option value="">All Status</option>
                        @foreach(['pending','confirmed','shipped','delivered','cancelled'] as $status)
                        <option value="{{ $status }}" {{ request('status')==$status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- User Type --}}
                <div class="col-md-2">
                    <select name="user_type" class="form-control">
                        <option value="">All Users</option>
                        <option value="registered" {{ request('user_type')=='registered' ? 'selected' : '' }}>Registered
                        </option>
                        <option value="guest" {{ request('user_type')=='guest' ? 'selected' : '' }}>Guest</option>
                    </select>
                </div>

                {{-- From Date --}}
                <div class="col-md-2">
                    <input type="date" name="from_date" value="{{ request('from_date') }}" class="form-control">
                </div>

                {{-- To Date --}}
                <div class="col-md-2">
                    <input type="date" name="to_date" value="{{ request('to_date') }}" class="form-control">
                </div>

                {{-- Sort --}}
                <div class="col-md-1">
                    <select name="sort" class="form-control">
                        <option value="latest" {{ request('sort')=='latest' ? 'selected' : '' }}>↓</option>
                        <option value="oldest" {{ request('sort')=='oldest' ? 'selected' : '' }}>↑</option>
                    </select>
                </div>

            </div>

            <div class="mt-2">
                <button class="btn btn-dark btn-sm">Filter</button>
                <a href="{{ route('admin.shipping-requests.index') }}"
                    class="btn btn-outline-secondary btn-sm">Reset</a>
            </div>
        </form>
    </div>

    {{-- 📦 Table --}}
    <table class="table table-bordered table-striped table-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>Contact</th>
                <th>City</th>
                <th>Status</th>
                <th>Date</th>
                <th>Type</th>
            </tr>
        </thead>
        <tbody>
            @forelse($requests as $req)
            <tr>
                <td>{{ $req->id }}</td>

                <td>
                    {{ $req->customer_name ?? 'N/A' }}
                </td>

                <td>
                    {{ $req->customer_phone ?? '-' }} <br>
                    <small>{{ $req->customer_email ?? '' }}</small>
                </td>

                <td>{{ $req->city }}</td>

                <td>
                    <span class="badge bg-{{ 
                            $req->status == 'pending' ? 'warning' : 
                            ($req->status == 'confirmed' ? 'info' : 
                            ($req->status == 'shipped' ? 'primary' : 
                            ($req->status == 'delivered' ? 'success' : 'danger'))) 
                        }}">
                        {{ ucfirst($req->status) }}
                    </span>
                </td>

                <td>
                    {{ $req->created_at->format('Y-m-d') }}
                </td>

                <td>
                    {{ $req->user_id ? 'User' : 'Guest' }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7">No shipping requests found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- 🔢 Pagination --}}
    {{ $requests->links() }}

</div>
@endsection