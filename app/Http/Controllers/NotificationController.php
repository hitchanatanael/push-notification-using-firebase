<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FirebaseNotification;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::all();

        return view('notifications.index', compact('notifications'));
    }

    public function sendNotification(Request $request)
    {
        $request->validate([
            'title'        => 'required',
            'body'         => 'required',
            'device_token' => 'required',
        ]);

        $notification = Notification::create($request->all());

        $serviceAccountPath = storage_path('app/oncard-34afb-683ac04732da.json');
        $factory = (new Factory)->withServiceAccount($serviceAccountPath);
        $messaging = $factory->createMessaging();

        $message = CloudMessage::fromArray([
            'token'        => $notification->device_token,
            'notification' => [
                'title' => $notification->title,
                'body'  => $notification->body,
            ],
        ]);

        $messaging->send($message);

        return back()->with('success', 'Notifikasi berhasil dikirim!');
    }
}
