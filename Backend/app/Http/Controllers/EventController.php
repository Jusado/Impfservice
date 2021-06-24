<?php

namespace App\Http\Controllers;

use App\Models\Location;
use http\Exception\InvalidArgumentException;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Database\Eloquent;
use Illuminate\Support\Facades\DB;
use App\Models\Event;
use App\Models\User;
//use App\Event;
use Auth;
use App\Image;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index() {
        $events = Event::with(['location', 'images', 'user']) ->get();
        return $events;
    }

    public function getLocations(){
        return response()->json(Location::all(),201);
    }

    public function checkID(id $id) {
    $event = Event::where('id', $id)->first();
    return $event !=null ? response()->json(true, 200) : response()->json(false, 200);
    }


    // URL: ./api/Event/GetById/{eventId}
    // GET
    // Parameter: eventId
    // Infos zu Impftermin für admin (impftermin,impfort,angemeldete personen)
    public function findByID($id) {
        $event = Event::with(['user','location'])->where('id', $id)->first();
        return $event !=null ? $event : response()->json(false, 404);
    }

    // URL: ./api/Event/enumerationFreeDates
    // GET
    // Parameter: keine
    // Auflistung von freien Terminen
    public function enumerationFreeDates(){
        return Event::with(['location'])->where("appointment",">=",Carbon::today())->whereColumn('people','>','current_amount')->get();
    }


    public function enumeration(){
        return Event::with(['location'])->get();
    }

    // URL: ./api/Event/register/{eventId}
    // POST
    // Parameter: eventId
    // Impfung buchen für einen normalen Benutzer
    public function bookEvent($id) {
        $userId = Auth::user()->id();
        $event = Event::where('id',$id)->first();
        if($event->current_amount > $event->people)
            return response()->json("Dieser Termin ist nicht mehr frei.",401);
        $user = User::where("id",$userId)->first();
        if(!$user->vaccinationAllowed)
            return response()->json("Sie können keine Impfung buchen.",402);
        $event->current_amount++;
        $event->save();
        $user->vaccinationAllowed = false;
        $user->save();
        $user->event()->associate($user)->save();
    }

    // URL: ./api/Event/GetUserInfo
    // GET
    // Parameter: keine
    // Infos zum ang. impftermin für normalen benutzer (impfort,impftermin)
    public function getInfo(){
        $userId = Auth::user()->id();
        $user = User::with(['event','event.location'])->where('id',$userId)->first();
        return response()->json($user,201);
    }

    // URL: ./api/Event/create
    // POST
    // Parameter: body Impftermin als JSON
    // {
    //    bezeichnung:"....",
    //    impfdatum:"..."
    // }
    // Impfterm anlegen für admin

    public function save(Request $request) : JsonResponse  {
      //  $request = $this->parseRequest($request);
        /*+
        *  use a transaction for saving model including relations
        * if one query fails, complete SQL statements will be rolled back
        */
       // DB::beginTransaction();
        try {
            /*
            $event= Event::create($request->all());
            $locationId = $request['locationId'];
            $location = Location::where('id',$locationId)->first();

            if($location == null){
                return response()->json($event,402);
            }*/

            // Achtung nun bei Änderungen von Spalten und Tabellennamen
            DB::table('events')->insert([
                'appointment' => $request['appointment'],
                'location_id' => $request['locationId'],
                'people' => $request['people']
            ]);
           // DB::commit();

            // Diese Zeile funktioniert nicht
            // $event->location()->associate($location)->save();
            // DB::commit();



            // return a vaild http response
            return response()->json([], 201);
        }
        catch (\Exception $e) {
            // rollback all queries
         //   DB::rollBack();
            return response()->json("saving event failed: ".$request . $e->getMessage(), 420);
        }
    }

    // URL: ./api/Event/update
    // PUT
    // Parameter: body
    // Impftermin bearbeiten für admin
    public function update(Request $request, $id) : JsonResponse
    {
        DB::beginTransaction();
        try {
            /*
            $event = Event::with(['location'])
                ->where('id', $id)->first();
            if ($event != null) {
                $event->update($request->all());

                $location = Location::where('id',$request["location_id"])->first();
                $event->location()->associate($location);
                $event->save();
            }
            DB::commit();*/

            $event = Event::findOrFail($id);
            if($event == null)
                return response()->json([],404);
            $event->update([
                'appointment' => $request['appointment'],
                'people' => $request['people'],
                'location_id' => $request['locationId']
            ]);

            DB::commit();
            $event1 = Event::with(['location'])
                ->where('id', $id)->first();
            // return a vaild http response
            return response()->json($event1, 201);
        }
        catch (\Exception $e) {
            // rollback all queries
            DB::rollBack();
            return response()->json("updating event failed: " . $e->getMessage(), 420);
        }
    }


    // URL: ./api/Event/delete/{eventId}
    // DELETE
    // Parameter: eventId
    // Impftermin löschen für admin
    public function delete(string $id) : JsonResponse
    {
        $event = Event::where('id', $id)->first();
        if ($event != null) {
            $event->delete();
        }
        else
            throw new \Exception("event couldn't be deleted - it does not exist");
        return response()->json('event (' . $id . ') successfully deleted', 200);
    }

    // URL: ./api/Event/confirmUserEvent/{userId}
    // PUT
    // Parameter: userId
    // Impfung bestätigen für admin
    public function setUserVac($id){
        $user = User::where('id',$id)->first();
        $user->isVaccinated = true;
        $user->save();
    }
}
