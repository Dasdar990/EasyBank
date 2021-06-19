<div data-active='true' data-number='{{$Number}}'>
    <div class="info-row" >
        <span>Status</span>
        <span>{{$Status}}</span>
    </div>
    <div class="info-row" >
        <span>Type</span>
        <span>{{$Type}}</span>
    </div>
    <div class="info-row" data-type="{{$Type}}">
        <span>Balance</span>
        <span>{{$Balance}} EUR</span>
    </div>
    <div class="info-row">
        <span>Daily limit</span>
        <span>{{$Daily_Max}} EUR</span>
    </div>
    <div class="info-row">
        <span>Monthly limit</span>
        <span>{{$Monthly_Max}} EUR</span>
    </div>
    <div class="info-row">
        <span>Activation date</span>
        <span>{{$ActivationDate}}</span>
    </div>
    <div class='button' data-num={{$Number}} data-active="{{$Active}}">Set as favorite</div>
</div>