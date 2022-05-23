    @csrf
    <script>
        $(function() {
            $('#member_id').change( function( ) {
                var id=$(this).val();
                console.log(id);
                $.ajax({
                        headers: {
                                // POSTのときはトークンの記述がないと"419 (unknown status)"になるので注意
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                            // POSTだけではなく、GETのメソッドも呼び出せる
                            type:'get',
                            // ルーティングで設定したURL
                            url:'add/' + id, // 引数も渡せる
                            dataType: 'json',
                            data:{id:id},
                        }).done(function (data,status,xhr){
                            var a_count=data.length;
                            var li="";
                            var ch_box='';
                           
                            for (i=0;i<a_count; i++){
                                ch_box='<input type="checkbox" name="lend[]" value="'+data[i]['id']+'">';
                             li='<li>'+ch_box+' 資料名:'+data[i]['title']+ '貸出日'+data[i]['lent_date']+'貸出期限日'+data[i]['due_date']+'</li>';
                            $('#member').append(li);
                            }
                            console.log(data);
                        }).fail(function(jqXHR, textStatus, errorThrown){
                            alert("sippai");
                            // 失敗したときのコールバック
                        }).always(function() {
                            // 成否に関わらず実行されるコールバック
                        });
            });
        });
    
    </script>
    <dl class="lending_dl margin-bottom">
        <dt>
            会員ID
        </dt>
            <dd>    
                <input type="number" name="member_id" id="member_id" min="0">
            </dd>
        <dt>
            在庫
        </dt>
            <dd> 
                <input type="number" name="inventory_id" id="inventory_id" min="0">
            </dd>
        <dt>
            
            {{($_SERVER['REQUEST_URI'] == '/lendings/create') ? '貸出日' : '返却';}}
        </dt>
            <dd> 
                <input type="date" 
                name="{{($_SERVER['REQUEST_URI'] == '/lendings/create') ? 'lent_date' : 'return_date';}}" 
                value="{{date('Y-m-j')}}" 
                class="lending_inp">
            </dd>
        <dt>
            備考
        </dt>
            <dd> 
                <input type="text" name="remarks" class="lending_inp">
            </dd>
    </dl>
    <p class="member_name">会員名が表示されます。</p>
    <!--<select  id="member" size="5" multiple style="width:400px; height:300px">
        会員ID検索
    </select>-->
    <ul id="member">
        
    </ul>
    <button type="submit" class="button is-warning">入力確認画面へ</button>