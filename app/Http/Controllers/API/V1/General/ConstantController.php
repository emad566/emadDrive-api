<?php

namespace App\Http\Controllers\API\V1\General;

use App\Models\Bank;
use App\Models\AppInfo;
use App\Models\Country;
use App\Models\Property;
use App\Models\AppSetting;
use App\Services\TripCost;
use App\Services\GoogleMap;
use App\Models\CancelReason;
use App\Models\TicketReason;
use App\Models\VehicleClass;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use App\Models\HealthCondition;
use App\Models\PassengerWallet;
use App\Models\LiveChatQuestion;
use App\Models\BankCardPassenger;
use App\Models\OfferSubscription;
use App\Models\CaptainVehicle;
use App\Http\Controllers\Controller;
use App\Http\Requests\Passengers\Trip\VehiclesClassesRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\FamilyPassengerWallet;
use App\Models\BusinessPassengerWallet;
use App\Http\Resources\Generals\AppInfo\AppInfoCollection;
use App\Http\Resources\Generals\Constants\Banks\BankCollection;
use App\Http\Resources\Generals\Constants\Vehicles\MakeTripResource;
use App\Http\Resources\Generals\TicketReasons\TicketReasonCollection;
use App\Http\Resources\Generals\Constants\Countries\CountryCollection;
use App\Http\Resources\Generals\Constants\LiveChats\LiveChatCollection;
use App\Http\Resources\Generals\Constants\Vehicles\VehicleSettingTinyResource;
use App\Http\Resources\Generals\Constants\CancelReasons\CancelReasonsCollection;
use App\Http\Resources\Generals\Constants\TripProperties\TripPropertyCollection;

use App\Http\Resources\Generals\Constants\PaymentMethods\PaymentMethodCollection;
use App\Http\Resources\Generals\Constants\HealthConditions\HealthConditionCollection;
use App\Models\DashboardNotification;

class ConstantController extends Controller
{

    public $tripCost;
    public $googleMap;

    const LARGE_NUMBER_OF_PAGINATE = 12;
    const TINY_NUMBER_OF_PAGINATE = 8;

    const CAPTAINS = 'captains';
    const PASSENGERS = 'passengers';

    const CAPTAIN = 'Captain';
    const PASSENGER = 'Passenger';

    const CAPTAIN_APP = 'captain_NOTIFICATION';
    const PASSENGER_APP = 'passenger_NOTIFICATION';

    const CAPTAIN_MODEL = 'App\Models\Captain';
    const PASSENGER_MODEL = 'App\Models\Passenger';

    const SCHEDULE_TRIP = 'schedule-trip';
    const NORMAL_TRIP = 'normal-trip';

    const RADIUS = 2.0; // KM
    const ITERATION = 30;  // seconds

    const REGISTER_STEP_ONE = 1;
    const REGISTER_STEP_TWO = 2;
    const REGISTER_STEP_THREE = 3;

    const AVAILABLE = '2';
    const REJECTED = '1';
    const PENDING = '0';


    const TRIP_PENDING = 'pending';
    const ACCEPTED_TRIP = "accepted-trip";
    const TRIP_CANCEL_BEFORE_CAPTAIN_ACCEPET = 'cancel-before-captain-accept';
    const TIME_OUT_BEFORE_ACCEPT='time-out-before-accept';
    const TRIP_WAIT_NEW_CAPTAIN = 'wait-new-captain';
    const TRIP_WAIT_APPROVE = 'wait-approve';
    const TRIP_APPROVE = 'approve';
    const TRIP_ARRIVED = 'arrived';
    const TRIP_CANCEL_PASSENGER = 'cancel-passenger';
    const TRIP_CANCEL_CAPTAIN = 'cancel-captain';
    const TRIP_END = 'end';
    const TRIP_END_WITH_PAYMENT = 'end-with-payment';

    const MEMBER_AVAILABLE = 'available';
    const MEMBER_REJECTED = 'rejected';
    const MEMBER_PENDING = 'pending';


    const REJECT_REASON = 4;
    const MISSING_FILES = 3;

    #Payment Method
    const CASH = 'Cash';
    const WALLET = 'Wallet';

    # Trip Status Firebase
    const STATUS_PENDING = "pending";
    const STATUS_ACCEPTED = "accepted";
    const STATUS_ON_WAY = "on_the_way";
    const STATUS_ARRIVED = "arrived";
    const STATUS_START_TRIP = "start_trip";
    const STATUS_PAY = "pay";
    const STATUS_PAID = "paid";
    const STATUS_REJECT_PAYMENT = "reject_payment";
    const STATUS_CANCELED = "canceled";
    const STATUS_END_WITH_PAYMENT = 'end-with-payment';

    const NATIONAL_ID_FRONT = "national-id-front";
    const NATIONAL_ID_BACK = "national-id-back";
    const VEHICLE_LICENSE_FRONT = "vehicle-license-front";
    const VEHICLE_LICENSE_BACK = "vehicle-license-back";
    const VEHCICLE_IMAGES = ['front seat', 'back seat', 'left side', 'right side', 'back side', 'front side'];
    const STATUS_SUCCESS = "success";

    # Type
    const NEW_CAR = 'new_car';
    const CAPTAIN_ARRIVED = 'captain_arrived';
    const TRIP_CANCEL = 'trip_cancel';
    const TRIP_COST = 'trip_cost';
    const NEW_TRIP = 'new_trip';
    const VERIFICATION_CODE = 'verification_code';
    const PROFILE = 'profile';
    const EMAIL = 'email';
    const CHECk = 'check';
    const ACCEPT_LANGUAGE = 'Accept-Language';
    const SUCCESS = 'success';
    const MESSAGE = 'message';
    const TOKEN_PASSENGER = 'Token-Passenger';
    const TOKEN_CAPTAIN = 'Token-Captain';


    //Options
    const COLORS = ['Red','Orange','Yellow','Green','Blue','Purple','Pink','White','Gray','Brown','Black'];
    const BRANDS = ['BMW','Daewoo','Ford','Holden','Honda','Hyundai','Isuzu','Kia','Lexus','Mazda','Mitsubishi','Nissan','MG','Peugeot','Subaru','Suzuki','Toyota','Volkswagen'];
    const YEARS = ['2021','2020','2019','2018','2017','2016','2015','2014','2013','2012','2011','2010','2009','2008','2007','2006','2005'];
    const GENDER = ['mail', 'female'];
    const CAPTAIN_STATUS = ['active','underReview','registration',];
}
