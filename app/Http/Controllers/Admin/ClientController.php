<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function AllClients()
    {
        $clients = User::role('user')->latest()->get();
        return view('backend.pages.client.all_clients', compact('clients'));
    }

    public function EditClient($id)
    {
        $client = User::role('user')->findOrFail($id);
        return view('backend.pages.client.edit_client', compact('client'));
    }

    public function UpdateClient(Request $request, $id)
    {
        $client = User::role('user')->findOrFail($id);

        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255|unique:users,email,'.$client->id,
            'phone'   => 'nullable|string|max:30',
            'address' => 'nullable|string|max:500',
            'status'  => 'required|in:active,inactive',
        ]);

        $client->update([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'address' => $request->address,
            'status'  => $request->status,
        ]);

        $notification = [
            'message'    => 'Client updated successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.clients')->with($notification);
    }

    public function ToggleClientStatus($id)
    {
        $client = User::role('user')->findOrFail($id);
        $client->update([
            'status' => $client->status === 'active' ? 'inactive' : 'active',
        ]);

        $notification = [
            'message'    => 'Client status updated',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }
}
