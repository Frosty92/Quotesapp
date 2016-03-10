<?php

namespace App\Http\Controllers;

use App\Author;
use App\Quote;
use Illuminate\Http\Request;
use App\Events\QuoteCreated;
use Illuminate\Support\Facades\Event;
use App\QuoteLog;
use DB;     


class GameController extends Controller{ 
    
    public function getGame() {
        
        $quotes = Quote::orderBy('created_at', 'dec')->paginate(50); 
        return view('game', ['quotes' => $quotes]);      
    }
    
    public function getNewGame(Request $request) {
        $request->session()->flush();
        return redirect()->route('game');      
    }
    
   
    public function postGame(Request $request) {
        
        $this->validate($request, [
            'author_name'=>'required|max:60|alpha'
        ]);
        $author = Author::find($request['author_id']);
        $authorName = $author->name;

        $isCorrect = strcasecmp( $request['author_name'], $authorName);
               
        if ($isCorrect === 0) {
            
            $feedbackMsg = "That's correct!";
            if (!$request->session()->has('score')) {
                 $request->session()->set('score', 1); 
          
            }  else {
                 
                 $score = $request->session()->get('score');        
                 $score = $score + 1;      
                 $request->session()->set('score', $score);           
            }                     
        } else {
            $feedbackMsg = "That's incorrect, The correct answer is: $authorName ";
                   
            if (!$request->session()->has('score')) {  
                $request->session()->set('score', 0); 
                
            }
        }
                          
        if (!$request->session()->has('index')) {
            $index = 1;  
            $isGameOver = 0;
            $request->session()->set('index', $index); 
        
        } else {
            
            $numRows = DB::table('quotes')->count();         
            $index = $request->session()->get('index');
        
            if ($index < ($numRows - 1)) {
                $index++;
                $isGameOver = 0;
            } else {
                $isGameOver = 1;
            }
        }
    
        $request->session()->set('isGameOver', $isGameOver);
        $request->session()->set('index', $index);
        
        
        return redirect()->route('game')->with([
            'feedbackMsg' => $feedbackMsg,
            'isGameOver' => $isGameOver
           ]);       
    }
}


        
        
        
        