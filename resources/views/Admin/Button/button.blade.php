<div class="dropdown d-inline-block">

    <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="actionDropdown" data-bs-toggle="dropdown"
        aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i>
    </button>

    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="actionDropdown">

        @if(Route::currentRouteName() == 'admin.user' && $data->role == 'User')
        <li>
            <button type="button" class="dropdown-item resetUserBtn" data-id="{{ $data->id }}">
                <i class="fas fa-lock me-2"></i>
                Change Password
            </button>
        </li>
        @endif

        <li>
            <button type="button" class="dropdown-item editUserButton" data-id="{{ $data->id }}">
                <i class="fas fa-edit me-2"></i>
                Edit
            </button>
        </li>

        <li>
            <button type="button" class="dropdown-item deleteData text-danger" data-id="{{ $data->id }}">
                <i class="fas fa-trash me-2"></i>
                Delete
            </button>
        </li>

    </ul>

</div>