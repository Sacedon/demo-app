<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use Carbon\Carbon;

class LogController extends Controller
{
    public function index()
    {
        $logEntries = Log::orderBy('created_at', 'desc')->get();

        // Format the created_at timestamps
        $logEntries->transform(function ($logEntry) {
            $logEntry->formattedCreatedAt = Carbon::parse($logEntry->created_at)->timezone('Asia/Manila')
            ->format('F d, Y g:i A');
            return $logEntry;
        });

        return view('book-logs', ['logEntries' => $logEntries]);
    }
}
