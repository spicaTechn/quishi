@extends('front.layout.master')
@section('content')
<div class="profile-setup">
    <div class="container">
        <h3>Welcome John, please setup your profile.</h3>
        <form action="">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Tell us your education level</label>
                        <select class="form-control">
                            <option>Tell us your education level</option>
                            <option>Tell us your education level</option>
                            <option>Tell us your education level</option>
                            <option>Tell us your education level</option>
                            <option>Tell us your education level</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Choose your faculty</label>
                        <select class="form-control">
                            <option>Choose your faculty</option>
                            <option>Choose your faculty</option>
                            <option>Choose your faculty</option>
                            <option>Choose your faculty</option>
                            <option>Choose your faculty</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Choose you job title</label>
                        <select class="form-control">
                            <option>Choose you job title</option>
                            <option>Choose you job title</option>
                            <option>Choose you job title</option>
                            <option>Choose you job title</option>
                            <option>Choose you job title</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Job experience</label>
                        <select class="form-control">
                            <option>Job experience</option>
                            <option>Job experience</option>
                            <option>Job experience</option>
                            <option>Job experience</option>
                            <option>Job experience</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Choose your major</label>
                        <select class="form-control">
                            <option>Choose your major</option>
                            <option>Choose your major</option>
                            <option>Choose your major</option>
                            <option>Choose your major</option>
                            <option>Choose your major</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Choose your industry</label>
                        <select class="form-control">
                            <option>Choose your industry</option>
                            <option>Choose your industry</option>
                            <option>Choose your industry</option>
                            <option>Choose your industry</option>
                            <option>Choose your industry</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Salary range</label>
                        <select class="form-control">
                            <option>Salary range</option>
                            <option>Salary range</option>
                            <option>Salary range</option>
                            <option>Salary range</option>
                            <option>Salary range</option>
                        </select>
                    </div>

                </div>
            </div>
            <div class="form-group">
                <label>Enter your skill</label>
                <input class="input-tags form-control" type="text" data-role="tagsinput">
            </div>
            <div class="form-group">
                <label>Describe a little bit about you</label>
                <textarea class="form-control"></textarea>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-default"> Proceed and Continue</button>
            </div>
        </form>
    </div>
</div>
@endsection