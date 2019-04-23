<?php

namespace App\Http\Requests\Category;

use App\Category;
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
        $category = $this->route()->parameter('category');
        assert($category instanceof Category);

        return [
            'name' => ['required', 'string', 'max:20', Rule::unique('categories')->ignore($category->id)],
        ];
    }
}