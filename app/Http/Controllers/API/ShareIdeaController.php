<?php
namespace App\Http\Controllers\API;
use App\Mail\AdminReplyMail;
use Illuminate\Http\Request;
use App\traits\ResponseJsonTrait;
use App\Models\{ShareIdea, Report};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ShareIdeaRequest;

class ShareIdeaController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->only(['index', 'show', 'destroy']);
    }
    public function index()
    {
        $ideas = ShareIdea::all();
        return $this->sendSuccess('Ideas Retrieved Successfully!', $ideas);
    }
    public function store(ShareIdeaRequest $request)
    {
        if (!Report::where('id', $request->report_id)->exists()) {
            return $this->sendError('The report ID is invalid or does not exist.', 404);
        }
        $idea = ShareIdea::create($request->validated());
        return $this->sendSuccess('Idea Added Successfully', $idea, 201);
    }
    public function show(string $id)
    {
        $idea = ShareIdea::with('report')->findOrFail($id);
        return $this->sendSuccess('Idea Retrieved Successfully!', $idea);
    }
    public function destroy($id)
    {
        $idea = ShareIdea::findOrFail($id);
        $idea->delete();
        return $this->sendSuccess('Idea Deleted Successfully');
    }
    public function reply(Request $request, $id)
    {
        $idea = ShareIdea::findOrFail($id);
        $request->validate([
            'reply' => 'required|string',
        ]);
        $idea->reply = $request->reply;
        $idea->save();
        Mail::to($idea->email)->send(new AdminReplyMail($idea));
        return $this->sendSuccess('Reply sent successfully!', $idea);
    }
}