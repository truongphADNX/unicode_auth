<form method="POST" action="{{ route('doctors.logout') }}">
    @csrf
    <button class="badge-info">
        LogOutHere
    </button>
</form>
