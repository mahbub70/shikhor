@extends('layouts.app')

@section('title')
    <title>Form - Add MCQ</title>
@endsection

@section('css')

@endsection

@section('content')
<div class="be-content">
    <div class="main-content container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-border-color card-border-color-primary">
                  <div class="card-header card-header-divider">Add MCQ<span class="card-subtitle"></span></div>
                    @if (session('success'))
                        <div class="alert alert-success p-3 w-50 m-auto mt-2">
                            <strong>Success!</strong> {!! session('success') !!}
                        </div>                        
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger p-3 w-50 m-auto mt-2">
                            <strong>Faild!</strong> {!! session('error') !!}
                        </div>                        
                    @endif
                  <div class="card-body">
                    <form action="{{ route('admin.mcq.add') }}" method="POST" id="people_add_form" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group pt-2">
                            <label for="class">Select Class</label>
                            <select name="class_id" id="class" class="form-control">
                                <option value="" selected disabled>Choose One</option>
                                @foreach ($classes as $key=>$item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group pt-2">
                            <label for="year">Select Year</label>
                            <select name="year" id="year" class="form-control">
                                <option value="" selected disabled>Choose One</option>
                                <option value="1990">1990</option>
                                <option value="1991">1991</option>
                                <option value="1992">1992</option>
                                <option value="1993">1993</option>
                                <option value="1994">1994</option>
                                <option value="1995">1995</option>
                                <option value="1996">1996</option>
                                <option value="1997">1997</option>
                                <option value="1998">1998</option>
                                <option value="1999">1999</option>
                                <option value="2000">2000</option>
                                <option value="2001">2001</option>
                                <option value="2002">2002</option>
                                <option value="2003">2003</option>
                                <option value="2004">2004</option>
                                <option value="2005">2005</option>
                                <option value="2006">2006</option>
                                <option value="2007">2007</option>
                                <option value="2008">2008</option>
                                <option value="2009">2009</option>
                                <option value="2010">2010</option>
                                <option value="2011">2011</option>
                                <option value="2012">2012</option>
                                <option value="2013">2013</option>
                                <option value="2014">2014</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                                <option value="2026">2026</option>
                                <option value="2027">2027</option>
                                <option value="2028">2028</option>
                                <option value="2029">2029</option>
                                <option value="2030">2030</option>
                            </select>
                        </div>
                      <div class="form-group pt-2">
                        <label for="inputquestion">MCQ Question</label>
                        <input class="form-control @error('question') is-invalid @enderror" id="inputquestion" type="text" placeholder="Enter Question" name="question" value="{{ old('question') }}">
                        @error('question')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-group pt-2">
                        <label for="inputoption_one">Option One</label>
                        <input class="form-control @error('option_one') is-invalid @enderror" id="inputoption_one" type="text" placeholder="Enter Option One" name="option_one" value="{{ old('option_one') }}">
                        @error('option_one')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-group pt-2">
                        <label for="inputoption_two">Option Two</label>
                        <input class="form-control @error('option_two') is-invalid @enderror" id="inputoption_two" type="text" placeholder="Enter Option Two" name="option_two" value="{{ old('option_two') }}">
                        @error('option_two')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-group pt-2">
                        <label for="inputoption_three">Option Three</label>
                        <input class="form-control @error('option_three') is-invalid @enderror" id="inputoption_three" type="text" placeholder="Enter Option three" name="option_three" value="{{ old('option_three') }}">
                        @error('option_three')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-group pt-2">
                        <label for="inputoption_four">Option Four</label>
                        <input class="form-control @error('option_four') is-invalid @enderror" id="inputoption_four" type="text" placeholder="Enter Option Four" name="option_four" value="{{ old('option_four') }}">
                        @error('option_four')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="form-group pt-2">
                        <label for="inputCurrectAns">Currect Answer</label>
                        <input class="form-control @error('currect_ans') is-invalid @enderror" id="inputCurrectAns" type="text" placeholder="Enter Currect Ans" name="currect_ans" value="{{ old('currect_ans') }}">
                        @error('currect_ans')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                      <div class="row pt-3">
                        <div class="col-sm-12">
                          <p class="text-right">
                            <button class="btn btn-primary" type="submit" id="people_add_form_btn">Add MCQ</button>
                          </p>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')
    
@endsection