@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">
                    <h6>{{$oppertunity->title}}</h6>
                </div>
                <div class="card-body">
                    <div class="summery">
                        <strong>Summery</strong><br>
                        {{$oppertunity->summery}}
                    </div>
                    <br>
                    <div class="salary">
                        <strong>Salary</strong><br>
                        {{$oppertunity->min_salary}} To {{$oppertunity->max_salary}} 
                        @if($oppertunity->salary_type =='1')
                            <strong>(Monthly)</strong>
                        @elseif($oppertunity->salary_type =='2')
                            <strong>(Yearly)</strong>
                        @elseif($oppertunity->salary_type =='3')
                            <strong>(Daily)</strong>
                        @else
                            <i>Not Specified</i>       
                        @endif 
                    </div>
                    <br>
                    <div class="job_type">
                        <strong>Job Type</strong><br>
                        @if($oppertunity->job_type =='1')
                            Internship
                        @elseif($oppertunity->job_type =='2')
                            Fresher
                        @elseif($oppertunity->job_type =='3')
                            Experienced
                        @else
                            <i>Not Specified</i>       
                        @endif
                    </div>
                    <br>
                    <div class="work_type">
                        <strong>Work Type</strong><br>
                        @if($oppertunity->work_type =='1')
                            Part Time
                        @elseif($oppertunity->work_type =='2')
                            Full Time
                        @else
                            <i>Not Specified</i>       
                        @endif
                    </div>
                    <br>
                    <div class="work_type">
                        <strong>No Of Positions</strong><br>
                        {{$oppertunity->no_of_positions}}
                    </div>

                    <br>
                    <div class="urgent_hiring">
                        <strong>Urgent Hiring</strong><br>
                        {{($oppertunity->urgent_hiring == 1) ? "Yes" : "No"}}
                    </div>

                    <br>
                    <div class="status">
                        <strong>Status</strong><br>
                        {{($oppertunity->status == 1) ? "Open" : "Closed"}}
                    </div>
                    <br>
                    <div class="discription">
                        <strong>Description</strong><br>
                        {{$oppertunity->description}}
                    </div>
                </div>
            </div>
        </div>
         @if(!in_array($oppertunity->id, $products))
            <div class="col-sm-4">
                <form action="{{route('store_apply_job',$oppertunity->id)}}" method="post" id="application_form">
                    @csrf
                    <h4>Submit your Job Application</h4>
                    <div class="input-group mb-3">
                        <input type="date" class="form-control" id="chosen_date">
                        <span class="input-group-text btn btn-primary" id="add_dates">+</span>
                    </div>
                    <div class="row" id="dates_area">
                    </div>
                    <button class="btn btn-success" type="Submit" id="submit_application">Submit your Application</button>
                </form>
            </div>
         @endif
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        var valid = 0;
        $('#add_dates').click(function(e){
            e.preventDefault();
            if(valid == 3){
                alert('only Three Dates Are allowed');
                return false;
            }
            var chosen_date = $("#chosen_date").val();
            if(chosen_date != ''){
                var html = `
                <div class="input-group mb-3 row_${valid}">
                    <input type="date" name='dates[]' class="form-control selected_dates" value="${chosen_date}">
                    <span class="input-group-text btn btn-danger del_dates" data-id="${valid}">X</span>
                </div>
                `;   
                $('#dates_area').append(html);
                $('#chosen_date').val('');
                valid++;
            }
        });

        $(document).on('click','.del_dates',function(e){
            e.preventDefault();
            var id  = $(this).attr('data-id');
            $(`.row_${valid}`).remove();
            valid --;
        });

        $('#submit_application').click(function(e){
            e.preventDefault();
            if(valid > 0){
                $('#application_form').submit();
            }else{
                alert('Please Choose Date')
            }
        });
    });
</script>
@endsection
