@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">Try To Attend All the Questions! &nbsp;<span class="m-widget5__info-author m--font-success"><b> * Best Of Luck * </b></span></h3>
                   
                </div>
                <div class="card-body">
                    @if($errors->any())
                    <ul>
                    {!! implode('', $errors->all('<li style="color:red">:message</li>')) !!}
                    </ul>
                    @endif
                <!--begin::Form-->
                <form class="form" method="POST" action="{{ route('store') }}">
                    @csrf
                   @forelse ($questions['results'] as $key=>$question)
                   <div class="form-group">
                    <label><b>{{ $sr_no=$key+1 }})  {!! $question['question'] !!} </b></label>
                    <input type="hidden" name="question[{{ $key }}][q]" value="{!! $question['question'] !!}"/>
                    <input type="hidden" name="question[{{ $key }}][type]" value="{!! $question['type'] !!}"/>
                    <input type="hidden" name="question[{{ $key }}][a]" value="{!! $question['correct_answer'] !!}"/>
                    @if($question['type']=='multiple')
                    
                        @php
                            $options=array();
                            $options=$question['incorrect_answers'];
                            array_push($options,$question['correct_answer']);
                            shuffle($options);
                        @endphp

                    <div class="m-radio-list">
                        @foreach ($options as $o_key=>$option)
                            <label class="m-radio m-radio--state-success">
                            <input type="radio" name="question[{{ $key }}][option]" value="{!! $option !!}">
                            <span></span>{!! $option !!}</label>
                        @endforeach
                    </div>
                    @else
                    <div class="m-radio-list">
                        <label class="m-radio m-radio--state-success">
                        <input type="radio" name="question[{{ $key }}][option]" value="true">
                        <span></span>True</label>

                        <label class="m-radio m-radio--state-success">
                        <input type="radio" name="question[{{ $key }}][option]" value="false">
                        <span></span>False</label>
                    </div>
                    @endif
                    <hr>
                    {{-- <span class="form-text text-muted">Some help text goes here</span> --}}
                </div> 
                   @empty
                       
                   @endforelse
                  
                     <button class="btn btn-success m-btn m-btn--custom m-btn--bolder m-btn--uppercase">Submit</button>  
                    </form>
                </div>
            </div>
            <!--end::Card-->
        </div>
    </div>
</div>
@endsection
