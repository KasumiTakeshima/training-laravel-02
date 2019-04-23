<?php

namespace App\Http\Requests\Item;

use App\Item;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $item = $this->route()->parameter('item');
        assert($item instanceof Item);
        return [
            'category_id' => ['required', 'numeric', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:100', Rule::unique('items')->ignore($item->id)],
        ];
    }
}