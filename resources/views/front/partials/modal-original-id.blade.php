<div id="modal-original-id">
    <div id="modal-original-id-box">
        <div class="modal-original-id-box-header">
            <p class="modal-original-id-box-header-ttl">オリジナルID検索</p>
            <a id="modal-original-id-box-close"></a>
        </div>
        <div class="modal-original-id-box-body">
            <form action="{{ route('front.services.index') }}" method="get">
                <input type="text" name="orig_id" placeholder="ID入力" required>
                <button type="submit">検索</button>
            </form>
        </div>
    </div>
</div>