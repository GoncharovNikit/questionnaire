@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1>{{ $questionnaire->title }}</h1>

            <form class="d-flex flex-column justify-content-center" action="{{ route('survey.store', ['questionnaire' => $questionnaire->id, 'slug' => Str::slug($questionnaire->title)]) }}" method="POST">
                @csrf

                @foreach($questionnaire->questions as $question)
                <div class="card mt-4">
                    <div class="card-header"><strong>{{ $loop->iteration }}. </strong>{{ $question->question }}</div>

                    <div class="card-body">
                        @error('responses.' . $question->id . '.answer_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror

                        <ul class="list-group">
                            @foreach($question->answers as $answer)
                            <label for="answer{{ $answer->id }}">
                                <li class="list-group-item list-group-item-info">
                                    <input type="radio" name="responses[{{ $question->id }}][answer_id]" {{ (old('responses.' . $question->id . '.answer_id') == $answer->id) ? 'checked' : '' }} value="{{ $answer->id }}" id="answer{{ $answer->id }}" class="mr-2">
                                    {{ $answer->answer }}

                                    <input type="text" name="responses[{{ $question->id }}][question_id]" value="{{ $question->id }}" hidden>
                                </li>
                            </label>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach

                <input type="text" name="survey[email]" id="useremail" value="{{ Auth::user()->email }}" hidden>
                <input type="text" name="survey[name]" id="username" value="{{ Auth::user()->name }}" hidden>

                <button type="submit" class="btn btn-success mt-3 mb-4">Complete Survey</button>
            </form>

        </div>
    </div>
</div>
@endsection