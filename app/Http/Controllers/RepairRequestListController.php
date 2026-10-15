<?php

namespace App\Http\Controllers;

use App\Models\RepairRequest;

class RepairRequestListController extends Controller
{
    public function index()
    {
        $query = RepairRequest::with(['quotes', 'photos'])->latest();

        if (auth()->user()->role !== 'repairer') {
            $query->where('user_id', auth()->id());
        }

        $requests = $query->get();

        return view('repair-requests', compact('requests'));
    }
}