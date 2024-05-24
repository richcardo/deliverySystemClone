<form action="{{ route('set_language_locale', $lang ) }}" method="post">
    @csrf
    <button type="submit" class="nav-link"> <span class="flag-icon flag-icon-{{ $nation }}"></span></button>

</form>