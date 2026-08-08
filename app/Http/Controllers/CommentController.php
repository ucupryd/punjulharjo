<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public const CONTENT_TYPE_MAP = [
        'blog' => \App\Models\Blog::class,
        'video' => \App\Models\Video::class,
        'ebook' => \App\Models\Ebook::class,
    ];

    public function store(Request $request)
    {
        // 1. Honeypot check (field "website" should be empty)
        if ($request->filled('website')) {
            // Fake success response to fool spam bots
            if ($request->expectsJson()) {
                return response()->json(['success' => 'Komentar berhasil dikirim!']);
            }
            return redirect()->back()->with('success', 'Komentar berhasil dikirim!');
        }

        // 2. Validate request parameters
        $request->validate([
            'nama'         => 'required|string|max:100',
            'email'        => 'nullable|email|max:150',
            'komentar'     => 'required|string|max:1000',
            'context_type' => 'required|string|in:blog,video,ebook',
            'context_id'   => 'required|integer',
            'parent_id'    => 'nullable|integer|exists:comments,id',
        ]);

        $contextType = $request->input('context_type');
        $contextId = $request->input('context_id');

        // 3. Resolve context using whitelist mapping
        if (!isset(self::CONTENT_TYPE_MAP[$contextType])) {
            abort(422, 'Tipe konten tidak valid.');
        }

        $modelClass = self::CONTENT_TYPE_MAP[$contextType];
        $model = $modelClass::findOrFail($contextId);

        // 4. Create and save comment
        $comment = new Comment([
            'parent_id'     => $request->input('parent_id'),
            'nama'          => $request->input('nama'),
            'email'         => $request->input('email'),
            'komentar'      => $request->input('komentar'),
            'visitor_token' => $request->input('visitor_token'),
        ]);

        $model->comments()->save($comment);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => 'Komentar berhasil dikirim!',
                'comment' => [
                    'id' => $comment->id,
                    'nama' => $comment->nama,
                    'komentar' => $comment->komentar,
                    'time_ago' => 'Baru saja',
                    'delete_url' => auth()->check() && auth()->user()->isAdmin() ? route('admin.comment.destroy', $comment->id) : null
                ]
            ]);
        }

        return redirect()->back()->with('success', 'Komentar berhasil dikirim!');
    }

    public function destroy($id, Request $request)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Akses ditolak.');
        }

        $comment = Comment::findOrFail($id);

        // If it is a root comment, delete replies first to avoid orphan comments
        if (is_null($comment->parent_id)) {
            $comment->replies()->delete();
        }

        $comment->delete();

        if ($request->expectsJson()) {
            return response()->json(['success' => 'Komentar berhasil dihapus!']);
        }

        return redirect()->back()->with('success', 'Komentar berhasil dihapus!');
    }

    public function markAsRead($id, Request $request)
    {
        if (!auth()->check() || !auth()->user()->isAdmin()) {
            abort(403, 'Akses ditolak.');
        }

        $comment = Comment::findOrFail($id);
        $comment->update(['is_read' => true]);

        if ($request->expectsJson()) {
            return response()->json(['success' => 'Komentar ditandai dibaca!']);
        }

        return redirect()->back()->with('success', 'Komentar ditandai dibaca!');
    }
}
