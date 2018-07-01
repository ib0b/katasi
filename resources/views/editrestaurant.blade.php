@extends('layouts.browser')
@section('content')

            <div class="card">
                <div class="card-header">Edit your restaurant</div>

                <div class="card-body">
                <h3 class="card-title">Make changes below.</h3>    
                    <form class="form-horizontal" method="POST" action="/restaurant/{{$restaurant->id}}/edit" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-9">
                                
                                <input id="name" type="text" class="form-control" name="name" value="{{$restaurant->name}}" required autofocus>
                                <small class="form-text text-muted">Example : Bob's Grill</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="seat_capacity" class="col-md-4 control-label">Seat Capacity</label>
                            <div class="col-9">
                                <input id="seat_capacity" type="number" class="form-control" name="seat_capacity" value="{{$restaurant->seat_capacity}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-md-4 control-label">Description</label>
                            <div class="col-9">
                                <textarea id="description" rows="10" class="form-control" name="description" required >{{$restaurant->description}}</textarea>
                                 <small class="form-text text-muted">Brief description of your restaurant</small>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="location" class="col-md-4 control-label">Location</label>
                            <div class="col-9">
                                <input id="location" type="text" class="form-control" name="location" value="{{$restaurant->location}}" required>
                                <small class="form-text text-muted">Example : Galleria Mall.</small>
                            </div>
                        </div>                       
                        <div class="form-group">
                            <label for="images" class="col-md-4 control-label">Images</label>
                            <div class="col-9">
                                <input type="file" id="images"  name="images[]" class=" btn btn-primary" multiple="true">
                                
                                <small class="form-text text-muted">Upload pictures of your Restaurant</small>
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