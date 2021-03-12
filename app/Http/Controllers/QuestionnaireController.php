<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionnaireRequest;
use Illuminate\Http\Request;
use App\Questionnaire;
use Illuminate\Support\Facades\Auth;

class QuestionnaireController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function create()
    {

        return view('questionnaire.create');
    }
    public function store(QuestionnaireRequest $request)
    {
        $questionnaire = auth()->user()->questionnaires()->create($request->validated());
        //Questionnaire::create(array_merge($request->validated(), ['user_id' => Auth::id()])); 
        return redirect()->route('quest.show', ['questionnaire' => $questionnaire->id]);
    }
    public function show(Questionnaire $questionnaire)
    {
        $questionnaire->load('questions.answers.responses'); //lazy-load (ленивая загрузка позволяет выгрузить сразу
        // все связки (связать текущую модель с questions, а questions связать с answers). У нас будет и questions и answers )

        
                
        return view('questionnaire.show', compact('questionnaire'));
    }
}


