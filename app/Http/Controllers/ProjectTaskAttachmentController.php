<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectTask;
use App\Models\ProjectTaskAttachment;
use Illuminate\Support\Facades\Storage;

class ProjectTaskAttachmentController extends Controller
{
    public function store(Request $request, ProjectTask $task)
    {
        $request->validate([
            'attachment' => 'required|file|max:10240', // max 10MB
        ]);

        $file = $request->file('attachment');
        $path = $file->store('attachments');

        $task->attachments()->create([
            'filename' => $file->getClientOriginalName(),
            'path' => $path,
        ]);

        return back()->with('success', 'File uploaded successfully.');
    }

}
