<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\User;
use App\TaxInformation;

class TaxInformationController extends Controller
{
    public function index(Request $request)
    {
        $userid = $request->user()->id;

        $taxInfoModel = new TaxInformation();

        $getTaxInfo = $taxInfoModel->usersTaxInfos($userid);
        // dd($getTaxInfo->toArray());
        return view ('taxinfos', $getTaxInfo->toArray());
        // dd($getTaxInfo);
        // if(empty($getTaxInfo))
        // {
        //     return view('taxinfos', [
        //         'status' => 'false',
        //         'info' => $getTaxInfo,
        //         'message' => 'Tax information not found'
        //     ]);
        // }

        // return view('taxinfos', [
        //     'status' => 'true',
        //     'info' => $getTaxInfo
        // ]);
    }

    public function store(Request $request)
    {

        $input = $request->all();

        $rules = array(
            'taxname' => 'required|string|min:1|max:32',
            'taxaddress' => 'required|string|min:1|max:65535'
        );

        $messages = array(
            'taxname.required' => 'You cant leave taxname field empty',
            'taxaddress.required' => 'You cant leave taxaddress field empty',
            'taxname.string' => 'The taxname should be a string',
            'taxaddress.string' => 'The taxaddress should be a string',
            'taxname.min' => 'the taxname field must have a minimum of 1 character',
            'taxaddress.min' => 'the taxaddress field must have a minimum of 1 character',
            'taxname.min' => 'the taxname field must have a maximum of 32 character',
            'taxaddress.min' => 'the taxaddress field must have a maximum of 65535 character'
        );

        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            $return['meta']['code'] = 400;
            $return['meta']['error_message'] = $validator->errors()->all()[0];

            return response()->json($return, 200);
        }

        $userid = $request->user()->id;

        $userModel = new User();

        $getUser = $userModel->getUser($userid);

        if (empty($getUser)) {
            // $return['meta']['code'] = 404;
            // $return['meta']['error_message'] = 'User not found';

            return redirect()->back()->with('error', 'User not found');

            // return response()->json($return, 200);
        }

        if ($getUser->taxinfo != null) {
            // $return['meta']['code'] = 404;
            // $return['meta']['error_message'] = 'Tax information already exist!';

            return redirect()->back()->with('error', 'Tax information already exist!');

            // return response()->json($return, 200);
        }

        $taxinfoDB['name'] = $input['taxname'];
        $taxinfoDB['address'] = $input['taxaddress'];
        $taxinfoDB['user_id'] = $userid;

        $newTaxinfo = TaxInformation::create($taxinfoDB);

        // $return['meta']['code'] = 200;
        // $return['meta']['error_message'] = 'Tax info created successfully';
        // return view('taxinfos', [
        //     'status' => 'true',
        //     'info' => $taxinfoDB
        //     ]);
        return redirect('/taxinfos')->with('success', 'Tax info created successfully');
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $userid = $request->user()->id;

        $rules = array(
            'taxname' => 'required|string|min:1|max:32',
            'taxaddress' => 'required|string|min:1|max:65535'
        );

        $messages = array(
            'taxname.required' => 'You cant leave taxname field empty',
            'taxaddress.required' => 'You cant leave taxaddress field empty',
            'taxname.string' => 'The taxname should be a string',
            'taxaddress.string' => 'The taxaddress should be a string',
            'taxname.min' => 'the taxname field must have a minimum of 1 character',
            'taxaddress.min' => 'the taxaddress field must have a minimum of 1 character',
            'taxname.min' => 'the taxname field must have a maximum of 32 character',
            'taxaddress.min' => 'the taxaddress field must have a maximum of 65535 character'
        );

        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            $return['meta']['code'] = 400;
            $return['meta']['error_message'] = $validator->errors()->all()[0];

            return response()->json($return, 200);
        }

        $taxinfoDB['name'] = $input['taxname'];
        $taxinfoDB['address'] = $input['taxaddress'];

        $update = TaxInformation::where('id',$id)->where('user_id',$userid)->update($taxinfoDB);

        return redirect('/taxinfos')->with('success', 'Tax info created successfully');
    }

    public function destroy($id)
    {
       $delete = TaxInformation::find($id);
       $delete->delete();
       return redirect('/home')->with('deleted','tax information deleted successfully');
    }
}
