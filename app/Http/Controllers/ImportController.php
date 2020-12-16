<?php

namespace App\Http\Controllers;

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

    /**
     * Parse contacts from file.
     *
     * @param  Request  $request
     * @param  ContactService  $contactService
     * @return JsonResponse
     */
    public function parseContacts(Request $request, ContactService $contactService)
    {
        $file = $request->file('file');
        $file_data = $contactService->parseContacts($file);

        return response()->json($file_data);
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
                'status' => 'success'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => 'error',
                'message' => $exception->getMessage()
            ], 500)->withException($exception);
        }
    }
}
