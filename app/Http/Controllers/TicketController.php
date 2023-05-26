<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Notifications\TicketUpdatedNotification;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::latest()->get();
    
        return view('ticket.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ticket.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTicketRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTicketRequest $request)
    { 

        $ticket = Ticket::create([
            
            'title' => $request->title,
            'description' => $request->description,
            
        ]);

        if( $request->file('image'))
        {
            $this->storeImage( $request, $ticket );

        }

        return response()->redirectTo(route('ticket.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
    
        return view('ticket.show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        return view('ticket.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTicketRequest  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTicketRequest $request, Ticket $ticket)
    {
       // $ticket->update($request-> validated());
       if($request->has('status'))
       {
            $user = User::find($ticket->id);
            return (new TicketUpdatedNotification($ticket))->toMail($user);    
       }
      
       $ticket->update($request->except('image'));

        if( $request->file( 'image' ) )
        {
            Storage::disk( 'public' )->delete( '$ticket->image' );

            $this->storeImage( $request, $ticket );
           

        }

        return redirect(route('ticket.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        //dd($ticket);
        $ticket->delete();
        return redirect( route( 'ticket.index' ) );
    }

    protected function storeImage ( $request, $ticket )
    {
        $ext = $request->file('image')->extension();
        $content = file_get_contents($request->file('image'));
        $filename = Str::random(25);
        $path = "image/$filename.$ext";
        Storage::disk('public')->put($path, $content);
        $ticket->update( [ 'image' => $path ] );
    }
}
