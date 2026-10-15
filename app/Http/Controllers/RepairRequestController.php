<?php

namespace App\Http\Controllers;

use App\Models\RepairRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepairRequestController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'email', 'max:255'],
            'customer_phone' => ['nullable', 'string', 'max:30'],
            'vehicle' => ['required', 'string', 'max:255'],
            'year' => ['required', 'integer', 'min:1900', 'max:2100'],
            'description' => ['required', 'string', 'max:5000'],
            'photos' => ['nullable', 'array', 'max:5'],
            'photos.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
        ]);

        $photos = $validated['photos'] ?? [];
        unset($validated['photos']);

        $validated['user_id'] = Auth::id();
        $repairRequest = RepairRequest::create($validated);

        foreach ($photos as $photo) {
            $path = $photo->store('repair-photos', 'public');

            $repairRequest->photos()->create([
                'photo_path' => $path,
            ]);
        }

        return redirect('/')
            ->with('success', 'Your repair request was saved.');
    }
}