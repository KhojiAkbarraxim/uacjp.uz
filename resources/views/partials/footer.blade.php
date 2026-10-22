<footer class="border-t border-white/10 bg-[#001E40] text-white">
    <div class="mx-auto max-w-7xl px-6 py-12 lg:px-8">
        <div class="grid grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-4">
            <div class="space-y-4">
                <div class="flex items-start gap-4">
                    <img
                        src="{{ asset('images/uac-japan-logo-footer.webp') }}"
                        width="320"
                        height="320"
                        alt="UAC Japan footer logo"
                        class="h-16 w-auto shrink-0 sm:h-20"
                        loading="lazy"
                        decoding="async"
                    >
                    <div class="space-y-2 pt-1">
                        <p class="text-lg font-semibold text-white">UAC Japan</p>
                        <x-i18n :text="ui('footer.academic_network')" tag="p" class="text-xs font-semibold uppercase tracking-[0.22em] text-white/80" />
                    </div>
                </div>
                <x-i18n :text="ui('footer.tagline')" tag="p" class="max-w-sm text-sm leading-6 text-white/70" />
                <p class="text-sm text-white/70">{{ $site['domain'] }}</p>
            </div>

            <div>
                <x-i18n :text="ui('footer.navigation_heading')" tag="h2" class="mb-4 text-xs font-semibold uppercase tracking-[0.24em] text-white/80" />
                <div class="space-y-2.5">
                    @foreach ($navigation as $item)
                        <x-i18n :text="$item['label']" tag="a" href="{{ route($item['route']) }}" class="block text-sm leading-6 text-white/70 transition-colors duration-200 hover:text-white" />
                    @endforeach
                </div>
            </div>

            <div>
                <x-i18n :text="ui('footer.contact_heading')" tag="h2" class="mb-4 text-xs font-semibold uppercase tracking-[0.24em] text-white/80" />
                <div class="space-y-2.5 text-sm leading-6 text-white/70">
                    <a href="mailto:{{ config('uac.contact.email') }}" class="block transition-colors duration-200 hover:text-white">
                        {{ config('uac.contact.email') }}
                    </a>
                    <x-i18n :text="ui('footer.regional_contacts')" tag="a" href="{{ route('contact') }}" class="block transition-colors duration-200 hover:text-[#a3f69c]" />
                    <x-i18n :text="ui('footer.response_note')" tag="p" />
                </div>
            </div>

            <div>
                <x-i18n :text="ui('footer.community_heading')" tag="h2" class="mb-4 text-xs font-semibold uppercase tracking-[0.24em] text-white/80" />
                <div class="space-y-3">
                    @foreach (config('uac.contact.socials') as $social)
                        <a href="{{ $social['url'] }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-3 text-sm leading-6 text-white/70 transition-colors duration-200 hover:text-[#a3f69c]">
                            <span class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-white/15 bg-white/5 text-white/80 transition-colors duration-200 hover:bg-white/10">
                                @if (($social['platform'] ?? '') === 'facebook')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4"><path d="M13.397 20.997v-8.196h2.765l.411-3.209h-3.176V7.548c0-.926.258-1.56 1.587-1.56h1.684V3.127A22.336 22.336 0 0 0 14.201 3c-2.444 0-4.122 1.492-4.122 4.231v2.355H7.332v3.209h2.753v8.202h3.312z"/></svg>
                                @elseif (($social['platform'] ?? '') === 'telegram')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4"><path d="M11.944 0A12 12 0 1 0 24 12 12 12 0 0 0 11.944 0zm5.992 8.352-2.04 9.61c-.146.658-.537.818-1.084.508l-3-2.21-1.447 1.394c-.16.16-.295.295-.605.295l.213-3.053 5.56-5.023c.242-.213-.054-.333-.373-.12L6.948 14.77l-2.955-.924c-.643-.204-.657-.643.136-.953l11.566-4.461c.537-.194 1.006.131.241.92z"/></svg>
                                @else
                                    <span class="text-xs font-semibold">{{ strtoupper(substr($social['label'], 0, 1)) }}</span>
                                @endif
                            </span>
                            <span>{{ $social['label'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="border-t border-white/10">
        <div class="mx-auto flex max-w-7xl flex-col gap-3 px-6 py-5 text-sm text-white/70 sm:flex-row sm:items-center sm:justify-between lg:px-8">
            <x-i18n :text="ui('footer.copyright')" tag="p" />
            <div class="flex flex-wrap items-center gap-4">
                <x-i18n :text="ui('footer.privacy_policy')" tag="a" href="#" class="transition-colors duration-200 hover:text-white" />
                <x-i18n :text="ui('footer.terms')" tag="a" href="#" class="transition-colors duration-200 hover:text-white" />
            </div>
        </div>
    </div>
</footer>
