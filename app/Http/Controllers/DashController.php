<?php

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;



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
                'Balance' => number_format($card->Balance, 0, '','.'),
                'Type' => $info->Type,
                'Daily_Max' => $info->Daily_Max,
                'Monthly_Max' => $info->Monthly_Max,
                'ActivationDate' => $card->ActivationDate
                ];
                $response = view('cc_info')->with($view_data)->render();
            
            return response()->json($response);
        }   
    }

    public function setAsFavorite(){
        if (session('id') == null){
            return redirect('login')->with('csrf_token', csrf_token());
        } else {
            $num = request('Number');
            
            Card::where("Account_ID", Session::get('id'))
            ->where('Favorite', 1)
            ->update(['Favorite' => 0]);

            $newFav = Card::where("Account_ID", Session::get('id'))->where('Number', 'LIKE', "%{$num}")->first();
            Card::where('Number', $newFav->Number)->update(['Favorite' => 1]);
            return ['success' => view('loading')->render()];
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

    public function RequestNewCardModal(){
        if (session('id') == null){
            return redirect('login')->with('csrf_token', csrf_token());
        } else {
            $cards = Card::where("Account_ID", Session::get('id'))
            ->join('card_types', 'cards.Card_ID', '=', 'card_types.ID')
            ->get();
            $bancomat = $cards->where('Type', 'Bancomat')->first();
            return response()
                   ->json(view('card_modal')
                   ->with('Balance', $bancomat->Balance)
                   ->with('csrf_token', csrf_token())
                   ->render());
        }
    }

    public function AddNewCard(){
        if (session('id') == null){
            return redirect('login')->with('csrf_token', csrf_token());
        } else {

            //generate a new card
            function completed_number($ccnumber, $length) {
                # generate digits
                while ( strlen($ccnumber) < ($length - 1) ) {
                    $ccnumber .= rand(0,9);
                }
                # Calculate sum
                $sum = 0;
                $pos = 0;
                $reversedCCnumber = strrev( $ccnumber );
                while ( $pos < $length - 1 ) {
                    $odd = $reversedCCnumber[ $pos ] * 2;
                    if ( $odd > 9 ) {
                        $odd -= 9;
                    }
                    $sum += $odd;
                    if ( $pos != ($length - 2) ) {
                        $sum += $reversedCCnumber[ $pos +1 ];
                    }
                    $pos += 2;
                }
                # Calculate check digit
                $checkdigit = (( floor($sum/10) + 1) * 10 - $sum) % 10;
                $ccnumber .= $checkdigit;
                return $ccnumber;
            }

            //check if user is pro, if not check that it has less than 3 debit cards
            $cards = Card::where("Account_ID", Session::get('id'))
                ->join('card_types', 'cards.Card_ID', '=', 'card_types.ID')
                ->get();
            if (Account::where('Account_ID', Session::get('id'))->first()->Type !== 'Pro'){
                if (count($cards->where('Type', 'Debit')) > 3)
                return ['error' => view('error')->with('error_text', 'User has already three cards')->render()];
            }
            //generate and store the new card
            $bancomat_num = $cards->where('Type', 'Bancomat')->first()->Number;
            $bancomat_balance = $cards->where('Type', 'Bancomat')->first()->Balance;
            $val = request('Value');

            if ($val > $bancomat_balance || $val > 1500)
            return ['error' => view('error')->with('error_text', 'Insert a valid value!')->render()];
            else {
                do {
                    $f = true;
                    $cc = completed_number('400311', 16);
                    if (Card::where('Number', $cc)->first() === null) $f = false;
                } while ($f);

                $month = sprintf("%02d", rand(01, 12));
                $year = rand(23, 26);
                $cvv = sprintf("%03d", rand(001, 999));
                $pin = sprintf("%04d", rand(0001, 9999));
                $today = date("Y-m-d");

                //insert new card into db
                $new_card = Card::create([
                    'Status' => 'Active',
                    'Number' => $cc,
                    'Month' => $month,
                    'Year' => $year,
                    'CVV' => $cvv,
                    'PIN' => $pin,
                    'Balance' => $val,
                    'Payment_Date' => NULL,
                    'Card_ID' => 4,
                    'Account_ID' => Session::get('id'),
                    'ActivationDate' => $today,
                    'Favorite' => 0,
                ]);


                //update bancomat balance
                Card::where("Number", $bancomat_num)->update(['Balance' => $bancomat_balance - $val]);

                $view_data = [
                    'Number'=> $cc,
                    'Month'=> $month,
                    'Year'=> $year,
                    'CVV'=> $cvv,
                    'Pin'=> $pin,
                ];
                return response()->json(view('cc_success')->with($view_data)->render());
            }
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



    public function RequestExchangeRates(){
        if (session('id') == null){
            return redirect('login')->with('csrf_token', csrf_token());
        } else {
            $response = Http::get('https://api.coinbase.com/v2/exchange-rates?currency=EUR');
            if ($response->failed()) abort(500);
            $response = $response->json()['data']['rates'];
            $data['EUR'] = array('USD' => round($response['USD'],3) , 'GBP' => round( $response['GBP'],3));

            $response = Http::get('https://api.coinbase.com/v2/exchange-rates?currency=USD');
            if ($response->failed()) abort(500);
            $response = $response->json()['data']['rates'];
            $data['USD'] = array('GBP' => round($response['GBP'],3) , 'JPY' => round( $response['JPY'],3));
            
            $response = [];
            foreach ($data as $index=>$i){
                foreach ($i as $index1 => $j){
                    $view_data = [
                        'base' => $index,
                        'curr' => $index1,
                        'value' => $j,
                    ];
                    array_push($response, view('exchangeRates')->with($view_data)->render());
                }
            }
            return $response;
                
        }
    }

    public function RequestStock(){
        if (session('id') == null){
            return redirect('login')->with('csrf_token', csrf_token());
        } else {
            $symbols = ['AAPL', 'MSFT','NKE', 'SBUX'];
            $response = array();
            foreach($symbols as $sym){
                $res = Http::get("https://cloud.iexapis.com/stable/stock/".$sym."/quote", [
                    'token' => env('STOCK_API_KEY')
                ])->json();
                
                $view_data = [
                    'favorite' => $sym === 'AAPL' ? 'true' : 'false',
                    'name' => $res['companyName'],
                    'symbol' => $res['symbol'],
                    'price' => $res['latestPrice'],
                    'trend' => $res['change'] > 0 ? 'up' : 'down',
                    'change' => $res['change'],
                    'changePercent' => $res['changePercent'] * 100,
                    'high' => $res['high'],
                    'low' => $res['low'],
                    'pe' => $res['peRatio'],
                    'week52High' => $res['week52High'],
                    'week52Low' => $res['week52Low'],
                    'volume' => $res['volume'],
                    'cap' => ''
                ];
                $response[$sym] = array(
                    'card' => view('stock_card')->with($view_data)->render(),
                    'info' => view('stock_info')->with($view_data)->render(),
                );
            }
            return $response;
        }
    }

    public function requestLoading(){
        if (session('id') == null){
            return redirect('login')->with('csrf_token', csrf_token());
        } else {
            return response()->json(view('loading')->render());
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