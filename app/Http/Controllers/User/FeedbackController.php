<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Feedback;
use App\Models\FeedbackComment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;


class FeedbackController extends Controller
{
    /* 
    * Feedback List page
    */
    public function feedBackList()
    {
        $feedbackData = Feedback::select('id','title','description','category_id','user_id')
            ->with(['userData'=>function($query){
                $query->select('id','name');
            }])
            ->with('categoryDate')
            ->paginate(10);
        $data['feedbackData'] = $feedbackData;
        return Inertia::render('Feedback/FeedbackList',$data); 
    }
    
    /* 
    * Feedback Create page
    */

    public function createFeedback(Request $request)
    {
        $categoryData = Category::select('id','name')->get();
        $data['categoryData'] = $categoryData;
        return Inertia::render('Feedback/FeedbackCreate',$data); 
    }

    /* 
    * Feedback Submit
    */
    public function submitFeedback(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required',
        ]);
        $data = [
            'title'=>$request->title,
            'description'=>$request->description,
            'category_id'=>$request->category_id,
            'user_id'=> Auth::user()->id,
            'created_at'=>Date('y-m-d H:i:s'),
            'updated_at'=>Date('y-m-d H:i:s'),
        ];
        
        try{
            DB::beginTransaction();
            Feedback::create($data);
            \DB::commit();
            return redirect()->route('feed.back');
        }catch(Exception $e){
            \DB::rollBack();
            return $e->getMessage();
        }
    }

    /* 
    * Feedback Comment Page
    */
    public function feedbackComment(Request $request)
    {
        $request->validate([
            'feedback_id' => 'required',
        ]);

        $feedbackData = Feedback::where('id',$request->feedback_id)
        ->with('userData')
        ->first();
        if($feedbackData)
        {
            $userRecords = User::select('id','name')->get();
            $feedbackCommentsData = FeedbackComment::where('feedback_id',$request->feedback_id)
            ->with(['userData'=>function($query){
                $query->select('id','name');
            }])
            ->orderBy('id','desc')
            ->get();
            $data['feedbackData'] = $feedbackData;
            $data['userRecords'] = $userRecords;
            $data['feedbackCommentsData'] = $feedbackCommentsData;
            return Inertia::render('Feedback/AddComments',$data);
        }else{
            return redirect()->route('feed.back');
        }
    }

    /* 
    * Feedback Comment Store Into Database
    */
    public function submitFeedbackComment(Request $request)
    {
        $request->validate([
            'feedback_id' => 'required',
            'comment' => 'required',
        ]);
        $requestData = $request->only('feedback_id','comment');
        $requestData['user_id'] = Auth::user()->id;
        FeedbackComment::create($requestData);
        return redirect()->back();
    }
}
