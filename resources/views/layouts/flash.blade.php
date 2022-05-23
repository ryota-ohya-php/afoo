@if($errors->count())
 <ul class="alert">
     @foreach($errors as $error)
        <li>{{$error}}</li>
     @endforeach
 </ul>
 @endif