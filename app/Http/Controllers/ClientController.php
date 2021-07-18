<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use App\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{

    public function __construct()
    {
        $isadmin = Auth::user()->user_is_system_admin;

        if($isadmin == 1)
        {
            $this->middleware(['auth', 'isSystemAdmin']);
        }else{
            $this->middleware(['auth', 'routeClearance']);
        }
    }

    public function index(){
        $page_breadcrumbs = [
            'main_module' =>  [   
                'title' => 'Jobs',
                'page' => '#',
            ],
            'sub_module' =>  [   
                'title' => 'Clients',
                'page' => '#',
            ],
        ];

        $page_title = 'Register Client';
        $page_description = 'Register a Client';

        return view('pages.clients.register_client', compact('page_title','page_breadcrumbs',));
    }

    public function viewClientForEdit($clientId){
        $client = Client::find($clientId);
        $page_breadcrumbs = [
            'main_module' =>  [   
                'title' => 'Jobs',
                'page' => '#',
            ],
            'sub_module' =>  [   
                'title' => 'Clients',
                'page' => '#',
            ],
        ];

        $page_title = 'Edit Client';

        return view('pages.clients.edit_client', compact('page_title','page_breadcrumbs','client'));
    }
    
    public function viewClientList(){
        $page_breadcrumbs = [
            'main_module' =>  [   
                'title' => 'Jobs',
                'page' => '#',
            ],
            'sub_module' =>  [   
                'title' => 'Clients',
                'page' => '#',
            ],
        ];

        $page_title       = 'Client List';
        $page_description = 'Information of all the Clients';

        return view('pages.clients.client_list', compact('page_title','page_breadcrumbs',));
    }

    public function registerClient(Request $request){
        try{
            $client = new Client;
            $this->storeClientDetails($request,$client);
            $client->client_status = 1;
            $client->client_created_by = auth()->user()->id;
            $client->client_updated_by = auth()->user()->id;
            $client->save();
           
            $clientRegistration = [
                'msg' =>  'Client Registered Successfully',
                'title' => 'Client Registration',
                'status' =>  1,
            ];

            $request->session()->flash('clientRegistration', $clientRegistration);
        }catch(Exception $e){
            $clientRegistration = [
                'msg' =>  'Client Registration is unsuccessful',
                'title' => 'Client Registration',
                'status' =>  0,
            ];

            $request->session()->flash('clientRegistration', $clientRegistration);
        }
        return redirect()->route('clientRegisterView');
    }

    public function editClient(Request $request, $clientId){
        try{
            $client = Client::find($clientId);
            $this->storeClientDetails($request,$client);
            $client->client_status = 1;
            $client->client_updated_by = auth()->user()->id;
            $client->save();
           
            $clientEdit = [
                'msg' =>  'Client Details edited successfully',
                'title' => 'Update Client Details',
                'status' =>  1,
            ];

            $request->session()->flash('clientEdit', $clientEdit);

        }catch(Exception $e){
            $clientEdit = [
                'msg' =>  'Client Details update is unsuccessful',
                'title' => 'Update Client Details',
                'status' =>  0,
            ];

            $request->session()->flash('clientEdit', $clientEdit); 
        }
        return redirect()->route('clientEditView', $clientId);
    }

    public function deleteClient(Request $request){
        try{
            $clientId = $request->clientId;
            $client   = Client::find($clientId);
            $client->client_status     = 0;
            $client->client_updated_by = auth()->user()->id;
            $client->save();

            $clientDelete = [
                'msg' =>  'Client permenantly deleted from system',
                'title' => 'Client Deletion',
                'status' =>  true,
            ];

            return $clientDelete;

        }catch(Exception $e){
            $clientDelete = [
                'msg' =>  'Client deletion is unsuccessful',
                'title' => 'Client Deletion',
                'status' =>  false,
            ];

            return $clientDelete;
        }
    }

    public function fetchClientsToDrawTbl(){
        $userType = request()->session()->get('userType');
        if($userType == 'SYSTEM-ADMIN'){
            $clients = Client::all();
        }
        else{
            $clients = Client::where('client_status',1)->get();
        }
        $data = array();
        
        foreach($clients as $client){
            $d = array();
            $d['clientDetails'] = array(
                'name'  => $client->client_fname.' '.$client->client_lname,
                'nic'   => $client->client_nic,
            );
            $d['contactDetails'] = array(
                'telephone' => $client->client_contact,
                'email'   => $client->client_email,
            );
            $d['createdDetails'] =  array(
                'createdAt'=> $client->client_created_at,
                'createdBy'=> User::getUsername($client->client_created_by),
            );
            $d['lastModifiesDetails'] =  array(
                'updatedAt'=> $client->client_updated_at,
                'updatedBy'=> User::getUsername($client->client_updated_by),
            );
            $d['status'] = $client->client_status;
            $d['clientId'] = $client->client_id;
            array_push($data, $d);
        }

        $result = array(
			'data' => $data
		);

        return $result;
    }

    private function storeClientDetails(Request $request, $client){
        $client->client_title   = $request->client_title_select;
        $client->client_fname   = Str::upper($request->client_fname);
        $client->client_lname   = Str::upper($request->client_lname);
        $client->client_nic     = Str::upper($request->client_nic);
        $client->client_contact = $request->client_telephone;
        $client->client_address = Str::upper($request->client_address);
        $client->client_email   = Str::lower($request->client_email);
    }
}
