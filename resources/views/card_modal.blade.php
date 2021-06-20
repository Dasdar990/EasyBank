<div class="modal-container">
    <div class="new-card-modal">
        <div class="title">
            <h1>Create new debit card</h1>
            <img id="close" src="images/icons/clear.svg" alt="clear">
        </div>
        <form>
            <input type="hidden" name="_token" value='{{ $csrf_token }}'>
            <div class="form-element">
                <h2>Available funds</h2>
                <div class="form-box">
                    <img class="form-icon" src="images/icons/funds.svg" alt="icon">
                    <span>{{$Balance}}</span>
                    <h3>EUR</h3>
                </div>
            </div>
            <div class="form-element">
                <h2>Add balance (Max 1500 EUR)</h2>
                <div class="form-box">
                    <img class="form-icon" src="images/icons/funds.svg" alt="icon">
                    <input name='Value' type="text" placeholder="Enter a value">
                    <h3>EUR</h3>
                </div>
            </div>
            <input type="submit" class='button' value="Request new card">
        </form>
    </div>
</div>