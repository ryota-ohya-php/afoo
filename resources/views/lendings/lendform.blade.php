@csrf
<script>
    $(function() {
        $('#member_id').change( function() {
            var member_id=$(this).val()    
            $('.lend_count').text('');  
            var alert ="";
            var js_array = <?php echo $test; ?>;
            var cc=js_array.length;
           
            for(var i=0 ; i<cc ; i++){
                if(member_id == js_array[i]['id']){
                    var bk_co=js_array[i]['inv_coun'];
                }
            }
            
            
             alert=$('.lend_count').append('現在選択された会員は<span class="bk_count">'+bk_co+'</span>冊貸出しています。');
            js_array="";
        });
        $('input:checkbox').change(function(bk_co) {
            var cnt = $('#count input:checkbox:checked').length;
            var cc=$('.bk_count').text();
            var count=cnt + parseInt( cc );

            
            if (count > 5) {
                alert('6冊以上貸出できません\r\n[現在'+cc+'冊借りています]');
                $('input:checkbox').prop('checked', false);
            }
        }).trigger('change');



    });
</script>

<div class="info_dl">
    <dl class="lending_dl margin-bottom info_dl ">
        <dt>
            会員
        </dt>
            <dd> 
                    <select name="member_id" id="member_id">
                        <option></option>
                        @foreach ($members as $member)
                        <option value="{{$member->id}}">{{$member->name}}(ID:{{$member->id}})
                         @foreach($test as $vval)
                                @if($member->id == $vval->id)
                                    {{$vval->inv_coun}}
                                @endif
                            @endforeach  
                        </option>
                        @endforeach  
                    </select>
                    {{-- <input type="hidden" name="member_name" value="{{$member->name}}"> --}}
                {{-- <input type="number" name="member_id" id="member_id" min="0" required> --}}
            </dd>
        <dt>
            在庫
        </dt>
            <dd><div class=""><p class="lend_count"></p></div>
                <p id="count">
                @for ($i = 0; $i < $inventories->count(); $i++)
                        <input type="checkbox" name="inventory[]" class="" value="{{$inventories[$i]['id']}}">
                        {{-- <input type="hidden" name="book_id[]" value="{{$inventories[$i]['book_id']}}"> --}}
                        <label for="lending">{{$inventories[$i]['title']}}</label>
                        <br>
                @endfor
                </p>
                <?php

                $json_array = json_encode($test);

                ?>
                    
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
<!--<select  id="member" size="5" multiple style="width:400px; height:300px">
    会員ID検索
</select>-->
<ul id="member">
    
</ul>
<input type="hidden" name="">
<button type="submit" class="button is-warning">入力確認画面へ</button>