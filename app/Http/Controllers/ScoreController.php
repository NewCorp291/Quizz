<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreScoreRequest;
use App\Http\Requests\UpdateScoreRequests;
use App\Models\Score;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $score = Score::all();
        return response()->json($score);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function addScore(Request $request) {
        $user = auth()->user();
        if ($user == null) {
            return ResponseFormatter::unauthorized("You need to Login first !");
        }

        $quiz_id = $request["quiz_id"];
        $answers = $request["answers"];
        if ($quiz_id == null || $answers == null) {
            return ResponseFormatter::badRequest("Missing Parameters");
        }

        $quiz = Quiz::find($quiz_id);
        if ($quiz == null) {
            return ResponseFormatter::notFound("Quiz");
        }

        $foundQuestion = Question::where("quiz_id", $quiz_id)->get();
        if (count($foundQuestions) !== count($answers)) {
            return ResponseFormatter::badrequest("The number of answer have to match the number of question");
        }
        
        $finalScore = 0;
        foreach ($answers as $answer) {
            $question = Question::find($answer['question_id']);
            if ($question ==null) {
                return ResponseFormatter::notFound("Question ". $answer['question_id'] . " not found");
            }
            if ($question->answer === $answer['answer']) {
                $finalScore += $question->earnings;
            }
        }

        $score = new Score();
        $score["user_id"] = $user["id"];
        $score["quiz_id"] = $quiz_id;
        $score["score"] = $finalScore;
        $score->save();

        return response("ok");

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreScoreRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function show(Score $score)
    {
        $score = Score::find($id);
        return response()->json($score);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function edit(Score $score)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateScoreRequest $request, Score $score)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Score  $score
     * @return \Illuminate\Http\Response
     */
    public function destroy(Score $score)
    {
        //
    }
}
