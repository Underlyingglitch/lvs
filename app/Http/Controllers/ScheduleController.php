<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SomTodayiCalAccount;
use Sabre\VObject\Reader as Calendar;
use App\Models\AbsenceRequest;
use App\Models\SchoolYear;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        // return view('schedule.notready');
        abort_unless(in_array(auth()->user->get_role(), ['student', 'buddie']), 403);
        $user = auth()->user();
        
        // TODO: implement caching
        // NOTE: Current load times are acceptable

        if (!$user->somtoday_ical_account) {
            return view('schedule.setup');
        }

        $vcalendar = Calendar::read(
            file_get_contents($user->somtoday_ical_account->ical_url)
            // file_get_contents('data.txt')
        );

        $days = [];
        foreach (['monday', 'tuesday', 'wednesday', 'thursday', 'friday'] as $day) {
            $days[] = date('d-m-Y', strtotime($day.' next week'));
        }

        $courses = [];
        $events = [];
        foreach ($vcalendar->VEVENT as $event) {
            if (in_array(date('d-m-Y', strtotime($event->DTSTART)), $days)) {
                $summary = explode(' - ', $event->SUMMARY);
                if (count($summary) != 3) continue;

                $background = 'lightgrey';
                
                $courses[$summary[1]] = (isset($courses[$summary[1]]))?$courses[$summary[1]]+1:1;

                $events[date('d-m-Y', strtotime($event->DTSTART))][] = [
                    'details' => $event,
                    'vak' => $summary[1],
                    'location' => $summary[0],
                    'teacher' => $summary[2],
                    'background' => $background,
                ];
            }
        }
        foreach ($events as $day_key => $day) {
            foreach ($day as $key => $event) {
                if ($courses[$event['vak']] > 2) {
                    $button_class = 'btn-info';
                } else {
                   $button_class = 'btn-danger'; 
                }
                $absence_req = AbsenceRequest::where('uid', '=', $event['details']->UID)->first();
                if ($absence_req !== null) {
                    $button_class = 'btn-warning';
                    if ($absence_req->signed_by !== null) $button_class = 'btn-success';
                }
                
                $events[$day_key][$key]['button_class'] = $button_class;
                $events[$day_key][$key]['button_disabled'] = ($button_class != 'btn-info');
            }
        }

        ksort($events);

        return view('schedule.index', [
            'events' => $events
        ]);
        
    }

    public function post(Request $request)
    {
        //NOTE - Disabled functionality
        // return redirect()->back();

        $account = new SomTodayiCalAccount();

        $account->user_id = auth()->user()->id;
        $account->ical_url = $request->url;

        $account->save();

        // PullScheduleData::dispatch($account)->afterCommit();

        return redirect()->back();
    }

    public function request($timestamp, $vak, $uid, Request $request)
    {
        // TODO: Implement request
        // abort(501, 'Feature not implemented');
        abort_unless(in_array(auth()->user->get_role(), ['student', 'buddie']), 403);

        abort_unless($request->hasValidSignature(), 401);

        $absence_req = new AbsenceRequest();

        $absence_req->user_id = auth()->user()->id;
        $absence_req->datetime = $timestamp;
        $absence_req->vak = $vak;
        $absence_req->uid = $uid;
        $absence_req->school_year_id = SchoolYear::current();
        
        $absence_req->save();

        return redirect()->back();
    }
}
