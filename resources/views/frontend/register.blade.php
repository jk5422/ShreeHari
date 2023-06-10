@extends('frontend.layouts.main')

@section('main-container')
@if (session('ptreg'))
<div class="alert alert-danger fade in" id="alert">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error!</strong> {{session('ptreg')}}
</div>
{{Session::forget('ptreg');}}
@endif
<div class="container">
    <div class="row" id="loginform">
		<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Sign Up </h3>
			 	</div>
			  	<div class="panel-body">
			    	<form method="POST" action="register" role="form" >
                        @csrf
                    <fieldset>
			    	  	<div class="form-group">
			    		    <input class="form-control" placeholder="Your Full Name" name="pname" type="text">
			    		</div>
                        <div class="form-group">
			    		    <input class="form-control" placeholder="Your Mobile" name="pmobile" maxlength="10" type="tel">
			    		</div>
                        <div class="form-group">
			    		    <input class="form-control" placeholder="Your Email" name="pemail" type="email">
			    		</div>

                        <div class="form-group">
			    		    <input class="form-control" placeholder="Your Age" name="page" type="text">
			    		</div>

                        <div class="form-group">
			    		   <select name="pgen" class="form-control">
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                           </select>
			    		</div>

                        <div class="form-group">
			    		    <textarea class="form-control" name="paddress" cols="45" rows="2" placeholder="Your Address"></textarea>
			    		</div>

			    		<div class="form-group">
			    			<input class="form-control" placeholder="Password" name="ppass" type="password" id="password">
			    		</div>
                        <div class="form-group">
			    			<input class="form-control" type="password" placeholder="Confirm Password" name="cpassword" type="pcpass" id="cpassword">
			    		</div>
			    		<div class="checkbox">
			    	    	<label>
			    	    		<input  type="checkbox" onclick="newpass()"> Show Password
			    	    	</label>

			    	    </div>
			    		<input class="btn btn-lg btn-success btn-block" type="submit" value="SignUp">
			    	</fieldset>

                    <div class="form-group">
                        <label style="margin-top: 2rem;">
                            Already have an account ?
                            <a href="{{url('/login')}}">SignIn Here</a>
                        </label>
                    </div>

			      	</form>
			    </div>
			</div>
		</div>
	</div>
</div>
@endsection
