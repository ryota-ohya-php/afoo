    @csrf
    <script>
        $(function() {
            var old_id="";
            
            var load_page=$('#member_id').val();
           


            $(document).ready(function(){
                var load_page=$('#member_id').val();
                if(load_page!=""){
                $.ajax({
        headers: {
                // POSTのときはトークンの記述がないと"419 (unknown status)"になるので注意
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            // POSTだけではなく、GETのメソッドも呼び出せる
            type:'get',
            // ルーティングで設定したURL
            url:'add/' + load_page, // 引数も渡せる
            dataType: 'json',
            data:{load_page:load_page},
            
        }).done(function (data,status,xhr){
            var a_count=data.length;
            
            var ch_box='';
            var m_name=""; 
            
           
            if(data!="" && data[0]['id'] != ""){
                var member='会員ID'+data[0]['member_id']+'　会員名'+data[0]['name']+'　電話番号　'+ data[0]['tel'] ;
                if(!confirm('こちらの会員で間違いないでしょうか？\r\n'+member)){
                    /*　キャンセルの時の処理 */
                    return false;
                }else{
                    /*　OKの時の処理  */
                    console.log(data);
                    $('.hid_table').css('display','table');
                    var mnm='<span class="f_bold">'+data[0]['name']+'</span>　様の貸出情報\n';
                    m_name= $('.member_name').append(mnm);
                    
        for (i=0;i<a_count; i++){
            var inp_hid='<input type="hidden" name="inventory_id" value='+data[i]['inventory_id']+'>'
                ch_box='<label><input type="checkbox" class="chk_lend" name="lend[]" value="'+data[i]['id']+'"></label>';
                    var td_in='<tr class="inv_li"><td>'+ch_box+inp_hid+'</td><td>'+data[i]['title']+'</td><td>'+data[i]['lent_date']+'</td><td>'+data[i]['due_date']+'</td></tr>';
        $('.table_in').append(td_in);
        }
                    var con='現在<span class="f_bold">'+i+'</span>冊借りています';
                    var num=$('.arr_num').append(con);
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
        }
            });

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
            
            var ch_box='';
            var m_name=""; 
            
            console.log(data);
            if(data!="" && data[0]['id'] != ""){
                var member='会員ID'+data[0]['member_id']+'　会員名'+data[0]['name']+'　電話番号　'+ data[0]['tel'] ;
                if(!confirm('こちらの会員で間違いないでしょうか？\r\n'+member)){
                    /*　キャンセルの時の処理 */
                    return false;
                }else{
                    /*　OKの時の処理  */
                    console.log(data);
                    $('.hid_table').css('display','table');
                    var mnm='<span class="f_bold">'+data[0]['name']+'</span>　様の貸出情報\n';
                    m_name= $('.member_name').append(mnm);
                    
        for (i=0;i<a_count; i++){
            var inp_hid='<input type="hidden" name="inventory_id" value='+data[i]['inventory_id']+'>'
                ch_box='<label><input type="checkbox" class="chk_lend" name="lend[]" value="'+data[i]['id']+'"></label>';
                    var td_in='<tr class="inv_li"><td>'+ch_box+inp_hid+'</td><td>'+data[i]['title']+'</td><td>'+data[i]['lent_date']+'</td><td>'+data[i]['due_date']+'</td></tr>';
        $('.table_in').append(td_in);
        }
                    var con='現在<span class="f_bold">'+i+'</span>冊借りています';
                    var num=$('.arr_num').append(con);
                }
            }else{
                $('.hid_table').css('display','none');
                
                alert('この会員は本を借りていません');
                
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

            $('.submit_return').click( function nosubmit() {
            var lend_check = $('.inv_li input:checkbox:checked').length;
            if (lend_check == 0) {
                alert('本が選択されていません')
                return false;
            }
        });

            $('.test').on('click', function() {
                if ($(this).prop('checked')) {
                allCheck('.chk_lend');
                } else {
                allRemove('.chk_lend');
                }
            });

            function allCheck(value) {
                $(value).prop('checked', true);
                
            }
            function allRemove(value) {
                $(value).prop('checked', false);
                
            }
 });
    
    </script>
    <div class="info_dl">

        <dl class="lending_dl margin-bottom">
            <dt>
                会員ID
            </dt>
                <dd>    

                    <input type="number" name="member_id" id="member_id" min="0" class="lending_inp" style="width: 130px;
                    " value="{{(isset($mem)? $mem: '')}}">
                    <button class="member_search button is-primary member_button" type="button"
                    style="height: 30px;">検索</button>
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

    <p class="member_name"></p>
    <p class="arr_num margin-top"></p>
    <!--<select  id="member" size="5" multiple style="width:400px; height:300px">
        会員ID検索
    </select>-->
    <table class="table_center hid_table">
        <thead>
            <tr>
                <th><input type="checkbox" class="test"></th>
                <th style=width:50%>資料名</th>
                <th>貸出日</th>
                <th>貸出期限日</th>
            </tr>
        </thead>
        <tbody class="table_in">

        </tbody>
    </table>


    <button type="submit" class="button is-warning margin-top submit_return">入力確認画面へ</button>
