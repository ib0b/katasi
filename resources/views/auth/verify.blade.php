@extends('layouts.browser')
@section('content')

       

          <div class="card mt-4">
            <div class="card-header">Account Verification</div>
            <div class="card-body">
              <h3 class="card-title">Please verify your account.</h3>
              
              <p class="card-text">Check your email :<b>{{auth()->user()->email}}</b> for account verification link.</p>
              <p>If you haven't received the email resend : to resend the email to you.<hr>
				<a href="/email/resend" class="btn btn-lg btn-outline-info">Resend</a>
              </p>
              
            </div>
          </div>
          <!-- /.card -->

          
          

        
@endsection