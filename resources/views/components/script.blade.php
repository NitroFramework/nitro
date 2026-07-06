<script src="/js/hx-component.js?v={{ @filemtime(base_path('public/js/hx-component.js')) ?: '1' }}"></script>

<script>
    /* ----- HX-Response-Data binding ----- */
    document.body.addEventListener('htmx:afterSwap', function (evt) {
        const responseData = evt.detail.xhr.getResponseHeader('HX-Response-Data');
        if (!responseData) return;

        try {
            const data = JSON.parse(responseData);
            const component = evt.detail.target.closest('[data-component]');
            if (!component) return;

            Object.entries(data).forEach(([key, value]) => {
                component.querySelectorAll(`[data-bind="${key}"]`).forEach(elem => {
                    if (elem.tagName === 'INPUT' || elem.tagName === 'TEXTAREA') {
                        elem.value = value;
                    } else {
                        elem.textContent = value;
                    }
                });
            });
        } catch (error) {
            console.error('HTMX Data Binding Error:', error, responseData);
        }
    });

    /* ----- NProgress (one bar shared by HTMX + Livewire, per-context config) -----
       Vendor scripts in <head> are `defer`'d, so NProgress/htmx are not yet
       defined when this inline block runs. Wait for DOMContentLoaded — by
       then all deferred scripts have executed (defer guarantees this). */
    document.addEventListener('DOMContentLoaded', function () {
        const config = @json(config('nprogress'));

        if (!config || !config.enabled || !window.NProgress) return;

        // Merge the shared `visual` defaults with a context's overrides.
        const visualFor = (ctx) => {
            const v = Object.assign({}, config.visual || {}, ctx || {});
            const opts = {};
            ['speed', 'minimum', 'trickle', 'trickleSpeed', 'easing', 'showSpinner'].forEach((k) => {
                if (v[k] !== undefined) opts[k] = v[k];
            });
            return { opts: opts, color: v.color, height: v.height };
        };

        // Configure NProgress for this context, then start + apply colour/height
        // (colour and height are CSS, so they're set on the bar element directly).
        const startBar = (visual) => {
            NProgress.configure(visual.opts);
            NProgress.start();
            const bar = document.querySelector('#nprogress .bar');
            if (bar) {
                if (visual.color) bar.style.background = visual.color;
                if (visual.height) bar.style.height = visual.height;
            }
        };

        /* ----- HTMX requests ----- */
        const hx = config.htmx || {};
        if (hx.enabled && window.htmx) {
            const triggers = Array.isArray(hx.triggers) ? hx.triggers : [];
            const minDuration = Number(hx.min_duration_ms) || 0;

            const matchesTriggers = (elt) => {
                if (!elt || !elt.getAttribute) return false;
                return triggers.some((rule) => {
                    const attr = rule && rule.attribute;
                    if (!attr) return false;
                    if (!elt.hasAttribute(attr)) return false;
                    return rule.value === null || rule.value === undefined
                        ? true
                        : elt.getAttribute(attr) === String(rule.value);
                });
            };

            const hxVisual = visualFor(hx);
            let pending = 0;
            const timers = new WeakMap();

            const startSoon = (xhr) => {
                if (minDuration <= 0) {
                    pending++;
                    if (pending === 1) startBar(hxVisual);
                    return;
                }
                const t = setTimeout(() => {
                    timers.delete(xhr);
                    pending++;
                    if (pending === 1) startBar(hxVisual);
                }, minDuration);
                timers.set(xhr, t);
            };

            const finish = (xhr) => {
                const t = timers.get(xhr);
                if (t !== undefined) {
                    clearTimeout(t);
                    timers.delete(xhr);
                    return; // bar never started — nothing to finish
                }
                if (pending > 0) pending--;
                if (pending === 0) NProgress.done();
            };

            document.body.addEventListener('htmx:beforeRequest', (evt) => {
                if (evt.defaultPrevented) return;
                if (!matchesTriggers(evt.detail.elt)) return;
                const xhr = evt.detail.xhr;
                if (!xhr) return;
                xhr.__npTracked = true;
                startSoon(xhr);
            });

            document.body.addEventListener('nitro:navigation-start', (evt) => {
                const token = evt.detail && evt.detail.token;
                if (!token) return;
                startSoon(token);
            });

            document.body.addEventListener('nitro:navigation-end', (evt) => {
                const token = evt.detail && evt.detail.token;
                if (!token) return;
                finish(token);
            });

            const onEnd = (evt) => {
                const xhr = evt.detail && evt.detail.xhr;
                if (xhr && xhr.__npTracked) finish(xhr);
            };
            document.body.addEventListener('htmx:afterRequest',   onEnd);
            document.body.addEventListener('htmx:responseError',  onEnd);
            document.body.addEventListener('htmx:sendError',      onEnd);
            document.body.addEventListener('htmx:timeout',        onEnd);
        }

        /* ----- Livewire wire:navigate ----- */
        const lw = config.livewire || {};
        if (lw.enabled) {
            const lwVisual = visualFor(lw);
            const minDuration = Number(lw.min_duration_ms) || 0;
            let lwTimer = null;

            window.addEventListener('livewire:navigating', () => {
                if (minDuration > 0) lwTimer = setTimeout(() => startBar(lwVisual), minDuration);
                else startBar(lwVisual);
            });
            window.addEventListener('livewire:navigated', () => {
                if (lwTimer) { clearTimeout(lwTimer); lwTimer = null; }
                NProgress.done();
            });
        }
    });

    /* ----- Sync active nav-link highlight on SPA navigation ----- */
    (function () {
        const activeClasses   = ['bg-brand-50', 'text-brand-700'];
        const inactiveClasses = ['text-slate-600', 'hover:bg-slate-100', 'hover:text-slate-900'];

        const sync = () => {
            const path = window.location.pathname;
            document.querySelectorAll('[data-nav-link]').forEach(link => {
                const href = link.getAttribute('data-nav-link');
                const isActive = href === path || (href !== '/' && path.startsWith(href));
                if (isActive) {
                    link.classList.add(...activeClasses);
                    link.classList.remove(...inactiveClasses);
                } else {
                    link.classList.remove(...activeClasses);
                    link.classList.add(...inactiveClasses);
                }
            });
        };

        document.body.addEventListener('htmx:pushedIntoHistory', sync);
        document.body.addEventListener('htmx:afterSettle', sync);
        document.body.addEventListener('nitro:navigation', sync);
    })();
</script>
