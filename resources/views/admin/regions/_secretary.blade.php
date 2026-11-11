{{-- One secretary row. $i is the array index, $s the row data (array). --}}
<div class="space-y-3 rounded-xl border border-line p-4" data-secretary-row>
    <div class="flex items-center justify-between">
        <p class="text-sm font-semibold text-primary">Secretary</p>
        <button type="button" class="btn-danger" data-remove-secretary>Remove</button>
    </div>
    <div class="grid gap-3 sm:grid-cols-4">
        <label class="block sm:col-span-1">
            <span class="admin-label">Name</span>
            <input name="secretaries[{{ $i }}][name]" type="text" class="form-input" value="{{ $s['name'] ?? '' }}">
        </label>
        <label class="block">
            <span class="admin-label">Email</span>
            <input name="secretaries[{{ $i }}][email]" type="email" class="form-input" value="{{ $s['email'] ?? '' }}">
        </label>
        <label class="block">
            <span class="admin-label">Phone</span>
            <input name="secretaries[{{ $i }}][phone]" type="text" class="form-input" value="{{ $s['phone'] ?? '' }}">
        </label>
        <label class="block">
            <span class="admin-label">Telegram</span>
            <input name="secretaries[{{ $i }}][telegram]" type="text" class="form-input" placeholder="@username" value="{{ $s['telegram'] ?? '' }}">
        </label>
    </div>
    @foreach (['role' => 'Role', 'affiliation' => 'Affiliation'] as $base => $label)
        <div>
            <p class="admin-label">{{ $label }}</p>
            <div class="grid gap-3 sm:grid-cols-3">
                @foreach (\App\Support\Locales::ORDER as $locale)
                    <label class="block">
                        <span class="admin-lang">{{ $locale }}</span>
                        <input name="secretaries[{{ $i }}][{{ $base }}_{{ $locale }}]" type="text" class="form-input mt-1" value="{{ $s["{$base}_{$locale}"] ?? '' }}">
                    </label>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
