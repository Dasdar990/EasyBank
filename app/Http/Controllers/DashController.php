<?php

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;



class DashController extends BaseController {
    
    public function checkAuth(){
        if (session('id') == null){
            return redirect('login')->with('csrf_token', csrf_token());
        }
        else 
            return view('dashboard')->with('csrf_token', csrf_token());;
    } 

    public function request_topbar(){
        if (session('id') == null){
            return redirect('login')->with('csrf_token', csrf_token());
        }
        else {
            $user = User::where('CF',Session::get('CF'))->first();
            $account = Account::find(Session::get('id'))->first();
            $view_data = [
                'name' =>    $user->Name,
                'surname' => $user->Surname,
                'src' => $user->Profile_Img
            ];
            return ['balance' => view('balance')->with('balance', number_format( $account->Balance, 0, '','.'))->render(),
                    'profile_info' => view('top_bar_info')->with($view_data)->render(),
                    'mobile_bar' => view('mobile_bar')->with($view_data)->render()
                    ];
        }
    }

    public function request_cc(){
        if (session('id') == null){
            return redirect('login')->with('csrf_token', csrf_token());
        } else {
            $cards = Card::where("Account_ID", Session::get('id'))
            ->join('card_types', 'cards.Card_ID', '=', 'card_types.ID')
            ->get();

            $response = [];
            foreach ($cards as $index=>$key){
                $view_data = [
                    'Number' => substr($key->Number, -4),
                    'Type' => $key->Type,
                    'Vendor' => $key->Vendor,
                    'Month' => $key->Month,
                    'Year' => $key->Year,
                    'Active' => $key->Favorite == 1 ? 'true' : 'false'
                ];
                $response[$index] = view('cc')->with($view_data)->render();
            }
            return $response;
        }   
    }

    public function requestCCInfo(){
        if (session('id') == null){
            return redirect('login')->with('csrf_token', csrf_token());
        } else {
            $response = [];
            $num = request('Number');
            $card = Card::where("Account_ID", Session::get('id'))->where('Number', 'LIKE', "%{$num}")->first();
            $info =  $card->card_types()->first();   
            
            $view_data = [
                'Active' => $card->Favorite == 1 ? 'false' : 'true',
                'Number' => substr($card->Number, -4),
                'Status' => $card->Status,
                'Balance' => $card->Balance,
                'Type' => $info->Type,
                'Daily_Max' => $info->Daily_Max,
                'Monthly_Max' => $info->Monthly_Max,
                'ActivationDate' => $card->ActivationDate
                ];
                $response = view('cc_info')->with($view_data)->render();
            
            return response()->json($response);
        }   
    }

    public function requestFilters(){    
        if (session('id') == null){
            return redirect('login')->with('csrf_token', csrf_token());
        } else {
            $cards = Card::where("Account_ID", Session::get('id'))->get();
            $response = [];

            foreach ($cards as $index=>$key){
                $view_data = [
                    'Number' => substr($key->Number, -4),
                    'Vendor' => $key->card_types()->first()->Vendor
                ];
               $response[$index] = view('filters_template')->with($view_data)->render();
            }
            return $response;
        }
    }

