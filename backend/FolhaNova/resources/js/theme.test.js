import { beforeEach, describe, expect, it, vi } from 'vitest';
import { applyTheme, initializeTheme, themeStorageKey } from './theme';

describe('theme helpers', () => {
    beforeEach(() => {
        document.documentElement.removeAttribute('data-theme');
        document.documentElement.className = '';
        localStorage.clear();
        vi.unstubAllGlobals();
    });

    it('applies dim theme with dark class', () => {
        applyTheme('dim');

        expect(document.documentElement.getAttribute('data-theme')).toBe('dim');
        expect(document.documentElement.classList.contains('dark')).toBe(true);
    });

    it('initializes from storage and toggles to the next theme', () => {
        localStorage.setItem(themeStorageKey, 'corporate');

        initializeTheme();

        expect(document.documentElement.getAttribute('data-theme')).toBe('corporate');
        expect(document.documentElement.classList.contains('dark')).toBe(false);

        window.toggleTheme();

        expect(localStorage.getItem(themeStorageKey)).toBe('dim');
        expect(document.documentElement.getAttribute('data-theme')).toBe('dim');
        expect(document.documentElement.classList.contains('dark')).toBe(true);
    });
});
