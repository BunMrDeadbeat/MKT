<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AdministrativeNotificationRecipient;
use App\Models\User;
use Illuminate\Http\Request;

class AdministrativeNotificationRecipientController extends Controller
{
    public function index()
    {
        $recipients = AdministrativeNotificationRecipient::with('user')->get();
        $users = User::whereIn('id', function ($query) {
            $query->select('user_id')->from('role_user')->whereIn('role_id', [1, 2]);
        })->whereNotIn('id', $recipients->pluck('user_id'))->get();

        return view('partials.admin.notification_recipients.index', compact('recipients', 'users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:administrative_notification_recipients,user_id',
        ]);

       AdministrativeNotificationRecipient::create($validated);

        return redirect()->route('admin.notification_recipients.index')->with('success', 'Destinatario agregado correctamente.');
    }

    public function destroy(AdministrativeNotificationRecipient $recipient)
    {
        $recipient->delete();

        return redirect()->route('admin.notification_recipients.index')->with('success', 'Destinatario eliminado correctamente.');
    }
}
