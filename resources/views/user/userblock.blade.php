<div class="media">
       <a class="pull-left" href="{{ route('admin.profile', ['name' => $user->name]) }}">
           <img class="media-object" alt="{{ $user->name }}" src="{{ $user->getAvatarUrl() }}">
       </a>
    <div class="media-body">
        <h4 class="media-heading"><a href="{{ route('admin.profile', ['name' => $user->name]) }}">{{ $user->name }}</a> </h4>
        @if ($user->location)
            <p>{{ $user->location }}</p>
        @endif
    </div>
</div>
