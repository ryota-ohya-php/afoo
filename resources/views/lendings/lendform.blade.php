@csrf
<script>
    $(function() {
        $(document).ready(function(){
            var member_id=$('#member_id').val()   
            if(member_id!=""){
            $('.lend_count').text('');  
            var alert ="";
            var js_array = <?php echo $test; ?>;
            var cc=js_array.length;
            var bk_co='';
            for(var i=0 ; i<cc ; i++){
                if(member_id == js_array[i]['id']){
                    bk_co=js_array[i]['inv_coun'];
                }
            }
            
            if(bk_co == ""){
                bk_co=0;
            }
            
             alert=$('.lend_count').append('現在選択された会員は<span class="bk_count">'+bk_co+'</span>冊貸出しています。');
            js_array="";
        } 
        });
        $('#member_id').change( function() {
            var member_id=$(this).val()    
            $('.lend_count').text('');  
            $('input:checkbox').prop('checked', false);
            var alert ="";
            var js_array = <?php echo $test; ?>;
            console.log(js_array);
            var cc=js_array.length;
            var bk_co='';
            for(var i=0 ; i<cc ; i++){
                if(member_id == js_array[i]['id']){
                    bk_co=js_array[i]['inv_coun'];
                }
            }
            if(bk_co == ""){
                bk_co=0;
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

        $('.submit_lend').click( function nosubmit() {
            var lend_check = $('#count input:checkbox:checked').length;
            if (lend_check == 0) {
                alert('本が選択されていません')
                return false;
            }
        });

    });
</script>

<div class="info_dl">
    <dl class="lending_dl margin-bottom info_dl ">
        <dt>
            会員
        </dt>
            <dd> 
                    <select name="member_id" id="member_id" required>
                        <option></option>
                        @foreach ($members as $member)
                            @if(isset($_GET['member_id']))
                                <option value="{{$member->id}}" {{($mem == $member->id)?'selected':''}}>
                            @else
                                <option value="{{$member->id}}">
                            @endif
                            {{$member->name}}(ID:{{$member->id}})
            
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
            貸出可能な本の一覧
        </dt>
            <dd><div class=""><p class="lend_count"></p></div>
                <p id="count">
                @for ($i = 0; $i < $inventories->count(); $i++)
                <label>
                    <input type="checkbox" name="inventory[]" class="" value="{{$inventories[$i]['id']}}">
                        {{$inventories[$i]['title']}}
                </label>
                        <br>
                @endfor
                </p>
                <?php

                $json_array = json_encode($test);

                ?>
                    
            </dd>
        <dt>
            
            貸出日
        </dt>
            <dd> 
                <input type="date" 
                name="lent_date" 
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
<button type="submit" class="button is-warning submit_lend">入力確認画面へ</button>