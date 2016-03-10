<?php

namespace App\Http\Controllers;

use App\Author;
use App\Quote;
use App\Admin;
use Illuminate\Http\Request;
use App\Events\QuoteCreated;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Auth;
use App\QuoteLog;


class QuoteController extends Controller{ 

    public function getIndex($author = null) {
        
        if (!is_null($author)) {
            $quote_author = Author::where('name', $author)->first();
            if ($quote_author) {
                $quotes = $quote_author->quotes()->orderBy('created_at', 'dec')->paginate(6);
            }
        } else {
               
            $quotes = Quote::orderBy('created_at', 'dec')->paginate(6);
        }    
        return view('index', ['quotes' => $quotes]);
    }

    public function postQuote(Request $request) {
        
        $this->validate($request, [
            'author' => 'required|alpha|max:45',
            'quote' => 'required|max:200'
        ]);
        
     
        $authorText = ucfirst($request['author']);
        $quoteText = $request['quote'];
        $author = Author::where('name', $authorText)->first();

        if (!$author) {  
            $author = new Author();
            $author->name = $authorText;
            $author->save();       
        }             
        $user = $request->user();
        
        $quote = new Quote();
        $quote->quote = $quoteText;
        $author->quotes()->save($quote);
        $user->quotes()->save($quote);
    
        Event::fire(new QuoteCreated($author));
        
        return redirect()->route('index')->with([
            'success' => 'Quote saved!'
        ]);
    }  
    

    public function deleteQuote($quote_id) {
        
        if (!Auth::check()) {        
            $msg = "You are not authorized to delete this quote";
            return redirect()->route('login')->with(['fail'=> $msg]);
        }
        
        $userId = Auth::user()->id;
        $quote = Quote::find($quote_id);
        $quoteCreatorId = $quote->admin_id;
        
        if ($userId === $quoteCreatorId) {
            
            $author_deleted = false;      
            if (count($quote->author->quotes) === 1) {
               
                $quote->author->delete();
                $author_deleted = true;   
                $quote->delete();
                $msg = $author_deleted ? "Quote and Author Deleted" : "Quote deleted";
                return redirect()->route('dashboard')->with(['success'=> $msg]);
            } 
  
        } else {
            $msg = "You are not authorized to delete this quote";
            return redirect()->route('dashboard')->with(['fail' => $msg]);
        }      
    }
}
