<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueCaseInsensitive implements Rule
{
    private $table;
    private $column;
    private $ignoreId;

    public function __construct($table, $column, $ignoreId = null)
    {
        $this->table = $table;
        $this->column = $column;
        $this->ignoreId = $ignoreId; // Optional: Exclude specific ID for updates
    }

    /**
     * Determine if the validation rule passes.
     */
    public function passes($attribute, $value)
    {
        $query = DB::table($this->table)
            ->whereRaw("LOWER({$this->column}) = ?", [strtolower($value)]);

        if ($this->ignoreId) {
            $query->where('id', '!=', $this->ignoreId);
        }

        return !$query->exists();  // Return true if no matching record found, meaning it's unique
    }

    /**
     * Get the validation error message.
     */
    public function message()
    {
        return 'The :attribute must be unique (case-insensitive).';
    }
}
