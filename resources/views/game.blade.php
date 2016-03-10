@extends('layout.master')

@section('title')
    Game
@endsection

@section('nav')
    @extends('layout.nav')
@endsection

@section('content')

              
<div class="container">
    <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
            <h1 class="text-center">Who said it?</h1>
            <h2 class="text-center">Rules:</h2>
            <ul>
                <li>Write the <b>Last</b> name of the person.</li>
                <li>You may use uppercase or lowercase letters.</li>            
            </ul>
        </div>
    </div>
</div>

@if(count($errors) > 0)
<div class="container">
    <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
            <div class="alert alert-danger" role="alert">
                @foreach($errors->all() as $error)
                {{$error}}
                @endforeach
                
            </div>
        </div>
    </div>
</div>

@endif

@if(!Session::has('isGameOver'))
    {{Session::set('isGameOver', 0)}}
@endif


@if(Session::get('isGameOver') == 0)  
<div class="container">
        <div class="row">      
         <div class="col-xs-6 col-xs-offset-3"> 
             <h2 class="text-center">Who said this famous quote? </h2>
             <h3 class="text-center">" {{$quotes[+Session::get('index')]->quote}} " </h3>
        </div>          
    </div>
</div>
@endif
 
    
@if(Session::get('isGameOver') == 1)     
<div class="container">
    <div class="row">      
         <div class="col-xs-6 col-xs-offset-3">
             <div class="jumbotron">
                 <h1 class="text-center">Game Over!</h1>
                 <h2 class="text-center"><a href="{{route('newgame')}}">play again</a> </h2>          
             </div>
        </div>
    </div>      
</div> 
@endif

  
@if(Session::get('isGameOver') == 0)  
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-xs-12">
           <form role="role" method="post" action="{{route('game')}}">
              
               <div class="form-group">
                   <input type="text" class="form-control" name="author_name">
               </div>     
               <div class="form-group">
                    <button class="btn-success col-xs-6 col-xs-offset-3" name="submit" >Submit</button> 
               </div>               
               <input type="hidden" name="_token" value="{{Session::token()}}">        
               <input type="hidden" name="author_id" value="{{$quotes[+Session::get('index')]->author_id}}"> 
               
            </form>     
        </div>
    </div>       
</div>
   
@endif

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-xs-12">
           @if(Session::has('feedbackMsg'))
                <div class="alert alert-info">
                <h3 class="text-center">{{Session::get('feedbackMsg')}}</h3>
               </div>             
           @endif           
        </div>
    </div>
</div>             

<div class="container">
    <div class="row">   
        <div class="text-center row">
            @if(Session::has('score'))
                <div class="jumbotron"><h2>Score: {{Session::get('score')}}</h2></div>
            @endif
           
        </div>
    </div>       
</div>   
    
    
@endsection
