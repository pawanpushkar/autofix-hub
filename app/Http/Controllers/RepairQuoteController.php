<?php

namespace App\Http\Controllers;

use App\Models\RepairRequest;
use Illuminate\Http\Request;

class RepairQuoteController extends Controller
{
    public function create(RepairRequest $repairRequest)
    {
        abort_unless(auth()->user()->role === 'repairer', 403);

        return view('repair-quote', compact('repairRequest'));
    }

    public function store(Request $request, RepairRequest $repairRequest)
    {
        abort_unless(auth()->user()->role === 'repairer', 403);

        $validated = $request->validate([
            'parts_cost' => ['required', 'numeric', 'min:0'],
            'labor_cost' => ['required', 'numeric', 'min:0'],
            'tax_amount' => ['required', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string', 'max:5000'],
        ]);

        $repairRequest->quotes()->create([
            ...$validated,
            'status' => 'Submitted',
        ]);

        $repairRequest->update(['status' => 'Quoted']);

        return redirect('/requests')->with('success', 'The quote was saved.');
    }
}