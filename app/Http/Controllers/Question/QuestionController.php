<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function createQuestion(Request $request)
    {
        $data = [
            'user_id' => $request->user_id,
            'question_number' => $request->question_number,
            'answer' => $request->answer,
        ];

        return Question::create($data);
    }

    public function getQuestions()
    {
        $questions = DB::table('questions')->groupBy('user_id')->get(['user_id', DB::raw('MAX(answer) as answer_true')]);
        $position = 1;

        foreach ($questions as $question) {
            $user = User::where('id', $question->user_id)->first();

            $total = Question::where('user_id', $question->user_id)->count();

            $totalAnswerTrue = Question::where([
                'user_id' => $question->user_id,
                'answer' => 1
            ])->count();

            $users[] = [
                'position' => $position++,
                'name' => $user->name,
                'accuracy' => $totalAnswerTrue / $total * 100 . "%",
            ];
        }

        return QuestionResource::collection($users);
    }
}
