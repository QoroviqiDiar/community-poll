<?php

namespace App\Http\Controllers;

use App\Poll;
use function dd;
use function is_nan;
use function is_null;
use Validator;
use Illuminate\Http\Request;
use App\Http\Resources\Poll as PollResources;
use function response;

class PollsController extends Controller
{
    public function index()
    {
        return response()->json(Poll::get(), 200);
    }

    public function show($id)
    {
        $poll = Poll::find($id);
        if (is_null($poll)){
            return response()->json(null, 404);
        }

        $response = new PollResources(Poll::findOrFail($id), 200);
        return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|max:255'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        $poll = Poll::create($request->all());
        return response()->json($poll, 201);
    }

    public function update(Request $request, Poll $poll)
    {
        $poll->update($request->all());
        return response()->json($poll, 200);
    }

    public function delete(Poll $poll)
    {
        $poll->delete();
        return response(null, 204);
    }
}
