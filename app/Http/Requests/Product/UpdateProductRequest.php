<?php

namespace App\Http\Requests\Product;

use App\Enums\RatingAccess;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'description' => ['nullable', 'string'],
            'is_enabled' => ['boolean'],
            'vote_enabled' => ['boolean'],
            'comment_enabled' => ['boolean'],
            'rating_access' => [Rule::enum(RatingAccess::class)],
        ];
    }
}
