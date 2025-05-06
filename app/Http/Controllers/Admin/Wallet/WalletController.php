<?php

namespace App\Http\Controllers\Admin\Wallet;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Bavix\Wallet\Models\Transaction; //bavix


class WalletController extends Controller
{
    /**
     * Show wallet balance and transaction history.
     */
    public function index(Request $request)
{
    $wallet = Auth::user()->wallet;
    $search = $request->input('search');
    
    if ($search) {
        // Filter transactions based on search query (e.g., uuid or type)
        $transactions = $wallet->transactions()
            ->where('uuid', 'LIKE', "%{$search}%")
            ->orWhere('type', 'LIKE', "%{$search}%")
            ->paginate(10);
    } else {
        // Get all transactions if no search is applied
        $transactions = $wallet->transactions()->latest()->paginate(10);
    }

    return view('admin.wallet.index', compact('wallet', 'transactions'));
}

    /**
     * Show deposit form.
     */
    public function create()
    {
        return view('admin.wallet.create');
    }

    /**
     * Handle deposit to wallet.
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        Auth::user()->deposit($request->amount);

        return redirect()->route('admin.wallet.index')->with('success', 'Amount deposited successfully.');
    }

    /**
     * Show form to transfer amount to another user.
     */
    public function transfer()
    {
        return view('admin.wallet.transfer');
    }

    /**
     * Perform transfer to another user.
     */
    public function makeTransfer(Request $request)
    {
        $request->validate([
            'recipient_email' => 'required|email|exists:users,email',
            'amount' => 'required|numeric|min:1',
        ]);

        $sender = Auth::user();
        $recipient = User::where('email', $request->recipient_email)->first();

        try {
            DB::transaction(function () use ($sender, $recipient, $request) {
                $sender->transfer($recipient, $request->amount);
            });

            return redirect()->route('admin.wallet.index')->with('success', 'Transfer successful.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
