<?php

namespace App\Http\Controllers;

use App\Models\Workorder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use ZipArchive;

class FileUploadController extends Controller
{
    public function index($id)
    {
        $order = workorder::findOrFail($id);
        if ($order->user_id != auth()->id()) {
            return redirect()->route('workorders.index');
        }
        return view('workorders.upload_files', compact('order'));
    }

    // public function upload(Request $request)
    // {
    //     $uploadId = $request->input('upload_id'); // Unique identifier for the upload
    //     $chunk = $request->input('chunk');       // Current chunk number
    //     $chunks = $request->input('chunks');     // Total number of chunks
    //     $filename = $request->input('name');     // Original filename

    //     $tempDir = storage_path('app/tmp_uploads/' . $uploadId); // Unique temp directory for this upload
    //     if (!file_exists($tempDir)) {
    //         mkdir($tempDir, 0777, true);
    //     }

    //     // Save the chunk
    //     $chunkPath = $tempDir . '/' . $chunk . '.part';
    //     $file = $request->file('file');
    //     $file->move($tempDir, $chunk . '.part');

    //     // Check if all chunks are uploaded
    //     if ($chunk + 1 == $chunks) {
    //         $newFilename = time() . '_' . $filename;
    //         $finalDir = storage_path('app/public/uploads/' . Auth::user()->name . '_' . Auth::user()->id . '/' . $request->order_id);
    //         $finalFile = $finalDir . '/' . $newFilename;

    //         // Ensure the final directory exists
    //         if (!file_exists($finalDir)) {
    //             mkdir($finalDir, 0777, true);
    //         }

    //         // Combine chunks into the final file
    //         $fp = fopen($finalFile, 'wb');
    //         for ($i = 0; $i < $chunks; $i++) {
    //             $chunkFile = $tempDir . '/' . $i . '.part';
    //             fwrite($fp, file_get_contents($chunkFile));
    //             unlink($chunkFile); // Clean up chunk
    //         }
    //         fclose($fp);

    //         // Remove temporary directory
    //         rmdir($tempDir);

    //         // Save file information to the database (example for workorder)
    //         $workorder = workorder::findOrFail($request->order_id);
    //         $files = $workorder->files ? json_decode($workorder->files, true) : [];
    //         $files[] = $newFilename;
    //         $workorder->files = json_encode($files);
    //         $workorder->save();
    //     }

    //     return response()->json(['status' => 'success']);
    // }
    public function zipper($id)
    {
        $workorder = workorder::where('id', $id)->first();
        if (!$workorder) {
            return response()->json(['status' => 'error', 'message' => 'Workorder not found'], 404);
        }
        $files = $workorder->files ? json_decode($workorder->files, true) : [];
        $userDir = Auth::user()->name . '_' . Auth::user()->id;
        $jobDir = $workorder->jobname . '_' . $id;
        $dir = storage_path('app/public/uploads/' . $userDir . '/' . $jobDir);
        if (!File::exists($dir)) {
            return response()->json(['status' => 'error', 'message' => 'Directory not found'], 404);
        }
        $zipFileName = Auth::user()->name . '_' . $workorder->jobname . '_workorderfiles.zip';
        $zipFilePath = $dir . '/' . $zipFileName;

        // Create a new ZIP archive
        $zip = new ZipArchive;

        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            // Add files to the ZIP archive
            foreach ($files as $file) {
                $filePath = $dir . '/' . $file;
                if (File::exists($filePath)) {
                    $zip->addFile($filePath, $file);
                }
            }
            $zip->close();
        } else {
            return response()->json(['msg' => 'error', 'data' => 'Failed to create ZIP archive'], 500);
        }

        $allFiles = File::files($dir);
        foreach ($allFiles as $file) {
            if ($file->getFilename() !== $zipFileName) {
                File::delete($file->getPathname());
            }
        }
        $workorder->files = json_encode([$zipFileName]);
        $query = $workorder->save();
        if(!$query){
            return response()->json(['msg' => 'error', 'data' => 'Failed to update workorder'], 500);
        }
        return response()->json(['msg' => 'success', 'message' => 'ZIP archive created successfully']);

    }
    public function upload(Request $request)
    {
        try {
            $uploadId = $request->input('upload_id'); // Unique identifier for the upload
            $chunk = $request->input('chunk');       // Current chunk number
            $chunks = $request->input('chunks');     // Total number of chunks
            $filename = $request->input('name');     // Original filename

            // Find the workorder
            $workorder = workorder::where('id', $request->order_id)->first();
            if (!$workorder) {
                return response()->json(['status' => 'error', 'message' => 'Workorder not found'], 404);
            }

            // Unique temporary directory for the upload
            $tempDir = storage_path('app/tmp_uploads/' . Auth::user()->id . '/' . $workorder->jobname . '_' . $request->order_id . '/' . $uploadId);
            if (!file_exists($tempDir)) {
                mkdir($tempDir, 0777, true);
            }

            // Save the chunk
            $chunkPath = $tempDir . '/' . $chunk . '.part';
            $file = $request->file('file');
            $file->move($tempDir, $chunk . '.part');

            // Check if all chunks are uploaded
            if ($chunk + 1 == $chunks) {
                $newFilename = time() . '_' . $filename;
                $finalDir = storage_path('app/public/uploads/' . Auth::user()->name . '_' . Auth::user()->id . '/' . $workorder->jobname . '_' . $request->order_id);
                $finalFile = $finalDir . '/' . $newFilename;

                // Ensure the final directory exists
                if (!file_exists($finalDir)) {
                    mkdir($finalDir, 0777, true);
                }

                // Combine chunks into the final file
                $fp = fopen($finalFile, 'wb');
                for ($i = 0; $i < $chunks; $i++) {
                    $chunkFile = $tempDir . '/' . $i . '.part';
                    fwrite($fp, file_get_contents($chunkFile));
                    unlink($chunkFile); // Clean up chunk
                }
                fclose($fp);

                // Remove temporary directory
                rmdir($tempDir);

                // Save file information to the database
                $files = $workorder->files ? json_decode($workorder->files, true) : [];
                $files[] = $newFilename;
                $workorder->files = json_encode($files);
                $workorder->save();
            }

            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            // Log the exception for debugging
            \Log::error('File upload error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            // Return error response with exact details
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred during the upload.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }
}
