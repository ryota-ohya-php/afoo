{{-- 確認画面から送信されるinput --}}

<input type="hidden" name="isbn" value="{{$request->isbn}}">
<input type="hidden" name="title" value="{{$request->title}}">
<input type="hidden" name="author" value="{{$request->author}}">
<input type="hidden" name="category_id" value="{{$request->category_id}}">
<input type="hidden" name="publisher" value="{{$request->publisher}}">
<input type="hidden" name="published_date" value="{{$request->published_date}}">

{{-- ------------------------- --}}