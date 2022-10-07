<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SomTodayiCalAccount;
use Sabre\VObject\Reader as Calendar;
use App\Jobs\PullScheduleData;

class ScheduleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        // return view('schedule.notready');
        $this->authorize('schedule.view');
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
                $button_class = ($courses[$event['vak']] > 2)?'btn-info':'btn-danger';

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
        $account = new SomTodayiCalAccount();

        $account->user_id = auth()->user()->id;
        $account->ical_url = $request->url;

        $account->save();

        // PullScheduleData::dispatch($account)->afterCommit();

        return redirect()->back();
    }

    public function request($timestamp, $vak)
    {
        // TODO: Implement request
        abort(501, 'Feature not implemented');
    }
}
