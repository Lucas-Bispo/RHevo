export const themeStorageKey = 'folhanova-theme';

export function applyTheme(theme, root = document.documentElement) {
    root.setAttribute('data-theme', theme);
    root.classList.toggle('dark', theme === 'dim');
}

export function initializeTheme({
    root = document.documentElement,
    storage = window.localStorage,
    target = window,
} = {}) {
    const initialTheme = storage.getItem(themeStorageKey) ?? 'dim';

    applyTheme(initialTheme, root);

    target.toggleTheme = () => {
        const nextTheme = root.getAttribute('data-theme') === 'dim' ? 'corporate' : 'dim';

        storage.setItem(themeStorageKey, nextTheme);
        applyTheme(nextTheme, root);
    };
}
