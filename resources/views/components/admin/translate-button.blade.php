@props(['context' => 'website content'])

{{-- Hidden entirely when no API key is configured, so the button can never
     fail for a reason the admin cannot act on. --}}
@if (filled(config('services.anthropic.key')))
    <div class="flex flex-wrap items-center gap-3" data-translate data-translate-url="{{ route('admin.translate') }}" data-translate-context="{{ $context }}">
        <button type="button" class="btn-secondary btn-small" data-translate-run>
            Translate into English and Japanese
        </button>
        <span class="admin-hint" data-translate-status></span>
    </div>

    <script>
        (function () {
            const box = document.currentScript.previousElementSibling;
            const button = box.querySelector('[data-translate-run]');
            const status = box.querySelector('[data-translate-status]');
            const form = box.closest('form');
            if (!form) return;

            const SOURCE = @json(\App\Support\Locales::SOURCE);
            const TARGETS = @json(\App\Services\Translator::targets());

            // Only plain {base}_{locale} fields; repeatable rows such as
            // secretaries[0][role_uz] are left to be filled by hand.
            const named = (name) => form.querySelector(`[name="${name}"]`);

            function sourceFields() {
                const out = {};
                form.querySelectorAll(`[name$="_${SOURCE}"]`).forEach((el) => {
                    if (el.name.includes('[')) return;
                    const base = el.name.slice(0, -(SOURCE.length + 1));
                    if (el.value.trim() !== '') out[base] = el.value;
                });
                return out;
            }

            button.addEventListener('click', async () => {
                const fields = sourceFields();

                if (Object.keys(fields).length === 0) {
                    status.textContent = 'Write the Uzbek text first.';
                    return;
                }

                button.disabled = true;
                status.textContent = 'Translating…';

                try {
                    const response = await fetch(box.dataset.translateUrl, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                        },
                        body: JSON.stringify({fields, context: box.dataset.translateContext}),
                    });

                    const payload = await response.json();

                    if (!response.ok) {
                        status.textContent = payload.message || 'Translation failed.';
                        return;
                    }

                    let filled = 0;
                    let kept = 0;

                    TARGETS.forEach((locale) => {
                        Object.entries(payload.translations[locale] || {}).forEach(([base, text]) => {
                            const input = named(`${base}_${locale}`);
                            if (!input || !text) return;
                            // Never overwrite something already written: a second
                            // click must not discard a hand-edited translation.
                            if (input.value.trim() !== '') { kept++; return; }
                            input.value = text;
                            filled++;
                        });
                    });

                    status.textContent = kept > 0
                        ? `Filled ${filled}; left ${kept} you had already written. Review and save.`
                        : `Filled ${filled}. Review and save.`;
                } catch (error) {
                    status.textContent = 'Translation failed. Please try again or write it by hand.';
                } finally {
                    button.disabled = false;
                }
            });
        })();
    </script>
@endif
