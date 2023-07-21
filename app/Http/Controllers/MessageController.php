<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Events\MessageSentEvent;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return Message::with('user')->get();
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $message = $user->messages()->create([
            'message' => $request->input('message')
        ]);
        broadcast(new MessageSentEvent($message, $user))->toOthers();

        return [
            'message' => $message,
            'user' => $user,
        ];
    }

    public function delete($id) {
        $message = Message::findOrFail($id);

        if($message)
           $message->delete(); 
        else
            return response()->json(error);
            
        return response()->json(null); 
    }
}
