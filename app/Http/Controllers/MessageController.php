<?php

namespace App\Http\Controllers;

use App\Http\Requests\Message\StoreRequest;
use App\Http\Resources\Message\StoreResource;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(){
        $messages = Message::all();
        $messages = StoreResource::collection($messages)->resolve();
        return inertia('Message/Index', compact('messages'));
    }

    public function store(StoreRequest $request){
        $data = $request->validated();
        $message = Message::create($data);

        return StoreResource::make($message)->resolve();
    }
}
