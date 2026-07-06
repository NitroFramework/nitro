<div id="contact-form-widget" hx-component="contactForm"
     class="max-w-lg rounded-lg border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900 dark:shadow-none">

    <h4 class="mb-4 text-base font-semibold text-slate-900 dark:text-slate-100">📬 Contact form</h4>

    @if (!empty($success))
        <div class="mb-4 rounded-md border border-green-200 bg-green-50 p-3 text-sm text-green-800 dark:border-green-500/30 dark:bg-green-500/10 dark:text-green-200">
            Form submitted successfully! (Total submissions: {{ $count ?? 0 }})
        </div>
        <button hx-click="reset"
                class="rounded-md bg-brand-600 px-4 py-2 text-sm font-medium text-white hover:bg-brand-700 dark:bg-brand-500 dark:hover:bg-brand-400">
            Submit another
        </button>
    @else
        @hxErrors($errors ?? null)

        @php
            $fieldClass = function ($hasError) {
                return 'block w-full rounded-md border bg-white px-3 py-2 text-sm shadow-sm focus:outline-none focus:ring-2 dark:bg-slate-950 dark:text-slate-100 dark:placeholder:text-slate-500 '
                    . ($hasError
                        ? 'border-red-400 focus:border-red-500 focus:ring-red-500 dark:border-red-500/50 dark:focus:border-red-400 dark:focus:ring-red-400'
                        : 'border-slate-300 focus:border-brand-500 focus:ring-brand-500 dark:border-slate-700 dark:focus:border-brand-400 dark:focus:ring-brand-400');
            };
            $hasError = isset($errors)
                ? fn($f) => $errors->has($f)
                : fn($f) => false;
        @endphp

        <form hx-submit="submit" class="flex flex-col gap-3">
            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700 dark:text-slate-300">Name *</label>
                <input type="text" name="name" value="{{ $old['name'] ?? '' }}" placeholder="Your name"
                       class="{{ $fieldClass($hasError('name')) }}" />
                @hxError('name')
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700 dark:text-slate-300">Email *</label>
                <input type="email" name="email" value="{{ $old['email'] ?? '' }}" placeholder="you@example.com"
                       class="{{ $fieldClass($hasError('email')) }}" />
                @hxError('email')
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700 dark:text-slate-300">Age</label>
                <input type="text" name="age" value="{{ $old['age'] ?? '' }}" placeholder="Optional"
                       class="{{ $fieldClass($hasError('age')) }}" />
                @hxError('age')
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700 dark:text-slate-300">Website</label>
                <input type="text" name="website" value="{{ $old['website'] ?? '' }}" placeholder="https://example.com"
                       class="{{ $fieldClass($hasError('website')) }}" />
                @hxError('website')
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700 dark:text-slate-300">Subject *</label>
                <select name="subject" class="{{ $fieldClass($hasError('subject')) }}">
                    <option value="">Select a subject...</option>
                    <option value="general" @selected(($old['subject'] ?? '') === 'general')>General Inquiry</option>
                    <option value="support" @selected(($old['subject'] ?? '') === 'support')>Support</option>
                    <option value="billing" @selected(($old['subject'] ?? '') === 'billing')>Billing</option>
                </select>
                @hxError('subject')
            </div>

            <div>
                <label class="mb-1 block text-sm font-medium text-slate-700 dark:text-slate-300">Message *</label>
                <textarea name="message" rows="4" placeholder="At least 10 characters..."
                          class="{{ $fieldClass($hasError('message')) }} resize-y">{{ $old['message'] ?? '' }}</textarea>
                @hxError('message')
            </div>

            <button type="submit"
                    class="mt-1 w-full rounded-md bg-brand-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-brand-700 dark:bg-brand-500 dark:hover:bg-brand-400">
                Submit
            </button>
        </form>
    @endif
</div>
