<div class="dropdown d-inline-block">

    <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
        <i class="fas fa-ellipsis-v"></i>
    </button>

    <ul class="dropdown-menu dropdown-menu-end">

        {{-- EDIT --}}
        <li>
            <button type="button" class="dropdown-item editAlbumButton" data-id="{{ $id }}">
                Edit
            </button>
        </li>

        {{-- DELETE --}}
        <li>
            <button type="button" class="dropdown-item text-danger deleteData" data-id="{{ $id }}">
                Delete
            </button>
        </li>

        {{ $slot ?? '' }}

    </ul>

</div>