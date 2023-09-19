<?php

namespace App\Http\Controllers\API\V1\Captains\Trip;

use App\Http\Controllers\Controller;
use App\Http\Requests\Captains\Trip\TripPropertiesRequest;
use App\Http\Resources\TripPropertiesResource;
use Illuminate\Support\Facades\Auth;
use  Kreait\Firebase\Database;
class TripController extends Controller
{
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function firebase(){
        $this->database->getReference('config/website')
            ->set([
                'name' => 'My Application',
                'emails' => [
                    'support' => 'support@domain.tld',
                    'sales' => 'sales@domain.tld',
                ],
                'website' => 'https://app.domain.tld',
            ]);

        $this->database->getReference('config/website/name')->set('New name');
        return "ok";
    }

    function properties(TripPropertiesRequest $request){
        try {
            $captain = Auth::user();
            if($request->toggle_available) $captain->update(['available'=>!$captain->available]);
            if($captain->available){
                $this->database->getReference('captains')
                    ->set([
                        'captain_id' => $captain->id,
                        'map_lat' => $request->map_lat,
                        'map_long' => $request->map_long,
                        'trip_id' => 0,
                    ]);

//                $this->database->getReference('captains')->set('New name');
            }else{  

            }
            $captain->tripProperties()->sync($request->selected_properties_ids);
            return $this->respondWithItem(new TripPropertiesResource($captain));
        } catch (\Throwable $th) {
            return $this->errorInternalError(th: $th);
        }
    }
}
