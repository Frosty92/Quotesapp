  
@extends('layout.master')

@section('content')
   
@if(count($errors) > 0)

<section class="alert alert-danger">
    @foreach($errors->all() as $error)
    {{$error}}
    @endforeach
</section> 
@endif
 
@if(Session::has('fail'))

<section class="alert alert-danger">
    {{Session::get('fail')}}
</section>
@endif


<div class="container">
    <div class="row">
        <div class="col-xs-6 col-xs-offset-3 jumbotron">
            <h2 class="text-center">Login</h2>
        </div>
    </div>
</div>

<div class="container">	
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="{{route('login')}}" class="btn btn-info col-md-12" >Login</a>
                        </div>
                        <div class="col-xs-6">
                            <a href="{{route('register')}}" class="btn btn-success col-md-12">Register</a>
                        </div>
                    </div>
                    <hr>
                </div>
                
                <div class="panel-body">
						<div class="row">
							<div class="col-lg-12"> 
                                <form method="post" action="{{route('login')}}" role="form">
									<div class="form-group">
										<input type="text" name="username" tabindex="1" class="form-control" placeholder="username" required>
									</div>
									<div class="form-group">
										<input type="password" name="password" tabindex="2" class="form-control" placeholder="Password" required>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="submit"  tabindex="4" class="form-control btn btn-primary" value="Log In">
											</div>
										</div>
									</div>
                                    <input type="hidden" name="_token" value="{{Session::token()}}">
								</form>		<!-- end of login form -->				
							</div>
						</div>
					</div> <!-- end of panel body -->
				</div>
			</div>
		</div>
	</div> <!-- end of container -->

@endsection