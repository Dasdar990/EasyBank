<div class="activity-row" data-close = "true" data-active="true" data-number={{$Number}}>
    <div class="transaction-header">
        <div class="transaction-agent">
            <img src="images/icons/money-{{$InOut}}.svg" alt="Money">
            <div class="transaction-info">
                <h1 class="agent">{{$Agent}}</h1>
                <h3>{{$Type}}</h3>
            </div>
        </div>
        <div class="value">
            <span class="{{$InOut}}-value">{{$Amount}}</span>
            <span><strong>EUR</strong></span>
            <img id="expand" src="images/icons/expand_more.svg" alt="expand">
        </div>
    </div>
    <div class="transaction-details">
        <div class="details-row">
            <h2>Date</h2>
            <h3>{{$Date}}</h3>
        </div>
        <div class="details-row card">
            <h2>Card</h2>
            <h3>**** {{$Number}}</h3>
        </div>
        <div class="details-row">
            <h2>Amount</h2>
            <h3 class="{{$InOut}}-value">{{$Amount}} <strong>EUR</strong></h3>
        </div>
    </div>
</div>