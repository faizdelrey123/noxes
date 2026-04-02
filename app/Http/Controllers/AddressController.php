<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use Auth;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Address::where('user_id', Auth::id())->get();
        return view('user.alamat.index', compact('addresses'));
    }

    public function create()
    {
        return view('user.alamat.create');
    }

    public function store(Request $request)
    {
        Address::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address
        ]);

        return redirect()->route('alamat.index');
    }

    public function select($id)
{
    $address = Address::findOrFail($id);

    session()->put('selected_address', $address->id); // FIX

    return redirect()->route('cart.index');
}
    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();

        return redirect()->route('alamat.index');
    }
}

