<?php

namespace App\Http\Controllers;

use App\Core\ParamsValidator;
use App\Core\Responder;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

/**
 * Class EventsController.
 *
 * @package App\Http\Controllers
 * @author Henry Harris <henry@104101110114121.com>
 */
class EventsController extends AbstractCrudController {

    /** @var Event $model */
    protected $model = Event::class;

    /** @var array $validation */
    protected $creationValidation = [
        'title' => 'required|string',
        'start' => 'required|date',
        'end' => 'required|date',
        'location' => 'required|string',
        'type' => 'required|string',
        'description' => 'string|nullable',
        'website' => 'string|nullable',
    ];

    /**
     * EventsController constructor.
     * 
     * @param Request $request
     * @param Responder $responder
     * @param ParamsValidator $validator
     */
    public function __construct(
        Request $request,
        Responder $responder,
        ParamsValidator $validator
    ) {
        parent::__construct($request, $responder, $validator);
        
        $this->middleware('auth', ['only' => ['create', 'createPost', 'delete']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $events = DB::table('events')->where('start', '>', now())->orderBy('start')->take(20)->get();
        return view('home')->with(['events' => $events]);
    }

    /**
     * @param $id
     * @return $this|Response
     */
    public function read($id) {
        $event = Event::find($id);
        if (!$event) {
            return $this->responder->notFoundResponse('Event not found');
        }
        return view('event')->with(['event' => $event]);
    }

    /**
     * Create an event
     *
     * @param null $additionalParams
     * 
     * @return \Illuminate\Http\Response
     */
    public function create($additionalParams = null) {
        $additionalParams = [];
        $user = $this->request->user();
        $additionalParams['user_id'] = $user->id;
        $additionalParams['organization_id'] = $user->organization->id;

        /** @var Response $result */
        $result = parent::create($additionalParams);

        if ($result->isSuccessful()) {
            $event = Event::find(
                json_decode($result->content(), true)['data']['id']
            );
            return view('event')->with(['event' => $event]);
        }

        return $result;
    }

    /**
     * Create an event
     *
     * @return \Illuminate\Http\Response
     */
    public function createPost() {
        $event = Event::first();
        return view('event')->with(['event' => $event]);
    }
}
