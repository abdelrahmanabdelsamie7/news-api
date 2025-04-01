<?php
namespace App\Http\Controllers\API;
use App\Http\Requests\SubscriberRequest;
use App\Models\Subscriber;
use App\traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;

class SubscriberController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->only(['index', 'destroy']);
    }
    public function index()
    {
        $subscribers = Subscriber::all();
        return $this->sendSuccess('subscribers Emails Retrieved Successfully!', $subscribers);
    }

    public function store(SubscriberRequest $request)
    {
        $subscriber = Subscriber::firstOrCreate(
            ['email' => $request->email]
        );
        return $this->sendSuccess('subscriber Email Added Successfully', $subscriber, 201);
    }


    public function destroy($id)
    {
        $subscriber_email = Subscriber::findOrFail($id);
        $subscriber_email->delete();
        return $this->sendSuccess('subscriber Email Deleted Successfully');
    }
}