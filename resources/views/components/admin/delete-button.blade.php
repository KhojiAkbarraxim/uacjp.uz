@props(['action', 'confirm' => 'Delete this item? This cannot be undone.'])

<form action="{{ $action }}" method="POST" class="inline" data-confirm="{{ $confirm }}">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn-danger">Delete</button>
</form>
