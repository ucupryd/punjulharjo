<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reaction;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class ReactionController extends Controller
{
    public const CONTENT_TYPE_MAP = [
        'blog' => \App\Models\Blog::class,
        'video' => \App\Models\Video::class,
        'ebook' => \App\Models\Ebook::class,
    ];

    public function store(Request $request)
    {
        $request->validate([
            'type'         => 'required|string|in:suka,senang,takjub,sedih',
            'context_type' => 'required|string|in:blog,video,ebook',
            'context_id'   => 'required|integer',
        ]);

        $type = $request->input('type');
        $contextType = $request->input('context_type');
        $contextId = $request->input('context_id');
        $visitorToken = $request->input('visitor_token');

        if (!isset(self::CONTENT_TYPE_MAP[$contextType])) {
            abort(422, 'Tipe konten tidak valid.');
        }

        $modelClass = self::CONTENT_TYPE_MAP[$contextType];
        $model = $modelClass::findOrFail($contextId);

        // Check if visitor has already reacted
        $exists = Reaction::where('reactable_type', $modelClass)
            ->where('reactable_id', $contextId)
            ->where('visitor_token', $visitorToken)
            ->exists();

        if ($exists) {
            $msg = 'Anda sudah memberi reaksi pada konten ini.';
            if ($request->expectsJson()) {
                return response()->json(['error' => $msg], 422);
            }
            return redirect()->back()->withErrors(['reaction' => $msg]);
        }

        try {
            $reaction = new Reaction([
                'type'          => $type,
                'visitor_token' => $visitorToken,
            ]);

            $model->reactions()->save($reaction);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => 'Reaksi berhasil ditambahkan!',
                    'reaction' => $type
                ]);
            }
            return redirect()->back()->with('success', 'Reaksi berhasil ditambahkan!');

        } catch (QueryException $e) {
            // Check unique constraint violation
            $msg = 'Anda sudah memberi reaksi pada konten ini.';
            if ($request->expectsJson()) {
                return response()->json(['error' => $msg], 422);
            }
            return redirect()->back()->withErrors(['reaction' => $msg]);
        }
    }

    public function summary($contextType, $contextId, Request $request)
    {
        if (!isset(self::CONTENT_TYPE_MAP[$contextType])) {
            abort(422, 'Tipe konten tidak valid.');
        }

        $modelClass = self::CONTENT_TYPE_MAP[$contextType];
        $visitorToken = $request->input('visitor_token');

        // Get count of each reaction type
        $reactions = Reaction::where('reactable_type', $modelClass)
            ->where('reactable_id', $contextId)
            ->select('type', DB::raw('count(*) as count'))
            ->groupBy('type')
            ->pluck('count', 'type')
            ->toArray();

        // Ensure all keys exist
        $counts = [
            'suka' => $reactions['suka'] ?? 0,
            'senang' => $reactions['senang'] ?? 0,
            'takjub' => $reactions['takjub'] ?? 0,
            'sedih' => $reactions['sedih'] ?? 0,
        ];

        // Check current visitor reaction
        $userReaction = null;
        if ($visitorToken) {
            $userReaction = Reaction::where('reactable_type', $modelClass)
                ->where('reactable_id', $contextId)
                ->where('visitor_token', $visitorToken)
                ->value('type');
        }

        return response()->json([
            'counts' => $counts,
            'user_reaction' => $userReaction,
        ]);
    }
}
