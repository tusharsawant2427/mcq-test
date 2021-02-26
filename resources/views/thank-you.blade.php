@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-xl-12">

        <!--begin:: Packages-->
        <div class="m-portlet m--bg-info m-portlet--bordered-semi m-portlet--full-height ">
            <div class="m-portlet__head" style="display:flex">
                <div class="m-portlet__head-caption" style="margin:auto">
                    <div class="m-portlet__head-title">
                        <h4 class="m-portlet__head-text m--font-light" style="
                        font-size: x-large;
                    ">
                            THANK YOU
                        </h4>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                   
                </div>
            </div>
            <div class="m-portlet__body">

                <!--begin::Widget 29-->
                <div class="m-widget29">
                    <div class="m-widget_content">
                        <h3 class="m-widget_content-title" style="text-align: center;color: black;">YOUR RESULT</h3>
                        <div class="m-widget_content-items">
                            <div class="m-widget_content-item">
                                <span>Total Questions</span>
                                <span class="m--font-accent">{{ $total_attend_questions }}/{{ $total_questions }}</span>
                            </div>
                            <div class="m-widget_content-item">
                                <span>Correct Answer</span>
                                <span class="m--font-brand">{{ (100*$total_correct_questions)/$total_questions }}%</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!--end::Widget 29-->
            </div>
        </div>

        <!--end:: Packages-->
    </div>
</div>
@endsection