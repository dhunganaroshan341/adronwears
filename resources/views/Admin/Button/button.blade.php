@if (Route::currentRouteName() == 'admin.user')
    <button title="change password" type="button"
        class="btn p-0 m-0 mx-1 bg-transparent border-0 text-info resetUserBtn {{ $data->role=='User' ? 'd-none':'' }}"
        data-id="{{ $data->id }}">
       <i class="fas fa-lock"></i>
    </button>

    <button title="edit" type="button"
        class="btn p-0 m-0 mx-1 bg-transparent border-0 text-warning editUserButton {{ $data->role=='User' ? 'd-none':'' }}"
        data-action="edit" data-id="{{ $data->id }}">
        <i class="fas fa-pencil"></i>
    </button>

    <button title="delete" type="button"
        class="btn p-0 m-0 mx-1 bg-transparent border-0 text-danger deleteData {{ $data->role=='User' ? 'd-none':'' }}"
        data-id="{{ $data->id }}">
        <i class="fas fa-trash"></i>
    </button>
@else
    <button title="edit" type="button"
        class="btn p-0 m-0 mx-1 bg-transparent border-0 text-warning editUserButton"
        data-id="{{ $data->id }}">
        <i class="fas fa-pencil"></i>
    </button>

    <button title="delete" type="button"
        class="btn p-0 m-0 mx-1 bg-transparent border-0 text-danger deleteData"
        data-id="{{ $data->id }}">
        <i class="fas fa-trash"></i>
    </button>
@endif
