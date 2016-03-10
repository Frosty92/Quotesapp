@extends('layout.master')

@section('title')
    Trending Quotes
@endsection

@section('styles')
<link rel="stylesheet" href="{{URL::asset('src/css/styles.css')}}">
@endsection


@section('nav')
    @extends('layout.nav')
@endsection

@section('content')

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
        @if(Session::has('success'))
          <div class="container">
              <div class="row">
                  <div class="alert alert-success col-md-6 col-md-offset-3">    
                      {{Session::get('success')}}                 
                  </div>
              </div>
           </div>  
    @endif

@if(!Auth::check())

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 col-xs-12">
            <h3 class="text-center">Do you have a profound quote to share?</h3>
            <h4 class="text-center">Login/Signup and get started</a></h4>
        </div>
    </div>
</div>

@endif
        
    <section class="quotes">
        <div class="container">
            <div class="row">  
        @for($i=0; $i < count($quotes); $i++)
                                                                           
            <article class="quote col-md-3 col-xs-12">
               <h5>" {{$quotes[$i]->quote}} " - <a href="{{route('index', ['name' => $quotes[$i]->author->name])}}"> {{ $quotes[$i]->author->name}}</a></h5> 

                <h5>Added by {{$quotes[$i]->admin->username}}</h5>
            </article>  
    
        @endfor             
            </div>
        </div> <!-- end container -->
         
      <div class="container">
          <div class="row">
              <div class="col-md-6 col-md-offset-3">
                   <div class="pagination text-center">           
                       @if($quotes->currentPage() !== 1) 
                                 <h3 class="text-center"> <a href="{{ $quotes->previousPageUrl() }}">  Previous | </a> </h3>      
                        @endif

                        @if($quotes->currentPage() != $quotes->lastPage() && $quotes->hasPages()) 
                          <h3 class="text-center"> <a href="{{ $quotes->nextPageUrl() }}">  Next  </a> </h3>
                        @endif
                  </div>
              
              </div>
          </div>
</div>
     
   
</section>

<section class="guess-quotes">
    <div class="container">
        <div class="row">
            <h2 class="text-center">Who said what? Guess the author of the quote <span> <a href="{{route('game') }}"> <button class="btn btn-success">here</button></a> </span></h2>  
        </div>
    </div>
</section>

   


@if(Auth::check())
<section class="add-quote">
    <h1 class="text-center">Add a quote</h1>
    <form role="form" method="post" action="{{ route('create') }}">

        <div class="form-group row">
            <div class="col-md-6 col-md-offset-3">
                    <label for="author">Last name of Author</label>
            <input type="text" name="author" class="form-control " placeholder="your name" />
            </div>
        
        </div>
        

        </div>
    
        <div class="form-group row">
            <div class="col-md-6 col-md-offset-3">
            <label for="quote">The profound quote</label>
            <textarea name="quote" class="form-control" rows="5" placeholder="your quote"></textarea>
        </div>
        </div>
        
        <div class="form-group row">  
             <div class="col-md-2 col-md-offset-3">      
                 <button type="submit" class="form-control btn btn-success" class="btn">Submit quote</button>
            </div>
        </div>
             
        <input type="hidden" name="_token" value="{{Session::token()}}">
    </form>
</section>
@endif


@endsection

