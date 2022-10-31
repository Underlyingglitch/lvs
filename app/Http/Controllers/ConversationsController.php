<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Conversation;
use Illuminate\Http\Request;
use App\Models\ConversationPreparation;

class ConversationsController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth']);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // TODO - Implement authentication
        $conversations = auth()->user()->organized_conversations
                        ->merge(auth()->user()->invited_conversations)
                        ->all();

        return view('conversations.index', [
            'conversations' => $conversations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // TODO - implement authentication

        $users = User::all()->where('id', '!=', auth()->user()->id);

        return view('conversations.create', [
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TODO - implement authentication
        $conversation = new Conversation();
        $conversation->conversation_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i', $request->date.' '.$request->time);
        $conversation->organizer_id = auth()->user()->id;
        $conversation->save();

        $invitees = User::find($request->invitees);
        $conversation->invitees()->attach($invitees);

        return redirect()->route('conversations.index')->with('success', 'Gesprek succesvol aangemaakt');
    }

    public function prepare($id, Request $request)
    {
        // TODO - implement authentication
        $preparation = ConversationPreparation::where([['user_id', auth()->user()->id],['conversation_id', $id]])->first();
        if (!$preparation) {
            $preparation = new ConversationPreparation();
            $preparation->user_id = auth()->user()->id;
            $preparation->conversation_id = $id;
        }
        $preparation->content = $request->preparation;
        $preparation->save();

        return redirect()->back()->with('success', 'Succesvol opgeslagen');
    }

    public function addinvitees($id, Request $request)
    {
        $conversation = Conversation::find($id);
        
        $invitees = User::find($request->invitees);
        $conversation->invitees()->attach($invitees);

        return redirect()->back()->with('success', 'Gebruiker(s) toegevoegd');
    }

    public function removeinvitee($id, Request $request)
    {
        $conversation = Conversation::find($id);
        
        $conversation->invitees()->detach(array_flip($request->all())['Verwijder']);

        return redirect()->back()->with('success', 'Gebruiker verwijderd');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // TODO - implement authentication

        $conversation = Conversation::find($id);

        $users = User::all()->where('id', '!=', auth()->user()->id)->whereNotIn('id', $conversation->invitees->pluck('id'));

        return view('conversations.show', [
            'conversation' => $conversation,
            'users' => $users
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // TODO - implement authentication

        $conversation = Conversation::find($id);
        $conversation->report = $request->report;
        $conversation->save();

        return redirect()->back()->with('success', 'Gesprek afgerond!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
