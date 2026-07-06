<div id="settings-widget" hx-component="settings"
     class="max-w-md rounded-lg border border-slate-200 bg-white p-5 shadow-sm">

    <h4 class="mb-4 text-base font-semibold text-slate-900">⚙️ Profile settings</h4>

    <div class="flex flex-col gap-4">
        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700">Display name</label>
            <input type="text" hx-model.defer="displayName" value="{{ $displayName ?? '' }}"
                   placeholder="Your display name"
                   class="block w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500" />
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700">Bio</label>
            <textarea hx-model.defer="bio" rows="3" placeholder="Tell us about yourself..."
                      class="block w-full resize-y rounded-md border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500">{{ $bio ?? '' }}</textarea>
        </div>

        <div>
            <label class="mb-1 block text-sm font-medium text-slate-700">Theme</label>
            <select hx-model.defer="theme"
                    class="block w-full rounded-md border border-slate-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-brand-500 focus:outline-none focus:ring-2 focus:ring-brand-500">
                <option value="light"  @selected(($theme ?? 'light') === 'light')>Light</option>
                <option value="dark"   @selected(($theme ?? 'light') === 'dark')>Dark</option>
                <option value="system" @selected(($theme ?? 'light') === 'system')>System</option>
            </select>
        </div>

        <label class="flex cursor-pointer items-center gap-2 text-sm text-slate-700">
            <input type="checkbox" hx-model.defer="newsletter" {{ ($newsletter ?? false) ? 'checked' : '' }}
                   class="h-4 w-4 rounded border-slate-300 text-brand-600 focus:ring-brand-500" />
            Subscribe to newsletter
        </label>

        <div class="flex gap-2 pt-1">
            <button hx-click="save" hx-loading="disabled"
                    class="rounded-md bg-brand-600 px-5 py-2 text-sm font-semibold text-white hover:bg-brand-700 disabled:opacity-50">
                Save settings
            </button>
            <button hx-click="reset"
                    class="rounded-md border border-slate-300 bg-slate-50 px-5 py-2 text-sm font-medium text-slate-700 hover:bg-slate-100">
                Reset
            </button>
        </div>
    </div>

    <p class="mt-3 text-xs text-slate-400">
        Type in the fields above — no requests are made until you click Save. All values are sent together with the
        action (check your network tab).
    </p>
</div>
