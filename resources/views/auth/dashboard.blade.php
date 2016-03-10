@extends('layout.master');

@section('nav')
    @extends('layout.nav')
@endsection

@section('content')

@if(Session::has('success'))
          <div class="container">
              <div class="row">
                  <div class="alert alert-success col-md-6 col-md-offset-3">    
                      {{Session::get('success')}}                 
                  </div>
              </div>
           </div>  
    @endif

@if(Session::has('fail'))
          <div class="container">
              <div class="row">
                  <div class="alert alert-danger col-md-6 col-md-offset-3">    
                      {{Session::get('fail')}}                 
                  </div>
              </div>
           </div>  
    @endif

<div class="container">
    <div class="row">
        <div class="jumbotron col-xs-12">          
            <h4 class="text-center">Welcome to your dashboard, {{Auth::user()->name}}</h4>          
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <h3 class="text-center">Here are the quotes you have created: </h3>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Quote</th>
                            <th>Author</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                       @for($i = 0; $i < count($quotes); $i++)
                    <tbody>
                     
                        <td class="col-md-7">"{{$quotes[$i]->quote}}"</td>
                        <td class="col-md-3">{{$quotes[$i]->author->name}}</td>
                        <td> <a href="{{ route('delete', ['quoteId' => $quotes[$i]->id]) }}">delete</a></td>
                      
                    </tbody>
                  @endfor
                </table>
            </div>
        </div>
    </div>
</div>


@endsection