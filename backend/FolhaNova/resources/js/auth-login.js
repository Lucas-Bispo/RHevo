const storageKey = 'folhanova-theme';

const applyTheme = (theme) => {
    document.documentElement.setAttribute('data-theme', theme);
    document.documentElement.classList.toggle('dark', theme === 'dim');
};

const initialTheme = localStorage.getItem(storageKey) ?? 'dim';

applyTheme(initialTheme);

window.toggleTheme = () => {
    const nextTheme = document.documentElement.getAttribute('data-theme') === 'dim' ? 'corporate' : 'dim';

    localStorage.setItem(storageKey, nextTheme);
    applyTheme(nextTheme);
};
