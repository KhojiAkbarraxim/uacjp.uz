@props(['cancel'])

<div class="sticky bottom-0 -mx-4 flex items-center justify-end gap-3 border-t border-line bg-white/90 px-4 py-3 backdrop-blur md:-mx-8 md:px-8">
    <a href="{{ $cancel }}" class="btn-secondary">Cancel</a>
    <button type="submit" class="btn-primary">Save</button>
</div>
