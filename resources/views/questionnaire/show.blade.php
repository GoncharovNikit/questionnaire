@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $questionnaire->title }}</div>

                <div class="card-body">
                    <a class="btn btn-success" href="{{ route('question.create', ['questionnaire' => $questionnaire->id]) }}">Add question</a>
                    <a class="btn btn-success" href="{{ route('survey.show', ['questionnaire' => $questionnaire->id, 'slug' => Str::slug($questionnaire->title)]) }}">Take Survey</a>
                    <a class="btn btn-success" href="{{ route('home') }}">Home</a>
                </div>
            </div>

            @foreach($questionnaire->questions as $question)
            <div class="card mt-4">
                <div class="card-header">{{ $question->question }}</div>

                <div class="card-body">
                    <ul class="list-group">
                        @foreach($question->answers as $answer)
                        <li class="list-group-item list-group-item-info d-flex justify-content-between">
                            <div>{{ $answer->answer }}</div>
                            @if($question->responses->count())
                            <div>{{ round(100 * $answer->responses->count() / $question->responses->count(), 1) }}%</div>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                </div>

                <div class="card-footer">
                    <form action="{{ route('question.delete', ['questionnaire' => $questionnaire->id, 'question' => $question->id]) }}" method="POST">
                        @method('delete')
                        @csrf

                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete Question</button>
                    </form>
                </div>

            </div>
            @endforeach

        </div>
    </div>
</div>
@endsection