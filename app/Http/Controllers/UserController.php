<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); 
        $usersWithGroupNames = [];
        foreach ($users as $user) 
        {
            $groupNames = $user->groups()->pluck('label')->implode(', ');
            $usersWithGroupNames[$user->id] = $groupNames;
        }
        return view('users/index' ,compact('users','usersWithGroupNames'));
    }
    public function create()
    {
        $groups = Group::all();
        if(count($groups)>0)
        {
            return view('users.form',compact('groups'));
        }
        else
        {
            return redirect('/group')->withFailed('Please Create Group First');
        }
    }
    public function store(Request $request)
    {
        $rules = [
            'label'=>['required','string','max:255','min:3'],
            'mobile'=>'required|numeric|digits:10|regex:/^[6-9]{1}[0-9]{9}+$/',
            'groups'=>'required'
        ];

        $this->validate($request, $rules);

        try 
        {
            $data = [
                'label'=>$request->label,
                'mobile'=>$request->mobile,
            ];
            $user = User::create($data);
            $user->groups()->sync($request->groups);
            if($user)
            {
                return response()->json([
                    'status'=>1,
                    'msg'=>'User Succesfully added'
                ]);
            }
        }
        catch(Exception $e)
        {
            return redirect()->back()->withFailed('Exception:' . $e->getMessage());
        }
    }
    public function edit($id)
    {

        if($id)
        {
            $groups = Group::all();
            $user = User::whereId($id)->first();
            if($user)
            {
                return view('users.form', compact('user','groups'));
            }
             return redirect()->back()->withFailed('Group Not Found');
        }
        return redirect()->back()->withFailed('Group Not Found');
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'label'=>'required','string','max:255','min:3',
            'mobile'=>'required|numeric|digits:10|regex:/^[5-9]{1}[0-9]{9}+$/',
            'groups'=>'required'
        ];

        $this->validate($request, $rules);

        try
        {
            $user = User::where('id',$id)->first();
            if($user)
            {
                $user->label = $request->label;
                $user->mobile= $request->mobile;
                $groups = $request->input('groups', []);
                if($user->save())
                {
                    $user->groups()->sync($groups);
                    return response()->json([
                        'status'=>1,
                        'msg'=>'User Succesfully Updated'
                    ]);
                }
                return redirect()->back()->withFailed('User Not Updated');
            }
            return redirect()->back()->withFailed('User Not Found');

        }

        catch(Exception $e)
        {
            return redirect()->back()->withFailed('Exception:' . $e->getMessage());
        }
    }
    public function trash()
    {
        $users = User::onlyTrashed()->get();
        $usersWithGroupNames = [];
        foreach ($users as $user) 
        {
            $groupNames = $user->groups()->pluck('label')->implode(', ');
            $usersWithGroupNames[$user->id] = $groupNames;
        }
        $data = compact('users','usersWithGroupNames');
        return view('users.trashData')->with($data);
    }
    public function delete($id)
    {
        if($id)
        {
            $user = User::find($id);
            if($user)
            {
                $user->delete();
                return redirect()->back()->withSuccess('User Successfully Deleted');
            }
        }
    }
    public function restore($id)
    {
        if($id)
        {
            $user = User::with('group')->withTrashed()->find($id);
            if($user)
            {
                $user->restore();
                return redirect('/group')->withSuccess('User Successfully restore');
            }

        }
        return redirect()->back()->withFailed('Group Not Restore');
    }

}