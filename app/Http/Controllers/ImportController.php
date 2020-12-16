<?php

namespace App\Http\Controllers;

use App\Requests\FileImportRequest;
use App\Services\ContactService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class ImportController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $errorMessage = 'We could not parse contacts. Please try again or contact administrator.';
    /**
     * Parse contacts from file.
     *
     * @param  FileImportRequest  $request
     * @param  ContactService  $contactService
     * @return JsonResponse
     */
    public function parseContacts(FileImportRequest $request, ContactService $contactService)
    {
        try {
            $file = $request->file('file');
            $file_data = $contactService->parseContacts($file);
            return response()->json([
                'status' => 'success',
                'message' => 'Ok',
                'data' => $file_data
            ]);
        } catch (\Exception $exception){
            return response()->json([
                'status' => 'error',
                'message' => $this->errorMessage,
                'data' => []
            ], 500)->withException($exception);
        }
    }

    /**
     * Import contacts.
     *
     * @param  Request  $request
     * @param  ContactService  $contactService
     * @return JsonResponse
     * @throws Throwable
     */
    public function importContacts(Request $request, ContactService $contactService)
    {
        $data = $request->all();
        try {
            $contactService->importContacts($data);
            return response()->json([
                'status' => 'success',
                'message' => 'Ok',
                'data' => []
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => 'error',
                'message' => $this->errorMessage,
                'data' => []
            ], 500)->withException($exception);
        }
    }
}
