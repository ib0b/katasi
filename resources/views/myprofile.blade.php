@php
$user = auth()->user();

@endphp
@extends('layouts.browser')
@section('content')

            <div class="card">
                <div class="card-header">My profile</div>

                <div class="card-body">
                <h3 class="card-title">Edit you details below</h3>	               
                  
                    <form class="form-horizontal" method="POST" action="/myprofile">
                        {{ csrf_field() }}
						<div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-9">
                                <input id="name" type="text" class="form-control" name="name" value="{{$user->name}}" required> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="mobile_number" class="col-md-4 control-label">Mobile Number</label>
                            <div class="col-9">
                                <input id="mobile_number" type="text" class="form-control" name="mobile_number" value="{{$user->mobile_number}}" required >
                                 <small class="form-text text-muted"></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="country" class="col-md-4 control-label">Country</label>
                            <div class="col-9">
                                <input id="country" type="text" class="form-control" name="country" value="{{$user->country}}"  >
                                 <small class="form-text text-muted"></small>
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label for="city" class="col-md-4 control-label">Enter City or Town</label>
                            <div class="col-9">
                                <input id="city" type="text" class="form-control" name="city" value="{{$user->city}}" >
                            </div>
                        </div>                      

                        <div class="form-group">
                            <div class="col-9 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        
@endsection