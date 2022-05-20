    @csrf
    <dl class="lending_dl margin-bottom">
        <dt>
            会員ID
        </dt>
            <dd>    
                <input type="number" name="member_id" class="lending_inp" min="0">
            </dd>
        <dt>
            在庫ID
        </dt>
            <dd> 
                <input type="number" name="inventory_id" class="lending_inp" min="0">
            </dd>
        <dt>
            
            {{($_SERVER['REQUEST_URI'] == '/lendings/create') ? '貸出日' : '返却';}}
        </dt>
            <dd> 
                <input type="date" name="{{($_SERVER['REQUEST_URI'] == '/lendings/create') ? 'lent_date' : 'return_date';}}" value="{{date('Y-m-j')}}" class="lending_inp">
            </dd>
        <dt>
            備考
        </dt>
            <dd> 
                <input type="text" name="remarks" class="lending_inp">
            </dd>
    </dl>
    <button type="submit" class="button is-warning">入力確認画面へ</button>