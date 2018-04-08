<?php

namespace App\Http\Controllers;

use App\Core\ParamsValidator;
use App\Core\Responder;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        'description' => 'required|string',
        'website' => 'required|string',
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
        return view('welcome');
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
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $event = Event::first();
        return view('event')->with(['event' => $event]);
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
