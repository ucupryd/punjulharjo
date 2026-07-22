<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(10);
        return view('admin.contact.index', compact('messages'));
    }

    public function markAsRead($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->is_read = true;
        $message->save();

        return redirect()->route('admin.moderasi.index', ['tab' => 'pesan'])->with('success', 'Pesan berhasil ditandai sebagai telah dibaca.');
    }

    public function markAllAsRead()
    {
        ContactMessage::where('is_read', false)->update(['is_read' => true]);

        return redirect()->route('admin.moderasi.index', ['tab' => 'pesan'])->with('success', 'Semua pesan berhasil ditandai sebagai telah dibaca.');
    }
}
