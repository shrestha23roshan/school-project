<?php

namespace Modules\Others\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Others\Repositories\Subscriber\SubscriberRepository;

class SubscribersController extends Controller
{
    private $subscriber;

    public function __construct(SubscriberRepository $subscriber)
    {
        $this->subscriber = $subscriber;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('others::Subscriber.index')
        ->withSubscribers($this->subscriber->all());
    }

}
