<select class="form-control" id="{{$field}}" name="{{$field}}">
@if(isset($items))
    @foreach($items as $item)
        <option>{{ $item->$fieldDisplay }}</option>
    @endforeach
@endif
</select>
