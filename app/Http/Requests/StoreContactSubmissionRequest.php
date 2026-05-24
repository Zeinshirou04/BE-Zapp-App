<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactSubmissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'from_name'      => ['required', 'string', 'max:100'],
            'from_email'     => ['required', 'email', 'max:255'],
            'from_phone'     => ['nullable', 'string', 'max:20'],
            'subject'        => ['required', 'string', 'max:150'],
            'content'        => ['required', 'string', 'min:10', 'max:5000'],
            'honeypot'       => ['nullable', 'string', 'max:0'],
            'attachments'    => ['nullable', 'array', 'max:5'],
            'attachments.*'  => [
                'file',
                'mimes:pdf,doc,docx,jpg,jpeg,png',
                'max:5120',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'from_name.required'     => 'Please enter your name.',
            'from_name.max'          => 'Name may not exceed 100 characters.',
            'from_email.required'    => 'Please enter your email address.',
            'from_email.email'       => 'Please enter a valid email address.',
            'from_phone.max'         => 'Phone number may not exceed 20 characters.',
            'subject.required'       => 'Please enter a subject.',
            'subject.max'            => 'Subject may not exceed 150 characters.',
            'content.required'       => 'Please enter a message.',
            'content.min'            => 'Message must be at least 10 characters.',
            'content.max'            => 'Message may not exceed 5000 characters.',
            'honeypot.max'           => 'Submission rejected.',
            'attachments.max'        => 'You may upload a maximum of 5 files.',
            'attachments.*.file'     => 'Each attachment must be a valid file.',
            'attachments.*.mimes'    => 'Attachments must be a PDF, Word document, or image (JPG, PNG).',
            'attachments.*.max'      => 'Each file may not exceed 5MB.',
        ];
    }
}