    public function request_transactions(){
        if (session('id') == null){
            return redirect('login')->with('csrf_token', csrf_token());
        } else {
            $response = [];
            $num = request('Number');
            $res = Card::where("Account_ID", Session::get('id'))->where('Number', 'LIKE', "%{$num}")->first();
            $transactions = Transaction::where('Number', $res->Number)->get();
            foreach($transactions as $index=>$key){
                $view_data = [
                    'Number' => substr($key->Number, -4),
                    'InOut' => $key->InOut,
                    'Agent' => $key->Agent,
                    'Type' => $key->Type,
                    'Amount' => $key->Amount,
                    'Date' => $key->Date
                ];
                $response[$index] = view('transaction_template')->with($view_data)->render();
            }
            return $response;
        }
    }
    public function requestAllTransactions(){
        if (session('id') == null){
            return redirect('login')->with('csrf_token', csrf_token());
        } else {
            $response = [];
            $cards = Card::where("Account_ID", Session::get('id'))->get();
            foreach($cards as $c){
            $transactions = Transaction::where('Number', $c->Number)->get();
                foreach($transactions as $key){
                    $view_data = [
                        'Number' => substr($key->Number, -4),
                        'InOut' => $key->InOut,
                        'Agent' => $key->Agent,
                        'Type' => $key->Type,
                        'Amount' => $key->Amount,
                        'Date' => $key->Date
                    ];
                    array_push($response, view('transaction_template')->with($view_data)->render());
                }
        }
            return $response;
        }
    }
    public function request_history(){
        if (session('id') == null){
            return redirect('login')->with('csrf_token', csrf_token());
        } else {
            $response = [];

            $history = History::where('Account_ID', Session::get('id'))->get();
            foreach ($history as $index=>$key){
                $view_data = [
                    'Month' => $key->Month,
                    'Year' => $key->Year,
                    'Balance' => number_format( $key->Balance, 0, '','.')
                ];
                $response[$index] = view('history')->with($view_data)->render();
            }
            return $response;
        }
    }

    public function requestLoanCC(){
        if (session('id') == null){
            return redirect('login')->with('csrf_token', csrf_token());
        } else {
            $response = [];
            $loans = Loan::where('Account_ID', Session::get('id'))->get();
            foreach ($loans as $index=>$key){
                $view_data = [
                    'Loan_ID' => $key->Loan_ID,
                    'Amount' => $key->Amount,
                    'Active' => $key->Favorite == 1 ? 'false' : 'true'
                ];
            $response[$index] = view('loan')->with($view_data)->render();
            }
        }
        return $response;
    }

    public function requestLoanInfo(){
        if (session('id') == null){
            return redirect('login')->with('csrf_token', csrf_token());
        } else {
            $response = [];
            $num = request('Number');
            $loan = Loan::where("Loan_ID", $num)->first();   
            $view_data = [
                'Loan_ID' => $loan->Loan_ID,
                'StartDate' => $loan->StartDate,
                'Amount' => $loan->Amount,
                'Tax' => $loan->Tax,
                'Returned' => $loan->Returned,
                'Total' => $loan->Total,
                'Fee' => $loan->Fee
                ];
                $response = view('loan_info')->with($view_data)->render();
            
            return response()->json($response);
        }   
    }

    public function requestSafeDepositInfo(){
        if (session('id') == null){
            return redirect('login')->with('csrf_token', csrf_token());
        } else {
            $response = [];
            $safe_boxes = SafeDepositBox::where('Account_ID', Session::get('id'))->get();
            foreach($safe_boxes as $index=>$key){
                $branch_info = $key->branches()->first();
                $view_data = [
                    'Address' => $branch_info->Address,
                    'City' => $branch_info->City,
                    'Sector' => $key->Sector,
                    'Level' => $key->Level,
                    'StartDate' => $key->StartDate,
                    'Fee' => $key->Fee
                ];
                $response[$index] = view('safe_deposit')->with($view_data)->render();
            }
            return $response;
        }
    }


    public function requestAccountData(){
        if (session('id') == null){
            return redirect('login')->with('csrf_token', csrf_token());
        } else {
            $user_info = User::where("CF", Session::get('CF'))->first();
            $subscription = $user_info->subscription()->first();
            $account = Account::where('Account_ID', Session::get('id'))->first();
            $view_data = [
                'Type' => $account->Type,
                'CF' => $user_info->CF,
                'Email' => $user_info->Email,
                'Name' => $user_info->Name,
                'Surname' => $user_info->Surname,
                'Phone' => $user_info->Phone,
                'Residence' => $user_info->Residence,
                'Dob' => $user_info->Dob,
                'StartDate' => $subscription->StartDate,
                'Fee' => $account->Fee                
            ];
            return response()->json(view('profile_info')->with($view_data)->render());
        }
    }

}