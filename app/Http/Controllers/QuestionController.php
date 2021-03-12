<?php

namespace App\Http\Controllers;

use App\Questionnaire;
use Illuminate\Http\Request;
use App\Question;

class QuestionController extends Controller
{
    public function create(Questionnaire $questionnaire)
    {
        return view('question.create', compact('questionnaire'));
    }
    public function store(Questionnaire $questionnaire)
    {
        // dd(request()->all());
        $data = request()->validate([
            'question.question' => 'required',
            'answers.*.answer' => ''
        ]);

        $question = $questionnaire->questions()->create($data['question']);

        // dd(array_map(function($e){ return $e['answer']; }, request()->get('answers')));
        // dd(request()->get('answers')[0]['answer']);
        if(count(array_filter(request()->get('answers'), function($e){ return $e['answer'] != null; }, ARRAY_FILTER_USE_BOTH)) > 0)
            $question->answers()->createMany(array_filter(request()->get('answers'), function($e){ return $e['answer'] != null; }, ARRAY_FILTER_USE_BOTH));

        return redirect()->route('quest.show', ['questionnaire' => $questionnaire->id]);
    }
    public function destroy(Questionnaire $questionnaire, Question $question)
    {
        $question->answers()->delete();  // удаляем все ответы
        $question->delete();
        return redirect($questionnaire->path());
    }

}
