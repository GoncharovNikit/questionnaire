@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create New Questionnaire') }}</div>

                <div class="card-body">
                    <form action="{{ route('quest.store') }}" method="POST">
                        @csrf

                        <form>
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input name="title" type="text" class="form-control" id="title" aria-describedby="titleHelp" value="{{ old('title') }}" placeholder="Enter title">
                                <small id="titleHelp" class="form-text text-muted">Give your questionnaire a title that attracts attention.</small>
                                @error('title')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="purpose">Purpose</label>
                                <input name="purpose" type="text" class="form-control" id="purpose" aria-describedby="purposeHelp" value="{{ old('purpose') }}" placeholder="Enter purpose">
                                <small id="purposeHelp" class="form-text text-muted">Giving a purpose will increase responses.</small>
                                @error('purpose')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn btn-success">Create questionnaire</button>
                        </form>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection