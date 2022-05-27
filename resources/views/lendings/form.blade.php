    @csrf
    <script>
        $(function() {
            $('#member_id').change( function( ) {
                var id=$(this).val();
                console.log(id);
    if(id!=""){
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
                    
            if(data[0]['id'] != ""){
                var member='会員ID　'+data[0]['member_id']+'会員名　'+data[0]['name']+'電話番号　'+ data[0]['tel'] ;
                if(!confirm('こちらの会員で間違いないでしょうか？\r\n'+member)){
                    /*　キャンセルの時の処理 */
                    return false;
                }else{
                    /*　OKの時の処理  */
                    
                    for (i=0;i<a_count; i++){
                        ch_box='<input type="checkbox" name="lend[]" value="'+data[i]['id']+'">';
                    li='<li class="inv_li">'+ch_box+' 資料名:'+data[i]['title']+ '貸出日'+data[i]['lent_date']+'貸出期限日'+data[i]['due_date']+'</li>';
                    $('#member').append(li);
                    }
                    
                }
            }
                console.log(data);
            }).fail(function(jqXHR, textStatus, errorThrown){
                alert("接続に失敗しました。");
                // 失敗したときのコールバック
            }).always(function() {
                // 成否に関わらず実行されるコールバック
            });
    }else{
        $('.inv_li').remove();
    }
            });
        });
    
    </script>
    <div class="info_dl">
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
    </div>
    <p class="member_name">会員名が表示されます。</p>
    <!--<select  id="member" size="5" multiple style="width:400px; height:300px">
        会員ID検索
    </select>-->
    <ul id="member">
        
    </ul>
    <input type="hidden" name="lend_or_rebook" value="{{($_SERVER['REQUEST_URI'] == '/lendings/create') ? "lend" : "rebook" }}">
    <button type="submit" class="button is-warning">入力確認画面へ</button>