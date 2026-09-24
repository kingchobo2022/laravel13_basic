<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class PostRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:3|max:255',
            'content' => 'required|min:10',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => '게시글 제목은 필수 입력 항목입니다.',
            'title.min' => '제목은 최소 :min자 이상 입력해야 합니다.',
            'title.max' => '제목은 :max자를 초과할 수 없습니다.',
            'content.required' => '게시글 내용은 비워둘 수 없습니다.',
            'content.min' => '내용은 최소 :min자 이상 성의 있게 작성해 주세요.',
        ];
    }

    
    public function attributes(): array
    {
        return [
            'title' => '제목',
            'content' => '내용',
        ];
    }
}
