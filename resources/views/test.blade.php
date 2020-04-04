<div>
        @foreach($posts as $item)
            <li>{{$item->title}}</li>
        @endforeach
        Auth: {{Auth::user()}}<br>
        Guest: {{Auth::guest()}}
</div>