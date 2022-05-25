    @csrf
    <script>
        $(function() {
            var old_id="";
            $('.member_search').click( function( ) {
                var id=$('#member_id').val();
                
                console.log('id:'+id);
                console.log('old_id:'+old_id);
                if(old_id ==id){
                    alert('同じ会員IDです')
                    return false;
                }
                
    
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
            var m_name=""; 
            
            if(data!="" && data[0]['id'] != ""){
                var member='会員ID'+data[0]['member_id']+'　会員名'+data[0]['name']+'　電話番号　'+ data[0]['tel'] ;
                if(!confirm('こちらの会員で間違えないでしょうか？\r\n'+member)){
                    /*　キャンセルの時の処理 */
                    return false;
                }else{
                    /*　OKの時の処理  */
                    m_name= $('.member_name').text(data[0]['name']+'　様の貸出情報\n');
                    
                    for (i=0;i<a_count; i++){
                        ch_box='<input type="checkbox" class="chk_lend" name="lend[]" value="'+data[i]['id']+'">';
                    li='<li class="inv_li">'+ch_box+' 資料名:'+data[i]['title'];
                        li+='貸出日'+data[i]['lent_date']+'貸出期限日'+data[i]['due_date']+'</li>';

                    
                    $('#member').append(li);
                    }
                    var num=$('.arr_num').text('現在'+i+'冊借りています');
                }
            }else{
                alert('この会員は本を借りていません')
            }
                
            }).fail(function(jqXHR, textStatus, errorThrown){
                alert("接続に失敗しました。");
                // 失敗したときのコールバック
            }).always(function() {
                // 成否に関わらず実行されるコールバック
            });
    
        if(old_id != id){
            $('.inv_li').remove();
            $('.member_name').text('');
            $('.arr_num').text('');
        }
    
             old_id=id;
            });

            $('.form_btn').click(function() {
                var test =$('.chk_lend');
                if(!test.prop("checked")){
                    alert('返却を行う資料を選択してください。')
                    return false;
                }
                
            });
        });
    
    </script>
    <dl class="lending_dl margin-bottom">
        <dt>
            会員ID
        </dt>
            <dd>    
                <input type="number" name="member_id" id="member_id" min="0">
                <button class="member_search button is-primary member_button" type="button">検索</button>
            </dd>
            @if($_SERVER['REQUEST_URI'] != '/lendings/rebook')
        <dt>
            在庫
        </dt>
            <dd> 
                <input type="number" name="inventory_id" id="inventory_id" min="0">
            </dd>
            @endif
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
    <h2 class="member_name"></h2>
    <p class="arr_num"></p>
    <!--<select  id="member" size="5" multiple style="width:400px; height:300px">
        会員ID検索
    </select>-->
    <ul id="member">
        
    </ul>

    <button type="submit" class="button is-warning margin-top">入力確認画面へ</button>