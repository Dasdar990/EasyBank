
<div class="cc" data-active="{{$Active}}" data-number="{{$Number}}">
    <img class="pattern" src="@switch($Type)
        @case('Debit')
            {{$src='images/pattern3.png'}}
            @break
        @case('Credit')
           {{$src='images/pattern2.png'}}
            @break
        @case('Bancomat')
           {{$src='images/pattern1.png'}}
            @break
        @endswitch" alt="Pattern">
    <div class="overlay "></div>
    <div class="row ">
        <img src="images/icons/logo_card.svg " alt="Bank Logo ">
        <img src="images/icons/{{$Vendor}}.svg " alt="Vendor Logo ">
    </div>
    <div class="row number "><span class="asterisk ">**** </span><span class="asterisk ">**** </span>****  {{$Number}}</span>
    </div>
    <div class="row date ">{{$Month}}/{{$Year}}</div>
    <div class="row type ">{{$Type}}</div>
</div>