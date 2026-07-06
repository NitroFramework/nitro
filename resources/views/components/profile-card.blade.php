@props([
    'name'       => 'Unknown',
    'role'       => 'Member',
    'verified'   => false,
    'online'     => false,
    'postCount'  => 0,
    'avatarUrl'  => '',
    'initials'   => '?',
    'hasAvatar'  => false,
])

<div {{ $attributes->merge(['class' => 'profile-card rounded-xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900 dark:shadow-none']) }}>

    <div class="profile-card__avatar relative mx-auto h-20 w-20">
        @if ($hasAvatar)
            <img src="{{ $avatarUrl }}" alt="{{ $name }}" class="h-20 w-20 rounded-full object-cover ring-2 ring-white dark:ring-slate-900">
        @else
            <span class="profile-card__initials grid h-20 w-20 place-items-center rounded-full bg-brand-100 text-2xl font-bold text-brand-700 dark:bg-brand-500/15 dark:text-brand-200">{{ $initials }}</span>
        @endif

        @if ($online)
            <span class="absolute bottom-0 right-1 h-4 w-4 rounded-full border-2 border-white bg-green-500 dark:border-slate-900 dark:bg-green-400" title="Online"></span>
        @else
            <span class="absolute bottom-0 right-1 h-4 w-4 rounded-full border-2 border-white bg-slate-400 dark:border-slate-900 dark:bg-slate-600" title="Offline"></span>
        @endif
    </div>

    <div class="profile-card__header mt-3 text-center">
        @if (isset($slots['headline']))
            {!! $slots['headline'] !!}
        @else
            <h3 class="profile-card__name flex items-center justify-center gap-1.5 text-base font-semibold text-slate-900 dark:text-slate-100">
                {{ $name }}
                @if ($verified)
                    <span class="inline-flex h-4 w-4 items-center justify-center rounded-full bg-blue-500 text-[10px] text-white dark:bg-blue-400" title="Verified">✓</span>
                @endif
            </h3>
            <p class="profile-card__role text-sm text-slate-500 dark:text-slate-400">{{ $role }}</p>
        @endif
    </div>

    @if ($slot->isNotEmpty())
        <div class="profile-card__bio mt-3 text-center text-sm text-slate-600 dark:text-slate-300">
            {!! $slot !!}
        </div>
    @endif

    <div class="profile-card__stats mt-4 flex justify-center gap-6 border-t border-slate-100 pt-3 text-center dark:border-slate-800">
        @if (isset($slots['stats']))
            {!! $slots['stats'] !!}
        @else
            <div class="profile-card__stat">
                <strong class="block text-lg font-bold text-slate-900 dark:text-slate-100">{{ $postCount }}</strong>
                <span class="text-xs uppercase tracking-wider text-slate-500 dark:text-slate-400">Posts</span>
            </div>
        @endif
    </div>

    @if (isset($slots['actions']))
        <div class="profile-card__actions mt-4 flex justify-center gap-2">
            {!! $slots['actions'] !!}
        </div>
    @endif
</div>
