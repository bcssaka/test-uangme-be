<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvestRequest;
use App\Models\Investment;
use Illuminate\Support\Facades\Auth;

class InvestmentController extends Controller
{
    public function invest(InvestRequest $request)
    {
        $banks = [
            'BCA'     => '1123',
            'BRI'     => '1124',
            'BNI'     => '1125',
            'Mandiri' => '1126',
        ];

        $user = Auth::user();
        $va_number = $banks[$request->bank] . $user->phone_number;

        $investment = Investment::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'bank' => $request->bank,
            'va_number' => $va_number,
        ]);

        return response()->json([
            'message' => 'Investment successful',
            'va_number' => $va_number,
        ]);
    }

    public function getTotalInvestments()
    {
        $user = Auth::user();
        $totalInvestments = $user->investments()->sum('amount');

        return response()->json([
            'total_investments' => $totalInvestments,
        ]);
    }

    public function getInvestments()
    {
        $user = Auth::user();
        $investments = $user->investments()->get();

        return response()->json($investments);
    }
}
