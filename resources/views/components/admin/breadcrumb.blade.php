<div class="card shadow-sm mb-3 border-0">
    <div class="card-body py-3 px-3 d-flex justify-content-between align-items-center">

        {{-- Left: Title-style breadcrumb --}}
        <div>
            <h4 class="mb-0 fw-semibold">
                <a href="{{ url('/admin/dashboard') }}" class="text-decoration-none text-dark">
                    Admin
                </a>

                <span class="text-muted mx-1">/</span>

                <span class="text-muted">
                    {{ ucwords(str_replace('-', ' ', request()->segment(2))) }}
                </span>
            </h4>
        </div>

        {{-- Right: Slot --}}
        <div class="d-flex align-items-center gap-2">
            {{ $slot }}
        </div>

    </div>
</div>