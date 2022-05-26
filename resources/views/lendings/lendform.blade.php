@csrf
<script>
    $(function() {
        $('input:checkbox').change(function() {
            var cnt = $('#count input:checkbox:checked').length;
           
            if (cnt > 5) {
                alert('5冊以上貸出できません');
                $('input:checkbox').prop('checked', false);
            }
        }).trigger('change');

        $('#member_id').change( function() {
            var id=$(this).text();
            console.log(id);
        });

    });
</script>

<div class="info_dl">
    <dl class="lending_dl margin-bottom info_dl ">
        <dt>
            会員
        </dt>
            <dd> 
                    <select name="member_id" id="member_id">
                        @foreach ($members as $member)
                        <option value="{{$member->id}}">{{$member->name}}(ID:{{$member->id}})
                         @foreach($test as $vval)
                                @if($member->id == $vval->id)
                                <span>{{$vval->inv_coun}}</span>
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
            <dd>
                <p id="count">
                @for ($i = 0; $i < $inventories->count(); $i++)
                        <input type="checkbox" name="inventory[]" class="" value="{{$inventories[$i]['id']}}">
                        {{-- <input type="hidden" name="book_id[]" value="{{$inventories[$i]['book_id']}}"> --}}
                        <label for="lending">{{$inventories[$i]['title']}}</label>
                        <br>
                @endfor
                </p>

                    
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