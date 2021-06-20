<div data-active = "{{$favorite}}" data-stock='{{$symbol}}'>
    <div class="stock-title">
        <h1>{{$name}} ({{$symbol}})</h1>
        <div class="stock-title-value">
            <h3>{{$price}}</h3>
            <h3 data-trend = {{$trend}}>{{$change}}</h3>
        </div>
    </div>
    <div class="chart-container">
        <div class="chart">
            <img src="images/big_chart.svg" alt="Chart">
        </div>
        <div class="stock-info">
            <div class="info">
                <h2>Max</h2>
                <h3>{{$high}}</h3>
            </div>
            <div class="info">
                <h2>Min</h2>
                <h3>{{$low}}</h3>
            </div>
            <div class="info">
                <h2>Min 52W</h2>
                <h3>{{$week52Low}}</h3>
            </div>
            <div class="info">
                <h2>Max 52W</h2>
                <h3>{{$week52High}}</h3>
            </div>
            <div class="info">
                <h2>P/E<h2>
                <h3>{{$pe}}</h3>
            </div>
            <div class="info">
                <h2>Volume</h2>
                <h3>{{$volume}}</h3>
            </div>
            <div class="info">
                <h2>Cap.</h2>
                <h3>{{$cap}}</h3>
            </div>
        </div>
    </div>
</div>