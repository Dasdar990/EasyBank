<div class="stock-card" data-link={{$symbol}} data-active={{$favorite}}>
    <div class="stock-title">
        <h2>{{$name}} ({{$symbol}})</h2>
        <h3>{{$price}}</h3>
    </div>
    <div class="value" data-trend = {{$trend}}>
        <span>{{$change}} ({{$changePercent}} %)</span>
        <img src="images/icons/trending_{{$trend}}.svg" alt="Trending icon">
    </div>
</div>