<?php

namespace App\Http\Controllers;

use App\Models\RepairQuote;

class RepairQuoteStatusController extends Controller
{
    public function accept(RepairQuote $repairQuote)
    {
        abort_unless(
            auth()->user()->role === 'customer'
            && $repairQuote->repairRequest->user_id === auth()->id()
            && $repairQuote->status === 'Submitted',
            403
        );

        $repairQuote->update(['status' => 'Accepted']);
        $repairQuote->repairRequest()->update(['status' => 'Accepted']);

        return redirect('/requests')->with('success', 'The quote was accepted.');
    }

    public function complete(RepairQuote $repairQuote)
    {
        abort_unless(
            auth()->user()->role === 'repairer'
            && $repairQuote->status === 'Accepted',
            403
        );

        $repairQuote->update(['status' => 'Completed']);
        $repairQuote->repairRequest()->update(['status' => 'Completed']);

        return redirect('/requests')->with('success', 'The repair was marked as completed.');
    }
}