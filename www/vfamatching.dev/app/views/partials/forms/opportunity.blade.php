<?php $validationErrors = Session::has('validation_errors') ? Session::get('validation_errors') : null; ?>
<?php
if(!isset($company)){
	throw new Exception('Company required to create Opportunity');
}
?>
{{-- If $opportunity exists, PUT to /opportunities/{id} to update, otherwise POST to /opportunities to store new  --}}
@if(isset($opportunity))
    <?php throw new Exception('TODO: Update Opportunity View'); ?>
@else
{{-- Opportunity was not passed in, so send an empty form that stores new opportunity --}}
{{ Form::open(array('url' => 'opportunities', 'method' => 'POST', 'files' => true)) }}
        <fieldset>
            {{ Form::hidden('company_id', $company->id) }}
            <div class="form-group @if($validationErrors){{ $validationErrors->has('title') ? "has-error" : ""}}@endif">
                {{ Form::label('title', 'Title') }}
                {{ Form::text('title', Input::old('title'), array('class'=>'form-control required character-limit', 'character-limit-max'=>140)) }}
            </div>
            <div class="form-group @if($validationErrors){{ $validationErrors->has('teaser') ? "has-error" : ""}}@endif">
                {{ Form::label('teaser', 'Pitch this Opportunity in 140 characters or less') }}
                {{ Form::text('teaser', Input::old('teaser'), array('class'=>'form-control required character-limit', 'character-limit-max'=>140)) }}
            </div>
            <div class="form-group @if($validationErrors){{ $validationErrors->has('city') ? "has-error" : ""}}@endif">
                {{ Form::label('city', 'City') }}
                {{ Form::text('city', Input::old('city'), array('class'=>'form-control required character-limit', 'character-limit-max'=>280)) }}
            </div>
            <div class="form-group @if($validationErrors){{ $validationErrors->has('description') ? "has-error" : ""}}@endif">
                {{ Form::label('description', 'Describe the Opportunity') }}
                {{ Form::textarea('description', Input::old('description'), array('class'=>'form-control character-limit required', 'character-limit-max'=>1400, 'character-limit-min'=>140)) }}
                <span><small>140 characters minimum</small></span>
            </div>
            <div class="form-group @if($validationErrors){{ $validationErrors->has('responsibilitiesAnswer') ? "has-error" : ""}}@endif">
                {{ Form::label('responsibilitiesAnswer', "What will be some of the Fellow's initial responsibilities?") }}
                {{ Form::textarea('responsibilitiesAnswer', Input::old('responsibilitiesAnswer'), array('class'=>'form-control required character-limit', 'character-limit-max'=>280, 'rows'=>5)) }}
            </div>
            <div class="form-group @if($validationErrors){{ $validationErrors->has('skillsAnswer') ? "has-error" : ""}}@endif">
                {{ Form::label('skillsAnswer', "What are the skills and attributes of a Fellow likely to succeed in this role and at this company?") }}
                {{ Form::textarea('skillsAnswer', Input::old('skillsAnswer'), array('class'=>'form-control required character-limit', 'character-limit-max'=>280, 'rows'=>5)) }}
            </div>
            <div class="form-group @if($validationErrors){{ $validationErrors->has('developmentAnswer') ? "has-error" : ""}}@endif">
                {{ Form::label('developmentAnswer', "What are some ways the Fellow may develop in this role?") }}
                {{ Form::textarea('developmentAnswer', Input::old('developmentAnswer'), array('class'=>'form-control required character-limit', 'character-limit-max'=>280, 'rows'=>5)) }}
            </div>
            <!-- Commented out in lieu of Job Types -->
            <!-- <div class="form-group @if($validationErrors){{ $validationErrors->has('tags') ? "has-error" : ""}}@endif">
                {{ Form::label('tags', 'List this Opportunity\'s labels, seperated by commas') }}
                {{ Form::text('tags', Input::old('tags'), array('class'=>'form-control')) }}
                <small><span class="">Example:<em> Data Analytics, Digital Marketing, Sales</em></span></small>
            </div> -->
            @include('partials.components.jobTypes', array('label' => "What type of Opportunity is this?"))
            <div class="form-group">
                {{ Form::submit('Create Opportunity', array('class'=>'btn btn-success')) }}
            </div>
        </fieldset>
    {{ Form::close() }}
@endif

<script src="{{ URL::to('js/pretty-file-upload.js') }}"></script>