<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactSubmissionRequest;
use App\Models\ContactSubmission;
use App\Models\ContactAttachment;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    public function store(StoreContactSubmissionRequest $request): JsonResponse
    {
        DB::transaction(function () use ($request) {
            $submission = ContactSubmission::create([
                'from_name'  => $request->from_name,
                'from_email' => $request->from_email,
                'from_phone' => $request->from_phone,
                'subject'    => $request->subject,
                'content'    => $request->content,
                'status'     => 'unread',
            ]);

            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $path = $file->store('contact-attachments', 'public');

                    ContactAttachment::create([
                        'submission_id' => $submission->id,
                        'path'          => $path,
                        'original_name' => $file->getClientOriginalName(),
                        'mime_type'     => $file->getMimeType(),
                        'size_bytes'    => $file->getSize(),
                    ]);
                }
            }
        });

        return response()->json([
            'message' => 'Your message has been received. We will get back to you shortly.',
        ], 201);
    }
}
