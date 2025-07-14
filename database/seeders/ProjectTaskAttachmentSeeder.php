<?php

namespace Database\Seeders;

use App\Models\ProjectTask;
use App\Models\ProjectTaskAttachment;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectTaskAttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tasks = ProjectTask::all();

        // Ensure the attachments folder exists
        Storage::makeDirectory('attachments');

        foreach ($tasks as $task) {
            // Create 1–3 fake attachments per task
            $attachmentCount = rand(1, 3);

            for ($i = 0; $i < $attachmentCount; $i++) {
                $filename = 'dummy_file_' . uniqid() . '.txt';
                $path = 'attachments/' . $filename;

                // Store dummy file content
                Storage::put($path, 'This is a dummy attachment file for testing.');

                $task->attachments()->create([
                    'filename' => $filename,
                    'path' => $path,
                ]);
            }
        }
    }
}
