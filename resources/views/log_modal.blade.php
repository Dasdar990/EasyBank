<div class="modal-container">
    <div class="new-card-modal">
        <div class="title">
            <h1>Access Logs</h1>
            <img id="close" src="images/icons/clear.svg" alt="clear">
        </div>
        @foreach ($logs as $log)
        <div class="form-row">
            <div class="form-element">
                <h2>Date and Time</h2>
                <div class="form-box">
                    <span>{{$log->created_at}}</span>
                </div>
            </div>
            <div class="form-element">
                <h2>IP Address</h2>
                <div class="form-box">
                    <span>{{$log->ip}}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>