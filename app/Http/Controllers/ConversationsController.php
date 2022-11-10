<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\ConversationPreparation;

class ConversationsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        if ($request->user()->can('viewAny')) {
            $conversations = Conversation::all();
        } else {
            $conversations = auth()->user()->organized_conversations
                        ->merge(auth()->user()->invited_conversations)
                        ->all();
        }

        return view('conversations.index', [
            'conversations' => $conversations
        ]);
    }

    public function create()
    {
        $this->authorize('create', Conversation::class);

        $users = User::all()->where('id', '!=', auth()->user()->id);

        return view('conversations.create', [
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Conversation::class);

        $conversation = new Conversation();
        $conversation->conversation_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i', $request->date.' '.$request->time);
        $conversation->organizer_id = auth()->user()->id;
        $conversation->location = $request->location;
        $conversation->save();

        $invitees = User::find($request->invitees);
        $conversation->invitees()->attach($invitees);

        return redirect()->route('conversations.index')->with('success', 'Gesprek succesvol aangemaakt');
    }

    public function prepare(Conversation $conversation, Request $request)
    {
        $this->authorize('create', [ConversationPreparation::class, $conversation]);
        
        $preparation = ConversationPreparation::where([['user_id', auth()->user()->id],['conversation_id', $conversation->id]])->first();
        if (!$preparation) {
            $preparation = new ConversationPreparation();
            $preparation->user_id = auth()->user()->id;
            $preparation->conversation_id = $conversation->id;
        }
        $preparation->content = $request->preparation;
        $preparation->save();

        return redirect()->back()->with('success', 'Succesvol opgeslagen');
    }

    public function addinvitees(Conversation $conversation, Request $request)
    {
        $this->authorize('update', $conversation);

        $invitees = User::find($request->invitees);
        $conversation->invitees()->attach($invitees);

        return redirect()->back()->with('success', 'Gebruiker(s) toegevoegd');
    }

    public function removeinvitee(Conversation $conversation, Request $request)
    {
        $this->authorize('update', $conversation);

        $conversation->invitees()->detach(array_flip($request->all())['Verwijder']);

        return redirect()->back()->with('success', 'Gebruiker verwijderd');
    }

    public function show(Conversation $conversation)
    {
        $this->authorize('view', $conversation);

        $users = User::all()->where('id', '!=', auth()->user()->id)->whereNotIn('id', $conversation->invitees->pluck('id'));

        return view('conversations.show', [
            'conversation' => $conversation,
            'users' => $users
        ]);
    }

    public function update(Request $request, Conversation $conversation)
    {
        $this->authorize('update', $conversation);

        $conversation->report = $request->report;
        $conversation->save();

        return redirect()->back()->with('success', 'Gesprek afgerond!');
    }
}
